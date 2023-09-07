<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Article;
use App\Models\Setting;
use Artesaos\SEOTools\Facades\SEOTools;
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

        $logo = Setting::where('key', 'logo')->first();

        SEOTools::setTitle($page->seo_title?$page->seo_title:$page->title);
        SEOTools::setDescription($page->seo_description?$page->seo_description:$page->title);
        SEOTools::addImages($page->image?asset($page->image):null);
        SEOTools::setCanonical(url()->current());
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::twitter()->setSite('IELTS TRAINER');

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
        $articles = Article::where('active', 1)
                        ->where(function ($query) use ($slug, $keyword) {
                            $query->where('slug', 'like', '%'.$slug.'%')
                                ->orWhere('title', 'like', '%'.$keyword.'%');
                        })
                        ->paginate(9);
        return view('web.page.search', compact('articles','keyword'));
    }
}
