// validate recipe form 
$(document).ready(function () {
    let namePattern = new RegExp(/^[A-Za-z]+$/);

    // get error message tags
    let first_name_error = $("#firstNameErrorMessage"),
        last_name_error = $("#lastNameErrorMessage");
    // set error message
    let firstNameError = lastNameError = false;

    // get id tags
    let firstName = $("#firstname"),
        lastName = $("#lastname");

    firstName.focusout(function () {
        checkFirstName();

    });
    lastName.focusout(function () {
        checkLastName();

    });

    // validate first name
    const checkFirstName = ()=> {

        if (firstName.val() === '') return false;
            

        if (!namePattern.test(firstName.val())) {

            first_name_error.text("firstname cannot contain spaces, numbers or special characters");
            first_name_error.show();
            firstNameError = true;
            // add error class
            firstName.addClass("error");
            return;


        }
        first_name_error.hide();
        firstName.removeClass("error");

    }

    // validate last name
    const checkLastName = () => {

        if (lastName.val() === '') return false;

        
        if (!namePattern.test(lastName.val())) {

            last_name_error.text("lastname cannot contain spaces, numbers or special characters");
            last_name_error.show();
            lastNameError = true;
            // add error class
            lastName.addClass("error");
            return;

        } 

        last_name_error.hide();
        astName.removeClass("error");

        

    }

    // check form submission
    $("form").submit(function () {
        // set to false
        firstNameError = lastNameError = false;

        checkFirstName();
        checkLastName();
        return !firstNameError  && !lastNameError ? true : false;

    });

}); // doc ready end