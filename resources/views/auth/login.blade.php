@extends('layouts.app')

@section('content')
<div class=" w-full">
   <div class=" w-full h-full">
    
        <div class="max-w-md relative flex flex-col p-4 rounded-md text-black bg-white border m-auto my-5">
            <div class=" w-[150px] mx-auto">
                <img  src="/images/logo.svg" />
            </div>
            <div class="text-xl font-bold mb-2 text-blue-800 text-center"> cours de soir</div>
            <div class="text-md font-normal mb-4 text-center text-blue-950">Log in to your account</div>
            <form class="flex flex-col gap-3" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="block relative"> 
                    <label for="email" class="block text-gray-600 cursor-text text-sm leading-[140%] font-normal mb-2">Email</label>
                    <input id="email" type="email" class="rounded border border-gray-200 text-sm w-full font-normal leading-[18px] text-black tracking-[0px] 
                    appearance-none block h-11 m-0 p-[11px] focus:ring-2  @error('email') ring-offset-1 ring-1 ring-red-500 @enderror outline-0"
                     name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                      @error('email')
                            <p class=' text-red-500 animate-pulse'>email incorrect</p>
                    @enderror
                </div>
                <div class="block relative"> 
                    <label for="password" class="block text-gray-600 cursor-text text-sm leading-[140%] font-normal mb-2">Password</label>
                    <input id="password" type="password" class="rounded border border-gray-200 text-sm w-full font-normal leading-[18px] text-black tracking-[0px] 
                    appearance-none block h-11 m-0 p-[11px] focus:ring-2  @error('password') ring-offset-1 ring-1 ring-red-500 @enderror outline-0"
                    name="password" required autocomplete="current-password">
                    @error('password')
                        <p class=' text-red-500 animate-pulse'>mot de pass incorrect</p>
                    @enderror
                </div>
                 <div class="">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
                <div>
                     @if (Route::has('password.request'))
                        <a class="text-sm text-blue-700" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
                <button type="submit" class="bg-blue-700 w-max m-auto px-6 py-2 rounded text-white text-sm font-normal">s'authentifier</button>
    
            </form>
            <form method="GET" action="{{ route('register') }}">
                <div class="text-sm text-center mt-[1.6rem]">
                    vous n'avez pas de compte? 
                        <button class="text-sm text-blue-700">Creez votre compte!</button>
                </div>
            </form>
        </div>
</div>
</div>
@endsection
