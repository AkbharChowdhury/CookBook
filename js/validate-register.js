
// validate recipe form 
$(document).ready(function() {
   
    let namePattern = new RegExp(/^[A-Za-z]+$/);

    // get error message tags
    let first_name_error = $("#firstNameErrorMessage"),
        last_name_error = $("#lastNameErrorMessage"),
        password_error = $("#passwordErrorMessage");
    // set error message
    let firstNameError = lastNameError = passwordError = false;

    // get id tags
    let firstName = $("#firstname"),
        lastName = $("#lastname"),
        password = $("#password");

    firstName.focusout(function() {
        checkFirstName();

    });

    lastName.focusout(function() {
        checkLastName();

    });

    password.focusout(function() {
        checkPassword();

    });

    // validate first name
    const checkFirstName = () => {

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
        lastName.removeClass("error");

        

    }


    // validate password
    const checkPassword =  () => {

        if (password.val() === '') return false;
            

         if (password.val().length < 8) {

            password_error.text("Password must be at least 8 characters");
            password_error.show();
            passwordError = true;
            // add error class
            password.addClass("error");
            return;

        } 
        
        password_error.hide();
        password.removeClass("error");

        

    }

    // check form submission
    $("form").submit(function() {
        // set to false
        firstNameError = lastNameError = passwordError = false;


        checkFirstName();
        checkLastName();
        checkPassword();

        return !firstNameError && !lastNameError  && !passwordError ? true : false;
        

    });

}); // doc ready end