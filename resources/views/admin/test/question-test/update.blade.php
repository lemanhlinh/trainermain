@extends('admin.layouts.admin')

@section('title_file', trans('form.question-test.update'))

@section('content')
    <div class="card card-primary card-body">
        <form action="{{ route('admin.question-test.update', $question->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.test.question-test.form.inputs')
            <input type="hidden" name="id" value="{{ $question->id }}">
            <button type="submit" class="btn btn-primary">@lang('form.button.update')</button>
        </form>
    </div>
@endsection
