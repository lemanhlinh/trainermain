<!DOCTYPE html>
<html>
<head>
    <title>Đăng ký học thử miễn phí</title>
</head>
<body>
<h1>Xin chào, {{ $data['full_name'] }}!</h1>
<p>Bạn đăng ký học thử với các thông tin sau:</p>

<ul>
    <li>Tên: {{ $data['full_name'] }}</li>
    <li>Số điện thoại: {{ $data['phone'] }}</li>
    <li>Email: {{ $data['email'] }}</li>
    <li>Band điểm mong muốn của bạn?: {{ $data['why_learn_ielts'] }}</li>
    <li>Bạn muốn IELTS TRAINER tư vấn lúc nào?: {{ $data['time_ielts_support'] }}</li>
    <li>Bạn muốn kiểm tra ở trung tâm nào?: {{ $data['test_ielts_address'] }}</li>
</ul>
</body>
</html>
