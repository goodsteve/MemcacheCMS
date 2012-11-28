<?php
class mcRootModel {
  public $created   = '';
  public $key       = '';
  public $modified  = '';
  public $owner     = '';
  public $name      = '';
  public $branches  = array();
  protected function create() {
    global $mc;
    $mc->memcache->set($this->key, get_object_vars($this));
    return null;
  }
  protected function getBranches() {
    return null;
  }
  protected function init() {
    global $mc;
    if (($res = $mc->memcache->get($this->key)) !== false) {
      foreach ($res AS $field => $value) {
        $this->$field = $value;
      }
    } else {
      $this->create();
    }
    return null;
  }
  public function __construct($key = '') {
    $this->created  = time();
    $this->key      = $key;
    $this->modified = $this->created;
    $this->owner    = $key;
    $this->name     = 'Root';
    $this->init();
    return null;
  }
}
?>