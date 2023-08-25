<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\RoleDataTable;
use App\Http\Requests\Role\CreateRole;
use App\Http\Requests\Role\UpdateRole;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Repositories\Contracts\RoleInterface;
use App\Repositories\Contracts\PermissionInterface;

class RoleController extends Controller
{
    protected $roleRepository;
    protected $permissionRepository;

    /**
     * UserController constructor.
     * @param RoleInterface $roleRepository
     * @param PermissionInterface $permissionRepository
     */
    public function __construct(RoleInterface $roleRepository, PermissionInterface $permissionRepository)
    {
        $this->middleware('auth');
        $this->permissionRepository = $permissionRepository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param RoleDataTable $dataTable
     * @return \Illuminate\Http\Response
     */
    public function index(RoleDataTable $dataTable)
    {
        return $dataTable->render('admin.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = $this->permissionRepository->getAll();
        return view('admin.roles.create',compact('permissions'));
    }

    /**
     * @param CreateRole $req
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateRole $req)
    {
        DB::beginTransaction();
        try {
            $role = $role = $this->roleRepository->create([
                'name' => \Str::slug($req->display_name, '-'),
                'display_name' => $req->display_name,
            ]);
            $this->roleRepository->updatePermission($role->id, $req->permissions);

            DB::commit();
            Session::flash('success', trans('message.create_role_success'));
            return redirect()->back();
        } catch (\Exception $exception) {
            \Log::error([
                'method' => __METHOD__,
                'line' => __LINE__,
                'context' => $exception->getMessage()
            ]);
            DB::rollBack();
            Session::flash('danger', trans('message.create_role_error'));
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = $this->roleRepository->getOneById($id);
        $permissions = $this->permissionRepository->getAll();
        return view('admin.roles.update', compact('role','permissions'));
    }

    /**
     * @param $id
     * @param UpdateRole $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, UpdateRole $request)
    {
        DB::beginTransaction();
        try {
            $this->roleRepository->update($id, [
                'name' => \Str::slug($request->display_name, '-'),
                'display_name' => $request->display_name,
            ]);
            $this->roleRepository->updatePermission($id, $request->permissions);

            DB::commit();
            Session::flash('success', trans('message.update_role_success'));
            return redirect()->back();
        } catch (\Exception $exception) {
            \Log::error([
                'method' => __METHOD__,
                'line' => __LINE__,
                'context' => $exception->getMessage()
            ]);
            DB::rollBack();
            Session::flash('danger', trans('message.update_role_error'));
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->roleRepository->delete($id);

        return [
            'status' => true,
            'message' => trans('message.delete_role_success')
        ];
    }
}
