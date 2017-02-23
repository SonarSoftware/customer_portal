<script>
    var _portal = {
        currencySymbol: '{{Config::get("customer_portal.currency_symbol")}}',
        thousandsSeparator: '{{Config::get("customer_portal.thousands_separator")}}',
        decimalSeparator: '{{Config::get("customer_portal.decimal_separator")}}'
    };
</script>
<script src="/assets/js/vendor/jquery/jquery-1.12.3.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/vendor/jsvalidation/js/jsvalidation.js"></script>
<script type="text/javascript" src="/assets/js/vendor/chartjs/Chart.bundle.min.js"></script>
<script type="text/javascript" src="/assets/js/vendor/moment/moment.min.js"></script>
<script type="text/javascript" src="/assets/js/vendor/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" src="/assets/js/global.js"></script>
<script>
    moment.locale('{{Config::get("app.locale")}}');
</script>
@yield('additionalJS')