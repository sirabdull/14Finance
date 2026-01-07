<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{-- Header --}}
    <div class="mb-8">
        <a href="{{ route('dashboard') }}"
            class="text-blue-900 hover:text-blue-700 text-sm font-medium mb-4 inline-block" wire:navigate>
            ← Back to Dashboard
        </a>
        <h2 class="text-3xl font-bold text-gray-900">Transaction History</h2>
        <p class="text-gray-600 mt-1">View all your account transactions</p>
    </div>

    {{-- Filters --}}
    <div class="card mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            {{-- Search --}}
            <div>
                <label for="search" class="label">Search</label>
                <input type="text" id="search" wire:model.live.debounce.300ms="searchTerm" class="input-field"
                    placeholder="Search by reference, name, or note">
            </div>

            {{-- Type Filter --}}
            <div>
                <label for="filterType" class="label">Transaction Type</label>
                <select id="filterType" wire:model.live="filterType" class="input-field">
                    <option value="all">All Types</option>
                    <option value="credit">Credit (Incoming)</option>
                    <option value="debit">Debit (Outgoing)</option>
                </select>
            </div>

            {{-- Category Filter --}}
            <div>
                <label for="filterCategory" class="label">Category</label>
                <select id="filterCategory" wire:model.live="filterCategory" class="input-field">
                    <option value="all">All Categories</option>
                    <option value="transfer">Transfer</option>
                    <option value="bill_payment">Bill Payment</option>
                    <option value="deposit">Deposit</option>
                    <option value="withdrawal">Withdrawal</option>
                </select>
            </div>
        </div>
    </div>

    {{-- Transactions Table --}}
    <div class="card">
        @if($transactions->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                Date & Time
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                Reference
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                Type
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                Description
                            </th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-600 uppercase tracking-wider">
                                Amount
                            </th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-600 uppercase tracking-wider">
                                Balance After
                            </th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-600 uppercase tracking-wider">
                                Status
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($transactions as $transaction)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-4 text-sm text-gray-900">
                                            <div>{{ $transaction->created_at->format('M d, Y') }}</div>
                                            <div class="text-xs text-gray-500">{{ $transaction->created_at->format('h:i A') }}</div>
                                        </td>
                                        <td class="px-4 py-4 text-sm font-mono text-gray-600">
                                            {{ $transaction->transaction_reference }}
                                        </td>
                                        <td class="px-4 py-4 text-sm">
                                            <span
                                                class="inline-flex px-2 py-1 text-xs font-medium rounded
                                                    {{ $transaction->type === 'credit' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ ucfirst($transaction->type) }}
                                            </span>
                                            <div class="text-xs text-gray-500 mt-1">
                                                {{ ucfirst(str_replace('_', ' ', $transaction->category)) }}</div>
                                        </td>
                                        <td class="px-4 py-4 text-sm text-gray-600">
                                            <div>{{ $transaction->narration }}</div>
                                            @if($transaction->recipient_name)
                                                <div class="text-xs text-gray-500 mt-1">
                                                    {{ $transaction->type === 'credit' ? 'From' : 'To' }}:
                                                    {{ $transaction->recipient_name }}
                                                </div>
                                            @endif
                                            @if($transaction->bill_reference)
                                                <div class="text-xs text-gray-500 mt-1">
                                                    Ref: {{ $transaction->bill_reference }}
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-4 py-4 text-sm text-right font-semibold
                                                {{ $transaction->type === 'credit' ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $transaction->type === 'credit' ? '+' : '-' }}₦{{ number_format($transaction->amount, 2) }}
                                        </td>
                                        <td class="px-4 py-4 text-sm text-right text-gray-900 font-medium">
                                            ₦{{ number_format($transaction->balance_after, 2) }}
                                        </td>
                                        <td class="px-4 py-4 text-center">
                                            <span class="inline-flex px-2 py-1 text-xs font-medium rounded
                                                    {{ $transaction->status === 'completed' ? 'bg-green-100 text-green-800' :
                            ($transaction->status === 'pending' ? 'bg-yellow-100 text-yellow-800' :
                                'bg-red-100 text-red-800') }}">
                                                {{ ucfirst($transaction->status) }}
                                            </span>
                                        </td>
                                    </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $transactions->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <div class="text-5xl mb-4">📄</div>
                <p class="text-gray-500 text-lg">No transactions found</p>
                @if($searchTerm || $filterType !== 'all' || $filterCategory !== 'all')
                    <p class="text-sm text-gray-400 mt-2">Try adjusting your filters</p>
                @endif
            </div>
        @endif
    </div>

    {{-- Account Summary --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
        <div class="card text-center">
            <p class="text-sm text-gray-600 mb-2">Current Balance</p>
            <p class="text-2xl font-bold text-gray-900">₦{{ number_format($account->balance, 2) }}</p>
        </div>
        <div class="card text-center">
            <p class="text-sm text-gray-600 mb-2">Total Transactions</p>
            <p class="text-2xl font-bold text-gray-900">{{ $account->transactions()->count() }}</p>
        </div>
        <div class="card text-center">
            <p class="text-sm text-gray-600 mb-2">Account Number</p>
            <p class="text-2xl font-bold text-gray-900">{{ $account->account_number }}</p>
        </div>
    </div>
</div>
