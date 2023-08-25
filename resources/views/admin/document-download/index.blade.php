@extends('admin.layouts.admin')

@section('title_file', trans('form.document_download.'))

@section('content')
    {!! $dataTable->table(['id' => 'document-download-table', 'class' => 'table table-striped table-bordered table-width-auto']) !!}
@endsection

@section('script')
    @parent
    {!! $dataTable->scripts() !!}
@endsection
