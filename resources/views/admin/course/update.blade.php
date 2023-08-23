@extends('admin.layouts.admin')

@section('title_file', trans('form.course.update'))

@section('content')
    <div class="card card-primary card-body">
        <form action="{{ route('admin.course.update', $course->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.course.form.inputs')
            <input type="hidden" name="id" value="{{ $course->id }}">
            <button type="submit" class="btn btn-primary">@lang('form.button.update')</button>
        </form>
    </div>
@endsection
