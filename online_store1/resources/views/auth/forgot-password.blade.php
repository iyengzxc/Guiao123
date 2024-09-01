<x-guest-layout>
    <link rel="stylesheet" href="{{ asset('style.css') }}">

    <div class="glassmorphism-container">
        <div class="mb-4 text-sm text-red-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" class="glassmorphism-form">
            @csrf

            <!-- Email Address -->
            <div class="input-field">
                <input type="email" required x-text-input id="email" class="block mt-1 w-full" name="email" :value="old('email')" required autofocus>
                <label>{{ __('Email') }}</label>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Submit Button -->
            <button type="submit" class="button mt-4">
                {{ __('Email Password Reset Link') }}
            </button>
        </form>
    </div>
</x-guest-layout>
