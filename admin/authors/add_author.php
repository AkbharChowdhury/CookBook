<?php
$current_page = 'manage_authors';
$page_title = 'Add Author';
require_once '../../templates/header.php';
// code logic
require_once '../adminIncludes/add_author.inc.php';
?>
<div class="container py-3">
    <?= $message = $message ?? ''; ?>
    <div class="row">
        <div class="col-md-12">
            <hr class="mb-4">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card card-outline-secondary">
                        <div class="card-header">
                            <h3 class="mb-0">Add Author</h3>
                        </div>
                        <div class="card-body">
                            <form action="" method="post" id="addAuthorForm" class="needs-validation" novalidate>
                                <div class="form-group">
                                    <label for="firstname">Firstname</label>
                                    <input type="text" class="form-control" autofocus name="firstname" id="firstname" maxlength="50" placeholder="firstname" value="<?= Helper::html($_POST['firstname'] ?? ''); ?>" required>
                                    <div class="col-md-12">
                                        <small class="form-text text-danger">
                                        <?= $errors['firstname'] ?? '' ?>
                                        </small>
                                        <!-- JS Error message-->
                                        <small id="firstNameErrorMessage" class="form-text text-danger"></small>
                                    </div>
                                    <div class="invalid-feedback">firstname is required</div>
                                </div>

                                <div class="form-group">
                                    <label for="lastname">Lastname</label>
                                    <input type="text" class="form-control" name="lastname" id="lastname" maxlength="50" placeholder="lastname" value="<?= Helper::html($_POST['lastname'] ?? ''); ?>" required>
                                    <div class="col-md-12">
                                        <small class="form-text text-danger"> <?= $errors['lastname'] ?? '' ?> </small>
                                        <!-- JS Error message-->
                                        <small id="lastNameErrorMessage" class="form-text text-danger"></small>
                                    </div>
                                    <div class="invalid-feedback">lastname is required</div>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" maxlength="100" placeholder="email" value="<?= Helper::html($_POST['email'] ?? ''); ?>" required>
                                    <div class="col-md-12">
                                        <small class="form-text text-danger">
                                        <?= $errors['email'] ?? '' ?>
                                        </small>
                                    </div>
                                    <div class="invalid-feedback">Email is required</div>
                                </div>
                                <input class="btn btn-success btn-lg" type="submit" value="Add Author">
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
    <?php require_once '../../templates/footer.php'; ?>
    <script src="../admin-js/validate-author.js"></script>
