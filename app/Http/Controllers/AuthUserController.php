<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\{SignupRequest, SigninRequest};
use App\Models\{User, Role};

class AuthUserController extends Controller
{
    public function postSignup(SignupRequest $request, \Illuminate\Mail\Mailer $mailer)
    {
        $params = $request->only('name', 'email', 'password');
        $default = config('default.avatar');
        $size = 40;
        $params['avatar_link'] = "https://www.gravatar.com/avatar/" . md5($request->input('email')) . "?d=" . urlencode( $default ) . "&s=" . $size;
        $params['confirmed'] = false;
        $params['confirmation_code'] = str_random(40);
        // $params['avatar_link'] = getGravatarLink($request->input('email'));
        try {
            $user = User::create($params);
            if ($user) {
                $user->roles()->attach(Role::where('name', 'User')->first());
                $contactInfo = $user;
                $contactInfo['subject'] = 'Xác nhận tài khoản';
                $mailer->to($contactInfo['email'])
                    ->send(new \App\Mail\MyMail($contactInfo));

                return redirect()->back()->with([
                    config('common.flash_message') => "Đăng ký thành công! <br/> Bạn hãy đăng nhập hòm thư để xác nhận email",
                    config('common.flash_level_key') => 'success'
                ]);
            }
        } catch (Exception $e) {
            return redirect()->route('home')->with([
                'errors' => $e->getMesssage()
            ]);
        }

        return redirect()->back()->with([
            config('common.flash_message') => "Đăng ký không thành công!",
            config('common.flash_level_key') => 'danger'
        ]);
    }

    public function postSignin(SigninRequest $request)
    {
        $loginSuccess = Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);

        if ($loginSuccess) {
            $message = [
                config('common.flash_message') => trans('auth.login_success', ['name' => Auth::user()->name]),
                config('common.flash_level_key') => 'success',
            ];

            return redirect()->back()->with($message);
        }

        return redirect()->back();
    }

    public function getLogout(Request $request)
    {
        if (Auth::check()) {
            Auth::logout();
            $request->session()->flush();

            return redirect()->route('home');
        }
    }

    public function getGravatarLink($email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array()) {
        $url = 'https://www.gravatar.com/avatar/';
        $url .= md5($email);
        $url .= "?s=$s&d=$d&r=$r";
        if ( $img ) {
            $url = '<img src="' . $url . '"';
            foreach ( $atts as $key => $val )
                $url .= ' ' . $key . '="' . $val . '"';
            $url .= ' />';
        }

        return $url;
    }

    public function activateUser($code)
    {
        $user = User::where('confirmation_code', $code)->first();

        if ($user) {
            $successConfirm = $user->update([
                    'confirmed' => true,
                    'confirmation_code' => null,
                ]
            );
        }

        if ($successConfirm) {
            Auth::login($user);

            return redirect()->route('home')->with([
                config('common.flash_message') => 'Tài khoản của bạn đã đưọc kích hoạt',
                config('common.flash_level_key') => 'success'
            ]);
        }

        return redirect()->back()->with([
            config('common.flash_message') => 'Xác nhận thất bại, có thể hết hạn',
            config('common.flash_level_key') => 'danger'
        ]);
    }

    public function sendConfirmation(Request $request, \Illuminate\Mail\Mailer $mailer)
    {
        $this->validate($request, [
            'email' => 'required|exists:users'
        ]);
        $email = $request->email;
        $contactInfo['subject'] = "Xác nhận tài khoản";
        $contactInfo['confirmation_code'] = str_random(40);
        $user = User::where('email', $email)->where('confirmed', false)->first();

        if ($user) {
            if ($user->update(['confirmation_code' => $contactInfo['confirmation_code']])) {
                $mailer->to($email)
                    ->send(new \App\Mail\MyMail($contactInfo));

                    return redirect()->back()->with([
                        config('common.flash_message') => 'Đã gửi lại mã xác nhận! Hãy kiểm tra hòm mail',
                        config('common.flash_level_key') => 'success'
                    ]);
            }
        } else {
            return redirect()->back()->with([
                config('common.flash_message') => 'Tài khoản của bạn đã đưọc kích hoạt!',
                config('common.flash_level_key') => 'warning'
            ]);
        }
    }
}
