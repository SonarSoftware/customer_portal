@extends('layouts.full')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            {{trans("billing.addNewCard")}}
                        </h3>
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['action' => 'BillingController@storePaymentMethod', 'id' => 'createPaymentMethodForm']) !!}
                        <div class="form-group">
                            <label for="cc_number">{{trans("billing.creditCardNumber")}}</label>
                            <div class="input-group">
                                {!! Form::tel("cc-number",null,['id' => 'cc-number', 'autocomplete' => 'cc-number', 'class' => 'cc-number form-control', 'placeholder' => trans("billing.creditCardNumber")]) !!}
                                <span class="input-group-addon"><i class="fa fa-cc" id="ccIcon" style="width: 25px;"></i></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">{{trans("billing.nameOnCard")}}</label>
                            {!! Form::text("name",null,['id' => 'name', 'class' => 'form-control', 'placeholder' => trans("billing.nameOnCard")]) !!}
                        </div>
                        <div class="form-group">
                            <label for="name">{{trans("billing.expirationDate")}}</label>
                            {!! Form::tel("expirationDate",null,['id' => 'expirationDate', 'class' => 'form-control', 'placeholder' => trans("billing.expirationDate")]) !!}
                        </div>
                        <button type="submit" class="btn btn-primary">{{trans("billing.addNewCard")}}</button>
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