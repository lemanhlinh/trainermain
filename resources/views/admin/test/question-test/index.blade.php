@extends('admin.layouts.admin')

@section('title_file', trans('form.question_test.'))

@section('content')
    <div class="row mb-3">
        <div class="col-sm-9">
            <form action="{{ route('admin.question-test.index') }}" method="GET" class="form-inline">
                <select name="lesson" class="form-control">
                    <option value="">@lang('form.lesson_test.')</option>
                    @forelse($lessons as $key => $lesson)
                        <option value="{{ $lesson['id'] }}" @if (isset($data['lesson']) && $data['lesson'] ==  $lesson['id']) selected @endif>{{ $lesson['name'] }}</option>
                    @empty
                    @endforelse
                </select>
                <select name="type" class="form-control ms-3">
                    <option value="">@lang('form.question_type_test.')</option>
                    @forelse($types as $key => $type)
                        <option value="{{ $type['id'] }}" @if (isset($data['type']) && $data['type'] ==  $type['id']) selected @endif>{{ $type['name'] }}</option>
                    @empty
                    @endforelse
                </select>
                <button type="submit" class="btn btn-primary ml-3"><i class="fa fa-search"></i> @lang('form.button.search')</button>
                <a class="btn btn-success ml-2" href="{{ route('admin.question-test.index') }}"><i class="fa fa-recycle"></i> @lang('form.button.refresh')</a>
            </form>
        </div>
        <div class="col-sm-3 text-right">
            <a href="{{ route('admin.question-test.create') }}" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> @lang('form.button.create')</a>
        </div>
    </div>

    {!! $dataTable->table(['id' => 'question-test-table', 'class' => 'table table-striped table-bordered table-width-auto']) !!}
@endsection

@section('link')
    @parent
    <style>
        img{
            max-width: 100% !important;
        }
    </style>
@endsection

@section('script')
    @parent
    {!! $dataTable->scripts() !!}
@endsection
