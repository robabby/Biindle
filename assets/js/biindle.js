var Biindle = {};

if($("#user-dropdown").length) {

	var username = $("#user-dropdown").text().trim();

	var dataString = "requestUser=1&username="+username;

	$.ajax({
		beforeSend: function() {
		    
		},
		type: "POST",
		contentType: "application/json; charset=utf-8",
        dataType: "json",
		url: "/assets/inc/user_funcs.inc.php",
		data: dataString,
		success: function(data){
		    if(data.length) {
		    	console.log(data);
	            for(i = 0 ; i < data.length; i++) {

	            	console.log(data[i]);

	            	// We don't need username, because we set that earlier
	            	var user_id = data[i].user_id;
	            	var first_name = data[i].first_name;
	            	var last_name = data[i].last_name;
	            	var email = data[i].email;
	            	var ipAddress = data[i].ip;
	            }

	            console.log(ipAddress);

	            return user_id, first_name, last_name, email, ipAddress;
	        }
		},
		complete: function(){
		    
		},
		error: function(jqXHR, textStatus, errorThrown) {
		    console.log("There appears to have been an error:\n\n"+errorThrown);
		}
	}); // $.ajax()

	Biindle.user = {
		username : "",
		first_name : "",
		last_name : "",
		email : ""
	}
}