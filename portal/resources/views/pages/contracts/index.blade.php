@extends('layouts.full')
@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{{utrans("headers.contracts")}}</h3>
            </div>
            <div class="panel-body">
                <table class="table table-condensed">
                    <thead>
                    <tr>
                        <th>{{utrans("contracts.name")}}</th>
                        <th>{{utrans("contracts.status")}}</th>
                        <th>{{utrans("contracts.action")}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($contracts) == 0)
                        <TR>
                            <TD colspan="3">{{utrans("contracts.noContracts")}}</TD>
                        </TR>
                    @endif
                    @foreach($contracts as $contract)
                        <tr @if($contract->getAcceptanceDatetime() == null) class="warning" @else class="success" @endif>
                            <TD>{{$contract->getContractName()}}</TD>
                            <TD>@if($contract->getAcceptanceDatetime() == null) {{utrans("contracts.pendingSignature")}} @else {{utrans("contracts.signed")}} @endif</TD>
                            <TD>@if($contract->getAcceptanceDatetime() == null) <a href="{{$contract->generateSignatureLink()}}" target="_blank">{{utrans("contracts.sign")}}</a> @else <a href="{{action("ContractController@downloadContractPdf",['id' => $contract->getId()])}}">{{utrans("contracts.download")}}</a> @endif</TD>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection