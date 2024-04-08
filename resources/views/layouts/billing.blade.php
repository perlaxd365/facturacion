@props([
    'breadcrumb' => [],
    'company'
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- Font Awesome --}}
    {{-- <script src="https://kit.fontawesome.com/e2d71e4ca2.js" crossorigin="anonymous"></script> --}}
    <script src="{{asset('vendor/fontawesome/js/all.min.js')}}"></script>

    @stack('css')

    <!-- Scripts -->
    @wireUiScripts
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased bg-gray-50" x-data="{open: false}">

    <div style="display: none" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-20 sm:hidden" x-on:click="open = false" x-show="open">
    </div>

    @include('layouts.includes.billing.navigation')

    @include('layouts.includes.billing.sidebar')

    <div class="p-4 sm:ml-64">

        <div class="mt-14 flex items-center">

            @include('layouts.includes.billing.breadcrumb')

            @isset ($action)
            
                <div class="ml-auto">
                    {{ $action }}
                </div>

            @endisset

        </div>


        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
            
            {{$slot}}

        </div>
    </div>

    @stack('modals')

    @livewireScripts

    @stack('js')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>

        Livewire.on('sweetAlert', data => {    
            Swal.fire(data)
        })
        
    </script>


    @if (session('flash.sweetAlert'))
    
        <script>
            Swal.fire({!!json_encode(session('flash.sweetAlert'))!!})
        </script>

    @endif
</body>

</html>