<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8" x-data="{
    step: 1,
    totalSteps: 4,
    get progress() {
        return (this.step / this.totalSteps) * 100;
    },
    nextStep() {
        if (this.step < this.totalSteps) this.step++;
    },
    prevStep() {
        if (this.step > 1) this.step--;
    }
}">
    <div class="max-w-2xl w-full space-y-8 animate-fade-in">
        {{-- Header --}}
        <div class="text-center">
            <div class="inline-block bg-gradient-to-r from-blue-900 to-blue-700 text-white px-8 py-3 rounded-2xl shadow-lg mb-4">
                <h1 class="text-4xl font-bold tracking-tight">14Finance</h1>
            </div>
            <p class="text-gray-600 text-lg font-medium mt-4">Create Your Banking Account</p>
            <p class="text-gray-500 text-sm mt-2">Join thousands of satisfied customers</p>
        </div>

        {{-- Progress Bar --}}
        <div class="bg-white rounded-2xl shadow-lg p-6 border-2 border-blue-100">
            <div class="flex items-center justify-between mb-4">
                <span class="text-sm font-bold text-gray-700">Step <span x-text="step"></span> of <span x-text="totalSteps"></span></span>
                <span class="text-sm font-bold text-blue-900" x-text="Math.round(progress) + '%'"></span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-900 to-blue-600 h-3 rounded-full transition-all duration-500 ease-out shadow-lg"
                    :style="'width: ' + progress + '%'"></div>
            </div>

            {{-- Step Indicators --}}
            <div class="flex justify-between mt-6">
                <div class="flex flex-col items-center flex-1" :class="step >= 1 ? 'opacity-100' : 'opacity-40'">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center mb-2 transition-all"
                        :class="step >= 1 ? 'bg-gradient-to-r from-blue-900 to-blue-700 text-white shadow-lg scale-110' : 'bg-gray-200 text-gray-500'">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-center">Personal Info</span>
                </div>
                <div class="flex flex-col items-center flex-1" :class="step >= 2 ? 'opacity-100' : 'opacity-40'">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center mb-2 transition-all"
                        :class="step >= 2 ? 'bg-gradient-to-r from-blue-900 to-blue-700 text-white shadow-lg scale-110' : 'bg-gray-200 text-gray-500'">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-center">Contact</span>
                </div>
                <div class="flex flex-col items-center flex-1" :class="step >= 3 ? 'opacity-100' : 'opacity-40'">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center mb-2 transition-all"
                        :class="step >= 3 ? 'bg-gradient-to-r from-blue-900 to-blue-700 text-white shadow-lg scale-110' : 'bg-gray-200 text-gray-500'">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-center">Account Type</span>
                </div>
                <div class="flex flex-col items-center flex-1" :class="step >= 4 ? 'opacity-100' : 'opacity-40'">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center mb-2 transition-all"
                        :class="step >= 4 ? 'bg-gradient-to-r from-blue-900 to-blue-700 text-white shadow-lg scale-110' : 'bg-gray-200 text-gray-500'">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-center">Security</span>
                </div>
            </div>
        </div>

        {{-- Registration Form --}}
        <div class="card animate-slide-up">
            <form wire:submit.prevent="register" class="space-y-6">

                {{-- Step 1: Personal Information --}}
                <div x-show="step === 1" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform translate-x-8"
                    x-transition:enter-end="opacity-100 transform translate-x-0">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2 flex items-center gap-3">
                        <svg class="w-8 h-8 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Personal Information
                    </h2>
                    <p class="text-gray-600 mb-6">Let's start with your basic details</p>

                    <div class="space-y-5">
                        {{-- Full Name --}}
                        <div>
                            <label for="name" class="label">Full Name</label>
                            <input type="text" id="name" wire:model="name"
                                class="input-field @error('name') border-red-500 @enderror"
                                placeholder="John Doe" autofocus>
                            @error('name')
                                <p class="text-red-600 text-sm mt-1 font-medium flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-end mt-8">
                        <button type="button" @click="nextStep()" class="btn-primary px-8">
                            Next Step
                            <svg class="w-5 h-5 ml-2 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Step 2: Contact Information --}}
                <div x-show="step === 2" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform translate-x-8"
                    x-transition:enter-end="opacity-100 transform translate-x-0">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2 flex items-center gap-3">
                        <svg class="w-8 h-8 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Contact Information
                    </h2>
                    <p class="text-gray-600 mb-6">How can we reach you?</p>

                    <div class="space-y-5">
                        {{-- Email --}}
                        <div>
                            <label for="email" class="label">Email Address</label>
                            <input type="email" id="email" wire:model="email"
                                class="input-field @error('email') border-red-500 @enderror"
                                placeholder="john@example.com">
                            @error('email')
                                <p class="text-red-600 text-sm mt-1 font-medium flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Phone --}}
                        <div>
                            <label for="phone" class="label">Phone Number</label>
                            <input type="text" id="phone" wire:model="phone"
                                class="input-field @error('phone') border-red-500 @enderror"
                                placeholder="+234 801 234 5678">
                            @error('phone')
                                <p class="text-red-600 text-sm mt-1 font-medium flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Address --}}
                        <div>
                            <label for="address" class="label">Residential Address</label>
                            <textarea id="address" wire:model="address"
                                class="input-field @error('address') border-red-500 @enderror"
                                placeholder="123 Main Street, City, State" rows="3"></textarea>
                            @error('address')
                                <p class="text-red-600 text-sm mt-1 font-medium flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-between mt-8">
                        <button type="button" @click="prevStep()" class="btn-secondary px-8">
                            <svg class="w-5 h-5 mr-2 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"/>
                            </svg>
                            Previous
                        </button>
                        <button type="button" @click="nextStep()" class="btn-primary px-8">
                            Next Step
                            <svg class="w-5 h-5 ml-2 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Step 3: Account Type --}}
                <div x-show="step === 3" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform translate-x-8"
                    x-transition:enter-end="opacity-100 transform translate-x-0">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2 flex items-center gap-3">
                        <svg class="w-8 h-8 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        Choose Account Type
                    </h2>
                    <p class="text-gray-600 mb-6">Select the account that fits your needs</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        {{-- Savings Account --}}
                        <label class="relative cursor-pointer">
                            <input type="radio" wire:model="account_type" value="savings" class="peer sr-only" checked>
                            <div class="border-2 rounded-2xl p-6 transition-all peer-checked:border-blue-900 peer-checked:bg-gradient-to-br peer-checked:from-blue-50 peer-checked:to-indigo-50 peer-checked:shadow-lg hover:shadow-md">
                                <div class="flex items-start gap-4">
                                    <div class="bg-blue-100 p-3 rounded-xl peer-checked:bg-blue-200">
                                        <svg class="w-8 h-8 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="text-lg font-bold text-gray-900 mb-1">Savings Account</h3>
                                        <p class="text-sm text-gray-600">Perfect for personal savings with competitive interest rates</p>
                                        <ul class="mt-3 space-y-1 text-xs text-gray-600">
                                            <li class="flex items-center gap-2">
                                                <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                </svg>
                                                Interest earning
                                            </li>
                                            <li class="flex items-center gap-2">
                                                <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                </svg>
                                                Low minimum balance
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="absolute top-4 right-4 w-6 h-6 rounded-full border-2 peer-checked:border-blue-900 peer-checked:bg-blue-900 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white hidden peer-checked:block" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </div>
                        </label>

                        {{-- Current Account --}}
                        <label class="relative cursor-pointer">
                            <input type="radio" wire:model="account_type" value="current" class="peer sr-only">
                            <div class="border-2 rounded-2xl p-6 transition-all peer-checked:border-blue-900 peer-checked:bg-gradient-to-br peer-checked:from-blue-50 peer-checked:to-indigo-50 peer-checked:shadow-lg hover:shadow-md">
                                <div class="flex items-start gap-4">
                                    <div class="bg-purple-100 p-3 rounded-xl peer-checked:bg-purple-200">
                                        <svg class="w-8 h-8 text-purple-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="text-lg font-bold text-gray-900 mb-1">Current Account</h3>
                                        <p class="text-sm text-gray-600">Ideal for businesses with unlimited transactions</p>
                                        <ul class="mt-3 space-y-1 text-xs text-gray-600">
                                            <li class="flex items-center gap-2">
                                                <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                </svg>
                                                Unlimited transactions
                                            </li>
                                            <li class="flex items-center gap-2">
                                                <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                </svg>
                                                Overdraft facility
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="absolute top-4 right-4 w-6 h-6 rounded-full border-2 peer-checked:border-blue-900 peer-checked:bg-blue-900 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white hidden peer-checked:block" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </div>
                        </label>
                    </div>

                    @error('account_type')
                        <p class="text-red-600 text-sm mt-1 font-medium flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror

                    <div class="flex justify-between mt-8">
                        <button type="button" @click="prevStep()" class="btn-secondary px-8">
                            <svg class="w-5 h-5 mr-2 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"/>
                            </svg>
                            Previous
                        </button>
                        <button type="button" @click="nextStep()" class="btn-primary px-8">
                            Next Step
                            <svg class="w-5 h-5 ml-2 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Step 4: Security --}}
                <div x-show="step === 4" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform translate-x-8"
                    x-transition:enter-end="opacity-100 transform translate-x-0">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2 flex items-center gap-3">
                        <svg class="w-8 h-8 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        Secure Your Account
                    </h2>
                    <p class="text-gray-600 mb-6">Create a strong password to protect your account</p>

                    <div class="space-y-5">
                        {{-- Password --}}
                        <div>
                            <label for="password" class="label">Password</label>
                            <input type="password" id="password" wire:model="password"
                                class="input-field @error('password') border-red-500 @enderror"
                                placeholder="Minimum 6 characters">
                            @error('password')
                                <p class="text-red-600 text-sm mt-1 font-medium flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Confirm Password --}}
                        <div>
                            <label for="password_confirmation" class="label">Confirm Password</label>
                            <input type="password" id="password_confirmation" wire:model="password_confirmation"
                                class="input-field @error('password_confirmation') border-red-500 @enderror"
                                placeholder="Re-enter your password">
                            @error('password_confirmation')
                                <p class="text-red-600 text-sm mt-1 font-medium flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Security Tips --}}
                        <div class="bg-blue-50 border-2 border-blue-200 rounded-xl p-4">
                            <h4 class="font-bold text-blue-900 mb-2 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Password Tips
                            </h4>
                            <ul class="text-sm text-blue-800 space-y-1">
                                <li class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    Use at least 6 characters
                                </li>
                                <li class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    Mix letters, numbers and symbols
                                </li>
                                <li class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    Avoid common words or patterns
                                </li>
                            </ul>
                        </div>
                    </div>

                    {{-- Error Message --}}
                    @error('general')
                        <div class="bg-red-50 border-2 border-red-200 text-red-700 px-4 py-3 rounded-lg font-medium flex items-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="flex justify-between mt-8">
                        <button type="button" @click="prevStep()" class="btn-secondary px-8">
                            <svg class="w-5 h-5 mr-2 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"/>
                            </svg>
                            Previous
                        </button>
                        <button type="submit" class="btn-primary px-8">
                            <svg class="w-5 h-5 mr-2 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Create My Account
                        </button>
                    </div>
                </div>

            </form>

            {{-- Login Link --}}
            <div class="mt-6 pt-6 border-t border-gray-200 text-center">
                <p class="text-gray-600">
                    Already have an account?
                    <a href="{{ route('login') }}" wire:navigate
                        class="text-blue-900 font-semibold hover:text-blue-700 transition-colors">
                        Sign In
                    </a>
                </p>
            </div>
        </div>

        {{-- Footer --}}
        <p class="text-center text-sm text-gray-500">
            © 2026 14Finance | Secure Banking Platform | Group 14
        </p>
    </div>
</div>
