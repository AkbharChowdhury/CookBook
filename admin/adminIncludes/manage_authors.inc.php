<?php

// used for breadcrumb navigation

Breadcrumb::getInstanceRootDirectory($current_page, null, true)->createBreadCrumb();

$current_file = htmlspecialchars($_SERVER['PHP_SELF']);

$author = Author::getInstance();
define("AUTHOR",$author->showAuthor());
//print_r(AUTHORvar_dump($author_exists));

// if the delete button is clicked
if (isset($_GET['deleteAuthorID'])) {

    $author->addData('author_id', $_GET['deleteAuthorID']);
    //if author is deleted successfully show message
    if ($author->deleteAuthor()) {

        $_SESSION['message'] = 'Author Deleted';
        $_SESSION['msg_type'] = 'danger';
        header('location: manage_authors.php');
    }
}