@extends('admin.layouts.admin')

@section('title_file', trans('form.advisory.'))

@section('content')
    {!! $dataTable->table(['id' => 'advisory-table', 'class' => 'table table-striped table-bordered table-width-auto']) !!}
@endsection
@section('script')
    @parent
    {!! $dataTable->scripts() !!}
@endsection
