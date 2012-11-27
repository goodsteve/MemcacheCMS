<?php
class mcRequestController {
  private $packets  = array();  // Valid request packets to be processed by mcMainController::main().
  private $wsapi    = array();  // @see settings/wsapi.php
  private function packetize($superGlobal = array()) {
    if (isset($superGlobal['o']) && isset($superGlobal['m'])) {
      if (isset($this->wsapi[$superGlobal['o']][$superGlobal['m']])) {
        if ($this->validate($superGlobal, $this->wsapi[$superGlobal['o']][$superGlobal['m']])) {
          $this->packets[]  = $superGlobal;
        }
      }
    }
    return null;
  }
  private function validate($args = array(), $wsapi = array()) {
    foreach ($wsapi['required'] AS $k => $field) {
      if (!isset($args[$field]) || !$args[$field]) {
        return false;
      }
    }
    foreach ($wsapi['optional'] AS $k => $field) {
      if (!isset($args[$field])) {
        return false;
      }
    }
    return true;
  }
  public function __construct($wsapi = array()) {
    $this->wsapi  = $wsapi;
    return null;
  }
  public function getPackets() {
    return $this->packets;
  }
  public function init() {
    // The order matters. We want to process POST's before GET's.
    $this->packetize($_POST);
    $this->packetize($_GET);
    return null;
  }
}
?>