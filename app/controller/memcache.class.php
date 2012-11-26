<?php
class mcMemcacheController {
  private $link     = null;
  private $linked   = false;
  private $settings = array();
  public function __construct() {
    global $mcSettings;
    $this->settings = $mcSettings['memcache'];
    return null;
  }
  public function close() {
    if ($this->linked == true) {
      $this->link->close();
    }
    $this->link     = null;
    $this->linked   = false;
    $this->settings = array();
    return null;
  }
  public function hash($str = '') {
    return sha1($str);
  }
  public function open() {
    if ($this->linked == false) {
      $this->link = new Memcache();
      if (($res = @$this->link->connect($this->settings[0]['host'], $this->settings[0]['port'])) !== false) {
        $this->linked = true;
      } else {
        echo 'Fatal error. Failed to connect to memcache server: ' . $this->settings[0]['host'] . ':' . $this->settings[0]['port'];
        return false;
      }
    }
    return true;
  }
}
?>