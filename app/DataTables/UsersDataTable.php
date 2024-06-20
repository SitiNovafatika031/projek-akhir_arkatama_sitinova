<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $editUrl = route('admin.users.edit', $row->id);
                $deleteUrl = route('admin.users.destroy', $row->id);
                return '
                    <a href="' . $editUrl . '" class="btn btn-sm btn-primary">
                        <img src="' . asset('icons/pen-to-square-solid.svg') . '" alt="Edit Icon" class="icon"> Edit
                    </a>
                    <form action="' . $deleteUrl . '" method="POST" style="display:inline-block;">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="submit" class="btn btn-sm btn-danger">
                            <img src="' . asset('icons/trash-solid.svg') . '" alt="Delete Icon" class="icon"> Delete
                        </button>
                    </form>
                ';
            })
            ->rawColumns(['action'])
            ->setRowId('id');
    }

    public function query(User $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('users-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->addAction(['width' => '150px'])
                    ->orderBy(1)
                    ->selectStyleSingle();
    }

    public function getColumns(): array
    {
        return [
            Column::computed('DT_RowIndex')->title('No')->width(60),
            Column::make('name')->title('Name'),
            Column::make('email')->title('Email'),
            Column::make('type')->title('Type'),
            Column::make('created_at')->title('Created At'),
            Column::make('updated_at')->title('Updated At'),
        ];
    }

    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}
