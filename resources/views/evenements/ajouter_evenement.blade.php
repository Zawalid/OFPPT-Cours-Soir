@extends('layouts.ajouter_edit_master')

@section('content')
    <x-ajouter content="evenement" toRoute="evenements">
        
        <div>
            <<div class="w-full my-4">
                <span class="text-red-500"> @error('etat') {{$message}} @enderror</span>
                <label class="flex cursor-pointer items-center justify-between p-1">
                    a venir
                    <div class="relative inline-block">
                        <input value='1' type="checkbox" name='etat' class="peer h-6 w-12 cursor-pointer appearance-none rounded-full border border-red-500 bg-white checked:border-green-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-green-500 focus-visible:ring-offset-2">
                        <span class="pointer-events-none absolute left-1 top-1 block h-4 w-4 rounded-full bg-red-500 transition-all duration-200 peer-checked:left-7 peer-checked:bg-green-500"></span>
                    </div>
                </label>            
            </div>
            <div class="mb-4">
                <label for="lieu">Lieu</label>
                <input name="lieu" type="text" id="lieu" class="block bg-gray-200 py-2 px-1 w-full rounded mt-4">
                @error('lieu')
                        <div class="text-red-600">{{$message}}</div>
                        @enderror
            </div>
    
            <div class="mb-4">
                <label for="duree">Duree</label>
                <input name="duree" type="number" id="duree" class="block bg-gray-200 py-2 px-1 w-full rounded mt-4">
                @error('duree')
                        <div class="text-red-600">{{$message}}</div>
                        @enderror
            </div>
    
            <div class="mb-4">
                <label for="date_evenement">Date d'evenement</label>
                <input name="date_evenement" type="date" id="date_evenement" class="block bg-gray-200 py-2 px-1 w-full rounded mt-4">
                @error('date_evenement')
                        <div class="text-red-600">{{$message}}</div>
                        @enderror
            </div>
    
    
            <div class="mb-4">
                <label for="annee_formation">Annee Formation</label>
                <select name="annee_formation" id="annee_formation" class="block bg-gray-200 py-2 px-1 w-full rounded mt-4">
                    <option value=''>annee de formation</option>
                    @foreach($AnneeFormation as $af)
                        <option value= "{{$af->id}}" > {{$af->nom}}</option>
                    @endforeach             
               </select>    
                @error('annee_formation')
                    <div class="text-red-600">{{$message}}</div>
                @enderror
            </div>
            </div>    
        
    </x-ajouter>
@endsection