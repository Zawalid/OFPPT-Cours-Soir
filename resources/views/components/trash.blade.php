        <div class="py-8 pr-4">
        <div class="flex items-center gap-6">
            <h2 class="text-5xl">{{$heading}}</h2>
            <a href="{{ route('articles.create') }}" class="bg-blue-500 px-3 py-1 text-white flex items-center gap-2 font-medium rounded text-sm">
                <i class="fa-solid fa-plus text-xs"></i>
                Nouveau {{$content}}
            </a>
        </div>
        <div class="flex gap-4 my-10">
            <div class="flex items-center gap-1">
                <a href="{{ route('articles.index') }}" class="font-semibold text-gray-400">Publiee</a>
                @if (count($allPubliee) > 0)
                <span class="w-[16px] h-[16px] text-xs bg-gray-300 rounded-full flex items-center justify-center font-medium opacity-70">{{count($allPubliee)}}</span>
                @endif
            </div>
            <div class="w-[1px] self-stretch bg-black"></div>
            <div class="flex items-center gap-1">
                <a href="{{ route('articles.trash') }}" class="text-red-700 font-medium">Trash</a>
                @if (count($allTrashed) > 0)
                <span class="w-[16px] h-[16px] text-xs bg-gray-300 rounded-full flex items-center justify-center font-medium">{{count($allTrashed)}}</span>
                @endif
            </div>
        </div>
        <div>
            <form action="" class="flex w-4/12">
                <input type="text" class="outline-none border-2 border-solid border-gray-300 px-2 flex-1">
                <button class="text-white bg-blue-400 px-2 py-1">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    Search
                </button>
            </form>
        </div>
        <table class="w-full">
            {{$thead}}
            {{$tbody}}
        </table>
        {{$trashed->links('pagination::tailwind')}}
    </div>
</div>