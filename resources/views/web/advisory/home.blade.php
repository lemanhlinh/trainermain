@extends('web.layouts.web')

@section('content')
    <div class="form-advisory">
        <div class="container">
            <div class="register-learn">
                <div class="row">
                    <div class="col-md-5">
                        <h1 class="title-form-add">Nhận tư vấn MIỄN PHÍ<br>
                            Hoàn thành mục tiêu IELTS ngay bây giờ!</h1>
                        <div class="mb-4 list-chat-form">
                            <ul class="list-unstyled bg-white p-3 rounded d-flex justify-content-between">
                                <li class="d-flex"><img src="{{ asset('images/mobile/facebook.png') }}" alt="Nhắn tin qua Facebook" class="img-fluid me-2"><a href="{{ $setting['link_facebook'] }}" target="_blank">Nhắn tin qua Facebook</a></li>
                                <li class="d-flex"><img src="{{ asset('images/mobile/zalo.png') }}" alt="Nhắn tin qua Zalo" class="img-fluid me-2"><a href="https://zalo.me/{{ $setting['phone_zalo'] }}">Nhắn tin qua Zalo</a></li>
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
                            <input type="text" class="form-control" placeholder="Bạn muốn IELTS TRAINER tư vấn lúc nào?" value="{{ old('time_ielts_support') }}" id="time_ielts_support" name="time_ielts_support" required>
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
@endsection

@section('link')
    @parent
    <link rel="stylesheet" href="{{ asset('/css/web/advisory.css') }}">
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
    </script>
@endsection
