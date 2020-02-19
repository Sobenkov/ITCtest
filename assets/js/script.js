$(#sendMail).on("click", function(){

	var name = $("#name").val().trim();
	var tel = $("#tel").val().trim();
	var email = $("#email").val().trim();

$.ajax({
	url: 'ajax/mail.php',
	type: 'POST',
	cache: false,
	data: {'name': name, 'tel': tel, 'email': email},
	dataType: 'html',
	beforeSend: function(){
		$("#sendMail").prop("disabled", true);
	},
	success: function(data){
		alert(data);
		$("#sendMail").prop("disabled", false);
	}
});

});

