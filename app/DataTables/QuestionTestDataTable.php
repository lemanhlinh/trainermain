<?php

namespace App\DataTables;

use App\Models\QuestionTest;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class QuestionTestDataTable extends DataTable
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
            ->editColumn('active', function ($q) {
                $url = route('admin.question-test.changeActive', $q->id);
                $status = $q->active === QuestionTest::STATUS_ACTIVE ? 'checked' : null;
                return view('admin.components.buttons.change_status', [
                    'url' => $url,
                    'lowerModelName' => 'question-test',
                    'status' => $status,
                ])->render();
            })
            ->editColumn('content', function ($q) {
                return '<div style="width: 500px">'. $q->content.'</div>';
            })
            ->editColumn('type_id', function ($q) {
                return optional($q->typeTest)->name;
            })
            ->editColumn('lesson_id', function ($q) {
                return optional($q->lessonTest)->name;
            })
            ->editColumn('created_at', function ($q) {
                return Carbon::parse($q->created_at)->format('H:i:s Y/m/d');
            })
            ->editColumn('updated_at', function ($q) {
                return Carbon::parse($q->updated_at)->format('H:i:s Y/m/d');
            })
            ->addColumn('action', function ($q) {
                $urlEdit = route('admin.question-test.edit', $q->id);
                $urlDelete = route('admin.question-test.destroy', $q->id);
                $lowerModelName = strtolower(class_basename(new QuestionTest()));
                return view('admin.components.buttons.edit', compact('urlEdit'))->render() . view('admin.components.buttons.delete', compact('urlDelete', 'lowerModelName'))->render();
            })->rawColumns(['active','action','content']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\QuestionTest $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(QuestionTest $model)
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
                    ->setTableId('question-test-table')
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
            Column::make('content'),
            Column::make('type_id')->title(trans('form.question_test.type_id')),
            Column::make('lesson_id')->title(trans('form.question_test.lesson_id')),
            Column::make('active'),
            Column::make('created_at'),
            Column::make('updated_at'),
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
        return 'QuestionTest_' . date('YmdHis');
    }
}
