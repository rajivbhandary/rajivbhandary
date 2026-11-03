$(function () {

    /*
            JQuery Validations
     */

    $("#update-config").validate({
        'rules': {
            'default_seo_author': {
                required: true,
                minlength: 2,
                maxlength: 255,
            },
            'default_seo_description': {
                required: true,
                minlength: 2,
                maxlength: 255,
            },
            'default_seo_keywords': {
                required: true,
                minlength: 2,
                maxlength: 2000,
            },
            'default_seo_og_description': {
                required: true,
                minlength: 2,
                maxlength: 255,
            },
            'default_seo_og_title': {
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
