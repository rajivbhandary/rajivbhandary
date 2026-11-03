$(function () {
    /*
            JQuery Validations
     */

    $("#edit-user").validate({
        'rules': {
            'image': {
                required: true,
            },
        },
        submitHandler: function (form) {
            // do other things for a valid form
            form.submit();
        }
    });

    var avatar = new KTAvatar('image');

});
