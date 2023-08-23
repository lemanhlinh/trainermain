<div class="row">
    <div class="col-sm-7">
        <div class="row">
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>@lang('form.program.title')</label> <span class="text-danger">*</span>
                    <input type="text" class="form-control" name="title" value="{{ isset($program) ? $program->title : old('title') }}" required>
                    @if ($errors->has('title'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group clearfix">
                    <label>@lang('form.status.active')</label> <span class="text-danger">*</span>
                    <div class="form-group">
                        <div class="icheck-success d-inline">
                            <input class="" type="radio" id="statusRadio1" name="active" value="{{ \App\Models\Program::STATUS_ACTIVE }}" {{ (isset($program->active) && $program->active == \App\Models\Program::STATUS_ACTIVE) ? 'checked' : (old('active') && (old('active') == \App\Models\Program::STATUS_ACTIVE)) ? 'checked' : '' }}  required>
                            <label for="statusRadio1" class="custom-control-label">@lang('form.status.active')&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        </div>
                        <div class="icheck-danger d-inline">
                            <input class="" type="radio" id="statusRadio2" name="active" value="{{ \App\Models\Program::STATUS_INACTIVE }}" {{ (isset($program) && $program->active == \App\Models\Program::STATUS_INACTIVE) ? 'checked' : (old('active') && (old('active') == \App\Models\Program::STATUS_INACTIVE)) ? 'checked' : '' }} required>
                            <label for="statusRadio2" class="custom-control-label">@lang('form.status.inactive')</label>
                        </div>
                    </div>
                    @if ($errors->has('active'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('active') }}</strong>
                </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>@lang('form.program.total_day')</label> <span class="text-danger">*</span>
                    <input type="text" class="form-control" name="total_day" value="{{ isset($program) ? $program->total_day : old('total_day') }}" required>
                    @if ($errors->has('total_day'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('total_day') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>@lang('form.program.total_time')</label> <span class="text-danger">*</span>
                    <input type="text" class="form-control" name="total_time" value="{{ isset($program) ? $program->total_time : old('total_time') }}" required>
                    @if ($errors->has('total_time'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('total_time') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>@lang('form.program.ordering')</label>
                    <input type="text" class="form-control" name="ordering" value="{{ isset($program) ? $program->ordering : (old('ordering') ? old('ordering') : 1) }}" required >
                    @if ($errors->has('ordering'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('ordering') }}</strong>
                </span>
                    @endif
                </div>
            </div>

        </div>
    </div>
    <div class="col-sm-5">

    </div>
</div>

@section('script')
    @parent
@endsection
