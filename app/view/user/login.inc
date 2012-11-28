<?php include_once(MC_PATH_APP_VIEW_TEMPLATES . DS . 'header.inc') ?>
<div class="row">
  <div class="span10">
    <h4>Sign in to try MemcacheCMS</h4>
    <br />
    <p>Use any username/password combination you want. Your content will only be stored for <b>1 hour</b>,<br />or until the memory (RAM) your data occupies needs to be re-used.</p>
    <br />
    <form name="mcLogin" id="mcLogin" method="post" action="<?php echo MC_URL; ?>">
    <input type="hidden" name="o" value="user" />
    <input type="hidden" name="m" value="login" />
    <div class="row">
      <div class="span2 mc-label">
        Username:
      </div>
      <div class="span4">
        <input type="text" name="username" id="mcUsername" size="16" maxlength="64" />
      </div>
    </div>
    <div class="row">
      <div class="span2 mc-label">
        Password:
      </div>
      <div class="span4">
        <input type="text" name="password" id="password" size="16" maxlength="64" />
      </div>
    </div>
    <br />
    <div class="row">
      <div class="span2"></div>
      <div class="span4">
        <input type="submit" class="btn btn-primary" value="Sign in" />
      </div>
    </div>
    </form>
  </div>
</div>
<script type="text/javascript">$('#mcUsername').focus();</script>
<?php include_once(MC_PATH_APP_VIEW_TEMPLATES . DS . 'footer.inc') ?>