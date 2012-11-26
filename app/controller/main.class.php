<?php
class mcMainController {
  // See __construct() for object variable instantiation.
  private $filesystem = null;   // mcFilesystemController object.
  private $html       = null;   // mcHtmlController object.
  private $memcache   = null;   // mcMemcacheController object.
  private $model      = null;   // mcModelController object.
  private $page       = null;   // mcPageController object.
  private $request    = null;   // mcRequestController object.
  private $response   = null;   // mcResponseController object.
  private $status     = null;   // mcStatusController object.
  private $tree       = null;   // mcTreeController object.
  private $user       = null;   // mcUserController object.
  private $utils      = null;   // mcUtilsController object.
  private function main() {
    $requestPackets = $this->request->getPackets();
    if (!empty($requestPackets)) {
      foreach ($requestPackets AS $p => $packet) {
        call_user_func_array(array($this->$packet['o'], $packet['m']), array($packet));
      }
    } else {
      $this->page->get(array('type' => 'user', 'name' => 'login'));
    }
    return null;
  }
  private function open() {
    if ($this->memcache->open()) {
      $this->request->init();
      return true;
    }
    return false;
  }
  public function __construct() {
    $this->filesystem = new mcFilesystemController();
    $this->html       = new mcHtmlController();
    $this->memcache   = new mcMemcacheController();
    $this->model      = new mcModelController();
    $this->page       = new mcPageController();
    $this->request    = new mcRequestController();
    $this->response   = new mcResponseController();
    $this->status     = new mcStatusController();
    $this->tree       = new mcTreeController();
    $this->user       = new mcUserController();
    $this->utils      = new mcUtilsController();
    return null;
  }
  public function close() {
    $this->memcache->close();
    $this->filesystem = null;
    $this->html       = null;
    $this->memcache   = null;
    $this->model      = null;
    $this->page       = null;
    $this->request    = null;
    $this->response   = null;
    $this->status     = null;
    $this->tree       = null;
    $this->user       = null;
    $this->utils      = null;
    return null;
  }
  public function run() {
    if ($this->open()) {
      $this->main();
    }
    return null;
  }
}
?>