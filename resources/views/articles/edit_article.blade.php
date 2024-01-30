@extends('layouts.ajouter_edit_master')

@section('content')
    
<x-edit content="article" toRoute="articles" :item="$article" >

    
        <div class="mb-4">
            <label for="user">Auteur</label>
            <select name="user" id="user" class="block bg-gray-200 py-2 px-1 w-full rounded mt-4">
                <option value=''>Auteur</option> 
                @foreach($admins as $admin)
                    <option value="{{$admin->id}}" {{$admin->id===Session::get('user')->id?'selected':''}}>{{$admin->name}}</option> 
                @endforeach
            </select>
            @error('user')
                    <div class="text-red-600">{{$message}}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="categorie">Categorie</label>
            <select name="categorie" id="categorie" class="block bg-gray-200 py-2 px-1 w-full rounded mt-4" value="{{$article->categorie}}">
                <option value=''>categorie</option>    
                    @foreach($Categorie as $categ)    
                        <option value= "{{$categ->id}}"  {{$article->categorie_id===$categ->id?'selected':''}}>{{$categ->nom}}</option>
                    @endforeach    
            </select>
            @error('categorie')
                <div class="text-red-600">{{$message}}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="date_publication">Date de Publication</label>
            <input type='date' name="date_publication" id="date_publication" class="block bg-gray-200 py-2 px-1 w-full rounded mt-4" value="{{$article->date}}"/>
            @error('date_publication')
                <div class="text-red-600">{{$message}}</div>
            @enderror
          
        </div>  
            <div class="mb-4">
                <label for="annee_formation">Annee Formation</label>
                <select name="annee_formation" id="annee_formation" class="block bg-gray-200 py-2 px-1 w-full rounded mt-4" >
                    <option value='' >annee de formation</option>
                    @foreach($anneeFormation as $af)
                        <option value="{{$af->id}}" {{$article->annee_formation_id===$af->id?'selected':''}}> {{$af->nom}}</option>
                    @endforeach    
                </select>    
                @error('annee_formation')
                    <div class="text-red-600">{{$message}}</div>
                @enderror
        </div>
</x-edit>

@endsection