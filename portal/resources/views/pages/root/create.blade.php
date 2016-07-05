@extends('layouts.no_nav')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 give_bottom_room">
                <img src="/assets/images/transparent_logo.png">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{trans("headers.createYourAccount")}}</h3>
                    </div>
                    <div class="panel-body">
                        <p>
                            {{trans("register.creationDescription")}}
                        </p>
                        {!! Form::open(['action' => ['AuthenticationController@createAccount', 'token' => $creationToken->token], 'id' => 'createForm', 'method' => 'post']) !!}
                        <div class="form-group">
                            <label for="email">{{trans("register.email")}}</label>
                            {!! Form::email("email",null,['id' => 'email', 'class' => 'form-control', 'placeholder' => trans("register.email")]) !!}
                        </div>
                        <div class="form-group">
                            <label for="username">{{trans("register.username")}}</label>
                            {!! Form::text("username",null,['id' => 'username', 'class' => 'form-control', 'placeholder' => trans("register.username")]) !!}
                        </div>
                        <div class="form-group">
                            <label for="password">{{trans("register.password")}}</label>
                            {!! Form::password("password",['id' => 'password', 'class' => 'form-control', 'placeholder' => trans("register.password")]) !!}
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">{{trans("register.confirmPassword")}}</label>
                            {!! Form::password("password_confirmation",['id' => 'password_confirmation', 'class' => 'form-control', 'placeholder' => trans("register.confirmPassword")]) !!}
                        </div>
                        <button type="submit" class="btn btn-primary">{{trans("actions.createAccount")}}</button>
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
    {!! JsValidator::formRequest('App\Http\Requests\AccountCreationRequest','#createForm') !!}
@endsection
@section('additionalCSS')
    <link rel="stylesheet" href="/assets/css/pages/index.css">
@endsection