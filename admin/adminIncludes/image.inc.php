<?php if (!is_null(RECIPE['image'])) : ?>
    <section class=" pt-2" id="recipe-image">
        <div class="row">
            <div class="col-md-4">
                <div class="content">
                    <div class="content-overlay"></div>
                    <img class="img-fluid content-image  edit-recipe-img img-thumbnail" src="<?= Helper::image(RECIPE['image']) ?>" alt="<?= RECIPE['alt'] ?>">
                    <div class="content-details fadeIn-bottom">
                        <h3 class="content-title"><?= RECIPE['name'] ?></h3>
                        <p class="content-text"><i class="fas fa-utensils"></i> <?= RECIPE['category_name'] ?></p>
                    </div>
                </div>
                <!--.content (Image) -->
            </div>
            <!--.col-md-4-->
        </div>
        <!--image row-->
    </section>
<?php else : ?>
    <p class="lead mt-2 p-3">No recipe image</p>
<?php endif; ?>
