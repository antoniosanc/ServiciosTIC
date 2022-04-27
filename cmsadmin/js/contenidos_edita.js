document.write('<script src="./libs/jquploader/jquery.uploadfile.js"></script>');
document.write('<script src="./libs/jquploader/uploader.js"></script>');


$().ready(function() {
	/*$('#summernote').summernote({
		height: 700,
		minHeight: null,
		maxHeight: null,
		focus: true,
		lang: 'es-ES',
		callbacks: {
			onImageUpload: function(image) {
				uploadImage(image[0]);
			}
		}
	});

	
	function uploadImage(image) {
		var data = new FormData();
		data.append("image", image);
		$.ajax({
			url: './libs/editor/upload.php',
			cache: false,
			contentType: false,
			processData: false,
			data: data,
			type: "post",
			success: function(url_imagen) {
				var image = $('<img>').attr('src',  url_imagen);
				$('#summernote').summernote("insertNode", image[0]);
			},
			error: function(data) {
				console.log(data);
			}
		});
	}*/
	
	
	$("#formeditacont").validate({
		rules: {
			contenido_titulo: {
				required: true,
				minlength: 5
			},
			contenido_descripcion: {
				required: true,
				minlength: 50,
				maxlength: 255
			},
			contenido_keywords: {
				required: true,
				minlength: 5,
				maxlength: 450
			}
		},
		messages: {
			contenido_titulo: {
				required: "Por favor escribe un título para la secci&oacute;n",
				minlength: "El Titulo es muy peque&ntilde;o intenta hacerlo m&aacute;s descriptivo"
			},
			contenido_descripcion: {
				required: "Ingrese una descripci&oacute;n",
				minlength: "La descripci&oacute;n debe tener m&aacute;s de 50 caracteres",
				maxlength: "La descripci&oacute;n debe tener  menos 250 caracteres"
			},
			contenido_keywords: {
				required: "Ingresa las palabras clave de tu secci&oacute;n",
				minlength: "Escribe al menos tres palabras clave",
				maxlength: "Ingresa como m&aacute;ximo cinco palabras clave separadas por coma"
			}
		}
	});
	
	$('.delimgd').click( function(){
		if (confirm("¿Estas seguro que deseas eliminar la imagen destacada?") == true) 
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
