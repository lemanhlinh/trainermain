@extends('web.layouts.web')

@section('content')
    <div class="content-detail">
        <div class="container">
            <h1 class="title-contact">Liên hệ</h1>
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h3 class="title-form-contact">Đặt câu hỏi hay lời nhắn</h3>
                    <p class="des-form-contact">Chúng tôi sẽ liên hệ với bạn ngay khi nhận được tin nhắn</p>
                    <form action="{{ route('detailContactStore') }}" name="form-contact" id="form-contact" class="form-contact" method="POST" enctype="multipart/form-data">
                        @csrf
                        @include('web.contact.form')
                        <button type="submit" class="btn submit-form-contact">Gửi liên hệ</button>
                    </form>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-5">
                    <div class="box-contact">
                        @include('web.components.image', ['src' => 'images/customer-support.png'])
                        <ul class="info-box">
                            <li>Hotline: <span class="color-other-contact">{{ $setting['hotline'] }}</span></li>
                            <li>Giờ hỗ trợ: {{ $setting['time_work_contact'] }}</li>
                        </ul>
                    </div>
                    <div class="box-contact">
                        @include('web.components.image', ['src' => 'images/email-contact2.png'])
                        <ul class="info-box">
                            <li>Email: <span>{{ $setting['email'] }}</span></li>
                            <li>Nhóm hỗ trợ của chúng tôi sẽ liên hệ lại sau 24 giờ trong giờ làm việc thông thường.</li>
                        </ul>
                    </div>
                    <div class="box-contact">
                        @include('web.components.image', ['src' => 'images/link-contact3.png'])
                        <ul class="info-box">
                            <li>Fanpage: {{ $setting['link_facebook'] }}</li>
                            <li>Chúng tôi online: {{ $setting['time_work_contact'] }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-detail-bottom">
        <div class="container">
            <h4 class="title-bottom-contact">Hẹn gặp bạn tại cơ sở IELTS Trainer gần nhất của chúng mình nhé!</h4>
            <div class="row">
                @forelse($stores as $store)
                <div class="col-md-6">
                    <h3>Công ty TNHH Giáo dục IELTS Trainer</h3>
                    <ul class="list-unstyled">
                        <li>{{ $store->title }}</li>
                        <li>Tel: {{ $store->phone }}</li>
                    </ul>
                </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>
@endsection

@section('link')
    @parent
    <link rel="stylesheet" href="{{ asset('/css/web/contact-detail.css') }}">
@endsection

@section('script')
    @parent
@endsection
