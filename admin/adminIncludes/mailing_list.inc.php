<?php

Breadcrumb::getInstanceRootDirectory($current_page, null, true)->createBreadCrumb();

// get selected author 
$selected_author = $$_POST['author_id'] ?? '';
$author = Author::getInstance(); // used for author dynamic dropdown menu

// if the form has been submitted
if ($_POST) {

    //default properties for mail class

    $authorID = $_POST['author_id'];

    $mail = Mail::getInstance()->setSubject($_POST['subject'])->setMessage($_POST['message']);

    // mail all authors from
    if ($authorID === 'mail_all_authors') {

        if ($mail->sendMultiEmail()) {
            $_SESSION['message'] = 'Your message has been sent!';
            $_SESSION['msg_type'] = 'success';
        }

        return;
    }
    $mail->setAuthorID($authorID);
    // mail individual authors
    if ($mail->sendSingleEmail($authorID)) {

        $_SESSION['message'] = 'Your message has been sent!';
        $_SESSION['msg_type'] = 'success';
    }
}
