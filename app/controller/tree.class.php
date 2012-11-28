<?php
class mcTreeController {
  private $root   = null;     // mcRootModel object.
  public function __construct() {
    return null;
  }
  public function init($userKey = '') {
    $this->root = new mcRootModel($userKey);
  }
}
?>