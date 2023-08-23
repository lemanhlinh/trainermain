<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MemberTest;
use Illuminate\Http\Request;
use App\DataTables\MemberTestDataTable;
use App\Repositories\Contracts\MemberTestInterface;

class MemberTestController extends Controller
{

    protected $memberTestRepository;

    public function __construct(MemberTestInterface $memberTestRepository)
    {
        $this->memberTestRepository = $memberTestRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MemberTestDataTable $dataTable)
    {
        return $dataTable->render('admin.test.member-test.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MemberTest  $memberTest
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $member = $this->memberTestRepository->getOneById($id);
        $questionList = json_decode($member->content);
        $answerList = json_decode($member->content_answer);
        return view('admin.test.member-test.update',compact('member','questionList','answerList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MemberTest  $memberTest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MemberTest $memberTest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MemberTest  $memberTest
     * @return \Illuminate\Http\Response
     */
    public function destroy(MemberTest $memberTest)
    {
        //
    }
}
