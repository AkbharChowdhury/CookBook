<!--footer-->
<footer class="bg-dark text-white mt-3">
	<div class="container-fluid padding">
		<div class="row text-center">
			<div class="col-md-4">
				<a class="navbar-brand" href="admin_home.php"><i class="fas fa-book-reader fa-2x"></i> CookBook</a>
				<hr class="bg-light">
				<p>02083318590</p>
				<p>CookBook@gmail.com</p>
				<p>32 The Broadway, Woodford Green,</p>
				<p>London IG8 0HQ, UK</p>
			</div>
			<div class="col-md-4">
				<hr class="bg-light">
				<h5>Our Hours</h5>
				<hr class="bg-light">
				<p>Monday-Friday: 9:00 AM to 6:00 PM</p>
				<p>Saturday: 10:00 AM to 6:00 PM </p>
				<p>Sunday: Closed</p>
			</div>
			<div class="col-md-4">
				<hr class="bg-light">
				<h5>Useful links</h5>
				<hr class="bg-light">
				<p><a href="<?=in_array($current_page, PAGES) ? 'index.php' : FILE_PATH['home']?>">Home</a></p> 
				<p><a href="<?=in_array($current_page, PAGES) ? 'about.php' : FILE_PATH['author']?>"><?=in_array($current_page, PAGES) ? 'About' : 'Manage Author'?></a></p> 
				<?php if(in_array($current_page, ADMIN_PAGES)):?>
				<p><a href="<?=FILE_PATH['category']?>">Manage Categories</a></p> 
				<?php endif;?>
				<p><a href="<?=in_array($current_page, PAGES) ? 'index.php?recipe' : FILE_PATH['recipe']?>"><?=in_array($current_page, PAGES) ? 'Recipes' : 'Manage Recipes'?></a></p> 

				<p><a href="<?=in_array($current_page, PAGES) ? 'contact.php' : FILE_PATH['mail']?>"><?=in_array($current_page, PAGES) ? 'Contact' : 'Manage Mailing List'?></a></p> 
			</div>
		</div>
		<div class="col-12 text-center">
			<hr class="bg-light">
			<h5 class="display-5" id="copyrightInfo">&copy; CookBook <?= date("Y") ?></h5>
		</div>
	</div>
</footer>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<!-- CKEditor link -->
<script src="https://cdn.ckeditor.com/ckeditor5/25.0.0/classic/ckeditor.js"></script>
<!-- required for AJAX to work -->
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<?php if(isset($root) && $root):?>
	<!-- include Data-table link in root admin folders-->
	<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.22/datatables.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.22/datatables.min.css">
	<script src="../../js/data-table.js"></script>
<?php endif;?>

<!-- custom js files -->
<script src="<?=in_array($current_page, PAGES) ? 'js/script.js' : FILE_PATH['scriptFile']?>"></script>

</body>
</html>



