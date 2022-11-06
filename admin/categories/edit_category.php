<?php
$current_page = 'manage_categories';
$page_title = 'Edit Category';
require_once '../../templates/header.php';
require_once '../adminIncludes/edit_category.inc.php';

?>
<div class="container py-3">
    <div class="row">
        <div class="col-md-12">
            <hr class="mb-4">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card card-outline-secondary">
                        <div class="card-header">
                            <h3 class="mb-0">Edit Category</h3>
                        </div>
                        <div class="card-body">
                            <form action="" method="post" id="validateCategoryForm" class="needs-validation" novalidate autocomplete="off">
                            <input type="hidden" name="category_id" value="<?=$category_info['category_id']?>">
                                <div class="form-group">
                                    <label for="category_name">Category Name</label>
                                    <input type="text" class="form-control"  name="category_name" id="category_name" maxlength="50" placeholder="Enter a category" value="<?=$category_info['category_name']?>" autofocus required>
                                    <div class="invalid-feedback">Category is required</div>
                                </div>
                                <input class="btn btn-dark btn-lg" type="submit" value="Update Category">
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


<?php require_once '../../templates/footer.php' ?>





