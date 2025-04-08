<?php
/**
 * Notes: dynamic pagination  
 * category and author properties used for pages over 1

 */

class Pagination {
    
    private static $instance = null;

    
    public static function getInstance($totalPages,$page,$pageURL,$author,$category){
        
        return self::$instance === null  ? self::$instance = new Pagination($totalPages, $page, $pageURL, $author, $category) : self::$instance;

      }


    private function __construct(
        private $totalPages,
        private $page,
        private $pageURL,
        private $category,
        private $author,

    ) {
        $this->createPagination();
    }
   
    public function createPagination() {

        echo '<nav aria-label="pagination-recipe">';
        echo '<ul class ="pagination justify-content-center">';

        // range of links to show = totalPages
        // display links to 'range of pages' around 'current page'
        $initialNum = $this->page - $this->totalPages;
        $conditionLimitNum = ($this->page + $this->totalPages)  + 1;

        for ($x = $initialNum; $x < $conditionLimitNum; $x++) {

            // be sure '$x is greater than 0' AND 'less than or equal to the $total_pages'
            if (($x > 0) && ($x <= $this->totalPages)) {

                // current page
                if ($x == $this->page) {
                    echo '<li class="page-item active"><a class="page-link" href="#">' . $x . ' <span class="sr-only">(current)</span></a></li>';
                } else {
                     // not current page
                    echo '<li class="page-item"><a class="page-link" href="' . $this->pageURL . 'page=' . $x . '&category_id=' . $this->category . '&author_id=' . $this->author . '">' . $x . '</a></li>';
                }

            }
        }
    
        echo '</ul>';
        echo '</nav>';
    }
 
}
