<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{-- Header --}}
    <div class="mb-8">
        <a href="{{ route('dashboard') }}"
            class="text-blue-900 hover:text-blue-700 text-sm font-medium mb-4 inline-block" wire:navigate>
            ← Back to Dashboard
        </a>
        <h2 class="text-3xl font-bold text-gray-900">Transfer Funds</h2>
        <p class="text-gray-600 mt-1">Send money to another 14Finance account</p>
    </div>

    {{-- Transfer Form --}}
    <div class="card">
        <form wire:submit.prevent="processTransfer" class="space-y-6">

            {{-- Recipient Account --}}
            <div>
                <label for="recipient_account" class="label">Recipient Account Number</label>
                <div class="relative">
                    <div class="flex gap-2">
                        <input type="text" id="recipient_account" wire:model.live="recipient_account"
                            class="input-field @error('recipient_account') border-red-500 @enderror"
                            placeholder="Enter account number" maxlength="20"
                            autocomplete="off">
                        <button type="button" wire:click="verifyRecipient"
                            class="px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg transition-all hover:shadow-md flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Verify
                        </button>
                    </div>

                    {{-- Account Suggestions Dropdown --}}
                    @if($showSuggestions && $suggestedAccounts->count() > 0)
                        <div class="absolute z-10 w-full mt-2 bg-white border-2 border-blue-200 rounded-xl shadow-2xl overflow-hidden">
                            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-4 py-2 border-b border-blue-200">
                                <p class="text-xs font-bold text-blue-900 uppercase tracking-wide flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                    14Finance MFB Accounts
                                </p>
                            </div>
                            <div class="max-h-64 overflow-y-auto">
                                @foreach($suggestedAccounts as $account)
                                    <button type="button"
                                        wire:click="selectAccount('{{ $account->account_number }}')"
                                        class="w-full text-left px-4 py-3 hover:bg-blue-50 transition-colors border-b border-gray-100 last:border-0">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-3">
                                                <div class="bg-blue-100 p-2 rounded-lg">
                                                    <svg class="w-5 h-5 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <p class="font-bold text-gray-900">{{ $account->user->name }}</p>
                                                    <p class="text-sm text-gray-600 font-mono">{{ $account->account_number }}</p>
                                                </div>
                                            </div>
                                            <span class="text-xs font-semibold px-3 py-1 bg-blue-100 text-blue-800 rounded-full">
                                                {{ ucfirst($account->account_type) }}
                                            </span>
                                        </div>
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                @error('recipient_account')
                    <p class="text-red-600 text-sm mt-1 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Recipient Info --}}
            @if($recipientAccount)
                <div class="bg-gradient-to-br from-green-50 to-emerald-50 border-2 border-green-300 rounded-xl p-5 shadow-lg">
                    <div class="flex items-start gap-4">
                        <div class="bg-green-200 p-3 rounded-xl">
                            <svg class="w-7 h-7 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-xs font-semibold text-green-700 uppercase tracking-wide mb-1">Verified Recipient</p>
                            <p class="text-xl font-bold text-gray-900">{{ $recipientAccount->user->name }}</p>
                            <div class="flex items-center gap-2 mt-2">
                                <span class="inline-flex items-center gap-1 px-3 py-1 bg-white/60 text-green-800 text-xs font-bold rounded-full">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                    14Finance MFB
                                </span>
                                <span class="text-xs font-medium px-2 py-1 bg-green-200 text-green-900 rounded">
                                    {{ ucfirst($recipientAccount->account_type) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Amount --}}
            <div>
                <label for="amount" class="label">Amount (₦)</label>
                <input type="number" id="amount" wire:model="amount"
                    class="input-field @error('amount') border-red-500 @enderror" placeholder="0.00" step="0.01"
                    min="1">
                @error('amount')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-sm text-gray-600 mt-1">
                    Available Balance: ₦{{ number_format(auth()->user()->account->balance, 2) }}
                </p>
            </div>

            {{-- Narration --}}
            <div>
                <label for="narration" class="label">Transaction Note (Optional)</label>
                <textarea id="narration" wire:model="narration"
                    class="input-field @error('narration') border-red-500 @enderror"
                    placeholder="Add a note for this transfer" rows="3" maxlength="255"></textarea>
                @error('narration')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Error Message --}}
            @error('general')
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded">
                    {{ $message }}
                </div>
            @enderror

            {{-- Submit Button --}}
            <div class="flex gap-3">
                <button type="submit" class="flex-1 btn-primary" @if(!$recipientAccount || !$amount) disabled @endif>
                    Transfer ₦{{ $amount ? number_format($amount, 2) : '0.00' }}
                </button>
                <a href="{{ route('dashboard') }}" class="btn-secondary" wire:navigate>
                    Cancel
                </a>
            </div>
        </form>
    </div>

    {{-- Security Notice --}}
    <div class="mt-6 bg-gray-100 border border-gray-300 rounded-lg p-4">
        <p class="text-sm text-gray-700">
            <strong>Security Notice:</strong> Always verify the recipient's account number before transferring.
            Transactions cannot be reversed once completed.
        </p>
    </div>
</div>
