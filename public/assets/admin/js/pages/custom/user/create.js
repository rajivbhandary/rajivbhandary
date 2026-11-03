"use strict";

// Class definition
var KTUserAdd = function () {
	// Base elements
	var wizardEl;
	var formEl;
	var validator;
	var wizard;
	var avatar;

	// Private functions
	var initWizard = function () {
		// Initialize form wizard
		wizard = new KTWizard('kt_user_add_user', {
			startStep: 1, // initial active step number
			clickableSteps: true  // allow step clicking
        });

        // Validation before going to next page
		wizard.on('beforeNext', function(wizardObj) {
			if (validator.form() !== true) {
				wizardObj.stop();  // don't go to the next step
			}
		})

		// Change event
		wizard.on('change', function(wizard) {
			KTUtil.scrollTop();
		});
	}

    var initValidation = function() {
		validator = formEl.validate({
			// Validate only visible fields
			ignore: ":hidden",

			// Validation rules
			rules: {
				// Step 1
				first_name: {
					required: true
                },
                last_name: {
					required: true
				},
				phone_number: {
                    required: true,
                    min: 10,
                    max: 10
				},
				email: {
					required: true,
					email: true
                },
                gender: {
					required: true
                },
                mother_number: {
					min: 10,
                    max: 10
                },
                father_number: {
					min: 10,
                    max: 10
                },
                address_line_1: {
                    maxlength: 255
                },
                address_line_2: {
                    maxlength: 255
                },
                image: {
                    accept: "image/*",
                    extension: "png | jpeg | jpg | svg",
                    maxsize: 5000000,
                },

                college: {
					required: true
                },
                standard: {
					required: true
                },
                semester: {
					required: true
                },
                branch: {
					required: true
                },
			},

			// Display error
			invalidHandler: function(event, validator) {
				KTUtil.scrollTop();

				swal.fire({
					"title": "",
					"text": "There are some errors in your submission. Please correct them.",
					"type": "error",
					"buttonStyling": false,
					"confirmButtonClass": "btn btn-brand btn-sm btn-bold"
				});
			},

			// Submit valid form
			submitHandler: function (form) {

			}
		});

    }

    var initUserForm = function() {
		avatar = new KTAvatar('kt_user_add_avatar');
	}


	return {
		// public functions
		init: function() {
            formEl = $('#kt_user_add_form');

            initWizard();
            initValidation();
			initUserForm();
		}
	};
}();

jQuery(document).ready(function() {
	KTUserAdd.init();
});
