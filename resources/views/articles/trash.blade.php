@extends('layouts.master')

@section('content')


<x-trash heading='Articles' content='Article' :trashed="$trashedArticles" :publiee="$publieeArticles" :allPubliee="$allPubliee" :allTrashed="$allTrashed">

<x-slot name="thead">
            <thead class="text-center border-b-2 border-solid border-gray-300">
                <tr>
                    <th class="py-2">#</th>
                    <th class="py-2">Title</th>
                    <th class="py-2">Auteur</th>
                    <th class="py-2">Categorie</th>
                    <th class="py-2">Date de Publication</th>
                    <th class="py-2">Action</th>
                </tr>
            </thead>
</x-slot>

<x-slot name="tbody">
            <tbody class="text-center">
                @foreach ($trashedArticles as $article)
                <tr>
                    <td class="py-2">{{$article->id}}</td>
                    <td class="py-2">{{$article->titre}}</td>
                    <td class="py-2">{{$article->auteur}}</td>
                    <td class="py-2">{{$article->Categories->nom}}</td>
                    <td class="py-2">{{$article->date}}</td>
                    <td class="py-2 flex items-center justify-center">
                        <a href="{{ route('articles.restore', $article->id)}}" class="mr-2">
                            <i class="fa-solid fa-rotate-left"></i>
                        </a>
                        <form action="{{ route('articles.force_delete', $article->id) }}" method="POST" class="mb-0">
                            @csrf
                            @method('DELETE')
                            <button>
                                <i class="fa-solid fa-trash"></i>    
                            </button>
                        </form>
                    </td>
                </tr>    
                @endforeach
            </tbody>
</x-slot>


</x-trash>
@endsection