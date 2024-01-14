<div class="p-8">
    <div class="flex items-center gap-2 text-gray-500">
        <i class="fa-solid fa-arrow-left text-sm"></i>
        <a href="{{ route($toRoute.'.index') }}" class="">Retour</a>
    </div>
    <p class="text-xl ">annee de formation active : {{Session::get('anneeFormationActive')->nom}}</p>
    <h2 class="text-3xl my-10">Ajouter {{$content}}</h2>

    <form action="{{ route($toRoute.'.store') }}" method="POST" enctype='multipart/form-data'>
        @csrf
        @method('post')
        <div class="grid grid-cols-[3fr_1fr] gap-6">
        <div>
            <div class="mb-4">
                <label for="titre">Titre</label>
                <input type="text" name="titre" id="titre" class="block border-[1px] border-solid border-gray-500 rounded w-full mt-4 py-1 px-2 outline-none">
           @error('titre')
           <div class="text-red-600">{{$message}}</div>
           @enderror
        </div>          
            <div class="mb-4">
                <label for="description">Description</label>
                <textarea rows="8" name="description" id="description" class="block border-[1px] border-solid border-gray-500 rounded w-full mt-4 py-1 px-2 outline-none"></textarea>
            @error('description')
           <div class="text-red-600">{{$message}}</div>
           @enderror
            </div>
            <label for="file">piece joint</label>  
            <div class='flex flex-wrap gap-1 ' id='container_imgs' >  
                <div  class="rounded-md border relative border-black bg-gray-50 shadow-md w-full">
                    <label for="upload" class="flex flex-col items-center gap-2 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 fill-white stroke-black" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <input id='upload' type="file" name='image' class="hidden w-full h-full upload" />
                        <span class="text-gray-600 font-medium">Upload file</span>
                    </label>
                        @error('image')<div class="text-red-600">{{$message}}</div> @enderror
                        <i class="fa-solid  fa-delete-left text-red-500 absolute removeFile cursor-pointer rounded-2xl m-1 px-1 right-0 top-0 hover:text-black hover:scale-110"></i>
                    </div>
            </div>
            <a type='button' id="btnAddImg" class=' bg-green-700 rounded-md p-1 w-full my-1 hover:bg-green-500 hover:font-bold text-center text-white cursor-pointer'>ajouter d'autre photo</a>
            <!-- <div id='container_imgs' >    
                <div  class="relative mt-4">
                    <div class="text-center absolute top-1/2 -translate-y-1/2 translate-x-1/2 right-1/2">
                        <i class="fa-solid fa-arrow-up-from-bracket"></i>
                        <h6>Upload Files</h6>
                    </div>
                     <input type="file" name='image' id='inputImg' multiple='True' 
                class="w-full text-transparent p-3 relative cursor-pointer border-dashed border-2 hover:border-black file:invisible rounded-md " />
                </div>
            </div> -->
        </div>
        {{$slot}}
        </div>   
        <input type='hidden' name="annee_formation" id="annee_formation" class="block bg-gray-200 cursor-pointer py-2 px-1 w-full rounded mt-4" value="{{Session::get('anneeFormationActive')->id}}" />  
         <div class="mt-6 flex w-3/12 gap-2">
            <button class="bg-[#499352] py-1 flex-1 text-white rounded font-medium">Save</button>
            <a href="{{ route($toRoute.".index") }}" class="border-[1px] text-center border-solid border-black py-1 flex-1 rounded">Cancel</a>
         </div>
    </form>
</div>