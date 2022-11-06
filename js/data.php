<script>
    $(document).ready(function() {

      // check page to load json obj file
     // load the json object - contact / mail
    <?php $src = ($current_page === 'contact') ? 'contact' : 'mail';?>
    let status = <?= json_encode($src); ?>;
    // get the file location of data.php depending on the current page
    let dataSrc = status === 'contact' ? 'js/data.json' : '../../js/data.json';
    // get the select menu
    let $select = $('#subject');
    // populate select menu
    loadData(<?= json_encode($src); ?>)

    function loadData(source) {
      // load data from json file
      $.getJSON(dataSrc, function(data) {
        $select.html('');
        // loop through json object array
        for (let i = 0; i < data[source].length; i++) {
          // append to select menu
          $select.append(`<option value="${data[source][i]['value']}">${data[source][i]['option']}</option>`);
        }
      });
    }
  });
</script>
