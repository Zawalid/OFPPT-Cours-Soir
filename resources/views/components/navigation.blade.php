<nav class="flex flex-col bg-gray-200 py-5 px-7 h-screen">
        <div class="w-[96px] mx-auto mb-14">
            <img class="w-full" src="{{ asset('logo.png') }}" />
        </div>
        <div class="flex flex-col flex-grow justify-between">
            <ul>
                <li class="py-2 px-3 font-bold text-lg bg-gray-300 rounded mb-4">
                    <a href="{{ route('articles.index') }}">
                        Articles
                    </a>
                </li>
                <li class="py-2 px-3 font-bold text-lg bg-gray-300 rounded mb-4">
                    <a href="{{ route('evenements.index') }}">Evenements</a>
                </li>
                <li class="py-2 px-3 font-bold text-lg bg-gray-300 rounded mb-4">
                    <a href="{{ route('filiers.index') }}">Filiers</a>
                </li>
            </ul>
            <div class="flex gap-4 items-center">
                <div class="bg-blue-600 p-3 rounded-full flex items-center justify-center">
                    <i class="fa-solid fa-user text-white"></i>
                </div>
                <span class="font-bold text-md">Mr Sbabou</span>
            </div>
        </div>
</nav>