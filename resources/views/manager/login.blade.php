<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>Quản trị ilawee</title>
        {!! Html::style('css/login-form.css') !!}
    </head>
    <body>
        {!! Form::open([
            'url' => route('manager.postLogin'),
            'class' => 'login',
            'method' => 'post',
        ]) !!}
            <h1>Đăng nhập quyền Cộng tác viên</h1>
            @include('includes.error')
            @include('includes.message')
            <fieldset class="inputs">
                {!! Form::email('email', null, [
                    'class' => 'email',
                    'placeholder' => trans('admin.email'),
                ]) !!}
                {!! Form::password('password', [
                    'class' => 'password',
                    'placeholder' => trans('admin.password'),
                ]) !!}
            </fieldset>
            <fieldset class="actions">
                {!! Form::submit('Đăng nhập', ['class' => 'submit']) !!}
            </fieldset>
        {!! Form::close() !!}
        {!! Html::script('js/jquery.min.js') !!}
        {!! Html::script('js/adminScript.js') !!}
    </body>
</html>
