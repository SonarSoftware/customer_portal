@extends('layouts.no_nav')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 give_bottom_room">
                @if(file_exists(base_path("/public/assets/images/logo.png")))
                    <img src="/assets/images/logo.png">
                @else
                    <img src="/assets/images/transparent_logo.png">
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{trans("headers.newPassword")}}</h3>
                    </div>
                    <div class="panel-body">
                        <p>
                            {{trans("register.resetDescription")}}
                        </p>
                        {!! Form::open(['action' => ['AuthenticationController@updateContactWithNewPassword', 'token' => $passwordReset->token], 'id' => 'passwordResetForm', 'method' => 'post']) !!}
                        <div class="form-group">
                            <label for="email">{{trans("register.email")}}</label>
                            {!! Form::email("email",null,['id' => 'email', 'class' => 'form-control', 'placeholder' => trans("register.email")]) !!}
                        </div>
                        <div class="form-group">
                            <label for="password">{{trans("register.password")}}</label>
                            {!! Form::password("password",['id' => 'password', 'class' => 'form-control', 'placeholder' => trans("register.password")]) !!}
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation ">{{trans("register.confirmPassword")}}</label>
                            {!! Form::password("password_confirmation",['id' => 'password_confirmation', 'class' => 'form-control', 'placeholder' => trans("register.confirmPassword")]) !!}
                        </div>
                        <button type="submit" class="btn btn-primary">{{trans("actions.lookupEmail")}}</button>
                        {!! Form::close() !!}
                    </div>
                </div>
                <p>
                    <a href="{{action("AuthenticationController@index")}}">{{trans("register.back")}}</a>
                </p>
            </div>
        </div>
    </div>
@endsection
@section('additionalJS')
    {!! JsValidator::formRequest('App\Http\Requests\PasswordUpdateRequest','#passwordResetForm') !!}
@endsection
@section('additionalCSS')
    <link rel="stylesheet" href="/assets/css/pages/index.css">
@endsection