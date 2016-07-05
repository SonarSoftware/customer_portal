@extends('layouts.full')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{trans("headers.myDetails")}}</h3>
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['action' => 'ProfileController@update', 'id' => 'profileForm', 'method' => 'PATCH']) !!}
                        <div class="form-group">
                            <label for="name">{{trans("profile.name")}}</label>
                            {!! Form::text("name",$contact->getName(),['id' => 'name', 'class' => 'form-control', 'placeholder' => trans("profile.name")]) !!}
                        </div>
                        <div class="form-group">
                            <label for="role">{{trans("profile.role")}}</label>
                            {!! Form::text("role",$contact->getRole(),['id' => 'role', 'class' => 'form-control', 'placeholder' => trans("profile.role")]) !!}
                        </div>
                        <div class="form-group">
                            <label for="email_address">{{trans("profile.emailAddress")}}</label>
                            {!! Form::email("email_address",$contact->getEmailAddress(),['id' => 'email_address', 'class' => 'form-control', 'placeholder' => trans("profile.emailAddress")]) !!}
                        </div>
                        <div class="form-group">
                            <label for="home_phone">{{trans("profile.homePhone")}}</label>
                            {!! Form::tel("home_phone",$phoneNumbers[\SonarSoftware\CustomerPortalFramework\Models\PhoneNumber::HOME],['id' => 'home_phone', 'class' => 'form-control', 'placeholder' => trans("profile.homePhone")]) !!}
                        </div>
                        <div class="form-group">
                            <label for="mobile_phone">{{trans("profile.mobilePhone")}}</label>
                            {!! Form::tel("mobile_phone",$phoneNumbers[\SonarSoftware\CustomerPortalFramework\Models\PhoneNumber::MOBILE],['id' => 'mobile_phone', 'class' => 'form-control', 'placeholder' => trans("profile.mobilePhone")]) !!}
                        </div>
                        <div class="form-group">
                            <label for="work_phone">{{trans("profile.workPhone")}}</label>
                            {!! Form::tel("work_phone",$phoneNumbers[\SonarSoftware\CustomerPortalFramework\Models\PhoneNumber::WORK],['id' => 'work_phone', 'class' => 'form-control', 'placeholder' => trans("profile.workPhone")]) !!}
                        </div>
                        <div class="form-group">
                            <label for="fax">{{trans("profile.fax")}}</label>
                            {!! Form::tel("fax",$phoneNumbers[\SonarSoftware\CustomerPortalFramework\Models\PhoneNumber::FAX],['id' => 'fax', 'class' => 'form-control', 'placeholder' => trans("profile.fax")]) !!}
                        </div>
                        <button type="submit" class="btn btn-primary">{{trans("profile.updateProfile")}}</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{trans("headers.changePassword")}}</h3>
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['action' => 'ProfileController@updatePassword', 'id' => 'passwordForm', 'method' => 'PATCH']) !!}
                        <div class="form-group">
                            <label for="current_password">{{trans("profile.currentPassword")}}</label>
                            {!! Form::password("current_password",['id' => 'current_password', 'class' => 'form-control', 'placeholder' => trans("profile.currentPassword")]) !!}
                        </div>
                        <div class="form-group">
                            <label for="new_password">{{trans("profile.newPassword")}}</label>
                            {!! Form::password("new_password",['id' => 'current_password', 'class' => 'form-control', 'placeholder' => trans("profile.newPassword")]) !!}
                        </div>
                        <div class="form-group">
                            <label for="new_password_confirmation">{{trans("profile.newPasswordConfirmed")}}</label>
                            {!! Form::password("new_password_confirmation",['id' => 'new_password_confirmation', 'class' => 'form-control', 'placeholder' => trans("profile.newPasswordConfirmed")]) !!}
                        </div>
                        <button type="submit" class="btn btn-primary">{{trans("profile.changePassword")}}</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('additionalJS')
    {!! JsValidator::formRequest('App\Http\Requests\ProfileUpdateRequest', '#profileForm') !!}
    {!! JsValidator::formRequest('App\Http\Requests\UpdatePasswordRequest', '#passwordForm') !!}
@endsection