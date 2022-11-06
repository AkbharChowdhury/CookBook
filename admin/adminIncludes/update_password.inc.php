<?php

$user = Author::getInstance();
Breadcrumb::getInstanceSubDirectory($current_page, 'manage_authors.php', null, 'Reset Password')->createBreadCrumb();
$login = Login::getInstance();

if (isset($_GET['editAuthor'])) {
    
    if ($_GET['editAuthor'] !== $login->getAuthorID()) { // check if author id is the same as session
        // prevent the user from editing other authors except their own
        $_GET['editAuthor'] = $login->getAuthorID();
    }

    if ($_POST) {

        $validation = ValidateAuthor::getInstance($_POST);
        $errors = $validation->validateForm();
        if (!array_filter($errors)) {

            $user->addData('password', $_POST['password'] . 'ijdb')->addData('email', $_SESSION['email']);

            if ($user->updatePassword()) {

                $_SESSION['message'] = 'Password updated';
                $_SESSION['message'] = 'Your password has been updated';
                $_SESSION['msg_type'] = 'warning';
                unset($_POST);
                header('Location: manage_authors.php');
                return;
            } 
            echo 'error creating user account';
        } // filter array
    } // post button
    return;
}
header('location: manage_authors.php');
