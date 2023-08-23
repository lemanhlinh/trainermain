@extends('admin.layouts.admin')

@section('title_file', trans('form.document.create'))

@section('content')
    <div class="card card-primary card-body">
        <form action="{{ route('admin.document.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.document.form.inputs')
            <button type="submit" class="btn btn-primary">@lang('form.button.submit')</button>
        </form>
{{--        <button id="ckfinder-popup" class="button-a button-a-background" style="float: left">Open Popup</button>--}}
    </div>
@endsection

