document.write('<script src="./libs/datepicker/js/bootstrap-datepicker.js"></script>');
$().ready(function() {
	
	$('#imagen_vigencia').datepicker({
		startDate: '+0d',
		format:'dd/mm/yyyy'
	});
	
	
	
	$("#frm_edita_imagenes").validate({
		rules: {

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
