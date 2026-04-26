<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-gray-800">Reset Password</h2>
        <p class="text-sm text-gray-500 mt-2">
            {{ __('No problem. Enter your email and we will send you a secure link to reset your password.') }}
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" class="font-semibold text-gray-700" />
            <x-text-input id="email" class="block mt-1 w-full border-gray-200 focus:border-[#ff9933] focus:ring-[#ff9933] rounded-xl" type="email" name="email" :value="old('email')" required autofocus placeholder="name@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-8">
            <x-primary-button class="w-full justify-center py-3 bg-[#ff9933] hover:bg-[#e68a00] active:bg-[#cc7a00] rounded-xl text-lg font-bold shadow-lg shadow-[#ff9933]/30 transition-all">
                {{ __('Send Reset Link') }}
            </x-primary-button>
        </div>

        <div class="mt-6 text-center">
            <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-gray-900 font-semibold">
                <i class="fas fa-arrow-left mr-2"></i> Back to Login
            </a>
        </div>
    </form>
</x-guest-layout>
