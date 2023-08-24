@extends('web.layouts.web')

@section('content')
    <div class="banner-home">
        @include('web.components.image', ['src' => $banner->image_resize, 'title'=> $banner->title])
    </div>
    <div class="why-different">
        <div class="container">
            <h4 class="why-different-title">IELTS TRAINER - đồng hành cùng bạn chinh phục ielts</h4>
            <div class="d-none d-md-block">
                <div class="list-why-diffe ">
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
            <div class="d-block d-md-none">
                <div class="list-why-different ">
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
    <div class="program-home">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="program-home__title">Lộ trình chinh phục ielts 7.5+</h4>
                    <ul class="program-home__summary">
                        <li>Trải nghiệm khóa học tùy chỉnh, phù hợp với nhu cầu và trình độ của từng bạn.</li>
                        <li>Tối ưu kết quả học tập bằng việc xây dựng kế hoạch học tập riêng thông qua bài kiểm tra thử IELTS đầu vào.</li>
                    </ul>

                </div>
            </div>
            @include('web.components.image', ['src' => 'images/route_learn.png','class' => 'image_router'])
        </div>
    </div>
    <div class="why-different">
        <div class="container">
            <h4 class="why-different-title">Đặc quyền tối đa, thành công vượt xa tại Ielts trainer</h4>
            <div class="list-access">
                <div class="box-list-access hvr-push px-3">
                    @include('web.components.image', ['src' => 'images/writing-amico.png'])
                    <p class="text-center">Tài liệu hỗ trợ học tập, sửa bài hỗ trợ trên nền tảng trực tuyến.</p>
                </div>

                <div class="box-list-access hvr-push px-3">
                    @include('web.components.image', ['src' => 'images/Webinar-amico.png'])
                    <p class="text-center">Nội dung đề ôn thi luôn được cập nhật, đảm bảo việc học viên luôn được tiếp cận đề thi mới nhất.</p>
                </div>

                <div class="box-list-access hvr-push px-3">
                    @include('web.components.image', ['src' => 'images/teacher-amico.png'])
                    <p class="text-center">Các giảng viên xịn xò từ 8.0+ theo sát, chăm sóc học viên kỹ càng, tận tâm như người thân.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="form-advisory">
        <div class="container">
            <div class="register-learn">
                <div class="row">
                    <div class="col-md-5">
                        <h4 class="title-form-add">đăng ký học thử<br>
                            miễn phí</h4>
                        <div class="mb-4 list-chat-form">
                            <ul class="list-unstyled bg-white p-3 rounded d-flex justify-content-between align-items-center">
                                <li class="d-flex align-items-center"><img src="{{ asset('images/mobile/facebook.png') }}" alt="Nhắn tin qua Facebook" class="img-fluid me-2"><a href="{{ $setting['link_mess_facebook'] }}" target="_blank">Nhắn tin qua Facebook</a></li>
                                <li class="d-flex align-items-center"><img src="{{ asset('images/mobile/zalo.png') }}" alt="Nhắn tin qua Zalo" class="img-fluid me-2"><a href="https://zalo.me/{{ $setting['phone_zalo'] }}">Nhắn tin qua Zalo</a></li>
                            </ul>
                        </div>
                        <form action="{{ route('detailAdvisoryStore') }}" class="form-home-add" name="form-advisory" id="form-advisory" method="post">
                            @csrf
                            <input type="text" class="form-control" placeholder="Họ và tên" name="full_name" value="{{ old('full_name') }}" required>
                            <input type="number" class="form-control" placeholder="Số điện thoại" name="phone" value="{{ old('phone') }}" required>
                            <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required>
                            <select name="why_learn_ielts" id="why_learn_ielts" class="form-select" required>
                                <option value="" disabled selected>Band điểm mong muốn của bạn?</option>
                                <option value="Get Ielts 3.5+" {{ old('why_learn_ielts') == 'Get Ielts 3.5+' ? 'selected' : '' }} >Get Ielts 3.5+</option>
                                <option value="Get Ielts 4.5+" {{ old('why_learn_ielts') == 'Get Ielts 4.5+' ? 'selected' : '' }} >Get Ielts 4.5+</option>
                                <option value="Get Ielts 5.5+" {{ old('why_learn_ielts') == 'Get Ielts 5.5+' ? 'selected' : '' }} >Get Ielts 5.5+</option>
                                <option value="Get Ielts 6.5+" {{ old('why_learn_ielts') == 'Get Ielts 6.5+' ? 'selected' : '' }} >Get Ielts 6.5+</option>
                                <option value="Get Ielts 7.5+" {{ old('why_learn_ielts') == 'Get Ielts 7.5+' ? 'selected' : '' }} >Get Ielts 7.5+</option>
                            </select>
                            <div class="position-relative">
                                <input type="text" class="form-control" placeholder="Bạn muốn IELTS TRAINER tư vấn lúc nào?" value="{{ old('time_ielts_support') }}" name="time_ielts_support" id="time_ielts_support" required>
{{--                                <span class="position-absolute" id="calendarIcon"><i class="fas fa-calendar-alt"></i></span>--}}
                            </div>

                            <select name="test_ielts_address" id="test_ielts_address" class="form-select" required>
                                <option value="" disabled selected>Bạn muốn kiểm tra ở trung tâm nào?</option>
                                @if(!empty($stores))
                                    @forelse($stores as $item)
                                        <option value="{{ $item->title }}" {{ old('test_ielts_address') == $item->title ? 'selected' : '' }} >{{ $item->title }}</option>
                                    @empty
                                    @endforelse
                                @endif

                            </select>
                            <button class="form-control submit-form-home">đăng ký học thử miển phí <i class="fas fa-paper-plane"></i></button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="why-different d-none">
        <div class="container">
            <h4 class="why-different-title">Đội ngũ giáo viên tâm huyết & giàu kinh nghiệm</h4>
            <div class="list-teacher">
                <div class="list-teacher-show">
                    @foreach($teachers as $item)
                        <div class="item-teacher hvr-bounce-to-top">
                            <div class="row">
                                <div class="col-md-7">
                                    <p class="d-flex align-items-center">
                                        <span class="point-teacher">{{ $item->scores }}.0</span>
                                        <span class="name-point">IELTS<br>Overall</span>
                                    </p>
                                </div>
                            </div>
                            <div class="bt-teacher">
                                <span>
                                    @include('web.components.image',['src' => $item->image,'title' => $item->name ])
                                </span>
                                <p class="name-teacher">{{ $item->name }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="content-student">
        <div class="container">
           <div class="row">
               <div class="col-md-4">
                   <h4 class="title-student">Cảm ơn những lời yêu thương dành cho IELTS TRAINER</h4>
                   <p>
                       Điều IELTS TRAINER luôn tâm đắc nhất trong giảng dạy đó là được nhìn thấy học viên thay đổi và tiến bộ rõ rệt lên từng ngày, nhìn thấy những nụ cười hạnh phúc và tự hào của các bạn trên hành trình chinh phục IELTS.
                   </p>
               </div>
               <div class="col-md-1"></div>
               <div class="col-md-7">
                   <div class="list-student">
                       @if(!empty($students))
                           <div class="row">
                               <div class="col-md-4"></div>
                               <div class="col-md-4">
                                   <div class="slider-nav-student">
                                       @foreach($students as $item)
                                           <div class="img-student-avata">
                                               @include('web.components.image',['src' => $item->image,'title' => $item->name ])
                                           </div>
                                       @endforeach
                                   </div>
                               </div>
                               <div class="col-md-4"></div>
                           </div>

                           <div class="slider-for-student">
                               @foreach($students as $item)
                                   <div class="content-student-item">
                                       {!! $item->content !!}
                                       <div class="title-student-name">
                                           <div class="name-student">{{ $item->name }}</div>
                                           <p>{{ $item->description }}</p>
                                       </div>
                                   </div>
                               @endforeach
                           </div>
                       @endif
                   </div>
               </div>
           </div>
        </div>
    </div>
    <div class="content-news">
        <div class="container">
            <div class="d-flex justify-content-between align-content-center">
                <h4 class="title-new-block">Tin tức nổi bật</h4>
                <a href="{{ route('homeArticle') }}" class="view-all-news">Xem tất cả <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            <div class="list-new">
                <div class="row">
                    @if(!empty($articles))
                        @foreach($articles as $item)
{{--                            @dd($item->image_resize);--}}
                            <div class="col-md-4 position-relative overflow-hidden item-article-home">
                                <a href="{{ route('detailArticle',[$item->slug,$item->id]) }}" class="link-black">
                                    @include('web.components.image',['src' => $item->image_resize['resize'],'class' => 'img-new-home hvr-grow' ])
                                </a>
                                <div class="title-new position-relative">
                                    {{ $item->title }}
                                    <a href="{{ route('detailArticle',[$item->slug,$item->id]) }}" class="stretched-link"></a>
                                </div>
                                <p class="description-news">{{ $item->description }}</p>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('link')
    @parent
    <link rel="stylesheet" href="{{ asset('/css/web/home.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/jquery-ui.min.css') }}">

@endsection

@section('script')
    @parent
    <script src="{{ asset('/js/jquery-ui.min.js') }}"></script>
    <script>
        $( function() {
            $( "#time_ielts_support" ).datepicker({ dateFormat: 'dd-mm-yy' });
        } );

        $('.list-teacher-show').slick({
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 3,
            dots: false,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: false,
                        arrows: false
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: false,
                        arrows: false
                    }
                }
            ]
        });

        $('.slider-for-student').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            autoplay: true,
            autoplaySpeed: 2000,
            asNavFor: '.slider-nav-student'
        });
        $('.slider-nav-student').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.slider-for-student',
            dots: false,
            centerMode: false,
            arrows: false,
            infinite: true,
            autoplay: true,
            autoplaySpeed: 2000,
            focusOnSelect: true
        });

        $('.list-why-different').slick({
            slidesToShow: 5,
            slidesToScroll: 5,
            dots: false,
            arrows: false,
            autoplay: false,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: true,
                        dots: true
                    }
                }
            ]
        });

        $('.list-access').slick({
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
                        autoplay: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: false,
                        autoplay: true,
                        dots: true
                    }
                }
            ]
        });

    </script>
@endsection
