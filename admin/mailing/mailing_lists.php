<?php
$current_page = 'mailing_lists';
$page_title = 'Mailing lists';
require_once '../../templates/header.php';
require_once '../adminIncludes/mailing_list.inc.php';

?>
<div class="container">
  <h1 class=" p-2">Mail Author</h1>
      <hr class="custom-line">
</div>
<form method="post" action="" class="needs-validation" novalidate>
  <div class="container">
  <?php require_once '../../includes/session_message.inc.php';?>
  <?php if(isset($_SESSION['message'])) Helper::removeSessionMsg();?>
    <div class="row">
    <div class="col-md-6">
        <div class="form-group">
        <label for="author_id">Author</label>
              <select id="author_id" name="author_id" class="custom-select" required autofocus>
                <option value="">Please Select</option>
                <option value="mail_all_authors">Mail all Authors</option>
                <?php foreach ($author->showAuthor() as $row) : ?>
                    <option value="<?= $row['author_id'] ?>" <?php if ($row['author_id'] === $selected_author) echo 'selected'  ?>><?= $row['author_name'] ?></option>
                <?php endforeach; ?>
              </select>
              <div class="invalid-feedback">Please select an Author.</div>
        </div>
      </div>


      <div class="col-md-6">
        <div class="form-group">
        <label for="Subject">Subject</label>
              <select id="subject" name="subject" class="custom-select" required></select>
              <div class="invalid-feedback">Please specify your subject.</div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label for="form_message">Message *</label>
          <textarea id="message" name="message" class="form-control" maxlength="500" placeholder="Enter your Message *" rows="4" maxlength="500" required="required"  id="comment"></textarea>
          <div class="invalid-feedback">Message is required</div>
          <p class="text-muted" id="charactersLeft"></p>
          <div class="help-block with-errors"></div>
        </div>
      </div>
      <div class="col-md-12 pb-3">
        <input type="submit" class="btn btn-primary btn-send" name="submit" value="Send message">
      </div>
    </div>


  </form>
</div>
<?php require_once '../../templates/footer.php';?>
<?php require_once '../../js/data.php'; ?>
