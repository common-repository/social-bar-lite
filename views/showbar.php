<div align="center" class="floatsocialbar">
<div class="contentbar">
<div class="message"><?php echo $data[SOCIAL_BL_PLUGIN_NAME_VAR]['message']; ?></div>

<?php if(!empty($data[SOCIAL_BL_PLUGIN_NAME_VAR]['url_twitter'])) { ?>
<div class="fsb">
  <a href="<?php echo $data[SOCIAL_BL_PLUGIN_NAME_VAR]['url_twitter']; ?>" class="twitter-follow-button" data-lang="<?php if($data[SOCIAL_BL_PLUGIN_NAME_VAR]['language'] === 'spanish'){echo "es";}else{ echo "en";} ?>" data-show-count="false" data-show-screen-name="false">Follow</a>
</div>
<?php } ?>
<?php if(!empty($data[SOCIAL_BL_PLUGIN_NAME_VAR]['url_facebook'])) { ?>
<div class="fsb facebook">
  <div class="fb-like" data-href="<?php echo $data[SOCIAL_BL_PLUGIN_NAME_VAR]['url_facebook']; ?>" data-layout="button" data-action="like" data-show-faces="false" data-share="false"></div>
</div>
<?php } ?>

<div class="close-sidebar" align="right">
  <a class="image-close-sidebar"></a>
</div>
<div class="clear"></div>
</div>
</div>
