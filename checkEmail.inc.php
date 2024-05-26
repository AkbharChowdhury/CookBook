<?php
require_once 'includes/class-autoload.php';
$author = Author::getInstance();
if(isset($_POST['email'])){
    $author = Author::getInstance();
    echo $author->emailExists($_POST['email']);
}
