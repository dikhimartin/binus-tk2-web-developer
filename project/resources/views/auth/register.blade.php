@extends('layouts.backend.login')

@section('content')
<section id="wrapper">
        <div class="login-register">
            <div class="login-box card">
                <div class="card-body">
                    <!-- Form Registrasi -->
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}

                    <div class="form-group ">
                        <div class="col-xs-12">
                            <a href="/" class="text-center db"><img src="{{ URL::asset('admin_assets/assets/images/logo-icon.png') }}" alt="MartinCodes" width="100" /></a>
                            <h4 class="box-title m-b-15 text-center text-muted mt-4">{{ config('app.name', 'Laravel') }}</h4>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" placeholder="Name" name="name" value="{{ old('name') }}">
                        </div>
                        @if ($errors->has('name'))
                            <small class="form-control-feedback">{{ $errors->first('name') }}</small>
                        @endif
                    </div>    

                    <div class="form-group{{ $errors->has('username') ? ' has-danger' : '' }}">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" placeholder="Username" name="username" value="{{ old('username') }}">
                        </div>
                        @if ($errors->has('username'))
                            <small class="form-control-feedback">{{ $errors->first('username') }}</small>
                        @endif
                    </div>    

                    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" placeholder="Password" name="password" value="{{ old('password') }}">
                        </div>
                        @if ($errors->has('password'))
                            <small class="form-control-feedback">{{ $errors->first('password') }}</small>
                        @endif
                    </div>    

                    <div class="col-xs-12">
                        <input class="form-control" id="password-confirm" type="password" placeholder="Confirm Password" name="password_confirmation" required">
                    </div>

                    @if (config('app.env') == 'production')
                        <div class="form-group mt-3 {{ $errors->has('g-recaptcha-response') ? ' has-danger' : '' }}">
                            <div class="input-group">
                                {!! NoCaptcha::renderJs() !!}
                                {!! NoCaptcha::display() !!}
                            </div>
                        </div>
                    @endif                    

                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Registrasi</button>
                        </div>
                    </div>                
                  
                </form>
                </div>
            </div>
        </div>
</section>
@endsection
