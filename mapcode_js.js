$(document).ready(function() {

// Process form
$('form').submit(function(event) {
var gg=$("#eventid").val();
var aa=$("#lat").val();
var bb=$("#lng").val();
var cc=$("#radius").val()
var dd=$("#cluedescription").val()
    // Get form data
    var formData = {
        'eventid' : gg,
    	'lat':aa,
    	'lng':bb,
        'radius':cc,
        'cluedescription':dd
    };
   
    $.ajax({
    	type: 'POST',
    	url: 'map2.php',
        data: formData, 
        dataType: 'text', 
        encode: true
    })

        // Using the done promise callback
        .done(function(data) {

            // Log data to the console
            console.log(data);
           if (!data.success) {

                // Handle errors for name
                
                console.log("success");
                var json = JSON.parse(data);
        		//now json variable contains data in json format
        		//let's display a few items
        		if (json.map_js)
        			{$("#message").html('Successfully added');
                     //window.location = 'index.html'; 
                     alert("Coordinates added to the database Successfully");
                 }
        		else
        			$("#message").html('Error adding');
    		} else {
                // Show success message
                $('form').append('<div class="alert alert-success">' + data.message + '</div>');

                
            }
        })

        .fail(function(data) {

        	console.log(data);
        });

    event.preventDefault();
});
});