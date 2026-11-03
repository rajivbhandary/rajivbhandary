$(function() {
    $("#edit-subject").validate({
        'rules': {
            'name': {
                required: true,
                minlength: 2,
                maxlength: 255,
            },
            'semester_number': {
                required: true,
            },
            'subject_code': {
                required: true,
            },
            'diploma_id[]': {
                required: true,
            },
        },
        submitHandler: function (form) {
            // do other things for a valid form
            form.submit();
        }
    });
});
