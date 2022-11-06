$(document).ready(function () {
	// get the ingredient class button clicked
	$('.ingredientID').click(function () {
		let ingredientID = $(this).prop("value");

		$.ajax({
			type: "post",
			url: "delete.inc.php",
			data: { ingredient_id: ingredientID },
			success: function () {
				$('#delete-ingredient-id' + ingredientID).hide('slow');

			}
		});

	});

	// delete prep
	$('.prepID').click(function () {
		let prepID = $(this).prop("value");

		$.ajax({
			type: "post",
			url: "delete.inc.php",
			data: { prep_id: prepID },
			success: function () {
				$('#delete-prep-id' + prepID).hide('slow');

			}
		});

	});
});
