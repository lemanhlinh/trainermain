@extends('admin.layouts.admin')

@section('title_file', trans('form.teacher.update'))

@section('content')
    <div class="card card-primary card-body">
        <form action="{{ route('admin.teacher.update', $teacher->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.teacher.form.inputs')
            <input type="hidden" name="id" value="{{ $teacher->id }}">
            <button type="submit" class="btn btn-primary">@lang('form.button.update')</button>
        </form>
    </div>
@endsection
