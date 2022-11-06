<?php
// default password passwordijdb
// query is UPDATE `Author` SET `password` = MD5('passwordijdb') 
// enter 'password' in field
$current_page = 'login';
$page_title = 'login';
require_once 'templates/header.php';
require_once 'includes/login.inc.php';
?>

<div class="container py-5">
    <?php require_once 'includes/session_message.inc.php';?>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-6 mx-auto">

                    <!-- form card login -->
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h3 class="mb-0">Login</h3>
                        </div>
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="email">email</label>
                                    <input type="email" class="form-control rounded-0" name="email" id="email" maxlength="50" value="<?= Helper::html($_POST['email'] ?? null); ?>" placeholder="email" required>
                                    <div class="invalid-feedback">email is required</div>
                                    <small class="form-text text-danger"><?= $errors['email'] ?? null ?></small>

                                </div>
                                <div class="form-group">
                                    <label for="password">password</label>
                                    <input type="password" class="form-control rounded-0" name="password" maxlength="20" value="<?= Helper::html($_POST['password'] ?? null); ?>" id="password" placeholder="password" required>
                                    <div class="invalid-feedback">password is required</div>
                                    <small class="form-text text-danger"><?= $errors['password'] ?? null ?></small>
                                </div>
                                <div class="mb-2">
                                    <a href="forgot_password.php" id="forgot-link">Forgot Password?</a>
                                </div>
                                <input type="submit" class="btn btn-primary" value="Login">
                                <?php if ($authenticate->getErrorMessage()) : ?>
                                    <p class="text-danger mt-3"><?= $authenticate->getErrorMessage(); ?></p>
                                <?php endif; ?>

                            </form>
                        </div>

                        <div class="card-footer">
                            <p class="text-muted">Don't have an account? <a class="custom-link" title="Register" href="register.php"><i>Register</i></a></p>
                        </div>
                    </div>
                    <!-- /form card login -->
                </div>
            </div>
            <!--/row-->
        </div>
        <!--/col-->
    </div>
    <!--/row-->
</div>
<!--/container-->
</div>
<?php require_once 'templates/footer.php';?>
