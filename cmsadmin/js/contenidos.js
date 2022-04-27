
$().ready(function() {
	
	$('#dataTables-example').dataTable({
		"order" : [[0, 'desc']]
	} );
	
	$("#frm_buscar").validate({
		rules: {
			contenido_buscar: {
				required: true,
				minlength: 3
			} 
		},
		messages: {
			contenido_buscar: {
				required: "Por favor escribe el nombre de la secci&oacute;n para buscar",
				minlength: "Ingrese al menos tres d&iacute;gitos"
			}
		}
	});

});
