<?php

// class autoload path
require_once '../../includes/class-autoload.php';
$author = Author::getInstance();

if (isset($_POST['author_id'])) {
    $authorID = Helper::html($_POST['author_id']);
    $author->addData('author_id',$authorID);
    if($author->deleteAuthor()){
        echo 'Author deleted';
    }
}
