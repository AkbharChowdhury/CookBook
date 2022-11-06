$(document).ready(function () {
    /**
     * Notes:
     * This script produces dynamic input fields for ingredients and prep-method input fields.
     * An ingredient / prep-method input field can be added or removed by clicking on its associated input field
     */
    /************************* Ingredients list **************************/

    // handle click event on add more ingredient button
    $('#add_ingredient').click(function (e) {
        e.preventDefault();
        $('#ingredient-items').append(`
            
                <div class="form-group">
                    <input type="text" class="form-control ingredients" name="ingredient_list[]" placeholder="enter an ingredient name" required>
                    <button class="btn btn-danger mt-3" id="remove_ingredients">Remove Ingredient</button>   
                    <div class="invalid-feedback">Ingredient is required</div>
                </div>
        
        `); // add input field for ingredients

        // set focus on the last ingredient input field
        focusLastInput('.ingredients');
    });

    // handle click event of the remove ingredient link
    $('#ingredient-items').on("click", "#remove_ingredients", function (e) {
        e.preventDefault();
        $(this).parent('div').remove(); // remove input field
        focusLastInput('.ingredients');

    });

    /************************* Ingredients List End **************************/

    /************************* Preparation Method List Start **************************/

    // handle click event on add more prep method button
    $('#add_prep_method').click(function (e) {
        e.preventDefault();
        $('#prep-method-items').append(`

                <div class="form-group">
                    <textarea class="form-control prep" id="prep_method_list" required name="prep_method_list[]" rows="3" required placeholder="enter prep method" autofocus></textarea>
                    <button class="btn btn-danger mt-3" id="remove_prep_method">Remove Method</button>
                    <div class="invalid-feedback">Prep method is required</div>
                </div>
            
            `); // add input field for prep method

        focusLastInput('.prep');
    });


    // handle click event of the remove ingredient link
    $('#prep-method-items').on("click", "#remove_prep_method", function (e) {
        e.preventDefault();
        $(this).parent('div').remove(); // remove input field
        focusLastInput('.prep');


    });
    /************************* Preparation Method List End **************************/


    // focus on the last input field
    function focusLastInput(inputID) {
        // check if input id exists
        if (!$(inputID).length) {
            alert('selector does not exists');
            return;
        }
        $(`${inputID}`).last().focus();

    }

}); // end of doc ready 
