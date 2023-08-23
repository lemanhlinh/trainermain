<div class="row">
    <div class="col-sm-7">
        <div class="row">
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>@lang('form.lesson_test.name')</label> <span class="text-danger">*</span>
                    <input type="text" class="form-control" name="name" value="{{ isset($lesson) ? $lesson->name : old('name') }}" required>
                    @if ($errors->has('name'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('name') }}</strong>
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
                            <input class="" type="radio" id="statusRadio1" name="active" value="{{ \App\Models\LessonTest::STATUS_ACTIVE }}" {{ (isset($lesson->active) && $lesson->active == \App\Models\LessonTest::STATUS_ACTIVE) ? 'checked' : (old('active') && (old('active') == \App\Models\LessonTest::STATUS_ACTIVE)) ? 'checked' : '' }}  required>
                            <label for="statusRadio1" class="custom-control-label">@lang('form.status.active')&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        </div>
                        <div class="icheck-danger d-inline">
                            <input class="" type="radio" id="statusRadio2" name="active" value="{{ \App\Models\LessonTest::STATUS_INACTIVE }}" {{ isset($lesson->active) && $lesson->active == \App\Models\LessonTest::STATUS_INACTIVE ? 'checked' : (old('active') && (old('active') == \App\Models\LessonTest::STATUS_INACTIVE)) ? 'checked' : '' }}  required>
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
                    <label>@lang('form.lesson_test.number_question')</label> <span class="text-danger">*</span>
                    <input type="text" class="form-control" name="number_question" value="{{ isset($lesson) ? $lesson->number_question : old('number_question') }}" required>
                    @if ($errors->has('number_question'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('number_question') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>@lang('form.lesson_test.time_submit')</label> <span class="text-danger">*</span>
                    <input type="text" class="form-control" name="time_submit" value="{{ isset($lesson) ? $lesson->time_submit : old('time_submit') }}" required>
                    @if ($errors->has('time_submit'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('time_submit') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label>@lang('form.description')</label>
                    <textarea class="form-control" rows="3" name="description" id="description" >{{ isset($lesson) ? $lesson->description : old('description') }}</textarea>
                    @if ($errors->has('description'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label>@lang('form.content')</label>
                    <textarea id="content" name="content" class="form-control" rows="10" >{{ isset($lesson->content) ? $lesson->content : old('content') }}</textarea>
                    @if ($errors->has('content'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('content') }}</strong>
                </span>
                    @endif
                    <div class="editor"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-5">

    </div>

</div>

@section('script')
    @parent
    <script src="{{ asset('ckeditor5/ckeditor.js') }}"></script>
    <script src="{{ asset('ckfinder/ckfinder.js') }}"></script>
    <script>
        InlineEditor
            .create( document.querySelector( '#content' ),{
                ckfinder: {
                    uploadUrl: '{!! asset('ckfinder/core/connector/php/connector.php').'?command=QuickUpload&type=Images&responseType=json' !!}',
                    options: {
                        resourceType: 'Images'
                    }
                }
            } )
            .catch( error => {
                console.error( error );
            } );
        InlineEditor
            .create( document.querySelector( '#description' ),{
                ckfinder: {
                    uploadUrl: '{!! asset('ckfinder/core/connector/php/connector.php').'?command=QuickUpload&type=Images&responseType=json' !!}',
                    options: {
                        resourceType: 'Images'
                    }
                }
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection
