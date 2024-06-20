<?php

namespace App\DataTables;

use App\Models\Pemesanan;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PemesananDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('subtotal', function ($row) {
                $subtotal = $row->pemesananProduks->sum(function ($produk) {
                    return $produk->harga * $produk->jumlah;
                });
                return 'Rp ' . number_format($subtotal, 0, ',', '.');
            })
            ->addColumn('action', function ($row) {
                $editUrl = route('admin.pemesanan.edit', $row->id);
                return '
                    <a href="' . $editUrl . '" class="btn btn-sm btn-primary">
                        <img src="' . asset('icons/pen-to-square-solid.svg') . '" alt="Edit Icon" class="icon"> Edit
                    </a>
                    ';
            })
            ->rawColumns(['action'])
            ->setRowId('id');
    }

    public function query(Pemesanan $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('pemesanan-table')
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
            Column::make('nama_penerima')->title('Nama Penerima'),
            Column::make('alamat')->title('Alamat'),
            Column::make('ongkir_id')->title('Ongkir ID'),
            Column::make('kota')->title('Kota'),
            Column::make('kode_pos')->title('Kode Pos'),
            Column::make('no_telp')->title('No Telp'),
            Column::make('subtotal')->title('Subtotal'),
            Column::make('status_bayar')->title('Status Bayar'),
            Column::make('created_at')->title('Dibuat Pada'),
            Column::make('updated_at')->title('Terakhir Diubah'),
        ];
    }

    protected function filename(): string
    {
        return 'Pemesanan_' . date('YmdHis');
    }
}