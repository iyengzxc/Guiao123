<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <link rel="stylesheet" href="{{ asset('style.css') }}">

    <div class="glassmorphism-container">
        <h2>{{ __('Register') }}</h2>
        <form method="POST" action="{{ route('register') }}" class="glassmorphism-form">
            @csrf

            <!-- Name -->
            <div class="input-field">
                <input type="text" required x-text-input id="name" class="block mt-1 w-full" name="name" :value="old('name')" required autofocus autocomplete="name">
                <label>{{ __('Name') }}</label>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Phone -->
            <div class="input-field mt-4">
                <input type="text" required x-text-input id="phone" class="block mt-1 w-full" name="phone" :value="old('phone')" required autofocus autocomplete="phone">
                <label>{{ __('Phone') }}</label>
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <!-- Address -->
            <div class="input-field mt-4">
                <input type="text" required x-text-input id="address" class="block mt-1 w-full" name="address" :value="old('address')" required autocomplete="address">
                <label>{{ __('Address') }}</label>
                <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="input-field mt-4">
                <input type="email" required x-text-input id="email" class="block mt-1 w-full" name="email" :value="old('email')" required autocomplete="username">
                <label>{{ __('Email') }}</label>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="input-field mt-4">
                <input type="password" required x-text-input id="password" class="block mt-1 w-full" name="password" required autocomplete="new-password">
                <label>{{ __('Password') }}</label>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="input-field mt-4">
                <input type="password" required x-text-input id="password_confirmation" class="block mt-1 w-full" name="password_confirmation" required autocomplete="new-password">
                <label>{{ __('Confirm Password') }}</label>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Register Button -->
            <button type="submit" class="button mt-4">{{ __('Register') }}</button>

            <!-- Already Registered Link -->
            <div class="register mt-4">
                <p>{{ __('Already registered?') }} <a href="{{ route('login') }}">{{ __('Log in') }}</a></p>
            </div>
        </form>
    </div>
</x-guest-layout>
