<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Document\CreateDocumentDownload;
use App\Mail\DocumentDownloadMail;
use App\Models\MemberTest;
use App\Models\DocumentDownload;
use App\Models\Setting;
use App\Repositories\Contracts\DocumentInterface;
use App\Repositories\Contracts\BannerInterface;
use App\Repositories\Contracts\CourseInterface;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class DocumentController extends Controller
{
    protected $documentRepository, $bannerRepository, $coursRepository;

    public function __construct(DocumentInterface $documentRepository, CourseInterface $coursRepository, BannerInterface $bannerRepository)
    {
        $this->bannerRepository = $bannerRepository;
        $this->documentRepository = $documentRepository;
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

        SEOTools::setTitle('Trang tài liệu - IELTS TRAINER');
        SEOTools::setDescription('Trang tài liệu - IELTS TRAINER');
        SEOTools::addImages(asset($logo->value));
        SEOTools::setCanonical(url()->current());
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::twitter()->setSite('IELTS TRAINER');

        $documents = $this->documentRepository->paginate(9,['id','slug','image','description','title']);
        $banner = $this->bannerRepository->getList(['link_page' => route('homeDocument')],['id','title','image','content'], 1);
        return view('web.document.home', compact('documents','banner'));
    }


    /**
     * Display a home of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detail($slug, $id)
    {
        $documents = $this->documentRepository->getList(['id' => ['!=',$id]],['id','title','slug','image'], 5);
        $courses = $this->coursRepository->getAll();
        $document = $this->documentRepository->getOneById($id);

        SEOTools::setTitle($document->seo_title?$document->seo_title:$document->title);
        SEOTools::setDescription($document->seo_description?$document->seo_description:$document->description);
        SEOTools::addImages($document->image?asset($document->image):null);
        SEOTools::setCanonical(url()->current());
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::twitter()->setSite('IELTS TRAINER');
        SEOMeta::setKeywords($document->seo_keyword?$document->seo_keyword:$document->title);

        return view('web.document.detail', compact('document','documents','courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDocumentDownload $req)
    {
        DB::beginTransaction();
        try {
            $data = $req->validated();
            DocumentDownload::create($data);
            DB::commit();
            $getEmail = Setting::where('key', 'email_for_admin')->first();
            $listEmail = explode(',',$getEmail->value);
            Mail::to($data['email'])->cc($listEmail)->send(new DocumentDownloadMail($data));
            Session::flash('success', trans('File đã được gửi vào mail, bạn hãy check mail!'));
            return redirect()->back();
        } catch (\Exception $ex) {
            DB::rollBack();
            \Log::info([
                'message' => $ex->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);

            Session::flash('danger', trans('Có lỗi trong quá trình gửi Mail'));
            return redirect()->back();
        }
        return redirect()->back();
    }
}
