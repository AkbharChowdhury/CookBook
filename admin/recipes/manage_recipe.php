<?php
$root = true; // used for the admin  root pages 
$current_page = 'manage_recipe';
$page_title = 'Manage Recipes';
require_once '../../templates/header.php';
require '../../includes/js-disabled.inc.php';
require_once '../adminIncludes/manage_recipe.inc.php';

?>
<div class="container">
  <div id="deleteMessage"></div>
<?php require_once '../../includes/session_message.inc.php';?>
<?php if(isset($_SESSION['message'])) Helper::removeSessionMsg();?>
  <section class="pt-3 pb-3">
      <h1 class="text-primary p-2">Manage Recipe</h1>
      <hr class="custom-line">
      <div class="col-sm-6">
        <span class="float-left"><a href="add_recipe.php" class="btn btn-primary">Add Recipe</a></span>
      </div>
      </div>
      
      <div class="container mt-5">
        <noscript>
        <p class="text-muted mt-2"><?= $recipe->getAuthorTotalRecipes($_SESSION['email']); ?> Results found</p>
        </noscript> <!-- JS disabled -->

        <p class="text-muted mt-2" id="totalRecipeCount"></p>
        <div class="table-responsive">
          <table class="table table-striped table-bordered">
            <caption>List of Recipes</caption>
            <thead>
              <tr>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Servings</th>
                <th scope="col">image</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <?php if ($recipe_exists) : ?>
                  <?php foreach ($recipe_exists as $row) : ?>
                    <td><?= Helper::html($row['name']) ?></td>
                    <td><?= $row['description'] ?></td>
                    <td><?= Helper::html($row['servings']) ?></td>
                    <?php if(empty(Helper::html($row['image']))):?>
                      <td><p class="text-muted">No recipe image</p></td>
                    <?php else: ?>
                      <td><img src="<?=$row['image']?>" alt="<?=Helper::html($row['alt'])?>" class="img-fluid"></td>
                    <?php endif; ?>
                    <td>
                    <a href="edit_recipe.php?editRecipe=<?=Helper::html($row['recipe_id']) ?>" role="button" class="btn btn-info mb-4">Edit</a>
                    <button  class="btn btn-danger delete"  id="deleteRecipe" value="<?= Helper::html($row['recipe_id']) ?>">Delete</button>
                    <noscript><a href="<?=$current_file?>?delete=<?= Helper::html($row['recipe_id']) ?>" role="button" class="btn btn-danger delete">Delete</a></noscript>
                    </td>
              </tr>
            <?php endforeach; ?>
          <?php else : ?>
            <td colspan="6"> No recipes found</td>
          <?php endif; ?>
            </tbody>
          </table>
        </div> <!-- /table-responsive-->
     
  </section>
  </div>

<?php require_once '../../templates/footer.php';?>
<!-- confirm delete using javascript confirm popup -->
<script src="../admin-js/confirm-delete.js"></script>

