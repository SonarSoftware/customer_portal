@if($errors->count() > 0)
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            @foreach($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only">Error:</span>
                    {{$error}}
                </div>
            @endforeach
        </div>
    </div>
@endif