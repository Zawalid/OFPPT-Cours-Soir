<div class="p-8">
    <div class="flex items-center gap-2 text-gray-500">
        <i class="fa-solid fa-arrow-left text-sm"></i>
        <a href="{{ route($toRoute.".index") }}" class="">Retour</a>
    </div>
    <h2 class="text-3xl my-10">Ajouter {{$content}}</h2>

    <form action="{{ route($toRoute.".store") }}" method="POST" enctype='multipart/form-data'>
        @csrf
        @method('post')
        <div class="grid grid-cols-[3fr_1fr] gap-6">
        <div>
            <div class="mb-4">

                <label for="titre">Titreee</label>
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

            <div id='container_imgs' >    
                <label for="file">piece joint</label>
                <div  class="relative mt-4">
                    <div class="text-center absolute top-1/2 -translate-y-1/2 translate-x-1/2 right-1/2">
                        <i class="fa-solid fa-arrow-up-from-bracket"></i>
                        <h6>Upload Files</h6>
                    </div>
                     <input type="file" name='image' id='inputImg' multiple='True' 
                class="w-full text-transparent p-3 relative cursor-pointer border-dashed border-2 hover:border-black file:invisible rounded-md " />
                </div>
                @error('image')<div class="text-red-600">{{$message}}</div> @enderror
            </div>
            <a type='button' id="btnAddImg" class=' bg-green-700 rounded-md p-1 w-full my-1 hover:bg-green-500 hover:font-bold text-center text-white cursor-pointer'>ajouter d'autre photo</a>
        </div>

        {{$slot}}

        </div>   
         <div class="mt-6 flex w-3/12 gap-2">
            <button class="bg-[#499352] py-1 flex-1 text-white rounded font-medium">Save</button>
            <a href="{{ route($toRoute.".index") }}" class="border-[1px] text-center border-solid border-black py-1 flex-1 rounded">Cancel</a>
         </div>
    </form>
</div>