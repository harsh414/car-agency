@extends('layouts.app')
@section('content')
    <x-guest-layout>
        <x-auth-card>
            <x-slot name="logo">
                <a href="/" class="text-lg tracking-wider bg-gray-300 hover:text-black font-semibold px-3 py-2 border rounded-full">
                    Login as Customer
                </a>
            </x-slot>
            <div class="text-center px-6 py-2" x-data="{flashMessage:true}">
                @if(session()->has('error'))
                    <div class="bg-blue-600 text-center py-4 lg:px-4 mb-4" x-show="flashMessage">
                        <div class="p-2 bg-blue-600 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                            <span class="font-semibold mr-2 text-left text-white font-semibold text-sm flex-auto">{{session()->get('error')}}</span>
                            <svg @click="flashMessage=false" xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('login.customer.store') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-label for="email" :value="__('Email')" />

                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-label for="password" :value="__('Password')" />

                    <x-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <x-button class="ml-3">
                        {{ __('Log in') }}
                    </x-button>
                </div>
            </form>
        </x-auth-card>
    </x-guest-layout>
@endsection
