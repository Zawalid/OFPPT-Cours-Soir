<nav class="flex flex-col justify-between bg-gray-200 py-5 px-3 h-screen">
        <div class="w-[96px] mx-auto">
            <img class="w-full" src="/images/logo.svg" />
        </div>
           <div class='p-2 mb-5 flex gap-1'>       
                <p class='text-balck font-bold text-xl'>
                    @if (Session::has('anneeFormationActive'))
                    {{Session::get('anneeFormationActive')->nom}}
                    @endif
                </p>
            </div>
        <div class="flex flex-col flex-grow">
            <ul>
                <li class="py-2 px-3 font-bold text-lg bg-gray-300 rounded mb-1">
                    <a href="{{ route('articles.index') }}">
                        Articles
                    </a>
                </li>
                <li class="py-2 px-3 font-bold text-lg bg-gray-300 rounded mb-1">
                    <a href="{{ route('evenements.index') }}">Evenements</a>
                </li>
                <li class="py-2 px-3 font-bold text-lg bg-gray-300 rounded mb-1">
                    <a href="{{ route('filiers.index') }}">Filiers</a>
                </li>
                <li class="py-2 px-3 font-bold text-lg bg-gray-300 rounded mb-1">
                    <a href="{{ route('home') }}">Paramètres </a>
                </li>
            </ul>
        </div>
        <div class="flex flex-col w-full">
            <div class='p-1 flex gap-1'>       
                    <p class='text-balck font-bold text-xl'>
                        <i class="fa-solid  rounded-full fa-user text-black"></i>
                        @if (Session::has('user'))
                            {{Session::get('user')->name}}
                        @endif
                    </p>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" >
                @csrf
                <button class=' font-bold  rounded-md text-red-600 hover:scale-105'>
                   Deconnexion <i class="fa-solid fa-arrow-right-to-bracket"></i>
                </button>
            </form>
        </div>
</nav>