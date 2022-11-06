<?php
/**
 * Notes: dynamic pagination  
 * category and author properties used for pages over 1

 */

class Pagination {
    private $totalPages,
        $page,
        $pageURL,
        $category,
        $author; 
    
     // Hold the class instance.
    private static $instance = null;

    
    public static function getInstance($totalPages,$page,$pageURL,$author,$category){
        
        return self::$instance === null  ? self::$instance = new Pagination($totalPages, $page, $pageURL, $author, $category) : self::$instance;

      }
    private function __construct($totalPages,$page,$pageURL,$author,$category){
        $this->totalPages = $totalPages;
        $this->page = $page;
        $this->pageURL = $pageURL;
        $this->author = $author;
        $this->category = $category;
        $this->createPagination();
    }
   
    public function createPagination() {

        echo '<nav aria-label="pagination-recipe">';
        echo '<ul class ="pagination justify-content-center">';

        /*// button for first page
        if($this->page>1){
            echo "<style>.pagination .next.disabled { display:none; } background: blue</style>            ";
            //echo "<script>alert('s')</script>";
            echo "<li class='page-item'><a class='page-link' href='{$this->pageURL}' title='Go to the first page.'>First</a></li>";
        }*/

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
        /*
        
    // button for last page
    if($this->page<$this->totalPages){
        echo "<li class='page-item'><a class='page-link' href='" .$this->pageURL . "page={$this->totalPages}' title='Last page is {$this->totalPages}.'>Last Page</a></li>";
    
    }
    */
        echo '</ul>';
        echo '</nav>';
    }
 
}
