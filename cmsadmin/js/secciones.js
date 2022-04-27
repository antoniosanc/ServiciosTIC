document.write('<script src="./libs/editable_select/editable_select.js"></script>');

$().ready(function() {
	
	$('#categoriasuperior').editableSelect({ filter: true })
		.on('select.editable-select', function (e, li) {
			$('#categoriasuperiorseccion').val(li.attr('value'));
	});
	
	$('[data-toggle="tooltip"]').tooltip()
	
	$("#frmsecciones").validate({
		rules: {
			categoriasuperiorseccion: { required: true },
			nombre_seccion: {
				required: true,
				minlength: 3
			}
		},
		messages: {
			categoriasuperiorseccion: {
				required: "Seleccione una categor&iacute;a superior"
			},
			nombre_seccion: {
				required: "Ingrese un nombre de secci&oacute;n",
				minlength: "La nueva secci&oacute;n debe contener al menos tres caracteres"
			}
		}
	});
	
	
	$('.delsec').click( function(){
		if (confirm("¿Estas seguro que deseas eliminar la sección?") == true) 
		{
			var url = $(this).attr("data-url");
			$(location).attr('href',url);
		} 
		else 
		{
			return false;
		}
	});
	
	$( "#muestra_opc" ).click(function() {
		$( ".elementos_secciones" ).toggle( "slow", function() {
		});
	});
	
});