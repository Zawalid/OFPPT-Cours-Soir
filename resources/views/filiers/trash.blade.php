@extends('layouts.master')

@section('content')

<x-navigation />

<x-trash heading='Filiers' content='Filier' :trashed="$trashedFiliers" :publiee="$publieeFiliers" :allPubliee="$allPubliee" :allTrashed="$allTrashed">

<x-slot name="thead">
    <thead class="text-center border-b-2 border-solid border-gray-300">
        <tr>
            <th class="py-2">#</th>
            <th class="py-2">Title</th>
            <th class="py-2">Numbre Stagiaires</th>
            <th class="py-2">Etat</th>
            <th class="py-2">Date de Publication</th>
            <th class="py-2">Action</th>
        </tr>
    </thead>
</x-slot>

<x-slot name="tbody">
    <tbody class="text-center">
        @isset($trashedFiliers)
            
        @foreach ($trashedFiliers as $filier)
        <tr>
            <td class="py-2">{{$filier->id}}</td>
            <td class="py-2">{{$filier->titre}}</td>
            <td class="py-2">{{$filier->number_stagiaires}}</td>
            <td class="py-2">{{$filier->active}}</td>
            <td class="py-2">{{$filier->created_at}}</td>
            <td class="py-2 flex items-center justify-center">
                <a href="{{ route('filiers.restore', $filier->id)}}" class="mr-2">
                    <i class="fa-solid fa-rotate-left"></i>
                </a>
                <form action="{{ route('filiers.force_delete', $filier->id) }}" method="POST" class="mb-0">
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