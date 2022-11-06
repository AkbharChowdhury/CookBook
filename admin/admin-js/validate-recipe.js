// validate recipe form 
$(document).ready(function () {

  // get error message tags
  let recipe_name_error = $("#recipeErrorMessage"),
    description_error = $("#descriptionErrorMessage"),
    prep_error = $("#prepTimeErrorMessage"),
    cook_error = $("#cookTimeErrorMessage"),
    category_error = $("#categoryError"),
    image_error = $('#imageErrorMessage'),
    chkNoCook = $('#no_cook');

  //set error message
  let recipeNameError = descriptionError = prepError = cookTimeError = categoryError = imageError = false;

  // get id tags
  let recipeName = $("#recipe_name"),
    description = $("#description"),
    prepTime = $("#prep_time"),
    cookTime = $("#cook_time"),
    image = $("#image"),
    categories = $(".categories");

  // checkbox change event
  (categories).change(function (e) {
    validateCategory();

  });

  recipeName.focusout(function () {
    checkRecipe();

  });

  description.focusout(function () {
    checkDescription();

  });
 

  prepTime.focusout(function () {

    checkPrepTime();

  });

  cookTime.focusout(function () {

    checkCookTime();

  });
  // remove the error message and error class when the  no-cook check-box is checked
  (chkNoCook).change(function () {
    if (cookTime.val() === 'No cooking time required') {
      cook_error.hide();
      cookTime.removeClass("error");

    }

  });


  const validateCategory = () => {
    // check if at least one category is selected
    if (!categories.is(':checked')) {
      category_error.text("Please choose at least one category!");
      categoryError = true;
      return;
    } 
    category_error.text("");


  }

  // validate recipe name
  const checkRecipe = () => {
    let recipeMinLength = 5;


    if (recipeName.val() === '') return false;
      
    if (recipeName.val().length < recipeMinLength) {

      recipe_name_error.text(`Recipe name must be at least ${recipeMinLength} characters long`);
      recipe_name_error.show();
      recipeNameError = true;
      recipeName.addClass("error");
      return;

    } 
    recipe_name_error.hide();
    recipeName.removeClass("error");

    

  }
  // validate description
  const checkDescription =  () => {
    let descriptionMinLength = 20;

    if (description.val() === '') return false;

    if (description.val().length < descriptionMinLength) {

      description_error.text(`Description name must be at least ${descriptionMinLength} characters long`);
      description_error.show();
      descriptionError = true;
      description.addClass("error");
      return;

    }
    description_error.hide();
    description.removeClass("error");

    

  }

  // validate prep time
  const checkPrepTime = () => {
    let number = parseInt(prepTime.val());
    if (prepTime.val() === '') return false;
      
    
    if (number <= 0) {

      prep_error.text("Enter positive numbers greater than 0");
      prep_error.show();
      prepTime.addClass("error");

      prepError = true;
      return;

    } 
    prep_error.hide();
    prepTime.removeClass("error");

    

  }

  // validate prep time
  const checkCookTime = ()=> {
    let number = parseInt(cookTime.val());
    if (cookTime.val() === '') return false;

    
    if (number <= 0) {

      cook_error.text("Enter positive numbers greater than 0");
      cook_error.show();
      cookTime.addClass("error");
      cookTimeError = true;
      return;

    }
    
    cook_error.hide();
    cookTime.removeClass("error");

    

  }

  // check form submission
  $("form").submit(function () {

    recipeNameError = descriptionError = prepError = cookTimeError = categoryError = imageError = false;

    validateCategory();
    checkRecipe();
    checkDescription();
    checkPrepTime();
    checkCookTime();
    //checkImage(image.val());

    if (!recipeNameError && !descriptionError && !prepError && !cookTimeError  && !categoryError && !imageError) {

      return true;
    }
      // errors with the form and prevent form submission
      return false;
    


  });

}); // form validation for add recipe page ends here