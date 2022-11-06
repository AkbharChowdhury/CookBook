<?php

$current_page = 'register';
$page_title = 'Create account';
require_once 'templates/header.php';
//code logic
require_once 'includes/class-autoload.php';
require_once 'includes/register.inc.php';

?>

<div class="container py-3">
    <?= $message = $message ?? ''; ?>
    <?php require_once 'includes/session_message.inc.php'; ?>
    <div class="row">
        <div class="col-md-12">
            <hr class="mb-4">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card card-outline-secondary">
                        <div class="card-header">
                            <h3 class="mb-0">Create Account</h3>
                        </div>
                        <div class="card-body">
                            <form action="" method="post" id="registerForm" class="needs-validation" novalidate autocomplete="off">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="firstname">Firstname</label>
                                        <input type="text" class="form-control" name="firstname" id="firstname" maxlength="50" placeholder="firstname" value="<?= Helper::html($_POST['firstname'] ?? ''); ?>" required>
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
                                        <input type="text" class="form-control" name="lastname" id="lastname" maxlength="50" placeholder="lastname" value="<?= Helper::html($_POST['lastname'] ?? ''); ?>" required>
                                        <div class="col-md-12">
                                            <small class="form-text text-danger"> <?= $errors['lastname'] ?? '' ?> </small>
                                            <!-- JS Error message-->
                                            <small id="lastNameErrorMessage" class="form-text text-danger"></small>
                                        </div>
                                        <div class="invalid-feedback">lastname is required</div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" maxlength="100" placeholder="email" value="<?= Helper::html($_POST['email'] ?? ''); ?>" required>
                                    <div class="col-md-12">
                                        <small class="form-text text-danger"><?= $errors['email'] ?? '' ?></small>
                                    </div>
                                    <div class="invalid-feedback">Email is required</div>
                                    <!-- JS Error message-->
                                    <small id="emailErrorMessage" class="form-text text-danger"></small>
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" maxlength="100" placeholder="password" value="<?= Helper::html($_POST['password'] ?? ''); ?>" required>
                                    <small id="passwordHelpBlock" class="form-text text-muted">
                                        Your password must be at least 8 characters long, contain 1 upper case letter, a number, and a special character.
                                    </small>
                                    <!-- JS Error message-->
                                    <small id="passwordErrorMessage" class="form-text text-danger"></small>
                                    <div id="password-criteria">
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

                                    <div class="col-md-12">
                                        <small class="form-text text-danger"><?= $errors['password'] ?? '' ?></small>
                                    </div>
                                    <div class="invalid-feedback">Password is required</div>
                                </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="chkPassword">
                                    <label class="form-check-label" for="chkPassword">Show Password</label>
                                </div>
                                <div class="form-group">
                                    <label for="verification_code">Verification code</label>
                                    <input type="text" maxlength="5" class="form-control" name="verification_code" id="verification_code" maxlength="10" placeholder="verification code" value="<?= Helper::html($_POST['verification_code'] ?? ''); ?>" required>
                                    <div class="col-md-12">
                                        <small class="form-text text-danger"><?= $errors['verification_code'] ?? '' ?></small>
                                        <!-- JS Error message-->
                                        <small id="verificationCodeErrorMessage" class="form-text text-danger"></small>
                                    </div>
                                    <div class="invalid-feedback">verification code is required</div>
                                </div>
                                <div class="form-group">
                                    <img src="includes/captcha.inc.php" alt="caption" id="img-captcha">
                                    <p class="text-muted">Can't read captcha <button type="button" class="btn btn-link" id="refresh">Refresh</button></p>
                                </div>
                                <input class="btn btn-dark btn-lg" id="register" type="submit" value="Create Account">
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
<?php require_once 'templates/footer.php'; ?>

<script src="js/validate-register.js"></script>
<script src="js/check-duplicate-email.js"></script>
