$().ready(function() {
	
	$("#frm_infogral").validate({
		rules: {
			nombre_empresa: {
				required: true,
				minlength: 5
			},
			correo_empresa: {
				required: true,
				email: true
			},
			pagina_empresa: {
				required: true,
				url: true
			},
			txt_email_empresa: {
				required: true,
				minlength: 30
			}
		},
		messages: {
			nombre_empresa: {
				required: "Escriba el nombre de su empresa",
				minlength: "Escriba el nombre completo de su empresa"
			},
			correo_empresa: {
				required: "Ingrese un correo electr&oacute;nico v&aacute;lido",
				email: "Escriba una direcci&oacute;n de Correo electr&oacute;nico correcta."
			},
			pagina_empresa: {
				required: "Ingrese la direcci&oacute;n web correcta de su p&aacute;gina web",
				url: "Ingrese una URL v&aacute;lida"
			},
			txt_email_empresa: {
				required: "Escriba el correo de confirmaci&oacute;n que le llegar&aacute;n a sus usuarios cuando lo contacten",
				minlength: "Le recomendamos ingresar m&aacute;s informaci&oacute;n"
			}
		}
	});
	
	$("#frm_misc").validate({
		rules: {
			keyword_seo_base: {
				required: true,
				minlength: 3
			},
			keywords_base: {
				required: true,
				minlength: 12
			},
			descripcion_base: {
				required: true,
				minlength: 100
			},
			analytics: {
				required: true,
				minlength: 8
			},
			chat: {
				required: false,
				minlength: 15
			},
			chat_facebook: {
				required: false,
				minlength: 15
			},
			recaptcha_publico: {
				required: false,
				minlength: 10
			},
			recaptcha_privado: {
				required: false,
				minlength: 10
			}
		},
		messages: {
			analytics: {
				required: "Escriba su identificador de Google Analytics",
				minlength: "El Identificador de Google Analytics no es correcto"
			},
			chat: {
				minlength: "Verifique que el c&oacute;digo sea correcto"
			},
			chat_facebook: {
				minlength: "Verifique que el c&oacute;digo sea correcto"
			},
			recaptcha_publico: {
				minlength: "Verifique que el c&oacute;digo sea correcto"
			},
			recaptcha_privado: {
				minlength: "Verifique que el c&oacute;digo sea correcto"
			}
		}
	});
	
});