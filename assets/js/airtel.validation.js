$(document).ready(function() {
    

    airtel_validation.validatePayment();
    
    
});


airtel_validation = {
    
    validatePayment: function() {
        
        $('#unban-payment').validate({

            onkeyup: false,
            errorClass: 'error',
            validClass: 'valid',

            highlight: function(element) {
                $(element).closest('div').addClass("f_error");
            },

            unhighlight: function(element) {
                $(element).closest('div').removeClass("f_error");
            },

            errorPlacement: function(error, element) {
                $(element).closest('div').append(error);
            }
        });

    }
    
};