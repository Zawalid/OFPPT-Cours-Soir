@extends('layouts.master')

@section('content')

<x-navigation />

<x-trash heading='Evenements' content='Evenement' :trashed="$trashedEvents" :publiee="$publieeEvents" :allPubliee="$allPubliee" :allTrashed="$allTrashed">

<x-slot name="thead">
    <thead class="text-center border-b-2 border-solid border-gray-300">
        <tr>
            <th class="py-2">#</th>
            <th class="py-2">Title</th>
            <th class="py-2">Duree</th>
            <th class="py-2">Etat</th>
            <th class="py-2">Date de Publication</th>
            <th class="py-2">Action</th>
        </tr>
    </thead>
</x-slot>

<x-slot name="tbody">
    <tbody class="text-center">
        @isset($trashedEvents)
            
        @foreach ($trashedEvents as $event)
        <tr>
            <td class="py-2">{{$event->id}}</td>
            <td class="py-2">{{$event->titre}}</td>
            <td class="py-2">{{$event->details}}</td>
            <td class="py-2">{{$event->categorie_id}}</td>
            <td class="py-2">{{$event->date}}</td>
            <td class="py-2 flex items-center justify-center">
                <a href="{{ route('evenements.restore', $event->id)}}" class="mr-2">
                    <i class="fa-solid fa-rotate-left"></i>
                </a>
                <form action="{{ route('evenements.force_delete', $event->id) }}" method="POST" class="mb-0">
                    @csrf
                    @method('DELETE')
                    <button>
                        <i class="fa-solid fa-trash"></i>    
                    </button>
                </form>
            </td>
        </tr>    
        @endforeach
        @endisset
    </tbody>
</x-slot>


</x-trash>
@endsection