@extends('layouts.master')

@section('content')
    
<x-show content="article" toRoute="articles" :item="$article" >
    <div>
        <div class="mb-4">
            <span class='font-bold'>auteur</span>
            <p for="titre">{{$article->Admin->name}}</p>       
        </div> 
        <div class="mb-4">
            <span class='font-bold'>categorie</span>
            <p for="titre">{{$article->Categories->name}}</p>       
        </div> 
    </div>
</x-show>

@endsection