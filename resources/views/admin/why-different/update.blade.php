@extends('admin.layouts.admin')

@section('title_file', trans('form.why-different.update'))

@section('content')
    <div class="card card-primary card-body">
        <form action="{{ route('admin.why-different.update', $whyDifferent->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.why-different.form.inputs')
            <input type="hidden" name="id" value="{{ $whyDifferent->id }}">
            <button type="submit" class="btn btn-primary">@lang('form.button.update')</button>
        </form>
    </div>
@endsection

