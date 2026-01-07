<?php

namespace App\Livewire\Dashboard;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Pay Bills - 14Finance')]
class BillPayment extends Component
{
    public $bill_type = '';
    public $provider = '';
    public $customer_reference = '';
    public $amount = '';
    public $selectedBillType = null;

    public $billTypes = [
        'electricity' => [
            'name' => 'Electricity',
            'icon' => '⚡',
            'providers' => ['IKEDC', 'EKEDC', 'AEDC', 'PHED'],
            'reference_label' => 'Meter Number'
        ],
        'water' => [
            'name' => 'Water',
            'icon' => '💧',
            'providers' => ['Lagos Water', 'Abuja Water', 'Rivers Water'],
            'reference_label' => 'Customer Number'
        ],
        'internet' => [
            'name' => 'Internet / TV',
            'icon' => '📡',
            'providers' => ['DSTV', 'GOTV', 'Startimes', 'Spectranet', 'Smile'],
            'reference_label' => 'Smart Card / Account Number'
        ],
    ];

    protected $rules = [
        'bill_type' => 'required|in:electricity,water,internet',
        'provider' => 'required|string',
        'customer_reference' => 'required|string|min:5',
        'amount' => 'required|numeric|min:100',
    ];

    protected $messages = [
        'amount.min' => 'Minimum bill payment is ₦100.00',
        'customer_reference.min' => 'Invalid reference number.',
    ];

    public function selectBillType($type)
    {
        $this->bill_type = $type;
        $this->selectedBillType = $this->billTypes[$type];
        $this->reset(['provider', 'customer_reference', 'amount']);
    }

    public function processPayment()
    {
        $this->validate();

        $account = Auth::user()->account;

        // Check sufficient balance
        if ($account->balance < $this->amount) {
            $this->addError('amount', 'Insufficient balance. Available: ₦' . number_format($account->balance, 2));
            return;
        }

        try {
            DB::beginTransaction();

            // Debit account
            $balanceBefore = $account->balance;
            $account->balance -= $this->amount;
            $account->save();

            // Create transaction
            Transaction::create([
                'account_id' => $account->id,
                'transaction_reference' => Transaction::generateReference(),
                'type' => 'debit',
                'category' => 'bill_payment',
                'amount' => $this->amount,
                'balance_before' => $balanceBefore,
                'balance_after' => $account->balance,
                'bill_type' => $this->bill_type,
                'bill_reference' => $this->customer_reference,
                'narration' => $this->provider . ' ' . ucfirst($this->bill_type) . ' - ' . $this->customer_reference,
                'status' => 'completed',
            ]);

            DB::commit();

            session()->flash('success', 'Bill payment successful! ₦' . number_format($this->amount, 2) . ' paid for ' . $this->selectedBillType['name']);

            $this->reset(['bill_type', 'provider', 'customer_reference', 'amount', 'selectedBillType']);

            return redirect()->route('dashboard');

        } catch (\Exception $e) {
            DB::rollBack();
            $this->addError('general', 'Payment failed. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.dashboard.bill-payment');
    }
}
