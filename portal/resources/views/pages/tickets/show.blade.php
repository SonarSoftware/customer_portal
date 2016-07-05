@extends('layouts.full')
@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{{trans("headers.ticket")}}</h3>
            </div>
            <div class="panel-body">
                <h3>{{$ticket->getSubject()}}</h3>
                @if (count($replies) == 0)
                    {{trans("tickets.noRepliesYet")}}
                @endif
            </div>
            @if(count($replies) > 0)
            <ul class="list-group">
                @foreach($replies as $reply)
                    <li class="list-group-item">
                        <div class="row @if($reply->incoming == true) bg-info text-info @else bg-success text-success @endif ticket-header">
                            <div class="col-md-6 text-left">
                                <em>
                                    @if($reply->incoming == true)
                                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                        {{trans("tickets.youWrote")}}
                                    @else
                                        <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                                        {{trans("tickets.ispWrote",['companyName' => Config::get("customer_portal.company_name")])}}
                                    @endif
                                </em>
                            </div>
                            <div class="col-md-6 text-right">
                                <small>
                                    {{Formatter::datetime($reply->created_at, true)}}
                                </small>
                            </div>
                        </div>
                        <p>
                            {!! $reply->text !!}
                        </p>
                    </li>
                @endforeach
            </ul>
            @endif
            <div class="panel-body">
                {!! Form::open(['action' => ['TicketController@postReply', 'tickets' => $ticket->getTicketID()], 'id' => 'replyForm', 'method' => 'post']) !!}
                <div class="form-group">
                    <label for="reply">{{trans("tickets.postAReply")}}</label>
                    {!! Form::textarea("reply",null,['class' => 'form-control', 'id' => 'reply', 'placeholder' => trans("tickets.postAReplyPlaceholder")]) !!}
                </div>
                <button type="submit" class="btn btn-primary">{{trans("actions.postReply")}}</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@section('additionalCSS')
    <link rel="stylesheet" href="/assets/css/pages/tickets.css">
@endsection
@section('additionalJS')
    {!! JsValidator::formRequest('App\Http\Requests\TicketReplyRequest','#replyForm') !!}
@endsection