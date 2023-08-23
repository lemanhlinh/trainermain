@extends('admin.layouts.admin')

@section('title_file', trans('form.contact.'))

@section('content')
    {!! $dataTable->table(['id' => 'contact-table', 'class' => 'table table-striped table-bordered table-width-auto']) !!}
@endsection

@section('script')
    @parent
    {!! $dataTable->scripts() !!}
@endsection
