<?php
$current_page = 'manage_categories';
$page_title = 'Add Category';
$menu_hyperlink = 'manage_categories.php';

require_once '../../templates/header.php';
require_once '../adminIncludes/add_category.inc.php';

?>
<div class="container py-3">
    <span id="availability"></span>
    <?php require_once '../../includes/session_message.inc.php'; ?>
    <div class="row">
        <div class="col-md-12">
            <hr class="mb-4">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card card-outline-secondary">
                        <div class="card-header">
                            <h3 class="mb-0">Add Category</h3>
                        </div>
                        <div class="card-body">
                            <form action="" method="post" id="validateCategoryForm" class="needs-validation" novalidate autocomplete="off">
                                <div class="form-group">
                                    <label for="category_name">Category Name</label>
                                    <input type="text" class="form-control" autofocus name="category_name" id="category_name" maxlength="50" placeholder="Enter a category" value="<?= Helper::html($_POST['category_name'] ?? '')  ?>" required>
                                    <div class="col-md-12">
                                        <small class="form-text text-danger">
                                        <?= $errors['category_name'] ?? '' ?>
                                        </small>
                                        <!-- JS Error message-->
                                        <small id="categoryErrorMessage" class="form-text text-danger"></small>
                                    </div>
                                    <div class="invalid-feedback">Category is required</div>
                                </div>
                                <input class="btn btn-success btn-lg" type="submit" value="Add Category">
                            </form>
                        </div>
                        <!--/card-block-->
                        </div><!-- /form card login -->
                    </div>
                </div>
            </div>
            <!--/col-->
        </div>
        <!--/row-->
    </div>
    <!--/container-->

<?php require_once '../../templates/footer.php';?>

</script>