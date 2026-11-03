$(function () {
    /*
            JQuery Validations
     */

    $("#create-response").validate({
        'rules': {
            'name': {
                required: true,
                minlength: 2,
                maxlength: 255,
            },
            'designation': {
                required: true,
                minlength: 2,
                maxlength: 255,
            },
            'company_name': {
                required: true,
                minlength: 2,
                maxlength: 255,
            },
            'branch_name': {
                required: true,
                minlength: 2,
                maxlength: 255,
            },
            'college_name': {
                required: true,
                minlength: 2,
                maxlength: 255,
            },
            'image': {
                required: true,
            },
            'response[]': {
                required: true,
                minlength: 2,
            },
        },
        submitHandler: function (form) {
            // do other things for a valid form
            form.submit();
        }
    });

    var avatar = new KTAvatar('image');

});
