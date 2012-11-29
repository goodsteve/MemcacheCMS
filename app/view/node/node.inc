<?php
$rootObj            = $mc->tree->getRoot();
$nodeObj            = $mc->tree->getNode();
$rootTreeLinks      = $mc->tree->getTreeLinks($rootObj->key);
$nodeTreeLinks      = $mc->tree->getTreeLinks($nodeObj->parent);
$nodeParentOptions  = $mc->tree->getNodeParentOptions($rootTreeLinks, $nodeObj->key, $nodeObj->parent);
?>

<?php include_once(MC_PATH_APP_VIEW_TEMPLATES . DS . 'header.inc') ?>

<div class="row">
  <div class="span12">
    <!-- Node form -->
    <div class="span12 well">
      <h4><?php echo $nodeObj->name; ?> Form</h4>
      <br />
      <form name="mcNodeForm" id="mcNodeForm" method="post" action="<?php echo MC_URL_FULL; ?>">
      <input type="hidden" name="o" value="tree" />
      <input type="hidden" name="m" value="updateNode" />
      <input type="hidden" name="key" value="<?php echo $nodeObj->key; ?>" />
      <div class="row">
        <div class="span10">
          <div class="row">
            <div class="span1 mc-label">
              Parent:
            </div>
            <div class="span7">
              <select name="parent" id="mcNodeParent" class="span7">
                <?php echo $nodeParentOptions; ?>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="span1 mc-label">
              Name:
            </div>
            <div class="span7">
              <input type="text" class="span7" name="name" id="mcNodeName" value="<?php echo $nodeObj->name; ?>" maxlength="128" />
            </div>
          </div>
        </div>
        <div class="span2">
          <div class="row">
            <div class="span2">
              <input type="submit" class="btn btn-success mc-form-button" name="mcNodeFormSubmit" id="mcNodeFormSubmit" value="Save Node" />
            </div>
          </div>
          <div class="row mc-margin-top-15">
            <div class="span2">
              <input type="reset" class="btn btn-info mc-form-button" name="mcNodeFormReset" id="mcNodeFormReset" value="Undo Changes" />
            </div>
          </div>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>


<div class="row">
  <div class="span5">
    <!-- Branch form -->
    <div class="span5 well mc-branch-form">
      <h4>Branch Form</h4>
      <br />
      <form name="mcNodeBranchForm" id="mcNodeBranchForm" method="post" action="<?php echo MC_URL_FULL; ?>">
      <input type="hidden" name="o" value="tree" />
      <input type="hidden" name="m" value="createNodeBranch" />
      <div class="row">
        <div class="span1 mc-label">
          Parent:
        </div>
        <div class="span4 mc-label">
          <?php echo $nodeObj->name; ?>
        </div>
      </div>
      <div class="row mc-margin-top-15">
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
          <input type="submit" class="btn btn-primary" name="mcNodeBranchFormSubmit" id="mcNodeBranchFormSubmit" value="Create Branch" />
        </div>
      </div>
      </form>
      <br />
    </div>
  </div>
  <div class="span8 offset1">
    <!-- Root tree -->
    <div class="row">
      <div class="span8">
        <h4><?php echo $nodeObj->name; ?> Tree</h4>
      </div>
    </div>
    <?php
    foreach ($nodeTreeLinks AS $treeLinkKey => $treeLinkPath) {
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