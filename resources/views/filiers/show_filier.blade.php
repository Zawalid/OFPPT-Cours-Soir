@extends('layouts.master')

@section('content')
    
<x-show content="filier" toRoute="filiers" :item="$filier">
   <div class="mb-4">
            <span class='font-bold'>max stagiaire</span>
            <p for="titre">{{$filier->max_stagiaires}}</p>       
        </div> 
        <div class="mb-4">
            <span class='font-bold'>Etat</span>
            @if($filier->active===1)
                <p for="titre">active</p>
                @else       
                <p for="titre">Not active</p>
            @endif
        </div> 
        <div class="mb-4">
            <span class='font-bold'>Secteur</span>
            <p for="titre">{{$secteur->name}}</p>       
        </div> 
</x-show>

@endsection