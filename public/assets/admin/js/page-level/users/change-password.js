$(function () {
    /*
            JQuery Validations
     */

    $("#change-password").validate({
        'rules': {
            'old_password': {
                required: true,
                minlength: 8,
            },
            'password': {
                required: true,
                minlength: 8,
            },
            'password_confirmation': {
                required: true,
                minlength: 8,
            },
        },
        submitHandler: function (form) {
            // do other things for a valid form
            form.submit();
        }
    });

});
