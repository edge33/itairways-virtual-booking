$("#frmProfile").submit(function(e) {
	e.preventDefault();
	
	var email = $("#txtEmail").val();
	var privacy = $("#chkPrivacy").is(":checked");
	var password = $("#txtPassword").val();

	$.ajax({
		cache: false,
		type: "POST",
		url: "json",
		data: { "type": "profile", "action": "update", "email": email, "privacy": privacy, password },
		success: function(data) { 
			if (data && data.error == 0)
			{
				toast({
					title: "Your profile has been saved!",
					type: "success",
				});
			}
			else
				notification(data);
		}
	});	
}); 