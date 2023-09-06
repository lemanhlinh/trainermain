@extends('web.layouts.web')

@section('content')
    <div class="top-content-news">
        <div class="banner-home-course">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        {!! $banner->content !!}
                        <button type="button" class="btn btn-course" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="fas fa-book-open"></i> Đăng ký khóa học
                        </button>
                        <a href="{{ route('detailAdvisory') }}" class="advisory-link">Tư vấn <i class="fas fa-clipboard-list"></i></a>
                    </div>
                    <div class="col-md-6">
                        @include('web.components.image', ['src' => $banner->image_resize, 'title' => $banner->title])
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="list-course-home">
        <div class="container">
            <div class="description-for-course">
                <h3 class="title-description-for-course">Các khóa học tại IELTS TRAINER</h3>
                <p class="description-for">
                    Các khóa học IELTS tại IELTS TRAINER được nghiên cứu, thiết kế riêng biệt bởi đội ngũ giáo viên nhiều năm kinh nghiệm, được sắp xếp phù hợp với từng đối tượng, nhằm đảm bảo và cam kết chất lượng đầu ra.
                </p>
            </div>
            <div class="row">
                @if(!empty($courses))
                    @foreach($courses as $item)
                        <div class="col-md-4 position-relative ">
                            <div class="box-course hvr-bounce-to-top">
                                <span class="img-new-home">
                                    <a href="{{ route('detailCourse',[$item->slug,$item->id]) }}" class="link-black">
                                        @include('web.components.image', ['src' => $item->image_resize['resize'], 'title' => $item->title,'class'=>'hvr-grow'])
                                    </a>
                                </span>
                                <div class="box-course-under">
                                    <div class="title-new position-relative">
                                        {{ $item->title }}
                                        <a href="{{ route('detailCourse',[$item->slug,$item->id]) }}" class="stretched-link"></a>
                                    </div>
                                    <p class="description-news">{{ $item->description }}</p>
                                    <div class="d-flex align-items-center justify-content-between price-course">
                                        @if($item->price)
                                        <span class="price-detail">{{ number_format($item->price_new, 0, ',', '.') }}đ</span>
                                        @else
                                            <span class="price-detail">Liên hệ</span>
                                        @endif
                                        @if($item->price)
                                            <span class="price-new">{{ number_format($item->price, 0, ',', '.') }}đ</span>
                                        @endif
                                        <a class="show-detail" href="{{ route('detailCourse',[$item->slug,$item->id]) }}">Chi tiết <i class="fas fa-caret-right"></i></a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <div class="why-different">
        <div class="container">
            <div class="d-none d-md-block">
                <div class="list-why-diffe">
                    @foreach($whyDifferent as $item)
                        <div class="box-why">
                            <div class="show-hidden-why">
                                @include('web.components.image', ['src' => $item->icon, 'title'=> $item->title])
                                <p class="title-box-why">{{ $item->title }}</p>
                                <span>{!! $item->content !!}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="d-block d-md-none">
                <div class="list-why-different">
                    @foreach($whyDifferent as $item)
                        <div class="box-why">
                            <div class="show-hidden-why">
                                @include('web.components.image', ['src' => $item->icon, 'title'=> $item->title])
                                <p>{{ $item->title }}</p>
                                <span>{{ $item->description }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="program-content">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <h4 class="title-box-program">Chi tiết chương trình học</h4>
                    <p class="description-for-program">IELTS TRAINER cung cấp 5 lộ trình tinh gọn, trọng tâm vào hoàn thiện 4 kỹ năng và luyện tập chuyên sâu để giúp học viên chinh phục mục tiêu của mình trong kỳ thi IELTS</p>
                    <div class="box-program-tab">
                        <div class="tab-content-program">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                @foreach($courses as $k => $item)
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link {{ $k === 0 ?'active':'' }}" id="content_{{ $k }}-tab" data-bs-toggle="tab" data-bs-target="#content_{{ $k }}" type="button" role="tab" aria-controls="content_{{ $k }}" aria-selected="{{ $k === 0 ?'true':'false' }}">{{ $item->title }}</button>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                @foreach($courses as $k => $item)
                                    <div class="tab-pane fade {{ $k === 0 ?'show active':'' }}" id="content_{{ $k }}" role="tabpanel" aria-labelledby="content_{{ $k }}-tab">{!! $item->content_near !!}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5"></div>
            </div>
        </div>
    </div>
    <div class="advisory-box">
        <div class="container">
            <div class="register-learn">
                <div class="row">
                    <div class="col-md-5">
                        <h4 class="title-form-add">Nhận tư vấn MIỄN PHÍ<br>
                            Hoàn thành mục tiêu IELTS ngay bây giờ!</h4>
                        <div class="mb-4 list-chat-form">
                            <ul class="list-unstyled bg-white p-3 rounded d-flex justify-content-between align-items-center">
                                <li class="d-flex align-items-center"><img src="{{ asset('images/mobile/facebook.png') }}" alt="Nhắn tin qua Facebook" class="img-fluid me-2"><a href="{{ $setting['link_mess_facebook'] }}" target="_blank">Nhắn tin qua Facebook</a></li>
                                <li class="d-flex align-items-center"><img src="{{ asset('images/mobile/zalo.png') }}" alt="Nhắn tin qua Zalo" class="img-fluid me-2"><a href="https://zalo.me/{{ $setting['phone_zalo'] }}">Nhắn tin qua Zalo</a></li>
                            </ul>
                        </div>
                        <form action="{{ route('detailAdvisoryStore') }}" class="form-home-add" name="form-advisory" id="form-advisory" method="post">
                            @csrf
                            <input type="text" class="form-control" placeholder="Họ và tên" name="full_name" value="{{ old('full_name') }}" required>
                            <input type="number" class="form-control" min="0" placeholder="Số điện thoại" name="phone" value="{{ old('phone') }}" required>
                            <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required>
                            <select name="why_learn_ielts" id="why_learn_ielts" class="form-select" required>
                                <option value="" disabled selected>Band điểm mong muốn của bạn?</option>
                                <option value="Get Ielts 3.5+" {{ old('why_learn_ielts') == 'Get Ielts 3.5+' ? 'selected' : '' }} >Get Ielts 3.5+</option>
                                <option value="Get Ielts 4.5+" {{ old('why_learn_ielts') == 'Get Ielts 4.5+' ? 'selected' : '' }} >Get Ielts 4.5+</option>
                                <option value="Get Ielts 5.5+" {{ old('why_learn_ielts') == 'Get Ielts 5.5+' ? 'selected' : '' }} >Get Ielts 5.5+</option>
                                <option value="Get Ielts 6.5+" {{ old('why_learn_ielts') == 'Get Ielts 6.5+' ? 'selected' : '' }} >Get Ielts 6.5+</option>
                                <option value="Get Ielts 7.5+" {{ old('why_learn_ielts') == 'Get Ielts 7.5+' ? 'selected' : '' }} >Get Ielts 7.5+</option>
                            </select>
                            <input type="text" class="form-control" placeholder="Bạn muốn IELTS TRAINER tư vấn lúc nào?" onchange="checkDateTime()" value="{{ old('time_ielts_support') }}" id="time_ielts_support" name="time_ielts_support" required>
                            <select name="test_ielts_address" id="test_ielts_address" class="form-select" required>
                                <option value="" disabled selected>Bạn muốn kiểm tra ở trung tâm nào?</option>
                                @if(!empty($stores))
                                    @forelse($stores as $item)
                                        <option value="{{ $item->title }}" {{ old('test_ielts_address') == $item->title ? 'selected' : '' }} >{{ $item->title }}</option>
                                    @empty
                                    @endforelse
                                @endif

                            </select>
                            <button class="form-control submit-form-home">đăng ký tư vấn <i class="fas fa-paper-plane"></i></button>
                        </form>
                    </div>
                    <div class="col-md-7 d-none d-md-block">
                        @include('web.components.image', ['src' => 'images/banner-advisory-course.png', 'title' => $item->title,'class' => 'img-advisory'])
                    </div>
                </div>
            </div>

        </div>
    </div>
    @include('web.course.modal')
@endsection

@section('link')
    @parent
    <link rel="stylesheet" href="{{ asset('/css/web/course-home.css') }}">
@endsection

@section('script')
    @parent
    <script>
        // Lấy tham chiếu đến phần tử input datetime-local
        var datetimeInput = $("#time_ielts_support");
        // Khi phần tử input datetime-local được tập trung vào (focus)
        datetimeInput.on("focus", function() {
            // Thay đổi loại của phần tử input sang "datetime-local"
            $(this).prop("type", "datetime-local");
        });

        function checkDateTime() {
            const inputDate = new Date(document.getElementById("time_ielts_support").value);
            const currentDate = new Date();
            inputDate.setHours(0, 0, 0, 0);
            currentDate.setHours(0, 0, 0, 0);

            if (inputDate.getTime() < currentDate.getTime()) {
                alert('Bạn không thể chọn thời gian quá khứ.')
                document.getElementById("time_ielts_support").value = ""; // Xoá giá trị nếu người dùng đã chọn thời gian quá khứ
            }
        }

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

        $('.list-why-different').slick({
            slidesToShow: 3,
            slidesToScroll: 3,
            dots: false,
            arrows: false,
            autoplay: false,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: false,
                        dots: true
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: false,
                        dots: true
                    }
                }
            ]
        });
    </script>
@endsection
