@extends('layouts.app')

@section('content')
<div class=" w-full">
   <div class=" w-full h-full">
        <div class="max-w-md relative flex flex-col p-4 rounded-md text-black bg-white border m-auto my-5">
            <a href="{{ route('login') }}" class='absolute top-0 left-0 px-2 text-gray-500'> <i class="fa-solid fa-arrow-left"></i></a>
            <div class="w-[96px] mx-auto mb-14">
                <img class="w-full" src="/images/logo.svg" />
            </div>
            <div class="text-2xl font-bold mb-2 text-blue-950 text-center">Creer votre compte <span class="text-blue-700">Ofppt</span></div>
            <div class="text-sm font-normal mb-4 text-center text-blue-950">coure de soir</div>
            <form class="flex flex-col gap-3" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="block relative"> 
                    <label for="name" class="block text-gray-600 cursor-text text-sm leading-[140%] font-normal mb-2">Nom </label>
                    <input id="name" type="text" class="rounded border border-gray-200 text-sm w-full font-normal leading-[18px] text-black tracking-[0px] 
                    appearance-none block h-11 m-0 p-[11px] focus:ring-2  @error('email') ring-offset-1 ring-1 ring-red-500 @enderror outline-0" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
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
                    appearance-none block h-11 m-0 p-[11px] focus:ring-2  @error('password') ring-offset-1 ring-1 ring-red-500 @enderror outline-0" name="password" required autocomplete="new-password">
                </div>
                <div class="block relative"> 
                    <label for="password-confirm" class="block text-gray-600 cursor-text text-sm leading-[140%] font-normal mb-2">Confirme Password</label>
                        <input id="password-confirm" type="password" class="rounded border border-gray-200 text-sm w-full font-normal leading-[18px] text-black tracking-[0px] 
                    appearance-none block h-11 m-0 p-[11px] focus:ring-2  @error('password') ring-offset-1 ring-1 ring-red-500 @enderror outline-0" name="password_confirmation" required autocomplete="new-password">

                    @error('password')
                        <p class=' text-red-500 animate-pulse'>error mot de pass</p>
                    @enderror
                </div>
                <button type="submit" class="bg-blue-700 w-max m-auto px-6 py-2 rounded text-white text-sm font-normal">Submit</button>

            </form>
            <form method="GET" action="{{ route('login') }}">
                <div class="text-sm text-center mt-[1.6rem]">
                    vous avez un compte deja? 
                        <button class="text-sm text-blue-700">connectez vous!</button>
                </div>
            </form>
        </div>
</div>
@endsection
