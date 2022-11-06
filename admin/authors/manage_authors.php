<?php
$root = true; // used for the admin  root pages 
$current_page = 'manage_authors';
$page_title = 'Manage Authors';
require_once '../../templates/header.php';
require '../../includes/js-disabled.inc.php';
// code logic
require_once '../adminIncludes/manage_authors.inc.php';
?>

<div class="container">
  <div id="deleteMessage"></div>
  <?php require_once '../../includes/session_message.inc.php'; ?>
  <?php if (isset($_SESSION['message'])) Helper::removeSessionMsg(); ?>
  <section class="pt-3 pb-3">
    <h1 class="text-primary p-2">Manage Author</h1>
    <hr class="custom-line">
    <!-- <div class="col-sm-6">
      <span class="float-left"><a href="add_author.php" class="btn btn-primary">Add Author</a></span>
    </div> -->
    <!-- </div>

<div class="container mt-5"> -->
    <noscript>
      <p class="text-muted mt-2"><?= $author->getTotalAuthors(); ?> Results found</p>
    </noscript> <!-- JS disabled -->
    <p class="text-muted mt-2" id="totalAuthorCount"></p>
    <div class="table-responsive">
      <table class="table table-striped table-bordered">
        <caption>List of Authors</caption>
        <thead>
          <tr>
            <th scope="col">FirstName</th>
            <th scope="col">LastName</th>
            <th scope="col">Email</th>
            <th scope="col">Total Recipes</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <?php if ($author_exists) : ?>
              <?php foreach ($author_exists as $row) : ?>

                <td><?= Helper::html($row['firstname']) ?></td>
                <td><?= Helper::html($row['lastname']) ?></td>
                <td><?= Helper::html($row['email']) ?></td>
                <td><?= Helper::html($row['total_recipe']) ?></td>
                <?php if ($row['email'] === $_SESSION['email']) : ?>
                  <td>
                    <a href="edit_author.php?editAuthor=<?= Helper::html($row['author_id']) ?>" role="button" class="btn btn-info m-3">Edit</a>
                    <!--<button-- class="btn btn-danger delete" id="deleteAuthor" value="<?php // Helper::html($row['author_id']) 
                                                                                          ?>">Delete</button-->
                    <!-- <noscript><a href="<?//$current_file?>?deleteAuthorID=<?php //Helper::html($row['author_id']) ?>" role="button" class="btn btn-danger">Delete</a></noscript>-->
                  </td>
                <?php endif; ?>
          </tr>
        <?php endforeach; ?>
      <?php else : ?>
        <td colspan="5"> no Authors found</td>
      <?php endif; ?>
        </tbody>
      </table>
    </div> <!-- /table-responsive-->
  </section>
</div>

<?php require_once '../../templates/footer.php'; ?>
<!-- confirm delete using javascript confirm popup -->
<script src="../admin-js/confirm-delete.js"></script>