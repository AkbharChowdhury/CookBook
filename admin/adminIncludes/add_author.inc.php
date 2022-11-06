<?php

Breadcrumb::getInstanceSubDirectory($current_page, 'manage_authors.php', null, $page_title)->createBreadCrumb();

$author = Author::getInstance();
$selected_author = $_GET['author_id'] ?? '';
// if the form was submitted 
if ($_POST) {

    $validation = ValidateAuthor::getInstance($_POST);
    $errors = $validation->validateForm();

    if (!array_filter($errors)) {

        // if there are no errors in form then redirect and insert values
        $author->addData('firstname', $_POST['firstname'])
        ->addData('lastname', $_POST['lastname'])
        ->addData('email', $_POST['email']);

        if ($author->addAuthor()) {
            $_SESSION['message'] = 'Author Added';
            $_SESSION['msg_type'] = 'success';
            header('location: ../authors/manage_authors.php');
        }
    } // filter array
} // End of post button