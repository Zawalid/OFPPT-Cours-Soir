@extends('layouts.master')

@section('content')
    
<x-navigation />

<x-main heading="Evenements" content="Evenement" :publiee="$publieeEvenements" :trashed="$trashedEvenements" toRoute="evenements" :allPubliee="$allPubliee" :allTrashed='$allTrashed' :categorie="$categorie" :anneeFormation="$anneeFormation">

<x-slot name='thead'>
    <thead class="text-center border-b-2 border-solid border-gray-300">
        <tr>
            <th class="py-2">#</th>
            <th class="py-2">Title</th>
            <th class="py-2">Duree</th>
            <th class="py-2">Etat</th>
            <th class="py-2">Date de Publication</th>
            <th class="py-2">annee de formation</th>
            <th class="py-2">Piece jointes</th>
            <th class="py-2">Action</th>
        </tr>
    </thead>
</x-slot>

<x-slot name='tbody'>

<tbody class="text-center">
    @isset($publieeEvenements)
        
    @foreach ($publieeEvenements as $event)
    <tr>
        <td class="py-2">{{$event->id}}</td>
        <td class="py-2">{{$event->titre}}</td>
        <td class="py-2">{{$event->duree}}</td>
        @if($event->etat === 1)
        <td class="py-2">upcoming</td>
        @else
        <td class="py-2 "> <span class='bg-blue-800 text-white p-1 rounded-md'>alraedy passed </span></td>
        @endif
        <td class="py-2">{{$event->date}}</td>
        <td class="py-2">{{$event->AnneeFormations->nom}}</td>
        <td class="py-2">{{count($event->pieceJointes)}}</td>

        <td class="py-2 flex items-center justify-center">
            <a href="{{ route('evenements.show', $event->id)}}" class="mr-2">
                <i class="fa-solid fa-eye"></i>
            </a>
            <a href="{{ route('evenements.edit', $event->id)}}" class="mr-2">
                <i class="fa-solid fa-pen-to-square"></i>
            </a>
            <form action="{{ route('evenements.destroy', $event->id) }}" method="POST" class="mb-0">
                @csrf
                @method('DELETE')
            </form>
            <div class="mb-0" id={{$event->id}}>
                <button class="delete">
                    <i class="fa-solid fa-trash"></i>    
                </button>
            </div> 
        </td>
    </tr>    
    @endforeach
    @endisset
</tbody>
</x-slot>
</x-main>

@endsection