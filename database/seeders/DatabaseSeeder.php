<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create demo users with accounts
        $users = [
            [
                'name' => 'John Doe',
                'email' => 'john@14finance.com',
                'password' => Hash::make('password'),
                'phone' => '+234 801 234 5678',
                'address' => '123 Lagos Street, Victoria Island, Lagos',
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@14finance.com',
                'password' => Hash::make('password'),
                'phone' => '+234 802 345 6789',
                'address' => '456 Abuja Avenue, Garki, Abuja',
            ],
            [
                'name' => 'Michael Johnson',
                'email' => 'michael@14finance.com',
                'password' => Hash::make('password'),
                'phone' => '+234 803 456 7890',
                'address' => '789 Port Harcourt Road, GRA, Port Harcourt',
            ],
        ];

        foreach ($users as $userData) {
            $user = User::create($userData);

            // Create account for each user
            $account = Account::create([
                'user_id' => $user->id,
                'account_number' => Account::generateAccountNumber(),
                'account_type' => ['savings', 'current'][array_rand(['savings', 'current'])],
                'balance' => rand(50000, 500000), // Random balance between 50k and 500k
                'status' => 'active',
            ]);

            // Create some sample transactions for the first user
            if ($user->email === 'john@14finance.com') {
                $this->createSampleTransactions($account);
            }
        }

        $this->command->info('Demo users created successfully!');
        $this->command->info('');
        $this->command->info('Login Credentials:');
        $this->command->info('==================');

        $demoUsers = User::all();
        foreach ($demoUsers as $user) {
            $this->command->info("Email: {$user->email}");
            $this->command->info("Account: {$user->account->account_number}");
            $this->command->info("Password: password");
            $this->command->info("Balance: ₦" . number_format($user->account->balance, 2));
            $this->command->info('------------------');
        }
    }

    /**
     * Create sample transactions for an account.
     */
    private function createSampleTransactions(Account $account): void
    {
        // Sample deposit
        $balanceBefore = 0;
        $balanceAfter = 100000;

        Transaction::create([
            'account_id' => $account->id,
            'transaction_reference' => Transaction::generateReference(),
            'type' => 'credit',
            'category' => 'deposit',
            'amount' => 100000,
            'balance_before' => $balanceBefore,
            'balance_after' => $balanceAfter,
            'narration' => 'Initial deposit',
            'status' => 'completed',
            'created_at' => now()->subDays(30),
        ]);

        // Sample transfers and payments
        $transactions = [
            [
                'type' => 'debit',
                'category' => 'transfer',
                'amount' => 15000,
                'narration' => 'Transfer to savings account',
                'days_ago' => 25,
            ],
            [
                'type' => 'debit',
                'category' => 'bill_payment',
                'amount' => 5000,
                'narration' => 'Electricity bill payment',
                'bill_type' => 'electricity',
                'bill_reference' => '1234567890',
                'days_ago' => 20,
            ],
            [
                'type' => 'credit',
                'category' => 'transfer',
                'amount' => 25000,
                'narration' => 'Salary payment',
                'days_ago' => 15,
            ],
            [
                'type' => 'debit',
                'category' => 'bill_payment',
                'amount' => 3500,
                'narration' => 'Internet bill payment',
                'bill_type' => 'internet',
                'bill_reference' => '0987654321',
                'days_ago' => 10,
            ],
            [
                'type' => 'debit',
                'category' => 'transfer',
                'amount' => 8000,
                'narration' => 'Transfer to friend',
                'days_ago' => 5,
            ],
        ];

        $currentBalance = $balanceAfter;

        foreach ($transactions as $txn) {
            $amount = $txn['amount'];
            $balanceBefore = $currentBalance;

            if ($txn['type'] === 'credit') {
                $currentBalance += $amount;
            } else {
                $currentBalance -= $amount;
            }

            Transaction::create([
                'account_id' => $account->id,
                'transaction_reference' => Transaction::generateReference(),
                'type' => $txn['type'],
                'category' => $txn['category'],
                'amount' => $amount,
                'balance_before' => $balanceBefore,
                'balance_after' => $currentBalance,
                'narration' => $txn['narration'],
                'bill_type' => $txn['bill_type'] ?? null,
                'bill_reference' => $txn['bill_reference'] ?? null,
                'status' => 'completed',
                'created_at' => now()->subDays($txn['days_ago']),
            ]);
        }

        // Update account balance
        $account->update(['balance' => $currentBalance]);
    }
}
