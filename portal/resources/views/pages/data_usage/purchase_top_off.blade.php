@extends('layouts.full')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            {{utrans("headers.purchaseAdditionalData")}}
                        </h3>
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['action' => 'DataUsageController@addTopOff', 'id' => 'topOffForm', 'class' => 'form', 'autocomplete' => 'on']) !!}
                        <div class="form-group">
                            <label for="quantity">{{utrans("data_usage.quantity")}}</label>
                            <div style="padding-top: 15px; padding-bottom: 15px;">
                                <input type="range" min="1" max="20" step="1" value="1" id="quantity" name="quantity">
                            </div>
                        </div>
                        <div>
                            <p class="text-info big_text" id="calculatedAmount">
                                {{utrans("data_usage.topOffTotal",['count' => $policyDetails->overage_units_in_gigabytes, 'cost' => \App\Facades\Formatter::currency($policyDetails->overage_cost)])}}
                            </p>
                        </div>
                        <button type="submit" class="btn btn-primary">{{utrans("data_usage.confirmTopOffAddition")}}</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="cost" value="{{$policyDetails->overage_cost}}">
    <input type="hidden" id="units" value="{{$policyDetails->overage_units_in_gigabytes}}">
@endsection
@section('additionalJS')
    <script src="/assets/js/vendor/rangeslider.js-2.1.1/rangeslider.min.js"></script>
    <script src="/assets/js/pages/data_usage/top_off.js"></script>
    {!! JsValidator::formRequest('App\Http\Requests\AddTopOffRequest','#topOffForm') !!}
@endsection
@section('additionalCSS')
    <link rel="stylesheet" href="/assets/js/vendor/rangeslider.js-2.1.1/rangeslider.css">
@endsection