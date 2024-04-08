@php

    $links = [
        [
            'name' => 'Dashboard',
            'icon' => 'fa-solid fa-gauge-high',
            'route' => route('billing.dashboard', $company),
            'active' => request()->routeIs('billing.dashboard'),
        ],

        [
            'name' => 'Empresa',
            'icon' => 'fa-solid fa-building',
            'active' => request()->routeIs('billing.companies.*'),
            'submenu' => [
                [
                    'name' => 'Datos de la empresa',
                    'route' => route('billing.companies.information', $company),
                    'active' => request()->routeIs('billing.companies.information'),
                ],

                [
                    'name' => 'Credenciales',
                    'route' => route('billing.companies.credentials', $company),
                    'active' => request()->routeIs('billing.companies.credentials'),
                ],

                [
                    'name' => 'Credenciales API',
                    'route' => route('billing.companies.api-credentials', $company),
                    'active' => request()->routeIs('billing.companies.api-credentials'),
                ],

                [
                    'name' => 'Certificado',
                    'route' => route('billing.companies.certificate', $company),
                    'active' => request()->routeIs('billing.companies.certificate'),
                ],
            ]
        ],

        [
            'name' => 'Sucursales / Series',
            'icon' => 'fa-solid fa-store',
            'route' => route('billing.branches.index', $company),
            'active' => request()->routeIs('billing.branches.*'),
        ],

        [
            'name' => 'Usuarios',
            'icon' => 'fa-solid fa-user',
            'route' => route('billing.users.index', $company),
            'active' => request()->routeIs('billing.users.*'),
        ],

        [
            'name' => 'Comprobantes',
            'icon' => 'fa-solid fa-receipt',
            'active' => request()->routeIs('billing.documents.invoices.*'),
            'submenu' => [
                [
                    'icon' => 'fa-regular fa-eye',
                    'name' => 'Ver comprobantes',
                    'route' => route('billing.documents.invoices.index', $company),
                    'active' => request()->routeIs('billing.documents.invoices.index'),
                ],

                [
                    'icon' => 'fa-solid fa-plus',
                    'name' => 'Emitir factura',
                    'route' => route('billing.documents.invoices.factura.create', $company),
                    'active' => request()->routeIs('billing.documents.invoices.factura.create'),
                ],

                [
                    'icon' => 'fa-solid fa-plus',
                    'name' => 'Emitir boleta',
                    'route' => route('billing.documents.invoices.boleta.create', $company),
                    'active' => request()->routeIs('billing.documents.invoices.boleta.create'),
                ],

                [
                    'icon' => 'fa-solid fa-plus',
                    'name' => 'Nota de crédito',
                    'route' => route('billing.documents.invoices.nota-credito.create', $company),
                    'active' => request()->routeIs('billing.documents.invoices.nota-credito.create'),
                ],

                [
                    'icon' => 'fa-solid fa-plus',
                    'name' => 'Nota de débito',
                    'route' => route('billing.documents.invoices.nota-debito.create', $company),
                    'active' => request()->routeIs('billing.documents.invoices.nota-debito.create'),
                ],
            ]
        ],
        [
            'name' => 'Guías de remisión',
            'icon' => 'fa-solid fa-truck',
            'active' => request()->routeIs('billing.documents.guides.*'),
            'submenu' => [
                [
                    'icon' => 'fa-regular fa-eye',
                    'name' => 'Ver guías',
                    'route' => route('billing.documents.guides.index', $company),
                    'active' => request()->routeIs('billing.documents.guides.index'),
                ],

                [
                    'icon' => 'fa-solid fa-plus',
                    'name' => 'Emitir guía',
                    'route' => route('billing.documents.guides.create', $company),
                    'active' => request()->routeIs('billing.documents.guides.create'),
                ],
            ]
        ]
    ];
    
@endphp

<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    :class="{
        'translate-x-0 ease-out': open,
        '-translate-x-full ease-in': !open
    }"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            @foreach ($links as $link)
                <li>

                    @isset($link['submenu'])
                        <div x-data="{open: {{$link['active'] ? 'true' : 'false'}}}">

                            <button type="button"
                                x-on:click="open = !open"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ $link['active'] ? 'bg-gray-100' : 'hover:bg-gray-100' }}"
                                aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">

                                <span class="inline-flex w-6 h-6 justify-center items-center">
                                    <i class="{{ $link['icon'] }} text-gray-500"></i>
                                </span>
                                <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>
                                    {{ $link['name'] }}
                                </span>

                                <i class="fa-solid fa-angle-down" :class="{
                                    'fa-angle-down': !open,
                                    'fa-angle-up': open,
                                }"></i>

                            </button>

                            <ul class="hidden py-2 space-y-2" :class="{
                                'hidden': !open,
                            }">
                                @foreach ($link['submenu'] as $link)

                                    <li>
                    
                                        <a href="{{ $link['route'] }}"
                                            class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-8 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ $link['active'] ? 'bg-gray-100' : 'hover:bg-gray-100' }}">

                                            @isset ($link['icon'])
                                                
                                                <span class="inline-flex w-6 h-6 justify-center items-center mr-2">
                                                    <i class="{{ $link['icon'] }} text-gray-500"></i>
                                                </span>

                                            @endisset

                                            <span>
                                                {{ $link['name'] }}
                                            </span>
                                        </a>
                                    </li>

                                @endforeach
                                    
                            </ul>
                        </div>
                    @else

                        <a href="{{ $link['route'] }}"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 {{ $link['active'] ? 'bg-gray-100' : 'hover:bg-gray-100' }}">

                            <span class="inline-flex w-6 h-6 justify-center items-center">
                                <i class="{{ $link['icon'] }} text-gray-500"></i>
                            </span>

                            <span class="ml-3">
                                {{ $link['name'] }}
                            </span>
                        </a>

                    @endisset
                </li>
            @endforeach

        </ul>
    </div>
</aside>