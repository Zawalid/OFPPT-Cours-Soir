@extends('layouts.master')

@section('content')
    
<x-main2 heading="Roles" content="Role"  toRoute='roles'> 

    <x-slot name='thead'>
        <thead class="text-center border-b-2 border-solid border-gray-300">
        <tr>
            <th class="py-2">#</th>
            <th class="py-2">Role</th>
            <th class="py-2">Permissions</th>
            <th class="py-2">Actions</th>
        </tr>
        </thead>
    </x-slot>

    <x-slot name='tbody'>
        <tbody class="text-center">
            @isset($roles)
                @foreach ($roles as $role)
                    @if($role->name !=='super-admin')
                <tr class='border-b-2 border-solid border-gray-300 '>
                    <td >{{$role->id}}</td>
                    <td >{{$role->name}}</td>
                    <td class="flex flex-wrap gap-1 items-center">
                        @foreach($role->permissions as $permission)
                          <span class='border border-black  bg-slate-300 px-1 rounded-lg font-bold '> {{$permission->name}}</span>
                        @endforeach
                    </td>
                    <td>
                        <div class="flex justify-end">
                            <div class="flex gap-1">
                                <a href="{{ route('roles.edit', $role->id) }}" class="h-fit p-2 bg-blue-500 hover:bg-blue-700 text-white rounded-md">Edit </a>
                                <form class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white rounded-md" method="POST" action="{{ route('roles.destroy', $role->id) }}" onsubmit="return confirm('Are you sure?');">
                                   @csrf
                                   @method('DELETE')
                                   <button type="submit">Delete</button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>    
                @endif
                @endforeach
            @endisset
        </tbody>
    </x-slot>
</x-main2>
@endsection
