<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.guest')]
#[Title('Login - 14Finance')]
class Login extends Component
{
    public string $account_identifier = '';
    public string $password = '';
    public bool $remember = false;

    public function rules()
    {
        return [
            'account_identifier' => 'required|string',
            'password' => 'required|string',
        ];
    }

    public function login()
    {
        $this->validate();

        // Check if identifier is email or account number
        $field = filter_var($this->account_identifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'account_number';

        $credentials = [
            $field => $this->account_identifier,
            'password' => $this->password,
        ];

        // If trying to login with account number, find user via account relationship
        if ($field === 'account_number') {
            $account = \App\Models\Account::where('account_number', $this->account_identifier)->first();

            if (!$account) {
                $this->addError('account_identifier', 'Invalid account number or password.');
                return;
            }

            $credentials = [
                'email' => $account->user->email,
                'password' => $this->password,
            ];
        }

        if (Auth::attempt($credentials, $this->remember)) {
            session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        $this->addError('account_identifier', 'Invalid credentials.');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
