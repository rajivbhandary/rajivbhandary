/*==============================================================*/
// Raque Contact Form  JS
/*==============================================================*/
(function ($) {
    "use strict"; // Start of use strict
    $("#enquiryForm").validator().on("submit", function (event) {
        if (event.isDefaultPrevented()) {
            // handle the invalid form...
            formError();
            submitMSG(false, "Did you fill in the form properly?");
        } else {
            // everything looks good!
            event.preventDefault();
            $("#enquiryForm").addClass("spinner");
            $(".spinner-border").removeClass("d-none");
            submitForm();
        }
    });


    function submitForm(){
        // Initiate Variables With Form Content
        var name = $("#first_name").val() + " " + $("#last_name").val();
        var phone_number = $("#phone_number").val();
        var email = $("#email").val();
        var city = $("#city").val();
        var state = $("#state").val();
        var message = $("#message").val();
        var model = $("#model").val();
        var model_id = $("#model_id").val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/enquiry",
            data:{
                "name" : name,
                "email" : email,
                "phone_number" : phone_number,
                "message" : message,
                "city" : city,
                "state" : state,
                "model" : model,
                "model_id" : model_id
            },
            datatype: "json",

            success : function(data) {
                $("#enquiryForm").removeClass("spinner");
                $(".spinner-border").addClass("d-none");
                if (data == "success") {
                    formSuccess();
                } else {
                    formError();
                    submitMSG(false, data);
                }
            },
            error: function (data) {
                console.log(data);
                $("#enquiryForm").removeClass("spinner");
                $(".spinner-border").addClass("d-none");
                formError();
                submitMSG(false, 'Some Error Occured');
            }
        });
    }

    function formSuccess(){
        $("#enquiryForm")[0].reset();
        submitMSG(true, "Message Submitted!")
    }

    function formError(){
        $("#enquiryForm").removeClass().addClass('shake animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
            $(this).removeClass();
        });
    }

    function submitMSG(valid, msg){
        if(valid){
            var msgClasses = "h4 tada animated text-center text-primary";
        } else {
            var msgClasses = "h4 text-center text-danger";
        }
        $("#msgBoxOuter").removeClass('d-none');
        $("#msgSubmit").removeClass().addClass(msgClasses).text(msg);
    }

    $(".enquiry-button").click(function () {
        $("#enquiryForm")[0].reset();
        $("#msgSubmit").text('');
        $("#msgBoxOuter").addClass("d-none");
        $(".help-block").html('');
    });

    $(".enquiry-button").click(function () {
        var id = this.dataset.id;
        var model = this.dataset.model;
        $("#model_id").val(id);
        $("#model").val(model);
    });

    // $(".contact-us-enquiry-button").click(function (){
    //     $("#model_id").val('');
    //     $("#model").val('');
    // })

}(jQuery)); // End of use strict