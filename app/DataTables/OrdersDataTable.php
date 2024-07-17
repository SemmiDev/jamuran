<?php

namespace App\DataTables;

use App\Models\Order;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class OrdersDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($row) {
                return view('admin.orders.action', ['row' => $row]);
            })
            ->editColumn('status', function ($order) {
                switch ($order->status) {
                    case 'belum_membayar':
                        return '<span class="text-error">Belum Membayar</span>';
                    case 'sudah_membayar':
                        return '<span class="text-info">Sudah Membayar</span>';
                    case 'verifikasi':
                        return '<span class="text-info">Belum Membayar</span>';
                    case 'dikirim':
                        return '<span class="text-info">Dikirim</span>';
                    case 'selesai':
                        return '<span class="text-success">Selesai</span>';
                    default:
                        return 'Unknown';
                }
            })
            ->addColumn('buyer_name', function ($order) {
                return $order->user->name;
            })
            ->addIndexColumn() // Add this line to include an index column
            ->setRowId('id')
            ->rawColumns(['status']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Order $model): QueryBuilder
    {
        $status = request()->get('status');
        return $model
            ->newQuery()
            ->with('user')
            ->where('status', $status);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('orders-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('DT_RowIndex')
                ->title('#') // Set the title of the index column
                ->orderable(false)
                ->searchable(false),
            Column::make('buyer_name')
                ->title('Nama Pembeli'),
            Column::make('address')
                ->title('Alamat'),
            Column::make('total_qty')
                ->title('Jumlah Barang'),
            Column::make('total_price')
                ->title('Total Harga'),
            Column::make('status')
                ->title('Status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center')
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Orders_' . date('YmdHis');
    }
}
