@extends('layouts.master')

@section('content')
   <div class="py-8 pr-4">
         <div class="flex flex-col   h-[10vh] gap-6 mb-16">
            <h2 class="text-5xl">Demandes</h2>
            <a class=' mx-5' href="{{route('demandes.index')}}">public</a>
        </div>
        <div>
            <table class="w-full  bg-slate-100 rounded-md p-2">
                <thead class="text-center border-b-2 border-solid border-gray-300">
                    <tr>
                        <th class="py-2">#</th>
                        <th class="py-2">demande</th>
                        <th class="py-2">propriétaire</th>
                        <th class="py-2">actions</th>
                    </tr>
                </thead>
                <tbody class="text-center position-fixed h-[50px] overflow-y-hidden">
                    @isset($demandes)
                        @foreach ($demandes as $demande)
                        <tr class='border-b-2 border-solid border-gray-300'>
                            <td class="py-2">{{$demande->id}}</td>
                            <td class="py-2">{{$demande->subject}}</td>
                            <td class="py-2">{{$demande->name}}</td>
                            <td>
                                <div class="flex justify-center">
                                    <div class="flex gap-1">
                                        <a href="{{ route('demandes.restore', $demande->id) }}" class="h-fit p-2 bg-green-500 hover:bg-green-700 text-white rounded-md">restore</a>
                                       
                                    </div>
                                </div>
                            </td>
                        </tr>    
                        @endforeach
                    @endisset
                </tbody>
            </table>
        </div>
    </div>
@endsection