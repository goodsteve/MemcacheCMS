<?php
class mcCrudController {
  public function __construct() {
    return null;
  }
  public function create($key = '', $value = null, $safe = false, $update = true, $compress = MC_MEMCACHE_DEFAULT_COMPRESS, $expire = MC_MEMCACHE_DEFAULT_EXPIRE) {
    global $mc;
    if ($safe == false) {
      return $mc->memcache->set($key, $value, $compress, $expire);
    } else {
      if ($key) {
        if (($res = $mc->memcache->get($key)) === false) {
          return $mc->memcache->set($key, $value, $compress, $expire);
        } else {
          if ($update == true) {
            return $mc->memcache->replace($key, $value, $compress, $expire);
          }
        }
      }
    }
    return false;
  }
  public function delete($key = '', $timeout = MC_MEMCACHE_DEFAULT_TIMEOUT) {
    global $mc;
    if ($key) {
      return $mc->memcache->delete($key, $timeout);
    }
    return false;
  }
  public function read($key = '') {
    global $mc;
    if ($key) {
      return $mc->memcache->get($key);
    }
    return false;
  }
  public function update($key = '', $value = null, $safe = false, $create = true, $compress = MC_MEMCACHE_DEFAULT_COMPRESS, $expire = MC_MEMCACHE_DEFAULT_EXPIRE) {
    global $mc;
    if ($safe == false) {
      return $mc->memcache->replace($key, $value, $compress, $expire);
    } else {
      if ($key) {
        if (($res = $mc->memcache->get($key)) !== false) {
          return $mc->memcache->replace($key, $value, $compress, $expire);
        } else {
          if ($create == true) {
            return $mc->memcache->set($key, $value, $compress, $expire);
          }
        }
      }
    }
    return false;
  }
}
?>