<div class="top-head">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-3 col-md-3">
                <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset($setting['logo']) }}" alt="{{ asset($setting['site_name']) }}" class="img-fluid logo-fs"></a>
            </div>
            <div class="col-md-9 d-none d-md-block">
                <div class="row">
                    <div class="col-md-6">
                        <ul class="list-unstyled list-hotline-email">
                            <li class="hotline-web d-inline-block">
                                <img src="{{ asset('images/hotline.png') }}" alt="Hotline">
                                Hotline: <a href="tel:{{ $setting['hotline'] }}">{{ $setting['hotline'] }}</a>
                            </li>
                            <li class="email-web d-inline-block">
                                <img src="{{ asset('images/email.png') }}" alt="Email">
                                Email: <a href="mailto:{{ $setting['email'] }}">{{ $setting['email'] }}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="action-top-head col-md-6">
                        <div class="row">
                            <div class="col-md-7">
                                <form action="" name="search-head-pc" class="search-head-pc">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="keyword" placeholder="Tìm kiếm" aria-label="Tìm kiếm" aria-describedby="button-search-top" required>
                                        <button class="btn btn-outline-secondary" type="submit" id="button-search-top"><i class="fas fa-search"></i></button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-5">
                                <a href="{{ route('detailAdvisory') }}" class="d-block register-trainer">Đăng ký tư vấn</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-9 d-block d-md-none">
                <div class="d-flex justify-content-end align-items-center mobile-head-top">
                    <p><i class="fas fa-search"></i></p>
                    <a href="{{ route('detailAdvisory') }}" class="d-block register-trainer">Tư vấn</a>
                    <button data-bs-toggle="modal" data-bs-target="#testOnline" class="btn d-block register-trainer">Test online</button>
                </div>
            </div>
        </div>
    </div>
</div>
