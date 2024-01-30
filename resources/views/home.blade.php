@extends('layouts.master')

@section('content')

<div class='P-2'>
    <h2 class="text-3xl my-10 m-2"> Paramètres<i class="fa-solid fa-gear m-2"></i> </h2>
    <div class='grid grid-cols-1 md:grid-cols-[1fr,1fr]'>
        <div class='flex w-full'>
            <form class='m-2 w-full' action="{{ route('ChangerAfSession') }}" method='POST'>
                <h3 class='text-xl my-3'>Session</h3>
                @csrf
                @method('POST')
                <p>changer l'annee de formation de  <strong>votre session</strong> </p>
                <select name="annee_formation_id" id="af" class=' bg-gray-200 py-2 px-1 w-full cursor-pointer rounded mt-4'>
                    @foreach($annesFormation as $af)
                    <option class="{{$af->id ===session('anneeFormationActive')->id?'bg-green-700 text-white font-bold':''}}" value="{{$af->id}}" {{$af->id ===session('anneeFormationActive')->id ?'selected':''}}>{{$af->nom}}</option>
                    @endforeach
                </select> 
                <button class=' bg-blue-700 p-1 w-full rounded-md my-2 text-white'> valider </button>
            </form>
        </div>
        @role(['super-admin','admin'])
        <div class='flex'>
            <form class='m-2 w-full' action="{{ route('setActiveAF') }}" method='POST'>
                <h3 class='text-xl my-3'>Site</h3>
                @csrf
                @method('POST')
                <p>changer l'annee de formation de <strong>site</strong> </p>
                <select name="annee_formation_id" id="af" class=' bg-gray-200 py-2 px-1 w-full cursor-pointer rounded mt-4'>
                    @foreach($annesFormation as $af)
                    <option class="{{$af->active===1?'bg-blue-700 text-white font-bold':''}}" value="{{$af->id}}" {{$af->active===1?'selected':''}}>{{$af->nom}}</option>
                    @endforeach
                </select> 
                <button class=' bg-blue-700 p-1 w-full rounded-md my-2 text-white'> valider </button>
            </form>
        </div>
        @endrole
    </div>
    <!-- <div class='grid grid-cols-2 gap-2'>
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
</div> -->
@endsection