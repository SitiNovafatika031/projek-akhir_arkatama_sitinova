<?php

namespace App\DataTables;

use App\Models\Pembayaran;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PembayaranDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $editUrl = route('admin.pembayaran.edit', $row->id);
                $deleteUrl = route('admin.pembayaran.delete', $row->id); 
                return '
                    <a href="' . $editUrl . '" class="btn btn-sm btn-primary">
                        <img src="' . asset('icons/pen-to-square-solid.svg') . '" alt="Edit Icon" class="icon"> Edit
                    </a>
                    <a href="' . $deleteUrl . '" class="btn btn-sm btn-danger">
                        <img src="' . asset('icons/trash-solid.svg') . '" alt="Hapus Icon" class="icon"> Hapus
                    </a>
                ';
            })
            ->editColumn('struk_pembayaran', function ($pembayaran) {
                if ($pembayaran->struk_pembayaran) {
                    $url = asset('storage/' . $pembayaran->struk_pembayaran);
                    return '<a href="'. $url .'" target="_blank" style="text-decoration: none;">Lihat Struk</a>';
                }
                return 'Tidak ada struk';
            })
            ->rawColumns(['struk_pembayaran', 'action'])
            ->setRowId('id');
    }

    public function query(Pembayaran $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('pembayaran-table')
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
            Column::make('pemesanan_id')->title('Pemesanan ID'),
            Column::make('nama_pelanggan')->title('Nama Pelanggan'),
            Column::make('jumlah_transfer')->title('Jumlah Transfer'),
            Column::make('nama_bank')->title('Nama Bank'),
            Column::make('keterangan')->title('Keterangan'),
            Column::make('tanggal')->title('Tanggal'),
            Column::make('struk_pembayaran')->title('Struk Pembayaran'),
            Column::make('created_at')->title('Dibuat Pada'),
            Column::make('updated_at')->title('Terakhir Diubah'),
        ];
    }

    protected function filename(): string
    {
        return 'Pembayaran_' . date('YmdHis');
    }
}