<?php
if(!isset($_GET['editAuthor'])) header('location: manage_authors.php');
// creating a breadcrumb menu
Breadcrumb::getInstanceSubDirectory($current_page, 'manage_authors.php', null, $page_title)->createBreadCrumb();
// create class instance
$author = Author::getInstance();
$login = Login::getInstance();
if (isset($_GET['editAuthor'])) {
    Helper::validateAuthorID($login);
    $author->addData('author_id', $_GET['editAuthor']);
    foreach ($author->getAuthorID() as $row) {
        define("AUTHOR", [
            'author_id' => $row['author_id'],
            'firstname' => $row['firstname'],
            'lastname' => $row['lastname'],
            'email' => $row['email'],
        ]);
    }
}

if ($_POST) {
    $validation = ValidateAuthor::getInstance($_POST);

    $errors = $validation->validateForm();

    if (!array_filter($errors)) { //if form validation is successful - error array is empty
        // populate array with email field
        $author->resetData();

        if ($author->emailExists(trim($_POST['email']))) {
            $_SESSION['message'] = $author->getData('email') . ' email is already taken! Please use a different email';
            $_SESSION['msg_type'] = 'danger';
            return;
        } 
        // if email is unique update author details to database
        updateAuthor($author, $login);
    } // filter array 
}

// code logic to update the author
function updateAuthor($author, $login){
    $author->resetData();
    // populating author-data array
    $author->addData('firstname', $_POST['firstname'])
        ->addData('lastname', $_POST['lastname'])
        ->addData('email', $_POST['email'])
        ->addData('author_id', $login->getAuthorID());


    // if author is updated successfully redirect 
    if ($author->updateAuthor()) {
        $_SESSION['email'] = $author->getAuthorEmail($_GET['editAuthor']);
        $_SESSION['message'] = '"' . $author->getAuthorName() . '" Author Updated';
        $_SESSION['msg_type'] = 'warning';
        header('Location: manage_authors.php');
    }
}
