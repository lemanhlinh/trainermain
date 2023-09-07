<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\Setting;
use App\Models\Store;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\Contact\CreateContact;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Display a home of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logo = Setting::where('key', 'logo')->first();

        SEOTools::setTitle('Trang liên hệ - IELTS TRAINER');
        SEOTools::setDescription('Trang liên hệ - IELTS TRAINER');
        SEOTools::addImages(asset($logo->value));
        SEOTools::setCanonical(url()->current());
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::twitter()->setSite('IELTS TRAINER');

        $stores = Store::where('active', 1)->get();
        return view('web.contact.detail', compact('stores'));
    }

    /**
     * Display a home of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CreateContact $req)
    {
        DB::beginTransaction();
        try {
            $data = $req->validated();
            Contact::create($data);
            DB::commit();
            $getEmail = Setting::where('key', 'email_for_admin')->first();
            $listEmail = explode(',',$getEmail->value);
            Mail::to($data['email'])->cc($listEmail)->send(new ContactMail($data));
            Session::flash('success', 'Cảm ơn, chúng tôi sẽ liên hệ với bạn sớm nhất có thể!');
            return redirect()->back();
        } catch (\Exception $ex) {
            DB::rollBack();
            \Log::info([
                'message' => $ex->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);

            Session::flash('danger', trans('message.create_contact_error'));
            return redirect()->back();
        }
        return redirect()->back();
    }
}
