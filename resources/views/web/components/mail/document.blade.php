<!DOCTYPE html>
<html>
<head>
    <title>Thông điệp download</title>
</head>
<body>
<h1>Xin chào, {{ $data['full_name'] }}!</h1>
<p>Bạn nhận được thông tin download với các thông tin sau:</p>

<ul>
    <li>Tên: {{ $data['full_name'] }}</li>
    <li>Số điện thoại: {{ $data['phone'] }}</li>
    <li>Email: {{ $data['email'] }}</li>
    <li>Tải file ở đây: <a href="{{ $data['file'] }}">Tải file</a></li>
</ul>
</body>
</html>
