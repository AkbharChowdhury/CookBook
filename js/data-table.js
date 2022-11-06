$(document).ready(function () {

	$('table').DataTable({
		//https://datatables.net/forums/discussion/38761/dom-positioning-in-bootstrap
		//"dom" : "<'row'<'col-sm-4'i><'col-sm-4'f><'col-sm-4 searchStyle'p>>" + "<'row'<'col-sm-12'tr>>",
		"orderCellsTop": true,
		"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
		responsive: true,
		language: {
			searchPlaceholder: "Search...",

		}
	}
	);
});
