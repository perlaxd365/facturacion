<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Empresa
        </h2>
    </x-slot>

    <x-container class="py-12">
        <x-wire-card title="Datos de la empresa">
            @livewire('companies.create')
        </x-wire-card>
    </x-container>

</x-app-layout>