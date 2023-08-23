@extends('web.layouts.web')

@section('content')
    <div class="content-register">
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <img src="{{ asset('images/register_success.png') }}" alt="" class="img-fluid mb-4">
                    <h1 class="title-register">Đăng ký khóa học thành công</h1>
                    <div class="mb-4">
                        Cảm ơn {{ $data->gender === 1 ? 'Chị' : 'Anh' }} {{ $data->full_name }} đã đăng ký khóa học trên IELTS Trainer!
                        IELTS Trainer sẽ gọi điện thông qua số điện thoại Đặt hàng của quý khách để xác nhận đơn hàng trong thời gian sớm nhất.
                        Nếu Quý khách có nhu cầu xem lại thông tin Đặt hàng, Quý khách vui lòng kiểm tra xác nhận đơn hàng đã được gửi qua email.
                        Mọi thắc mắc xin vui lòng liên hệ với IELTS Trainer qua Hotline {{ $setting['hotline'] }}
                    </div>
                    <div class="row button-go-to-page">
                        <div class="col-md-6">
                            <a href="{{ route('home') }}" class="go-to-home-page"><i class="fas fa-tv"></i> Về trang chủ</a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('homeCourse') }}" class="go-to-course-page">Xem thêm khóa học <i class="fas fa-paper-plane"></i></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('link')
    @parent
    <style>
        .content-register{
            padding: 50px 0;
            text-align: center;
        }
        .content-register img{
            display: block;
            margin: 0 auto;
        }
        .content-register .title-register{
            color: #E5AE35;
            font-size: 40px;
            margin-bottom: 40px;
        }
        .button-go-to-page a{
            border: 1px solid #BC2330;
            border-radius: 100px;
            text-align: center;
            padding: 14px 20px;
            display: block;
            text-decoration: none;
            font-family: HelveticaNeue-Bold;
        }
        .button-go-to-page .go-to-course-page{
            background: #BC2330;
            color: #fff;
        }
        .button-go-to-page .go-to-home-page{
            color: #BC2330;
        }
    </style>
@endsection

@section('script')
    @parent
@endsection
