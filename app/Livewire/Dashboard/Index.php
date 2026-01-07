<?php

namespace App\Livewire\Dashboard;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Dashboard - 14Finance')]
class Index extends Component
{
    public $showBalance = true;
    public $account;
    public $recentTransactions;

    public function mount()
    {
        $this->account = Auth::user()->account;
        $this->recentTransactions = $this->account->transactions()
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
    }

    public function toggleBalance()
    {
        $this->showBalance = !$this->showBalance;
    }

    public function render()
    {
        return view('livewire.dashboard.index');
    }
}
