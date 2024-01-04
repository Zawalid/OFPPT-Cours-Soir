@extends('layouts.ajouter_edit_master')

@section('content')
    
<x-edit content="evenement" toRoute="evenements" :item="$evenement">

    
    <div class="mb-4">
        <label for="etat">Etat</label>
        <select name="etat" id="etat" class="block bg-gray-200 py-2 px-1 w-full rounded mt-4" value="{{$evenement->etat}}">
            <option value="prochain">Prochain</option>    
        </select>
        @error('etat')
                <div class="text-red-600">{{$message}}</div>
                @enderror
    </div>
    <div class="mb-4">
        <label for="lieu">Lieu</label>
        <input name="lieu" type="text" id="lieu" class="block bg-gray-200 py-2 px-1 w-full rounded mt-4" value="{{$evenement->lieu}}">
        @error('lieu')
                <div class="text-red-600">{{$message}}</div>
                @enderror
    </div>

    <div class="mb-4">
        <label for="duree">Duree</label>
        <input name="duree" type="number" id="duree" class="block bg-gray-200 py-2 px-1 w-full rounded mt-4" value="{{$evenement->duree}}">
        @error('duree')
                <div class="text-red-600">{{$message}}</div>
                @enderror
    </div>

    <div class="mb-4">
        <label for="date_evenement">Date d'evenement</label>
        <input name="date_evenement" type="date" id="date_evenement" class="block bg-gray-200 py-2 px-1 w-full rounded mt-4" value="{{$evenement->date}}">
        @error('date_evenement')
            <div class="text-red-600">{{$message}}</div>
        @enderror
    </div>
     <div class="mb-4">
                <label for="annee_formation">Annee Formation</label>
                <select name="annee_formation" id="annee_formation" class="block bg-gray-200 py-2 px-1 w-full rounded mt-4">
                    <option value=''>annee de formation</option>
                    @foreach($anneeFormation as $af)
                        <option value= "{{$af->id}}" {{$evenement->annee_formation_id===$af->id?'selected':''}}> {{$af->nom}}</option>
                    @endforeach             
               </select>    
                @error('annee_formation')
                    <div class="text-red-600">{{$message}}</div>
                @enderror
        </div>

</x-edit>

@endsection