<?php

namespace App\DataTables;

use App\Models\Document;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DocumentDataTable extends DataTable
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
                $url = route('admin.document.changeActive', $q->id);
                $status = $q->active === Document::STATUS_ACTIVE ? 'checked' : null;
                return view('admin.components.buttons.change_status', [
                    'url' => $url,
                    'lowerModelName' => $this->lowerModelName,
                    'status' => $status,
                ])->render();
            })
            ->editColumn('created_at', function ($q) {
                return Carbon::parse($q->created_at)->format('H:i:s Y/m/d');
            })
            ->editColumn('updated_at', function ($q) {
                return Carbon::parse($q->updated_at)->format('H:i:s Y/m/d');
            })
            ->addColumn('checkbox', function ($q) {
                return '<input type="checkbox" class="row-checkbox" value="' . $q->id . '">';
            })
            ->addColumn('action', function ($q) {
                $urlEdit = route('admin.document.edit', $q->id);
                $urlDelete = route('admin.document.destroy', $q->id);
                $lowerModelName = strtolower(class_basename(new Document()));
                return view('admin.components.buttons.edit', compact('urlEdit'))->render() . view('admin.components.buttons.delete', compact('urlDelete', 'lowerModelName'))->render();
            })
            ->rawColumns(['active','checkbox','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Document $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Document $model)
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
                    ->setTableId('document-table')
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
            Column::make('title'),
            Column::make('image')->title(trans('form.document.image'))->render([
                'renderImage(data)'
            ]),
            Column::make('active')->title(trans('form.document.active')),
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
        return 'Document_' . date('YmdHis');
    }
}
