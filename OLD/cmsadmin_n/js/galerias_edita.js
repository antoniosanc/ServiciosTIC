
$().ready(function() {
	
	$('#dataTables-example').dataTable();
	
	$('.delgal').click( function(){
		if (confirm("¿Estas seguro que deseas eliminar la galería?") == true) 
		{
			var url = $(this).attr("data-url");
			$(location).attr('href',url);
		} 
		else 
		{
			return false;
		}
	});
	
	$("#frm_nueva_imagen").validate({
		rules: {
			imagen_subir: 
			{
				required: true
			},
			imagen_titulo: 
			{
				required: true,
				minlength: 5
			},
			imagen_descripcion: 
			{
				required: false,
				minlength: 10
			},
			imagen_url: 
			{
				required: false
			}
		}
	});
	
});
