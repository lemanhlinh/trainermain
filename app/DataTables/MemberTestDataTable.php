<?php

namespace App\DataTables;

use App\Models\Course;
use App\Models\MemberTest;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MemberTestDataTable extends DataTable
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
            ->editColumn('time_end', function ($q) {
                return Carbon::parse($q->created_at)->format('H:i:s Y/m/d');
            })
            ->editColumn('time_end', function ($q) {
                return Carbon::parse($q->updated_at)->format('H:i:s Y/m/d');
            })
            ->addColumn('action', function ($q) {
                $urlEdit = route('admin.member-test.edit', $q->id);
                $urlDelete = route('admin.member-test.destroy', $q->id);
                $lowerModelName = strtolower(class_basename(new Course()));
                return view('admin.components.buttons.edit', compact('urlEdit'))->render() . view('admin.components.buttons.delete', compact('urlDelete', 'lowerModelName'))->render();
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\MemberTest $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(MemberTest $model)
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
                    ->setTableId('member-test-table')
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
            Column::make('full_name')->title(trans('form.member_test.full_name')),
            Column::make('phone')->title(trans('form.member_test.phone')),
            Column::make('email')->title(trans('form.member_test.email')),
            Column::make('lesson_name')->title(trans('form.member_test.lesson_name')),
            Column::make('correct')->title(trans('form.member_test.correct')),
            Column::make('total_questions')->title(trans('form.member_test.total_questions')),
            Column::make('time_start')->title(trans('form.member_test.time_start')),
            Column::make('time_end')->title(trans('form.member_test.time_end')),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'MemberTest_' . date('YmdHis');
    }
}
