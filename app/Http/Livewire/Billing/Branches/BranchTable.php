<?php

namespace App\Http\Livewire\Billing\Branches;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Branch;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class BranchTable extends DataTableComponent
{
    public $company;

    protected $model = Branch::class;

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
                ->sortable(),

            Column::make("Code", "code")
                ->sortable()
                ->collapseOnTablet(),

            Column::make("Created at", "created_at")
                ->sortable()
                ->format(fn($value) => $value->format('d-m-Y'))
                ->collapseOnTablet(),

            LinkColumn::make('Action')
                ->title(fn() => 'Edit')
                ->location(fn($row) => route('billing.branches.edit', [$this->company, $row]))
                ->collapseOnTablet()
        ];
    }

    public function builder(): Builder
    {
        return Branch::query()
            ->where('company_id', $this->company->id);
    }
}
