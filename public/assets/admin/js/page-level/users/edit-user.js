$(function () {
    /*
            JQuery Validations
     */

    $("#edit-user").validate({
        'rules': {
            'name': {
                required: true,
                minlength: 2,
                maxlength: 255,
            },
            'email': {
                required: true,
                minlength: 2,
                maxlength: 255,
            },
            'phone_number': {
                required: true,
                digits:true,
                minlength: 10,
                maxlength: 10,
            },
            'facebook_id': {
                maxlength: 255,
            },
            'twitter_id': {
                maxlength: 255,
            },
            'instagram_id': {
                maxlength: 255,
            },
            'linked_in_id': {
                maxlength: 255,
            },
            'behance_id': {
                maxlength: 255,
            },
            'youtube_id': {
                maxlength: 255,
            },
        },
        submitHandler: function (form) {
            // do other things for a valid form
            form.submit();
        }
    });

    var avatar = new KTAvatar('image');

});
