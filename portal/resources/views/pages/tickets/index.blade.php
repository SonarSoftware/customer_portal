@extends('layouts.full')
@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{{utrans("headers.tickets")}}</h3>
            </div>
            <div class="panel-body">
                <p>
                    <a class="btn btn-primary btn-lg" href="{{action("TicketController@create")}}" role="button">
                        {{utrans("tickets.createNewTicket")}}
                    </a>
                </p>
                <div class="table-responsive">
                    <table class="table table-condensed">
                        <thead>
                        <tr>
                            <th>{{utrans("tickets.subject")}}</th>
                            <th>{{utrans("tickets.status")}}</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if(count($tickets) == 0)
                                <TR>
                                    <TD>{{utrans("tickets.noTickets")}}</TD>
                                </TR>
                            @endif
                            @foreach($tickets as $ticket)
                                <tr>
                                    <TD><a href="{{action("TicketController@show",['tickets' => $ticket->getTicketID()])}}">{{$ticket->getSubject()}}</a></TD>
                                    @if($ticket->getOpen() === false)
                                        <TD class="text-danger">{{utrans("tickets.closed")}}</TD>
                                    @else
                                        <TD @if($ticket->getLastReplyIncoming() === false) class="text-success" @else class="text-warning" @endif>@if($ticket->getLastReplyIncoming() === false) {{utrans("tickets.waitingYourResponse")}} @else {{utrans("tickets.waitingIspResponse", [ 'companyName' => Config::get("customer_portal.company_name")])}} @endif</TD>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection