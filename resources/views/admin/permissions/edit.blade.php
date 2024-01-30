@extends('layouts.master')

@section('content')
<div content="permission" toRoute="permissions">
    <div class="py-12 w-full">
        <div class="max-w-7xl mx-auto sm:px-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-2">
                <div class="flex p-2">
                        <a href="{{ route('permissions.index') }}" class="px-4 py-2 text-slate-500">           
                        <i class="fa-solid fa-arrow-left text-sm"></i>
                          retour
                    </a>                </div>
                <div class="flex flex-col p-2 bg-slate-100">
                    <div class="divide-y divide-gray-200 w-1/2 mt-10">
                        <form method="POST" action="{{ route('permissions.update', $permission) }}">
                            @csrf
                            @method('PUT')
                            <div class="sm:col-span-6">
                                <label for="name" class="block text-sm font-medium text-gray-700"> Permission name
                                </label>
                                <div class="mt-1">
                                    <input type="text" id="name" name="name"
                                        class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                                        value="{{ $permission->name }}" />
                                </div>
                                @error('name')
                                    <span class="text-red-400 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="sm:col-span-6 pt-5">
                                <button type="submit"
                                    class="px-4 py-2 bg-green-500 hover:bg-green-700 rounded-md">Update</button>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="mt-6 p-2 bg-slate-100">
                    <h2 class="text-2xl font-semibold">Roles</h2>
                    <div class="flex flex-wrap space-x-2 mt-4 p-2">
                        @if ($permission->roles)
                            @foreach ($permission->roles as $permission_role)
                                <form class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white rounded-md" method="POST"
                                    action="{{ route('permissions.roles.remove', [$permission->id, $permission_role->id]) }}"
                                    onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">{{ $permission_role->name }}</button>
                                </form>
                            @endforeach
                        @endif
                    </div>
                    <div class="max-w-xl mt-6">
                        <form method="POST" action="{{ route('permissions.roles', $permission->id) }}">
                            @csrf
                             <div class="sm:col-span-6">
                                <label for="role" class="block text-sm font-medium text-gray-700">Roles</label>
                                    @foreach ($roles as $i=> $role)
                                    <div>
                                        <label for="role{{$i}}">{{$role->name}}</label>
                                        <input id='role{{$i}}' type="checkbox" name='roles[]' value='{{ $role->name }}'>  
                                    </div>
                                      @endforeach
                            </div> 
                    </div>
                    <div class="sm:col-span-6 pt-5">
                        <button type="submit"
                            class="px-4 py-2 bg-green-500 hover:bg-green-700 rounded-md">Assign</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
