@extends('partials.layout')
@section('content')
    <!-- Session Status -->
    @if (session('status'))
        <div role="alert" class="alert alert-success mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <span>{{ session('status') }}</span>
        </div>
    @endif
    <div class="card bg-base-200 w-full max-w-md mx-auto">
        <div class="card-body">
            <h2 class="card-title text-2xl">{{ __('Log in') }}</h2>
            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <!-- Email Address -->
                <fieldset class="fieldset">
                    <legend class="fieldset-legend">@lang('Email')</legend>
                    <input value="{{ old('email') }}" name="email" type="email" required
                        class="input input-bordered w-full @error('email') input-error @enderror" autofocus autocomplete="username" />
                    @error('email')
                        <p class="text-error text-sm mt-1">{{ $message }}</p>
                    @enderror
                </fieldset>

                <!-- Password -->
                <fieldset class="fieldset">
                    <legend class="fieldset-legend">@lang('Password')</legend>
                    <input name="password" type="password" required
                        class="input input-bordered w-full @error('password') input-error @enderror" autocomplete="current-password" />
                    @error('password')
                        <p class="text-error text-sm mt-1">{{ $message }}</p>
                    @enderror
                </fieldset>

                <!-- Remember Me -->
                <fieldset class="fieldset">
                    <label class="label cursor-pointer gap-2">
                        <input type="checkbox" class="checkbox" name="remember" />
                        <span class="label-text">{{ __('Remember me') }}</span>
                    </label>
                </fieldset>

                <div class="flex items-center justify-between mt-6">
                    @if (Route::has('password.request'))
                        <a class="btn btn-link btn-sm" href="{{ route('password.request') }}">
                            {{ __('Forgot password?') }}
                        </a>
                    @endif

                    <div class="flex gap-2">
                        @if (Route::has('register'))
                            <a class="btn btn-ghost btn-sm" href="{{ route('register') }}">
                                {{ __('Register') }}
                            </a>
                        @endif
                        <button class="btn btn-primary">
                            {{ __('Log in') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection