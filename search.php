<?php 
// auto-complete search
require_once 'includes/class-autoload.php';
require_once 'includes/interface-autoload.php';

$recipe = Recipe::getInstance();
if (isset($_GET['term'])) {
	
    $search_term = trim($_GET['term']);
	$recipe->setRecipeName($search_term);
	
	foreach ($recipe->getRecipeName() as $row) {
		extract($row);
		$return_arr[] = $row['name'];
	}
	echo json_encode($return_arr);
}



