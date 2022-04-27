
$().ready(function() {
	
	$('[data-toggle="tooltip"]').tooltip();
	
	$('ul.nav li.dropdown').hover(function() {
		if (!$('.navbar-toggle').is(':visible')) {
			$(this).toggleClass('open', true);
		}
	}, function() {
		if (!$('.navbar-toggle').is(':visible')) {
			$(this).toggleClass('open', false);
		}
	});
	$('ul.nav li.dropdown a').click(function(){
		if (!$('.navbar-toggle').is(':visible') && $(this).attr('href') != '#' && $(this).attr('href') != 'https://www.solucionesim.net/blog/' && $(this).attr('href') != 'https://www.solucionesim.net/index.php?q=contacto&g=cmsadmin') {
			$(this).toggleClass('open', false);
			window.location = $(this).attr('href')
		}
	});

});
