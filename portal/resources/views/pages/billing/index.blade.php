@extends('layouts.full')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{trans("headers.amountDue")}}</h3>
                    </div>
                    <div class="panel-body">
                        <p class="attention_text text-center @if($values['amount_due'] > 0) text-danger @endif">
                            {{Formatter::currency($values['amount_due'])}}
                        </p>
                        <p>
                            <a class="btn btn-primary btn-block btn-lg" href="{{action("BillingController@makePayment")}}" role="button">
                                <span class="glyphicon glyphicon-piggy-bank" aria-hidden="true"></span>
                                {{trans("billing.makePayment")}}
                            </a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{trans("headers.accountDetails")}}</h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <TR class="info text-info">
                                        <TD>{{trans("general.accountNumber")}}</TD>
                                        <TD>{{get_user()->account_id}}</TD>
                                    </TR>
                                    <TR @if($values['balance_minus_funds'] > 0) class="bg-danger text-danger" @else class="bg-success text-success" @endif>
                                        <TD>{{trans("billing.totalBalance")}}</TD>
                                        <TD>{{Formatter::currency($values['balance_minus_funds'])}}</TD>
                                    </TR>
                                    <TR>
                                        <TD>{{trans("billing.nextBillDate")}}</TD>
                                        <TD>@if($values['next_bill_date'] !== null) {{Formatter::date($values['next_bill_date'],false)}} @else {{trans("general.notAvailable")}} @endif</TD>
                                    </TR>
                                    <TR>
                                        <TD>{{trans("billing.nextBillAmount")}}</TD>
                                        <TD>
                                            @if($values['next_bill_amount'] !== null)
                                                {{Formatter::currency($values['next_bill_amount'])}}
                                            @else
                                                {{trans("general.notAvailable")}}
                                            @endif
                                        </TD>
                                    </TR>
                                    @if($values['payment_past_due'] === true)
                                        <TR class="danger text-danger">
                                            <TD colspan="2">
                                                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                                {{trans("billing.accountPastDue")}}
                                            </TD>
                                        </TR>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
                <!-- Nav tabs -->
                <ul class="nav nav-pills" role="tablist">
                    @if(Config::get("customer_portal.show_detailed_transactions") == true)
                        <li role="presentation" class="active"><a href="#transactions" aria-controls="transactions" role="tab" data-toggle="tab">{{trans("headers.recentTransactions")}}</a></li>
                        <li role="presentation"><a href="#invoices" aria-controls="invoices" role="tab" data-toggle="tab">{{trans("headers.invoices")}}</a></li>
                        <li role="presentation"><a href="#creditCards" aria-controls="creditCards" role="tab" data-toggle="tab">{{trans("headers.creditCards")}}</a></li>
                        @if(config("customer_portal.enable_bank_payments") == true) <li role="presentation"><a href="#bankAccounts" aria-controls="bankAccounts" role="tab" data-toggle="tab">{{trans("headers.bankAccounts")}}</a></li> @endif
                    @else
                        <li role="presentation" class="active"><a href="#invoices" aria-controls="invoices" role="tab" data-toggle="tab">{{trans("headers.invoices")}}</a></li>
                        <li role="presentation"><a href="#creditCards" aria-controls="creditCards" role="tab" data-toggle="tab">{{trans("headers.creditCards")}}</a></li>
                        @if(config("customer_portal.enable_bank_payments") == true) <li role="presentation"><a href="#bankAccounts" aria-controls="bankAccounts" role="tab" data-toggle="tab">{{trans("headers.bankAccounts")}}</a></li> @endif
                    @endif
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    @if(Config::get("customer_portal.show_detailed_transactions") == true)
                    <div role="tabpanel" class="tab-pane active" id="transactions">
                        <div class="table-responsive">
                            <table class="table table-condensed give_top_room">
                                <thead>
                                    <tr>
                                        <th>{{trans("billing.transactionType")}}</th>
                                        <th>{{trans("general.date")}}</th>
                                        <th>{{trans("general.amount")}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($transactions) == 0)
                                        <TR>
                                            <TD colspan="3">
                                                {{trans("billing.noTransactionsFound")}}
                                            </TD>
                                        </TR>
                                    @else
                                        @foreach($transactions as $transaction)
                                            <TR @if($transaction['type'] != "debit") class="success text-success" @endif>
                                                <TD>@if(in_array($transaction['type'],['debit','discount'])) {{$transaction['description']}} @else {{trans("transaction_types." . $transaction['type'])}} @endif</TD>
                                                <TD>{{Formatter::date($transaction['date'],false)}}</TD>
                                                <TD>@if($transaction['type'] != "debit")-@endif{{Formatter::currency($transaction['amount'])}}</TD>
                                            </TR>
                                            @if(in_array($transaction['type'],['credit','debit']))
                                                @foreach($transaction['taxes'] as $tax)
                                                    <TR class="active">
                                                        <TD class="push_right"><small>{{trans("transaction_types.tax",['type' => $tax->description])}}</small></TD>
                                                        <TD><small>{{Formatter::date($transaction['date'],false)}}</small></TD>
                                                        <TD><small>{{Formatter::currency($tax->amount)}}</small></TD>
                                                    </TR>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                    <div role="tabpanel" class="tab-pane @if(Config::get("customer_portal.show_detailed_transactions") != true) active @endif" id="invoices">
                        <div class="table-responsive">
                            <table class="table table-condensed give_top_room">
                                <thead>
                                <tr>
                                    <th>{{trans("general.date")}}</th>
                                    <th>{{trans("billing.invoiceNumber")}}</th>
                                    <th>{{trans("billing.remainingDue")}}</th>
                                    <th>{{trans("billing.dueDate")}}</th>
                                    <th>{{trans("billing.viewInvoice")}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($invoices) == 0)
                                    <TR>
                                        <TD colspan="4">{{trans("billing.noInvoicesFound")}}</TD>
                                    </TR>
                                @else
                                    @foreach($invoices as $invoice)
                                        <TR>
                                            <TD>{{Formatter::date($invoice->date,false)}}</TD>
                                            <TD>{{$invoice->id}}</TD>
                                            <TD>{{Formatter::currency(bcadd($invoice->remaining_due, $invoice->child_remaining_due,2))}}</TD>
                                            <TD>{{Formatter::date($invoice->due_date,false)}}</TD>
                                            <TD>
                                                <a class="btn btn-default btn-xs" href="{{action("BillingController@getInvoicePdf",['invoices' => $invoice->id])}}" role="button">
                                                    <span class="glyphicon glyphicon-save-file" aria-hidden="true"></span>
                                                    {{trans("billing.downloadInvoice")}}
                                                </a>
                                            </TD>
                                        </TR>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="creditCards">
                        <div class="table-responsive">
                            <p class="text-right">
                                <a class="btn btn-primary btn-sm" href="{{action("BillingController@createPaymentMethod")}}" role="button">
                                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                    {{trans("billing.addNewCard")}}
                                </a>
                            </p>
                            <table class="table table-condensed give_top_room">
                                <thead>
                                <tr>
                                    <th>{{trans("billing.last4")}}</th>
                                    <th>{{trans("billing.expiration")}}</th>
                                    <th>{{trans("billing.autoPay")}}</th>
                                    <th>{{trans("billing.action")}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @if(count($paymentMethods) === 0)
                                        <TR>
                                            <TD colspan="4">{{trans("billing.noCreditCardsOnFile")}}</TD>
                                        </TR>
                                    @else
                                        @foreach($paymentMethods as $paymentMethod)
                                            <TR>
                                                <TD>***{{$paymentMethod->identifier}}</TD>
                                                <TD>{{$paymentMethod->expiration_month}}/{{$paymentMethod->expiration_year}}</TD>
                                                <TD>
                                                    @if($paymentMethod->auto == 1)
                                                        {!! Form::open(['action' => ["BillingController@toggleAutoPay",$paymentMethod->id],'id' => 'deletePaymentMethodForm', 'method' => 'patch']) !!}
                                                        <button class="btn btn-xs btn-warning">
                                                            <span class="glyphicon glyphicon-retweet" aria-hidden="true"></span>
                                                            {{trans("billing.disableAuto")}}
                                                        </button>
                                                        {!! Form::close() !!}
                                                    @else
                                                        {!! Form::open(['action' => ["BillingController@toggleAutoPay",$paymentMethod->id],'id' => 'deletePaymentMethodForm', 'method' => 'patch']) !!}
                                                        <button class="btn btn-xs btn-info">
                                                            <span class="glyphicon glyphicon-retweet" aria-hidden="true"></span>
                                                            {{trans("billing.enableAuto")}}
                                                        </button>
                                                        {!! Form::close() !!}
                                                    @endif
                                                </TD>
                                                <TD>
                                                    {!! Form::open(['action' => ["BillingController@deletePaymentMethod",$paymentMethod->id],'id' => 'deletePaymentMethodForm', 'method' => 'delete']) !!}
                                                    <button class="btn btn-xs btn-danger">
                                                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                        {{trans("actions.delete")}}
                                                    </button>
                                                    {!! Form::close() !!}
                                                </TD>
                                            </TR>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                        <div role="tabpanel" class="tab-pane" id="bankAccounts">
                            <div class="table-responsive">
                                <p class="text-right">
                                    <a class="btn btn-primary btn-sm" href="{{action("BillingController@createPaymentMethod")}}" role="button">
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                        {{trans("billing.addNewBankAccount")}}
                                    </a>
                                </p>
                                <table class="table table-condensed give_top_room">
                                    <thead>
                                    <tr>
                                        <th>{{trans("billing.accountNumber")}}</th>
                                        <th>{{trans("billing.autoPay")}}</th>
                                        <th>{{trans("billing.action")}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($paymentMethods) === 0)
                                        <TR>
                                            <TD colspan="4">{{trans("billing.noBankAccounts")}}</TD>
                                        </TR>
                                    @else
                                        @foreach($paymentMethods as $paymentMethod)
                                            <TR>
                                                <TD>***{{$paymentMethod->identifier}}</TD>
                                                <TD>{{$paymentMethod->expiration_month}}/{{$paymentMethod->expiration_year}}</TD>
                                                <TD>
                                                    @if($paymentMethod->auto == 1)
                                                        {!! Form::open(['action' => ["BillingController@toggleAutoPay",$paymentMethod->id],'id' => 'deletePaymentMethodForm', 'method' => 'patch']) !!}
                                                        <button class="btn btn-xs btn-warning">
                                                            <span class="glyphicon glyphicon-retweet" aria-hidden="true"></span>
                                                            {{trans("billing.disableAuto")}}
                                                        </button>
                                                        {!! Form::close() !!}
                                                    @else
                                                        {!! Form::open(['action' => ["BillingController@toggleAutoPay",$paymentMethod->id],'id' => 'deletePaymentMethodForm', 'method' => 'patch']) !!}
                                                        <button class="btn btn-xs btn-info">
                                                            <span class="glyphicon glyphicon-retweet" aria-hidden="true"></span>
                                                            {{trans("billing.enableAuto")}}
                                                        </button>
                                                        {!! Form::close() !!}
                                                    @endif
                                                </TD>
                                                <TD>
                                                    {!! Form::open(['action' => ["BillingController@deletePaymentMethod",$paymentMethod->id],'id' => 'deletePaymentMethodForm', 'method' => 'delete']) !!}
                                                    <button class="btn btn-xs btn-danger">
                                                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                        {{trans("actions.delete")}}
                                                    </button>
                                                    {!! Form::close() !!}
                                                </TD>
                                            </TR>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection