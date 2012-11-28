<?php
class mcRootModel {
  public $branches  = array();
  public $created   = '';
  public $key       = '';
  public $level     = 0;
  public $modified  = '';
  public $name      = 'Root';
  public $owner     = '';
  public $type      = 'root';
  public function __construct() {
    $this->created  = microtime();
    $this->modified = $this->created;
    return null;
  }
}
?>