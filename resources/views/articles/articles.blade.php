@extends('layouts.master')

@section('content')
    
<x-navigation />

<x-main heading="Articles" content="Article" :publiee="$publieeArticles" :trashed="$trashedArticles" toRoute="articles" :allPubliee="$allPubliee" :allTrashed="$allTrashed" :categorie="$categorie" :anneeFormation="$anneeFormation"> 

<x-slot name='thead'>
    <thead class="text-center border-b-2 border-solid border-gray-300">
        <tr>
            <th class="py-2">#</th>
            <th class="py-2">Title</th>
            <th class="py-2">Auteur</th>
            <th class="py-2">categorie</th>
            <th class="py-2">Date de Publication</th>
            <th class="py-2">annee de foromation</th>
            <th class="py-2">Piece jointes</th>
            <th class="py-2">Action</th>
        </tr>
    </thead>
</x-slot>

<x-slot name='tbody'>

<tbody class="text-center">
    @isset($publieeArticles)
    @foreach ($publieeArticles as $article)
    <tr>
        <td class="py-2">{{$article->id}}</td>
        <td class="py-2">{{$article->titre}}</td>
        <td class="py-2">{{$article->auteur}}</td>
        @foreach($categorie as $categ)
        @if( $categ->id === $article->categorie_id)
        <td class="py-2">{{$categ->nom}} </td>
        @endif
        @endforeach
        <td class="py-2">{{$article->date}}</td>
        <td class="py-2">{{$article->AnneeFormations->nom}}</td>
        <td class="py-2">{{count($article->PieceJointes)}}</td>
        <td class="py-2 flex items-center justify-center">
            <a href="{{ route('articles.show', $article->id)}}" class="mr-2">
                <i class="fa-solid fa-eye"></i>
            </a>
            <a href="{{ route('articles.edit', $article->id)}}" class="mr-2">
                <i class="fa-solid fa-pen-to-square"></i>
            </a>
            {{-- <form action="{{ route('articles.destroy', $article->id) }}" method="POST" class="mb-0">
                @csrf
                @method('DELETE')
            </form> --}}
            <div class="mb-0" id={{$article->id}}>
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