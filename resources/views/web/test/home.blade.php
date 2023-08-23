@extends('web.layouts.web')

@section('content')
    <div class="content-home-test">
        <div class="container">
            <div class="text-center title-top-home">
                <h1 class="title-home-test">Kiểm tra đầu vào miễn phí</h1>
                <p>Chọn bài thi</p>
            </div>
            <form action="{{ route('updateMember',$id) }}" name="choose_lesson" id="choose_lesson" method="post">
                @csrf
                <div class="row">
                    @forelse($listLesson as $item)
                        <div class="col-md-6">
                            <label for="lesson_test_{{ $item->id }}" class="lesson_item" onclick="show_description({{ $item->id }})">
                                <input type="radio" name="lesson_id" id="lesson_test_{{ $item->id }}" value="{{ $item->id }}">
                                {{ $item->name }}
                                <div class="description_lesson" id="des_lesson_{{ $item->id }}">{!! $item->description !!}</div>
                            </label>

                        </div>
                    @empty
                    @endforelse
                </div>
                <p class="submit-form-lesson">
                    <button type="submit" class="btn btn-danger text-center">Bắt đầu làm bài</button>
                </p>
            </form>
        </div>
    </div>
@endsection

@section('link')
    @parent
    <link rel="stylesheet" href="{{ asset('/css/web/test-home.css') }}">
@endsection

@section('script')
    @parent
    <script>
        function show_description(id) {
            $('.description_lesson').hide();
            $('#des_lesson_'+id).slideToggle( "slow");
        }
    </script>
@endsection
