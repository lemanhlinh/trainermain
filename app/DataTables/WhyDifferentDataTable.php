<?php

namespace App\DataTables;

use App\Models\WhyDifferent;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class WhyDifferentDataTable extends DataTable
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
                $url = route('admin.why-different.changeActive', $q->id);
                $status = $q->active === WhyDifferent::STATUS_ACTIVE ? 'checked' : null;
                return view('admin.components.buttons.change_status', [
                    'url' => $url,
                    'lowerModelName' => 'why-different',
                    'status' => $status,
                ])->render();
            })
            ->editColumn('created_at', function ($q) {
                return Carbon::parse($q->created_at)->format('H:i:s Y/m/d');
            })
            ->editColumn('updated_at', function ($q) {
                return Carbon::parse($q->updated_at)->format('H:i:s Y/m/d');
            })
            ->addColumn('action', function ($q) {
                $urlEdit = route('admin.why-different.edit', $q->id);
                $urlDelete = route('admin.why-different.destroy', $q->id);
                $lowerModelName = strtolower(class_basename(new WhyDifferent()));
                return view('admin.components.buttons.edit', compact('urlEdit'))->render() . view('admin.components.buttons.delete', compact('urlDelete', 'lowerModelName'))->render();
            })->rawColumns(['active','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\WhyDifferent $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(WhyDifferent $model)
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
                    ->setTableId('whydifferent-table')
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
            Column::make('title')->title(trans('form.why_different.title')),
            Column::make('icon')->title(trans('form.why_different.icon'))->render([
                'renderImage(data)'
            ]),
            Column::make('description')->title(trans('form.why_different.description')),
            Column::make('ordering')->title(trans('form.why_different.ordering')),
            Column::make('display_page')->title(trans('form.why_different.display_page'))->render([
                'renderPageViewValue(data)'
            ]),
            Column::make('active')->title(trans('form.article.active')),
            Column::make('created_at')->title(trans('form.created_at')),
            Column::make('updated_at')->title(trans('form.updated_at')),
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
        return 'WhyDifferent_' . date('YmdHis');
    }
}
