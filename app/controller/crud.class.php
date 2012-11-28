<?php
class mcCrudController {
  public function __construct() {
    return null;
  }
  public function create($key = '', $value = null, $safe = false, $update = true, $compress = MC_MEMCACHE_DEFAULT_COMPRESS, $expire = MC_MEMCACHE_DEFAULT_EXPIRE) {
    global $mc;
    if ($safe == false) {
      // Safety not guaranteed.
      return $mc->memcache->set($key, $value, $compress, $expire);
    } else {
      // Go forth, be safe.
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
  public function create_r($key = '', $value = null, $safe = false, $update = true, $compress = MC_MEMCACHE_DEFAULT_COMPRESS, $expire = MC_MEMCACHE_DEFAULT_EXPIRE) {
    if (isset($value->branches)) {
      $value    = clone $value;
      $branches = $value->branches;
      unset($value->branches);
      $value->branches  = array_keys($branches);
      foreach ($branches AS $branchKey => $branchObj) {
        $this->create_r($branchKey, $branchObj, $safe, $update, $compress, $expire);
      }
    }
    return $this->create($key, $value, $safe, $update, $compress, $expire);
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
  public function read_r($key = '') {
    if (($res = $this->read($key)) !== false) {
      if (isset($res->branches)) {
        $branchKeys = array_values($res->branches);
        unset($res->branches);
        $res->branches  = array();
        foreach ($branchKeys AS $k => $branchKey) {
          $res->branches[$branchKey]  = $this->read_r($branchKey);
        }
        return $res;
      }
    }
    return $res;
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
  public function update_r($key = '', $value = null, $safe = false, $create = true, $compress = MC_MEMCACHE_DEFAULT_COMPRESS, $expire = MC_MEMCACHE_DEFAULT_EXPIRE) {
    if (isset($value->branches)) {
      $value    = clone $value;
      $branches = $value->branches;
      unset($value->branches);
      $value->branches  = array_keys($branches);
      foreach ($branches AS $branchKey => $branchObj) {
        $this->update_r($branchKey, $branchObj, $safe, $create, $compress, $expire);
      }
    }
    return $this->update($key, $value, $safe, $create, $compress, $expire);
  }
}
?>