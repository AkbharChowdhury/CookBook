<?php
// count all recipes in the database to calculate total pages
$total_pages = ceil($total_rows / $records_per_page);
//create dynamic pagination 
$pagination = Pagination::getInstance($total_pages, $page, $page_url, $selected_author, $selected_category);


