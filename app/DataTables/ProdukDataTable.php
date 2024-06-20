<?php

namespace App\DataTables;

use App\Models\Produk;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ProdukDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $editUrl = route('admin.produk.edit', $row->id);
                $deleteUrl = route('admin.produk.destroy', $row->id);
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
            ->editColumn('gambar', function ($produk) {
                $imageUrl = asset('storage/' . $produk->gambar);
                return '<img src="'. $imageUrl .'" alt="Gambar Produk" height="100" width="200">';
            })
            ->rawColumns(['gambar', 'action'])
            ->setRowId('id');
    }

    public function query(Produk $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('produk-table')
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
            Column::make('kategori_id')->title('Kategori ID'),
            Column::make('nama')->title('Nama'),
            Column::make('harga')->title('Harga'),
            Column::make('stok')->title('Stok'),
            Column::make('keterangan')->title('Keterangan'),
            Column::make('gambar')->title('Gambar'),
            Column::make('updated_at')->title('Terakhir Diubah'),
        ];
    }

    protected function filename(): string
    {
        return 'Produk_' . date('YmdHis');
    }
}
