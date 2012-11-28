<?php
class mcTreeController {
  private $root   = null;     // mcRootModel object.
  public function __construct() {
    return null;
  }
  public function createRootBranch($args = array()) {
    global $mc;
    // Create the branch (node) object and set its values.
    $branch = new mcNodeModel();
    $branch->owner  = $this->root->owner;
    $branch->parent = $this->root->key;
    $branch->level  = ($this->root->level + 1);
    $branch->name   = $args['name'];
    $branch->key    = urlencode($this->root->key . MC_MEMCACHE_KEY_CONCAT . $branch->created);
    // Add the branch to memcache.
    if ($mc->crud->create_r($branch->key, $branch) !== false) {
      // Add branch to root and update root cache.
      $this->root->branches[] = $branch->key;
      $mc->crud->update($this->root->key, $this->root, true);
    }
    // Load the node page.
    $mc->page->getPage('root', 'root');
    return null;
  }
  public function getRoot() {
    return $this->root;
  }
  public function getTree($fromKey = '') {
    global $mc;
    return $mc->crud->read_r($fromKey);
  }
  public function getTreeLinkArray(&$treeLinks, $parentPath = '', $key = '') {
    global $mc;
    if (($res = $mc->crud->read($key)) !== false) {
      if (isset($res->key)) {
        $linkPath   = $parentPath . '/' . $res->name;
        $treeLinks[$res->key] = $linkPath;
        foreach ($res->branches AS $k => $branchKey) {
          $this->getTreeLinkArray($treeLinks, $linkPath, $branchKey);
        }
      }
    }
    return null;
  }
  public function getTreeLinkOptions($treeLinks = array(), $selected = '') {
    $linkOptions  = '';
    foreach ($treeLinks AS $key => $linkPath) {
      if ($key != $selected) {
        $linkOptions  .= '<option value="' . $key . '">' . $linkPath . '</option>';
      } else {
        $linkOptions  .= '<option value="' . $key . '" selected="selected">' . $linkPath . '</option>';
      }
    }
    return $linkOptions;
  }
  public function getTreeLinks($fromKey = '') {
    $treeLinks  = array();
    if ($fromKey) {
      $this->getTreeLinkArray($treeLinks, '', $fromKey);
    }
    return $treeLinks;
  }
  public function init($userKey = '') {
    global $mc;
    if (($res = $mc->crud->read($userKey)) !== false) {
      $this->root = $res;
    } else {
      $this->root = new mcRootModel();
      $this->root->key    = $userKey;
      $this->root->owner  = $userKey;
      $mc->crud->create_r($userKey, $this->root);
    }
    return null;
  }
  public function updateRoot($args = array()) {
    global $mc;
    $this->root->name   = $args['name'];
    $mc->crud->update($this->root->key, $this->root, true);
    return null;
  }
  public function viewNode($args = array()) {
    global $mc;
    $mc->page->getPage('node', 'node');
    return null;
  }
}
?>