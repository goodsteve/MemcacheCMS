<?php
$mcSettings['wsapi']  = array();

// Page object API.
$mcSettings['wsapi']['page']['get']       = array('optional' => array(), 'required' => array('type', 'name'));

// User object API.
$mcSettings['wsapi']['user']['login']     = array('optional' => array(), 'required' => array('username', 'password'));
$mcSettings['wsapi']['user']['logout']    = array('optional' => array(), 'required' => array());
?>