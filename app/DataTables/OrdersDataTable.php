<?php

namespace App\DataTables;

use App\Models\Order;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
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
            ->addColumn('action', function ($order) {
                return view('admin.orders.action', ["row" => $order]);
            })
            ->editColumn('status', function ($order) {
                switch ($order->status) {
                    case 'belum_membayar':
                        return '<span class="text-danger">Belum Membayar</span>';
                    case 'sudah_membayar':
                    case 'verifikasi':
                    case 'dikirim':
                        return '<span class="text-info">Dalam Proses</span>';
                    case 'selesai':
                        return '<span class="text-success">Selesai</span>';
                    default:
                        return 'Unknown';
                }
            })
            ->addColumn('buyer_name', function ($order) {
                return $order->user->name;
            })
            ->addIndexColumn()
            ->setRowId('id')
            ->rawColumns(['status', 'action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Order $model): QueryBuilder
    {
        $status = request()->get('status');

        // Query to fetch orders with items and user information
        return $model
            ->newQuery()
            ->with('items')
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
    protected function getColumns(): array
    {
        return [
            Column::computed('DT_RowIndex')
                ->title('#')
                ->orderable(false)
                ->searchable(false),
            Column::make('buyer_name')
                ->title('Nama Pembeli'),
            Column::make('address')
                ->title('Alamat'),
            Column::make('status')
                ->title('Status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
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
