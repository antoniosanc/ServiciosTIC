$().ready(function() {

	$("#frm_agregadatos").validate({
		rules: {
			nombre_usuario: {
				required: true,
				minlength: 5
			},
			usuario_usuario: {
				required: true,
				minlength: 5
			},
			correo_empresa: {
				required: true,
				email: true
			},
			password_nuevo: {
				required: true,
				minlength: 5
			},
			password_nuevo_confirma: {
				required: true,
				minlength: 5,
				equalTo: "#password_nuevo"
			},
			input_secciones: {
				required: true
			},
			input_contenidos: {
				required: true
			},
			input_estadisticas: {
				required: true
			},
			input_centro_negocios: {
				required: true
			},
			input_configuracion: {
				required: true
			}
		},
		messages: {
			nombre_usuario: {
				required: "Escriba el nombre del usuario",
				minlength: "Escriba el nombre completo del usuario"
			},
			usuario_usuario: {
				required: "Escriba el usuario",
				minlength: "Escriba un usuario de almenos 5 caracteres"
			},
			correo_empresa: {
				required: "Ingrese un correo electr&oacute;nico v&aacute;lido",
				email: "Escriba una direcci&oacute;n de Correo electr&oacute;nico correcta."
			},
			password_nuevo: {
				required: "Favor de escribir la nueva contrase&ntilde;a",
				minlength: "La contrase&ntilde;a es demasiado peque&ntilde;a"
			},
			password_nuevo_confirma: {
				required: "Favor de escribir la nueva contrase&ntilde;a",
				minlength: "La contrase&ntilde;a es demasiado peque&ntilde;a",
				equalTo: "Las contrase&ntilde;as no coinciden"
			}
		}
	});
});