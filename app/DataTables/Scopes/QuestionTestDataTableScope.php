<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;

class QuestionTestDataTableScope implements DataTableScope
{
    /**
     * Apply a query scope.
     *
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
     * @return mixed
     */
    public function apply($query)
    {
        $lesson = request()->input('lesson');
        if (! empty($lesson)) {
            $query->where('lesson_id', $lesson);
        }
        $type = request()->input('type');
        if (! empty($type)) {
            $query->where('type_id', $type);
        }
        return $query;
    }
}
