document.write('<script src="./libs/datepicker/js/bootstrap-datepicker.js"></script>');
$().ready(function() {
	
	$('#imagen_vigencia').datepicker({
		startDate: '+0d',
		format:'dd/mm/yyyy'
	});
	
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
	
	$("#frm_edita_imagen").validate({
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
	
	
	$('.delimg').click( function(){
		if (confirm("¿Estas seguro que deseas eliminar la imagen?") == true) 
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
