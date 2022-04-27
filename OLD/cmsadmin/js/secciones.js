$().ready(function() {
	$("#frmsecciones").validate({
		rules: {
			categoriasuperiorseccion: { required: true },
			nombre_seccion: {
				required: true,
				minlength: 3
			},
			descripcion_seccion: {
				required: true,
				minlength: 10,
				maxlength: 150
			}
		},
		messages: {
			categoriasuperiorseccion: {
				required: "Seleccione una categor&iacute;a superior"
			},
			nombre_seccion: {
				required: "Ingrese un nombre de secci&oacute;n",
				minlength: "La nueva secci&oacute;n debe contener al menos tres caracteres"
			},
			descripcion_seccion: {
				required: "Ingrese una descripci&oacute;n",
				minlength: "La descripci&oacute;n debe tener m&aacute;s de 10 caracteres",
				maxlength: "La descripci&oacute;n debe tener  menos 150 caracteres"
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
	
});