@extends('layouts.full')
@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{{utrans("headers.paymentSucceeded")}}</h3>
            </div>
            <div class="panel-body">
                <p>
                    {{utrans("billing.paymentWasSuccessful")}}
                </p>
                <ul>
                    <li>{{utrans("billing.transactionID")}}: {{$result->transaction_id}}</li>
                </ul>
                <p>
                    <a href="{{action("BillingController@index")}}">{{utrans("billing.backToBillingPage")}}</a>
                </p>
            </div>
        </div>
    </div>
@endsection