@extends('admin.layouts.admin')

@section('title_file', trans('form.document.update'))

@section('content')
    <div class="card card-primary card-body">
        <form action="{{ route('admin.document.update', $document->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.document.form.inputs')
            <input type="hidden" name="id" value="{{ $document->id }}">
            <button type="submit" class="btn btn-primary">@lang('form.button.update')</button>
        </form>
    </div>
@endsection
