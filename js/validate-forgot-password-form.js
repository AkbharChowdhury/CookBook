$(document).ready(function () {

    let password_error = $("#passwordErrorMessage"),
        // set error message
        passwordError = false,
        // get id tags
        password = $("#password");



    password.focusout(function () {
        checkPassword();

    });

    const checkPassword = () => {

        if (password.val() === '') return false;

        if (password.val().length < 8) {

            password_error.text("Password must be 8 password must be at least 8 characters");
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
    $("form").submit(function () {
        // set to false
        passwordError = false;

        checkPassword();

        return !passwordError ? true: false;


    });

}); // doc ready end
