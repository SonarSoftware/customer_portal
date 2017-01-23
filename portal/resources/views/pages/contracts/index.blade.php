@extends('layouts.full')
@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{{trans("headers.contracts")}}</h3>
            </div>
            <div class="panel-body">
                <table class="table table-condensed">
                    <thead>
                    <tr>
                        <th>{{trans("contracts.name")}}</th>
                        <th>{{trans("contracts.status")}}</th>
                        <th>{{trans("contracts.action")}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($contracts) == 0)
                        <TR>
                            <TD colspan="3">{{trans("contracts.noContracts")}}</TD>
                        </TR>
                    @endif
                    @foreach($contracts as $contract)
                        <tr @if($contract->getAcceptanceDatetime() == null) class="warning" @else class="success" @endif>
                            <TD>{{$contract->getContractName()}}</TD>
                            <TD>@if($contract->getAcceptanceDatetime() == null) {{trans("contracts.pendingSignature")}} @else {{trans("contracts.signed")}} @endif</TD>
                            <TD>@if($contract->getAcceptanceDatetime() == null) <a href="{{$contract->generateSignatureLink()}}">{{trans("contracts.sign")}}</a> @else <a href="{{action("ContractController@downloadContractPdf",['id' => $contract->getId()])}}">{{trans("contracts.download")}}</a> @endif</TD>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection