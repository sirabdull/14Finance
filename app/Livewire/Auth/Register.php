<?php

namespace App\Livewire\Auth;

use App\Models\Account;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.guest')]
#[Title('Create Account - 14Finance')]
class Register extends Component
{
    public string $name = '';
    public string $email = '';
    public string $phone = '';
    public string $address = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $account_type = 'savings';

    public function rules()
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|min:10|max:20',
            'address' => 'required|string|min:10|max:500',
            'password' => 'required|string|min:6|confirmed',
            'account_type' => 'required|in:savings,current',
        ];
    }

    protected $messages = [
        'name.min' => 'Name must be at least 3 characters.',
        'email.unique' => 'This email is already registered.',
        'phone.min' => 'Please enter a valid phone number.',
        'address.min' => 'Please provide a complete address.',
        'password.min' => 'Password must be at least 6 characters.',
        'password.confirmed' => 'Password confirmation does not match.',
    ];

    public function register()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            // Create user
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'address' => $this->address,
                'password' => Hash::make($this->password),
            ]);

            // Create account with initial balance
            $account = Account::create([
                'user_id' => $user->id,
                'account_number' => Account::generateAccountNumber(),
                'account_type' => $this->account_type,
                'balance' => 100000.00,
                'status' => 'active',
            ]);

            // Create opening balance transaction
            Transaction::create([
                'account_id' => $account->id,
                'transaction_reference' => Transaction::generateReference(),
                'amount' => 100000.00,
                'type' => 'credit',
                'balance_before' => 0.00,
                'balance_after' => 100000.00,
                'category' => 'deposit',
                'narration' => 'Welcome bonus - Opening account credit from 14Finance MFB',
            ]);

            DB::commit();

            // Log the user in
            Auth::login($user);

            session()->flash('success', 'Welcome to 14Finance! Your account has been created successfully. Account Number: ' . $account->account_number);

            return redirect()->route('dashboard');

        } catch (\Exception $e) {
            DB::rollBack();
            $this->addError('general', 'Registration failed. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
