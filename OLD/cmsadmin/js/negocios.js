document.write('<script src="./libs/bootstrap/js/bootstrap-modal.js"></script>');

$('#dataTables-example').dataTable();

$().ready(function() {
	
	$("#frm_contacto").validate({
		rules: {
			correo_empresa: {
				required: true,
				email: true
			},
			asunto_correo: {
				required: true,
				minlength: 10
			}
		},
		messages: {
			asunto_correo: {
				required: "Escriba un asunto para su correo electr&oacute;nico",
				minlength: "El asunto debe ser m&aacute;s descriptivo"
			},
			correo_empresa: {
				required: "Ingrese un correo electr&oacute;nico v&aacute;lido",
				email: "Escriba una direcci&oacute;n de Correo electr&oacute;nico correcta."
			}
		}
	});
	

});