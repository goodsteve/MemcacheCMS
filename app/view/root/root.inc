<?php
$rootObj        = $mc->tree->getRoot();
$rootTreeLinks  = $mc->tree->getTreeLinks($rootObj->key);
?>

<?php include_once(MC_PATH_APP_VIEW_TEMPLATES . DS . 'header.inc') ?>



<div class="row">
  <div class="span5">
    <!-- Root form -->
    <div class="span5 well">
      <h4><?php echo $rootObj->name; ?> Form</h4>
      <br />
      <form name="mcRootForm" id="mcRootForm" method="post" action="<?php echo MC_URL; ?>">
      <input type="hidden" name="o" value="tree" />
      <input type="hidden" name="m" value="updateRoot" />
      <div class="row">
        <div class="span1 mc-label">
          Name:
        </div>
        <div class="span4">
          <input type="text" class="span3" name="name" id="mcRootName" value="<?php echo $rootObj->name; ?>" maxlength="128" />
        </div>
      </div>
      <div class="row">
        <div class="span1"></div>
        <div class="span4"><br />
          <input type="submit" class="btn" name="mcRootFormSubmit" id="mcRootFormSubmit" value="Save Root" />
        </div>
      </div>
      </form>
    </div>
    <!-- Branch form -->
    <div class="span5 well mc-branch-form">
      <h4>Branch Form</h4>
      <br />
      <form name="mcRootBranchForm" id="mcRootBranchForm" method="post" action="<?php echo MC_URL; ?>">
      <input type="hidden" name="o" value="tree" />
      <input type="hidden" name="m" value="createRootBranch" />
      <div class="row">
        <div class="span1 mc-label">
          Name:
        </div>
        <div class="span4">
          <input type="text" class="span4" name="name" id="mcBranchName" maxlength="128" />
        </div>
      </div>
      <div class="row">
        <div class="span1"></div>
        <div class="span4"><br />
          <input type="submit" class="btn btn-primary" name="mcRootBranchFormSubmit" id="mcRootBranchFormSubmit" value="Create Branch" />
        </div>
      </div>
      </form>
    </div>
  </div>
  <div class="span8 offset1">
    <!-- Root tree -->
    <div class="row">
      <div class="span8">
        <h4><?php echo $rootObj->name; ?> Tree</h4>
      </div>
    </div>
    <?php
    foreach ($rootTreeLinks AS $treeLinkKey => $treeLinkPath) {
      echo '<div class="row mc-margin-top-5">
        <div class="span6">
          <a href="' . MC_URL . '?o=tree&m=viewNode&key=' . $treeLinkKey . '">' . $treeLinkPath . '</a>
        </div>
      </div>';
    }
    ?>
  </div>
</div>

<script type="text/javascript">$('#mcBranchName').focus();</script>
<?php include_once(MC_PATH_APP_VIEW_TEMPLATES . DS . 'footer.inc') ?>