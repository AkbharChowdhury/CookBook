<?php
$current_page = 'contact';
$page_title = 'Contact us';
require_once 'templates/header.php';
//code logic
require_once 'includes/mail.inc.php';
?>
<div class="container">
  <h2 class="mt-3">Contact Details</h2>
  <hr class="custom-line">
  <div class="row pt-3">
    <div class="col-lg-8 mb-4">
      <!--Google Maps-->
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d79291.10197096619!2d-0.03595234179685477!3d51.607693100000006!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47d8a0cfc89c9c0b%3A0xfa99ea904de239d8!2sCOOK!5e0!3m2!1sen!2suk!4v1604599032545!5m2!1sen!2suk" class="embed-responsive" width="500" height="350" frameborder="0" style="border:0;"></iframe>
    </div>
    <!-- Contact Details Column -->
    <div class="col-lg-4 mb-4">
      <h3 class="display-5">Contact Details</h3>
      <p>32 The Broadway, Woodford Green IG8 0HQ</p>
      <p> Tel:<a href="tel:02083318590"> 0208 331 8590</a> </p>
      <p> Email: <a href="mailto:CookBook@gmail.com?subject = Enquriy&body = Message">CookBook@gmail.com</a> </p>

    </div>
  </div>

  <h2 class="mt-3">Contact Form</h2>
  <hr class="custom-line">
  <?php require_once 'includes/session_message.inc.php'; ?>
  <?php if (isset($_SESSION['message'])) Helper::removeSessionMsg(); ?>
  <p class="lead mt-2">Please fill in the form to contact the admin</p>
  <form method="post" action="" class="needs-validation" novalidate>
    <div class="controls">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="firstname">Firstname *</label>
            <input  type="text"  maxlength="30" name="firstname" id="firstname" class="form-control" placeholder="Please enter your firstname *" required data-error="Firstname is required." autofocus>
            <div class="invalid-feedback">Firstname is required.</div>
            <small class="form-text text-danger"><?= $errors['firstname'] ?? null ?></small>
            <small id="firstNameErrorMessage" class="form-text text-danger"></small>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="lastname">Lastname *</label>
            <input  type="text" maxlength="30" name="lastname" id="lastname" class="form-control" placeholder="Please enter your lastname *" required data-error="Lastname is required.">
            <div class="invalid-feedback">Lastname is required.</div>
            <small class="form-text text-danger"><?= $errors['lastname'] ?? null ?></small>
            <small id="lastNameErrorMessage" class="form-text text-danger"></small>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="form_email">Email *</label>
            <input id="form_email" maxlength="50" type="email" name="email" class="form-control" placeholder="Please enter your email *" required data-error="Valid email is required.">
            <div class="invalid-feedback">Email is required.</div>
            <small class="form-text text-danger"><?= $errors['email'] ?? null ?></small>

          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="subject">Subject *</label>
            <select id="subject" name="subject" class="custom-select" required></select>
            <div class="invalid-feedback">Please specify your subject.</div>
            <small class="form-text text-danger"><?= $errors['subject'] ?? null ?></small>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label for="form_message">Message *</label>
            <textarea id="message" name="message" class="form-control" maxlength="500" placeholder="Enter your Message *" rows="4" maxlength="500" required="required" data-error="Please, leave us a message." id="comment"></textarea>
            <small class="form-text text-danger"><?= $errors['message'] ?? null ?></small>
            <div class="invalid-feedback">Message is required</div>
            <p class="text-muted" id="charactersLeft"></p>
          </div>
        </div>
        <div class="col-md-12">
          <input type="submit" class="btn btn-primary btn-send" name="sendEmail" value="Send message">
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <p class="text-muted">
            <strong>*</strong> These fields are required.
          </p>
        </div>
      </div>
    </div>
  </form>
</div>


</div>
<!--/container..-->


<?php require_once 'templates/footer.php'; ?>
<?php require_once 'js/data.php'; ?>
<script src="js/validate-contact.js"></script>