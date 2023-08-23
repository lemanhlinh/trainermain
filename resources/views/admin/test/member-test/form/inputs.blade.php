<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-4">
                <!-- text input -->
                <div class="form-group">
                    <label>@lang('form.member_test.full_name')</label> <span class="text-danger">*</span>
                    <input type="text" class="form-control" name="full_name" value="{{ isset($member) ? $member->full_name : old('full_name') }}" required>
                    @if ($errors->has('full_name'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('full_name') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-4">
                <!-- text input -->
                <div class="form-group">
                    <label>@lang('form.member_test.email')</label> <span class="text-danger">*</span>
                    <input type="text" class="form-control" name="email" value="{{ isset($member) ? $member->email : old('email') }}" required>
                    @if ($errors->has('email'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-4">
                <!-- text input -->
                <div class="form-group">
                    <label>@lang('form.member_test.phone')</label> <span class="text-danger">*</span>
                    <input type="text" class="form-control" name="phone" value="{{ isset($member) ? $member->phone : old('phone') }}" required>
                    @if ($errors->has('phone'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('phone') }}</strong>
                </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>@lang('form.member_test.gender')</label> <span class="text-danger">*</span>
                    <input type="text" class="form-control" name="gender" value="{{ isset($member) ? ($member->gender == 1)?'Nam':'Nữ' : old('gender') }}" required>
                    @if ($errors->has('gender'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('gender') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>@lang('form.member_test.birthday')</label> <span class="text-danger">*</span>
                    <input type="text" class="form-control" name="birthday" value="{{ isset($member) ? $member->birthday : old('birthday') }}" required>
                    @if ($errors->has('birthday'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('birthday') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@if(!empty($questionList))
<div class="card card-info">
    <div class="card-header bg-blue">
        <h3 class="card-title">Bài thi ({{ $member->lesson_name }})</h3>
    </div>
    <div class="card-body">
        @forelse($questionList as $k => $question)
            <p class="number-question"><i class="fas fa-question-circle"></i> <b class="text-danger">Câu hỏi {{ $k + 1 }}:</b></p>
            <p class="title-question"><b>{!! $question->content !!}</b></p>
            <ul class="list-unstyled">
                @forelse($question->question_item_test as $key => $item)
                    @php($i = !empty($answerList) ? (array)$answerList : null)
                    @if($question->type_id == 1)
                        <li>
                            <label class="font-weight-normal">
                                 <span>
                                    @if($item->answer)
                                         <i class="fas fa-check-circle text-success"></i>
                                     @else
                                         <i class="fas fa-times-circle text-danger"></i>
                                     @endif
                                </span>
                                <input
                                    type="{{ $question->type_id == 1 ? 'checkbox' : 'text' }}"
                                    name="question_{{ $key }}" {{ gettype($i[$question->id]) == 'array' ? in_array($item->id,$i[$question->id])? 'checked' : '': ($item->id == $i[$question->id])? 'checked' : '' }}
                                    value="{{ $item->id }}"
                                    disabled>
                                {{ $item->content_answer }}
                            </label>
                        </li>
                    @else
                        <li>
                            <label>
                                <span>
                                    @if($item->content_answer == $i[$question->id] )
                                        <i class="fas fa-check-circle text-success"></i>
                                    @else
                                        <i class="fas fa-times-circle text-danger"></i>
                                    @endif
                                </span>
                                <input
                                    type="text"
                                    name="question_{{ $key }}" }}
                                    value="{{ !empty($i[$question->id])?$i[$question->id]:'' }}"
                                    disabled>
                                <span class="font-weight-normal">Đáp án đúng: {{ $item->content_answer }}</span>
                            </label>
                        </li>
                    @endif
                @empty

                @endforelse
            </ul>
        @empty
        @endforelse
    </div>
</div>
@endif
@section('script')
    @parent
@endsection
