<x-billing-layout :company="$company"
:breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => route('billing.dashboard', $company),
    ],
    [
        'name' => 'Certificado',
    ]
]">

    <x-wire-card>


        @if ($company->certificate)
            <x-label class="mb-2">
                Certificado
            </x-label>

            <div class="mb-6">

                <div class="relative">
                    <div class="px-6 py-4 border h-36 overflow-auto" x-data="{
                    
                        copied: false,
                    
                        copyToClipboard() {
                    
                            let textarea = document.createElement('textarea');
                            textarea.value = this.$refs.certificate.innerText;
                            document.body.appendChild(textarea);
                            textarea.select();
                            document.execCommand('copy');
                            document.body.removeChild(textarea);
                    
                            this.copied = true;
                    
                            setTimeout(() => {
                                this.copied = false;
                            }, 2000);
                        }
                    }">

                        <div class="absolute top-4 right-8">
                            <button type="button" x-on:click="copyToClipboard()"
                                class="bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg shadow-lg">
                                <i class="fa-solid fa-copy mr-2"></i>
                                {{-- Copiar --}}
                                <span x-text="copied ? '!Copiado!' : 'Copiar'"></span>
                            </button>
                        </div>

                        <div x-ref="certificate">

                            <pre class="text-xs text-gray-600"><code>{{ $company->certificate }}</code></pre>

                        </div>
                    </div>
                </div>

            </div>
        @endif


        <form action="{{route('billing.companies.certificate.store', $company)}}" 
            method="POST"
            enctype="multipart/form-data">

            @csrf

            <div class="mb-4">
                <x-wire-input label="Seleccione su certificado digital en formato PFX o P12"
                    type="file" 
                    accept=".pem" 
                    name="certificate" />
            </div>

            <div class="flex justify-end items-center">

                <x-button>
                    Actualizar
                </x-button>

            </div>
        </form>

    </x-wire-card>

</x-billing-layout>