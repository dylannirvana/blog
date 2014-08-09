(function($) {
    $('.bigMailChimpForm').on('submit', function(event) {
        event.preventDefault();

        var $form = $(this);
        var form_data = $form.serialize();
        var url = $form.attr('action');

        $.post(url, form_data, function(data) {
            $form.parent().children(".result").removeClass('box_error box_success');
            $form.parent().children(".result").empty().hide();
            $.each(data, function(index, value) {
                if (index != 'status')
                    $form.parent().children(".result").append('<p>' + value + '</p>');
                else {
                    $form.parent().children(".result").slideDown();
                    $form.parent().children(".result").addClass('box_' + value);
                }
            });
        }, 'json');
    });
    if (!("placeholder" in document.createElement("input")) || !("placeholder" in document.createElement("textarea"))) {
        // set placeholder values
        $('#signup_form , #contact-form').on('submit', function(event) {
            event.preventDefault();
            $('[placeholder]').each(function() {
                $(this).val($(this).attr('placeholder')).addClass('placeholder');
            });
        });
        $('[placeholder]').each(function() {
            $(this).val($(this).attr('placeholder')).addClass('placeholder');
        });
        // focus and blur of placeholders
        $('[placeholder]').focus(function() {
            if ($(this).val() == $(this).attr
                    ('placeholder')) {
                $(this).val('');
                $(this).removeClass('placeholder');
            }
        }).blur(function() {
            if ($(this).val() == '' || $(this).val() == $(this).attr('placeholder')) {
                $(this).val($(this).attr('placeholder'));
                $(this).addClass('placeholder');
            }
        });

        // remove placeholders on submit
        $('[placeholder]').closest('.bigMailChimpForm').submit(function() {
            $(this).find('[placeholder]').each(function() {
                if ($(this).val() == $(this).attr('placeholder')) {
                    $(this).val('');
                }
            });
        });
    }

})(jQuery);
