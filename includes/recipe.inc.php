<?php foreach ($recipes as $recipe) : ?>
    <div class="col-md-4 mb-4">
        <div class="card shadow border-0 h-100">
            <div class="inner">
                <a href="recipe_details_page.php?recipe_selected_id=<?= $recipe['recipe_id'] ?>">
                    <img class="card-img-top recipe-image" src="<?= Helper::image($recipe['image']) ?>"
                         alt="<?= Helper::html($recipe['alt']); ?>"
                         title="All images are used for illustrative purposes. Results may vary">
                </a>
            </div>
            <div class="card-body">
                <h4 class="card-title"><?= $recipe['name'] ?></h4>
                <p class="card-text">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-stopwatch" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M6 .5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1H9v1.07A7.001 7.001 0 0 1 8 16 7 7 0 0 1 7 2.07V1h-.5A.5.5 0 0 1 6 .5zM8 3a6 6 0 1 0 .001 12A6 6 0 0 0 8 3zm0 2.1a.5.5 0 0 1 .5.5V9a.5.5 0 0 1-.5.5H4.5a.5.5 0 0 1 0-1h3V5.6a.5.5 0 0 1 .5-.5z"/>
                    </svg> <?= $recipe['prep_time'] ?>
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-people-fill" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
                    </svg> <?= $recipe['servings'] ?>
                </p>
                <p class="card-text">By <strong><?= Helper::html($recipe['author_name']) ?></strong></p>
                <p class="card-text">Category <strong><?= Helper::html($recipe['category_name']) ?></strong></p>
                <p class="card-text"><?= $recipe['description'] ?></p>
                <a href="recipe_details_page.php?recipe_selected_id=<?= Helper::html($recipe['recipe_id']) ?>"
                   role="button" class="btn btn-info">View</a>
            </div>
        </div>
    </div>
<?php endforeach; ?>