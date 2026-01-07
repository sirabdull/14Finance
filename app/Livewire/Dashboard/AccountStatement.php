<?php

namespace App\Livewire\Dashboard;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Account Statement - 14Finance')]
class AccountStatement extends Component
{
    public $startDate = '';
    public $endDate = '';
    public $account;
    public $transactions = [];
    public $summary = [];

    public function mount()
    {
        $this->account = Auth::user()->account;
        $this->startDate = now()->subDays(30)->format('Y-m-d');
        $this->endDate = now()->format('Y-m-d');
        $this->generateStatement();
    }

    public function generateStatement()
    {
        $this->validate([
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
        ]);

        $this->transactions = $this->account->transactions()
            ->whereBetween('created_at', [$this->startDate, $this->endDate])
            ->orderBy('created_at', 'desc')
            ->get();

        $this->summary = [
            'opening_balance' => $this->account->transactions()
                ->where('created_at', '<', $this->startDate)
                ->orderBy('created_at', 'desc')
                ->first()?->balance_after ?? 0,
            'total_credits' => $this->transactions->where('type', 'credit')->sum('amount'),
            'total_debits' => $this->transactions->where('type', 'debit')->sum('amount'),
            'closing_balance' => $this->account->balance,
            'transaction_count' => $this->transactions->count(),
        ];
    }

    public function downloadPDF()
    {
        // This would require a PDF library like dompdf or snappy
        // For now, we'll just show the statement
        session()->flash('info', 'PDF download feature coming soon!');
    }

    public function render()
    {
        return view('livewire.dashboard.account-statement');
    }
}
