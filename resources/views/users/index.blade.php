@extends('layouts.master')

@section('content')
    

<x-main heading="Users" content="User" toRoute="users" :publiee="$publieeUsers" 
    :trashed="$trashedUsers"  :allPubliee="$allPubliee" 
    :allTrashed='$allTrashed' :categorie="$categorie" :anneeFormation="$anneeFormation"
    >
    <x-slot name='thead'>
        <thead class="text-center border-b-2 border-solid border-gray-300">
            <tr>
                <th class="py-2">#</th>
                <th class="py-2">name</th>
                <th class="py-2">email </th>
                <th class="py-2">roles </th>
                <th class="py-2">Action</th>
            </tr>
        </thead>
    </x-slot>
    <x-slot name='tbody'>
        <tbody class="text-center">
            @isset($allPubliee)        
            @foreach ($allPubliee as $user)
            <tr>
                <td class="py-2">{{$user->id}}</td>
                <td class="py-2">{{$user->name}}</td>
                <td class="py-2">{{$user->email}}</td>
                <td class="py-2">
                    @foreach( $user->roles as $role)
                        <span class='border border-black  bg-slate-300 px-1 rounded-lg font-bold '> {{$role->name}}</span>
                    @endforeach
                </td>
                <td class="py-2 flex items-center justify-center">
                    <a href="{{ route('users.show', $user->id)}}" class="mr-2">
                        <i class="fa-solid fa-eye"></i>
                    </a>
                    <a href="{{route('users.edit', $user->id)}}" class="mr-2">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="mb-0">
                        @csrf
                        @method('DELETE')
                    </form>
                    <div class="mb-0" id={{$user->id}}>
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