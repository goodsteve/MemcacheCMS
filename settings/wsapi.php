<?php
$mcSettings['wsapi']  = array();

// Page object API.
$mcSettings['wsapi']['page']['get']             = array('optional' => array(), 'required' => array('type', 'name'));

// Tree object API.
$mcSettings['wsapi']['tree']['createRootBranch']      = array('optional' => array(), 'required' => array('name'));
$mcSettings['wsapi']['tree']['updateRoot']            = array('optional' => array(), 'required' => array('name'));

// User object API.
$mcSettings['wsapi']['user']['login']           = array('optional' => array(), 'required' => array('username', 'password'));
$mcSettings['wsapi']['user']['logout']          = array('optional' => array(), 'required' => array());
?>