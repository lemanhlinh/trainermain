<div class="btn-group">
    <button class="btn btn-sm btn-outline-warning" data-toggle="dropdown" aria-expanded="false"
            title="{{ trans('form.order.change_status') }}">
        <i class="fa fa-recycle" aria-hidden="true"></i>
    </button>
    <ul class="dropdown-menu dropdown-menu-status" data-table-id="@if(isset($lowerModelName)) #{{ $lowerModelName }}-table @endif">
        <li class="{{ ($q->status === \App\Models\Order::STATUS_WAITING )?'bg-primary':'' }}">
            <a href="javascript:void(0);" class="js-change-order-status"
               data-order-status-name="{{ trans('form.order.status_waiting') }}"
               data-url-change-status="{{ route('admin.order.changeStatus', [$q->id, \App\Models\Order::STATUS_WAITING]) }}"><i
                    class="fa fa-recycle"></i> @lang('form.order.status_waiting')</a>
            <hr>
        </li>
        <li class="{{ ($q->status === \App\Models\Order::STATUS_SUCCESS )?'bg-primary':'' }}">
            <a href="javascript:void(0);" class="js-change-order-status"
               data-order-status-name="{{ trans('form.order.status_success') }}"
               data-url-change-status="{{ route('admin.order.changeStatus', [$q->id, \App\Models\Order::STATUS_SUCCESS]) }}"><i
                    class="fa fa-recycle"></i> @lang('form.order.status_success')</a>
            <hr>
        </li>
        <li class="{{ ($q->status === \App\Models\Order::STATUS_CANCEL )?'bg-primary':'' }}">
            <a href="javascript:void(0);" class="js-change-order-status"
               data-order-status-name="{{ trans('form.order.status_cancel') }}"
               data-url-change-status="{{ route('admin.order.changeStatus', [$q->id, \App\Models\Order::STATUS_CANCEL]) }}"><i
                    class="fa fa-recycle"></i> @lang('form.order.status_cancel')</a>
            <hr>
        </li>
    </ul>
</div>
