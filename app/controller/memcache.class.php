<?php
class mcMemcacheController {
  private $link     = null;
  private $linked   = false;
  private $settings = array();
  public function __construct($settings = array()) {
    $this->settings = $settings;
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
  public function get($key = '') {
    return $this->link->get($this->hash($key));
  }
  public function delete($key = '', $timeout = MC_MEMCACHE_DEFAULT_TIMEOUT) {
    return $this->link->delete($this->hash($key), $timeout);
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
  public function replace($key = '', $value = array(), $compress = MC_MEMCACHE_DEFAULT_COMPRESS, $expire = MC_MEMCACHE_DEFAULT_EXPIRE) {
    return $this->link->replace($this->hash($key), $value, $compress, $expire);
  }
  public function set($key = '', $value = array(), $compress = MC_MEMCACHE_DEFAULT_COMPRESS, $expire = MC_MEMCACHE_DEFAULT_EXPIRE) {
    return $this->link->set($this->hash($key), $value, $compress, $expire);
  }
}
?>