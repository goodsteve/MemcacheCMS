<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>MemcacheCMS - A Memcache Content Management System</title>
    <link type="text/css" href="css/bootstrap.min.css" rel="stylesheet" />
    <!-- Include css file. -->
    <link type="text/css" href="css/MemcacheCMS.css" rel="stylesheet" />
    <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- Include javascript class. -->
    <script type="text/javascript" src="js/MemcacheCMS.class.js"></script>
    <script type="text/javascript">
      $(function(){
        mc = new MemcacheCMS();
        $('#memcache-cms .mc-menu button').click(function() {
          mc.menuButtonClick(this);
        });
      });
    </script>
  </head>
  <body>
    <div id="memcache-cms">
      <div class="row">
        <div class="span14">
          <div class="row">
            <div class="span14">
              <h3><a href="index.php">MemcacheCMS</a></h3>
            </div>
          </div>
          <div class="row">
            <div class="span14">
              <?php if ($mc->user->isAuth() == false) { ?>
              <i>A memcache content management system.</i>
              <?php } else {
                include_once(MC_PATH_APP_VIEW_TEMPLATES . DS . 'menu.inc');
              }
              ?>
            </div>
          </div>
        </div>
      </div>