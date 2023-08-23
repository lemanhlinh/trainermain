<!DOCTYPE html>
<html>
<head>
    <title>Test online</title>
</head>
<body>
<h1>Xin chào, {{ $data['full_name'] }}!</h1>
<p>Bạn đăng ký test online với các thông tin sau:</p>

<ul>
    <li>Tên: {{ $data['full_name'] }}</li>
    <li>Số điện thoại: {{ $data['phone'] }}</li>
    <li>Email: {{ $data['email'] }}</li>
    <li>Giới tính: {{ $data['gender'] == 1 ? 'Nam' : 'Nữ' }}</li>
    <li>Năm sinh: {{ $data['birthday'] }}</li>
</ul>
</body>
</html>
