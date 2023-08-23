@extends('admin.layouts.admin')

@section('title_file', trans('form.article.update'))

@section('content')
    <div class="card card-primary card-body">
        <form action="{{ route('admin.program.update', $program->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.program.form.inputs')
            <input type="hidden" name="id" value="{{ $program->id }}">
            <button type="submit" class="btn btn-primary">@lang('form.button.update')</button>
        </form>
    </div>
@endsection
