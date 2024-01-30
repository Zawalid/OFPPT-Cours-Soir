<div class="p-2 ">
    <div class="flex items-center gap-2 text-gray-500">
        <i class="fa-solid fa-arrow-left text-sm"></i>
        <a href="{{ route($toRoute.".index") }}" class="">Retour</a>
    </div>
    <h2 class="text-3xl my-10">{{$content. '#'. $item->id}}</h2>
<div class='bg-gray-200 p-2 rounded-md''>
    <div class='flex w-full h-[30vh] my-5 rounded-md  justify-between'>
        <div id='container_imgs '  class='w-[35%] overflow-x-hidden'>  
            @if(count($item->pieceJointes)>0)  
                @foreach($item->pieceJointes as $pj)
                    <img class='m-2 rounded-md shadow-md shadow-black'  src="{{ asset('/images/'.$content.'/'.$pj->URL)  }}" alt="">
                @endforeach
            @else
            <p>no images found</p>
            @endif
        </div>
    </div>
        <div class="flex w-full justify-between">
            <div>
                    <div class="mb-4">
                        <span class='font-bold'>Titre</span>
                        <p for="titre">{{$item->titre}}</p>       
                    </div>
                    <div class="mb-4">
                        <span class='font-bold'>Description</span>
                        <p for="titre">{!!$item->details!!}</p>       
                    </div> 
                    <div>
                    @if(count($item->tags)>0)  
                        @foreach($item->tags as $tag)
                            <span>{{$tag->name}}</span>
                        @endforeach
                    @endif
                    </div>
</div>
<div>
                    {{$slot}}
                    <div class="mb-4">
                        <span class='font-bold'>annee de formation</span>
                        <p for="titre">{{$item->AnneeFormations->nom}}</p>       
                    </div> 
            </div>
        </div>
    </div>   

</div>