<?php
class mcPageController {
  private $name   = '';
  private $path   = '';
  private $set    = false;
  private $type   = '';
  private function validate($str) {
    if ((strlen($str) >= MC_MIN_PAGE_NAME_LENGTH) && (strpos($str, '.') === false) && (strpos($str, '/') === false) && (strpos($str, '\\') === false)) {
      return true;
    }
    return false;
  }
  public function __construct() {
    return null;
  }
  public function get($args = array()) {
    global $mc;
    if ($this->validate($args['type']) && $this->validate($args['name'])) {
      $this->type = $args['type'];
      $this->name = $args['name'];
      $this->path = MC_PATH_APP_VIEW . DS . $this->type . DS . $this->name . '.inc';
      if (file_exists($this->path)) {
        $this->set  = true;
        include_once($this->path);
        return null;
      }
    }
    return null;
  }
  public function getPage($pageType = '', $pageName = '') {
    global $mc;
    if ($this->validate($pageType) && $this->validate($pageName)) {
      $this->type = $pageType;
      $this->name = $pageName;
      $this->path = MC_PATH_APP_VIEW . DS . $this->type . DS . $this->name . '.inc';
      if (file_exists($this->path)) {
        $this->set  = true;
        include_once($this->path);
        return null;
      }
    }
    return null;
  }
  public function pageSet() {
    return $this->set;
  }
}
?>