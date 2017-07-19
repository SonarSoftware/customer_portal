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
                        <h3 class="panel-title">{{trans("headers.forgotUsernameOrPassword",[],$language)}}</h3>
                    </div>
                    <div class="panel-body">
                        <p>
                            {{trans("register.forgotDescription",[],$language)}}
                        </p>
                        {!! Form::open(['action' => 'AuthenticationController@sendResetEmail', 'id' => 'passwordResetForm', 'method' => 'post']) !!}
                        <div class="form-group">
                            <label for="email">{{trans("register.email",[],$language)}}</label>
                            {!! Form::email("email",null,['id' => 'email', 'class' => 'form-control', 'placeholder' => trans("register.email",[],$language)]) !!}
                        </div>
                        <button type="submit" class="btn btn-primary">{{trans("actions.sendResetEmail",[],$language)}}</button>
                        {!! Form::close() !!}
                    </div>
                </div>
                <p>
                    <a href="{{action("AuthenticationController@index")}}">{{trans("register.back",[],$language)}}</a>
                </p>
            </div>
        </div>
    </div>
@endsection
@section('additionalJS')
    {!! JsValidator::formRequest('App\Http\Requests\SendPasswordResetRequest','#passwordResetForm') !!}
@endsection
@section('additionalCSS')
    <link rel="stylesheet" href="/assets/css/pages/index.css">
@endsection