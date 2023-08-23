<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\MenuCategoryDataTable;
use App\Repositories\Contracts\MenuCategoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Menu\CreateMenuCategory;
use App\Http\Requests\Menu\UpdateMenuCategory;

class MenuCategoryController extends Controller
{
    protected $menuCategoryRepository;

    public function __construct(MenuCategoryInterface $menuCategoryRepository)
    {
        $this->middleware('auth');
        $this->menuCategoryRepository = $menuCategoryRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MenuCategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.menu-category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.menu-category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMenuCategory $req)
    {
        DB::beginTransaction();
        try {
            $data = $req->validated();
            $this->menuCategoryRepository->create($data);
            DB::commit();
            Session::flash('success', trans('message.create_menu_category_success'));
            return redirect()->back();
        } catch (\Exception $ex) {
            DB::rollBack();
            \Log::info([
                'message' => $ex->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);

            Session::flash('danger', trans('message.create_menu_category_error'));
            return redirect()->back();
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
        $menu_category = $this->menuCategoryRepository->getOneById($id);
        return view('admin.menu-category.update', compact('menu_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateMenuCategory $req)
    {
        try {
            $data = $req->validated();
            $category = $this->menuCategoryRepository->getOneById($id);
            $category->update($data);
            Session::flash('success', trans('message.update_menu_category_success'));
            return redirect()->route('admin.menu-category.edit', $id);
        } catch (\Exception $exception) {
            \Log::info([
                'message' => $exception->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            Session::flash('danger', trans('message.update_menu_category_error'));
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
        $this->menuCategoryRepository->delete($id);

        return [
            'status' => true,
            'message' => trans('message.delete_menu_category_success')
        ];
    }
}
