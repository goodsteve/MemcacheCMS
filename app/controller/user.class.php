<?php
class mcUserController {
  private $auth     = false;
  private $key      = '';
  private $session  = '';
  public function __construct() {
    return null;
  }
  public function getKey() {
    return $this->key;
  }
  public function getSession() {
    return $this->session;
  }
  public function isAuth() {
    return $this->auth;
  }
  public function login($args = array()) {
    global $mc;
    $this->key      = $mc->utils->hash(implode('::', $args));
    $this->session  = $mc->utils->hash($this->key . MC_USER_HTTP_USER_AGENT . MC_USER_REMOTE_ADDR);
    setcookie(MC_USER_KEY_COOKIE_NAME, $this->key, (time() + MC_USER_COOKIE_EXPIRE), '/', MC_SERVER_NAME, false, true);
    setcookie(MC_USER_SESSION_COOKIE_NAME, $this->session, (time() + MC_USER_COOKIE_EXPIRE), '/', MC_SERVER_NAME, false, true);
    $this->auth     = true;
    $mc->tree->init($this->key);
    return null;
  }
  public function logout() {
    global $mc;
    $this->auth     = false;
    $this->key      = '';
    $this->session  = '';
    setcookie(MC_USER_KEY_COOKIE_NAME, null, (time() - 3600), '/', MC_SERVER_NAME, false, true);
    setcookie(MC_USER_SESSION_COOKIE_NAME, null, (time() - 3600), '/', MC_SERVER_NAME, false, true);
    $mc->page->getPage('user', 'login');
    return null;
  }
  public function verify() {
    global $mc;
    if (isset($_COOKIE[MC_USER_KEY_COOKIE_NAME]) && isset($_COOKIE[MC_USER_SESSION_COOKIE_NAME])) {
      $this->key      = $_COOKIE[MC_USER_KEY_COOKIE_NAME];
      if ($_COOKIE[MC_USER_SESSION_COOKIE_NAME] === $mc->utils->hash($this->key . MC_USER_HTTP_USER_AGENT . MC_USER_REMOTE_ADDR)) {
        $this->session  = $_COOKIE[MC_USER_SESSION_COOKIE_NAME];
        setcookie(MC_USER_KEY_COOKIE_NAME, $this->key, (time() + MC_USER_COOKIE_EXPIRE), '/', MC_SERVER_NAME, false, true);
        setcookie(MC_USER_SESSION_COOKIE_NAME, $this->session, (time() + MC_USER_COOKIE_EXPIRE), '/', MC_SERVER_NAME, false, true);
        $this->auth     = true;
        $mc->tree->init($this->key);
        return true;
      }
      return false;
    }
    return true;
  }
}
?>