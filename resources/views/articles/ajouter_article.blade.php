@extends('layouts.ajouter_edit_master')

@section('content')
    <x-ajouter content="article" toRoute="articles" >
        
        <div>
            <div class="mb-4">
                <label for="auteur">Auteur</label>
                <select name="auteur" id="auteur" class="block bg-gray-200 py-2 px-1 w-full cursor-pointer rounded mt-4">
                    <option value="Amin D">Amin D.</option>    
                </select>
                @error('auteur')
                        <div class="text-red-600">{{$message}}</div>
                        @enderror
            </div>
            <div class="mb-4">
                <label for="categorie">Categorie</label>
                <select name="categorie" id="categorie" class="block bg-gray-200 py-2 px-1 w-full cursor-pointer rounded mt-4">
                    <option value='' >categorie</option>    
                    @foreach($Categorie as $categ)    
                        <option value= "{{$categ->id}}">{{$categ->nom}}</option>
                    @endforeach    
                </select>
                @error('categorie')
                        <div class="text-red-600">{{$message}}</div>
                        @enderror
            </div>
    
            <div class="mb-4">
                <label for="date_publication">Date de Publication</label>
                <input type='date' name="date_publication" id="date_publication" class="block bg-gray-200 py-2 px-1 w-full cursor-pointer rounded mt-4"/>
                @error('date_publication')
                        <div class="text-red-600">{{$message}}</div>
                @enderror
            </div>
    
            <div class="mb-4">
                <label for="annee_formation">Annee Formation</label>
                <select name="annee_formation" id="annee_formation" class="block bg-gray-200 cursor-pointer py-2 px-1 w-full rounded mt-4">  
                    <option value='' >annee de formation</option>
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