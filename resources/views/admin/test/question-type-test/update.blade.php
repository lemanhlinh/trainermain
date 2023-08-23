@extends('admin.layouts.admin')

@section('title_file', trans('form.question-type-test.update'))

@section('content')
    <div class="card card-primary card-body">
        <form action="{{ route('admin.question-type-test.update', $questionType->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.test.question-type-test.form.inputs')
            <input type="hidden" name="id" value="{{ $questionType->id }}">
            <button type="submit" class="btn btn-primary">@lang('form.button.update')</button>
        </form>
    </div>
@endsection
