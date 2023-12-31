@extends('web.layouts.web')

@section('content')
    <div class="top-content-news">
        <div class="banner-home-course">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h1 class="title-course">{{ $data->title }}</h1>
                        @if(isset($setting['time_countdown']))
                            <div id="countdown"></div>
                        @endif
                        <p class="price-course d-none">{{ format_money($data->price_new,'') }}</p>
                        <button type="button" class="btn btn-course my-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="fas fa-book-open"></i> Đăng ký ngay
                        </button>
                    </div>
                    <div class="col-md-6">
                        @include('web.components.image', ['src' => $data->image, 'title'=> $data->title])
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-detail">
        <div class="container">
            <div class="box-content-detail">
                <h2 class="title-article-detail">Khóa học {{ $data->title }} tại IELTS TRAINER giúp bạn</h2>
                <div class="d-none d-md-block">
                    @include('web.components.image', ['src' => $data->image_pc, 'title'=> $data->title,'class' => 'mb-5'])
                </div>
                <div class="d-block d-md-none">
					<img src="{{ asset($data->image_mobile) }}" alt="{{ $data->title }}" class="img-fluid mb-5 w-100">
                </div>
                <div class="text-center">
                    <button type="button" class="btn btn-course" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="fas fa-book-open"></i> Đăng ký ngay
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="content-list-course">
        <div class="container">
            <h4 class="title-content-list-course">Sự khác biệt trong một khóa học tại IELTS TRAINER</h4>
            <div class="tab-content-program">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="content_1-tab" data-bs-toggle="tab" data-bs-target="#content_1" type="button" role="tab" aria-controls="content_1" aria-selected="true">Quy trình đào tạo</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="content_2-tab" data-bs-toggle="tab" data-bs-target="#content_2" type="button" role="tab" aria-controls="content_2" aria-selected="false">Phương pháp giảng dạy</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="content_3-tab" data-bs-toggle="tab" data-bs-target="#content_3" type="button" role="tab" aria-controls="content_3" aria-selected="false">Chương trình đào tạo</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="content_4-tab" data-bs-toggle="tab" data-bs-target="#content_4" type="button" role="tab" aria-controls="content_4" aria-selected="false">Mô hình lớp học</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="content_5-tab" data-bs-toggle="tab" data-bs-target="#content_5" type="button" role="tab" aria-controls="content_5" aria-selected="false">Môi trường học tập</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active ck-content" id="content_1" role="tabpanel" aria-labelledby="content_1-tab">{!! $data->content_1 !!}</div>
                    <div class="tab-pane fade ck-content" id="content_2" role="tabpanel" aria-labelledby="content_2-tab">{!! $data->content_2 !!}</div>
                    <div class="tab-pane fade ck-content" id="content_3" role="tabpanel" aria-labelledby="content_3-tab">{!! $data->content_3 !!}</div>
                    <div class="tab-pane fade ck-content" id="content_4" role="tabpanel" aria-labelledby="content_4-tab">{!! $data->content_4 !!}</div>
                    <div class="tab-pane fade ck-content" id="content_5" role="tabpanel" aria-labelledby="content_5-tab">{!! $data->content_5 !!}</div>
                </div>
            </div>
            <button type="button" class="btn btn-course btn-under-content" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fas fa-book-open"></i> Đăng ký ngay
            </button>
        </div>
    </div>
    <div class="other-course">
        <div class="container">
            <h4 class="title-other-course">Các khóa học khác tại IELTS TRAINER</h4>
            <div class="list-course-other">
                <div class="row">
                    @foreach($course_other as $item)
                        <div class="col-md-3 position-relative ">
                            <div class="box-course hvr-bounce-to-top">
                                <span class="img-new-home position-relative">
                                    <a href="{{ route('detailCourse',[$item->slug,$item->id]) }}" class="link-black">
                                        @include('web.components.image', ['src' => $item->image_resize['resize'],'class' => 'hvr-grow'])
                                    </a>
                                </span>
                                <div class="box-course-under">
                                    <div class="title-new position-relative">
                                        {{ $item->title }}
                                        <a href="{{ route('detailCourse',[$item->slug,$item->id]) }}" class="stretched-link"></a>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between price-course">
                                        <span class="price-detail">{{ format_money($item->price_new) }}</span>
                                        @if($item->price)
                                        <span class="price-new">{{ format_money($item->price) }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @include('web.course.modal')
@endsection

@section('link')
    @parent
    <link rel="stylesheet" href="{{ asset('/css/web/course-detail.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/content-ckeditor.css') }}">
@endsection

@section('script')
    @parent
    <script>
        $(document).ready(function () {
            $(".course-select").change(function () {
                var val = $('input[name="course-check"]:checked').val();
                $('#product_id').val(val);
                $('.item-course').removeClass('active');
                if ($(this).is(':checked')) {
                    $(this).closest('.item-course').addClass('active');
                }
                let price = $(this).data("price");
                $('#total-price-order').text(price);
            });
        });

        @if ($errors->any())
            let errorMessage = '';
            @foreach ($errors->all() as $error)
                errorMessage += '{{ $error }}\n';
            @endforeach

            Swal.fire({
                icon: 'error',
                title: 'Lỗi',
                text: errorMessage,
            });
        @endif
    </script>
    <script>
        // Thời gian bắt đầu và thời gian kết thúc (10 phút)
        const startTime = new Date().getTime();
        const endTime = localStorage.getItem('endTime') || (startTime + {{ $setting['time_countdown'] }} * 60 * 1000); // Lấy thời gian kết thúc từ Local Storage hoặc mặc định 10 phút

        // Lưu thời gian kết thúc vào Local Storage
        localStorage.setItem('endTime', endTime);

        // Cập nhật đồng hồ đếm ngược mỗi giây
        const countdown = document.getElementById("countdown");
        const countdownInterval = setInterval(updateCountdown, 1000); // Cập nhật mỗi giây

        function updateCountdown() {
            const currentTime = new Date().getTime();
            const remainingTime = endTime - currentTime;

            const hours = Math.floor((remainingTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);

            countdown.innerHTML = `<div class="text-promotion">Đăng ký ngay<br> {!! $setting['promotion_des'] !!} <p class="time-count">${hours} giờ ${minutes} phút ${seconds} giây</p></div>`;

            if (remainingTime <= 0) {
                countdown.innerHTML = "<div class='text-promotion text-promotion-end'>Đã hết thời gian ưu đãi!</div>";
                clearInterval(countdownInterval);
            }
        }

        updateCountdown(); // Cập nhật ban đầu

        const endTimeExist = localStorage.getItem('endTime');

        if (endTimeExist) {
            const timeElapsed = startTime - parseInt(endTime);
            const secondsElapsed = Math.floor(timeElapsed / 1000 /60 /60);
            console.log('Thời gian đã tồn tại: ' + secondsElapsed + ' giờ');
            if(secondsElapsed >= 1){
                localStorage.removeItem('endTime');
            }
        }
    </script>
@endsection
