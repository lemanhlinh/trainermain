<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ArticleInterface;
use App\Repositories\Contracts\WhyDifferentInterface;
use App\Repositories\Contracts\StudentInterface;
use App\Repositories\Contracts\BannerInterface;
use App\Repositories\Contracts\TeacherInterface;
use App\Repositories\Contracts\StoreInterface;

class HomeController extends Controller
{
    protected
        $articleRepository,
        $studentRepository,
        $whyDifferentRepository,
        $bannerRepository,
        $teacherRepository,
        $storeRepository
    ;

    public function __construct(
        ArticleInterface $articleRepository,
        WhyDifferentInterface $whyDifferentRepository,
        StudentInterface $studentRepository,
        BannerInterface $bannerRepository,
        TeacherInterface $teacherRepository,
        StoreInterface $storeRepository
    )
    {
        $this->articleRepository = $articleRepository;
        $this->whyDifferentRepository = $whyDifferentRepository;
        $this->studentRepository = $studentRepository;
        $this->teacherRepository = $teacherRepository;
        $this->bannerRepository = $bannerRepository;
        $this->storeRepository = $storeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = $this->articleRepository->getList(['active' => 1,'is_home' => 1],['id','title','slug','description','image'], 3);
        $banner = $this->bannerRepository->getList(['link_page' => route('home'), 'active' => 1],['id','title','image'], 1);
        $whyDifferent = $this->whyDifferentRepository->getList(['display_page'=>0],['id','title','description','icon'], 0);
        $teachers = $this->teacherRepository->getList(['active' => 1],['id','name','image','scores'], 0);
        $students = $this->studentRepository->getList(['active' => 1],['id','name','image','description','content'], 0);
        $stores = $this->storeRepository->getList(['active' => 1],['id','title'], 0);
        return view('web.home',compact('articles','banner','whyDifferent','students','teachers','stores'));
    }

    /**
     * Show the form for getContent a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getContent()
    {
        return view('web.about');
    }

    /**
     * Show the form for getContentApp a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getContentApp()
    {
        return view('web.design');
    }
}
