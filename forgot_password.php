<?php
//https://bbbootstrap.com/snippets/forgot-your-password-form-all-details-42875894
$current_page = 'login';
$page_title = 'Reset password';
require_once 'templates/header.php';
require_once 'includes/forgot_password.inc.php';
?>
<div class="container padding-bottom-3x mb-2 mt-5">
    <?php require_once 'includes/session_message.inc.php' ?>

    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <?php $breadcrumb->createBreadCrumb();  // dynamic breadcrumb ?>
            <div class="forgot">
                <h2>Forgot your password?</h2>
                <hr class="custom-line">
                <p>Change your password in three easy steps. This will help you to secure your password!</p>
                <ol class="list-unstyled">
                    <li><span class="text-primary text-medium">1. </span>Enter your email address below.</li>
                    <li><span class="text-primary text-medium">2. </span>Enter the new password</li>
                    <li><span class="text-primary text-medium">3. </span>Your password will be reset. You can use this to sign in</li>
                </ol>
            </div>
            <form action="" method="post" id="forgotPasswordForm" class="needs-validation" novalidate autocomplete="off">
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="email">Enter your email address</label>
                            <input type="email" class="form-control" name="email" id="email" maxlength="100" placeholder="email" value="<?= Helper::html($_POST['email'] ?? ''); ?>" required autofocus>
                            <div class="invalid-feedback">Email is required</div>

                            <small class="form-text text-muted">Enter the email address you used during the registration on Cookbook.com. Then we'll email a link to this address.</small>
                            <small class="form-text text-danger"><?= $errors['email'] ?? ''; ?></small>
                        </div>

                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="password" class="form-control" name="password" id="password" maxlength="30" placeholder="Password" value="<?= Helper::html($_POST['password'] ?? ''); ?>" required>
                             <div class="invalid-feedback">Password is required</div>
                            <small class="form-text text-muted">Password must be at least 8 characters long</small>
                            <!-- JS Error message-->
                            <small id="passwordErrorMessage" class="form-text text-danger"></small>
                            <small class="form-text text-danger"><?= $errors['password'] ?? ''; ?></small>
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
                    </div>

                    <div class="card-footer">
                        <input type="submit" value="Reset Password" class="btn btn-success">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once 'templates/footer.php'; ?>
<script src="js/validate-forgot-password-form.js"></script>
