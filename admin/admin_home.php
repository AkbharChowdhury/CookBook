<?php
$current_page = 'admin_home';
$page_title = 'Dashboard - Admin Panel';
require_once '../classes/helper.class.php';
// set default directory
Helper::setDirectory(true); 
require_once '../templates/header.php';
?>

<div class="container">
	<section id="services" class="container padding">
		<h2 class="display-4 text-center mt-5 mb-3">Dashboard</h2>
		<hr class="custom-line">

		<div class="row text-center">
			<div class="col-md-4 mb-4">
				<div class="card h-100">
					<div class="card-body">
						<h5 class="card-title">Manage Authors</h5>
						<h6 class="card-subtitle mb-2 text-muted">Create, edit, and delete authors</h6>
						<a href="<?= FILE_PATH['author']?>" class="card-link">View</a>
					</div>
				</div>
			</div>

			<div class="col-md-4 mb-4">
				<div class="card h-100">
					<div class="card-body">
						<h5 class="card-title">Manage Categories</h5>
						<h6 class="card-subtitle mb-2 text-muted">Create, edit, and delete categories</h6>
						<a href="<?=FILE_PATH['category']?>" class="card-link">View</a>
					</div>
				</div>
			</div>

			<div class="col-md-4 mb-4">
				<div class="card h-100">
					<div class="card-body">
						<h5 class="card-title">Manage recipes</h5>
						<h6 class="card-subtitle mb-2 text-muted">Create, edit, and delete recipes</h6>
						<a href="<?=FILE_PATH['recipe']?>" class="card-link">View</a>
					</div>
				</div>
			</div>

			<div class="col-md-4 mb-4">
				<div class="card h-100">
					<div class="card-body">
						<h5 class="card-title">Mailing list and actions</h5>
						<h6 class="card-subtitle mb-2 text-muted">Mail individual or multiple authors for updates and offers </h6>
						<a href="<?= FILE_PATH['mail']; ?>" class="card-link">View</a>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<?php require_once '../templates/footer.php' ?>