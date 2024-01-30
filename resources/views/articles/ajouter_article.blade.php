@extends('layouts.ajouter_edit_master')

@section('content')
    <x-ajouter content="article" toRoute="articles" >
        
        <div>
            <div class="mb-4">
                <label for="categorie">Categorie</label>
                <select name="categorie" value="{{old('categorie')}}"  id="categorie" class="block bg-gray-200 py-2 px-1 w-full cursor-pointer rounded mt-4">
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
                <input type='date' name="date_publication" value="{{old('date_publication')}}" id="date_publication" class="block bg-gray-200 py-2 px-1 w-full cursor-pointer rounded mt-4"/>
                @error('date_publication')
                        <div class="text-red-600">{{$message}}</div>
                @enderror
            </div>
    
          
            </div>  
        
    </x-ajouter>
@endsection