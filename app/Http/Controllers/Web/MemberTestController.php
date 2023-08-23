<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Mail\TestOnlineMail;
use App\Models\MemberTest;
use App\Models\QuestionTest;
use App\Models\LessonTest;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Requests\MemberTest\CreateMemberTest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class MemberTestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $listLesson = LessonTest::where('active', 1)->get();
        return view('web.test.home',compact('id','listLesson'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMemberTest $req)
    {
        DB::beginTransaction();
        try {
            $data = $req->validated();
            $model = MemberTest::create($data);
            DB::commit();
            $getEmail = Setting::where('key', 'email_for_admin')->first();
            $listEmail = explode(',',$getEmail->value);
            Mail::to($data['email'])->cc($listEmail)->send(new TestOnlineMail($data));
//            Session::flash('success', trans('message.create_member_test_success'));
            return redirect()->route('detailChooseTest', $model->id);
        } catch (\Exception $ex) {
            DB::rollBack();
            \Log::info([
                'message' => $ex->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);

            Session::flash('danger', trans('message.create_member_test_error'));
            return redirect()->back();
        }
        return redirect()->back();
    }

    /**
     * Show the form for update member a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateMember(Request $req, $id)
    {
        try {
            $member_test = MemberTest::find($id);
            if (!$member_test) {
                Session::flash('success', trans('message.update_member_test_error'));
                return redirect()->route('home');
            }
            $newData = $req->only(['lesson_id']);
            $member_test->update($newData);
            Session::flash('success', trans('message.upda te_member_testr_success'));
            return redirect()->route('guideTest', $id);
        } catch (\Exception $exception) {
            \Log::info([
                'message' => $exception->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            Session::flash('danger', trans('message.create_member_test_error'));
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function guideTest($id)
    {
        $member_test = MemberTest::with('lessonTest')->find($id);
        return view('web.test.guide',compact('member_test'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function examTest($id)
    {
        $member_test = MemberTest::with('lessonTest')->find($id);
        $listQuestion = QuestionTest::inRandomOrder()->with('questionItemTest')->where(['lesson_id'=>$member_test->lesson_id,'active' => 1])->get();
        $date = Carbon::parse($member_test->birthday);
        if (empty($listQuestion))
            return redirect()->route('home');
        return view('web.test.exam', compact('member_test','date','listQuestion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function saveTest(Request $req, $id)
    {
        try {
            $member_test = MemberTest::find($id);
            if (!$member_test) {
                Session::flash('success', trans('message.update_member_test_error'));
                return false;
            }
//            dd($req);
            $newData = $req->only(['lesson_id','lesson_name','correct','total_questions','wrong','content_answer','content','time_start','time_end']);
            $member_test->update($newData);
//            Session::flash('success', trans('message.update_member_test_success'));
            return true;
        } catch (\Exception $exception) {
            \Log::info([
                'message' => $exception->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
//            Session::flash('danger', trans('message.create_member_test_error'));
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
