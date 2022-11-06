$(document).ready(function () {

    let cookingTime = $('#cook_time'), noCookCheckbox = $("#no_cook"), firstValue = false;

    // ensure that the prep/cooking time does not exceed max-length
    $("#cook_time, #prep_time").on("input", function () {

        $(this).prop("maxLength", "2");

        if ($(this).val().length > $(this).prop("maxLength")) {
            $(this).val($(this).val().slice(0, $(this).prop("maxLength")));
        }
    });

    // disable input field if no cooking time already exists
    if (cookingTime.val() === noCookCheckbox.prop("value")) {
        cookingTime.prop('disabled', true);
        noCookCheckbox.prop('checked', true);
    }

    // if the no cook checkbox button state change
    noCookCheckbox.change(function () {
        if (!firstValue) firstValue = cookingTime.val();
        

        // check if no cook time checkbox is checked
        if ($(this).is(":checked")) { // disable input field
            // set cook time input field properties
            cookingTime.prop({
                disabled: true,
                type: "text",
                value: $(this).prop("value")
            });
            return;


        }
         // checkbox is unchecked
        cookingTime.prop({

            value: firstValue,
            disabled: false,
            type: "number",
            maxLength: "2"
            });

            firstValue = false; // set firstValue to false - default value
            cookingTime.last().focus(); // focus on the cook_time text input field
        

    });

});

