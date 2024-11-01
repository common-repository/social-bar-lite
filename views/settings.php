<div class="wrapper-sbl-plugin">
  <div class="page-header">
    <h1 class="SBLtitle" id="titleSettings"><?php echo $title_module;?></h1	>
  </div>

<form id="master-settings" class="form-horizontal" role="form" action="<?php echo admin_url() . "admin.php?page=" . SOCIAL_BL_FORM_URL; ?>" method="post">

<?php if(!empty($msg)) { ?>
<div class="alert alert-<?php echo $msgtype; ?>">
   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	<?php echo $msg; ?>
</div>
<?php } ?>

	<input type="hidden" name="option" value="social_bl_masterPlugin.social_bl_init">
 <?php wp_nonce_field( 'post_settings_for_socialbarlite', 'settings_for_socialbarlite' ); ?>
 <div class="form-group">
   <label for="language" class="col-sm-4 control-label SBLtitle" id="language"></label>
   <div class="col-sm-6">
     <input class="language" type="radio" name="data[<?php echo SOCIAL_BL_PLUGIN_NAME_VAR; ?>][language]"  <?php if(empty($data[SOCIAL_BL_PLUGIN_NAME_VAR]['language']) || $data[SOCIAL_BL_PLUGIN_NAME_VAR]['language'] === 'spanish'){?> checked="checked" <?php } ?> value="spanish" /> &nbsp; Español &nbsp;
     <input class="language" type="radio" <?php if($data[SOCIAL_BL_PLUGIN_NAME_VAR]['language'] === 'english'){?>  checked="checked"  <?php } ?> name="data[<?php echo SOCIAL_BL_PLUGIN_NAME_VAR; ?>][language]"  value="english" />&nbsp; English
   </div>
 </div>

	<div class="form-group">
		<label for="BackgroundBar" class="col-sm-4 control-label SBLtitle" id="message"></label>
		<div class="col-sm-6">
	    <input type="text" class="form-control" placeholder="" name="data[<?php echo SOCIAL_BL_PLUGIN_NAME_VAR; ?>][message]" value="<?php echo $data[SOCIAL_BL_PLUGIN_NAME_VAR]['message'];?>">
		</div>
	</div>

	<div class="form-group">
	    <label for="BackgroundBar" class="col-sm-4 control-label SBLtitle" id="textColor"></label>
	    <div class="col-sm-6">
		    <div >
          <input id="colorSelector_colortext" name="colortext" type="text" class="color-field" value="<?php if(!empty($data[SOCIAL_BL_PLUGIN_NAME_VAR]['colortext'])){echo $data[SOCIAL_BL_PLUGIN_NAME_VAR]['colortext'];}else{ echo '#fff';}?>" />
        </div>
		</div>
	</div>

  <div class="form-group">
      <label for="BackgroundBar" class="col-sm-4 control-label SBLtitle" id="backgroundColor"></label>
      <div class="col-sm-6">
        <div >
          <input id="colorSelector_background" name="background" type="text" class="color-field" value="<?php if(!empty($data[SOCIAL_BL_PLUGIN_NAME_VAR]['background'])){echo $data[SOCIAL_BL_PLUGIN_NAME_VAR]['background'];}else{ echo '#fff';}?>" />
        </div>
    </div>
  </div>

	<div class="form-group">
		<label for="BackgroundBar" class="col-sm-4 control-label icon-label"><span><img width="32" height="32" src="<?php echo SOCIAL_BL_STATIC_URL; ?>images/Twitter.png"></span></label>
	    <div class="col-sm-6">
			<input type="text" class="form-control" placeholder="https://twitter.com/username" name="data[<?php echo SOCIAL_BL_PLUGIN_NAME_VAR; ?>][url_twitter]" value="<?php echo $data[SOCIAL_BL_PLUGIN_NAME_VAR]['url_twitter'];?>">
		</div>
	</div>

  <div class="form-group">
    <label for="BackgroundBar" class="col-sm-4 control-label icon-label"><span><img width="32" height="32" src="<?php echo SOCIAL_BL_STATIC_URL; ?>images/Facebook.png"></span></label>
      <div class="col-sm-6">
      <input type="text" class="form-control" placeholder="https://facebook.com/username" name="data[<?php echo SOCIAL_BL_PLUGIN_NAME_VAR; ?>][url_facebook]" value="<?php if(!empty($data[SOCIAL_BL_PLUGIN_NAME_VAR]['url_facebook'])) echo $data[SOCIAL_BL_PLUGIN_NAME_VAR]['url_facebook'];?>">
    </div>
  </div>

	<div class="form-group">
		<label for="BackgroundBar" class="col-sm-4 control-label SBLtitle" id="status"></label>
		<div class="col-sm-6">
		<div id="active-switch" class="make-switch" data-on="success" data-off="warning">
		    <input type="checkbox" name="data[<?php echo SOCIAL_BL_PLUGIN_NAME_VAR; ?>][active]" <?php if(!empty($data[SOCIAL_BL_PLUGIN_NAME_VAR]["active"])){ ?>checked<?php }?> value="1">
		</div>
		</div>
	</div>

	<div class="form-group">
		<label for="BackgroundBar" class="col-sm-4 control-label"></label>
		<div class="col-sm-6">
	    <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Guardar Cambios">
		</div>
	</div>
</form>
</div>
