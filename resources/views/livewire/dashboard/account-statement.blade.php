<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 animate-fade-in">
    {{-- Header --}}
    <div class="mb-8">
        <a href="{{ route('dashboard') }}"
            class="text-blue-900 hover:text-blue-700 font-semibold mb-4 inline-flex items-center gap-2 transition-all"
            wire:navigate>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Back to Dashboard
        </a>
        <h2 class="text-4xl font-bold text-gray-900 mt-4 flex items-center gap-3">
            <svg class="w-10 h-10 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            Account Statement
        </h2>
        <p class="text-gray-600 mt-2 text-lg">Generate and download your account statement</p>
    </div>

    {{-- Date Range Selector --}}
    <div class="card mb-8">
        <h3 class="text-xl font-bold text-gray-900 mb-6">Select Date Range</h3>
        <form wire:submit.prevent="generateStatement" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label for="startDate" class="label">Start Date</label>
                <input type="date" id="startDate" wire:model="startDate" class="input-field" required>
            </div>
            <div>
                <label for="endDate" class="label">End Date</label>
                <input type="date" id="endDate" wire:model="endDate" class="input-field" required>
            </div>
            <div class="flex items-end">
                <button type="submit" class="btn-primary w-full">
                    <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Generate
                </button>
            </div>
        </form>
    </div>

    @if($transactions->count() > 0)
        {{-- Summary Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 border-2 border-blue-200 shadow-lg">
                <p class="text-sm font-semibold text-blue-700 mb-2">Opening Balance</p>
                <p class="text-2xl font-bold text-blue-900">₦{{ number_format($summary['opening_balance'], 2) }}</p>
            </div>
            <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl p-6 border-2 border-green-200 shadow-lg">
                <p class="text-sm font-semibold text-green-700 mb-2">Total Credits</p>
                <p class="text-2xl font-bold text-green-900">₦{{ number_format($summary['total_credits'], 2) }}</p>
            </div>
            <div class="bg-gradient-to-br from-red-50 to-rose-50 rounded-2xl p-6 border-2 border-red-200 shadow-lg">
                <p class="text-sm font-semibold text-red-700 mb-2">Total Debits</p>
                <p class="text-2xl font-bold text-red-900">₦{{ number_format($summary['total_debits'], 2) }}</p>
            </div>
            <div class="bg-gradient-to-br from-purple-50 to-violet-50 rounded-2xl p-6 border-2 border-purple-200 shadow-lg">
                <p class="text-sm font-semibold text-purple-700 mb-2">Closing Balance</p>
                <p class="text-2xl font-bold text-purple-900">₦{{ number_format($summary['closing_balance'], 2) }}</p>
            </div>
        </div>

        {{-- Statement Table --}}
        <div class="card">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-gray-900">Transaction Details</h3>
                <button wire:click="downloadPDF" class="btn-secondary">
                    <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Download PDF
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gradient-to-r from-blue-50 to-indigo-50 border-b-2 border-blue-200">
                        <tr>
                            <th class="px-4 py-4 text-left text-xs font-bold text-blue-900 uppercase tracking-wider">Date
                            </th>
                            <th class="px-4 py-4 text-left text-xs font-bold text-blue-900 uppercase tracking-wider">
                                Reference</th>
                            <th class="px-4 py-4 text-left text-xs font-bold text-blue-900 uppercase tracking-wider">
                                Description</th>
                            <th class="px-4 py-4 text-right text-xs font-bold text-blue-900 uppercase tracking-wider">Debit
                            </th>
                            <th class="px-4 py-4 text-right text-xs font-bold text-blue-900 uppercase tracking-wider">Credit
                            </th>
                            <th class="px-4 py-4 text-right text-xs font-bold text-blue-900 uppercase tracking-wider">
                                Balance</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($transactions as $transaction)
                            <tr class="hover:bg-blue-50 transition-colors">
                                <td class="px-4 py-4 text-sm text-gray-900 font-medium">
                                    {{ $transaction->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-4 py-4 text-sm font-mono text-gray-600">
                                    {{ $transaction->transaction_reference }}
                                </td>
                                <td class="px-4 py-4 text-sm text-gray-600">
                                    {{ $transaction->narration }}
                                </td>
                                <td class="px-4 py-4 text-sm text-right font-semibold text-red-600">
                                    {{ $transaction->type === 'debit' ? '₦' . number_format($transaction->amount, 2) : '-' }}
                                </td>
                                <td class="px-4 py-4 text-sm text-right font-semibold text-green-600">
                                    {{ $transaction->type === 'credit' ? '₦' . number_format($transaction->amount, 2) : '-' }}
                                </td>
                                <td class="px-4 py-4 text-sm text-right font-bold text-gray-900">
                                    ₦{{ number_format($transaction->balance_after, 2) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="card text-center py-12">
            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <p class="text-gray-500 text-lg">No transactions found for the selected date range</p>
        </div>
    @endif
</div>
