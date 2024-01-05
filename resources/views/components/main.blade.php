<form class="confirmation overlay hidden transition duration-300" action="" method="POST">
    @csrf
    @method('DELETE')
    <div class="z-[444] bg-white absolute text-black rounded top-[50%] left-[50%] translate-x-[-50%] translate-y-[-50%] py-4 px-8">
        <h3 class="text-lg font-medium">Delete {{$content}}</h3>
        <p class="my-4 text-lg">Are you sure you want to delete this {{Str::lower($content)}}?</p>
        <button class="bg-red-500 text-white rounded px-2 py-1 font-medium mr-2">Delete</button>
        <span class="border-solid border-[1px] border-black rounded px-2 py-1 font-medium cancel_delete cursor-pointer">Cancel</span>
    </div>
</form>

<div class="py-8 pr-4">
    <div class="flex items-center gap-6">
        <h2 class="text-5xl">{{$heading}}</h2>
        <a href="{{ route("$toRoute".".create") }}" class="bg-blue-500 px-3 py-1 text-white flex items-center gap-2 font-medium rounded text-sm">
            <i class="fa-solid fa-plus text-xs"></i>
            Nouveau {{$content}}
        </a>
    </div>
    <div class="flex gap-4 my-10">
        <div class="flex items-center gap-1">
            <a href="{{route("$toRoute".".index")}}" class="font-semibold">Publie</a>
            @if (count($allPubliee))
            <span class="w-[16px] h-[16px] text-xs bg-gray-300 rounded-full flex items-center justify-center font-medium">{{count($allPubliee)}}</span>
            @endif
        </div>
        <div class="w-[1px] self-stretch bg-black"></div>
        <div class="flex items-center gap-1">
            <a href="{{route("$toRoute".".trash")}}" class="text-red-700 opacity-70">Trash</a>
            @if (count($allTrashed) > 0)
            <span class="w-[16px] h-[16px] text-xs bg-gray-300 rounded-full flex items-center justify-center font-medium opacity-50">{{count($allTrashed)}}</span>
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
    {{$publiee->links('pagination::tailwind')}}
</div>