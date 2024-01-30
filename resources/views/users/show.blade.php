@extends('layouts.master')

@section('content')
    
<div class="py-12 w-full">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-2">
            <div class="flex p-2">
                <a href="{{ route('users.index') }}" class="px-4 py-2 text-slate-500">           
                    <i class="fa-solid fa-arrow-left text-sm"></i>
                      retour
                </a>
            </div>
            <div>
                <p> nom :{{$user->name}}</p>
                <p>email : {{$user->email}}</p>
                <p>@foreach($user->roles as $role)
                   les roles : {{$role->name}}
                    @foreach($role->Permissions as $permission)
                    ->{{$permission->name}}
                    @endforeach
                    @endforeach
                </p>
            </div>
        </div>
    </div>
</div>
@endsection