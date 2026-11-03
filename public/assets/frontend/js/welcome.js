jQuery(document).ready(function() {
    $('#property-type').on('change', function(){
        $('#property-subtype-select').empty();
        $('#property-subtype-select').append('<option value="">Select</option>');
        var type = $(this).children("option:selected").text();
        
        if(type == 'Residential'){        
            var house = document.createElement('option');
            house.value = '1';
            house.innerHTML = 'House';
            $('#property-subtype-select').append(house);
        }else if(type == 'Commercial'){
            console.log("here");
            var offices = document.createElement('option');
            offices.value = '1';
            offices.innerHTML = 'Offices';
            
            var shops = document.createElement('option');
            shops.value = '2';
            shops.innerHTML = 'Shops';

            var others = document.createElement('option');
            others.value = '3';
            others.innerHTML = 'Others';

            $('#property-subtype-select').append(offices);
            $('#property-subtype-select').append(shops);
            $('#property-subtype-select').append(others);
        }
    });

    $(window).on('scroll', function() {
		var height = $(window).scrollTop();
		if (height > 100) {
			$('#back2Top').fadeIn();
		} else {
			$('#back2Top').fadeOut();
		}
	});

	$("#back2Top").on('click', function(event) {
		event.preventDefault();
		$("html, body").animate({ scrollTop: 0 }, "slow");
		return false;
	});
});