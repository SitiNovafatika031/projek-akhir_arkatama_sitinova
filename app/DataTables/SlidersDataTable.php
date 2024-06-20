<?php

namespace App\DataTables;

use App\Models\Slider;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SlidersDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $editUrl = route('admin.slider.edit', $row->id);
                $deleteUrl = route('admin.slider.destroy', $row->id);
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
            ->editColumn('image', function ($slider) {
                $imageUrl = asset('storage/' . $slider->image);
                return '<img src="'. $imageUrl .'" alt="Slider Image" height="200" width="400">';
            })         
            ->rawColumns(['image', 'action']) 
            ->setRowId('id');
    }

    public function query(Slider $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('slider-table')
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
            Column::make('image')->title('Gambar'),
            Column::make('updated_at')->title('Terakhir diubah'),
        ];
    }

    protected function filename(): string
    {
        return 'Sliders_' . date('YmdHis');
    }
}
