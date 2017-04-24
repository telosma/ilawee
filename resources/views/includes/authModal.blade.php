<div class="modal fade" id="auth-modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-body">
            <div class="row">
                <div class="form-body">
                    <ul class="nav nav-tabs final-login">
                        <li class="active"><a data-toggle="tab" href="#sectionA">Đăng nhập</a></li>
                        <li><a data-toggle="tab" href="#sectionB">Đăng ký!</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="sectionA" class="tab-pane fade in active">
                        <div class="innter-form">
                            {{ Form::open(['route' => 'signin', 'method' => 'post', 'class' => 'sa-innate-form']) }}
                                {{ Form::label('email', 'Email') }}
                                {{ Form::text('email') }}
                                {{ Form::label('password', 'Mật khẩu') }}
                                {{ Form::password('password') }}
                                {{ Form::submit('Đăng nhập') }}
                            {{ Form::close() }}
                            </div>
                            <div class="social-login">
                                <h4 align="center">Đăng nhập với</h4>
                                <ul>
                                    <li><a href="{{ route('redirectToProvider', 'facebook') }}"><i class="fa fa-facebook"></i> Facebook</a></li>
                                    <li><a href="{{ route('redirectToProvider', 'google') }}"><i class="fa fa-google-plus"></i> Google+</a></li>
                                </ul>
                                <a data-dismiss="modal" data-toggle="modal" href="#resend-confirm-modal" style="margin-top: 20px; display: inline-block;">
                                    <b>Gửi lại mã xác nhận tài khoản</b>
                                </a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div id="sectionB" class="tab-pane fade">
                            <div class="innter-form">
                                {{ Form::open(['route' => 'signup', 'method' => 'POST', 'class' => 'sa-innate-form']) }}
                                    {{ Form::label('name', 'Họ tên') }}
                                    {{ Form::text('name') }}
                                    {{ Form::label('email', 'Email') }}
                                    {{ Form::text('email') }}
                                    {{ Form::label('password', 'Mật khẩu') }}
                                    {{ Form::password('password') }}
                                    {{ Form::label('password_confirmation', 'Xác nhận') }}
                                    {{ Form::password('password_confirmation') }}
                                    {{ Form::submit('Đăng ký') }}
                                {{ Form::close() }}
                            </div>
                            <div class="social-login">
                                <h4 align="center">Đăng ký qua</h4>
                                <ul>
                                    <li><a href="{{ route('redirectToProvider', 'facebook') }}"><i class="fa fa-facebook"></i> Facebook</a></li>
                                    <li><a href="{{ route('redirectToProvider', 'google') }}"><i class="fa fa-google-plus"></i> Google+</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="resend-confirm-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Gửi lại email xác nhận</h3>
            </div>
            <div class="box-warper modal-body">
                <div class="form-group">
                    {{ Form::open([
                        'route' => 'user.confirm',
                        'method' => 'post',
                        'id' => 'resend-confirm-form',
                        'data-toggle' => 'validator',
                        'role' => 'form',
                    ]) }}
                        <div class="control-group">
                            {{ Form::label('email', 'Địa chỉ email') }}
                            {{ Form::text('email', null, [
                                'class' => 'form-control',
                                'placeholder' => 'email cần xác nhận',
                                'required' => true,
                            ]) }}
                        </div>
                        {{ Form::submit('Gửi mã xác nhận', ['class' => 'btn btn-info mgv15']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
