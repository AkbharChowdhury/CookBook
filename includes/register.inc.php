<?php

try {
    $registerUser = Author::getInstance();

    // if the form was submitted
    if ($_POST) {

        $validation = ValidateAuthor::getInstance($_POST);
        $errors = $validation->validateForm();
        if (!array_filter($errors)) {
            // if there are no errors in form then redirect and insert values

            // populate array with email field
            $registerUser->addData('email', $_POST['email']);
            if ($registerUser->checkEmailExists()) { // check for existing email

                $_SESSION['message'] = $registerUser->getAuthorData('email') . ' email is already taken! Please use a different email';
                $_SESSION['msg_type'] = 'danger';
            } else {

                $registerUser->resetData();
                // populate array
                $registerUser->addData('firstname', $_POST['firstname'])
                    ->addData('lastname', $_POST['lastname'])
                    ->addData('email', $_POST['email'])
                    ->addData('password', $_POST['password'] . 'ijdb');

                // welcome email message
                $mail = Mail::getInstance()
                    ->setFirstName($_POST['firstname'])
                    ->setLastName($_POST['lastname'])
                    ->setSubject('Cookbook Welcome email')
                    ->setFrom($_POST['email'])
                    ->setMessage('welcome ' . $_POST['firstname'] . ' ' . $_POST['lastname'] . "\n\n" . 'you can now manage your account including modifying your own recipes');

                if (!$mail->sendWelcomeMail()) {
                    echo 'error sending welcome email';
                }
                // insert author and assign author role
                if ($registerUser->addAuthor() && $registerUser->addAuthorRole()) {

                    $_SESSION['message'] = 'Thank you for registering, you can now <a href="login.php" class="alert-link">Login</a> or <a href="." class="alert-link">Return to the homepage</a>';
                    $_SESSION['msg_type'] = 'success';
                    unset($_POST);
                } else {
                    echo 'error creating user account';
                }
            }
        } // filter array
    }
} catch (Exception $e) {
    echo 'error: ' . $e->getMessage();
}
