<?php
$root = true; // used for the admin  root pages 
$current_page = 'manage_categories';
$page_title = 'Manage Categories';
require_once '../../templates/header.php';
require '../../includes/js-disabled.inc.php';
//code logic
require_once '../adminIncludes/manage_categories.inc.php';

?>
<div class="container">
  <div id="deleteMessage"></div>
<?php require_once '../../includes/session_message.inc.php';?>
<?php if(isset($_SESSION['message'])) Helper::removeSessionMsg();?>
  <section class="pt-3 pb-3">
      <h1 class="text-primary p-2">Manage Category</h1>
      <hr class="custom-line">
      <div class="col-sm-6">
        <span class="float-left"><a href="add_category.php" class="btn btn-primary">Add Category</a></span>
      </div>
      </div>
      
      <div class="container mt-5">
        <noscript>
        <p class="text-muted mt-2"><?= $category->getTotalCategory(); ?> Results found</p>
        </noscript> <!-- JS disabled -->
        <p class="text-muted mt-2" id="totalCategoryCount"></p>
        <div class="table-responsive">
          <table class="table table-striped table-bordered">
            <caption>List of Categories</caption>
            <thead>
              <tr>
                <th scope="col">Name</th>
                <th scope="col">Total Recipe</th>
                <th scope="col">Actions</th>
                
              </tr>
            </thead>
            <tbody>
              <tr>
                <?php if ($category_exists) : ?>
                  <?php foreach ($category_exists as $row) : ?>
                    <td><?= Helper::html($row['category_name']) ?></td>
                    <td><?= Helper::html($row['total_recipe']) ?></td>
                    <td>
                    <a href="edit_category.php?editCategory=<?=Helper::html($row['category_id']) ?>" role="button" class="btn btn-info m-3">Edit</a>
                    <button class="btn btn-danger delete" id="deleteCategory" value="<?= Helper::html($row['category_id']) ?>">Delete</button>
                    <noscript><a href="<?=$current_file?>?delete=<?= Helper::html($row['category_id']) ?>" role="button" class="btn btn-danger">Delete</a></noscript>
                    </td>
              </tr>
            <?php endforeach; ?>
          <?php else : ?>
            <td colspan="5"> No categories found</td>
          <?php endif; ?>
            </tbody>
          </table>
        </div> <!-- /table-responsive-->
     
  </section>


      </div>

<?php require_once '../../templates/footer.php';?>
<!-- confirm delete using javascript confirm popup -->
<script src="../admin-js/confirm-delete.js"></script>

