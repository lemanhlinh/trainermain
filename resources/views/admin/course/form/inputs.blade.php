<div class="row">
    <div class="col-sm-7">
        <div class="row">
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>@lang('form.course.title')</label> <span class="text-danger">*</span>
                    <input type="text" class="form-control" name="title" value="{{ isset($course) ? $course->title : old('title') }}" required>
                    @if ($errors->has('title'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>@lang('form.course.slug')</label> <span class="text-danger">(@lang('form.auto_slug'))</span>
                    <input type="text" class="form-control" name="slug" value="{{ isset($course) ? $course->slug : old('slug') }}">
                    @if ($errors->has('slug'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('slug') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group clearfix">
                    <label>@lang('form.course.active')</label> <span class="text-danger">*</span>
                    <div class="form-group">
                        <div class="icheck-success d-inline">
                            <input class="" type="radio" id="statusRadio1" name="active" value="{{ \App\Models\Course::STATUS_ACTIVE }}" {{ (isset($course->active) && $course->active == \App\Models\Course::STATUS_ACTIVE) ? 'checked' : (old('active') && (old('active') == \App\Models\Course::STATUS_ACTIVE)) ? 'checked' : '' }}  required>
                            <label for="statusRadio1" class="custom-control-label">@lang('form.status.active')&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        </div>
                        <div class="icheck-danger d-inline">
                            <input class="" type="radio" id="statusRadio2" name="active" value="{{ \App\Models\Course::STATUS_INACTIVE }}" {{ (isset($course) && $course->active == \App\Models\Course::STATUS_INACTIVE) ? 'checked' : (old('active') && (old('active') == \App\Models\Course::STATUS_INACTIVE)) ? 'checked' : '' }}  required>
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
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>@lang('form.course.ordering')</label>
                    <input type="text" class="form-control" name="ordering" value="{{ isset($course) ? $course->ordering : (old('ordering') ? old('ordering') : 1) }}" >
                    @if ($errors->has('ordering'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('ordering') }}</strong>
                </span>
                    @endif
                </div>
            </div>

        </div>
        <div class="row">

            <div class="col-sm-12">
                <div class="form-group">
                    <label>@lang('form.course.image')</label> <span class="text-danger">*</span>
                    <div class="input-group">
                        @include('admin.components.buttons.image',['src' => isset($course->image) ? $course->image : old('image'),'name' => 'image'])
                        @if ($errors->has('image'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('image') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label>@lang('form.course.image_pc')</label> <span class="text-danger">*</span>
                    <div class="input-group">
                        @include('admin.components.buttons.image',['src' => isset($course->image_pc) ? $course->image_pc : old('image_pc'),'name' => 'image_pc'])
                        @if ($errors->has('image_pc'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('image_pc') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>@lang('form.course.image_mobile')</label> <span class="text-danger">*</span>
                    <div class="input-group">
                        @include('admin.components.buttons.image',['src' => isset($course->image_mobile) ? $course->image_mobile : old('image_mobile'),'name' => 'image_mobile'])
                        @if ($errors->has('image_mobile'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('image_mobile') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-sm-6 d-none">
                <div class="form-group">
                    <label>@lang('form.course.image_map')</label> <span class="text-danger">*</span>
                    <div class="input-group">
                        @include('admin.components.buttons.image',['src' => isset($course->image_map) ? $course->image_map : old('image_map'),'name' => 'image_map'])
                        @if ($errors->has('image_map'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('image_map') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>@lang('form.course.price')</label>
                    <input type="text" class="form-control" name="price" value="{{ isset($course) ? $course->price : old('price') }}" >
                    @if ($errors->has('price'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('price') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>@lang('form.course.price_new')</label>
                    <input type="text" class="form-control" name="price_new" value="{{ isset($course) ? $course->price_new : old('price_new') }}" >
                    @if ($errors->has('price_new'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('price_new') }}</strong>
                </span>
                    @endif
                </div>
            </div>

            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>@lang('form.course.input_student')</label>
                    <input type="text" class="form-control" name="input_student" value="{{ isset($course) ? $course->input_student : old('input_student') }}" >
                    @if ($errors->has('input_student'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('input_student') }}</strong>
                </span>
                    @endif
                </div>
            </div>

            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>@lang('form.course.output_student')</label>
                    <input type="text" class="form-control" name="output_student" value="{{ isset($course) ? $course->output_student : old('output_student') }}" >
                    @if ($errors->has('output_student'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('output_student') }}</strong>
                </span>
                    @endif
                </div>
            </div>

            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>@lang('form.course.time_learn')</label>
                    <input type="text" class="form-control" name="time_learn" value="{{ isset($course) ? $course->time_learn : old('time_learn') }}" >
                    @if ($errors->has('time_learn'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('time_learn') }}</strong>
                </span>
                    @endif
                </div>
            </div>

            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>@lang('form.course.who_teacher')</label>
                    <input type="text" class="form-control" name="who_teacher" value="{{ isset($course) ? $course->who_teacher : old('who_teacher') }}" >
                    @if ($errors->has('who_teacher'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('who_teacher') }}</strong>
                </span>
                    @endif
                </div>
            </div>

            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>@lang('form.course.how_learn')</label>
                    <input type="text" class="form-control" name="how_learn" value="{{ isset($course) ? $course->how_learn : old('how_learn') }}" >
                    @if ($errors->has('how_learn'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('how_learn') }}</strong>
                </span>
                    @endif
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group">
                    <label>@lang('form.description')</label> <span class="text-danger">*</span>
                    <textarea class="form-control" rows="3" name="description" >{{ isset($course) ? $course->description : old('description') }}</textarea>
                    @if ($errors->has('description'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

        </div>
    </div>
    <div class="col-sm-5">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">SEO</h3>
            </div>
            <div class="card-body p-3">
                <div class="form-group">
                    <label>@lang('form.seo_title')</label>
                    <input type="text" class="form-control" name="seo_title" value="{{ isset($course) ? $course->seo_title : old('seo_title') }}"  >
                    @if ($errors->has('seo_title'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('seo_title') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>@lang('form.seo_keyword')</label>
                    <input type="text" class="form-control" name="seo_keyword" value="{{ isset($course) ? $course->seo_keyword : old('seo_keyword') }}"  >
                    @if ($errors->has('seo_keyword'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('seo_keyword') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>@lang('form.seo_description')</label>
                    <textarea class="form-control" rows="3" name="seo_description"  >{{ isset($course) ? $course->seo_description : old('seo_description') }}</textarea>
                    @if ($errors->has('seo_description'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('seo_description') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <label>@lang('form.course.content_near')</label>
            <textarea id="content_near" name="content_near" class="form-control" rows="10" >{{ isset($course->content_near) ? $course->content_near : old('content_near') }}</textarea>
            @if ($errors->has('content_near'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('content_near') }}</strong>
                </span>
            @endif
            <div class="editor"></div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <label>@lang('form.course.content_1')</label>
            <textarea id="content_1" name="content_1" class="form-control" rows="10" >{{ isset($course->content_1) ? $course->content_1 : old('content_1') }}</textarea>
            @if ($errors->has('content_1'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('content_1') }}</strong>
                </span>
            @endif
            <div class="editor"></div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <label>@lang('form.course.content_2')</label>
            <textarea id="content_2" name="content_2" class="form-control" rows="10" >{{ isset($course->content_2) ? $course->content_2 : old('content_2') }}</textarea>
            @if ($errors->has('content_2'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('content_2') }}</strong>
                </span>
            @endif
            <div class="editor"></div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <label>@lang('form.course.content_3')</label>
            <textarea id="content_3" name="content_3" class="form-control" rows="10" >{{ isset($course->content_3) ? $course->content_3 : old('content_3') }}</textarea>
            @if ($errors->has('content_3'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('content_3') }}</strong>
                </span>
            @endif
            <div class="editor"></div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <label>@lang('form.course.content_4')</label>
            <textarea id="content_4" name="content_4" class="form-control" rows="10" >{{ isset($course->content_near) ? $course->content_4 : old('content_4') }}</textarea>
            @if ($errors->has('content_4'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('content_4') }}</strong>
                </span>
            @endif
            <div class="editor"></div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <label>@lang('form.course.content_5')</label>
            <textarea id="content_5" name="content_5" class="form-control" rows="10" >{{ isset($course->content_near) ? $course->content_5 : old('content_5') }}</textarea>
            @if ($errors->has('content_5'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('content_5') }}</strong>
                </span>
            @endif
            <div class="editor"></div>
        </div>
    </div>
</div>

@section('script')
    @parent
    <script src="{{ asset('ckeditor5/ckeditor.js') }}"></script>
    <script src="{{ asset('ckfinder/ckfinder.js') }}"></script>
    <script>
        var contentElements = document.querySelectorAll('[id^="content"]');

        contentElements.forEach(function(element) {
            InlineEditor
                .create(element, {
                    ckfinder: {
                        uploadUrl: '{!! asset('ckfinder/core/connector/php/connector.php').'?command=QuickUpload&type=Images&responseType=json' !!}',
                        options: {
                            resourceType: 'Images'
                        }
                    }
                })
                .catch(error => {
                    console.error(error);
                });
        });
    </script>
@endsection
