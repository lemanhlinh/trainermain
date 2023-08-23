@extends('admin.layouts.admin')

@section('title_file', trans('form.member_test.'))

@section('content')
    {!! $dataTable->table(['id' => 'member-test-table', 'class' => 'table table-striped table-bordered table-width-auto']) !!}
@endsection

@section('script')
    @parent
    {!! $dataTable->scripts() !!}
@endsection
