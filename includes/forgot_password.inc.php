<?php
$breadcrumb = Breadcrumb::getInstanceSubDirectory($current_page, 'login.php', null, 'Forgot password')
->setHomeLink(false); // index.php
$user = Author::getInstance();
if ($_POST) {

    $validation = ValidateAuthor::getInstance($_POST);
    $errors = $validation->validateForm();
    if (!array_filter($errors)) {

        $user->addData('email', $_POST['email']);
        if (!$user->checkEmailExists()) {            
            $_SESSION['message'] = 'This email is not registered in our system';
            $_SESSION['msg_type'] = 'danger';
        } else {

            $user->resetData();
            // populate array
            $user->addData('password', $_POST['password'].'ijdb')->addData('email', $_POST['email']);

            if ($user->updatePassword()) {
            
                $_SESSION['message'] = 'Password updated';
                $_SESSION['message'] = 'Your password is updated, you can now <a href="login.php" class="alert-link">Login</a> or <a href="." class="alert-link">Return to the homepage</a>';
                $_SESSION['msg_type'] = 'warning';
                unset($_POST);

            } else {
                echo 'error creating user account';
            }
        }
    } // filter array
}// post button