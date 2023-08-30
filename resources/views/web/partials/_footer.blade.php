<footer class="main-footer text-light">
    <div class="top-footer py-5">
        <div class="container">
            <p class="mb-4"><img src="{{ asset('images/logo-footer.png') }}" alt=""></p>
            <div class="row">
                <div class="col-md-6">
                    {!! $setting['footer_1'] !!}
                </div>
                <div class="col-md-2">
                    <h4  class="fw-bold mb-3">Khóa học</h4>
                    <ul class="list-unstyled list-course-home-ft">
                        @if(!empty($course_all))
                            @foreach($course_all as $item)
                                <li class="position-relative"><a href="{{ route('detailCourse',[$item->slug,$item->id]) }}" class="stretched-link">{{ $item->title }}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div class="col-md-4">
                    {!! $setting['footer_2'] !!}
                    <p class="register-program">
                        <a href="{{ route('homeCourse') }}"><img src="{{ asset('images/book1.png') }}" alt="">Đăng ký khóa học</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-footer py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-8"><span class="year-product">© 2023 Công ty TNHH Giáo dục IELTS TRAINER. All Rights Reserved.</span></div>
                <div class="col-md-4">
                    <ul class="list-unstyled text-uppercase m-0 list-social-ft">
                        <li>
                            <a href="{{ $setting['link_facebook'] }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        </li>
                        <li>
                            <a href="{{ $setting['link_youtube'] }}" target="_blank"><i class="fab fa-youtube"></i></a>
                        </li>
                        <li>
                            <a href="{{ $setting['link_instagram'] }}" target="_blank"><i class="fab fa-instagram"></i></a>
                        </li>
                        <li>
                            <a href="{{ $setting['link_tiktok'] }}" target="_blank"><i class="fab fa-tiktok"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="position-fixed bottom-0 start-50 translate-middle-x d-block d-md-none w-100 z-3">
    <div class="menu-mobile">
        <ul class="list-unstyled text-uppercase m-0 d-flex justify-content-between">
            @include('web.components.menu.mobile')
        </ul>
    </div>
</div>
<div class="position-fixed z-3 scroll-top">
    <a href="#">
        <i class="fas fa-chevron-up"></i>
    </a>
</div>
<div id="notification" ></div>
<div class="phone-call">
    <a href="tel:{{ $setting['hotline'] }}">
        <div class="content-center">
            <div class="pulse">
                <i class="fas fa-phone"></i>
            </div>
        </div>
    </a>
</div>
