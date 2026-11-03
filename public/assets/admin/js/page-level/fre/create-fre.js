"use strict";

// Class definition
var KTWizard2 = function () {
    // Base elements
    var wizardEl;
    var formEl;
    var validator;
    var wizard;
    var uppy;
    var folderName = "fres";


    // Private functions
    var initWizard = function () {
        // Initialize form wizard
        wizard = new KTWizard('kt_wizard_v2', {
            startStep: 1, // initial active step number
			clickableSteps: true  // allow step clicking
        });

        // //Validation before going to next page
        // wizard.on('beforeNext', function(wizardObj) {
        //     if (validator.form() !== true) {
        //         wizardObj.stop();  // don't go to the next step
        //     }
        // });

        // wizard.on('beforePrev', function(wizardObj) {
		// 	if (validator.form() !== true) {
		// 		wizardObj.stop();  // don't go to the next step
		// 	}
		// });

        // Change event
        wizard.on('change', function(wizard) {
            KTUtil.scrollTop();
        });

    }

    var initUppy = function(){
        uppy = Uppy.Core({autoProceed: false})
        .use(Uppy.Dashboard, {
          inline: true,
          target: '#kt_uppy_6',
          hideUploadButton: true,
          proudlyDisplayPoweredByUppy: false,
          restrictions: {
            maxFileSize: 2000000,
            allowedFileTypes: ['image/*', 'video/*']
          }
        })

        .use(Uppy.XHRUpload, {
            endpoint: '/control-panel/fre-image-upload/' + folderName,
            method: 'post',
            formData: true,
            fieldName: 'files[]',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        })

        uppy.setMeta({ type: 'file'})

        // uppy.on('file-added', (file) => {
        //     uppy.setFileMeta(file.id, {
        //       size: file.size
        //     })
        //   })
        // .use(Uppy.XHRUpload, {endpoint: location.host + '/storage/app/public/temp/' + folderName})
        
        // .use(null, {endpoint: 'localhost:8000' + '/storage/app/public/temp/' + folderName})
    }

    var initValidation = function() {
        validator = formEl.validate({
            // Validate only visible fields
            ignore: ":hidden, .d-none",

            // Validation rules

            'rules': {
                'title': {
                    required: true,
                    minlength: 2,
                    maxlength: 255,
                },
                'overview': {
                    required: true,
                },
                'commercial_space': {
                    required: true,
                },
                'total_price':{
                    required: true,
                },
                'rental_yield': {
                    number: true,
                },
                'gross_yield': {
                    number: true,
                },
                'expected_irr': {
                    number: true,                    
                },
                'target_multiplier': {
                    number: true,                    
                },
                'fre_rera_numner':{
                    required: true,
                    minlength:12,
                },
                'details_info': {
                    required: true,
                    minlength: 10,
                    maxlength:255,
                },
                'floor_plate': {
                    number: true,
                },
                'floor': {
                    number:true,
                },
                'car_parking': {
                    number: true,
                },
                'elevators': {
                    number: true
                },
                'built_up_area': {
                    required: true,
                    number: true,
                },
                'carpet_area':{
                    required: true,
                    number: true,
                },
                'property_type': {
                    maxlength: 255,
                },
                'tenant_overview': {
                    required: true,
                    minlength: 10,
                    maxlength: 2000,
                },
                'founded': {
                    number: true,
                },
                'industry': {
                    maxlength: 255,
                },
                'market_cap': {
                    maxlength: 255,
                },
                'employees':{
                    number: true,
                },
                'location_building_name': {
                    required: true,
                    minlength: 2,
                    maxlength: 255
                },
                'location_street': {
                    required: true,
                    minlength: 2,
                    maxlength: 255
                },
                'location_landmark': {
                    minlength: 2,
                    maxlength: 255
                },
                'location_locality': {
                    required: true,
                    minlength: 2,
                    maxlength: 255
                },
                'location_town': {
                    required: true,
                    minlength: 2,
                    maxlength: 255
                },
                'location_city': {
                    required: true,
                    minlength: 2,
                    maxlength: 255
                },
                'location_pincode': {
                    required: true,
                    minlength: 6,
                    maxlength: 6,
                    digits: true
                },
                'location_state': {
                    required: true,
                    minlength: 2,
                    maxlength: 255
                },
                'location_country': {
                    required: true,
                },
                'location_latitude': {
                    required: true,
                    number: true,
                },
                'location_longitude': {
                    required: true,
                    number: true,
                },
                'minimum_investment': {
                    required: true,
                },
                'tenant_overview': {
                    required: true,
                },
                'seo_description': { 
                    maxlength: 255,
                },
                'seo_keywords': {
                    maxlength: 2000,
                },
                'seo_og_title': {
                    maxlength: 255,
                },
                'seo_og_description':{
                    maxlength: 255,
                },
            },

            // Display error
            invalidHandler: function(event, validator) {
                KTUtil.scrollTop();

                swal.fire({
                    "title": "",
                    "text": "There are some errors in your submission. Please correct them.",
                    "type": "error",
                    "confirmButtonClass": "btn btn-secondary"
                });
            },

            // Submit valid form
            submitHandler: function (form) {
                // console.log("here");
                // console.log(form);
                form.submit();
            }
        });
    }

    var initSubmit = function() {
        var btn = formEl.find('[type="submit"]');

        btn.on('click', function(e) {
            e.preventDefault();

            if (validator.form()) {

                uppy.upload();
                
                var htmlContent = "";

                uppy.on('complete', (result) => {
                    var data = result.successful;
                    data.forEach(element => {
                       htmlContent = `
                       <input type="hidden" class="form control upload" name="uploadImages[]" value="${element.response.body.uploadURL}">
                       `;
                       $("#kt_form").append(htmlContent);
                    });

                    // See: src\js\framework\base\app.js
                    KTApp.progress(btn);
                    //KTApp.block(formEl);

                    // See: http://malsup.com/jquery/form/#ajaxSubmit
                    formEl.ajaxSubmit({
                        success: function(data) {
                            KTApp.unprogress(btn);
                            //KTApp.unblock(formEl);
    
                            if(data == 'success'){
                                swal.fire({
                                    "title": "",
                                    "text": "The FRE has been created successfully!",
                                    "type": "success",
                                    "confirmButtonClass": "btn btn-secondary"
                                }).then(function(result) {
                                    window.location.href = window.origin + '/control-panel/fre';
                                });
                            }else if(data == 'failure'){
                                swal.fire({
                                    "title": "",
                                    "text": "There was some error. Please try again!",
                                    "type": "error",
                                    "confirmButtonClass": "btn btn-secondary"
                                }).then(function(result) {
                                    window.location.href = window.origin + '/control-panel/fre';
                                });
                            }
                        }
                    });
                });
            }
        });
    }

    return {
        // public functions
        init: function() {
            var avatar = new KTAvatar('image');
            wizardEl = KTUtil.get('kt_wizard_v2');
            formEl = $('#kt_form');

            initWizard();
            initUppy();
            initValidation();
            initSubmit();
        }
    };
}();

