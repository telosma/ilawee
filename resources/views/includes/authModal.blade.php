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
                            {{ Form::open(['url' => '', 'method' => 'post', 'class' => 'sa-innate-form']) }}
                                {{ Form::label('email', 'Email') }}
                                {{ Form::text('email') }}
                                {{ Form::label('password', 'Mật khẩu') }}
                                {{ Form::text('password') }}
                                {{ Form::submit('Đăng nhập') }}
                            {{ Form::close() }}
                            </div>
                            <div class="social-login">
                            <h4 align="center">Đăng nhập với</h4>
                            <ul>
                            <li><a href=""><i class="fa fa-facebook"></i> Facebook</a></li>
                            <li><a href=""><i class="fa fa-google-plus"></i> Google+</a></li>
                            </ul>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div id="sectionB" class="tab-pane fade">
                            <div class="innter-form">
                                {{ Form::open(['url' => '', 'method' => 'post', 'class' => 'sa-innate-form']) }}
                                    {{ Form::label('name', 'Họ tên') }}
                                    {{ Form::text('name') }}
                                    {{ Form::label('email', 'Email') }}
                                    {{ Form::text('email') }}
                                    {{ Form::label('password', 'Mật khẩu') }}
                                    {{ Form::text('password') }}
                                    {{ Form::submit('Đăng ký') }}
                                {{ Form::close() }}
                            </div>
                            <div class="social-login">
                                <h4 align="center">Đăng ký qua</h4>
                                <ul>
                                    <li><a href=""><i class="fa fa-facebook"></i> Facebook</a></li>
                                    <li><a href=""><i class="fa fa-google-plus"></i> Google+</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
