@extends('layouts.master')

@section('content')
    
<x-show content="evenement" toRoute="evenements" :item="$evenement">
         <div class="mb-4">
            <span class='font-bold'>Lieu</span>
            <p for="titre">{{$evenement->lieu}}</p>       
        </div> 
        <div class="mb-4">
            <span class='font-bold'>duree</span>
            <p for="titre">{{$evenement->duree}}</p>       
        </div> 

</x-show>

@endsection