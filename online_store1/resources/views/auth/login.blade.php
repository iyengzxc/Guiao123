<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <link rel="stylesheet" href="{{ asset('style.css') }}">

    <div class="glassmorphism-container">
        <form method="POST" action="{{ route('login') }}" class="glassmorphism-form">
            @csrf

            <!-- Email Address -->
            <div class="input-field">
                <input type="text" required x-text-input id="email" class="block mt-1 w-full"  name="email" :value="old('email')" required autofocus autocomplete="username">
                <label>Enter your email</label>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="input-field mt-4">
            <input type="password" required x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password">
                <label>Enter your password</label> 
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me and Forgot Password -->
            <div class="options mt-4">
                <div class="remember">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>
                <div class="forgot">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-red-600 hover:underline">{{ __('Forgot your password?') }}</a>
                    @endif
                </div>
            </div>

            <!-- Login Button -->
            <button type="submit" class="button mt-4">Log In</button>

            <!-- Register Link -->
            <div class="register mt-4">
                <p>Don't have an account? <a href="{{ route('register') }}">Register</a></p>
            </div>
        </form>
    </div>
</x-guest-layout>
