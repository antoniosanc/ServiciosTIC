document.write('<script src="./libs/bootstrap/js/bootstrap-modal.js"></script>');

$().ready(function() {
	$('#dataTables-example').dataTable({
		"order" : [[0, 'desc']]
	} );
});

