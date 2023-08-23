@extends('web.layouts.web')

@section('content')
    <div class="content-home-test">
        <div class="container">
            <div class="text-center title-top-home">
                <h1 class="title-home-test">Hướng dẫn làm bài thi</h1>
            </div>
            <div class="content-lesson">
                {!! $member_test->lessonTest->content !!}
            </div>
            <div class="list_action">
                <a href="{{ route('detailChooseTest',$member_test->id) }}" class="choose_return border">Chọn lại bài thi</a>
                <a href="{{ route('examTest',$member_test->id) }}" class="start_test_online">Bắt đầu làm bài</a>
            </div>
        </div>
    </div>
@endsection

@section('link')
    @parent
    <link rel="stylesheet" href="{{ asset('/css/web/test-guide.css') }}">
@endsection

@section('script')
    @parent
@endsection
