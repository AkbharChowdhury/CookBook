<?php
$current_page = 'manage_authors';
$page_title = 'Edit Author';
require_once '../../templates/header.php';
require_once '../adminIncludes/update_password.inc.php';


?>
<div class="container py-3">
    <div class="row">
        <div class="col-md-12">
            <hr class="mb-4">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card card-outline-secondary">
                        <div class="card-header">
                            <h3 class="mb-0">Edit Author password</h3>
                        </div>
                        <div class="card-body">
                            <form action="" method="post" class="needs-validation" novalidate autocomplete="off">
                                <input type="hidden" name="author_id" value="<?= AUTHOR_INFO['author_id'] ?>">

                                <div class="form-group">
                                    <label for="password">Set Password</label>
                                    <input type="password" class="form-control" name="password" id="password" maxlength="100" placeholder="Enter a password" value="<?= htmlspecialchars($_POST['password'] ?? ''); ?>" required>
                                    <div class="invalid-feedback">Password is required</div>
                                    <div class="col-md-12">
                                        <small class="form-text text-danger">
                                            <?= $errors['password'] ?? '' ?>
                                        </small>
                                    </div>
                                    <!-- JS Error message-->
                                    <small id="passwordErrorMessage" class="form-text text-danger"></small>

                                    <div class="invalid-feedback">password is required</div>
                                    <div id="my-password-criteria mt-2">
                                        <ul class="fa-ul">
                                            <li><span class="fa-li"><i id="number"></i></span>contains 1 number</li>
                                            <li><span class="fa-li"><i id="uppercase"></i></span>contains 1 upper case char</li>
                                            <li><span class="fa-li"><i id="lowercase"></i></span>contains 1 lower case char</li>
                                            <li><span class="fa-li"><i id="specialChar"></i></span>contains 1 special char</li>
                                            <li><span class="fa-li"><i id="minLength"></i></span>is at least 8 chars long</li>
                                        </ul>
                                    </div>
                                    <div class="progress mt-2">
                                        <div class="progress-bar"></div>
                                    </div>
                                </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="chkPassword">
                                    <label class="form-check-label" for="chkPassword">Show Password</label>
                                </div>
                                <input class="btn btn-dark btn-lg" type="submit" value="Update Password">
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
<script src="../../js/validate-forgot-password-form.js"></script>
