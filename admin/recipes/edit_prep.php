<?php
$current_page = 'manage_recipe';
$page_title = 'Edit Prep';
require_once '../../templates/header.php';
// code logic
require_once '../adminIncludes/edit_prep.inc.php';
?>

<section class="container py-3">

	<?php require_once '../../includes/session_message.inc.php';?>
	<?php if(isset($_SESSION['message'])) Helper::removeSessionMsg();?>

	<div class="card">
		<div class="card-header">
			<h3 class="mb-0">Edit Prep Method</h3>
		</div>
		<div class="card-body">
		<h1 class="text-primary"><?=RECIPE_INFO['name']?></h1>
			<hr class="custom-line">
			<h2>Current Prep list</h2>
			<?php if($recipe->getPrepMethod()):?>
				<ul class="ordered-list">
					<?php foreach($recipe->getPrepMethod() as $row):?>
						<li><?=Helper::html($row['method'])?></li>
						<hr class="custom-line-list">
					<?php endforeach;?>
					</ul>
					<?php else: ?>
						<p class="text-muted">No Prep-method found</p>
			<?php endif;?>
			<form action="" method="post" id="recipeForm" class="needs-validation" novalidate autocomplete="off">
				<h1 class="text-primary p-2">Recipe Details</h1>
				<hr class="custom-line">
				<div class="form-row">
					<!-- append prep list-->
					<div class="col-md-6" id="prep-method-items">
						<h2 class="text-dark">Prep method</h2>
						<div class="form-group">
                        <textarea class="form-control prep" id="prep_method_list" required autofocus name="prep_method_list[]" rows="4" cols="5" required placeholder="enter prep method" maxlength="200"><?= $_POST['prep_method_list'] ?? null; ?></textarea>
						<div class="invalid-feedback">Prep method is required</div>
						</div>
					</div>
					<!-- append prep list end -->
					
					<div class="form-group col-md-6">
						<input class="btn btn-dark mt-3" type="button" value="Add Prep Method" id="add_prep_method">
					</div>
					
				</div>
				
				<input class="btn btn-success btn-lg mt-3" type="submit" value="Submit prep">
			</form>
		</div>
	</div>
</section>
<!--/section-->

<?php require_once '../../templates/footer.php'; ?>

<!-- dynamic input fields -->
<script src="../admin-js/ingredient-prep-dynamic-input-field.js"></script>



