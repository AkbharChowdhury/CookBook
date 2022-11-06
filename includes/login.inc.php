<?php
declare(strict_types=1);
$authenticate = Login::getInstance();

if ($_POST) {

    $validation = ValidateAuthor::getInstance($_POST);
    $validation->setAdditionalChecks(false);
    $errors = $validation->validateForm();
    if (!array_filter($errors)) {
        $email = trim($_POST['email']);
        $password = md5(trim($_POST['password']) . 'ijdb');
        $authenticate->addData('email', $email)->addData('password', $password);

        if ($authenticate->databaseContainsAuthor()) {

            $_SESSION['logged_in'] = true;
            $_SESSION['email'] = $_POST['email'];
            // check if page was redirected to requested page otherwise redirect to default page
            $redirect = isset($_SESSION['redirect']) ? $_SESSION['redirect'] : 'admin/admin_home.php';
            header('location: ' . $redirect);
        } else {
            unset($_POST); // clear all fields

        }
    } // filter array

}
