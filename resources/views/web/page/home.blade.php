@extends('web.layouts.web')

@section('content')
    <div class="content-detail">
        <div class="container">
            <div class="box-content-detail">
                <div class="show-content ck-content">
                    {!! $page->content !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('link')
    @parent
    <link rel="stylesheet" href="{{ asset('/css/web/page-home.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/content-ckeditor.css') }}">
@endsection

@section('script')
    @parent
@endsection
