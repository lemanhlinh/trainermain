<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\ArticleInterface;
use App\Repositories\Contracts\MenuCategoryInterface;
use App\Repositories\Contracts\MenuInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Menu\CreateMenu;
use App\Repositories\Contracts\PageInterface;

class MenuController extends Controller
{
    protected $articleRepository, $menuCategoryRepository, $menuRepository;

    public function __construct(
        ArticleInterface $articleRepository,
        MenuCategoryInterface $menuCategoryRepository,
        MenuInterface $menuRepository,
        PageInterface $pageRepository
    )
    {
        $this->articleRepository = $articleRepository;
        $this->menuCategoryRepository = $menuCategoryRepository;
        $this->menuRepository = $menuRepository;
        $this->pageRepository = $pageRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category_id = request()->query('category_id');
        $articles = $this->articleRepository->getAll();
        $menu_categories = $this->menuCategoryRepository->getAll();
        $pages = $this->pageRepository->getAll();
        if ($menu_categories->count() === 0){
            Session::flash('danger', 'Chưa có nhóm menu nào');
            return redirect()->route('admin.menu-category.index');
        }
        if (empty($category_id)){
            $category_id = $menu_categories->first()->id;
        }
        $menu = $this->menuRepository->getMenusByCategoryId($category_id)->toTree();
        return view('admin.menu.index', compact('articles','menu_categories','menu','category_id','pages'));
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
    public function store(CreateMenu $req)
    {
        DB::beginTransaction();
        try {
            $data = $req->validated();
            $menu = $this->menuRepository->create($data);
            DB::commit();
            $id_menu = [
                'id' => $menu->id
            ];
            return $id_menu;
        } catch (\Exception $ex) {
            DB::rollBack();
            \Log::info([
                'message' => $ex->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            return false;
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->menuRepository->delete($id);

        return [
            'status' => true,
            'message' => trans('message.delete_menu_success')
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @param updateTree $request
     * @return \Illuminate\Http\Response
     */
    public function updateTree(Request $request)
    {
        $data = $request->data;
        $this->menuRepository->updateTreeRebuild('id', $data);
        return response()->json($data);
    }
}
