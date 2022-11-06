<?php
$current_page = 'manage_recipe';
$page_title = 'Add Recipe';
require_once '../../templates/header.php';
// code logic
require_once '../adminIncludes/add_recipe.inc.php';

?>

<section class="container py-3">
	<?php require_once '../../includes/session_message.inc.php' ?>
	<div class="card">
		<div class="card-header">
			<h3 class="mb-0">Add Recipe</h3>
		</div>
		<div class="card-body">
			<form action="" method="post" class="needs-validation" novalidate autocomplete="off">
				<h1 class="text-primary p-2">Recipe Details</h1>
				<hr class="custom-line">
				<div class="form-group">
					<label for="recipe_name">Recipe Name</label>
					<input type="text" class="form-control" name="recipe_name" id="recipe_name" maxlength="100" value="<?= $_POST['recipe_name'] ?? null; ?>" placeholder="Enter a recipe" required>
					<div class="col-md-12">
						<small class="form-text text-danger">
							<?= $errors['recipe_name'] ?? null; ?>
						</small>
						<!-- JS Error message-->
						<small id="recipeErrorMessage" class="form-text text-danger"></small>
					</div>
					<div class="invalid-feedback">Recipe is required</div>
				</div>
				<div class="form-group">
					<label for="description">Description</label>
					<textarea class="form-control" id="description" name="description" rows="3" required placeholder="enter description" maxlength="200"><?= $_POST['description'] ?? null; ?></textarea>
					<div class="col-md-12">
						<small class="form-text text-danger">
							<?= $errors['description'] ?? null ?>
						</small>
						<!-- JS Error message-->
						<small id="descriptionErrorMessage" class="form-text text-danger"></small>
					</div>
					<div class="invalid-feedback">Description is required</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="prep_time">Prep time (mins)</label>
						<input type="number" class="form-control" name="prep_time" id="prep_time" maxlength="2" placeholder="Enter a prep time" value="<?= $_POST['prep_time'] ?? null; ?>" required>
						<div class="col-md-12">
							<small class="form-text text-danger">
								<?= $errors['prep_time'] ?? null ?>
							</small>
							<!-- JS Error message-->
							<small id="prepTimeErrorMessage" class="form-text text-danger"></small>
						</div>
						<div class="invalid-feedback">Prep time is required</div>
					</div>
					<div class="form-group col-md-4">
						<label for="cook_time">Cook time (mins)</label>
						<input type="number" class="form-control" name="cook_time" maxlength="2" id="cook_time" placeholder="Enter a cook_time" value="<?= $_POST['cook_time'] ?? null; ?>" required>
						<div class="custom-control custom-checkbox">
							<input type="checkbox" class="custom-control-input" id="no_cook" value="<?= Helper::noCookingMsg() ?>">
							<label class="custom-control-label" for="no_cook">No cook</label>
						</div>
						<div class="col-md-12">
							<small class="form-text text-danger"><?= $errors['cook_time'] ?? null ?></small>
							<!-- JS Error message-->
							<small id="cookTimeErrorMessage" class="form-text text-danger"></small>
						</div>
						<div class="invalid-feedback">cook_time is required</div>
					</div>
					<div class="form-group col-md-2">
						<div class="form-group">
							<label for="servings">Servings</label>
							<input type="text" class="form-control" name="servings" id="servings" maxlength="50" placeholder="Enter servings" value="<?= $_POST['servings'] ?? null; ?>" required>
							<div class="col-md-12">
								<small class="form-text text-danger"><?= $errors['servings'] ?? null ?></small>
								<!-- JS Error message-->
								<small id="recipeErrorMessage" class="form-text text-danger"></small>
							</div>
							<div class="invalid-feedback">servings is required</div>
						</div>
					</div>

					<div class="form-group col-md-6">
						<label for="image">Image</label>
						<input type="url" class="form-control" name="image" id="image" placeholder="Enter image url" value="<?= $_POST['image'] ?? null; ?>" required>
						<div class="col-md-12">
							<small class="form-text text-danger"><?= $errors['image'] ?? null ?></small>
							<!-- JS Error message-->
							<small id="imageErrorMessage" class="form-text text-danger"></small>
						</div>
						<div class="invalid-feedback">Image is required</div>
					</div>

					<div class="form-group col-md-6">
						<label for="alt">Alt</label>
						<input type="text" class="form-control" name="alt" id="alt" maxlength="100" placeholder="Enter a alternate text" value="<?= $_POST['alt'] ?? null; ?>" required>
						<div class="col-md-12">
							<small class="form-text text-danger"><?= $errors['alt'] ?? null ?></small>
						</div>
						<div class="invalid-feedback">Alt is required</div>
					</div>
				</div>
				<div class="form-row">
					<h1 class="text-primary p-2">Recipe ingredients and preparation method</h1>
					<hr class="custom-line">
					<!-- append ingredient list-->
					<div class="col-md-6" id="ingredient-items">
						<h2 class="text-dark">Ingredients</h2>
						<div class="form-group">
							<input type="text" class="form-control ingredients" name="ingredient_list[]" placeholder="enter an ingredient name" required>
							<div class="invalid-feedback">Ingredient is required</div>
						</div>
					</div>
					<!-- append ingredient list end -->
					<div class="form-group col-md-6">
						<input class="btn btn-info mt-3" type="button" value="Add Ingredients" id="add_ingredient">
					</div>
					<!-- append preparation list-->
					<div class="col-md-6" id="prep-method-items">
						<h2 class="text-dark">Preparation Method</h2>
						<div class="form-group">
							<textarea class="form-control prep" id="prep_method_list" required name="prep_method_list[]" rows="3" required placeholder="enter prep method"></textarea>
							<div class="invalid-feedback">Prep method is required</div>
						</div>
					</div>
					<!-- append preparation list end -->
					<div class="form-group col-md-6">
						<input class="btn btn-dark mt-3" type="button" value="Add Prep method" id="add_prep_method">
					</div>
				</div>
				<h1 class="text-primary p-2">Categories</h1>
				<hr class="custom-line">

				<div class="form-group col-md-6">
					<h4>Categories</h4>
					<hr>
					<section class="categories">
						<?php foreach ($recipe->getCategory() as $row) : ?>
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input categories" name="categories[]" id="<?= Helper::html($row['category_name']) ?>" value="<?= Helper::html($row['category_id']); ?>" <?php if (isset($selected_categories)) if (in_array($row['category_id'], $selected_categories)) echo ' checked'; ?>>
								<label class="custom-control-label" for="<?= Helper::html($row['category_name']); ?>"><?= Helper::html($row['category_name']); ?></label>
							</div>
							<div class="my-2"></div>
						<?php endforeach; ?>
						<!-- JS Error message-->
						<small id="categoryError" class="form-text text-danger"></small>
						<small class="form-text text-danger"><?= $errors['categories'] ?? null; ?></small>
						<small class="form-text text-danger"><?= $categoryError ?? null; ?></small>
					</section>
					<hr>
				</div>
				<input class="btn btn-success btn-lg mt-3" type="submit" value="Add Recipe">
			</form>
		</div>
	</div>
</section>
<!--/section-->

<?php require_once '../../templates/footer.php'; ?>
<!-- CKEditor js -->
<script src="../admin-js/ckEditorFormat.js"></script>
<script src="../admin-js/ingredient-prep-dynamic-input-field.js"></script>
<script src="../admin-js/validate-cook-time.js"></script>
<!-- validate Recipe-->
<script src="../admin-js/validate-recipe.js"></script>
