<?php
require_once 'includes/class-autoload.php';
$author = Author::getInstance();
if(isset($_POST['email'])){
    $author = Author::getInstance();
    $author->addData('email', $_POST['email']);
    echo $author->checkEmailExists();
}
