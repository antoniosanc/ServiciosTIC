$().ready(function() {
	
	$('[data-toggle="tooltip"]').tooltip()
	 
	$("#frm_datosgral").validate({
		rules: {
			nombre_usuario: {
				required: true,
				minlength: 5
			},
			correo_empresa: {
				required: true,
				email: true
			}
		},
		messages: {
			nombre_usuario: {
				required: "Escriba el nombre del usuario",
				minlength: "Escriba el nombre completo del usuario"
			},
			correo_empresa: {
				required: "Ingrese un correo electr&oacute;nico v&aacute;lido",
				email: "Escriba una direcci&oacute;n de Correo electr&oacute;nico correcta."
			}
		}
	});
	
	$("#frm_cpass").validate({
		rules: {
			password_actual: {
				required: true,
				minlength: 5
			},
			password_nuevo: {
				required: true,
				minlength: 5
			},
			password_nuevo_confirma: {
				required: true,
				minlength: 5,
				equalTo: "#password_nuevo"
			}
		},
		messages: {
			password_actual: {
				required: "Ingrese la direcci&oacute;n web correcta de su p&aacute;gina web",
				url: "Ingrese una URL v&aacute;lida"
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
	
	$("#frm_edita_permisos").validate({
		rules: {
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
			input_secciones: {
				required: "Seleccione una opci&oacute;n para configurar los permisos"
			},
			input_contenidos: {
				required: "Seleccione una opci&oacute;n para configurar los permisos"
			},
			input_estadisticas: {
				required: "Seleccione una opci&oacute;n para configurar los permisos"
			},
			input_centro_negocios: {
				required: "Seleccione una opci&oacute;n para configurar los permisos"
			},
			input_configuracion: {
				required: "Seleccione una opci&oacute;n para configurar los permisos"
			}
		}
	});
});