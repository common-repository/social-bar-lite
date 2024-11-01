<?php

	class social_bl_appController{

		public $data;

		public $vars;

		/* -------- Constructor ------ */

		public function __construct(){
			$this->data = new social_bl_dataPlugin();
		}


		public function social_bl_set($namevar, $valuevar){
			$this->vars[$namevar] = $valuevar;
		}

		public function social_bl_loadView($view,$admin=true){

			foreach ($this->vars as $namevar => $valuevar) {
				$$namevar = $valuevar;
			}

			if($admin){

			wp_enqueue_style( 'stylesheet', SOCIAL_BL_STATIC_URL.'css/styles.css' );
			add_action( 'wp_enqueue_scripts', 'stylesheet' );
			include_once(SOCIAL_BL_ROOT_VIEWS.$view.'.php');
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( 'custom-script-handle', SOCIAL_BL_STATIC_URL.'js/functions.js', array( 'wp-color-picker'), false);
			add_action( 'admin_enqueue_scripts', 'wp-color-picker' );
			add_action( 'admin_enqueue_scripts', 'custom-script-handle' );

			}else{
				include_once(SOCIAL_BL_ROOT_VIEWS.$view.'.php');
			}

		}

	}
