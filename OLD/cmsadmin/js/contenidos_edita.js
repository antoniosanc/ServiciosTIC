document.write('<script src="./libs/jquploader/jquery.uploadfile.js"></script>');
document.write('<script src="./libs/jquploader/uploader.js"></script>');

$().ready(function() {
	
	$("#formeditacont").validate({
		rules: {
			contenido_titulo: {
				required: true,
				minlength: 5
			},
			contenido_descripcion: {
				required: true,
				minlength: 20,
				maxlength: 200
			},
			contenido_keywords: {
				required: true,
				minlength: 2,
				maxlength: 300
			}
		},
		messages: {
			contenido_titulo: {
				required: "Por favor escribe un título para la secci&oacute;n",
				minlength: "El Titulo es muy peque&ntilde;o intenta hacerlo m&aacute;s descriptivo"
			},
			contenido_descripcion: {
				required: "Ingrese una descripci&oacute;n",
				minlength: "La descripci&oacute;n debe tener m&aacute;s de 10 caracteres",
				maxlength: "La descripci&oacute;n debe tener  menos 150 caracteres"
			},
			contenido_keywords: {
				required: "Ingresa las palabras clave de tu secci&oacute;n",
				minlength: "Escribe al menos tres palabras clave",
				maxlength: "Ingresa como m&aacute;ximo cinco palabras clave separadas por coma"
			}
		}
	});

});
