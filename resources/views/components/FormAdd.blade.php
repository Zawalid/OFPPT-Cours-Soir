<div class="w-full h-full p-3">
    <div class="w-full flex justify-end p-3">
        <span class=" text-gray-400"> retour</span>
    </div>
    <div class="w-full p-3 ms-0 m-3">
        <span class="font-bold text-2xl"> Ajouter Article</span>
    </div>
    <form action="add"
        class="max-sm:flex-col md:flex justify-around p-3 bg-gray-100 rounded-md transition duration-500">
        @csrf
        <div class="max-sm:w-full md:w-[70%]">
            <div class="w-full">
                <label class="m-4 block"> Titre :</label>
                <span class="text-red-500"> @error('Titre') {{$message}} @enderror </span>
                <input type="text" name="Titre" class="w-full border p-2 rounded-md" value="{{ old('Titre')}}" />
            </div>
            <div class="w-full">
                <label class="m-4 block "> Description :</label>
                <input type="textarea" name='Details' class="w-full h-40 border p-2 rounded-md" />
            </div>
            <div class="w-full">
                <label class=" m-4 block"> Piece jointe :</label>
                <input type="file" class="w-full relative h-40 border-dashed border-2 hover:border-black 
                file:mr-4 file:py-2 file:px-4 file:cursor-pointer
                file:absolute file:top-1/2 file:left-1/2 file:-translate-x-1/2 file:-translate-y-1/2  file:border-0
                file:text-sm file:font-semibold file:w-full file:h-full
              file:bg-green-50 file:text-green-700
              hover:file:bg-green-700 
              hover:file:text-green-100
              rounded-md " />
            </div>
        </div>
        <div class="flex flex-col w-full md:w-[25%] P-3">
            <div class="w-full ">
                <label class="m-4 block"> Categories :</label>
                <select name='Categorie' class="self-stretch p-2 bg-neutral-200 rounded ">
                    <option> Education</option>
                    <option> information</option>
                    <option> journal</option>
                </select>
            </div>
            <div class="w-full ">
                <label class="m-4 block"> Annee de formation :</label>
                <select name='AnneeFormation' class="self-stretch p-2 bg-neutral-200 rounded ">
                    <option> 23/24</option>
                    <option> 22/23</option>
                    <option> 21/22</option>
                    <option> 20/21</option>
                </select>
            </div>
            <div class="w-full ">
                <label class="m-4 block"> Date de publication :</label>
                <input type="date" name="Date" class=" border p-2 rounded-sm" />
            </div>
            <div class="w-full ">
                <label class="m-4 block"> Auteur :</label>
                <select class="self-stretch p-2 bg-neutral-200 rounded " name="Autheur">
                    <option> Directeur</option>
                    <option> Formateur 1</option>
                    <option> Formateur 2</option>
                    <option> Formateur 3</option>
                </select>
            </div>
            <div class="flex justify-around my-auto">
                <input type="submit" class="bg-green-500 w-1/2 p-2 rounded-md text-white " />
                <button class="bg-red-600 p-2 w-1/3 rounded-md text-white ">
                    cancel
                </button>
            </div>
        </div>
    </form>
</div>