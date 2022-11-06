<?php
$current_page = 'manage_recipe';
$page_title = 'Edit Ingredients';
require_once '../../templates/header.php';
// code logic
require_once '../adminIncludes/edit_ingredient.inc.php';

?>

<section class="container py-3">
	<?php require_once '../../includes/session_message.inc.php' ?>
	<div class="card">
		<div class="card-header">
			<h3 class="mb-0">Edit Recipe ingredient</h3>
		</div>
		<div class="card-body">
			<h1 class="text-primary"><?=RECIPE_INFO['name']?></h1>
			<hr class="custom-line">
			<h2>Current ingredient list</h2>
			<hr>
			<?php if($recipe->getIngredients()): ?>
				<ul>
				<?php foreach($recipe->getIngredients() as $row):?>
					<?php if(!empty(Helper::html($row['title']))):?>

                        <p class="lead font-weight-bold"><?=Helper::html($row['title'])?></p>
                        <hr class="custom-line">
                            <?php endif; ?>
					
					<li><p><?= Helper::html($row['ingredient'])?></p></li>
				<?php endforeach; ?>
				</ul>
			<?php else: ?>
				<p class="text-muted">No Ingredients found</p>
			<?php endif;?>
			<form action="" method="post" id="validaterecipeForm" class="needs-validation" novalidate autocomplete="off">
				<h1 class="text-primary p-2">Recipe Details</h1>
				<hr class="custom-line">
				<div class="form-row">
					<!-- append ingredient list-->
					<div class="col-md-6" id="ingredient-items">
						<h2 class="text-dark">Ingredients</h2>
						<div class="form-group">
							<input type="text" class="form-control ingredients" name="ingredient_list[]" placeholder="enter an ingredient name" value="<?= $_POST['ingredient_list'] ?? '' ?>" required autofocus>
							<div class="invalid-feedback">Ingredient is required</div>
						</div>
					</div>
					
					<!-- append ingredient list end -->
					
					<div class="form-group col-md-6">
						<input class="btn btn-info mt-3" type="button" value="Add Ingredients" id="add_ingredient">
					</div>
				</div>
				
				<input class="btn btn-success btn-lg mt-3" type="submit" value="Submit ingredient">
			</form>
		</div>
	</div>
</section>
<!--/section-->
<?php require_once '../../templates/footer.php';?>
<!-- form validation -->
<script src="../admin-js/validate-recipe.js"></script>
<!-- dynamic input field -->
<script src="../admin-js/ingredient-prep-dynamic-input-field.js"></script>

