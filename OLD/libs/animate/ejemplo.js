//El ejemplo que aplique se copia en /js/usr.js

$().ready(function() {
//Cuando se necesita en un scroll
	$(window).scroll(function()
	{
		var class_effect = "image_focus"; //Cambiar por class de img que queremos con efecto
		if ($(this).scrollTop() > 50) 
			addAnimated_scroll( class_effect );
		else
			removeAnimated_scroll( class_effect );
	}); 

//Cuando se necesita en una clase particular
$(".image_focus").on({ //Cambiar por class de img que queremos con efecto
	 "mouseover" : function() {
		addAnimated( $(this) );
	  },
	  "mouseout" : function() {
		removeAnimated( $(this) );
	  }
});

//Cuando  necesitas aplicarlo en un hover X
	$('.imagen_focus').hover(function(){
		addAnimated( $(this) );
		return false;
    }, function(){
       removeAnimated( $(this) );
		return false;
	});

});