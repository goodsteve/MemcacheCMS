<?php include_once(MC_PATH_APP_VIEW_TEMPLATES . DS . 'header.inc') ?>

<?php
$key  = '';
if (isset($_POST['key']) && $_POST['key']) {
  $key  = $_POST['key'];
}
?>

<div class="row">
  <div class="span12">
    <form name="mcForm" id="mcForm" method="post" action="<?php echo MC_URL_FULL; ?>">
    <input type="hidden" name="o" value="crud" />
    <input type="hidden" name="m" value="test" />
    <div class="row">
      <div class="span1 mc-label">
        Key:
      </div>
      <div class="span6">
        <input type="text" name="key" id="key" class="span6" maxlength="128" value="<?php echo $key; ?>" />
      </div>
      <div class="span4">
        <input type="submit" class="btn btn-primary" value="Submit" />
        <button class="btn" id="mcFormClearButton">New Key</button>
      </div>
    </div>
    </form>
  </div>
</div>
<div class="row">
  <div class="span12">
<pre>
<?php
if ($key) {
  echo '<br /><b>Key: ' . $key . '</b><br /><br />';
  if (($res = $mc->crud->read($key)) !== false) {
    print_r($res);
  } else {
    echo 'false';
  }
  
} else {
  echo 'No key';
}
?>
</pre>
  </div>
</div>
<script type="text/javascript">
$('#key').focus();
$('#mcFormClearButton').click(function() {
  $('#key').val('');
  $('#key').focus();
  return false;
});

</script>
<?php include_once(MC_PATH_APP_VIEW_TEMPLATES . DS . 'footer.inc') ?>