@extends('admin.layouts.admin')

@section('title_file', trans('form.lesson-test.update'))

@section('content')
    <div class="card card-primary card-body">
        <form action="{{ route('admin.lesson-test.update', $lesson->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.test.lesson-test.form.inputs')
            <input type="hidden" name="id" value="{{ $lesson->id }}">
            <button type="submit" class="btn btn-primary">@lang('form.button.update')</button>
        </form>
    </div>
@endsection
