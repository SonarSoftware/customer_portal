@extends('layouts.full')
@section('content')
    <div class="container">
        @if($policyDetails->has_policy === true)
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{{trans("headers.currentUsage")}}</h3>
            </div>
            <div class="panel-body">
                <div class="progress">
                    <div class="progress-bar @if($usagePercentage < 75) progress-bar-success @elseif($usagePercentage < 90) progress-bar-warning @else progress-bar-danger @endif" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{$usagePercentage}}%;">
                        <span class="sr-only">{{ $currentUsage['billable'] }}GB / {{ $calculatedCap }}GB</span>
                    </div>
                </div>
                <p class="text-center bigger_text @if($currentUsage['billable'] > $calculatedCap) text-danger @else text-info @endif">
                    {{ $currentUsage['billable'] }}GB / {{ $calculatedCap }}GB
                </p>
                @if($policyDetails->allow_user_to_purchase_capacity === true)
                    <div class="row">
                        <div class="col-xs-10 col-xs-offset-1">
                            <a class="btn btn-primary btn-block btn-lg" href="{{action("DataUsageController@showTopOff")}}" role="button">
                                <span class="glyphicon glyphicon-transfer" aria-hidden="true"></span>
                                {{trans("data_usage.purchaseAdditionalData")}}
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        @else
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{trans("headers.currentUsage")}}</h3>
                </div>
                <div class="panel-body">
                    <p class="text-center bigger_text text-info">
                        {{ $currentUsage['billable'] }}GB
                    </p>
                </div>
            </div>
        @endif
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{{trans("headers.dataUsage")}}</h3>
            </div>
            <div class="panel-body">
                <canvas id="historicalUsage" height="125"></canvas>
            </div>
        </div>
    </div>
@endsection
@section('additionalJS')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.6/Chart.bundle.min.js"></script>
    <script type="text/javascript" src="/assets/js/vendor/moment/moment.min.js"></script>
    <script>
        var historicalUsage = {!! $historicalUsage !!};
    </script>
    <script src="/assets/js/pages/data_usage/index.js" type="text/javascript"></script>
@endsection