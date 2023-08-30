<div class="test-online">
    <button type="button" class="btn test-online-button" data-bs-toggle="modal" data-bs-target="#testOnline">
        <i class="fas fa-clipboard-list"></i> Test online miễn phí
    </button>

    <!-- Modal -->
    <div class="modal fade" id="testOnline" tabindex="-1" aria-labelledby="testOnlineLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="testOnlineLabel">Test online miễn phí</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('detailTestStore') }}" method="post" name="test-online" id="test-online">
                    @csrf
                    <div class="modal-body">
                        <p>Để tham gia test online, Quý khách vui lòng điền đầy đủ các thông tin dưới đây để tiến hành tham gia.</p>
                        <input type="text" class="form-control mb-3" value="{{ old('full_name')?old('full_name'):'' }}" placeholder="Họ và tên" name="full_name" required>
                        <input type="number" class="form-control mb-3" min="0" value="{{ old('phone')?old('phone'):'' }}" placeholder="Số điện thoại" name="phone" required>
                        <input type="email" class="form-control mb-3" value="{{ old('email')?old('email'):'' }}" placeholder="Email" name="email" required>
                        <select name="gender" id="gender-test" class="form-control mb-3 text-secondary" required>
                            <option value="">Giới tính</option>
                            <option value="1" {{ old('gender') == 1? 'selected':'' }}>Nam</option>
                            <option value="2" {{ old('gender') == 2? 'selected':'' }}>Nữ</option>
                        </select>
                        <input type="text" onfocus="(this.type='date')" value="{{ old('birthday')?old('birthday'):'' }}" placeholder="Năm sinh" name="birthday" class="form-control" required >
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger text-center w-100">Tham gia test</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="mobile-show d-block d-md-none">
    <button class="btn btn-show-social position-fixed" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">
        <ul class="list-social-mobile">
            <li class="firt-call-mobile"><img src="{{ asset('images/mobile/Property 1=Default.png') }}" alt="" class="img-fluid"></li>
            <li><img src="{{ asset('images/mobile/Property 1=Variant2.png') }}" alt="" class="img-fluid"></li>
            <li><img src="{{ asset('images/mobile/Property 1=Variant3.png') }}" alt="" class="img-fluid"></li>
            <li><img src="{{ asset('images/mobile/Property 1=Variant4.png') }}" alt="" class="img-fluid"></li>
            <li><img src="{{ asset('images/mobile/Property 1=Variant5.png') }}" alt="" class="img-fluid"></li>
        </ul>
    </button>

    <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
        <button type="button" class="btn-close text-reset btn-close-modal" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        <div class="offcanvas-header">
            <img src="{{ asset('images/mobile/logo-modal-mobile.png') }}" alt="{{ asset($setting['site_name']) }}" class="img-fluid">
            <h5 class="offcanvas-title" id="offcanvasBottomLabel">IELTS TRAINER có thể hỗ trợ gì cho anh chị ạ?</h5>
        </div>
        <div class="offcanvas-body large">
            <ul class="list-unstyled">
                <li class="d-flex"><img src="{{ asset('images/mobile/facebook.png') }}" alt="Nhắn tin qua Facebook" class="img-fluid"><a href="{{ $setting['link_facebook'] }}" target="_blank">Nhắn tin qua Facebook <span>{{ $setting['link_facebook'] }}</span></a></li>
                <li class="d-flex"><img src="{{ asset('images/mobile/zalo.png') }}" alt="Nhắn tin qua Zalo" class="img-fluid"><a href="https://zalo.me/{{ $setting['phone_zalo'] }}">Nhắn tin qua Zalo <span>zalo.me/{{ $setting['phone_zalo'] }}</span></a></li>
                <li class="d-flex"><img src="{{ asset('images/mobile/callcalling.png') }}" alt="Gọi điện thoại trực tiếp" class="img-fluid"><a href="tel:{{ $setting['hotline'] }}">Gọi điện thoại trực tiếp <span>{{ $setting['hotline'] }}</span></a></li>
                <li class="d-flex"><img src="{{ asset('images/mobile/sms.png') }}" alt="Liên hệ qua Email" class="img-fluid"><a href="mailto:{{ $setting['email'] }}">Liên hệ qua Email <span>{{ $setting['email'] }}</span></a></li>
            </ul>
        </div>
    </div>
</div>

<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form action="{{ route('formSearch') }}" name="search-head-pc" class="search-head-pc" method="post">
                    @csrf
                    <div class="input-group">
                        <input type="text" class="form-control" value="{{ old('keyword') }}" name="keyword" placeholder="Tìm kiếm" aria-label="Tìm kiếm" aria-describedby="button-search-top" required>
                        <button class="btn btn-outline-secondary" type="submit" id="button-search-top"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
