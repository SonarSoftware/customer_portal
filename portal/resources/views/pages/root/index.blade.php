@extends('layouts.no_nav')
@section('styles')
<style>
body{
	background-image:url({{ asset('assets/images/body-bg.jpg') }});
	background-repeat: no-repeat;
}
.loginbox .col-sm-6 {
    padding: 10px 15px;
    min-height: 386px;
}
</style>
@endsection
@section('content')
<div class="vertically-center">
    <div class="container">
	
        @if(Config::get("customer_portal.login_page_message"))
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="alert alert-info" role="alert">
                        <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                        {{Config::get("customer_portal.login_page_message")}}
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
				<div class="row loginbox">
					<div class="col-sm-6 bg_darkgrey">
						<div class="loginlogo">
						<img src="{{ asset('assets/images/login-logo.png') }}">
						</div>
					</div>
					<div class="col-sm-6">
					@if(count(getAvailableLanguages()) > 1)
								<div class="lang_selector">
									@if(count(getAvailableLanguages()) > 1)
										@include("layouts.partials.lang")
									@endif
								</div>
					@endif
						<h2>SIGN IN <div class="pull-right"><a class="smalltext text-upper" href="{{action("AuthenticationController@showRegistrationForm")}}" role="button">{{trans("root.register",[],$language)}}</a></div></h2>
						{!! Form::open(['action' => 'AuthenticationController@authenticate']) !!}
						<input type="hidden" name="language" value="{{$language}}">
						<div class="form-group">
							{!! Form::text("username",null,['placeholder' => trans("root.username",[],$language), 'id' => 'username', 'class' => 'hasicon email form-control']) !!}
						</div>
						<div class="form-group">
							{!! Form::password("password",['placeholder' => trans("root.password",[],$language), 'id' => 'password', 'class' => 'hasicon pass form-control']) !!}
						</div>
						<p>
							<a class="smalltext text-upper" href="{{action("AuthenticationController@showResetPasswordForm")}}">{{trans("root.forgot",[],$language)}}</a>
						</p>
						<button type="submit" class="btn btn-success btn-lg btn-block">{{trans("actions.login",[],$language)}} &raquo;</button>
						{!! Form::close() !!}
					</div>
				</div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('additionalCSS')
    <link rel="stylesheet" href="/assets/css/pages/index.css">
@endsection
@section('additionalJS')
    {!! JsValidator::formRequest('App\Http\Requests\AuthenticationRequest') !!}
@endsection