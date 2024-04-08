<?php

namespace App\Http\Livewire\Companies;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Company;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class CompanyTable extends DataTableComponent
{

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        # code...
        return [
            Column::make("Id", "id")
                ->sortable(),

            Column::make("Domain", "domain")
                ->sortable(),

            Column::make("Ruc", "ruc")
                ->sortable(),

            Column::make("Razon social", "razonSocial")
                ->sortable(),

            Column::make("Nombre comercial", "nombreComercial")
                ->sortable(),

            Column::make("Created at", "created_at")
                ->sortable()
                ->format(fn ($value) => $value->format('d/m/Y')),

            LinkColumn::make('Action')
                ->title(fn ($row) => 'Edit')
                ->location(fn ($row) => route('billing.dashboard', $row)),
        ];
    }

    public function builder(): Builder
    {

        if (auth()->user()->email == "perlaxd365@gmail.com") {
            # code...
            return Company::query()
                ->whereHas('users', function ($query) {
                    $query->where('user_id', auth()->id());
                });
        } else {
            return Company::query()
                ->join('company_user', 'company_user.company_id', 'companies.id')
                ->where('company_user.user_id', auth()->id());
        }
    }
}
