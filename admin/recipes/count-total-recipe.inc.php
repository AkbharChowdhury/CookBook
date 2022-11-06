<?php
session_start();
require_once '../../includes/class-autoload.php';
require_once '../../includes/interface-autoload.php';
echo ManageRecipe::getInstance()->getAuthorTotalRecipes($_SESSION['email']).' Results found';
