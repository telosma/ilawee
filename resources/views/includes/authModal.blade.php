<div class="modal fade" id="auth-modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-body">
            {{-- <div class="container"> --}}
                <div class="row">
                    {{-- <div class="col-md-4 col-md-offset-4"> --}}
                        <div class="form-body">
                            <ul class="nav nav-tabs final-login">
                                <li class="active"><a data-toggle="tab" href="#sectionA">Đăng nhập</a></li>
                                <li><a data-toggle="tab" href="#sectionB">Đăng ký!</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="sectionA" class="tab-pane fade in active">
                                <div class="innter-form">
                                    {{ Form::open(['url' => '', 'method' => 'post', 'class' => 'sa-innate-form']) }}
                                        {{ Form::label('username', 'Tài khoản') }}
                                        {{ Form::text('username') }}
                                        {{ Form::label('password', 'Mật khẩu') }}
                                        {{ Form::text('password') }}
                                        {{ Form::submit('Đăng nhập') }}
                                    {{ Form::close() }}
                                    </div>
                                    <div class="social-login">
                                    <p>- - - - - - - - - - - - - Sign In With - - - - - - - - - - - - - </p>
                                    <ul>
                                    <li><a href=""><i class="fa fa-facebook"></i> Facebook</a></li>
                                    <li><a href=""><i class="fa fa-google-plus"></i> Google+</a></li>
                                    <li><a href=""><i class="fa fa-twitter"></i> Twitter</a></li>
                                    </ul>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div id="sectionB" class="tab-pane fade">
                                    <div class="innter-form">
                                    <form class="sa-innate-form" method="post">
                                    <label>Name</label>
                                    <input type="text" name="username">
                                    <label>Email Address</label>
                                    <input type="text" name="username">
                                    <label>Password</label>
                                    <input type="password" name="password">
                                    <button type="submit">Join now</button>
                                    </form>
                                    </div>
                                    <div class="social-login">
                                    <p>- - - - - - - - - - - - - Register With - - - - - - - - - - - - - </p>
                                    <ul>
                                    <li><a href=""><i class="fa fa-facebook"></i> Facebook</a></li>
                                    <li><a href=""><i class="fa fa-google-plus"></i> Google+</a></li>
                                    <li><a href=""><i class="fa fa-twitter"></i> Twitter</a></li>
                                    </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    {{-- </div> --}}
                </div>
            {{-- </div> --}}
        </div>
    </div>
</div>
