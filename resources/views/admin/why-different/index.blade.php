@extends('admin.layouts.admin')

@section('title_file', trans('form.why_different.'))

@section('content')
    <a href="{{ route('admin.why-different.create') }}" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> @lang('form.button.create')</a>
    {!! $dataTable->table(['id' => 'why-different-table', 'class' => 'table table-striped table-bordered table-width-auto']) !!}
@endsection

@section('script')
    @parent
    {!! $dataTable->scripts() !!}
@endsection
