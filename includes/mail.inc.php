<?php
require_once 'includes/class-autoload.php';
if ($_POST) {

    $validation = ValidateContact::getInstance($_POST);
    $errors = $validation->validateForm();
    if (!array_filter($errors)) {


        $mail = Mail::getInstance()
            ->setFirstName($_POST['firstname'])->setLastName($_POST['lastname'])
            ->setSubject($_POST['subject'])->setFrom($_POST['email'])->setMessage($_POST['message']);

        if ($mail->sendEmail()) {
            $_SESSION['message'] = 'Your message has been sent!';
            $_SESSION['msg_type'] = 'success';
        } else {
            $_SESSION['message'] = 'There was an error sending your message. Please try again later';
            $_SESSION['msg_type'] = 'danger';
        }
    }
}