jQuery(document).ready(function() {
    KTWizard2.init();

    var amenityID = 2;
    var overviewKeypointID = 2;
    var surroundingID = 2;

    /*******************Event Register  *******************/
    $("#add_amenity").click(addAmenity);
    $("#amenity_container").click({elementID: "#amenity_row_"}, deleteElement);

    $("#add_overview_keypoint").click(addOverviewKeypoint);
    $("#overview_keypoint_container").click({elementID: "#overview_keypoint_row_"}, deleteElement);

    $("#add_surrounding").click(addSurrounding);
    $("#surrounding_container").click({elementID: "#surrounding_row_"}, deleteElement);

    /*******************Event functions ******************/
    function addAmenity(){
        var rowAmenity = `
            <div class="row amenity_row" id="amenity_row_${amenityID}">
                <div class="form-group ">
                    <label for="amenity_name">Name</label>
                    <input type="text" class="form-control" id="amenity_name_${amenityID}"
                        name="amenity_name[]"
                        placeholder="Enter Amenity">
                </div>
                <div class="d-flex align-items-center justify-content-center">
                    <button data-id="${amenityID}" type="button"
                            class="btn btn-label-brand btn-icon delete"><i
                            class='kt-menu__link-icon flaticon2-trash delete'
                            data-id="${amenityID}"></i></button>
                </div>
            </div>
            `;
        $("#amenity_container").append(rowAmenity);
        amenityID++;
    }

    function addOverviewKeypoint(){
        var rowOverviewKeypoint = `
                <div class="row overview_keypoint_row" id="overview_keypoint_row_${overviewKeypointID}">
                    <div class="form-group">
                        <label for="overview_keypoint_name">Name</label>
                        <input type="text" class="form-control" id="overview_keypoint_name_${overviewKeypointID}"
                            name="overview_keypoint_name[]"
                            placeholder="Enter Overview Keypoint">
                    </div>
                    <div class="d-flex align-items-center justify-content-center">
                        <button data-id="${overviewKeypointID}" type="button"
                                class="btn btn-label-brand btn-icon delete"><i
                                class='kt-menu__link-icon flaticon2-trash delete'
                                data-id="${overviewKeypointID}"></i></button>
                    </div>
                </div>
            `;
        $("#overview_keypoint_container").append(rowOverviewKeypoint);
        overviewKeypointID++;
    }

    function addSurrounding(){
        var rowsurrounding = `
                <div class="row surrounding_row" id="surrounding_row_${surroundingID}">
                    <div class="form-group ">
                        <label for="surrounding_name">Name</label>
                        <input type="text" class="form-control" id="surrounding_name_${surroundingID}"
                            name="surrounding_name[]"
                            placeholder="Enter Surroundings">
                    </div>
                    <div class="d-flex align-items-center justify-content-center">
                        <button data-id="${surroundingID}" type="button"
                                class="btn btn-label-brand btn-icon delete"><i
                                class='kt-menu__link-icon flaticon2-trash delete'
                                data-id="${surroundingID}"></i></button>
                    </div>
                </div>
            `;
        $("#surrounding_container").append(rowsurrounding);
        surroundingID++;
    }

    $('#fre_availability_by').datetimepicker({
        todayHighlight: true,
        autoclose: true,
        pickerPosition: 'top-left',
        format: 'yyyy/mm/dd',
        startDate: new Date(),
    });

    $('#founded').datetimepicker({
        todayHighlight: true,
        autoclose: true,
        startView: 4,
        minView: 4,
        format: 'yyyy'
    });

    $("#founded").change(function () {
        $("#founded-details").text('This would be considered as ' + ((parseInt($("#founded").val())-1)) + "-" + ($("#founded").val()));
    });

    /*******************Deleting a row ******************/
    function deleteElement(e, elementID) {
        if (e.target.classList.contains('delete')) {
            var rowId = e.target.dataset.id;
            $(e.data.elementID + rowId).remove();
        }
    }
});
