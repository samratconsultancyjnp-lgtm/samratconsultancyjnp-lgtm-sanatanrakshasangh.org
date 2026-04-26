<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Namaste! A 6-digit verification code (OTP) has been sent to your email address. Please enter it below to complete your login.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('verify-otp') }}">
        @csrf

        <!-- OTP -->
        <div>
            <x-input-label for="otp" :value="__('Verification Code (OTP)')" />
            <x-text-input id="otp" class="block mt-1 w-full" type="text" name="otp" required autofocus placeholder="123456" />
            <x-input-error :messages="$errors->get('otp')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Verify & Login') }}
            </x-primary-button>
        </div>
    </form>
    
    <div class="mt-4 text-center">
        <p class="text-sm text-gray-600">
            Didn't receive the code? 
            <a href="{{ route('login') }}" class="underline text-sm text-gray-600 hover:text-gray-900">
                Try logging in again
            </a>
        </p>
    </div>
</x-guest-layout>
