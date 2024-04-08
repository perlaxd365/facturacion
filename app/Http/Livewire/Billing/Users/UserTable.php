<?php

namespace App\Http\Livewire\Billing\Users;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class UserTable extends DataTableComponent
{
    public $company;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable()
                ->collapseOnTablet(),

            Column::make("Name", "name")
                ->sortable()
                ->searchable(),

            Column::make("Email", "email")
                ->sortable()
                ->searchable(),

            Column::make("Created at", "created_at")
                ->sortable()
                ->collapseOnTablet(),

            LinkColumn::make('Action')
                ->title(fn($row) => 'Edit')
                ->location(fn($row) => route('billing.users.edit', [$this->company, $row]))
                ->collapseOnTablet()
        ];
    }

    public function builder(): Builder
    {
        return User::query()
            ->whereHas('companies', function ($query) {
                $query->where('company_id', $this->company->id);
            });
    }
}
