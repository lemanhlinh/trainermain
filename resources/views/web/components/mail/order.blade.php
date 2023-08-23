<!DOCTYPE html>
<html>
<head>
    <title>Mua khóa học</title>
</head>
<body>
<h1>Xin chào, {{ $data['full_name'] }}!</h1>
<p>Bạn đăng ký mua khóa học với các thông tin sau:</p>

<ul>
    <li>Giới tính: {{ $data['gender'] == 0 ? 'Anh' : 'Chị' }}</li>
    <li>Tên: {{ $data['full_name'] }}</li>
    <li>Số điện thoại: {{ $data['phone'] }}</li>
    <li>Email: {{ $data['email'] }}</li>
    <li>Địa chỉ: {{ $data['address'] }}</li>
    <li>Ghi chú: {{ $data['note'] }}</li>
    <li>Khóa học đăng ký: <a href="{{ route('detailCourse',[$course->slug,$course->id]) }}" target="_blank" >{{ $course->title }}</a></li>
    <li>Giá khóa học: {{ number_format($course->price_new, 0, ',', '.') }}đ</li>
    @if($data['voucher_course'])
        <li>Mã giảm giá: {{ $data['voucher_course'] }}</li>
        <li>Thông tin: {{ $data['message'] }}, <b>Lưu ý giá trên chưa áp dụng</b></li>
    @endif
</ul>
</body>
</html>
