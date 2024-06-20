<?php

namespace App\DataTables;

use App\Models\Cart;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CartDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addIndexColumn()
        ->addColumn('product_name', function ($row) {
            return $row->product->nama;
        })
        ->addColumn('quantity', function ($row) {
            return $row->quantity;
        })
        ->addColumn('subtotal', function ($row) {
            return 'Rp ' . number_format($row->product->harga * $row->quantity, 0, ',', '.');
        })
        ->addColumn('action', function ($row) {
            $deleteUrl = route('cart.remove', $row->id);
            return '
                <form action="' . $deleteUrl . '" method="POST" style="display:inline-block;">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '
                    <button type="submit" class="btn btn-sm btn-danger">
                        <img src="' . asset('icons/trash-solid.svg') . '" alt="Delete Icon" class="icon"> Remove
                    </button>
                </form>
            ';
        })
        ->rawColumns(['action'])
        ->setRowId('id');
    }

    public function query(Cart $model): QueryBuilder
    {
        return $model->where('user_id', auth()->id())->with('product')->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('cart-table')
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
            Column::make('product_name')->title('Product Name'),
            Column::make('quantity')->title('Quantity'),
            Column::make('subtotal')->title('Subtotal'),
            Column::computed('action')->title('Action')->width(100)->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'Cart_' . date('YmdHis');
    }
}