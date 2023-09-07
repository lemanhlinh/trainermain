<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Repositories\Contracts\ArticleInterface;
use App\Repositories\Contracts\BannerInterface;
use App\Repositories\Contracts\CourseInterface;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;
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
        $logo = Setting::where('key', 'logo')->first();

        SEOTools::setTitle('Trang tin tức - IELTS TRAINER');
        SEOTools::setDescription('Trang tin tức - IELTS TRAINER');
        SEOTools::addImages(asset($logo->value));
        SEOTools::setCanonical(url()->current());
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::twitter()->setSite('IELTS TRAINER');

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

        SEOTools::setTitle($article->seo_title?$article->seo_title:$article->title);
        SEOTools::setDescription($article->seo_description?$article->seo_description:$article->description);
        SEOTools::addImages($article->image?asset($article->image):null);
        SEOTools::setCanonical(url()->current());
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::twitter()->setSite('IELTS TRAINER');
        SEOMeta::setKeywords($article->seo_keyword?$article->seo_keyword:$article->title);

        return view('web.article.detail', compact('article','articles','courses'));
    }
}
