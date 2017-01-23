<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <span class="navbar-brand">
                @if(file_exists(base_path("/public/assets/images/logo.png")))
                    <img src="/assets/images/logo.png" height="20px">
                @else
                    <img src="/assets/images/transparent_logo.png" height="20px">
                @endif
            </span>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li @if(str_contains(Route::getCurrentRoute()->getPath(),"billing")) class="active" @endif><a href="{{action("BillingController@index")}}">{{trans("nav.billing")}} @if(str_contains(Route::getCurrentRoute()->getPath(),"billing")) <span class="sr-only">(current)</span> @endif</a></li>
                @if(Config::get("customer_portal.ticketing_enabled") === true)
                <li @if(str_contains(Route::getCurrentRoute()->getPath(),"tickets")) class="active" @endif><a href="{{action("TicketController@index")}}">{{trans("nav.tickets")}} @if(str_contains(Route::getCurrentRoute()->getPath(),"tickets")) <span class="sr-only">(current)</span> @endif</a></li>
                @endif
                @if(Config::get("customer_portal.data_usage_enabled") === true)
                    <li @if(str_contains(Route::getCurrentRoute()->getPath(),"data_usage")) class="active" @endif><a href="{{action("DataUsageController@index")}}">{{trans("nav.dataUsage")}} @if(str_contains(Route::getCurrentRoute()->getPath(),"data_usage")) <span class="sr-only">(current)</span> @endif</a></li>
                @endif
                @if(Config::get("customer_portal.contracts_enabled") === true)
                    <li @if(str_contains(Route::getCurrentRoute()->getPath(),"contracts")) class="active" @endif><a href="{{action("ContractController@index")}}">{{trans("nav.contracts")}} @if(str_contains(Route::getCurrentRoute()->getPath(),"contracts")) <span class="sr-only">(current)</span> @endif</a></li>
                @endif
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li @if(str_contains(Route::getCurrentRoute()->getPath(),"profile")) class="active" @endif><a href="{{action("ProfileController@show")}}">{{trans("nav.profile")}} @if(str_contains(Route::getCurrentRoute()->getPath(),"profile")) <span class="sr-only">(current)</span> @endif</a></li>
                <li><a href="/logout">{{trans("nav.logOut")}}</a></li>
            </ul>
        </div>
    </div>
</nav>