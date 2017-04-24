<?php

return [
    'name' => [
        'required' => 'Bạn chưa nhập tên',
    ],
    'email' => [
        'required' => 'Bạn chưa nhập địa chỉ email',
        'email' => 'Địa chỉ email không hợp lệ',
        'unique' => 'Địa email đã đưọc sử dụng',
        'exists' => 'Tài khoản sai',
    ],
    'password' => [
        'required' => 'Yêu cầu nhập vào mật khẩu',
        'min' => 'Mật khẩu phải ít nhất chứa 6 ký tự',
        'confirmed' => 'Xác nhận mật khẩu không đúng',
    ],
];
