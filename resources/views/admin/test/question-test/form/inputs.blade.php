
<div class="row">
    <div class="col-sm-6">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>@lang('form.question_test.type_id')</label>
                    <select class="form-control" data-placeholder="@lang('form.question_test.type_id')" name="type_id" id="type_id" >
                        @if(isset($type))
                            @foreach($type as $item)
                                @if(isset($type_id) && $item->id == $type_id)
                                    <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                @else
                                    <option value="{{ $item->id }}" {{ isset($question) && empty($type_id) ? ($question->type_id == $item->id ? 'selected':'') : (old('type_id') == $item->id ?'selected':'') }}>{{ $item->name }}</option>
                                @endif
                            @endforeach
                        @endif
                    </select>
                    @if ($errors->has('type_id'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('type_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label>@lang('form.question_test.level')</label>
                    <select class="form-control" data-placeholder="@lang('form.question_test.level')" name="level" required >
                        @forelse(\App\Models\QuestionTest::LEVEL_VALUE as $key => $value)
                            <option value="{{ $key }}" {{ isset($question) ? ($question->type_id == $key ? 'selected':'') : (old('level') == $key ?'selected':'') }}>{{ $value }}</option>
                        @empty
                        @endforelse
                    </select>
                    @if ($errors->has('level'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('level') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>@lang('form.question_test.lesson_id')</label>
                    <select class="form-control" data-placeholder="@lang('form.question_test.lesson_id')" name="lesson_id" >
                        @if(isset($lesson))
                            @foreach($lesson as $item)
                                <option value="{{ $item->id }}" {{ isset($question) ? ($question->lesson_id == $item->id ? 'selected':'') : (old('lesson_id') == $item ?'selected':'') }}>{{ $item->name }}</option>
                            @endforeach
                        @endif
                    </select>
                    @if ($errors->has('lesson_id'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('lesson_id') }}</strong>
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
                            <input class="" type="radio" id="statusRadio1" name="active" value="{{ \App\Models\QuestionTest::STATUS_ACTIVE }}" {{ (isset($question->active) && $question->active == \App\Models\QuestionTest::STATUS_ACTIVE) ? 'checked' : (old('active') && (old('active') == \App\Models\QuestionTest::STATUS_ACTIVE)) ? 'checked' : '' }}  required>
                            <label for="statusRadio1" class="custom-control-label">@lang('form.status.active')&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        </div>
                        <div class="icheck-danger d-inline">
                            <input class="" type="radio" id="statusRadio2" name="active" value="{{ \App\Models\QuestionTest::STATUS_INACTIVE }}" {{ isset($question->active) && $question->active == \App\Models\QuestionTest::STATUS_INACTIVE ? 'checked' : (old('active') && (old('active') == \App\Models\QuestionTest::STATUS_INACTIVE)) ? 'checked' : '' }}  required>
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
            <div class="col-sm-12">
                <div class="form-group">
                    <label>@lang('form.content')</label>
                    <textarea id="content" name="content" class="form-control" rows="10" >{{ isset($question->content) ? $question->content : old('content') }}</textarea>
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
    <div class="col-sm-6">
        @if((isset($type_id) && in_array($type_id,[1,3,4,5])))
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>@lang('form.question_test.answer')</label>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Đáp án</th>
                                <th scope="col" class="text-center">Đáp án đúng</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse($listAnswer as $key => $value)
                                    <tr>
                                        <td>Đáp án {{ $key+1 }}</td>
                                        <td><input type="text" name="answer[]" class="form-control" placeholder="Đáp án {{ $key+1 }}" value="{{ $value->content_answer }}"></td>
                                        <td class="text-center"><input type="checkbox" name="answer_true[]" value="{{ $key }}" {{ $value->answer == 1 ? 'checked':'' }}></td>
                                    </tr>
                                @empty
                                    @if($type_id == 3)
                                        <tr>
                                            <td>Đáp án 1</td>
                                            <td><input type="text" name="answer[]" class="form-control" placeholder="Đáp án 1"></td>
                                            <td class="text-center"><input type="checkbox" name="answer_true[]" value="0"></td>
                                        </tr>
                                        <tr>
                                            <td>Đáp án 2</td>
                                            <td><input type="text" name="answer[]" class="form-control" placeholder="Đáp án 2"></td>
                                            <td class="text-center"><input type="checkbox" name="answer_true[]" value="1"></td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td>Đáp án 1</td>
                                            <td><input type="text" name="answer[]" class="form-control" placeholder="Đáp án 1"></td>
                                            <td class="text-center"><input type="checkbox" name="answer_true[]" value="0"></td>
                                        </tr>
                                        <tr>
                                            <td>Đáp án 2</td>
                                            <td><input type="text" name="answer[]" class="form-control" placeholder="Đáp án 2"></td>
                                            <td class="text-center"><input type="checkbox" name="answer_true[]" value="1"></td>
                                        </tr>
                                        <tr>
                                            <td>Đáp án 3</td>
                                            <td ><input type="text" name="answer[]" class="form-control" placeholder="Đáp án 3"></td>
                                            <td class="text-center"><input type="checkbox" name="answer_true[]" value="2"></td>
                                        </tr>
                                        <tr>
                                            <td>Đáp án 4</td>
                                            <td ><input type="text" name="answer[]" class="form-control" placeholder="Đáp án 4"></td>
                                            <td class="text-center"><input type="checkbox" name="answer_true[]" value="3"></td>
                                        </tr>
                                    @endif
                                @endforelse
                            </tbody>
                        </table>
                        @if ($errors->has('answer'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('answer') }}</strong>
                            </span>
                        @endif
                        @if ($errors->has('answer_true'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('answer_true') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        @elseif(isset($type_id) && $type_id == 2)
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>@lang('form.question_test.answer')</label>
                        @if(count($listAnswer) > 2)
                            <input type="text" name="answer[]" class="form-control" placeholder="Đáp án">
                            <input type="hidden" name="answer_true[]" value="0" checked>
                        @else
                            @forelse($listAnswer as $key => $value)
                                <input type="text" name="answer[]" class="form-control" value="{{ $value->content_answer }}" placeholder="Đáp án">
                                <input type="hidden" name="answer_true[]" value="0" checked>
                            @empty
                                <input type="text" name="answer[]" class="form-control" placeholder="Đáp án">
                                <input type="hidden" name="answer_true[]" value="0" checked>
                            @endforelse
                        @endif

                        @if ($errors->has('answer'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('answer') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        @else
            @if((isset($question) && in_array($question->type_id,[1,3,4,5])))
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>@lang('form.question_test.answer')</label>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Đáp án</th>
                                    <th scope="col" class="text-center">Đáp án đúng</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($listAnswer as $key => $value)
                                    <tr>
                                        <td>Đáp án {{ $key+1 }}</td>
                                        <td><input type="text" name="answer[]" class="form-control" placeholder="Đáp án {{ $key+1 }}" value="{{ $value->content_answer }}"></td>
                                        <td class="text-center"><input type="checkbox" name="answer_true[]" value="{{ $key }}" {{ $value->answer == 1 ? 'checked':'' }}></td>
                                    </tr>
                                @empty
                                    @if($type_id == 3)
                                        <tr>
                                            <td>Đáp án 1</td>
                                            <td><input type="text" name="answer[]" class="form-control" placeholder="Đáp án 1"></td>
                                            <td class="text-center"><input type="checkbox" name="answer_true[]" value="0"></td>
                                        </tr>
                                        <tr>
                                            <td>Đáp án 2</td>
                                            <td><input type="text" name="answer[]" class="form-control" placeholder="Đáp án 2"></td>
                                            <td class="text-center"><input type="checkbox" name="answer_true[]" value="1"></td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td>Đáp án 1</td>
                                            <td><input type="text" name="answer[]" class="form-control" placeholder="Đáp án 1"></td>
                                            <td class="text-center"><input type="checkbox" name="answer_true[]" value="0"></td>
                                        </tr>
                                        <tr>
                                            <td>Đáp án 2</td>
                                            <td><input type="text" name="answer[]" class="form-control" placeholder="Đáp án 2"></td>
                                            <td class="text-center"><input type="checkbox" name="answer_true[]" value="1"></td>
                                        </tr>
                                        <tr>
                                            <td>Đáp án 3</td>
                                            <td ><input type="text" name="answer[]" class="form-control" placeholder="Đáp án 3"></td>
                                            <td class="text-center"><input type="checkbox" name="answer_true[]" value="2"></td>
                                        </tr>
                                        <tr>
                                            <td>Đáp án 4</td>
                                            <td ><input type="text" name="answer[]" class="form-control" placeholder="Đáp án 4"></td>
                                            <td class="text-center"><input type="checkbox" name="answer_true[]" value="3"></td>
                                        </tr>
                                    @endif
                                @endforelse
                                </tbody>
                            </table>
                            @if ($errors->has('answer'))
                                <span class="help-block text-danger">
                                <strong>{{ $errors->first('answer') }}</strong>
                            </span>
                            @endif
                            @if ($errors->has('answer_true'))
                                <span class="help-block text-danger">
                                <strong>{{ $errors->first('answer_true') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            @elseif((isset($question) && $question->type_id == 2))
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>@lang('form.question_test.answer')</label>
                            @if(count($listAnswer) > 2)
                                <input type="text" name="answer[]" class="form-control" placeholder="Đáp án">
                                <input type="hidden" name="answer_true[]" value="0" checked>
                            @else
                                @forelse($listAnswer as $key => $value)
                                    <input type="text" name="answer[]" class="form-control" value="{{ $value->content_answer }}" placeholder="Đáp án">
                                    <input type="hidden" name="answer_true[]" value="0" checked>
                                @empty
                                    <input type="text" name="answer[]" class="form-control" placeholder="Đáp án">
                                    <input type="hidden" name="answer_true[]" value="0" checked>
                                @endforelse
                            @endif
                            @if ($errors->has('answer'))
                                <span class="help-block text-danger">
                                <strong>{{ $errors->first('answer') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>@lang('form.question_test.answer')</label>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Đáp án</th>
                                    <th scope="col" class="text-center">Đáp án đúng</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($listAnswer as $key => $value)
                                    <tr>
                                        <td>Đáp án {{ $key+1 }}</td>
                                        <td><input type="text" name="answer[]" class="form-control" placeholder="Đáp án {{ $key+1 }}" value="{{ $value->content_answer }}"></td>
                                        <td class="text-center"><input type="checkbox" name="answer_true[]" value="{{ $key }}" {{ $value->answer == 1 ? 'checked':'' }}></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>Đáp án 1</td>
                                        <td><input type="text" name="answer[]" class="form-control" placeholder="Đáp án 1"></td>
                                        <td class="text-center"><input type="checkbox" name="answer_true[]" value="0"></td>
                                    </tr>
                                    <tr>
                                        <td>Đáp án 2</td>
                                        <td><input type="text" name="answer[]" class="form-control" placeholder="Đáp án 2"></td>
                                        <td class="text-center"><input type="checkbox" name="answer_true[]" value="1"></td>
                                    </tr>
                                    <tr>
                                        <td>Đáp án 3</td>
                                        <td ><input type="text" name="answer[]" class="form-control" placeholder="Đáp án 3"></td>
                                        <td class="text-center"><input type="checkbox" name="answer_true[]" value="2"></td>
                                    </tr>
                                    <tr>
                                        <td>Đáp án 4</td>
                                        <td ><input type="text" name="answer[]" class="form-control" placeholder="Đáp án 4"></td>
                                        <td class="text-center"><input type="checkbox" name="answer_true[]" value="3"></td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                            @if ($errors->has('answer'))
                                <span class="help-block text-danger">
                                <strong>{{ $errors->first('answer') }}</strong>
                            </span>
                            @endif
                            @if ($errors->has('answer_true'))
                                <span class="help-block text-danger">
                                <strong>{{ $errors->first('answer_true') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        @endif
    </div>
</div>

@section('script')
    @parent
    <script src="{{ asset('ckeditor5/ckeditor.js') }}"></script>
    <script src="{{ asset('ckfinder/ckfinder.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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


        const selectElement = document.getElementById('type_id');
        let initialSelectedValue = selectElement.value;
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        selectElement.addEventListener('change', (event) => {
            Swal.fire({
                title: 'Bạn có chắc chắn không?',
                text: "Đáp án sẽ mất",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Đồng ý!'
            }).then((result) => {
                if (result.isConfirmed) {
                    const selectedRoute = event.target.value;
                    @if(isset($question))
                        $.ajax({
                            url: '{{ route('admin.question-test.destroyItem',$question->id) }}',
                            type: 'POST',
                            data: {
                                _token: csrfToken,
                            },
                            success: function(response) {
                                // Xử lý kết quả trả về
                                console.log(response);
                            },
                            error: function(error) {
                                // Xử lý lỗi
                                console.error(error);
                            }
                        });
                        window.location.href = `{{ route('admin.question-test.edit',$question->id) }}?type_id=${selectedRoute}`;
                    @else
                        window.location.href = `{{ route('admin.question-test.create') }}?type_id=${selectedRoute}`;
                    @endif
                }else {
                    // Gán giá trị ban đầu lại cho select option nếu nhấn "Cancel"
                    selectElement.value = initialSelectedValue;
                }
            })

        });
    </script>
@endsection
