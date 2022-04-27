document.write('<script src="./libs/editable_select/editable_select.js"></script>');

$().ready(function() {
	

	$('#galeria_elije_seccion').editableSelect({ filter: false })
		.on('select.editable-select', function (e, li) {
			$('#galeria_seccion').val(li.attr('value'));
	});

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
