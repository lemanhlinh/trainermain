<div class="row">
    <div class="col-sm-7">
        <div class="row">
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>@lang('form.why_different.title')</label> <span class="text-danger">*</span>
                    <input type="text" class="form-control" name="title" value="{{ isset($whyDifferent) ? $whyDifferent->title : old('title') }}" required>
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
                            <input class="" type="radio" id="statusRadio1" name="active" value="{{ \App\Models\WhyDifferent::STATUS_ACTIVE }}" {{ (isset($whyDifferent->active) && $whyDifferent->active == \App\Models\WhyDifferent::STATUS_ACTIVE) ? 'checked' : (old('active') && (old('active') == \App\Models\WhyDifferent::STATUS_ACTIVE)) ? 'checked' : '' }}  required>
                            <label for="statusRadio1" class="custom-control-label">@lang('form.status.active')&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        </div>
                        <div class="icheck-danger d-inline">
                            <input class="" type="radio" id="statusRadio2" name="active" value="{{ \App\Models\WhyDifferent::STATUS_INACTIVE }}" {{ (isset($whyDifferent) && $whyDifferent->active == \App\Models\WhyDifferent::STATUS_INACTIVE) ? 'checked' : (old('active') && (old('active') == \App\Models\WhyDifferent::STATUS_INACTIVE)) ? 'checked' : '' }} required>
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
                <div class="form-group clearfix">
                    <label>@lang('form.why_different.display_page')</label> <span class="text-danger">*</span>
                    <div class="form-group">
                        <div class="icheck-success d-inline">
                            <input class="" type="radio" id="display_pageRadio1" name="display_page" value="{{ \App\Models\WhyDifferent::STATUS_SHOW_HOME }}" {{ (isset($whyDifferent->display_page) && $whyDifferent->display_page == \App\Models\WhyDifferent::STATUS_SHOW_HOME) ? 'checked' : (old('display_page') && (old('display_page') == \App\Models\WhyDifferent::STATUS_SHOW_HOME)) ? 'checked' : '' }}  required>
                            <label for="display_pageRadio1" class="custom-control-label">@lang('form.why_different.show_home')&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        </div>
                        <div class="icheck-danger d-inline">
                            <input class="" type="radio" id="display_pageRadio2" name="display_page" value="{{ \App\Models\WhyDifferent::STATUS_SHOW_CAT }}" {{ (isset($whyDifferent) && $whyDifferent->display_page == \App\Models\WhyDifferent::STATUS_SHOW_CAT) ? 'checked' : (old('display_page') && (old('display_page') == \App\Models\WhyDifferent::STATUS_SHOW_CAT)) ? 'checked' : '' }} required>
                            <label for="display_pageRadio2" class="custom-control-label">@lang('form.why_different.show_cat')</label>
                        </div>
                    </div>
                    @if ($errors->has('display_page'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('display_page') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>@lang('form.why_different.icon')</label> <span class="text-danger">*</span>
                    <div class="input-group">
                        @include('admin.components.buttons.image',['src' => isset($whyDifferent->icon) ? $whyDifferent->icon : old('icon'),'name' => 'icon'])
                        @if ($errors->has('icon'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('icon') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>@lang('form.why_different.ordering')</label>
                    <input type="text" class="form-control" name="ordering" value="{{ isset($whyDifferent) ? $whyDifferent->ordering : (old('ordering') ? old('ordering') : 1) }}" required >
                    @if ($errors->has('ordering'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('ordering') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label>@lang('form.description')</label>
                    <textarea class="form-control" rows="3" name="description" >{{ isset($whyDifferent) ? $whyDifferent->description : old('description') }}</textarea>
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

    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <label>@lang('form.content')</label>
            <textarea id="content" name="content" class="form-control" rows="10" >{{ isset($whyDifferent->content) ? $whyDifferent->content : old('content') }}</textarea>
            @if ($errors->has('content'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('content') }}</strong>
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
    </script>
@endsection
