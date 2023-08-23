<div class="row">
    <div class="col-sm-7">
        <div class="row">
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>@lang('form.banner.title')</label> <span class="text-danger">*</span>
                    <input type="text" class="form-control" name="title" value="{{ isset($banner) ? $banner->title : old('title') }}" required>
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
                            <input class="" type="radio" id="statusRadio1" name="active" value="{{ \App\Models\Banner::STATUS_ACTIVE }}" {{ (isset($banner->active) && $banner->active == \App\Models\Banner::STATUS_ACTIVE) ? 'checked' : (old('active') && (old('active') == \App\Models\Banner::STATUS_ACTIVE)) ? 'checked' : '' }}  required>
                            <label for="statusRadio1" class="custom-control-label">@lang('form.status.active')&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        </div>
                        <div class="icheck-danger d-inline">
                            <input class="" type="radio" id="statusRadio2" name="active" value="{{ \App\Models\Banner::STATUS_INACTIVE }}" {{ (isset($banner) && $banner->active == \App\Models\Banner::STATUS_INACTIVE) ? 'checked' : (old('active') && (old('active') == \App\Models\Banner::STATUS_INACTIVE)) ? 'checked' : '' }} required>
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
                <div class="form-group">
                    <label>@lang('form.banner.image')</label> <span class="text-danger">*</span>
                    <div class="input-group">
                        @include('admin.components.buttons.image',['src' => isset($banner->image) ? $banner->image : old('image'),'name' => 'image'])
                        @if ($errors->has('image'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('image') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>@lang('form.article.ordering')</label>
                    <input type="text" class="form-control" name="ordering" value="{{ isset($banner) ? $banner->ordering : (old('ordering') ? old('ordering') : 1) }}" required >
                    @if ($errors->has('ordering'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('ordering') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label>@lang('form.banner.link_page')</label>
                    <select class="select2bs4 form-control" data-placeholder="@lang('form.banner.link_page')" name="link_page" >
                        @if(isset($links))
                            @foreach($links as $item)
                                <option value="{{ $item }}" {{ isset($banner) ? ($banner->link_page === $item ? 'selected':'') : (old('link_page') === $item ?'selected':'') }}>{{ $item }}</option>
                            @endforeach
                        @endif
                    </select>
                    @if ($errors->has('link_page'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('link_page') }}</strong>
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
            <textarea id="content" name="content" class="form-control" rows="10" >{{ isset($banner->content) ? $banner->content : old('content') }}</textarea>
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
