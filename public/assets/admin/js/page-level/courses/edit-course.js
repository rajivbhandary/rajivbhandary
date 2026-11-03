$(function () {
    /*
            TINY MCE SETTINGS
     */
    tinymce.init({
        selector: '#course-body',
        toolbar: ['styleselect fontsizeselect',
            'undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify',
            'bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview |  code'],
        plugins: 'advlist autolink link image lists charmap print preview',
        images_upload_url: '/control-panel/course-image-upload',
        relative_urls: false,
        remove_script_host: true,
        document_base_url: location.origin,

        images_upload_handler: function (blobInfo, success, failure) {
            var xhr, formData;

            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', '/control-panel/course-image-upload');
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
    });

    var arrows = {
        leftArrow: '<i class="la la-angle-left"></i>',
        rightArrow: '<i class="la la-angle-right"></i>'
    }

    $('#start_date').datepicker({
        todayHighlight: true,
        autoclose: true,
        pickerPosition: 'top-left',
        format: 'yyyy/mm/dd',
        templates: arrows
    });

    function initDatePicker() {
        $('.review_date').datepicker({
            todayHighlight: true,
            autoclose: true,
            pickerPosition: 'top-left',
            format: 'yyyy/mm/dd',
            templates: arrows
        });
    }

    initDatePicker();

    /*
            JQuery Validations
     */

    $("#edit-course").validate({
        'rules': {
            'name': {
                required: true,
                minlength: 2,
                maxlength: 255,
            },
            'status': {
                maxlength: 255,
            },
            'stream_id[]': {
                required: true,
            },
            'duration_in_weeks': {
                required: true,
                minlength: 2,
                maxlength: 255,
            },
            'number_of_hours': {
                required: true,
                minlength: 2,
                maxlength: 255,
            },
            'number_of_projects': {
                required: true,
                digits: true,
            },
            'certificate_provided': {
                required: true,
            },
            'visibility': {
                required: true,
            },
            'start_date': {
                required: true,
            },
            'description': {
                required: true,
                minlength: 2,
            },
            'review_name[]': {
                required: true,
                minlength: 2,
                maxlength: 255,
            },
            'review_date[]': {
                required: true,
                minlength: 2,
                maxlength: 255,
            },
            'review[]': {
                required: true,
                minlength: 2,
                maxlength: 10000,
            },
            'part_name[]': {
                required: true,
                minlength: 2,
                maxlength: 255,
            },
            'topic_description[]': {
                required: true,
                minlength: 2,
                maxlength: 5000,
            },
        },
        ignore: '',
        submitHandler: function (form) {
            // do other things for a valid form
            form.submit();
        },
        invalidHandler: function(form) {
            console.log($(".is-invalid"));
        },
    });

    var avatar = new KTAvatar('image');
    var avatar = new KTAvatar('review_image_1');

    var reviewID = 100000;
    var partID = 100000;
    var topicID = 100000;
    /*
            EVENT REGISTRATIONS
     */

    $("#add_review").click(addReview);
    $("#reviews_container").click({elementID: "#review_row_"}, deleteElement);

    $("#add_part").click(addPart);
    $("#parts_container").click({elementID: "#part_row_"}, deleteElement);

    $("#parts_container").click(addTopic);
    $("#parts_container").click({elementID: "#topic_row_"}, deleteInnerElement);

    /***************** Add Part Rows *****************/
    function addPart() {
        row = `<div class="col-md-12 bg-light mb-3 p-3" id="part_row_${partID}">
                    <div class="row">
                        <div class="col-md-11">
                            <div class="form-group col-md-12 mb-2 px-0">
                                <input type="hidden" name="part_id[]" value="-1">
                                <input type="hidden" name="topics_count[]" id="topic_count_${partID}" value="1">
                                <input type="text" name="part_name[]"
                                       class="form-control"
                                       placeholder="Enter name of the part" id="part_name_${partID}">
                            </div>
                            <div class="bg-white pb-2">
                                <div class="col-md-12 py-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <label class="font-weight-bold mb-0">Topics: </label>
                                        <button type="button"
                                                class="btn btn-label-brand btn-sm btn-bold add_topic"
                                                data-id="${partID}"><i
                                                class="la la-plus add_topic" data-id="${partID}"></i> Add
                                        </button>
                                    </div>
                                </div>
                                <div id="topics_container_${partID}">
                                    <div class="row topic_row" id="topic_row_${topicID}">
                                        <input type="hidden" name="topic_id[]" value="-1">
                                        <div class="form-group col-md-11 mb-3 pl-4">
                                <textarea type="text" name="topic_description[]" rows="2"
                                          class="form-control"
                                          placeholder="Enter topic wise description"
                                          id="topic_${topicID}"></textarea>
                                        </div>
                                        <div class="col-md-1 d-flex align-items-center">
                                            <button type="button"
                                                    class="btn btn-icon btn-label-danger btn-bold delete-topic"
                                                    data-parent="${partID}" data-id="${topicID}">
                                                <i class="flaticon2-trash delete-topic"
                                                   data-parent="${partID}" data-id="${topicID}"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1 d-flex align-items-center">
                            <button type="button"
                                    class="ml-3 p-4 btn btn-icon btn-icon-lg btn-label-danger btn-bold delete"
                                    data-id="${partID}">
                                <i class="flaticon2-trash delete" data-id="${partID}"></i>
                            </button>
                        </div>
                    </div>
                </div>`;
        $("#parts_container").append(row);
        partID++;
        topicID++;
    }

    /***************** Add Review Rows *****************/
    function addReview() {
        row = `<div class="bg-light p-3 mb-3 review_row" id="review_row_${reviewID}">
                    <div class="row">
                        <div class="col-md-11">
                            <div class="row">
                                <input type="hidden" name="review_id[]" value="-1">
                                <div class="form-group col-md-6">
                                    <input type="text" name="review_name[]"
                                           class="form-control"
                                           placeholder="Enter name of the reviewer"
                                           id="review_name_${reviewID}">
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="pl-0">
                                        <div class="input-group date">
                                            <input type="text"
                                                   name="review_date[]"
                                                   class="form-control review_date" readonly
                                                   placeholder="Select date &amp; time"
                                                   id="review_date_${reviewID}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-9 mb-0">
                                <textarea type="text" name="review[]" rows="7"
                                          class="form-control" id="review_review_${reviewID}"
                                          placeholder="Enter review"></textarea>
                                </div>
                                <div class="form-group col-md-3 mb-0">
                                    <div class="col-lg-6 col-xl-6">
                                        <div class="kt-avatar kt-avatar--outline" id="review_image_${reviewID}">
                                            <div class="kt-avatar__holder"
                                                 style="background-image: url('/assets/admin/media/placeholders/500x500.jpg'); width: 150px; height: 150px"></div>
                                            <label class="kt-avatar__upload"
                                                   data-toggle="kt-tooltip" title=""
                                                   data-original-title="Change image">
                                                <i class="fas fa-pen"></i>
                                                <input type="file" name="review_image[]"
                                                       id="review_image_input_${reviewID}" value="">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1 d-flex align-items-center">
                            <button type="button" data-id="${reviewID}"
                                    class="ml-3 p-4 btn btn-icon btn-icon-lg btn-label-danger btn-bold delete">
                                <i class="flaticon2-trash delete" data-id="${reviewID}"></i>
                            </button>
                        </div>
                    </div>
                </div>`;
        $("#reviews_container").append(row);
        var avatar = new KTAvatar(`review_image_${reviewID}`);
        reviewID++;
        initDatePicker();
    }

    /***************** Add Review Rows *****************/
    function addTopic(e) {
        if (e.target.classList.contains('add_topic')) {
            rowId = e.target.dataset.id;
            row = `<div class="row topic_row" id="topic_row_${topicID}">
                        <input type="hidden" name="topic_id[]" value="-1">
                        <div class="form-group col-md-11 mb-3 pl-4">
                            <textarea type="text" name="topic_description[]" rows="2"
                              class="form-control"
                              placeholder="Enter topic wise description"
                              id="topic_${topicID}"></textarea>
                        </div>
                        <div class="col-md-1 d-flex align-items-center">
                            <button type="button"
                                    class="btn btn-icon btn-label-danger btn-bold delete-topic"
                                    data-parent="${rowId}" data-id="${topicID}">
                                <i class="flaticon2-trash delete-topic"
                                   data-parent="${rowId}" data-id="${topicID}"></i>
                            </button>
                        </div>
                    </div>`;

            $("#topics_container_" + rowId).append(row);
            $("#topic_count_" + rowId).val((parseInt($("#topic_count_" + rowId).val())+1));
            topicID++;
        }
    }

    /***************** Deleting Elements *****************/
    function deleteElement(e, elementID) {
        if (e.target.classList.contains('delete')) {
            rowId = e.target.dataset.id;
            $(e.data.elementID + rowId).remove();
        }
    }

    function deleteInnerElement(e, elementID) {
        if (e.target.classList.contains('delete-topic')) {
            rowId = e.target.dataset.id;
            parentId = e.target.dataset.parent;
            $(e.data.elementID + rowId).remove();
            $("#topic_count_" + parentId).val((parseInt($("#topic_count_" + parentId).val())-1));
        }
    }

});
