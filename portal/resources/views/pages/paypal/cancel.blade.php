@extends('layouts.full')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{trans("headers.cancelled")}}</h3>
                    </div>
                    <div class="panel-body">
                        <p>
                            {{trans("billing.paypalCancelled")}}
                        </p>
                        <p>
                            <a href="{{action("BillingController@index")}}">{{trans("billing.backToBillingPage")}}</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection