"use strict";

// Class definition
var KTWizard2 = function () {
    // Base elements
    var wizardEl;
    var formEl;
    var validator;
    var wizard;
    var uppy;
    var folderName;

    // Private functions
    var initWizard = function () {
        // Initialize form wizard
        wizard = new KTWizard('kt_wizard_v2', {
            startStep: 1, // initial active step number
			clickableSteps: true  // allow step clicking
        });

        //Validation before going to next page
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
            endpoint: '/control-panel/property-image-upload/' + folderName,
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
            ignore: ":hidden",

            // Validation rules

            'rules': {
                'property-status': {
                    required: true,
                },
                'property-type': {
                    required: true,
                },
                'property-commercials': {
                    required: true,
                },
                'property-detailed-type': {
                    required: true,
                    minlength: 2,
                    maxlength: 255
                },
                'name': {
                    required: true,
                    minlength: 2,
                    maxlength: 255
                },
                'phone': {
                    required: true,
                    digits: true,
                    minlength: 10,
                    maxlength: 10
                },
                'email': {
                    required: true,
                    email: true,
                },
                'location-realtor-name': {
                    minlength: 2,
                    maxlength: 255
                },
                'location-house-number': {
                    required: true,
                    minlength: 2,
                    maxlength: 255
                },
                'property-office-number': {
                    required: true,
                    minlength: 2,
                    maxlength: 255
                },
                'property-others-office-number': {
                    required: true,
                    minlength: 2,
                    maxlength: 255
                },
                'property-shop-number': {
                    required: true,
                    minlength: 2,
                    maxlength: 255
                },
                'location-building-name': {
                    required: true,
                    minlength: 2,
                    maxlength: 255
                },
                'location-street': {
                    required: true,
                    minlength: 2,
                    maxlength: 255
                },
                'location-landmark': {
                    minlength: 2,
                    maxlength: 255
                },
                'location-locality': {
                    required: true,
                    minlength: 2,
                    maxlength: 255
                },
                'location-town': {
                    required: true,
                    minlength: 2,
                    maxlength: 255
                },
                'location-city': {
                    required: true,
                    minlength: 2,
                    maxlength: 255
                },
                'location-pincode': {
                    required: true,
                    minlength: 6,
                    maxlength: 6,
                    digits: true
                },
                'location-state': {
                    required: true,
                    minlength: 2,
                    maxlength: 255
                },
                'location-country': {
                    required: true,
                },
                'location-latitude': {
                    required: true,
                    number: true,
                },
                'location-longitude': {
                    required: true,
                    number: true,
                },
                'property-bedrooms': {
                    required: true,
                    digits: true
                },
                'property-bathrooms': {
                    required: true,
                    digits: true
                },
                'property-facade-width': {
                    required: true,
                },
                'property-facade-height': {
                    required: true,
                },
                'property-separate-toilets': {
                    required: false,
                    digits: true
                },
                'property-total-floors': {
                    required: true,
                    digits: true
                },
                'property-floor-number': {
                    required: true,
                    digits: true
                },
                'property-seats': {
                    required: true,
                    digits: true
                },
                'property-cabin': {
                    required: true,
                    digits: true
                },
                'property-meeting-room': {
                    required: true,
                    digits: true
                },
                'property-reception-area': {
                    required: true,
                },
                'property-pantry': {
                    required: true,
                },
                'roperty-staircase': {
                    required: true,
                },
                'property-lift': {
                    required: true,
                },
                'property-furnished-status': {
                    required: true,
                },
                'property-others-furnished-status': {
                    required: true,
                },
                'suitable_business[]': {
                    required: true,
                },
                'property-covered-parking': {
                    required: true,
                    digits: true
                },
                'property-open-parking': {
                    required: true,
                    digits: true
                },
                'property-others-covered-parking': {
                    required: true,
                    digits: true
                },
                'property-others-open-parking': {
                    required: true,
                    digits: true
                },
                'property-facing-direction': {
                    required: true,
                    minlength: 2,
                    maxlength: 255
                },
                'property-age-property': {
                    required: true,
                    digits: true
                },
                'property-description': {
                    required: true,
                    minlength: 2,
                },
                'property-carpet-area': {
                    required: true,
                },
                'property-feature-image': {
                    required: true
                },
                'property-rera-number': {
                    required: false,
                },
                'property-availability-status': {
                    required: true,
                },
                'property_feature_image': {
                    required: true
                },
                'property-price': {
                    required: true,
                    digits: true
                },
                'property-negotiable': {
                    required: true,
                },
                'property-security-deposit-mode': {
                    required: true,
                },
                'property-amount': {
                    required: true,
                    digits: true
                },
                'property-duration-of-agreement': {
                    required: true,
                    digits: true
                },
                'property-months-of-notice': {
                    required: true,
                    digits: true
                }
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
                                    "text": "The property has been created successfully!",
                                    "type": "success",
                                    "confirmButtonClass": "btn btn-secondary"
                                }).then(function(result) {
                                    window.location.href = window.origin + '/control-panel/properties';
                                });
                            }else if(data == 'failure'){
                                swal.fire({
                                    "title": "",
                                    "text": "There was some error. Please try again!",
                                    "type": "error",
                                    "confirmButtonClass": "btn btn-secondary"
                                }).then(function(result) {
                                    window.location.href = window.origin + '/control-panel/properties';
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
            wizardEl = KTUtil.get('kt_wizard_v2');
            formEl = $('#kt_form');
            folderName = "properties"
            // console.log(folderName);

            initWizard();
            initUppy();
            initValidation();
            initSubmit();
        }
    };
}();

