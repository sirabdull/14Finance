<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 animate-fade-in">
        {{-- Header --}}
        <div class="text-center">
            <div
                class="inline-block bg-gradient-to-r from-blue-900 to-blue-700 text-white px-8 py-3 rounded-2xl shadow-lg mb-4">
                <h1 class="text-4xl font-bold tracking-tight">14Finance</h1>
            </div>
            <p class="text-gray-600 text-lg font-medium mt-4">Secure Banking Platform</p>
            <p class="text-gray-500 text-sm mt-2">Welcome back! Please login to continue</p>
        </div>

        {{-- Login Form --}}
        <div class="card animate-slide-up">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">Sign In</h2>

            <form wire:submit.prevent="login" class="space-y-5">
                {{-- Account Number / Email --}}
                <div>
                    <label for="account_identifier" class="label">Account Number or Email</label>
                    <input type="text" id="account_identifier" wire:model="account_identifier"
                        class="input-field @error('account_identifier') border-red-500 @enderror"
                        placeholder="Enter your account number or email" required>
                    @error('account_identifier')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="label">Password</label>
                    <input type="password" id="password" wire:model="password"
                        class="input-field @error('password') border-red-500 @enderror"
                        placeholder="Enter your password" required>
                    @error('password')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Remember Me --}}
                <div class="flex items-center">
                    <input type="checkbox" id="remember" wire:model="remember"
                        class="h-4 w-4 text-blue-900 focus:ring-blue-900 border-gray-300 rounded">
                    <label for="remember" class="ml-2 block text-sm text-gray-700">
                        Remember me
                    </label>
                </div>

                {{-- Submit Button --}}
                <button type="submit" class="w-full btn-primary mt-6">
                    Sign In
                </button>
            </form>

            {{-- Register Link --}}
            <div class="mt-6 text-center">
                <p class="text-gray-600">
                    Don't have an account?
                    <a href="{{ route('register') }}" wire:navigate
                        class="text-blue-900 font-semibold hover:text-blue-700 transition-colors">
                        Create Account
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
