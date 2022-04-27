
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
});
