$(document).ready(function(){
    var ccNumberField = $("#cc-number");
    var expirationField = $("#expirationDate");
    var makeAuto = $("#makeAuto");
    var ccIcon = $("#ccIcon");

    ccNumberField.payment('formatCardNumber');
    expirationField.payment('formatCardExpiry');

    updatePaymentForm();

    ccNumberField.keyup(function (e){
        var cardType = $.payment.cardType($("#cc-number").val());
        ccIcon.removeClass();
        switch (cardType) {
            case "visa":
            case "visaelectron":
                ccIcon.addClass("fa fa-cc-visa");
                break;
            case "mastercard":
                ccIcon.addClass("fa fa-cc-mastercard");
                break;
            case "amex":
                ccIcon.addClass("fa fa-cc-amex");
                break;
            case "dinersclub":
                ccIcon.addClass("fa fa-cc-diners-club");
                break;
            case "discover":
                ccIcon.addClass("fa fa-cc-discover");
                break;
            case "jcb":
                ccIcon.addClass("fa fa-cc-jcb");
                break;
            default:
                ccIcon.addClass("fa fa-cc");
                break;
        }
    });

    makeAuto.change(function(){
        if (makeAuto.is(":checked")) {
            $("#autoPayDescription").show();
        }
        else {
            $("#autoPayDescription").hide();
        }
    })

    $("#payment_method").change(function(){
        updatePaymentForm();
    });
});


function updatePaymentForm()
{
    var selectedPaymentMethod = $("#payment_method").val();
    switch (selectedPaymentMethod) {
        case "new_card":
            $(".new_card").show();
            $(".non_paypal").show();
            $(".paypal").hide();
            break;
        case "paypal":
            $(".new_card").hide();
            $(".non_paypal").hide();
            $(".paypal").show();
            break;
        default:
            //Existing card
            $(".new_card").hide();
            $(".non_paypal").show();
            $(".paypal").hide();
            break;
    }
}