<?php

namespace App\DataTables;

use App\Models\Order;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use function MongoDB\BSON\toJSON;

class OrderDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('product_name', function ($q) {
                return ($q->orderItem)->product_title;
            })
            ->addColumn('product_price', function ($q) {
                return ($q->orderItem)->product_price;
            })
            ->editColumn('gender', function ($q) {
                return ($q->gender == 0)?'Nam':'Nữ';
            })
            ->editColumn('where_learn', function ($q) {
                return ($q->gender == 0)?'Học online':'Học tại trung tâm';
            })
            ->editColumn('method_pay', function ($q) {
                return ($q->method_pay == 1)?'Qua VNPay(Chưa triển khai)':'COD';
            })
            ->editColumn('created_at', function ($q) {
                return Carbon::parse($q->created_at)->format('H:i:s Y/m/d');
            })
            ->editColumn('change_order_status', function ($q) {
                $lowerModelName = strtolower(class_basename(new Order()));
                return view('admin.components.buttons.change_order_status', compact('q', 'lowerModelName'))->render();
            })->rawColumns(['change_order_status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Order $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Order $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('order-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(0);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('full_name')->title(trans('form.order.full_name')),
            Column::make('gender')->title(trans('form.order.gender')),
            Column::make('where_learn')->title(trans('form.order.where_learn')),
            Column::make('email')->title(trans('form.order.email')),
            Column::make('phone')->title(trans('form.order.phone')),
            Column::make('address')->title(trans('form.order.address')),
            Column::make('note')->title(trans('form.order.note')),
            Column::make('method_pay')->title(trans('form.order.method_pay')),
            Column::computed('product_name')->title(trans('form.order.product_name')),
            Column::computed('product_price')->title(trans('form.order.product_price')),
            Column::make('created_at')->title(trans('form.created_at')),
            Column::make('status')->title(trans('form.order.status'))->render([
                'renderLabelOrderStatus(data)'
            ]),
            Column::computed('change_order_status')->title(trans('form.order.change_order_status'))
//            Column::computed('action')
//                ->exportable(false)
//                ->printable(false)
//                ->width(60)
//                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Order_' . date('YmdHis');
    }
}
