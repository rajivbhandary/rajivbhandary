$(function () {
    /*
            JQuery Validations
     */

    $("#edit-achiever").validate({
        'rules': {
            'name': {
                required: true,
                minlength: 2,
                maxlength: 255,
            },
            'percentage': {
                required: true,
            },
            'year': {
                required: true,
            }
        },
        submitHandler: function (form) {
            // do other things for a valid form
            form.submit();
        }
    });

    $('#year').datetimepicker({
        todayHighlight: true,
        autoclose: true,
        startView: 4,
        minView: 4,
        format: 'yyyy'
    });

    $("#year").change(function () {
        $("#year-details").text('This would be considered as ' + ((parseInt($("#year").val())-1)) + "-" + ($("#year").val()));
    });

    var avatar = new KTAvatar('image');

});
