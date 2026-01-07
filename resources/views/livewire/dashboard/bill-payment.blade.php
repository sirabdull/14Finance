<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{-- Header --}}
    <div class="mb-8">
        <a href="{{ route('dashboard') }}"
            class="text-blue-900 hover:text-blue-700 text-sm font-medium mb-4 inline-block" wire:navigate>
            ← Back to Dashboard
        </a>
        <h2 class="text-3xl font-bold text-gray-900">Pay Bills</h2>
        <p class="text-gray-600 mt-1">Pay your utility bills securely</p>
    </div>

    @if(!$selectedBillType)
        {{-- Bill Type Selection --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($billTypes as $key => $bill)
                <button wire:click="selectBillType('{{ $key }}')"
                    class="card hover:shadow-md transition-shadow cursor-pointer text-center group">
                    <div class="text-5xl mb-4">{{ $bill['icon'] }}</div>
                    <h3 class="text-xl font-semibold text-gray-900 group-hover:text-blue-900 transition-colors">
                        {{ $bill['name'] }}
                    </h3>
                    <p class="text-sm text-gray-600 mt-2">
                        {{ implode(', ', $bill['providers']) }}
                    </p>
                </button>
            @endforeach
        </div>
    @else
        {{-- Payment Form --}}
        <div class="card">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h3 class="text-2xl font-semibold text-gray-900">{{ $selectedBillType['name'] }}</h3>
                    <p class="text-sm text-gray-600 mt-1">Complete your payment</p>
                </div>
                <button wire:click="$set('selectedBillType', null)"
                    class="text-blue-900 hover:text-blue-700 text-sm font-medium">
                    Change Bill Type
                </button>
            </div>

            <form wire:submit.prevent="processPayment" class="space-y-6">

                {{-- Service Provider --}}
                <div>
                    <label class="label">Service Provider</label>
                    <div class="bg-gray-50 border border-gray-200 rounded p-3">
                        <p class="text-sm text-gray-700">
                            {{ implode(' • ', $selectedBillType['providers']) }}
                        </p>
                    </div>
                </div>

                {{-- Customer Reference --}}
                <div>
                    <label for="customer_reference" class="label">{{ $selectedBillType['reference_label'] }}</label>
                    <input type="text" id="customer_reference" wire:model="customer_reference"
                        class="input-field @error('customer_reference') border-red-500 @enderror"
                        placeholder="Enter your {{ strtolower($selectedBillType['reference_label']) }}">
                    @error('customer_reference')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Amount --}}
                <div>
                    <label for="amount" class="label">Amount (₦)</label>
                    <input type="number" id="amount" wire:model="amount"
                        class="input-field @error('amount') border-red-500 @enderror" placeholder="0.00" step="0.01"
                        min="100">
                    @error('amount')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-sm text-gray-600 mt-1">
                        Available Balance: ₦{{ number_format(auth()->user()->account->balance, 2) }}
                    </p>
                </div>

                {{-- Error Message --}}
                @error('general')
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded">
                        {{ $message }}
                    </div>
                @enderror

                {{-- Submit Button --}}
                <div class="flex gap-3">
                    <button type="submit" class="flex-1 btn-primary" @if(!$customer_reference || !$amount) disabled @endif>
                        Pay ₦{{ $amount ? number_format($amount, 2) : '0.00' }}
                    </button>
                    <button type="button" wire:click="$set('selectedBillType', null)" class="btn-secondary">
                        Cancel
                    </button>
                </div>
            </form>
        </div>

        {{-- Info Notice --}}
        <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
            <p class="text-sm text-gray-700">
                <strong>Note:</strong> Your {{ strtolower($selectedBillType['name']) }} payment will be processed
                immediately.
                Please ensure all details are correct before confirming.
            </p>
        </div>
    @endif
</div>
