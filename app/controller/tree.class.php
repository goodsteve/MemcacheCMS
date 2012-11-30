<?php
class mcTreeController {
  private $node       = null;     // mcNodeModel object.
  private $root       = null;     // mcRootModel object.
  public function __construct() {
    return null;
  }
  public function changeParent($key = '', $currentParentKey = '', $newParentKey = '') {
    global $mc;
    if ($currentParentNode = $this->getKey($currentParentKey)) {
      $currentParentNode->branches  = $mc->utils->deleteArrayValue($currentParentNode->branches, $key);
      $mc->crud->update($currentParentKey, $currentParentNode, true);
    }
    if ($newParentNode = $this->getKey($newParentKey)) {
      $newParentNode->branches[]  = $key;
      $mc->crud->update($newParentKey, $newParentNode, true);
    }
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
  public function getKey($key = '') {
    global $mc;
    if ($key) {
      return $mc->crud->read($key);
    }
    return false;
  }
  public function getNode() {
    return $this->node;
    return false;
  }
  public function getRoot() {
    return $this->root;
  }
  private function getNodeParentOpts(&$parentOptions, $parentKey = '', $parentPath = '', $nodeKey = '', $nodeParent = '') {
    global $mc;
    if (($res = $mc->crud->read($parentKey)) !== false) {
      $nodePath = $parentPath . '/' . $res->name;
      if ($res->key != $nodeParent) {
        $parentOptions .= '<option value="' . $res->key . '">' . $nodePath . '</option>';
      } else {
        $parentOptions .= '<option value="' . $res->key . '" selected="selected">' . $nodePath . '</option>';
      }
      foreach ($res->branches AS $k => $branchKey) {
        if ($branchKey != $nodeKey) {
          $this->getNodeParentOpts($parentOptions, $branchKey, $nodePath, $nodeKey, $nodeParent);
        }
      }
    }
    return null;
  }
  public function getNodeParentOptions($rootKey = '', $nodeKey = '') {
    global $mc;
    $parentOptions  = '';
    $nodeObj        = null;
    if ($nodeKey && ($nodeKey != $rootKey)) {
      if (($nodeObj = $mc->crud->read($nodeKey)) !== false) {
        $this->getNodeParentOpts($parentOptions, $rootKey, '', $nodeObj->key, $nodeObj->parent);
      }
    }
    return $parentOptions;
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
  public function initNode($key = '') {
    global $mc;
    if ($key != $this->root->key) {
      if (($res = $mc->crud->read(urlencode($key))) !== false) {
        $this->node = $res;
      } else {
        if (($res = $mc->crud->read($key)) !== false) {
          $this->node = $res;
        }
      }
    }
    return null;
  }
  public function updateNode($args = array()) {
    global $mc;
    $this->initNode($args['key']);
    if ($this->node) {
      $currentParent  = $this->node->parent;
      $newParent      = $args['parent'];
      $this->node->parent = $args['parent'];
      $this->node->name   = $args['name'];
      $mc->crud->update($this->node->key, $this->node, true);
      if ($newParent != $currentParent) {
        $this->changeParent($this->node->key, $currentParent, $newParent);
      }
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
    $this->initNode($args['key']);
    if ($this->node) {
      $mc->page->getPage('node', 'node');
    } else {
      $mc->page->getPage('root', 'root');
    }
    return null;
  }
}
?>