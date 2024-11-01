<?php

	class social_bl_dataPlugin extends social_bl_appModel {

		/* -------- Constructor ------ */

		public function __construct(){
			parent::__construct();
		}


		function social_bl_updateSettings($conf) {
			update_option(SOCIAL_BL_PLUGIN_NAME_VAR."_config", $conf);
		}

		function social_bl_getSettings() {
			$conf = get_option(SOCIAL_BL_PLUGIN_NAME_VAR."_config");
			return $conf;
		}

	}
