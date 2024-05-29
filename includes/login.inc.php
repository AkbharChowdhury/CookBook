<?php
$authenticate = Login::getInstance();
if ($_POST) {

    $validation = ValidateAuthor::getInstance($_POST);
    $validation->setAdditionalChecks(false);
    $errors = $validation->validateForm();
    if (array_filter($errors)) return;
    $email = trim($_POST['email']);
    $password = md5(trim($_POST['password']) . 'ijdb');

    if (!$authenticate->databaseContainsAuthor($email, $password)) {
        unset($_POST);
        return;
    }

    $_SESSION['logged_in'] = true;
    $_SESSION['email'] = $email;
    $redirect = $_SESSION['redirect'] ?? 'admin/';
    header('location: ' . $redirect);

}
