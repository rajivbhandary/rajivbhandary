$(function () {
    /*
            JQuery Validations
     */

    $("#create-stream").validate({
        'rules': {
            'name': {
                required: true,
                minlength: 2,
                maxlength: 255,
            },
        },
        submitHandler: function (form) {
            // do other things for a valid form
            form.submit();
        }
    });

});
