<?php
$current_page = 'manage_authors';
$page_title = 'Edit Author';
require_once '../../templates/header.php';
require_once '../adminIncludes/edit_author.inc.php';


?>
<div class="container py-3">
  <?php require_once '../../includes/session_message.inc.php'; ?>

    <div class="row">
        <div class="col-md-12">
            <hr class="mb-4">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card card-outline-secondary">
                        <div class="card-header">
                            <h3 class="mb-0">Edit Author</h3>
                        </div>
                        <div class="card-body">
                            <form action="" method="post" id="validateForm" class="needs-validation" novalidate autocomplete="off">
                                <input type="hidden" name="author_id" value="<?= AUTHOR['author_id'] ?>">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="firstname">firstname</label>
                                        <input type="text" class="form-control" autofocus name="firstname" id="firstname" maxlength="50" placeholder="Enter a firstname" value="<?= htmlspecialchars($_POST['firstname'] ?? AUTHOR['firstname']) ?>" required>
                                        <div class="col-md-12">
                                            <small class="form-text text-danger">
                                                <?= $errors['firstname'] ?? '' ?>
                                            </small>
                                            <!-- JS Error message-->
                                            <small id="firstNameErrorMessage" class="form-text text-danger"></small>
                                        </div>
                                        <div class="invalid-feedback">firstname is required</div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="lastname">Lastname</label>
                                        <input type="text" class="form-control" name="lastname" id="lastname" maxlength="50" placeholder="Enter a lastname" value="<?= htmlspecialchars($_POST['lastname'] ?? AUTHOR['lastname']) ?>" required>
                                        <div class="col-md-12">
                                            <small class="form-text text-danger"> <?= $errors['lastname'] ?? '' ?> </small>
                                            <!-- JS Error message-->
                                            <small id="lastNameErrorMessage" class="form-text text-danger"></small>
                                        </div>
                                        <div class="invalid-feedback">lastname is required</div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email">email</label>
                                    <input type="email" class="form-control" name="email" id="email" maxlength="100" placeholder="Enter a email" value="<?= htmlspecialchars($_POST['email'] ?? AUTHOR['email']) ?>" required>
                                    <div class="col-md-12">
                                        <small class="form-text text-danger">
                                            <?= $errors['email'] ?? '' ?>
                                        </small>
                                    </div>
                                    <div class="invalid-feedback">email is required</div>
                                </div>

                                <input class="btn btn-dark btn-lg" type="submit" value="Update Author">

                            </form>
                        </div>
                        <div class="card-footer">
                            <p class="text-muted">Need to update your password? <a class="custom-link" title="Register" href="update_password.php?editAuthor=<?= Helper::html($row['author_id']) ?>"><i>Update Password</i></a></p>
                        </div>
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