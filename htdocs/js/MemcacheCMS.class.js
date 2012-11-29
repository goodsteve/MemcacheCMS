var mc = null;

function MemcacheCMS() {
  this.showBranchForm = false;
  return null;
}

MemcacheCMS.prototype.menuButtonClick = function(btnElem) {
  var menuClick = $('#' + btnElem.id).attr('rel');
  switch (menuClick) {
    case 'logout':
      window.location = 'index.php?o=user&m=logout';
      break;
    default:
      window.location = 'index.php';
      break;
  }
  return false;
}

MemcacheCMS.prototype.toggleClass = function(className) {
  console.log(className);
  $('#memcache-cms .' + className).slideToggle();
  return null;
}

MemcacheCMS.prototype.toggleBranchForm = function() {
  if (this.showBranchForm == false) {
    $('#memcache-cms .mc-branch-form').fadeIn();
    $('#mcBranchName').focus();
    this.showBranchForm = true;
  } else {
    $('#memcache-cms .mc-branch-form').fadeOut();
    this.showBranchForm = false;
  }
  
  return null;
}