<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\DataTables\OrderDataTable;
use Illuminate\Support\Facades\DB;
use App\Repositories\Contracts\OrderInterface;

class OrderController extends Controller
{
    protected $orderRepository;

    public function __construct(OrderInterface $orderRepository)
    {
        $this->middleware('auth');
        $this->orderRepository = $orderRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(OrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    /**
     * @param $id
     * @param $status
     * @return array
     */
    public function changeStatus($id, $status)
    {
        DB::beginTransaction();
        try {
            $order = $this->orderRepository->getOneById($id);
            $order->update(['status' => $status]);
            $order = $order->fresh();
//            if ($order->status === Order::STATUS_PASS || $order->status === Order::STATUS_LEARNING_MAKE_FILE) {
//                $trainees = $this->traineeRepository->getByOrderAndOrderStatus($order->id, $status);
//                dispatch(new SendTraineePassedEmail($order, $trainees));
//            }

            DB::commit();
            return [
                'status' => true,
                'message' => trans('message.change_order_status_success')
            ];
        } catch (\Exception $ex) {
            DB::rollBack();
            return [
                'message' => $ex->getMessage()
            ];
        }
    }
}
