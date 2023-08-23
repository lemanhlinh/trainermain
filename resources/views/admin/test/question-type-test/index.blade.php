@extends('admin.layouts.admin')

@section('title_file', trans('form.question_type_test.'))

@section('content')
    <a href="{{ route('admin.question-type-test.create') }}" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> @lang('form.button.create')</a>
    {!! $dataTable->table(['id' => 'question-type-test-table', 'class' => 'table table-striped table-bordered table-width-auto']) !!}
@endsection

@section('script')
    @parent
    {!! $dataTable->scripts() !!}
@endsection
