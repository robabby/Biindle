var Biindle = {
	user : {}
};

// Check for the #user-dropdown, then 
// gather the username from that element 
// to query user information
if($("#user-dropdown").length) {
	var username = $("#user-dropdown").text().trim();
	var dataString = "requestUser=1&username="+username;
	$.ajax({
		type: "GET",
		url: "/assets/inc/user_funcs.inc.php",
		data: dataString,
        contentType: "application/json; charset=utf-8",
		dataType: "json",
		success: function(data){
		    console.log(data);
        	Biindle.user.user_id = data.user_info[0]['user_id'];
        	Biindle.user.username = data.user_info[0]['username'];
        	Biindle.user.first_name = data.user_info[0]['first_name'];
        	Biindle.user.last_name = data.user_info[0]['last_name'];
        	Biindle.user.email = data.user_info[0]['email'];
		},
		error: function(jqXHR, textStatus, errorThrown) {
		    console.log("There appears to have been an error:\n\n"+errorThrown);
		}
	}); // $.ajax()
}

// Begin Biindle notification system
/*
setInterval(function() {
$.get("file.php", { userid: "userid" },
	function(data){
		if (data > old_count) {
			alert("the list is updated with: " + data);
			//OR
			//console.log('the list is updated with:' + data);
			old_count = data;
		}
	 }
)},5000); // every 5 seconds
*/