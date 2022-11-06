$(document).ready(function() {
    $('#email').on('keyup keypress blur focus', function() {

        let email = $(this).val();
        checkEmail();

        function checkEmail() {
            $.ajax({
                url: 'checkEmail.inc.php',
                method: "POST",
                data: {email: email},
                success: function(data) {

                    if (data === '1') {
                        $('#emailErrorMessage').text('This email already exists!');
                        $('#email').addClass("error");
                        $('form').attr('onsubmit', 'return false;'); // disable form submission
                        return;

                    } 
                    $('#emailErrorMessage').text('');
                    $('#email').removeClass("error");
                    $('form').attr('onsubmit', 'return true;'); // enable default form submission
                   

                }

            });
        }
    });


});