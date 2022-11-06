$(document).ready(function () {
    // replace existing js-disabled class
    $(".delete").prop("class", "btn btn-danger");

    if ($('#totalAuthorCount').length) getTotalRecords('count-total-author.inc.php','#totalAuthorCount');
    if ($('#totalRecipeCount').length) getTotalRecords('count-total-recipe.inc.php','#totalRecipeCount');
    if ($('#totalCategoryCount').length) getTotalRecords('count-total-category.inc.php','#totalCategoryCount');

    function getTotalRecords (url, selector) {
        $.ajax({
            url: url,
            method: "POST",
            success: function (data) {
                $(selector).text(data);

            }
        });
    }
    //confirm delete

    // code to read selected table row cell data (values).
    $("table").on('click', '#deleteAuthor', function () {
        let authorID = $(this).val();

        // get the current row
        let currentRow = $(this).closest("tr");

        let authorName = `${currentRow.find("td:eq(0)").text()} ${currentRow.find("td:eq(1)").text()}`; // get current row 1st TD value

        if (confirm(`WARNING \nAre you sure you want to delete ${authorName} and all their recipes?`)) {
            $.ajax({
                url: "delete-author.inc.php",
                method: "POST",
                data: { author_id: authorID },
                success: function (data) {
                    // getTotalAuthorCount();
                    getTotalRecords('count-total-author.inc.php','#totalAuthorCount');
                    currentRow.hide('slow');
                    $('#deleteMessage').html(`
                          <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            ${data}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            `);
                }
            });
        }

    });

    // code to delete recipe
    // code to read selected table row cell data (values).
    $("table").on('click', '#deleteRecipe', function () {

        let recipeID = $(this).val();
        // get the current row
        let currentRow = $(this).closest("tr");
        let output = `${currentRow.find("td:eq(0)").text()}`; // get current row 1st TD value

        if (confirm(`WARNING \nAre you sure you want to delete ${output}?\nDoing so will delete remove this recipe from the associated author`)) {
            $.ajax({
                url: "delete-recipe.inc.php",
                method: "POST",
                data: { recipe_id: recipeID },
                success: function (data) {
                    // getTotalRecipeCount();
                    getTotalRecords('count-total-recipe.inc.php','#totalRecipeCount');

                    currentRow.hide('slow');

                    $('#deleteMessage').html(`
                          <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            ${data}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>

                          `);
                }
            });

        }

    });


    // code to delete a category
    // code to read selected table row cell data (values).
    $("table").on('click', '#deleteCategory', function () {
        let categoryID = $(this).val();

        // get the current row
        let currentRow = $(this).closest("tr");

        let output = `${currentRow.find("td:eq(0)").text()}`; // get current row 1st TD value


        if (confirm(`WARNING \nAre you sure you want to delete ${output} and all its associated recipes?`)) {
            $.ajax({
                url: "delete-category-inc.php",
                method: "POST",
                data: { category_id: categoryID },
                success: function (data) {
                    // getTotalCategoryCount();
                    getTotalRecords('count-total-category.inc.php','#totalCategoryCount');

                    // hide selected row
                    currentRow.hide('slow');
                    $('#deleteMessage').html(`
                          <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            ${data}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>

                          `);
                }
            });

        }

    });

});
