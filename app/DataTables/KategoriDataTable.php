<?php

namespace App\DataTables;

use App\Models\Kategori;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class KategoriDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('gambar', function ($row) {
                return '<img src="' . asset('storage/' . $row->gambar) . '" alt="Gambar Kategori" style="width: 50px; height: 50px;">';
            })
            ->addColumn('action', function ($row) {
                $editUrl = route('admin.kategori.edit', $row->id);
                $deleteUrl = route('admin.kategori.destroy', $row->id);
                return '
                    <a href="' . $editUrl . '" class="btn btn-sm btn-primary">
                        <img src="' . asset('icons/pen-to-square-solid.svg') . '" alt="Edit Icon" class="icon"> Edit
                    </a>
                    <form action="' . $deleteUrl . '" method="POST" style="display:inline-block;">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="submit" class="btn btn-sm btn-danger">
                            <img src="' . asset('icons/trash-solid.svg') . '" alt="Hapus Icon" class="icon"> Hapus
                        </button>
                    </form>
                ';
            })
            ->rawColumns(['gambar', 'action'])
            ->setRowId('id');
    }

    public function query(Kategori $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('kategori-table')
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
            Column::make('nama')->title('Nama'),
            Column::make('gambar')->title('Gambar'),
            Column::make('updated_at')->title('Terakhir diubah'),
        ];
    }

    protected function filename(): string
    {
        return 'Kategori_' . date('YmdHis');
    }
}