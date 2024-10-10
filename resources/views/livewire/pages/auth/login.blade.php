<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use function Livewire\Volt\form;
use function Livewire\Volt\layout;

layout('layouts.guest');

form(LoginForm::class);

$login = function () {
    $this->validate();

    // Delay the execution for 10 seconds (simulating a real delay)
    sleep(10);

    $this->form->authenticate();

    Session::regenerate();

    $userRole = Auth::user()->role;

    switch ($userRole) {
        case 1:
            $this->redirectIntended(default: route('superadmin', absolute: false), navigate: true);
            break;
        case 2:
            $this->redirectIntended(default: route('admin', absolute: false), navigate: true);
            break;
        case 3:
            $this->redirectIntended(default: route('normal', absolute: false), navigate: true);
            break;
        case 4:
            $this->redirectIntended(default: route('customer', absolute: false), navigate: true);
            break;
        default:
            return redirect('/');
    }
};
?>

<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit.prevent="login">
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="form.email" id="email" class="block mt-1 w-full" type="email" name="email" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm  text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}" wire:navigate>
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <div class="flex items-center justify-end mt-4">
            <!-- Login Button -->
            <x-primary-button class="ms-3" wire:loading.attr="disabled">
                <span wire:loading.remove>{{ __('Log in') }}</span>
                <span wire:loading>{{ __('Logging in...') }}</span>
            </x-primary-button>

            <!-- Spinner -->
            <div wire:loading class="ml-3">
                <svg class="animate-spin h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.372 0 0 5.372 0 12h4z"></path>
                </svg>
            </div>
        </div>

        <!-- Register Button -->
        <div class="flex items-center justify-center mt-4">
            <a href="{{ route('register') }}" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                {{ __('Don\'t have an account? Register') }}
            </a>
        </div>
    </form>
</div>
