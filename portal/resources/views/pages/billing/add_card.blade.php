@extends('layouts.full')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            {{utrans("billing.addNewCard")}}
                        </h3>
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['action' => 'BillingController@storeCard', 'id' => 'createPaymentMethodForm']) !!}
                        <div class="form-group">
                            <label for="name">{{utrans("billing.nameOnCard")}}</label>
                            {!! Form::text("name",null,['id' => 'name', 'class' => 'form-control', 'placeholder' => utrans("billing.nameOnCard")]) !!}
                        </div>
                        <div class="form-group">
                            <label for="cc_number">{{utrans("billing.creditCardNumber")}}</label>
                            <div class="input-group">
                                {!! Form::tel("cc-number",null,['id' => 'cc-number', 'autocomplete' => 'cc-number', 'class' => 'cc-number form-control', 'placeholder' => utrans("billing.creditCardNumber")]) !!}
                                <span class="input-group-addon"><i class="fa fa-cc" id="ccIcon" style="width: 25px;"></i></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">{{utrans("billing.expirationDate")}}</label>
                            {!! Form::tel("expirationDate",null,['id' => 'expirationDate', 'class' => 'form-control', 'placeholder' => utrans("billing.expirationDate")]) !!}
                        </div>
                        <div class="form-group">
                            <label for="cvc">{{utrans("billing.cvc")}}</label>
                            <div class="input-group">
                                {!! Form::tel("cvc",null,['id' => 'cvc', 'autocomplete' => 'cvc', 'class' => 'form-control', 'placeholder' => utrans("billing.cvc")]) !!}
                                <span class="input-group-addon"><i class="fa fa-cc" id="ccIcon" style="width: 25px;"></i></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="country">{{utrans("billing.country")}}</label>
                            {!! Form::select("country",countries(),\Illuminate\Support\Facades\Config::get("customer_portal.country"),['id' => 'country', 'class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label for="line1">{{utrans("billing.line1")}}</label>
                            {!! Form::text("line1",null,['id' => 'line1', 'class' => 'form-control', 'placeholder' => utrans("billing.line1")]) !!}
                        </div>
                        <div class="form-group">
                            <label for="city">{{utrans("billing.city")}}</label>
                            {!! Form::text("city",null,['id' => 'city', 'class' => 'form-control', 'placeholder' => utrans("billing.city")]) !!}
                        </div>
                        <div class="form-group" id="stateWrapper" @if(count(subdivisions(\Illuminate\Support\Facades\Config::get("customer_portal.country"))) === 0) style="display:none;" @endif">
                            <label for="state">{{utrans("billing.state")}}</label>
                            {!! Form::select("state",subdivisions(\Illuminate\Support\Facades\Config::get("customer_portal.country")),\Illuminate\Support\Facades\Config::get("customer_portal.state"),['id' => 'state', 'class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label for="zip">{{utrans("billing.zip")}}</label>
                            {!! Form::text("zip",null,['id' => 'zip', 'class' => 'form-control', 'placeholder' => utrans("billing.zip")]) !!}
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    {!! Form::checkbox("auto",1,1) !!}
                                    {{utrans("billing.saveAsAutoPayMethod")}}
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">{{utrans("billing.addNewCard")}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('additionalJS')
    <script src="/assets/js/vendor/jquery.payment/jquery.payment.min.js"></script>
    <script src="/assets/js/pages/billing/payment/page.js"></script>
    {!! JsValidator::formRequest('App\Http\Requests\CreateCreditCardRequest','#createPaymentMethodForm') !!}
@endsection