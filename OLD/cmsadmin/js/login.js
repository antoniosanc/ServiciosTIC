$().ready(function() {
	// validate signup form on keyup and submit
	$(".form-signin").validate({
		rules: {
			user: {
				required: true,
				minlength: 5
			},
			password: {
				required: true,
				minlength: 5
			}
		},
		messages: {
			user: {
				required: "Ingrese su usuario",
				minlength: "El nombre de usuario o contrase&ntilde;a parecen  no ser v&aacute;lidos"
			},
			password: {
				required: "Ingrese su contrase&ntilde;a",
				minlength: "El nombre de usuario o contrase&ntilde;a parecen  no ser v&aacute;lidos"
			}
		}
	});
	
});