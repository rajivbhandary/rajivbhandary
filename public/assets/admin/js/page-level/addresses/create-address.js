var semester = ['First', 'Second', 'Third', 'Fourth', 'Fifth', 'Sixth', 'Seventh', 'Eighth'];
$("#standard").change(function(){
    $("#semester").empty();
    if(this.value == 'diploma'){
        semCount = 6;
    }else{
        semCount = 8;
    }
    $("#semester").append(
        `<option value="" selected disabled>--- Select ---</option>`
    );
    for(var i = 0; i < semCount; i++){
        $("#semester").append(
            `<option value='${i+1}'>${semester[i]}</option>`
        );
    }
});

$(function(){
    $("#create-address").validate({
        'rules': {
            'first_name':{
                required: true,
                minlength: 2,
                maxlength: 255
            },
            'last_name':{
                required: true,
                minlength: 2,
                maxlength: 255
            },
            'phone_number':{
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 10
            },
            'standard':{
                required: true,
            },
            'semester':{
                required: true,
            },
            'block_number':{
                required: true,
                minlength: 2,
                maxlength: 255
            },
            'landmark':{
                required: true,
                minlength: 2,
                maxlength: 255
            },
            'town':{
                required: true,
                minlength: 2,
                maxlength: 255
            },
            'city':{
                required: true,
                minlength: 2,
                maxlength: 255
            },
            'pincode':{
                required: true,
                digits: true,
                minlength: 6,
                maxlength: 6
            },
            'state':{
                required: true,
                minlength: 2,
                maxlength: 255
            },
            'country':{
                required: true,
                minlength: 2,
                maxlength: 255
            }
        },
        submitHandler: function(form) {
            // do other things for a valid form
            form.submit();
        }
    });
});
