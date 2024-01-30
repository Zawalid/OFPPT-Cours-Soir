@extends('layouts.master')

@section('content')

  <div>
        <div class="flex p-2 ">
        <a href="{{ route('roles.index') }}" class="px-4 py-2 text-slate-500">           
            <i class="fa-solid fa-arrow-left text-sm"></i>
              retour
        </a>
      </div>
      <div class='grid grid-cols-2 gap-2'>
        <div class="py-12 space-y-8 divide-y flex flex-col divide-gray-200 mt-10">
                <form method="POST" action="{{ route('permissions.store') }}">
                    @csrf
                  <div class="sm:col-span-6">
                    <label for="name" class="block text-sm font-medium text-gray-700"> permission name </label>
                    <div class="mt-1">
                      <input type="text" id="name" name="name" class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                    </div>
                    @error('name') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                  </div>
                  <div class="sm:col-span-6 pt-5">
                    <button type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white  rounded-md">Create</button>
                  </div>
                  <!-- <div class="sm:col-span-6">
                        <label for="role" class="block text-sm font-medium text-gray-700">Roles</label>
                            @foreach ($roles as $i=> $role)
                            <div>
                                <label for="role{{$i}}">{{$role->name}}</label>
                                <input id='role{{$i}}' type="checkbox" name='roles[]' value='{{ $role->name }}'>  
                            </div>
                              @endforeach
                  </div> -->
                </form>
        </div>
        <div class="py-12 space-y-8 flex flex-col divide-y divide-gray-200 mt-10">
                <form method="POST" action="{{ route('roles.store') }}">
                      @csrf
                    <div class="sm:col-span-6">
                      <label for="name" class="block text-sm font-medium text-gray-700"> Role name </label>
                      <div class="mt-1">
                        <input type="text" id="name" name="name" class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                      </div>
                      @error('name') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div class="sm:col-span-6 pt-5">
                      <button type="submit" class="px-4 py-2 bg-green-500 hover:bg-green-700 rounded-md">Create</button>
                    </div>
                </form>
          </div>
      </div>
</div>
@endsection