@extends('layouts.master')

@section('content')
    

<x-main heading="Evenements" content="Evenement" :publiee="$publieeEvenements" :trashed="$trashedEvenements" toRoute="evenements" :allPubliee="$allPubliee" :allTrashed='$allTrashed' :categorie="$categorie" :anneeFormation="$anneeFormation">

<x-slot name='thead'>
    <thead class="text-center border-b-2 border-solid border-gray-300">
        <tr>
            <th class="py-2">#</th>
            <th class="py-2">Title</th>
            <th class="py-2">Duree</th>
            <th class="py-2">Date P</th>
            <th class="py-2">annee F</th>
            <th class="py-2">Piece J</th>
            <th class="py-2">Visibilite</th>
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
        <td class="py-2">{{$event->date}}</td>
        <td class="py-2">{{$event->AnneeFormations->nom}}</td>
        <td class="py-2">{{count($event->pieceJointes)}}</td>
        <td class="py-2 ">
           <form action="{{ route('evenements.cacher', $event->id) }}" method="POST" class="mb-0">
                @csrf
                @method('POST')       
                @if($event->visibility==='1')
                    <button class=" bg-green-700 rounded-lg px-1 text-white font-bold ">
                            <i class="fa-solid text-xl fa-check "></i>  
                            <span>cacher </span>
                    </button>
                @else
                    <button class="bg-red-600 rounded-lg p-1 text-white font-bold ">
                            <i class="fa-solid fa-x "></i>  
                            <span>afficher </span>
                    </button>
                @endif
            </form>
        </td>
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