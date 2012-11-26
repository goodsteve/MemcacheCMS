<?php
class mcPageController {
  private function validate($str) {
    if ((strpos($str, '.') === false) && (strpos($str, '/') === false) && (strpos($str, '\\') === false)) {
      return true;
    }
    return false;
  }
  public function __construct() {
    return null;
  }
  public function get($args = array()) {
    $pageType = $args['type'];
    $pageName = $args['name'];
    if ($this->validate($pageType) && $this->validate($pageName)) {
      $pagePath = MC_PATH_APP_VIEW . DS . $pageType . DS . $pageName . '.inc';
      if (file_exists($pagePath)) {
        include_once($pagePath);
        return null;
      }
    }
    echo 'Failed to load page: ' . $pageType . '/' . $pageName;
    return null;
  }
}
?>