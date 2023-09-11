@extends('web.layouts.web')

@section('content')
    <div class="banner-home">
        @include('web.components.image', ['src' => $banner->image_resize, 'title'=> $banner->title])
    </div>
    <div class="why-different">
        <div class="container">
            <h4 class="why-different-title">IELTS TRAINER - đồng hành cùng bạn chinh phục ielts</h4>
            <div class="d-none d-md-block">
                <div class="list-why-diffe" style="background: url('{{ asset((!empty($setting['background_home_different']))?$setting['background_home_different']:'images/bg-why.jpg') }}') no-repeat center; ">
                    @foreach($whyDifferent as $item)
                        <div class="box-why">
                            <div class="show-hidden-why">
                                <img src="{{ $item->icon }}" alt="{{ $item->title }}" class="img-fluid">
                                <p class="title-why-different">{{ $item->title }}</p>
                                <span>{{ $item->description }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="d-block d-md-none">
                <div class="list-why-different" style="background: url('{{ asset((!empty($setting['background_home_different']))?$setting['background_home_different']:'images/bg-why.jpg') }}') no-repeat center; ">
                    @foreach($whyDifferent as $item)
                        <div class="box-why">
                            <div class="show-hidden-why">
                                <img src="{{ $item->icon }}" alt="{{ $item->title }}" class="img-fluid">
                                <p class="title-why-different">{{ $item->title }}</p>
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
            @include('web.components.image', ['src' => 'images/route_learn.svg','class' => 'image_router'])
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
                    <p class="text-center">Các giảng viên có chuyên môn cao từ 8.0+ theo sát, chăm sóc học viên kỹ càng, tận tâm như người thân.</p>
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
                            <ul class="list-unstyled py-2 rounded d-flex justify-content-between align-items-center">
                                <li class="d-flex align-items-center">
                                    <svg width="30" height="30" viewBox="0 0 48 48" fill="#BC2330" xmlns="http://www.w3.org/2000/svg" style="margin-right: 10px;">
                                        <circle cx="24" cy="24" r="24" fill="#BC2330"></circle>
                                        <g clip-path="url(#clip0_170_6623)">
                                            <path d="M24 8C15.1773 8 8 14.8787 8 23.3333C8 27.692 9.94 31.8333 13.3333 34.7467V39.3333C13.334 39.5099 13.4045 39.6791 13.5294 39.804C13.6542 39.9288 13.8234 39.9993 14 40C14.125 40.0003 14.2475 39.9652 14.3533 39.8987L18.0693 37.5773C19.9573 38.3 21.9507 38.6667 24 38.6667C32.8227 38.6667 40 31.788 40 23.3333C40 14.8787 32.8227 8 24 8ZM25.5653 27.84L21.5973 24.4387C21.4951 24.3502 21.3683 24.2952 21.2339 24.2809C21.0995 24.2666 20.9639 24.2937 20.8453 24.3587L14.32 27.9187C14.1786 27.9933 14.0154 28.0154 13.8592 27.9813C13.7031 27.9471 13.564 27.8588 13.4667 27.732C13.3712 27.6034 13.325 27.4448 13.3365 27.285C13.348 27.1253 13.4164 26.975 13.5293 26.8613L21.5293 18.8613C21.7347 18.656 22.0347 18.4853 22.4347 18.8267L26.4027 22.228C26.505 22.3163 26.6318 22.3712 26.7662 22.3855C26.9005 22.3998 27.0361 22.3728 27.1547 22.308L33.68 18.7493C33.8215 18.6753 33.9846 18.6534 34.1406 18.6875C34.2966 18.7217 34.4357 18.8096 34.5333 18.936C34.6288 19.0646 34.675 19.2232 34.6635 19.383C34.652 19.5427 34.5836 19.693 34.4707 19.8067L26.4707 27.8067C26.2653 28.0093 25.9653 28.1813 25.5653 27.84Z" fill="white"></path>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_170_6623">
                                                <rect width="32" height="32" fill="white" transform="translate(8 8)"></rect>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <a href="{{ $setting['link_mess_facebook'] }}" target="_blank">Nhắn tin qua Facebook</a>
                                </li>
                                <li class="d-flex align-items-center">
                                    <svg width="30" height="30" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" style="padding-right: 4px;">
                                        <circle cx="24" cy="24" r="24" fill="#BC2330" style="padding-right: 10px; margin-right: 10px;"></circle>
                                        <g clip-path="url(#clip0_170_6625)">
                                            <path d="M40 23.9971C39.9989 26.7112 39.308 29.3804 37.9921 31.7541C36.6762 34.1277 34.7786 36.1278 32.4775 37.5663C30.1765 39.0049 27.5475 39.8347 24.8377 39.9778C22.1279 40.121 19.4262 39.5727 16.9864 38.3845L9.54 39.3159C9.41679 39.3313 9.29169 39.3177 9.17462 39.2764C9.05754 39.235 8.9517 39.1669 8.86547 39.0776C8.77923 38.9882 8.71498 38.88 8.67779 38.7616C8.6406 38.6431 8.6315 38.5175 8.6512 38.3949L9.784 31.3464C8.67246 29.1938 8.0641 26.8169 8.0048 24.3949C7.94549 21.9729 8.43678 19.569 9.44163 17.3645C10.4465 15.1601 11.9386 13.2126 13.8056 11.669C15.6726 10.1253 17.8656 9.02579 20.2193 8.45331C22.573 7.88083 25.0259 7.85033 27.3931 8.36411C29.7603 8.8779 31.98 9.92257 33.8847 11.4193C35.7895 12.9161 37.3296 14.8259 38.3889 17.0046C39.4482 19.1834 39.9991 21.5743 40 23.9971H40Z" fill="white"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M24.4568 22.3152V21.896H25.7136V27.796H24.9936C24.8516 27.796 24.7153 27.7398 24.6146 27.6397C24.5139 27.5396 24.4569 27.4036 24.456 27.2616C23.9993 27.5952 23.4591 27.7959 22.8954 27.8413C22.3316 27.8868 21.7663 27.7752 21.262 27.5191C20.7578 27.263 20.3343 26.8722 20.0384 26.3902C19.7426 25.9081 19.586 25.3536 19.586 24.788C19.586 24.2224 19.7426 23.6679 20.0384 23.1858C20.3343 22.7038 20.7578 22.313 21.262 22.0569C21.7663 21.8008 22.3316 21.6893 22.8954 21.7347C23.4591 21.7802 23.9993 21.9808 24.456 22.3144L24.4568 22.3152ZM19.2576 19.9984V20.1896C19.2772 20.5423 19.1789 20.8916 18.9784 21.1824L18.9504 21.2144C18.9 21.272 18.7808 21.4064 18.724 21.48L14.688 26.5424H19.2576V27.2624C19.2574 27.4051 19.2006 27.5418 19.0996 27.6426C18.9987 27.7434 18.8619 27.8 18.7192 27.8H12.8V27.4584C12.7831 27.1756 12.8655 26.8958 13.0328 26.6672L17.3344 21.3424H12.9792V19.9984H19.2576ZM27.2384 27.796C27.1197 27.7958 27.0058 27.7485 26.9219 27.6646C26.8379 27.5806 26.7906 27.4668 26.7904 27.348V19.9984H28.136V27.796H27.2384ZM32.1136 21.688C32.7237 21.6883 33.32 21.8695 33.8271 22.2087C34.3342 22.5479 34.7293 23.0299 34.9625 23.5936C35.1957 24.1574 35.2566 24.7776 35.1373 25.3759C35.018 25.9742 34.724 26.5237 34.2924 26.9549C33.8609 27.3862 33.3111 27.6797 32.7127 27.7986C32.1143 27.9174 31.4942 27.8561 30.9306 27.6224C30.367 27.3888 29.8854 26.9933 29.5466 26.4859C29.2078 25.9785 29.0271 25.3821 29.0272 24.772C29.0276 23.9538 29.353 23.1693 29.9318 22.5909C30.5106 22.0126 31.2954 21.6878 32.1136 21.688ZM22.6488 26.5904C23.0051 26.5906 23.3535 26.4851 23.6499 26.2872C23.9462 26.0894 24.1773 25.8081 24.3138 25.479C24.4503 25.1499 24.4861 24.7876 24.4168 24.4381C24.3474 24.0886 24.1759 23.7675 23.9241 23.5155C23.6723 23.2634 23.3513 23.0917 23.0019 23.022C22.6524 22.9523 22.2902 22.9878 21.9609 23.124C21.6316 23.2603 21.3502 23.491 21.1521 23.7872C20.954 24.0834 20.8482 24.4317 20.848 24.788C20.848 25.2658 21.0377 25.724 21.3754 26.0619C21.713 26.3999 22.1711 26.59 22.6488 26.5904ZM32.1136 26.5904C32.4726 26.5904 32.8235 26.484 33.122 26.2846C33.4205 26.0851 33.6531 25.8017 33.7906 25.47C33.928 25.1384 33.964 24.7735 33.894 24.4214C33.824 24.0693 33.6512 23.7458 33.3974 23.492C33.1437 23.2381 32.8203 23.0651 32.4682 22.995C32.1162 22.9249 31.7512 22.9607 31.4195 23.098C31.0878 23.2352 30.8043 23.4678 30.6047 23.7662C30.4052 24.0646 30.2986 24.4154 30.2984 24.7744C30.299 25.2555 30.4905 25.7167 30.8309 26.0567C31.1712 26.3967 31.6325 26.5878 32.1136 26.588V26.5904Z" fill="#BC2330"></path>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_170_6625">
                                                <rect width="32" height="32" fill="white" transform="translate(8 8)"></rect>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <a href="https://zalo.me/{{ $setting['phone_zalo'] }}">Nhắn tin qua Zalo</a>
                                </li>
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
                            <div class="position-relative">
                                <input type="text" class="form-control" placeholder="Bạn muốn IELTS TRAINER tư vấn lúc nào?" onchange="checkDateTime()" value="{{ old('time_ielts_support') }}" name="time_ielts_support" id="time_ielts_support" required>
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
                    <div class="col-md-7">
                        <div class="position-relative w-100 h-100 bg-for-form-advisory">
                            <img src="{{ asset('images/bg-advisory.svg') }}" alt="" class="img-fluid">
                        </div>
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
{{--    <script src="{{ asset('/js/jquery-ui.min.js') }}"></script>--}}
    <script>
        // Lấy tham chiếu đến phần tử input datetime-local
        var datetimeInput = $("#time_ielts_support");
        // Khi phần tử input datetime-local được tập trung vào (focus)
        datetimeInput.on("focus", function() {
            // Thay đổi loại của phần tử input sang "datetime-local"
            $(this).prop("type", "datetime-local");
        });

        // $( function() {
        //     $( "#time_ielts_support" ).datepicker({ dateFormat: 'dd-mm-yy' });
        // } );

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
