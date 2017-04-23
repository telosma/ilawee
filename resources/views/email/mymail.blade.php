<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>My Mail</title>
    <link rel="stylesheet" href="">
</head>
<body>
    <h1>Bạn có email</h1>
    <h3>{{ $contactInfo['subject'] }}</h3>
    <p>Đi đến dường dẫn bên dưới để xác nhận tài khoản</p>
    <a href="{!! route('user.activate', $contactInfo['confirmation_code']) !!}">
        <span>Xác nhận</span>
    </a>
</body>
</html>
