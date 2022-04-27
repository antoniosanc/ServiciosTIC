/*Animaciones de entrada con waypoint*/

$('.hm_bienvenido').waypoint(function(direction) {
    if (direction == 'down') {
      $('.acercade1').addClass('opacity1');
      $('.bg_ventajas').addClass('apareceizq0');
      $('.ventajas1').addClass('apareceizq1');
      $('.ventajas2').addClass('apareceizq2');
      $('.ventajas3').addClass('apareceizq3');
    }
    else {
      $('.acercade1').removeClass('opacity1');
      $('.bg_ventajas').removeClass('apareceizq0');
      $('.ventajas1').removeClass('apareceizq1');
      $('.ventajas2').removeClass('apareceizq2');
      $('.ventajas3').removeClass('apareceizq3');	  
    }
  }, { 
    offset: '85%' 
  });