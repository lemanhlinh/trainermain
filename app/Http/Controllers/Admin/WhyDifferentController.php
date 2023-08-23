<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WhyDifferent;
use Illuminate\Http\Request;
use App\DataTables\WhyDifferentDataTable;
use App\Repositories\Contracts\WhyDifferentInterface;
use App\Http\Requests\Why_Different\CreateWhyDifferent;
use App\Http\Requests\Why_Different\UpdateWhyDifferent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class WhyDifferentController extends Controller
{

    protected $whyDifferentRepository;

    public function __construct(WhyDifferentInterface $whyDifferentRepository)
    {
        $this->whyDifferentRepository = $whyDifferentRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(WhyDifferentDataTable $dataTable)
    {
        return $dataTable->render('admin.why-different.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.why-different.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateWhyDifferent $req)
    {
        DB::beginTransaction();
        try {
            $data = $req->validated();
            $this->whyDifferentRepository->create($data);
            DB::commit();
            Session::flash('success', trans('message.create_why_different_success'));
            return redirect()->back();
        } catch (\Exception $ex) {
            DB::rollBack();
            \Log::info([
                'message' => $ex->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            Session::flash('danger', trans('message.create_why_different_error'));
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WhyDifferent  $whyDifferent
     * @return \Illuminate\Http\Response
     */
    public function show(WhyDifferent $whyDifferent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WhyDifferent  $whyDifferent
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $whyDifferent = $this->whyDifferentRepository->getOneById($id);
        return view('admin.why-different.update', compact('whyDifferent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WhyDifferent  $whyDifferent
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateWhyDifferent $req)
    {
        DB::beginTransaction();
        try {
            $data = $req->validated();
            $whyDifferent = $this->whyDifferentRepository->getOneById($id);
            $whyDifferent->update($data);
            DB::commit();
            Session::flash('success', trans('message.update_why_different_success'));
            return redirect()->route('admin.why-different.edit', $id);
        } catch (\Exception $exception) {
            \Log::info([
                'message' => $exception->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            Session::flash('danger', trans('message.update_why_different_error'));
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WhyDifferent  $whyDifferent
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->whyDifferentRepository->delete($id);

        return [
            'status' => true,
            'message' => trans('message.delete_why_different_success')
        ];
    }

    /**
     * @param $id
     * @return array
     */
    public function changeActive($id)
    {
        $whyDifferent = $this->whyDifferentRepository->getOneById($id);
        $whyDifferent->update(['active' => !$whyDifferent->active]);
        return [
            'status' => true,
            'message' => trans('message.change_active_why_different_success')
        ];
    }
}
