@extends('layouts.full')
@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{{trans("headers.paymentSucceeded")}}</h3>
            </div>
            <div class="panel-body">
                <p>
                    {{trans("billing.paymentWasSuccessful")}}
                </p>
                <ul>
                    <li>{{trans("billing.transactionID")}}: {{$result->transaction_id}}</li>
                </ul>
                <p>
                    <a href="{{action("BillingController@index")}}">{{trans("billing.backToBillingPage")}}</a>
                </p>
            </div>
        </div>
    </div>
@endsection