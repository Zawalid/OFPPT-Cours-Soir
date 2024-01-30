
<div class="py-8 pr-4 ">
    <div class="flex items-center  h-[10vh] gap-6 mb-16">
        <h2 class="text-5xl">{{$heading}}</h2>
        <a href="{{ route("$toRoute".".create") }}" class="bg-blue-500 px-3 py-1 text-white flex items-center gap-2 font-medium rounded text-sm">
            <i class="fa-solid fa-plus text-xs"></i>
            Nouveau {{$content}}
        </a>
    </div>
    <table class="w-full  bg-slate-100 rounded-md p-2">
        {{$thead}}
        {{$tbody}}
    </table>
</div>