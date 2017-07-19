@extends('layouts.full')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{utrans("headers.createTicket")}}</h3>
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['action' => 'TicketController@store', 'id' => 'ticketForm']) !!}
                        <div class="form-group">
                            <label for="subject">{{utrans("tickets.subject")}}</label>
                            {!! Form::text("subject",null,['class' => 'form-control', 'id' => 'subject', 'placeholder' => utrans("tickets.subjectLong")]) !!}
                        </div>
                        <div class="form-group">
                            <label for="description">{{utrans("tickets.description")}}</label>
                            {!! Form::textarea("description",null,['class' => 'form-control', 'id' => 'description', 'placeholder' => utrans("tickets.descriptionLong")]) !!}
                        </div>
                        <button type="submit" class="btn btn-primary">{{utrans("actions.createTicket")}}</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('additionalJS')
    {!! JsValidator::formRequest('App\Http\Requests\TicketRequest','#ticketForm') !!}
@endsection