jQuery(document).ready(function() {
    KTWizard2.init();

    var avatar = new KTAvatar('image');

    var commercial = false;

    //Initially display:none, if Commercial selected in property-type then only display:block
    $('#property-commercial-select').css('display', 'none');

    //To manage Rent-detail related fields
    $('#property-status').on('change', function(){
        var type = $(this).children("option:selected").text();
        if(type == 'Rent'){
            $('.property-rent').css('display', 'block');
            $('.property-sell').css('display', 'none');
        }else if(type == 'Sell'){
            $('.property-rent').css('display', 'none');
            $('.property-sell').css('display', 'block');
        }
    });

    //To manage fields residential & commercials
    $('#property-type').on('change', function(){
        var type = $(this).children("option:selected").text();
        if(type == 'Residential'){
            $('#property-commercial-select').css('display', 'none');
            $('.property-commercial-office').css('display', 'none'); 
            $('.property-commercial-shops').css('display', 'none'); 
            $('.property-commercial-others').css('display', 'none'); 

            $('.property-residential').css('display', 'block');
            commercial = false;
        }else if(type == 'Commercial'){
            $('#property-commercial-select').css('display', 'block');
            $('.property-residential').css('display', 'none');

            commercial = true;
        }
    });

    //To manage the fields of offices, shop & others 
    $('#property-commercials').on('change', function(){

        var type = $(this).children("option:selected").text();
        
        if(commercial == true){
            
            if(type == 'Offices'){
                //Hide all others
                $('.property-commercial-shops').css('display', 'none');
                $('.property-commercial-others').css('display', 'none'); 

                //Show only offices
                $('.property-commercial-office').css('display', 'block'); 
            }else if(type == 'Shops'){
                $('.property-commercial-office').css('display', 'none');
                $('.property-commercial-others').css('display', 'none'); 

                $('.property-commercial-shops').css('display', 'block'); 

            }else if(type == 'Land'){
                    $('.property-commercial-office').css('display', 'none');
                    $('.property-commercial-others').css('display', 'none');
                    $('.property-commercial-shops').css('display', 'none'); 

                    $(".property-bathroom").css('display', 'none');
                    $(".property-total-floor").css('display', 'none');
                    $(".property-floor-number").css('display', 'none');
                    $(".add-special-room").css('display', 'none');
                    $(".add-amenity").css('display', 'none');
                    $(".add-facility").css('display', 'none');
                    $(".add-safety-equipment").css('display', 'none');

                }else if(type == 'Others'){
                $('.property-commercial-office').css('display', 'none'); 
                $('.property-commercial-shops').css('display', 'none'); 

                $('.property-commercial-others').css('display', 'block');
            }
        }
    });


    $('#property-availability-by').datetimepicker({
        todayHighlight: true,
        autoclose: true,
        pickerPosition: 'top-left',
        format: 'yyyy/mm/dd',
        startDate: new Date(),
    });

    var specialRoomID = 2;
    var amenityID = 2;
    var facilityID = 2;
    var surroundingID = 2;
    var safetyEquipmentID = 2;
    var suitableBusinessID = 2;


    /*******************Event Register  *******************/
    $("#add_special_room").click(addSpecialRoom);
    $("#special_room_container").click({elementID: "#special_room_row_"}, deleteElement);

    $("#add_amenity").click(addAmenity);
    $("#amenity_container").click({elementID: "#amenity_row_"}, deleteElement);

    $("#add_facility").click(addFacility);
    $("#facility_container").click({elementID: "#facility_row_"}, deleteElement);

    $("#add_surrounding").click(addSurrounding);
    $("#surrounding_container").click({elementID: "#surrounding_row_"}, deleteElement);

    $("#add_safety_equipment").click(addSafetyEquipment);
    $("#safety_equipment_container").click({elementID: "#safety_equipment_row_"}, deleteElement);

    $("#add_suitable_business").click(addSuitableBusiness);
    $("#suitable_business_container").click({elementID: "#suitable_business_row_"}, deleteElement);

    /*******************Event functions ******************/

    function addSpecialRoom(){
        var rowSpecialRoom = `
            <div class="row special_room" id="special_room_row_${specialRoomID}">
                <div class="form-group col-xd-6 col-md-6">
                    <label for="special_room">Name</label>
                    <input type="text" class="form-control" id="special_room_${specialRoomID}"
                        name="special_room[]"
                        placeholder="Enter Special Room">
                </div>
                <div class="col-md-1 d-flex align-items-center justify-content-center">
                    <button data-id="${specialRoomID}" type="button"
                            class="btn btn-label-brand btn-icon delete"><i
                            class='kt-menu__link-icon flaticon2-trash delete'
                            data-id="${specialRoomID}"></i></button>
                </div>
                
            </div>
        `;

        $("#special_room_container").append(rowSpecialRoom);
       specialRoomID++;
    }

    function addAmenity(){
        var rowAmenity = `
            <div class="row amenity_row" id="amenity_row_${amenityID}">
                <div class="form-group col-xd-6 col-md-6">
                    <label for="amenity_name">Name</label>
                    <input type="text" class="form-control" id="amenity_name_${amenityID}"
                        name="amenity_name[]"
                        placeholder="Enter Amenity">
                </div>
                <div class="col-md-1 d-flex align-items-center justify-content-center">
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

    function addFacility(){
        var rowFacility = `
                <div class="row facility_row" id="facility_row_${facilityID}">
                    <div class="form-group col-xd-6 col-md-6">
                        <label for="facility_name">Name</label>
                        <input type="text" class="form-control" id="facility_name_${facilityID}"
                            name="facility_name[]"
                            placeholder="Enter Facilty">
                    </div>
                    <div class="col-md-1 d-flex align-items-center justify-content-center">
                        <button data-id="${facilityID}" type="button"
                                class="btn btn-label-brand btn-icon delete"><i
                                class='kt-menu__link-icon flaticon2-trash delete'
                                data-id="${facilityID}"></i></button>
                    </div>
                </div>
            `;
        $("#facility_container").append(rowFacility);
        facilityID++;
    }

    function addSurrounding(){
        var rowSurrounding = `
                <div class="row surrounding_row" id="surrounding_row_${surroundingID}">
                    <div class="form-group col-xd-6 col-md-6">
                        <label for="surrounding_name">Name</label>
                        <input type="text" class="form-control" id="surrounding_name_${surroundingID}"
                            name="surrounding_name[]"
                            placeholder="Enter Surroundings">
                    </div>
                    <div class="col-md-1 d-flex align-items-center justify-content-center">
                        <button data-id="${surroundingID}" type="button"
                                class="btn btn-label-brand btn-icon delete"><i
                                class='kt-menu__link-icon flaticon2-trash delete'
                                data-id="${surroundingID}"></i></button>
                    </div>
                </div>
            `;
        $("#surrounding_container").append(rowSurrounding);
        surroundingID++;
    }

    function addSafetyEquipment(){
        var rowSafetyEquipment = `
                <div class="row safety_equipment_row" id="safety_equipment_row_${safetyEquipmentID}">
                    <div class="form-group col-xd-6 col-md-6">
                        <label for="safety_equipment_name">Name</label>
                        <input type="text" class="form-control" id="safety_equipment_name_${safetyEquipmentID}"
                            name="safety_equipment_name[]"
                            placeholder="Enter Safety Equipment">
                    </div>
                    <div class="col-md-1 d-flex align-items-center justify-content-center">
                        <button data-id="${safetyEquipmentID}" type="button"
                                class="btn btn-label-brand btn-icon delete"><i
                                class='kt-menu__link-icon flaticon2-trash delete'
                                data-id="${safetyEquipmentID}"></i></button>
                    </div>
                </div>    
            `;

        $("#safety_equipment_container").append(rowSafetyEquipment);
        safetyEquipmentID++;
    }

    function addSuitableBusiness(){
        var rowSuitableBusiness = `
                <div class="row suitable_business_row" id="suitable_business_row_${suitableBusinessID}">
                    <div class="form-group col-xd-6 col-md-6">
                        <label for="suitable_business_name">Name</label>
                        <input type="text" class="form-control" id="suitable_business_name_${suitableBusinessID}"
                            name="suitable_business_name[]"
                            placeholder="Enter Suitable Business">
                    </div>
                    <div class="col-md-1 d-flex align-items-center justify-content-center">
                        <button data-id="${suitableBusinessID}" type="button"
                                class="btn btn-label-brand btn-icon delete"><i
                                class='kt-menu__link-icon flaticon2-trash delete'
                                data-id="${suitableBusinessID}"></i></button>
                    </div>
                </div>    
            `;

        $("#suitable_business_container").append(rowSuitableBusiness);
        suitableBusinessID++;
    }

    /*******************Deleting a row ******************/
    function deleteElement(e, elementID) {
        if (e.target.classList.contains('delete')) {
            var rowId = e.target.dataset.id;
            $(e.data.elementID + rowId).remove();
        }
    }
});
