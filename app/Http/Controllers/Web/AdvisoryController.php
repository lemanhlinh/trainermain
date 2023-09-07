<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Mail\AdvisoryMail;
use App\Models\Advisory;
use App\Models\Setting;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Advisory\CreateAdvisory;
use App\Repositories\Contracts\StoreInterface;

class AdvisoryController extends Controller
{

    protected $storeRepository;

    public function __construct( StoreInterface $storeRepository)
    {
        $this->storeRepository = $storeRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logo = Setting::where('key', 'logo')->first();

        SEOTools::setTitle('Trang tư vấn - IELTS TRAINER');
        SEOTools::setDescription('Trang tư vấn - IELTS TRAINER');
        SEOTools::addImages(asset($logo->value));
        SEOTools::setCanonical(url()->current());
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::twitter()->setSite('IELTS TRAINER');

        $stores = $this->storeRepository->getList(['active' => 1],['id','title'], 0);
        return view('web.advisory.home', compact('stores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAdvisory $req)
    {
        DB::beginTransaction();
        try {
            $data = $req->validated();
            Advisory::create($data);
            $getEmail = Setting::where('key', 'email_for_admin')->first();
            $listEmail = explode(',',$getEmail->value);
            Mail::to($data['email'])->cc($listEmail)->send(new AdvisoryMail($data));
            DB::commit();
            Session::flash('success', 'Cảm ơn, chúng tôi sẽ liên hệ với bạn sớm nhất có thể!');
            return redirect()->back();
        } catch (\Exception $ex) {
            DB::rollBack();
            \Log::info([
                'message' => $ex->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);

            Session::flash('danger', trans('message.create_advisory_error'));
            return redirect()->back();
        }
    }
}
