<?php

namespace App\DataTables;

use App\Models\Advisory;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AdvisoryDataTable extends DataTable
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
            ->editColumn('created_at', function ($q) {
                return Carbon::parse($q->created_at)->format('H:i:s Y/m/d');
            })
            ->addColumn('action', 'advisory.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Advisory $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Advisory $model)
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
                    ->setTableId('advisory-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(0)
                    ->buttons(
                        Button::make('excel')
                    )
                    ->parameters($this->getBuilderParameters());
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
            Column::make('full_name')->title(trans('form.advisory.full_name')),
            Column::make('phone')->title(trans('form.advisory.phone')),
            Column::make('email')->title(trans('form.advisory.email')),
            Column::make('why_learn_ielts')->title(trans('form.advisory.why_learn_ielts')),
            Column::make('time_ielts_support')->title(trans('form.advisory.time_ielts_support')),
            Column::make('test_ielts_address')->title(trans('form.advisory.test_ielts_address')),
            Column::make('created_at'),
//            Column::make('updated_at'),
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
        return 'Dang_ky_tu_van_' . date('YmdHis');
    }

    /**
     * Get default builder parameters.
     *
     * @return array
     */
    protected function getBuilderParameters()
    {
        return [
            'dom' => "<'row btn-table '<'col-sm-6'><'col-sm-6 dataTables_filter'B>>".
                "<'row'<'col-sm-6'l><'col-sm-6'f>>" .
                "<'row'<'col-sm-12'tr>>" .
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            'language' => [
                'url' => asset('vendor/datatables/languages/Vietnamese.json')
            ],
        ];
    }
}
