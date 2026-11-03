$(function () {
    $("#create-board-paper").validate({
        'rules': {
            'name': {
                required: true,
                minlength: 2,
                maxlength: 255,
            },
            'subject_id': {
                required: true,
            },
            'pdf_name': {
                required: true,
            },
        },
        submitHandler: function (form) {
            // do other things for a valid form
            form.submit();
        }
    });
});

