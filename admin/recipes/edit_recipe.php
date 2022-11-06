<?php
$current_page = 'manage_recipe';
$page_title = 'Edit Recipe';
require_once '../../templates/header.php';
// code logic
require_once '../adminIncludes/edit_recipe.inc.php';
require_once '../adminIncludes/delete.php';
//echo RECIPE_INFO['cook_time']
?>
<section class="container py-3">
	<?php require_once '../../includes/session_message.inc.php' ?>
	<?php if (isset($_SESSION['message'])) Helper::removeSessionMsg(); ?>

	<div class="card">
		<div class="card-header">
			<h3 class="mb-0">Edit Recipe</h3>
		</div>
		<!-- Recipe image section -->
		<?php if (!is_null(RECIPE_INFO['image'])) : ?>
			<section class=" pt-2" id="recipe-image">
				<div class="row">
					<div class="col-md-4">
						<div class="content">
							<div class="content-overlay"></div>
							<img class="img-fluid content-image  edit-recipe-img img-thumbnail" src="<?= $row['image'] ?>" alt="<?= RECIPE_INFO['alt'] ?>">
							<div class="content-details fadeIn-bottom">
								<h3 class="content-title"><?= RECIPE_INFO['name'] ?></h3>
								<p class="content-text"><i class="fas fa-utensils"></i> <?= RECIPE_INFO['category_name'] ?></p>
							</div>
						</div>
						<!--.content (Image) -->
					</div>
					<!--.col-md-4-->
				</div>
				<!--image row-->
			</section>
		<?php else : ?>
			<p class="lead mt-2 p-3">No recipe image</p>
		<?php endif; ?>
		<div class="card-body">
			<form action="" method="post" class="needs-validation" novalidate autocomplete="off">
				<input type="hidden" name="recipe_id" value="<?= RECIPE_INFO['recipe_id'] ?>">
				<h1 class="text-primary p-2">Recipe Details</h1>
				<hr class="custom-line">
				<div class="form-group">
					<label for="recipe_name">Recipe Name</label>
					<input type="text" class="form-control" name="recipe_name" id="recipe_name" maxlength="100" placeholder="Enter a recipe" value="<?= Helper::html($_POST['recipe_name'] ?? RECIPE_INFO['name']); ?>" required autofocus>
					<div class="invalid-feedback">Recipe is required</div>
					<!-- JS Error message-->
					<small id="recipeErrorMessage" class="form-text text-danger"></small>
					<div class="col-md-12">
						<small class="form-text text-danger">
							<?= $errors['recipe_name'] ?? null; ?>
						</small>
					</div>
					<div class="form-group">
						<label for="description">Description</label>
						<textarea class="form-control" id="description" name="description" rows="3" required placeholder="enter description" maxlength="200"><?= Helper::html($_POST['description'] ?? RECIPE_INFO['description']); ?></textarea>
						<div class="invalid-feedback">Description is required</div>
						<small id="descriptionErrorMessage" class="form-text text-danger"></small>
						<div class="col-md-12">
							<small class="form-text text-danger">
								<?= $errors['description'] ?? null; ?>
							</small>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="prep_time">Prep time (mins)</label>
							<input type="number" class="form-control" name="prep_time" id="prep_time" maxlength="2" placeholder="Enter a prep time" value="<?= Helper::html($_POST['prep_time'] ?? RECIPE_INFO['prep_time']);  ?>" required>
							<div class="invalid-feedback">Prep time is required</div>
							<small id="prepTimeErrorMessage" class="form-text text-danger"></small>
							<div class="col-md-12">
								<small class="form-text text-danger">
									<?= $errors['prep_time'] ?? null; ?>
								</small>
							</div>
						</div>
						<div class="form-group col-md-4">
							<label for="cook_time">Cook time (mins)</label>
							<input type="text" class="form-control" name="cook_time" id="cook_time" maxlength="2" placeholder="Enter a cook_time" value="<?= Helper::html($_POST['cook_time'] ?? RECIPE_INFO['cook_time']); ?>" required>
							<small id="cookTimeErrorMessage" class="form-text text-danger"></small>
							<small class="form-text text-danger">
								<?= $errors['cook_time'] ?? null; ?>
							</small>

							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="no_cook" value="<?= Helper::noCookingMsg() ?>">
								<label class="custom-control-label" for="no_cook">No cook</label>
							</div>
							<div class="invalid-feedback">cook_time is required</div>
						</div>
						<div class="form-group col-md-2">
							<div class="form-group">
								<label for="servings">Servings</label>
								<input type="text" class="form-control" name="servings" id="servings" maxlength="50" placeholder="Enter servings" value="<?= Helper::html($_POST['servings'] ?? RECIPE_INFO['servings']); ?>" required>
								<div class="col-md-12">
									<small class="form-text text-danger">
										<?= $errors['servings'] ?? '' ?>
									</small>
									<!-- JS Error message-->
									<small id="recipeErrorMessage" class="form-text text-danger"></small>
								</div>
								<div class="invalid-feedback">servings is required</div>
							</div>
						</div>
						<div class="form-group col-md-6">
							<label for="image">Image</label>
							<input type="url" class="form-control" name="image" id="image" placeholder="Enter image url" value="<?= $_POST['image'] ?? RECIPE_INFO['image']; ?>" required>
							<div class="col-md-12">
								<small class="form-text text-danger">
									<?= $errors['image'] ?? null ?>
								</small>
								<!-- JS Error message-->
								<small id="imageErrorMessage" class="form-text text-danger"></small>
							</div>
							<div class="invalid-feedback">Image is required</div>
						</div>
						<div class="form-group col-md-6">
							<label for="image">Alt</label>
							<input type="text" class="form-control" name="alt" id="alt" placeholder="Enter image alt" value="<?= $_POST['alt'] ?? RECIPE_INFO['alt']; ?>" required>
							<div class="col-md-12">
								<small class="form-text text-danger">
									<?= $errors['alt'] ?? null ?>
								</small>
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
								<?php foreach ($recipe->getIngredients() as $ingredient_row) : ?>
									<div class="form-inline">
										<div class="input-group">
											<table>
												<tr id="delete-ingredient-id<?= $ingredient_row['ingredient_id'] ?>">
													<td>
														<input type="text" class="form-control" name="ingredient_list[]" placeholder="enter an ingredient name" value="<?= Helper::html($_POST['ingredient_list'] ?? $ingredient_row['ingredient']); ?>" required>
													</td>
													<!-- Delete ingredient button -->
													<div class="input-group-append">
														<td><button type="button" class="btn btn-danger ingredientID" value="<?= $ingredient_row['ingredient_id'] ?>">Delete</button></td>
													</div>
												</tr>
											</table>
										</div>
									</div>
									<div class="col-md-12">
										<small class="form-text text-danger">
											<?= $errors['ingredient_list'] ?? '' ?>
										</small>
									</div>
									<div class="invalid-feedback">Ingredient is required</div>
								<?php endforeach; ?>
							</div>
						</div>
						<!-- append ingredient list end -->
						<div class="form-group col-md-6">
							<a href="edit_ingredient.php?editRecipe=<?= $row['recipe_id'] ?>" role="button" class="btn btn-info">Add Ingredients</a>
						</div>
						<!-- append preparation list-->
						<div class="col-md-6" id="prep-method-items">
							<h2 class="text-dark">Preparation Method</h2>
							<div class="form-group">
								<?php foreach ($recipe->getPrepMethod() as $prep_row) : ?>
									<table>
										<tr id="delete-prep-id<?= $prep_row['prep_id'] ?>">
											<td style="width:100%"><textarea style="width:100%; height:100%;" class="form-control" id="prep_method_list" required name="prep_method_list[]" rows="4" cols="5" required placeholder="enter prep method" maxlength="200"><?= Helper::html($_POST['prep_method_list'] ?? $prep_row['method']); ?></textarea></td>
											<!-- delete prep method-->
											<td><button type="button" class="btn btn-danger prepID" value="<?= $prep_row['prep_id'] ?>">Delete</button></td>
										</tr>
									</table>
									<div class="col-md-12">
										<small class="form-text text-danger">
											<?= $errors['prep_method_list'] ?? '' ?>
										</small>
									</div>
									<div class="invalid-feedback">Prep method is required</div>
								<?php endforeach; ?>
							</div>
						</div>
						<!-- append preparation list end -->
						<div class="form-group col-md-6">
							<a href="edit_prep.php?editRecipe=<?= $row['recipe_id'] ?>" role="button" class="btn btn-dark mt-3">Add Prep method</a>
						</div>
					</div>
					<h1 class="text-primary p-2">Categories</h1>
					<hr class="custom-line">

					<div class="form-group col-md-6">
						<h4>Categories</h4>
						<hr>
						<section class="categories">
							<?php foreach ($categories as $category) : ?>
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input categories" name="categories[]" id="<?= Helper::html($category['category_name']); ?>" value="<?= Helper::html($category['category_id']); ?>" <?php if ($category['selected']) echo ' checked'; ?>>
									<label class="custom-control-label" for="<?= Helper::html($category['category_name']); ?>"><?= Helper::html($category['category_name']); ?></label>
								</div>
								<div class="my-2"></div>
							<?php endforeach; ?>
							<!-- JS Error message-->
							<small id="categoryError" class="form-text text-danger"></small>
						</section>
						<hr>
					</div>
					<input class="btn btn-success btn-lg mt-3" type="submit" value="Update Recipe">
			</form>
		</div>
	</div>
	</div>
	<!--card-->
</section>
<!--/section-->
<?php require_once '../../templates/footer.php'; ?>
<!-- CKEditor js -->
<script src="../admin-js/ckEditorFormat.js"></script>
<script src="delete-prep-ingredient-script.js"></script>
<script src="../admin-js/validate-cook-time.js"></script>
<!-- validate Recipe -->
<script src="../admin-js/validate-recipe.js"></script>