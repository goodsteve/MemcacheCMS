<?php
class mcUtilsController {
  public function __construct() {
    return null;
  }
  public function hash($str = '') {
    return sha1($str);
  }
}
?>