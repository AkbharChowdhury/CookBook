<?php


try {
    $registerUser = Author::getInstance();

    if ($_POST) {
        $user = new User($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['password']);

        $validation = ValidateAuthor::getInstance($_POST);
        $errors = $validation->validateForm();
        if (array_filter($errors)) return;
            if ($registerUser->emailExists($user->email)) { // check for existing email

                $_SESSION['message'] = $user->email . ' email is already taken! Please use a different email';
                $_SESSION['msg_type'] = 'danger';
                return;

            } else {

                $registerUser->resetData();
                $registerUser->addData('firstname', $user->firstname)
                    ->addData('lastname', $user->lastname)
                    ->addData('email', $user->email)
                    ->addData('password', $user->password . 'ijdb');

                // welcome email message
                $mail = Mail::getInstance()->createEmailTemplate($user);
//                    ->setFirstName($author->firstname)
//                    ->setLastName($author->lastname)
//                    ->setSubject('Cookbook Welcome email')
//                    ->setFrom($_POST['email'])
//                    ->setMessage('Welcome ' . $author->firstname . ' ' . $author->lastname . "\n\n" . 'you can now manage your account including modifying your own recipes');

                if (!$mail->sendWelcomeMail()) echo 'error sending welcome email';

                // insert author and assign author role
                if ($registerUser->addAuthor() && $registerUser->addAuthorRole()) {

                    $_SESSION['message'] = 'Thank you for registering, you can now <a href="login.php" class="alert-link">Login</a> or <a href="." class="alert-link">Return to the homepage</a>';
                    $_SESSION['msg_type'] = 'success';
                    unset($_POST);
                    return;
                }
                echo 'error creating user account';
            }
    }
} catch (Exception $e) {
    echo 'error: ' . $e->getMessage();
}
