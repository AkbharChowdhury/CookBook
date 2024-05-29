<?php
$current_page = 'index';
$page_title = 'Home - Cookbook - Get cooking today';
require_once 'templates/header.php';
require_once 'includes/search.inc.php';
?>

<div id="home">
	<div class="landing-text text-center text-white">
		<h1 class="text-uppercase">CookBook</h1>
		<hr class="hr-landing">
		<h3>Cook Simple & Affordable Recipes Today</h3>
		<a href="#recipe" class="btn btn-outline-light btn-lg custom-btn">View Recipe</a>
	</div>
</div>

<section class="pb-3" id="breakfast">
	<div class="bg-dark">
		<div class="container">
			<div class="row py-4 bg-dark text-white">
				<div class="col-lg-4 mb-4 my-lg-auto">
					<h1 class="font-weight-bold mb-3">Breakfast Recipe</h1>
					<p class="mb-4 lead">Simple, delicious breakfast recipe. From as little as <strong><?= $recipe->getMinCategory('Breakfast') ?> minutes</strong></p>
					<a href="#recipe" role="button" class="btn btn-outline-light btn-lg custom-btn">View Recipe</a>
				</div>
				<div class="col-lg-6">
					<img src="https://images.unsplash.com/photo-1555243896-c709bfa0b564?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80" alt="Breakfast image caption" class="img-fluid">
				</div>
			</div>
		</div>
	</div>
</section>

<section id="recipe">
	<?php $current_page = 'recipe'; ?>
	<div class="container">
		<div class="row">
			<div class="col-md-10 pb-3">
				<h1 class="text-primary p-2">Recipe Search</h1>
				<hr class="custom-line">
				<!-- Search filter -->
				<form action="" autocomplete="off">
					<!-- Search by Author-->
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="author_id">Author</label>
							<select id="author_id" name="author_id" class="custom-select">
								<option value="">Any Author</option>
								<?php foreach ($recipe->getAuthor() as $row) : ?>
									<option value="<?= $row['author_id'] ?>" <?php if ($row['author_id'] == $selected_author) echo 'selected'; ?>><?= $row['author_name'] ?></option>
								<?php endforeach; ?>
							</select>
						</div>

						<!-- Search by Category -->
						<div class="form-group col-md-6">
							<label for="category_id">Any Category</label>
							<select id="category_id" name="category_id" class="custom-select">
								<option value="">Any Category</option>
								<?php foreach ($recipe->getCategory() as $row) : ?>
									<option value="<?= $row['category_id'] ?>" <?php if ($row['category_id'] == $selected_category) echo 'selected'; ?>><?= $row['category_name'] ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div> <!-- .from row-->
					<!-- Search by text -->
					<div class="form-inline">
						<label for="search" class="font-weight-bold lead text-dark p-3">Search Recipes</label>
						<div class="input-group">
							<input type="search" class="form-control" placeholder="Search recipe" id="search" name="s" value="<?= Helper::html($_GET['s'] ?? '')  ?>" autofocus>
							<div class="input-group-append">
								<!--Search button-->
								<button type="submit" class="btn btn-secondary" name="search"><i class="fa fa-search"></i> </button>
							</div>
						</div>
					</div>
				</form>
				<?php if (!empty($search_term) && $total_rows > 0) : ?>
					<!--If search term is not empty -->
					<p class="text-muted">Showing search results for "<?= $search_term ?>"</p>
				<?php endif; ?>
				<?php if ($total_rows > 0) : ?>
					<!--Display total search results -->
					<p class="text-muted">Total results: <?= $total_rows ?></p>
				<?php endif; ?>
			</div> <!-- .col-md-10 pb-3-->
		</div> <!-- .row -->
	</div> <!-- .container-->
</section>


<section class="bg-light" id="results">
	<div class="container pt-3">
		<h1 class="text-primary p-2">Recipe lists</h1>
		<hr class="custom-line">
		<?php if ($total_rows > 0) : ?>
			<p class="lead text-muted mb-5">Here is a selection of recipes</p>
		<?php endif; ?>
		<div class="row">
			<!-- display the recipes if there are any-->
			<?php if ($total_rows > 0) : ?>
            <?php require_once  'includes/recipe.inc.php';?>

		</div> <!-- container-->
	<?php else : ?>
		<div class="container-fluid">
			<div class="alert alert-danger">No Recipes found.</div>
			<?php if ($recipe->relatedRecipeResults()) : ?>
				<!-- relatedResults id is populated via Javascript in script.js file-->
				<p id="relatedResults" class="lead"></p>
				<?php foreach ($recipe->relatedRecipeResults() as $row) : ?>
					<a href="recipe_details_page.php?recipe_selected_id=<?= Helper::html($row['recipe_id']) ?>"><?= Helper::html($row['name']) ?></a><br>
				<?php endforeach; ?>
			<?php endif ?>
		</div>
	<?php endif; ?>
	<div class="col-lg-12">
		<div class="row justify-content-center">
			<?php require_once 'templates/paging.inc.php'; ?>
		</div>
	</div>
</div>
</section>

<?php require_once 'templates/footer.php'; ?>