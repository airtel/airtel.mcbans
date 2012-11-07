$(document).ready(function() {
    
    // Le fire init
    airtel_init.transformSelect();
    airtel_init.tooltips();

    // Le payments
    airtel_payments.ibank_anchor(); 
    airtel_payments.paypal_anchor(); 
    airtel_payments.paymentTabs();

    // Le datatables
    airtel_datatables.bansTable();

    // Le modals
    airtel_modal.paymentModal();

});


/**
 * Init
 */
airtel_init = {
    
    transformSelect: function()
    {
        // Pasive chosens without any additional js functionality
        $('.chosen').chosen({
            disable_search_threshold: 25
        });
    },
    
    /**
     * Enables tooltips with title as selector tag
     */
    tooltips: function()
    {
        $('[title]').tooltip({placement: 'top'});
    }
    
};


/**
 * Payment functions
 */
airtel_payments = {
    
    ibank_anchor: function()
    {
        // Open window on click and set timer
        $("#airtel_ibank_system").click(function (e) {

            e.preventDefault();
            
            // Get changed values
            var key = $('#ibank_key').text();
            var href = 'http://ibank.airtel.lv/handler/index/' + key + '/LVL/';

            // Open window
            window.airtel_ibank_window = window.open(href, 'ibank_airtel', 'width=800, height=700, scrollbars=yes, status=yes, resizable=yes, screenx=200, screeny=100');

            // Open notification
            $('#payment-window-notification').modal({
                backdrop: 'static',
                keyboard: false
            });

            // Set function to check window status
            airtel_payments.ibank_check_status();

            // Check interval
            setTimeout('airtel_payments.ibank_check_status()', 2000);
        
        });
    },
    
    ibank_check_status: function()
    {
        if (window.airtel_ibank_window.closed === false) {} else {
            $('#payment-window-notification').modal('hide');
        }
        setTimeout('airtel_payments.ibank_check_status()', 500);
    },
            
    paypal_anchor: function ()
    {
        $("#airtel_paypal_system").click(function (e) {
            
            // Prevent default action
            e.preventDefault();
            
            // Get changed values
            var key = $('#paypal_key').text();
            var href = 'http://paypal.airtel.lv/handler/index/' + key + '/EUR/';

            // Open window
            window.airtel_paypal_window = window.open(href, 'paypal_airtel', 'width=1000, height=768, scrollbars=yes, status=yes, resizable=yes, screenx=200, screeny=100');

            // Open notification
            $('#payment-window-notification').modal({
                backdrop: 'static',
                keyboard: false
            });

            // Set function to check window status
            airtel_payments.paypal_check_status();

            // Check interval
            setTimeout('airtel_payments.paypal_check_status()', 2000);
            
            
        });
    },
            
    paypal_check_status: function()
    {
        if (window.airtel_paypal_window.closed === false) {} else {
            $('#payment-window-notification').modal('hide');
        }
        setTimeout('airtel_payments.paypal_check_status()', 500);
    },

    paymentTabs: function()
    {
        // Clearing inputs that could been filled by user into non-active tabs, so that on submit there
        // would be only one pay-method code filled.
        $('a[data-toggle="tab"]').on('shown', function(e) {

            // Prevent default action
            e.preventDefault();

            // Set value to non-active tab input to bypass validation
            $('.tab-pane:not(.active) .code').val('99999999');

            // Active tab input is cleared
            $('.tab-pane.active .code').val('');
        });    
    }
            
};


/**
 * 
 */
airtel_modal = {
    
    paymentModal: function() {
        
        // Modal open and load content
        $('.table-bans').delegate('tbody tr', 'click', function(e) {

            e.preventDefault();
            
            // Get username
            var username = $(this).attr('id');
            
            // Set hidden input value
            $('input[name=username]').val(username);
            
            // Set header
            $('#modalUsername').text(username);
            
            // Set modal options and then show it
            $('#paymentModal').modal({
                backdrop: 'static',
                keyboard: true,
            }, 'show');
            
        });
        
        // On submit event do ajax call
        $('#unban-payment').submit(function(e) {
        
            e.preventDefault();

            //var btn = $(this);
            var btn = $('.do-process');
            var form = $('#unban-payment');
            
            if ($(form).valid()) {
            
                // Lock form while processing
                airtel_misc.lockPaymentForm(btn);

                // Send data
                $.ajax({

                    url: form.attr('action'),
                    type: 'POST',
                    dataType: 'json',
                    data: form.serialize(),
                    success : function(data) {
                        
                        // Unlock form
                        airtel_misc.unlockPaymentForm(btn);

                        // Show alert
                        airtel_misc.showAlert(data.type, data.text);
                        
                        // Remove TR if success
                        if(data.type === 'success')
                        {
                            var trId = $('input[name=username]').val();
                            $('#' + trId).remove();
                        }
                    }
                    
                });
                
            }
            
        });
        
    }
    
};


/**
 * 
 */
airtel_misc = { 
    
    lockPaymentForm: function(btnSelector) {
        
        // Lock button
        btnSelector.button('loading');
        
        $('input').prop('readonly', true);
    },
    
    unlockPaymentForm: function(btnSelector) {
        btnSelector.button('reset');
        $('input').prop('readonly', false);
        $('.code').val('');
    },
    
    showAlert: function(type, message) {

        $('#alert-area').html($('<div class="alert alert-' + type + ' fade in" data-alert="alert"><a class="close" data-dismiss="alert">×</a>' + message + '</div>'));
        //$('.alert').addClass('in');
        //$('.alert').delay(2000).fadeOut(2000, function () { $(this).remove(); });
        //$('.alert').delay(2000).alert('close');
    }
    
};


/**
 * 
 */
airtel_datatables = {
   
    bansTable: function() {
        
        $('.table-bans').dataTable({
            "sDom": "<'row'<'span6'<'dt_actions'>l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
            "sPaginationType": 'bootstrap',
            'oLanguage': {
                "sUrl": base_url + 'assets/lib/datatables/language/lv_LV.txt'
            }
        });
    
    }

};