<?php
$current_page = 'index';
$page_title = 'Home - Cookbook - Get cooking today';
require_once 'templates/header.php';
// search logic
require_once 'includes/search.inc.php';
?>

<!-- static image background -->
<div id="home">
	<div class="landing-text text-center text-white">
		<h1 class="text-uppercase">CookBook</h1>
		<hr class="hr-landing">
		<h3>Cook Simple & Affordable Recipes Today</h3>
		<a href="#recipe" class="btn btn-outline-light btn-lg custom-btn">View Recipe</a>
	</div>
</div>

<!-- Two column Section -->
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
<!-- end of Two column Section -->
<!-- Search Recipe Section-->
<section id="recipe">
	<?php $current_page = 'recipe'; ?>
	<div class="container">
		<div class="row">
			<div class="col-md-10 pb-3">
				<h1 class="text-primary p-2">Recipe Search</h1>
				<hr class="custom-line">
				<!-- Search filter -->
				<form action="" method="get" autocomplete="off">
					<!-- Search by Author-->
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="author_id">Author</label>
							<select id="author_id" name="author_id" class="custom-select">
								<option value="">Any Author</option>
								<?php foreach ($recipe->getAuthor() as $row) : ?>
									<option value="<?= $row['author_id'] ?>" <?php if ($row['author_id'] === $selected_author) echo 'selected'; ?>><?= $row['author_name'] ?></option>
								<?php endforeach; ?>
							</select>
						</div>

						<!-- Search by Category -->
						<div class="form-group col-md-6">
							<label for="category_id">Any Category</label>
							<select id="category_id" name="category_id" class="custom-select">
								<option value="">Any Category</option>
								<?php foreach ($recipe->getCategory() as $row) : ?>
									<option value="<?= $row['category_id'] ?>" <?php if ($row['category_id'] === $selected_category) echo 'selected'; ?>><?= $row['category_name'] ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div> <!-- .from row-->
					<!-- Search by text -->
					<div class="form-inline">
						<label for="search" class="font-weight-bold lead text-dark p-3">Search Recipes</label>
						<div class="input-group">
							<input type="search" class="form-control" placeholder="Search recipe" id="search" name="s" value="<?= htmlspecialchars($_GET['s'] ?? null)  ?>" autofocus>
							<div class="input-group-append">
								<!--Search button-->
								<button type="submit" class="btn btn-secondary" name="search"><i class="fa fa-search"></i></button>
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


<!-- recipe lists-->
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
				<?php foreach ($stmt as $row) : ?>
					<div class="col-md-4 mb-4">
						<div class="card shadow border-0 h-100">
							<div class="inner">
								<a href="recipe_details_page.php?recipe_selected_id=<?= $row['recipe_id'] ?>">
									<img class="card-img-top recipe-image" src="<?= $row['image'] ?>" alt="<?= Helper::html($row['alt']); ?>" title="All images are used for illustrative purposes. Results may vary">
								</a>
							</div>
							<div class="card-body">
								<h4 class="card-title"><?= $row['name'] ?></h4>
								<p class="card-text"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-stopwatch" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd" d="M6 .5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1H9v1.07A7.001 7.001 0 0 1 8 16 7 7 0 0 1 7 2.07V1h-.5A.5.5 0 0 1 6 .5zM8 3a6 6 0 1 0 .001 12A6 6 0 0 0 8 3zm0 2.1a.5.5 0 0 1 .5.5V9a.5.5 0 0 1-.5.5H4.5a.5.5 0 0 1 0-1h3V5.6a.5.5 0 0 1 .5-.5z" />
									</svg> <?= $row['prep_time'] ?>
									<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-people-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd" d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z" />
									</svg> <?= $row['servings'] ?>
								</p>
								<p class="card-text">By <strong><?= Helper::html($row['author_name']) ?></strong></p>
								<p class="card-text">Category <strong><?= Helper::html($row['category_name']) ?></strong></p>
								<p class="card-text"><?= $row['description'] ?></p>
								<a href="recipe_details_page.php?recipe_selected_id=<?= Helper::html($row['recipe_id']) ?>" role="button" class="btn btn-info">View</a>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
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
			<!-- Paging -->
			<?php require_once 'templates/paging.inc.php'; ?>
		</div>
	</div>
</div>
</section>

<?php require_once 'templates/footer.php'; ?>