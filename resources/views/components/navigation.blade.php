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
                    <a href="{{ route('home') }}">Home</a>
                </li>
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
                    <a href="{{ route('demandes.index') }}">Demandes</a>
                </li>
           
          
                @role(['super-admin','admin'])
                    <button class="peer relative text-white w-full bg-blue-700 hover:bg-blue-800 focus:ring-4 font-medium rounded-md text-lg p-2 text-center inline-flex items-center " >
                     Admin
                        <svg class="w-2.5 h-2.5 mx-2 absolute right-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>
                    <div  class="z-10 invisible bg-white divide-y font-bold divide-gray-100 rounded-lg shadow  dark:bg-gray-300 text-black hover:visible peer-hover:visible">
                        <ul class=" pt-2 text-sm ">
                            @can('gerer users')
                                <a href="{{ route('users.index') }}" >
                                    <li class="block px-4 py-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-400 ">users </li>
                                </a>
                            @endcan             
                            @can('gerer roles')
                                <a href="{{ route('permissions.index') }}" >
                                    <li class="block px-4 py-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-400 ">permissions</li>
                                </a>

                                <a href="{{ route('roles.index') }}" >
                                    <li class="block px-4 py-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-400 ">  roles</li>
                                </a>
                            @endcan
                        </ul>
                    </div>
                @endrole
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