<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use App\DataTables\ProgramDataTable;
use App\Repositories\Contracts\ProgramInterface;
use App\Http\Requests\Program\CreateProgram;
use App\Http\Requests\Program\UpdateProgram;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ProgramController extends Controller
{

    protected $programRepository;

    public function __construct(ProgramInterface $programRepository)
    {
        $this->programRepository = $programRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProgramDataTable $dataTable)
    {
        return $dataTable->render('admin.program.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.program.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProgram $req)
    {
        DB::beginTransaction();
        try {
            $data = $req->validated();
            $this->programRepository->create($data);
            DB::commit();
            Session::flash('success', trans('message.create_program_success'));
            return redirect()->back();
        } catch (\Exception $ex) {
            DB::rollBack();
            \Log::info([
                'message' => $ex->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            Session::flash('danger', trans('message.create_program_error'));
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function show(Program $program)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $program = $this->programRepository->getOneById($id);
        return view('admin.program.update', compact('program'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateProgram $req)
    {
        DB::beginTransaction();
        try {
            $data = $req->validated();
            $program = $this->programRepository->getOneById($id);
            $program->update($data);
            DB::commit();
            Session::flash('success', trans('message.update_program_success'));
            return redirect()->route('admin.program.edit', $id);
        } catch (\Exception $exception) {
            \Log::info([
                'message' => $exception->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            Session::flash('danger', trans('message.update_program_error'));
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->programRepository->delete($id);

        return [
            'status' => true,
            'message' => trans('message.delete_program_success')
        ];
    }

    /**
     * @param $id
     * @return array
     */
    public function changeActive($id)
    {
        $program = $this->programRepository->getOneById($id);
        $program->update(['active' => !$program->active]);
        return [
            'status' => true,
            'message' => trans('message.change_active_program_success')
        ];
    }
}
