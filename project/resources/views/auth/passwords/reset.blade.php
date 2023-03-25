@extends('layouts.backend.login')

@section('content')

<section id="wrapper">
    <div class="login-register">
        <div class="login-box card">
            <div class="card-body">
                <div class="form-group ">
                    <div class="col-xs-12">
                        <a href="/" class="text-center db"><img src="{{ URL::asset('admin_assets/assets/images/logo-icon.png') }}" alt="MartinCodes" width="100" /></a>
                        <h3 class="text-center mt-5">{{ __('main.recover_password') }}</h3>
                    </div>
                </div>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group {{ $errors->has('email') ? ' has-danger' : '' }}">
                        <div class="col-xs-12">
                            <input id="email" type="email" class="form-control" placeholder="Email" name="email">
                            @if ($errors->has('email'))
                                <small class="form-control-feedback">{{ $errors->first('email') }}</small>
                            @endif
                        </div>
                    </div>
                        
                    <div class="form-group {{ $errors->has('password') ? ' has-danger' : '' }}">
                        <div class="col-xs-12">
                            <input id="password" type="password" class="form-control" placeholder="Kata Sandi" name="password" required>
                            @if ($errors->has('password'))
                                <small class="form-control-feedback">{{ $errors->first('password') }}</small>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('password_confirmation') ? ' has-danger' : '' }}">
                        <div class="col-xs-12">
                            <input id="password-confirm" type="password" class="form-control"  placeholder="Konfirmasi Kata Sandi" name="password_confirmation" required>
                            @if ($errors->has('password_confirmation'))
                                <small class="form-control-feedback">{{ $errors->first('password_confirmation') }}</small>
                            @endif
                        </div>
                    </div>                    
    
                    <div class="form-group">
                        <div class="form-group text-center m-t-20">
                            <button type="submit" class="btn btn-info">
                                {{ __('Atur Ulang Kata Sandi') }}
                            </button>
                        </div>
                    </div>    
                </form>
            </div>
        </div>
    </div>
</section>
@endsection