window.onerror = false; // ignore errors and continue running script
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict';
  window.addEventListener('load', function () {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function (form) {
      form.addEventListener('submit', function (event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();

/** format search text on searchbar homepage starts here  */

const removeFullStopEnd = () => {
  const txtSearch = document.getElementById('search');
  const whitespace = /(^\s*)|(\s*$)/gi,
    fullStop = /\./g;
  // Check if string contains a full-stop or white spaces
  if (txtSearch.value.match(whitespace) || txtSearch.value.match(fullStop)) txtSearch.value = txtSearch.value.replace(whitespace, '').replace(fullStop, '');

}
if (document.getElementById('search')) removeFullStopEnd();

/** format search text on searchbar homepage ends here  */

/*********************************** toggle password checkbox   *********************************/
const password = document.getElementById('password');
const chkPassword = document.getElementById('chkPassword');

if (chkPassword) chkPassword.addEventListener('change', (e) => password.type = e.target.checked ? 'text' : 'password');

/*********************************** toggle password checkbox ends here   *********************************/

/*********************************** Validate number field using input type text   *********************************/

if (document.getElementById('verification_code')) document.getElementById('verification_code').onkeypress = e => e.keyCode > 31 && (e.keyCode < 48 || e.keyCode > 57) ? false : true;
/*********************************** Validate number field using input type text   *********************************/

/*********************************** password strength meter starts here      *********************************/
const passCriteria = document.getElementById('password-criteria');

passCriteria ? passCriteria.style.display = 'none' : '';

if (password) password.addEventListener('keyup', () => checkPassword(password.value));
if (password) password.addEventListener('focus', () => passCriteria ? (passCriteria.style.display = 'block') : checkPassword(password.value)); // Show password criteria
if (password) password.addEventListener('focusout', () => passCriteria ? (passCriteria.style.display = 'none') : ''); // Hide password criteria


const checkPassword = (password) => {
  const strengthBar = document.querySelector('.progress-bar');
  let strength = 0;

  // password validation regex
  const validation = Object.freeze({
    containsUpperCase: str => /[A-Z]/.test(str),
    containsLowerCase: str => /[a-z]/.test(str),
    containsNumber: str => str.match('.*\\d.*'),
    containsSpecialChars: str => /[!@#£$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/.test(str),
    is8Chars: str => str.length >= 8
  });

  const updateStrengthBar = id => {
    document.querySelector(`#${id}`).className = 'fa fa-check-circle';
    strength++;
  };
  const decreaseStrengthBar = id => document.querySelector(`#${id}`).className = 'fa fa-times';

  validation.containsNumber(password) ? updateStrengthBar('number') : decreaseStrengthBar('number');
  validation.containsSpecialChars(password) ? updateStrengthBar('specialChar') : decreaseStrengthBar('specialChar');
  validation.containsUpperCase(password) ? updateStrengthBar('uppercase') : decreaseStrengthBar('uppercase');
  validation.is8Chars(password) ? updateStrengthBar('minLength') : decreaseStrengthBar('minLength');
  validation.containsLowerCase(password) ? updateStrengthBar('lowercase') : decreaseStrengthBar('lowercase');


  switch (strength) {
    default:
      setStrength(strengthBar, 0, 'bg-danger');
      break;
    case 1:
      setStrength(strengthBar, 20, 'bg-warning');
      break;
    case 2:
      setStrength(strengthBar, 40, 'bg-info');
      break;
    case 3:
      setStrength(strengthBar, 60, 'bg-primary');
      break;
    case 4:
      setStrength(strengthBar, 80, 'bg-dark');
      break;
    case 5:
      setStrength(strengthBar, 100, 'bg-success');
      break;
  }
};

const setStrength = (strengthBar, strengthNumber, colour) => {
  // if colour was not provided set a default colour
  if (!colour) colour = 'bg-primary';

  strengthBar.className = `progress-bar ${colour}`;
  strengthBar.style.width = `${strengthNumber}%`;
  strengthBar.innerText = `${strengthNumber} %`;
};
/*********************************** password strength meter ends here  *********************************/

/*********************************** change image source when the refresh button is clicked starts here  *********************************/

// change image source when the refresh button is clicked
if (document.getElementById('refresh')) {
  document.getElementById('refresh').addEventListener('click', (e) => {
    e.preventDefault();
    document.getElementById('img-captcha').src = 'includes/captcha.inc.php';
  });
}
/*********************************** change image source when the refresh button is clicked ends here  *********************************/

$(document).ready(function () {
  try {
    // This function counts the number of characters in a textarea
    $('#charactersLeft').each(function () {
      $('#charactersLeft').text(`${$('textarea').prop('maxlength')} characters left`);

      $('textarea').on('input', function () {
        // get the max-length property
        const maxLength = $(this).prop('maxlength');
        // get total number of character user input
        const currentLength = $(this).val().length;

        if (currentLength >= maxLength) {
          $('#charactersLeft').text('You have reached the maximum number of characters.');
          return;
        }
        $('#charactersLeft').text(`${maxLength - currentLength} characters left`);

      });
    });

    const home = [
      '/COMP1321-WebApplication/index.php',
      '/COMP1321-WebApplication/',
      '/mc8852u/COMP1321/Coursework/COMP1321-WebApplication/index.php',
      '/mc8852u/COMP1321/Coursework/COMP1321-WebApplication/'
    ];
    // check if the home link does not exists in the array to invoke function
    if (jQuery.inArray(window.location.pathname, home) === -1) focusFirstInputField();


    // This function focuses on the first input field.
    function focusFirstInputField() {
      const firstInput = 'form :input:enabled:visible:first';
      if (!firstInput) {
        // check if the input field is not focused by using autofocus html5 element
        let len = firstInput.val().length;
          if (firstInput.length) {
            firstInput[0].focus();
            firstInput[0].setSelectionRange(len, len);
          }
        
      }
    }
    //.each used to check if selector exists

    //check if author id exists to show related search results
    if ($('#author_id').length) relatedSearchResults();

    // show related search results for an author
    function relatedSearchResults() {
      const authorName = $('#author_id option:selected').text();
      // check if the first option is not selected to show message
      const msg = !$('#author_id option:nth-child(1)').is(':selected') ? `for <strong>${authorName}</strong>` : '';
      $('#relatedResults').html(`Related recipe results ${msg}`);
    }

    $('#search').each(function () {
      // focus on the end of the search text-box
      let input = $('#search'), len = input.val().length;
      input[0].focus();
      input[0].setSelectionRange(len, len);
    });

    // search recipe by name autocomplete
    if (document.getElementById('search')) {
      $('#search').autocomplete({
        source: 'search.php',
        minLength: 1
      });
    }
  } catch (err) {
    console.error(`error: ${err.message}`);
  }
});
