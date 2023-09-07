<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\CreateOrder;
use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Course;
use App\Models\Setting;
use App\Repositories\Contracts\CourseInterface;
use App\Repositories\Contracts\ArticleInterface;
use App\Repositories\Contracts\BannerInterface;
use App\Repositories\Contracts\WhyDifferentInterface;
use App\Repositories\Contracts\StoreInterface;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class CourseController extends Controller
{
    protected $articleRepository, $bannerRepository, $coursRepository, $whyDifferentRepository,$storeRepository;

    public function __construct(
        ArticleInterface $articleRepository,
        BannerInterface $bannerRepository,
        CourseInterface $coursRepository,
        WhyDifferentInterface $whyDifferentRepository,
        StoreInterface $storeRepository
    )
    {
        $this->coursRepository = $coursRepository;
        $this->articleRepository = $articleRepository;
        $this->bannerRepository = $bannerRepository;
        $this->whyDifferentRepository = $whyDifferentRepository;
        $this->storeRepository = $storeRepository;
    }
    /**
     * Display a home of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logo = Setting::where('key', 'logo')->first();

        SEOTools::setTitle('Trang khóa học - IELTS TRAINER');
        SEOTools::setDescription('Trang khóa học - IELTS TRAINER');
        SEOTools::addImages(asset($logo->value));
        SEOTools::setCanonical(url()->current());
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::twitter()->setSite('IELTS TRAINER');

        $courses = $this->coursRepository->getAll();
        $banner = $this->bannerRepository->getList(['link_page' => route('homeCourse')],['id','title','image','content'], 1);
        $whyDifferent = $this->whyDifferentRepository->getList(['display_page'=>1],['id','title','content','icon'], 0);
        $stores = $this->storeRepository->getList(['active' => 1],['id','title'], 0);
        return view('web.course.home', compact('courses','banner','whyDifferent','stores'));
    }


    /**
     * Display a home of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detail($slug, $id)
    {
        $data = $this->coursRepository->getOneById($id);
        $course_other = $this->coursRepository->getList([],['id','title','slug','image','price','price_new'], 4);
        $courses = $this->coursRepository->getAll();

        SEOTools::setTitle($data->seo_title?$data->seo_title:$data->title);
        SEOTools::setDescription($data->seo_description?$data->seo_description:$data->title);
        SEOTools::addImages($data->image?asset($data->image):null);
        SEOTools::setCanonical(url()->current());
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::twitter()->setSite('IELTS TRAINER');
        SEOMeta::setKeywords($data->seo_keyword?$data->seo_keyword:$data->title);

        return view('web.course.detail', compact('data','course_other','courses'));
    }

    /**
     * Display a home of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function success ($id)
    {
        $data = Order::findOrFail($id);
//        if (Session::has('success')) {
            return view('web.course.register_success',compact('data'));
//        }else{
//            return redirect('/');
//        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateOrder $req)
    {
        DB::beginTransaction();
        try {
            $data = $req->validated();
            $voucherCourse = Setting::where('key', 'voucher_course')->first();
            $percentVoucher = Setting::where('key', 'percent_voucher')->first();
            $mes = 'Đã đăng ký khóa học thành công';
            if ($data['voucher_course']){
                if ($voucherCourse->value != $data['voucher_course']){
                    $mes = 'Đã đăng ký thất bại, mã voucher không tồn tại';
                    $data['message'] = $mes;
                }else{
                    $mes .= ',Mã voucher đã được áp dụng giảm -'. $percentVoucher->value.'%';
                    $data['percent_voucher'] = $percentVoucher->value;
                    $data['message'] = $mes;
                }
            }

            $order = Order::create($data);
            $course = Course::find($data['product_id']);
            $data_item = array();
            $data_item['order_id'] = $order->id;
            $data_item['product_id'] = $data['product_id'];
            $data_item['product_title'] = $course->title;
            $data_item['product_price'] = $course->price_new;
            OrderItem::create($data_item);
            DB::commit();
            $getEmail = Setting::where('key', 'email_for_admin')->first();
            $listEmail = explode(',',$getEmail->value);
            Mail::to($data['email'])->cc($listEmail)->send(new OrderMail($data, $course));

            Session::flash('success', $mes);
            return redirect()->route('orderCourseSuccess',$order->id);
        } catch (\Exception $ex) {
            DB::rollBack();
            \Log::info([
                'message' => $ex->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);

            Session::flash('danger', trans('message.create_order_error'));
            return redirect()->back();
        }
    }

    public function storeTest()
    {
        return redirect()->route('orderCourseSuccess');
    }

    protected function failedValidation(CreateOrder $request)
    {
        if ($request->expectsJson()) {
            $errors = $request->validator->errors()->messages();

            return response()->json($errors, 422);
        }

        return redirect()->back()
            ->withInput($request->input())
            ->withErrors($request->validator);
    }
}
