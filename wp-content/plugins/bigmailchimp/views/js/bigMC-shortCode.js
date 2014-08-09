(function($){
    if($('#bigMailChimp-send_to_editor').length > 0){

        $("#bigMailChimp-send_to_editor").on('click', function(event){
            event.preventDefault();
            var bigMailChimp_shortCode;
            var required_only = $('#BMC-required-fields-only');
            bigMailChimp_shortCode = '[BigMailChimp list='+ $("#BMC-SELECT").val();
            if(required_only.is(':checked')){
                bigMailChimp_shortCode += ' required_fields="1"';
            }
            bigMailChimp_shortCode += ']';
            if($("#BMC-SELECT").val().length > 0)
                send_to_editor(bigMailChimp_shortCode);
        });
    }
})(jQuery);