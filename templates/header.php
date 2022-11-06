<?php 
declare(strict_types=1);
define('PAGES', array('index', 'about', 'contact', 'recipe','login', 'register','profile'));
define('HEADER_PATH', dirname(__FILE__, 2) . DIRECTORY_SEPARATOR . 'includes/header.inc.php');
require_once HEADER_PATH;
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
		<!--font awesome -->
		<script src="https://kit.fontawesome.com/af0beca0d3.js"></script>
		<!-- Custom CSS -->
		<link rel="stylesheet" href="<?=in_array($current_page, PAGES) ? 'css/style.css' : FILE_PATH['css']?>">

    <title><?=$page_title?></title>
  </head>
  <body data-spy="scroll" data-offset="15" data-target="#navbarSupportedContent">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm ">
    <a class="navbar-brand" href="<?=in_array($current_page, PAGES) ? 'index.php' : FILE_PATH['home']?>"><i class="fas fa-book-reader"></i> CookBook
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <?php if(in_array($current_page, PAGES)): // public pages ?>
          <li class="nav-item <?=Helper::activeLink('index');?>">
          <a class="nav-link" href="index.php">Home <?=Helper::srOnly('index');?></a>
        </li>
        <li class="nav-item <?=Helper::activeLink('about');?>">
          <a class="nav-link" href="about.php">About <?=Helper::srOnly('about');?></a>
        </li>
        <li class="nav-item <?=Helper::activeLink('recipe');?>">
          <a class="nav-link" href="index.php?recipe">Recipe <?=Helper::srOnly('recipe');?></a>
        </li>
        <li class="nav-item <?=Helper::activeLink('contact');?>">
          <a class="nav-link" href="contact.php">Contact <?=Helper::srOnly('contact');?></a>
        </li>
        <?php endif;?>

        <?php if(in_array($current_page, ADMIN_PAGES)): // Admin pages ?>
            <li class="nav-item <?=Helper::activeLink('admin_home');?>">
              <a class="nav-link" href="<?= FILE_PATH['home'] ?>">Home <?=Helper::srOnly('admin_home');?></a>
            </li>
            <li class="nav-item <?=Helper::activeLink('manage_authors');?>">
              <a class="nav-link" href="<?= FILE_PATH['author'] ?>">Authors <?=Helper::srOnly('manage_authors');?></a>
            </li>
            <li class="nav-item <?=Helper::activeLink('manage_categories');?>">
              <a class="nav-link" href="<?= FILE_PATH['category'] ?>">Categories <?=Helper::srOnly('manage_categories');?></a>
            </li>
            <li class="nav-item <?=Helper::activeLink('manage_recipe');?>">
              <a class="nav-link" href="<?= FILE_PATH['recipe'] ?>">Recipes <?=Helper::srOnly('manage_recipe');?></a>
            </li>
            <li class="nav-item <?=Helper::activeLink('mailing_lists');?>">
              <a class="nav-link" href="<?= FILE_PATH['mail'] ?>">Mailing <?=Helper::srOnly('mailing_lists');?></a>
            </li>
        <?php endif;?>
      </ul>

      <ul class="navbar-nav ml-auto">
      <?php if(!isset($_SESSION['logged_in'])): // nav-links for when user is not logged in ?>
          <li class="nav-item <?=Helper::activeLink('login');?>">
          <a class="nav-link" href="login.php">Login <?=Helper::srOnly('login');?></a>
        </li>
        <li class="nav-item <?=Helper::activeLink('register');?>">
          <a class="nav-link" href="register.php">Register <?=Helper::srOnly('register');?></a>
        </li>
    </ul>  

      <?php else: ?>

        <span class="navbar-text">
        <?=$_SESSION['email']?>
        </span>
        <li class="nav-item">
          <a class="nav-link" href="<?=in_array($current_page, PAGES) ? 'logout.inc.php' : FILE_PATH['logout']?>">Logout</a>
        </li>



        <?php endif;?>
    </div>
  </nav>







