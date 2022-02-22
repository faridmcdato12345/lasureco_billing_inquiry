@extends('layouts.reapp')
@section('content')
<div class="min-h-screen flex flex-col sm:justify-center justify-center items-center pt-6 sm:pt-6">
    <div class="w-96 sm:max-w-md md:min-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg rounded-lg opacity-95">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <label for="email" class="block font-medium text-sm text-gray-700">{{ __('Email Address') }}</label>
                <input id="email" type="email" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mt-4">
                <label for="password" class="block font-medium text-sm text-gray-700">{{ __('Password') }}</label>
                <input id="password" type="password" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="block">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" style="color:blue" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>
            <div class="items-center justify-end mt-4">
                <button type="submit" class="items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 w-full">
                    {{ __('Login') }}
                </button>
                <span class="text-sm text-gray-600 hover:text-gray-900" style="float: right">Not registered?
                    <a class="underline text-sm text-indigo-400 hover:text-indigo-400" style="color:blue" href="{{ route('register')  }}">
                        {{ __('Signup') }}
                    </a>
                </span>
            </div>
            <div class="flex items-center justify-end mt-4">
                <hr>
                <button class="items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-gray-600 uppercase tracking-wides  ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                    OR
                </button>
                <hr>
            </div>
            <div class="flex items-center justify-end">
                <a href="{{route('facebook.redirect')}}" style="background:blue;text-align:center" class="items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 active:bg-blue-600 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 w-full">
                    {{ __('Facebook') }}
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
