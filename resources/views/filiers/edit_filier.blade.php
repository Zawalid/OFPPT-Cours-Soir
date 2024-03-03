@extends('layouts.ajouter_edit_master')

@section('content')
    
<x-edit content="filier" toRoute="filiers" :item="$filier">

    
     <div class="w-full my-4">
                <span class="text-red-500"> @error('Active') {{$message}} @enderror</span>
                <label class="flex cursor-pointer items-center justify-between p-1">
                    Active
                    <div class="relative inline-block">
                        <input value='1' type="checkbox" name='active' 
                        class="peer h-6 w-12 cursor-pointer appearance-none rounded-full border border-red-500 bg-white checked:border-green-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-green-500 focus-visible:ring-offset-2"
                        {{$filier->active?"checked":""}} 
                        >
                        <span class="pointer-events-none absolute left-1 top-1 block h-4 w-4 rounded-full bg-red-500 transition-all duration-200 peer-checked:left-7 peer-checked:bg-green-500"></span>
                    </div>
                </label>            
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