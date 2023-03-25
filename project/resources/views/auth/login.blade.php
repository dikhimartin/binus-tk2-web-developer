@extends('layouts.backend.login')

@section('content')
    <section id="wrapper">
        <div class="login-register">
            <div class="login-box card">
                <div class="card-body">
                    <!-- Form Login -->
                    <form action="/login" class="form-horizontal form-material login-form" id="loginform" role="form" method="POST" onsubmit="return validasi_input(this)">
                        {{ csrf_field() }}

                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <a href="/" class="text-center db"><img src="{{ URL::asset('admin_assets/assets/images/logo-icon.png') }}" alt="MartinCodes" width="100" /></a>
                                    <h4 class="box-title m-b-15 text-center text-muted mt-4">{{ config('app.name', 'Laravel') }}</h4>
                                </div>
                            </div>

                            <div class="form-group" id="username">
                                <div class="col-xs-12">
                                    <input class="form-control" type="text"placeholder="Username" name="username" value="{{ old('username') }}">
                                </div>
                                <small class="form-control-feedback" id="alert-username"></small>
                            </div>

                            <div class="form-group" id="password">
                                <div class="col-xs-12">
                                    <input name="password" class="form-control" type="password" placeholder="Kata Sandi">
                                </div>
                                <small class="form-control-feedback" id="alert-password"></small>
                            </div>

                            @if (config('app.env') == 'production')
                                <div class="form-group {{ $errors->has('g-recaptcha-response') ? ' has-danger' : '' }}">
                                    <div class="input-group">
                                        {!! NoCaptcha::renderJs() !!}
                                        {!! NoCaptcha::display() !!}
                                    </div>
                                </div>
                            @endif
                            
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <p>{{ $error }}</p>
                                    @endforeach
                                </div>
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger">
                                    <p> {{ session('error') }}</p>
                                </div>
                            @endif


                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <div class="form-group text-center m-t-20">
                                <div class="col-xs-12">
                                    <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">{{__('main.login')}}</button>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12 font-14">
                                    <div class="checkbox checkbox-primary pull-left p-t-0">
                                        <input id="checkbox-signup" type="checkbox">
                                        <label for="checkbox-signup">{{__('main.remember_me')}}</label>
                                    </div> 
                                    <a href="{{ LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(),URL::to( 'password/reset' ))}}" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> {{ __('main.forgot_password') }}?</a> 
                                </div>
                            </div>

                            <div class="form-group m-b-0">
                                <div class="col-sm-12 text-center">
                                    <div>{{ __('main.dont_have_an_account') }} <a href="/register" class="text-info m-l-5"><b>{{ __('main.signup') }}</b></a></div>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

<script type="text/javascript">
    function validasi_input(form){

        $('.has-success').removeClass( "has-success");
        $('.has-danger').removeClass( "has-danger");
        $('.form-control-feedback').text("");

        // validasi
        if (form.username.value == ""){
            $("#username").addClass("form-group has-danger");
            $("#alert-username").text("Please fill in Username");
            form.username.focus();
            return (false);
        }
        if (form.password.value == ""){
            $("#password").addClass("form-group has-danger");
            $("#alert-password").text("Please fill in Password");
            form.password.focus();
            return (false);
        }

        return (true);
    }
</script>

