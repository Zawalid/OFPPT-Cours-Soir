@extends('layouts.master')

@section('content')
    
<x-mainRoles heading="Permissions" content="Permission" toRoute="permissions" > 

    <x-slot name='thead'>
        <thead class="text-center border-b-2 border-solid border-gray-300">
        <tr>
            <th class="py-2">#</th>
            <th class="py-2">permission</th>
            <th class="py-2">propriétaire</th>
            <th class="py-2">actions</th>
        </tr>
        </thead>
    </x-slot>

    <x-slot name='tbody'>
        <tbody class="text-center position-fixed h-[50px] overflow-y-hidden">
            @isset($permissions)
                @foreach ($permissions as $permission)
                <tr class='border-b-2 border-solid border-gray-300'>
                    <td class="py-2">{{$permission->id}}</td>
                    <td class="py-2">{{$permission->name}}</td>
                    <td class="py-2 flex flex-wrap gap-1 justify-center">
                        @foreach($permission->roles as $role)
                          <span class='border border-black  bg-slate-300 px-1 rounded-lg font-bold '> {{$role->name}}</span>
                        @endforeach
                    </td>
                    <td>
                        <div class="flex justify-end">
                            <div class="flex gap-1">
                                <a href="{{ route('permissions.edit', $permission->id) }}" class="h-fit p-2 bg-blue-500 hover:bg-blue-700 text-white rounded-md">Edit</a>
                                <form class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white rounded-md" method="POST" action="{{ route('permissions.destroy', $permission->id) }}" onsubmit="return confirm('confirmez-vous la supprission du permission?');">
                                   @csrf
                                   @method('DELETE')
                                   <button type="submit">Delete</button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>    
                @endforeach
            @endisset
        </tbody>
    </x-slot>
</x-mainRoles>
@endsection
