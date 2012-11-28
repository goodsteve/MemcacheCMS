<?php
$rootObj        = $mc->tree->getRoot();
$rootTreeLinks  = $mc->tree->getTreeLinks($rootObj->key);
?>

<?php include_once(MC_PATH_APP_VIEW_TEMPLATES . DS . 'header.inc') ?>

<div class="row">
  <!-- Root form -->
  <div class="span6 well">
    <h4>Root Form</h4>
    <br />
    <form name="mcRootForm" id="mcRootForm" method="post" action="<?php echo MC_URL; ?>">
    <input type="hidden" name="o" value="tree" />
    <input type="hidden" name="m" value="updateRoot" />
    <div class="row">
      <div class="span2 mc-label">
        Root Name:
      </div>
      <div class="span4">
        <input type="text" class="span4" name="name" id="mcRootName" value="<?php echo $rootObj->name; ?>" maxlength="128" />
      </div>
    </div>
    <div class="row">
      <div class="span2"></div>
      <div class="span4"><br />
        <input type="submit" class="btn" name="mcRootFormSubmit" id="mcRootFormSubmit" value="Save Root" />
      </div>
    </div>
    </form>
  </div>
  <!-- Branch form -->
  <div class="span6 offset1 well">
    <h4>Branch Form</h4>
    <br />
    <form name="mcRootBranchForm" id="mcRootBranchForm" method="post" action="<?php echo MC_URL; ?>">
    <input type="hidden" name="o" value="tree" />
    <input type="hidden" name="m" value="createRootBranch" />
    <div class="row">
      <div class="span2 mc-label">
        Branch Name:
      </div>
      <div class="span4">
        <input type="text" class="span4" name="name" id="mcRootBranchName" maxlength="128" />
      </div>
    </div>
    <div class="row">
      <div class="span2"></div>
      <div class="span4"><br />
        <input type="submit" class="btn btn-primary" name="mcRootBranchFormSubmit" id="mcRootBranchFormSubmit" value="Create Branch" />
      </div>
    </div>
    </form>
  </div>
</div>
<hr />
<div class="row">
  <div class="span14">
    <h4>Root Tree</h4>
  </div>
</div>
<?php
foreach ($rootTreeLinks AS $treeLinkKey => $treeLinkPath) {
  echo '<div class="row">
    <div class="span14">
      <a href="' . MC_URL . '?o=tree&m=viewNode&key=' . $treeLinkKey . '">' . $treeLinkPath . '</a>
    </div>
  </div>';
}
?>
<script type="text/javascript">$('#mcRootBranchName').focus();</script>
<?php include_once(MC_PATH_APP_VIEW_TEMPLATES . DS . 'footer.inc') ?>