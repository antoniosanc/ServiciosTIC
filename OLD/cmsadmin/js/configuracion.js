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
			keyworkds_base: {
				required: true,
				minlength: 8
			},
			descripcion_base: {
				required: true,
				minlength: 20
			},
			analytics: {
				required: true,
				minlength: 8
			},
			css_custom: {
				required: false,
				minlength: 4
			}
		},
		messages: {
			analytics: {
				required: "Escriba su identificador de Google Analytics",
				minlength: "El Identificador de Google Analytics no es correcto"
			},
			css_custom: {
				minlength: "Verifique la sintaxis de su hoja de estilos"
			}
		}
	});
	
});