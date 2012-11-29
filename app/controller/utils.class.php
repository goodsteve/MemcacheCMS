<?php
class mcUtilsController {
  public function __construct() {
    return null;
  }
  public function deleteArrayValue($list = array(), $value = '') {
    $filteredList = array();
    foreach ($list AS $k => $v) {
      if ($v != $value) {
        $filteredList[$k] = $v;
      }
    }
    return $filteredList;
  }
  public function hash($str = '') {
    return sha1($str);
  }
}
?>