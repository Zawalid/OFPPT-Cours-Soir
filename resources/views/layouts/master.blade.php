<link rel="stylesheet" href="{{ asset('all.min.css') }}">
@vite(['resources/css/app.css','resources/js/app.js'])

<div class="grid grid-cols-[auto,1fr] gap-4">
    <x-navigation />
@yield('content')

</div>