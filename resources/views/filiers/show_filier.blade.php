@extends('layouts.master')

@section('content')
    
<x-show content="filier" toRoute="filiers" :item="$filier">
   <div class="mb-4">
            <span class='font-bold'>max stagiaire</span>
            <p for="titre">{{$filier->max_stagiaires}}</p>       
        </div> 
        <div class="mb-4">
            <span class='font-bold'>active</span>
            <p for="titre">{{$filier->active}}</p>       
        </div> 
</x-show>

@endsection