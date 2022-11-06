<?php if (!isset($errorMsg)) exit; ?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <title>Access Denied</title>
</head>

<body>
    <?php if (isset($errorMsg)) : ?>
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">Access Denied! you do not have permission to access this page</h4>
            <p><?= $errorMsg ?></p>
            <hr>
            <p class="mb-0">Please contact your administrator for permission. Click <a onclick="window.history.back()" class="alert-link">here</a> to go back or <a onclick="window.location.href='../admin_home.php'" class="alert-link">Return to the admin homepage</a></p>
        </div>
    <?php endif; ?>
    <div class="container-fluid">
    <button onclick="window.history.back()" class="btn btn-dark">Back</button>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>