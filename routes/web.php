<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Dashboard\Index;
use App\Livewire\Dashboard\Transfer;
use App\Livewire\Dashboard\BillPayment;
use App\Livewire\Dashboard\TransactionHistory;
use App\Livewire\Dashboard\AccountStatement;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', Login::class)->name('login')->middleware('guest');
Route::get('/register', Register::class)->name('register')->middleware('guest');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', Index::class)->name('dashboard');
    Route::get('/transfer', Transfer::class)->name('transfer');
    Route::get('/bills', BillPayment::class)->name('bills');
    Route::get('/transactions', TransactionHistory::class)->name('transactions');
    Route::get('/statement', AccountStatement::class)->name('statement');

    Route::post('/logout', function () {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
    })->name('logout');
});
