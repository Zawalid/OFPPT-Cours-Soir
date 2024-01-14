@extends('layouts.app')

@section('content')
<div class="grid grid-cols-[auto,1fr] gap-4">
    <x-navigation />
    <div class='P-2'>
    <h2 class="text-3xl my-10 m-2"> Paramètres<i class="fa-solid fa-gear m-2"></i> </h2>
    <div class='grid grid-cols-1 md:grid-cols-[1fr,1fr]'>
        <div class='flex w-full'>
            <form class='m-2 w-full' action="{{ route('ChangerAfSession') }}" method='POST'>
                <h3 class='text-xl my-3'>Session</h3>
                @csrf
                @method('POST')
                <p>changer l'annee de formation de  <strong>votre session</strong> </p>
                <select name="annee_formation_id" id="af" class=' bg-gray-200 py-2 px-1 w-full cursor-pointer rounded mt-4'>
                    @foreach($annesFormation as $af)
                    <option class="{{$af->id ===session('anneeFormationActive')->id?'bg-green-700 text-white font-bold':''}}" value="{{$af->id}}" {{$af->id ===session('anneeFormationActive')->id ?'selected':''}}>{{$af->nom}}</option>
                    @endforeach
                </select> 
                <button class=' bg-blue-700 p-1 w-full rounded-md my-2 text-white'> valider </button>
            </form>
        </div>
        <div class='flex'>
            <form class='m-2 w-full' action="{{ route('setActiveAF') }}" method='POST'>
                <h3 class='text-xl my-3'>Site</h3>
                @csrf
                @method('POST')
                <p>changer l'annee de formation de <strong>site</strong> </p>
                <select name="annee_formation_id" id="af" class=' bg-gray-200 py-2 px-1 w-full cursor-pointer rounded mt-4'>
                    @foreach($annesFormation as $af)
                    <option class="{{$af->active===1?'bg-blue-700 text-white font-bold':''}}" value="{{$af->id}}" {{$af->active===1?'selected':''}}>{{$af->nom}}</option>
                    @endforeach
                </select> 
                <button class=' bg-blue-700 p-1 w-full rounded-md my-2 text-white'> valider </button>
            </form>
        </div>
    </div>
</div>
</div>
@endsection