$(document).ready(function(){
    var myForm = null;
    $("form").submit(function(e){
        myForm = $(this);
        setTimeout(function() {
            if (myForm.children(".has-error").length == 0) {
                $(".alert").alert('close')
                var button = myForm.children("button");
                button.prop("disabled",true);
                var currentText = button.text();
                button.html('<i class="fa fa-spinner fa-spin fa-fw"></i> ' + currentText);
            }
        });
    });

    //This automates CSRF protection for any AJAX calls you may add
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

Number.prototype.formatCurrency = function(c){
    var n = this,
        c = isNaN(c = Math.abs(c)) ? 2 : c,
        d = _portal.decimalSeparator,
        t = _portal.thousandsSeparator,
        s = n < 0 ? "-" : "",
        i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "",
        j = (j = i.length) > 3 ? j % 3 : 0;
    return _portal.currencySymbol + s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
};