<?php
class mcRequestController {
  private $packets  = array();
  private function packetize($superGlobal = array()) {
    global $mcSettings;
    if (isset($superGlobal['o']) && isset($superGlobal['m'])) {
      if (isset($mcSettings['wsapi'][$superGlobal['o']][$superGlobal['m']])) {
        if ($this->validate($superGlobal, $mcSettings['wsapi'][$superGlobal['o']][$superGlobal['m']])) {
          $this->packets[]  = $superGlobal;
        }
      }
    }
    return null;
  }
  private function validate($args = array(), $settings = array()) {
    foreach ($settings['required'] AS $k => $field) {
      if (!isset($args[$field]) || !$args[$field]) {
        return false;
      }
    }
    foreach ($settings['optional'] AS $k => $field) {
      if (!isset($args[$field])) {
        return false;
      }
    }
    return true;
  }
  public function __construct() {
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