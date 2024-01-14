@extends('layouts.app')

@section('content')
<div class=" w-full">
   <div class=" w-full h-full">
        <div class="max-w-md relative flex flex-col p-4 rounded-md text-black bg-white border m-auto my-5">
                <p class="text-2xl font-bold mb-2 text-blue-950 text-center"> {{ __('Reset Password') }}</p>
                <a href="{{ route('login') }}" class='absolute top-0 left-0 px-2 text-gray-500'> <i class="fa-solid fa-arrow-left"></i></a>
                <div class="">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}" class='flex flex-col gap-3'>
                        @csrf
                        <div >
                            <label for="email" class="">{{ __('Email Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="rounded border border-gray-200 text-sm w-full font-normal leading-[18px] text-black tracking-[0px] 
                                    appearance-none block h-11 m-0 p-[11px] focus:ring-2  @error('email') ring-offset-1 ring-1 ring-red-500 @enderror outline-0" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                     <p class=' text-red-500 animate-pulse'>mot de pass incorrect</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row ">
                            <button type="submit" class="bg-blue-700 w-max m-auto px-6 py-2 rounded text-white text-sm font-normal hover:scale-105">
                                {{ __('Send Password Reset Link') }}
                            </button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>
@endsection
