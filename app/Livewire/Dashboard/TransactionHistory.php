<?php

namespace App\Livewire\Dashboard;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
#[Title('Transaction History - 14Finance')]
class TransactionHistory extends Component
{
    use WithPagination;

    public $filterType = 'all';
    public $filterCategory = 'all';
    public $searchTerm = '';

    public function updatingFilterType()
    {
        $this->resetPage();
    }

    public function updatingFilterCategory()
    {
        $this->resetPage();
    }

    public function updatingSearchTerm()
    {
        $this->resetPage();
    }

    public function render()
    {
        $account = Auth::user()->account;

        $query = $account->transactions()->orderBy('created_at', 'desc');

        // Filter by type
        if ($this->filterType !== 'all') {
            $query->where('type', $this->filterType);
        }

        // Filter by category
        if ($this->filterCategory !== 'all') {
            $query->where('category', $this->filterCategory);
        }

        // Search
        if ($this->searchTerm) {
            $query->where(function($q) {
                $q->where('transaction_reference', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('narration', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('recipient_name', 'like', '%' . $this->searchTerm . '%');
            });
        }

        $transactions = $query->paginate(15);

        return view('livewire.dashboard.transaction-history', [
            'transactions' => $transactions,
            'account' => $account,
        ]);
    }
}
