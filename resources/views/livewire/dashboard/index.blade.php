<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 animate-fade-in">
    {{-- Welcome Section --}}
    <div class="mb-10">
        <h2 class="text-4xl font-bold bg-gradient-to-r from-blue-900 to-blue-700 bg-clip-text text-transparent">Welcome back, {{ auth()->user()->name }}</h2>
        <p class="text-gray-600 mt-2 text-lg font-medium">Here's your account overview</p>
    </div>

    {{-- Account Summary Card --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <div class="lg:col-span-2 animate-slide-up">
            <div class="stat-card">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <p class="text-sm text-blue-200 mb-2 font-medium tracking-wide uppercase">Account Number</p>
                        <p class="text-2xl font-bold text-white tracking-wide">{{ $account->account_number }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-blue-200 mb-2 font-medium tracking-wide uppercase">Account Type</p>
                        <span class="inline-block px-4 py-2 bg-white/20 backdrop-blur-sm text-white text-sm font-bold rounded-lg">
                            {{ ucfirst($account->account_type) }}
                        </span>
                    </div>
                </div>

                <div class="border-t border-white/20 pt-6">
                    <div>
                        <div class="flex justify-between items-center mb-4">
                            <p class="text-sm text-blue-200 font-medium tracking-wide uppercase flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Available Balance
                            </p>
                            <button
                                wire:click="toggleBalance"
                                class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-lg text-xs font-semibold transition-all duration-300 backdrop-blur-sm flex items-center gap-1.5"
                            >
                                @if($showBalance)
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                    </svg>
                                @else
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                @endif
                                {{ $showBalance ? 'Hide' : 'Show' }}
                            </button>
                        </div>
                        <div>
                            @if($showBalance)
                                <p class="text-3xl md:text-4xl lg:text-5xl font-bold text-white tracking-tight break-all">₦{{ number_format($account->balance, 2) }}</p>
                            @else
                                <p class="text-3xl md:text-4xl lg:text-5xl font-bold text-white tracking-tight">••••••</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="card animate-slide-up" style="animation-delay: 0.1s">
            <h3 class="text-xl font-bold text-gray-900 mb-6">Quick Actions</h3>
            <div class="space-y-4">
                <a href="{{ route('transfer') }}" class="block w-full text-center btn-primary group" wire:navigate>
                    <svg class="w-5 h-5 inline-block mr-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                    </svg>
                    Transfer Funds
                </a>
                <a href="{{ route('bills') }}" class="block w-full text-center btn-secondary group" wire:navigate>
                    <svg class="w-5 h-5 inline-block mr-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    Pay Bills
                </a>
                <a href="{{ route('transactions') }}" class="block w-full text-center btn-secondary group" wire:navigate>
                    <svg class="w-5 h-5 inline-block mr-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    View Transactions
                </a>
                <a href="{{ route('statement') }}" class="block w-full text-center btn-secondary group" wire:navigate>
                    <svg class="w-5 h-5 inline-block mr-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Account Statement
                </a>
            </div>
        </div>
    </div>

    {{-- Account Stats --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 animate-slide-up" style="animation-delay: 0.2s">
        <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl p-6 border-2 border-green-200 shadow-lg hover:shadow-xl transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-green-700 mb-2 uppercase tracking-wide">Total Credits</p>
                    <p class="text-3xl font-bold text-green-900">₦{{ number_format($account->transactions()->where('type', 'credit')->sum('amount'), 2) }}</p>
                </div>
                <div class="bg-green-200 p-4 rounded-xl">
                    <svg class="w-8 h-8 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"/>
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-red-50 to-rose-50 rounded-2xl p-6 border-2 border-red-200 shadow-lg hover:shadow-xl transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-red-700 mb-2 uppercase tracking-wide">Total Debits</p>
                    <p class="text-3xl font-bold text-red-900">₦{{ number_format($account->transactions()->where('type', 'debit')->sum('amount'), 2) }}</p>
                </div>
                <div class="bg-red-200 p-4 rounded-xl">
                    <svg class="w-8 h-8 text-red-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"/>
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 border-2 border-blue-200 shadow-lg hover:shadow-xl transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-blue-700 mb-2 uppercase tracking-wide">Total Transactions</p>
                    <p class="text-3xl font-bold text-blue-900">{{ $account->transactions()->count() }}</p>
                </div>
                <div class="bg-blue-200 p-4 rounded-xl">
                    <svg class="w-8 h-8 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Recent Transactions --}}
    <div class="card animate-slide-up" style="animation-delay: 0.3s">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-bold text-gray-900 flex items-center gap-3">
                <svg class="w-7 h-7 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Recent Transactions
            </h3>
            <a href="{{ route('transactions') }}" class="text-blue-900 hover:text-blue-700 text-sm font-medium"
                wire:navigate>
                View All →
            </a>
        </div>

        @if($recentTransactions->count() > 0)
            {{-- Mobile Card View --}}
            <div class="block md:hidden space-y-4">
                @foreach($recentTransactions as $transaction)
                    <div class="bg-white border-2 border-gray-100 rounded-xl p-3 hover:shadow-lg transition-all">
                        <div class="flex justify-between items-start mb-2">
                            <div class="flex items-center gap-2">
                                <div class="p-1.5 rounded-lg {{ $transaction->type === 'credit' ? 'bg-green-100' : 'bg-red-100' }}">
                                    @if($transaction->type === 'credit')
                                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"/>
                                        </svg>
                                    @else
                                        <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"/>
                                        </svg>
                                    @endif
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900 text-xs">{{ ucfirst($transaction->category) }}</p>
                                    <p class="text-[10px] text-gray-500">{{ $transaction->created_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-bold {{ $transaction->type === 'credit' ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $transaction->type === 'credit' ? '+' : '-' }}₦{{ number_format($transaction->amount, 2) }}
                                </p>
                                <span class="inline-flex px-1.5 py-0.5 text-[10px] font-semibold rounded-full
                                    {{ $transaction->status === 'completed' ? 'bg-green-100 text-green-800' :
                                        ($transaction->status === 'pending' ? 'bg-yellow-100 text-yellow-800' :
                                            'bg-red-100 text-red-800') }}">
                                    {{ ucfirst($transaction->status) }}
                                </span>
                            </div>
                        </div>
                        <div class="pt-2 border-t border-gray-100">
                            <p class="text-xs text-gray-600 line-clamp-2">{{ $transaction->narration ?? $transaction->transaction_reference }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Desktop Table View --}}
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gradient-to-r from-blue-50 to-indigo-50 border-b-2 border-blue-200">
                        <tr>
                            <th class="px-4 py-4 text-left text-xs font-bold text-blue-900 uppercase tracking-wider">Date</th>
                            <th class="px-4 py-4 text-left text-xs font-bold text-blue-900 uppercase tracking-wider">Type</th>
                            <th class="px-4 py-4 text-left text-xs font-bold text-blue-900 uppercase tracking-wider">Description</th>
                            <th class="px-4 py-4 text-right text-xs font-bold text-blue-900 uppercase tracking-wider">Amount</th>
                            <th class="px-4 py-4 text-center text-xs font-bold text-blue-900 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($recentTransactions as $transaction)
                            <tr class="hover:bg-blue-50 transition-colors">
                                <td class="px-4 py-4 text-sm text-gray-900 font-medium">
                                    {{ $transaction->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-4 py-4 text-sm">
                                    <span class="inline-flex items-center gap-2">
                                        @if($transaction->type === 'credit')
                                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"/>
                                            </svg>
                                        @else
                                            <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"/>
                                            </svg>
                                        @endif
                                        <span class="font-semibold text-gray-700">{{ ucfirst($transaction->category) }}</span>
                                    </span>
                                </td>
                                <td class="px-4 py-4 text-sm text-gray-600">
                                    {{ $transaction->narration ?? $transaction->transaction_reference }}
                                </td>
                                <td class="px-4 py-4 text-sm text-right font-bold
                                    {{ $transaction->type === 'credit' ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $transaction->type === 'credit' ? '+' : '-' }}₦{{ number_format($transaction->amount, 2) }}
                                </td>
                                <td class="px-4 py-4 text-center">
                                    <span class="inline-flex px-3 py-1 text-xs font-bold rounded-full
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
        @else
            <div class="text-center py-12">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <p class="text-gray-500 text-lg">No transactions yet</p>
                <p class="text-gray-400 text-sm mt-2">Start by making a transfer or paying bills</p>
            </div>
        @endif
    </div>
</div>
