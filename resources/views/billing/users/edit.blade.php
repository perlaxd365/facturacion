<x-billing-layout :company="$company"
:breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => route('billing.dashboard', $company),
    ],
    [
        'name' => $user->name,
    ]
]">


    <x-wire-card x-data="{
        'is_admin': {{old('is_admin', $is_admin)}},
    }">

        <form action="{{route('billing.users.update', [$company, $user])}}" method="POST">

            @csrf
            @method('PUT')

            <x-validation-errors class="mb-4" />

            <div class="mb-4">
                <x-wire-native-select
                    label="Rol"
                    name="is_admin" 
                    x-model="is_admin">

                    <option value="1">Administrador</option>
                    <option value="0">Colaborador</option>

                </x-wire-native-select>
            </div>

            <template x-if="is_admin == 0">
                <div class="mb-4">
                    <x-label class="mb-1">
                        Sucursales
                    </x-label>

                    @foreach ($branches as $branch)

                        <div class="flex items-center space-x-2">
                            <x-checkbox name="branches[]" 
                                :value="$branch->id" 
                                :id="'branch-' . $branch->id"
                                :checked="in_array($branch->id, old('branches', $assigned_branches))" />

                            <label for="{{'branch-' . $branch->id}}">
                                {{$branch->name}}
                            </label>
                        </div>

                    @endforeach
                </div>
            </template>

            <div class="flex justify-end">

                <x-button>
                    Actualizar
                </x-button>

            </div>

        </form>

    </x-wire-card>

</x-billing-layout>