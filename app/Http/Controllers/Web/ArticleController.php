<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ArticleInterface;
use App\Repositories\Contracts\BannerInterface;
use App\Repositories\Contracts\CourseInterface;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    protected $articleRepository, $bannerRepository, $coursRepository;

    public function __construct(ArticleInterface $articleRepository, CourseInterface $coursRepository, BannerInterface $bannerRepository)
    {
        $this->bannerRepository = $bannerRepository;
        $this->articleRepository = $articleRepository;
        $this->coursRepository = $coursRepository;
    }
    /**
     * Display a home of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = $this->articleRepository->paginate(9,['id','slug','image','description','title'],['active' => 1]);
        $banner = $this->bannerRepository->getList(['link_page' => route('homeArticle')],['id','title','image','content'], 1);
        return view('web.article.home', compact('articles','banner'));
    }


    /**
     * Display a home of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detail($slug, $id)
    {
        $articles = $this->articleRepository->getList(['id' => ['!=',$id]],['id','title','slug','image'], 5);
        $courses = $this->coursRepository->getAll();
        $article = $this->articleRepository->getOneById($id);
        return view('web.article.detail', compact('article','articles','courses'));
    }
}
