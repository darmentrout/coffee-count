
// RETRIEVE DATA FROM THE JSON FILE OR THROW AN ERROR
$.ajax({
  type:    "GET",
  url:     "coffee-cups.json",
  cache: false,
  success: callback,
  error:   function(jqXHR, textStatus, errorThrown) {
        console.log("Error, status = " + textStatus + ", " +
              "error thrown: " + errorThrown
        );
  }
});



// CALLBACK FUNCTION FOR THE AJAX REQUEST ABOVE
function callback(data){

	var timestamp = Date.now();

	var cups = data;

	// CHECK FOR VOWELS SO THAT THE MESSAGE IS GRAMMATICAL
	var numCups = Object.keys(cups).length - 1;
	if ( "AEIOUaeiou".indexOf(cups[numCups][1][0]) > -1 ){
		$('#lastCup').html('an ' + cups[numCups][1]);
	}
	else {
		$('#lastCup').html('a ' + cups[numCups][1]);
	}

	// CAPITALIZE NAME AND MAKE POSSESSIVE
	var lastUser = cups[numCups][2];
	lastUser = lastUser.substring(0, 1).toUpperCase() + lastUser.substring(1)
	$('#lastUser').html( lastUser + '\'s ' );	

	// DISPLAY INTERVAL SINCE LAST CUP OF COFFEE
	var sinceCup = timestamp - cups[numCups][0];
	sinceCup = Math.round(sinceCup / 86400000);
	if (sinceCup == 0){ $('#sincePlural').hide(); sinceCup = 'today.'; }
	if (sinceCup == 1){ $('#sincePlural').hide(); sinceCup = '1 day ago.'; }
	$('#lastCupDate').html( sinceCup );

	var thisCup;

	// COMPILE DATA TO SAVE TO THE JSON FILE AND SHOW IT TO THE USER
	$('#saucer li').on('click', function(){
	    thisCup = timestamp + ',' + $(this).text() + ',' + username;
	    $('#submitCup').html('Submit: ' + $(this).text());
	});

	$('#submitCup').on('click', function(){

		// SEND AJAX REQUEST WITH USER DATA TO SAVE.PHP OR THROW ERRORS
		$.ajax({
			type: "POST",
			url: "save.php",
			cache: false,
			data: thisCup,
			success: function(){
				$('#submitCup').html('Done!');
				$.ajax({
					type:    "GET",
					url:     "coffee-cups.json",
					cache: false,
					success: callback,
					error:   function(jqXHR, textStatus, errorThrown) {
						console.log("Error, status = " + textStatus + ", " +
							"error thrown: " + errorThrown
						);
					}
				});
			},
			error:   function(jqXHR, textStatus, errorThrown) {
				console.log("Error, status = " + textStatus + ", " +
					"error thrown: " + errorThrown
				);
			}
		});

	}); // END #SUBMITCUP ONCLICK

} // END CALLBACK




// MAKE WEATHER REQUEST
function weatherVane(city){
	$.ajax({
		type: 'GET',
		cache: false,
		url: 'weather.php',
		data: {city: city},
		success: weatherCallback,
		error:   function(jqXHR, textStatus, errorThrown) {
			console.log("Error, status = " + textStatus + ", " +
				"error thrown: " + errorThrown
			);
		}
	});
}
weatherVane('Phoenix');

// PARSE THE WEATHER REPORT AND DISPLAY RECOMMENDATION
function weatherCallback(data){
	var weather;
	weather = data;
	var temp = weather.main.temp.toString().split('.');
	var tempToday = parseInt( temp[0] );
	$('#temperature').text(tempToday);
	if ( tempToday >= 75 ){
		$('#tDrink').text('an iced coffee');
	}
	else {
		$('#tDrink').text('a warm cup of coffee');
	}
}


// CONTROL THE CITY SELECTION FIELD
$('#city').on('click', function(){
	$(this).hide();
	$('#cityInput').fadeIn();
});

function getCity(e){
	var k = e.keyCode;
	if (k == 13){
		var thisCity = $('#cityInput').val();
		$('#city').text( $('#cityInput').val() );
		weatherVane(thisCity);
		$('#cityInput').hide();
		$('#city').fadeIn();
	}
}

$('#cityInput').on( 'keydown', function(e){ getCity(e) });