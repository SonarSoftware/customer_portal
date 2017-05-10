@extends('layouts.full')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            {{trans("billing.addNewBankAccount")}}
                        </h3>
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['action' => 'BillingController@storeBank', 'id' => 'createPaymentMethodForm']) !!}
                        <div class="form-group">
                            <label for="name">{{trans("billing.nameOnAccount")}}</label>
                            {!! Form::text("name",null,['id' => 'name', 'class' => 'form-control', 'placeholder' => trans("billing.nameOnAccount")]) !!}
                        </div>
                        <div class="form-group">
                            <label for="account_number">{{trans("billing.accountNumber")}}</label>
                            {!! Form::tel("account_number",null,['id' => 'account_number', 'class' => 'form-control', 'placeholder' => trans("billing.accountNumber")]) !!}
                        </div>
                        <div class="form-group">
                            <label for="routing_number">{{trans("billing.routingNumber")}}</label>
                            {!! Form::tel("routing_number",null,['id' => 'routing_number', 'class' => 'form-control', 'placeholder' => trans("billing.routingNumber")]) !!}
                        </div>
                        <div class="form-group">
                            <label for="account_type">{{trans("billing.accountType")}}</label>
                            {!! Form::select("account_type",['checking' => trans("billing.checking"), 'savings' => trans("billing.savings")],'checking',['id' => 'account_type', 'class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    {!! Form::checkbox("auto",1,1) !!}
                                    {{trans("billing.saveAsAutoPayMethodBank")}}
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">{{trans("billing.addNewBankAccount")}}</button>
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