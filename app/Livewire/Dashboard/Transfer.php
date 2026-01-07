<?php

namespace App\Livewire\Dashboard;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Transfer Funds - 14Finance')]
class Transfer extends Component
{
    public $recipient_account = '';
    public $amount = '';
    public $narration = '';
    public $confirmTransfer = false;
    public $recipientAccount = null;
    public $suggestedAccounts = [];
    public $showSuggestions = false;

    protected $rules = [
        'recipient_account' => 'required|string|exists:accounts,account_number',
        'amount' => 'required|numeric|min:1',
        'narration' => 'nullable|string|max:255',
    ];

    protected $messages = [
        'recipient_account.exists' => 'Recipient account number does not exist.',
        'amount.min' => 'Amount must be at least ₦1.00',
    ];

    public function updatedRecipientAccount($value)
    {
        if (strlen($value) >= 3) {
            $this->suggestedAccounts = Account::with('user')
                ->where('account_number', 'like', '%' . $value . '%')
                ->where('id', '!=', Auth::user()->account->id)
                ->where('status', 'active')
                ->limit(5)
                ->get();
            $this->showSuggestions = $this->suggestedAccounts->count() > 0;
        } else {
            $this->suggestedAccounts = [];
            $this->showSuggestions = false;
        }
    }

    public function selectAccount($accountNumber)
    {
        $this->recipient_account = $accountNumber;
        $this->showSuggestions = false;
        $this->verifyRecipient();
    }

    public function verifyRecipient()
    {
        $this->validate([
            'recipient_account' => 'required|string|exists:accounts,account_number',
        ]);

        $this->recipientAccount = Account::with('user')
            ->where('account_number', $this->recipient_account)
            ->first();

        if ($this->recipientAccount->id === Auth::user()->account->id) {
            $this->addError('recipient_account', 'Cannot transfer to your own account.');
            $this->recipientAccount = null;
            return;
        }
    }

    public function processTransfer()
    {
        $this->validate();

        $senderAccount = Auth::user()->account;

        // Verify recipient again
        if (!$this->recipientAccount) {
            $this->verifyRecipient();
            if (!$this->recipientAccount) {
                return;
            }
        }

        // Check for self-transfer
        if ($this->recipientAccount->id === $senderAccount->id) {
            $this->addError('recipient_account', 'Cannot transfer to your own account.');
            return;
        }

        // Check sufficient balance
        if ($senderAccount->balance < $this->amount) {
            $this->addError('amount', 'Insufficient balance. Available: ₦' . number_format($senderAccount->balance, 2));
            return;
        }

        try {
            DB::beginTransaction();

            // Debit sender
            $senderBalanceBefore = $senderAccount->balance;
            $senderAccount->balance -= $this->amount;
            $senderAccount->save();

            // Create debit transaction
            Transaction::create([
                'account_id' => $senderAccount->id,
                'transaction_reference' => Transaction::generateReference(),
                'type' => 'debit',
                'category' => 'transfer',
                'amount' => $this->amount,
                'balance_before' => $senderBalanceBefore,
                'balance_after' => $senderAccount->balance,
                'recipient_account' => $this->recipientAccount->account_number,
                'recipient_name' => $this->recipientAccount->user->name,
                'narration' => $this->narration ?: 'Fund transfer to ' . $this->recipientAccount->user->name,
                'status' => 'completed',
            ]);

            // Credit recipient
            $recipientBalanceBefore = $this->recipientAccount->balance;
            $this->recipientAccount->balance += $this->amount;
            $this->recipientAccount->save();

            // Create credit transaction
            Transaction::create([
                'account_id' => $this->recipientAccount->id,
                'transaction_reference' => Transaction::generateReference(),
                'type' => 'credit',
                'category' => 'transfer',
                'amount' => $this->amount,
                'balance_before' => $recipientBalanceBefore,
                'balance_after' => $this->recipientAccount->balance,
                'recipient_account' => $senderAccount->account_number,
                'recipient_name' => $senderAccount->user->name,
                'narration' => $this->narration ?: 'Fund transfer from ' . $senderAccount->user->name,
                'status' => 'completed',
            ]);

            DB::commit();

            session()->flash('success', 'Transfer successful! ₦' . number_format($this->amount, 2) . ' sent to ' . $this->recipientAccount->user->name);

            $this->reset(['recipient_account', 'amount', 'narration', 'recipientAccount', 'confirmTransfer']);

            return redirect()->route('dashboard');

        } catch (\Exception $e) {
            DB::rollBack();
            $this->addError('general', 'Transfer failed. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.dashboard.transfer');
    }
}
