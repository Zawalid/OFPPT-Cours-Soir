@extends('layouts.ajouter_edit_master')

@section('content')
    
<x-edit content="article" toRoute="articles" :item="$article">

    
        <div class="mb-4">
            <label for="auteur">Auteur</label>
            <select name="auteur" id="auteur" class="block bg-gray-200 py-2 px-1 w-full rounded mt-4" value="{{$article->auteur}}">
                <option value="Amin D">Amin D.</option>    
            </select>
            @error('auteur')
                    <div class="text-red-600">{{$message}}</div>
                    @enderror
        </div>
        <div class="mb-4">
            <label for="categorie">Categorie</label>
            <select name="categorie" id="categorie" class="block bg-gray-200 py-2 px-1 w-full rounded mt-4" value="{{$article->categorie}}">
                <option value="1">Education</option>    
            </select>
            @error('categorie')
                    <div class="text-red-600">{{$message}}</div>
                    @enderror
        </div>

        <div class="mb-4">
            <label for="date_publication">Date de Publication</label>
            <select name="date_publication" id="date_publication" class="block bg-gray-200 py-2 px-1 w-full rounded mt-4" value="{{$article->date}}">
                <option value="2023-12-28">2023-12-28</option>    
            </select>
            @error('date_publication')
                    <div class="text-red-600">{{$message}}</div>
                    @enderror
          
        </div>  

</x-edit>

@endsection