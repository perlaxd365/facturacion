<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Empresa
        </h2>
    </x-slot>

    <x-container class="py-12 px-4">
@if (auth()->user()->email == "perlaxd365@gmail.com")
    
<div class="flex justify-end mb-8">
    <x-wire-button dark href="{{route('companies.create')}}">
        Agregar empresa
    </x-wire-button>
</div>
@endif

        @livewire('companies.company-table')

    </x-container>

</x-app-layout>