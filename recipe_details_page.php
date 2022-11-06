<?php
require_once 'includes/interface-autoload.php';
require_once 'includes/class-autoload.php';
require_once 'includes/recipe_details.inc.php';

$current_page = 'recipe';
$page_title = RECIPE_INFO['name'];
require_once 'templates/header.php'; ?>

<div class="container">
    <!-- breadcrumb -->
    <div class="pt-5">
        <?php Helper::breadcrumb(Helper::html(RECIPE_INFO['name']), $_SESSION['author'], $_SESSION['category'], $_SESSION['search'], $_SESSION['page']) ?>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <h2><?=RECIPE_INFO['name']?></h2>
            <hr class="custom-line">
            <p class="lead"><?=nl2br(RECIPE_INFO['description'])?> </p>
            <p>By <strong><a class="custom-link" title="Email:<?=Helper::html(RECIPE_INFO['email'])?>" href="mailto:<?=Helper::html(RECIPE_INFO['email'])?>"><?=Helper::html(RECIPE_INFO['author'])?></a></strong></a></p>

            <p class="text-lead">Category: <strong><?=Helper::html(RECIPE_INFO['category_name'])?></strong></p>
        </div>
    </div>
    <!-- Recipe Item Row -->
    <div class="row padding">
        <div class="col-md-8">
            <img class="img-fluid card-img-top recipe-detail-img" src="<?=$row['image']?>" alt="<?=Helper::html(RECIPE_INFO['alt'])?>">
        </div>
        <div class="col-md-4">
            <div class="card border-dark mb-3" style="max-width: 18rem;">
                <div class="card-header">Details</div>
                <div class="card-body text-dark">
                    <h5 class="card-title"><?=Helper::html(RECIPE_INFO['name'])?></h5>
                    <p class="card-text">
                        Prep: <?=Helper::formatTime(Helper::html(RECIPE_INFO['prep_time'])) ?><br>
                        <!-- Check if the cooking time is a number -->
                        <?php if(is_numeric(Helper::html(RECIPE_INFO['cook_time']))):?>
                        Cook: <?=Helper::formatTime(Helper::html(RECIPE_INFO['cook_time'])) ?><br>
                        Total: <?=Helper::formatTime(Helper::html(RECIPE_INFO['total_cooking_time'])) ?><br>
                        <?php else: ?>
                            <!-- display default string literal (No cooking time required) -->
                            <?=Helper::html(RECIPE_INFO['cook_time'])?>
                        <?php endif?>
                        Servings: <?=Helper::html(RECIPE_INFO['servings'])?><br>
                </p>
                </div>
            </div>
        </div>  <!-- /.col-md-4 -->
    </div> <!-- /.row -->
    <div class="row">
        <div class="col-md-10 mt-2 rounded pb-3">
            <section id="lists">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-disciplinary-stages" role="tab" aria-controls="nav-disciplinary-stages" aria-selected="true">Ingredients</a>
                        <a class="nav-item nav-link" id="nav-expectations-tab" data-toggle="tab" href="#nav-expectations" role="tab" aria-controls="nav-expectations" aria-selected="false">Cooking Directions</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-disciplinary-stages" role="tabpanel" aria-labelledby="nav-disciplinary-stages">
                        <div class="card-body">
                            <ul class="list-unstyled">
                                <?php foreach ($recipe->getIngredients() as $ingredient):?>
                                    <?php if(!empty(Helper::html($ingredient['title']))):?>
                                        <p class="lead font-weight-bold"><?=Helper::html($ingredient['title'])?></p>
                                        <hr class="custom-line">
                                        <?php endif;?>
                                    <li><?=Helper::html($ingredient['ingredient'])?></li>
                                    <hr class="custom-line-list">
                                <?php endforeach;?>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-expectations" role="tabpanel" aria-labelledby="nav-expectations-tab">
                        <div class="card-body">
                        <ul class="ordered-list">
                                <?php foreach ($recipe->getPrepMethod() as $prep_method):?>
                                    <li><?=Helper::html($prep_method['method'])?></li>
                                    <hr class="custom-line-list">
                                <?php endforeach;?>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
        </div> <!-- /.col-md-10-->
    </div> <!-- /.row -->
</div>
<!-- /.container -->

<?php require_once 'templates/footer.php'; ?>