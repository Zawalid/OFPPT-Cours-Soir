@extends('layouts.master')

@section('content')
 <div class="py-8 pr-4">
        <div class="flex items-center  h-[10vh] gap-6 mb-16">
            <h2 class="text-5xl">Demande #{{$demande->id}}</h2>
        </div>
        <div class='grid grid-cols-[auto,1fr] gap-10 bg-slate-300 rounded-md '>
            <div class='grid grid-cols-1 bg-slate-200 r rounded-e-2xl p-3'>
                <p class='text-2xl font-bold'>Informations</p>
                <p class='p-2'><span class='font-bold'>name </span>: {{$demande->name}}</p>
                <p class='p-2'><span class='font-bold'>email</span> : {{$demande->email}}</p>
                <p class='p-2'><span class='font-bold'>Telephone:</span> {{$demande->phoneNumber}}</p>
            </div>
            <div class='flex flex-col justify-between p-2'>
                <div>
                    <h1 class='text-3xl font-bold p-2'>{{$demande->subject}}</h1>
                    <p class='p-2'>{{$demande->details}}</p>
                </div>
                <div class='flex justify-end'>
                    <a class='bg-green-400 p-1 rounded-md text-white hover:scale-105' href='mailto:{{$demande->email}}'>envoyer mail</a>
                </div>
            </div>
        </div>
</div>
@endsection