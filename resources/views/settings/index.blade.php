@extends('layouts.master')

@section('content')
    
<div>
    <h2 class="text-3xl my-10 m-2"> Settings<i class="fa-solid fa-gear m-2"></i> </h2>
    <div class='flex gap-2'>
        <form action="{{ route('setActiveAnneeFormation') }}" method='POST'>
            @csrf
            @method('POST')
            <p>changer l'annee de formation active</p>
            <select name="annee_formation_id" id="af" class=' bg-gray-200 py-2 px-1 w-full cursor-pointer rounded mt-4'>
                @foreach($annesFormation as $af)
                <option value="{{$af->id}}" {{$af->active===1?'selected':''}}>{{$af->nom}}</option>
                @endforeach
            </select> 
                <button class=' bg-blue-700 p-1 w-full rounded-md my-2 text-white'> valider </button>
        </form>
</div>
</div>

@endsection