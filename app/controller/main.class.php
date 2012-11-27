<?php
class mcMainController {
  // See __construct() for object variable instantiation.
  public $crud        = null;   // mcCrudController object.
  public $filesystem  = null;   // mcFilesystemController object.
  public $html        = null;   // mcHtmlController object.
  public $memcache    = null;   // mcMemcacheController object.
  public $model       = null;   // mcModelController object.
  public $page        = null;   // mcPageController object.
  public $request     = null;   // mcRequestController object.
  public $response    = null;   // mcResponseController object.
  public $status      = null;   // mcStatusController object.
  public $tree        = null;   // mcTreeController object.
  public $user        = null;   // mcUserController object.
  public $utils       = null;   // mcUtilsController object.
  // Settings
  private $settings   = array();  // $mcSettings multi-dimensional array.
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
  public function __construct($settings = array()) {
    $this->settings   = $settings;
    $this->crud       = new mcCrudController();
    $this->filesystem = new mcFilesystemController();
    $this->html       = new mcHtmlController();
    $this->memcache   = new mcMemcacheController($this->settings['memcache']);
    $this->model      = new mcModelController();
    $this->page       = new mcPageController();
    $this->request    = new mcRequestController($this->settings['wsapi']);
    $this->response   = new mcResponseController();
    $this->status     = new mcStatusController();
    $this->tree       = new mcTreeController();
    $this->user       = new mcUserController();
    $this->utils      = new mcUtilsController();
    return null;
  }
  public function close() {
    $this->memcache->close();
    $this->crud       = null;
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