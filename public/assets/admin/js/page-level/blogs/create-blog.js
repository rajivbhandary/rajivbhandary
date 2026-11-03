$(function () {
    /*
            TINY MCE SETTINGS
     */
    tinymce.init({
        selector: '#blog-body',
        toolbar: ['styleselect fontsizeselect',
        'undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify',
        'bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview |  code'],
        plugins: 'advlist autolink link image lists charmap print preview',
        images_upload_url: '/control-panel/blog-image-upload',
        relative_urls : false,
        remove_script_host : true,
        document_base_url : location.origin,

        images_upload_handler: function (blobInfo, success, failure) {
            var xhr, formData;

            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', '/control-panel/blog-image-upload');
            xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));


            xhr.onload = function () {
                var json;

                if (xhr.status < 200 || xhr.status >= 300) {
                    failure('HTTP Error: ' + xhr.status);
                    return;
                }

                console.log(xhr.responseText);
                json = JSON.parse(xhr.responseText);


                if (!json || typeof json.location != 'string') {
                    failure('Invalid JSON: ' + xhr.responseText);
                    return;
                }

                success(json.location);
            };

            xhr.onerror = function () {
                failure('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
            };

            formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());

            xhr.send(formData);
        }
    })

    $('#published_at').datetimepicker({
        todayHighlight: true,
        autoclose: true,
        pickerPosition: 'top-left',
        format: 'yyyy/mm/dd hh:ii',
        startDate: new Date(),
    });

    /*
            JQuery Validations
     */

    $("#create-blog").validate({
        'rules': {
            'title': {
                required: true,
                minlength: 2,
                maxlength: 255,
            },
            'excerpt': {
                required: true,
                minlength: 2,
                maxlength: 255,
            },
            'body': {
                required: true,
                minlength: 2,
            },
            'tag_id[]': {
                required: true,
            },
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
