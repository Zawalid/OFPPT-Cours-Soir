@extends('layouts.ajouter_edit_master')

@section('content')
    
<x-edit content="filier" toRoute="filiers" :item="$filier">

    
    <div class="mb-4">
        <label for="active">Active</label>
        <select name="active" id="active" class="block bg-gray-200 py-2 px-1 w-full rounded mt-4" value="{{$filier->active}}">
            <option value="1">True</option>    
        </select>
        @error('active')
                <div class="text-red-600">{{$message}}</div>
                @enderror
    </div>
        
    <div class="mb-4">
        <label for="max_stagiaires">Max Stagiaires</label>
        <input name="max_stagiaires" type="number" id="max_stagiaires" class="block bg-gray-200 py-2 px-1 w-full rounded mt-4" value="{{$filier->max_stagiaires}}">
        @error('max_stagiaires')
                <div class="text-red-600">{{$message}}</div>
                @enderror
    </div>


    <div class="mb-4">
        <label for="annee_formation">Annee Formation</label>
        <select name="annee_formation" id="annee_formation" class="block bg-gray-200 py-2 px-1 w-full rounded mt-4" value="{{$filier->annee_formation}}">
           <option value=''>annee de formation</option>
                    @foreach($anneeFormation as $af)
                        <option value= "{{$af->id}}" {{$filier->annee_formation_id===$af->id?'selected':''}}> {{$af->nom}}</option>
                    @endforeach  
        </select>    
        @error('annee_formation')
                <div class="text-red-600">{{$message}}</div>
                @enderror
    </div>

</x-edit>

@endsection