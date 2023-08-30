<div class="row">
    <div class="col-sm-7">
        <div class="row">
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>@lang('form.store.title')</label> <span class="text-danger">*</span>
                    <input type="text" class="form-control" name="title" value="{{ isset($store) ? $store->title : old('title') }}" required>
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
                            <input class="" type="radio" id="statusRadio1" name="active" value="{{ \App\Models\Store::STATUS_ACTIVE }}" {{ (isset($store->active) && $store->active == \App\Models\Store::STATUS_ACTIVE) ? 'checked' : (old('active') && (old('active') == \App\Models\Store::STATUS_ACTIVE)) ? 'checked' : '' }}  required>
                            <label for="statusRadio1" class="custom-control-label">@lang('form.status.active')&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        </div>
                        <div class="icheck-danger d-inline">
                            <input class="" type="radio" id="statusRadio2" name="active" value="{{ \App\Models\Store::STATUS_INACTIVE }}" {{ isset($store->active) && $store->active == \App\Models\Store::STATUS_INACTIVE ? 'checked' : (old('active') && (old('active') == \App\Models\Store::STATUS_INACTIVE)) ? 'checked' : '' }}  required>
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
                    <label>@lang('form.store.phone')</label> <span class="text-danger">*</span>
                    <input type="text" class="form-control" name="phone" value="{{ isset($store) ? $store->phone : old('phone') }}" required>
                    @if ($errors->has('phone'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>@lang('form.article.ordering')</label>
                    <input type="text" class="form-control" name="ordering" value="{{ isset($store) ? $store->ordering : (old('ordering') ? old('ordering') : 1) }}" required >
                    @if ($errors->has('ordering'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('ordering') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Nhúng bản đồ</label>
                </span>
                    </div>

                    <textarea id="content" name="content" class="form-control" rows="10" >{{ isset($store->content) ? $store->content : old('content') }}</textarea>
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
        let editor;
        InlineEditor
            .create( document.querySelector( '#content' ),{
                ckfinder: {
                    uploadUrl: '{!! asset('ckfinder/core/connector/php/connector.php').'?command=QuickUpload&type=Images&responseType=json' !!}',
                    options: {
                        resourceType: 'Images'
                    }
                }
            } )
            .then( newEditor => {
                editor = newEditor; // Lưu trình soạn thảo CKEditor vào biến editor
            } )
            .catch( error => {
                console.error( error );
            } );
        function insertHTML() {
            CKFinder.modal( {
                chooseFiles: true,
                width: 800,
                height: 600,
                onInit: function( finder ) {
                    finder.on('files:choose', function(evt) {
                        const file = evt.data.files.first();
                        const docFrag = editor.model.change( writer => {
                            const p1 = writer.createElement( 'paragraph');
                            const p2 = writer.createElement( 'paragraph' );
                            const image = writer.createAttributeElement( 'figure',{
                                class: 'image'
                            } );
                            const image_detail = writer.createElement( 'img',{
                                src: '/storage/upload_image/images/26-1-202221-4259-1643241010(1).png'
                            } );
                            const blockQuote = writer.createElement( 'blockQuote' );
                            const docFrag = writer.createDocumentFragment();

                            writer.append( p1, docFrag );
                            writer.append( blockQuote, docFrag );
                            writer.append( p2, blockQuote );
                            writer.append( image, docFrag );
                            writer.append( image_detail, image );
                            writer.insertText( 'barsss', p1 );
                            writer.insertText( 'bar', p2 );

                            return docFrag;
                        } );
                        editor.model.insertContent( docFrag );
                    });
                }
            } );


        }
    </script>
@endsection
