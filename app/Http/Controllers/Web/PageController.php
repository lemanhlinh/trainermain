<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Article;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a home of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        $page = Page::where('slug', $slug)->first();
        if (!$page) {
            abort(404);
        }
        return view('web.page.home', compact('page'));
    }

    public function search(Request $req)
    {
        $keyword = $req->input('keyword');
        return redirect()->route('detailSearch', $keyword);
    }

    public function detailSearch($keyword = null)
    {
        $slug = \Str::slug($keyword, '-');
        $articles = Article::where('slug','like', '%'.$slug.'%')->orwhere('title','like', '%'.$keyword.'%')->paginate(9);
        return view('web.page.search', compact('articles','keyword'));
    }
}
