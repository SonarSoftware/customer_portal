@extends('layouts.full')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            {{utrans("headers.makeAPayment")}}
                        </h3>
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['action' => 'BillingController@submitPayment', 'id' => 'paymentForm', 'class' => 'form', 'autocomplete' => 'on']) !!}
                        <div class="form-group">
                            <label for="payment_method">{{utrans("billing.paymentMethod")}}</label>
                            <div class="form-group">
                                {!! Form::select("payment_method",$paymentMethods,'new_card',['id' => 'payment_method','class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group new_card">
                            <label for="name">{{utrans("billing.nameOnCard")}}</label>
                            {!! Form::text("name",null,['id' => 'name', 'class' => 'form-control', 'placeholder' => utrans("billing.nameOnCard")]) !!}
                        </div>
                        <div class="form-group new_card">
                            <label for="cc_number">{{utrans("billing.creditCardNumber")}}</label>
                            <div class="input-group">
                                {!! Form::tel("cc-number",null,['id' => 'cc-number', 'autocomplete' => 'cc-number', 'class' => 'cc-number form-control', 'placeholder' => utrans("billing.creditCardNumber")]) !!}
                                <span class="input-group-addon"><i class="fa fa-cc" id="ccIcon" style="width: 25px;"></i></span>
                            </div>
                        </div>
                        <div class="form-group new_card">
                            <label for="name">{{utrans("billing.expirationDate")}}</label>
                            {!! Form::tel("expirationDate",null,['id' => 'expirationDate', 'class' => 'form-control', 'placeholder' => utrans("billing.expirationDate")]) !!}
                        </div>
                        <div class="form-group new_card">
                            <label for="cvc">{{utrans("billing.cvc")}}</label>
                            <div class="input-group">
                                {!! Form::tel("cvc",null,['id' => 'cvc', 'autocomplete' => 'cvc', 'class' => 'form-control', 'placeholder' => utrans("billing.cvc")]) !!}
                            </div>
                        </div>
                        <div class="form-group new_card">
                            <label for="country">{{utrans("billing.country")}}</label>
                            {!! Form::select("country",countries(),\Illuminate\Support\Facades\Config::get("customer_portal.country"),['id' => 'country', 'class' => 'form-control', 'required' => true]) !!}
                        </div>
                        <div class="form-group new_card">
                            <label for="line1">{{utrans("billing.line1")}}</label>
                            {!! Form::text("line1",null,['id' => 'line1', 'class' => 'form-control', 'placeholder' => utrans("billing.line1"), 'required' => true]) !!}
                        </div>
                        <div class="form-group new_card">
                            <label for="city">{{utrans("billing.city")}}</label>
                            {!! Form::text("city",null,['id' => 'city', 'class' => 'form-control', 'placeholder' => utrans("billing.city"), 'required' => true]) !!}
                        </div>
                        <div class="form-group new_card">
                            <label for="state">{{utrans("billing.state")}}</label>
                            {!! Form::select("state",subdivisions(\Illuminate\Support\Facades\Config::get("customer_portal.country")),\Illuminate\Support\Facades\Config::get("customer_portal.state"),['id' => 'state', 'class' => 'form-control', 'required' => true]) !!}
                        </div>
                        <div class="form-group new_card">
                            <label for="zip">{{utrans("billing.zip")}}</label>
                            {!! Form::text("zip",null,['id' => 'zip', 'class' => 'form-control', 'placeholder' => utrans("billing.zip"), 'required' => true]) !!}
                        </div>
                        <div class="form-group">
                            <label for="amount">{{utrans("billing.amountToPay")}}</label>
                            {!! Form::number("amount",number_format($billingDetails->balance_due,2,".",""),['id' => 'amount', 'class' => 'form-control', 'placeholder' => utrans("billing.amountToPay"), 'steps' => 'any', 'required' => true]) !!}
                        </div>
                        <div class="form-group new_card">
                            <label>
                                {!! Form::checkbox("makeAuto",1,false,['id' => 'makeAuto']) !!}
                                {{utrans("billing.saveAsAutoPayMethod")}}
                            </label>
                            <p style="display: none;" id="autoPayDescription" class="help-block">{{utrans("billing.autoPayDescription")}}</p>
                        </div>
                        <button type="submit" class="btn btn-primary">{{utrans("billing.submitPayment")}}</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('additionalJS')
    <script src="/assets/js/vendor/jquery.payment/jquery.payment.min.js"></script>
    <script src="/assets/js/pages/billing/payment/page.js"></script>
    {!! JsValidator::formRequest('App\Http\Requests\CreditCardPaymentRequest','#paymentForm') !!}
@endsection