<?php

namespace App\DataTables;

use App\Models\Setting;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SettingDataTable extends DataTable
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
                $url = route('admin.setting.changeActive', $q->id);
                $status = $q->active === Setting::STATUS_ACTIVE ? 'checked' : null;
                return view('admin.components.buttons.change_status', [
                    'url' => $url,
                    'lowerModelName' => 'article',
                    'status' => $status,
                ])->render();
            })
            ->editColumn('created_at', function ($q) {
                return Carbon::parse($q->created_at)->format('H:i:s Y/m/d');
            })
            ->addColumn('display', function ($q) {
                if ($q->type == 2) {
                    return '<img src="' . asset($q->value) . '" width="200px" >';
                } elseif ($q->type == 3) {
                    return '<span class="text-red">Nội dung editor</span>';
                } else {
                    return $q->value;
                }
            })
            ->addColumn('action', function ($q){
                $urlEdit = route('admin.setting.edit', $q->id);
                $urlDelete = route('admin.setting.destroy', $q->id);
                $lowerModelName = strtolower(class_basename(new Setting()));
                return view('admin.components.buttons.edit', compact('urlEdit'))->render();
            })
            ->rawColumns(['active','display', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Setting $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Setting $model)
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
                    ->setTableId('setting-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(0, 'asc');
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
            Column::make('name')->title(trans('form.setting.name')),
            Column::make('key')->title(trans('form.setting.key')),
//            Column::make('value'),
            Column::make('description')->title(trans('form.setting.description')),
            Column::make('display')->title(trans('form.setting.display')),
            Column::make('active')->title(trans('form.article.active')),
            Column::make('created_at'),
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
        return 'Setting_' . date('YmdHis');
    }
}
