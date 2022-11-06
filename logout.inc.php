<?php

session_start();
session_destroy();
$_SESSION['message'] = 'you have been logged out';
$_SESSION['msg_type'] = 'success';
header("location: login.php");
