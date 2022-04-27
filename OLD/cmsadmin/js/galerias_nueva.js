
$().ready(function() {
	
	$("#frm_nueva_galeria").validate({
		rules: {
			galeria_titulo: 
			{
				required: true,
				minlength: 5
			},
			galeria_keywords: 
			{
				required: true,
				minlength: 8
			},
			galeria_seccion: 
			{
				required: true
			}
		}
	});
	
});
