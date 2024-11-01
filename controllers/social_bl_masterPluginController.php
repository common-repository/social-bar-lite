<?php

	class social_bl_masterPluginController extends social_bl_appController {


		var $twitter_validation = "^(http|https):\/\/(www.|)twitter.com\/\w*(\/|)$";
		var $facebook_validation = "^(http|https):\/\/(www.|)facebook.com\/\w*(\/|)$";

		/* -------- Constructor ------ */

		public function __construct(){
			parent::__construct();
		}


		public function social_bl_showBar(){

                $data = $this->data->social_bl_getSettings();

                if(isset($data[SOCIAL_BL_PLUGIN_NAME_VAR]['active'])){
                        $this->social_bl_set('data',$data);
                        $this->social_bl_loadView('showbar',false);
                }
         }

        public function social_bl_showBarCss(){
					$data = $this->data->social_bl_getSettings();
      		wp_register_style( 'social_bl_css', SOCIAL_BL_STATIC_URL . 'css/sbd-styles.css', array(), '', 'screen' );
					wp_enqueue_style( 'social_bl_css' );
					if (isset($data[SOCIAL_BL_PLUGIN_NAME_VAR]['background'])) {
						$color_background = $data[SOCIAL_BL_PLUGIN_NAME_VAR]['background'];
	        	$custom_css = "
	                	.floatsocialbar{
	                        background-color: {$color_background};
	                	}";
	        	wp_add_inline_style( 'social_bl_css', $custom_css );
					}
					if(isset($data[SOCIAL_BL_PLUGIN_NAME_VAR]['colortext'])){
							$color_text = $data[SOCIAL_BL_PLUGIN_NAME_VAR]['colortext'];
							$custom_css_text = "
		                	.floatsocialbar .message{
		                        color: {$color_text};
		                	}";
		        	wp_add_inline_style( 'social_bl_css', $custom_css_text );
					}
				}

        public function social_bl_showBarJs(){
					$data = $this->data->social_bl_getSettings();
						wp_register_script('social_bl_js', SOCIAL_BL_STATIC_URL.'js/sbd-functions.js', array('jquery'), false);
						wp_enqueue_script('social_bl_js');

						wp_register_script('social_bl_js_twitter', SOCIAL_BL_STATIC_URL.'js/twitter.js', array('jquery'), false);
						wp_enqueue_script('social_bl_js_twitter');
						if($data[SOCIAL_BL_PLUGIN_NAME_VAR]['language'] === 'english')
						wp_register_script('social_bl_js_facebook', SOCIAL_BL_STATIC_URL.'js/countrys/facebook-en.js', array('jquery'), '1.0.1', false);
						if($data[SOCIAL_BL_PLUGIN_NAME_VAR]['language'] === 'spanish')
							wp_register_script('social_bl_js_facebook', SOCIAL_BL_STATIC_URL.'js/countrys/facebook-es.js', array('jquery'), '1.0.1', false);
						wp_enqueue_script('social_bl_js_facebook');
				}

			public function social_bl_validateSettings($data){

			$swvalidate = array('valid' => true, 'msg' => '');

			if(!empty($data)){

				if(!$data[SOCIAL_BL_PLUGIN_NAME_VAR]['url_twitter'] && !$data[SOCIAL_BL_PLUGIN_NAME_VAR]['url_facebook'] ){
					$swvalidate['valid'] = false;
					if ($data[SOCIAL_BL_PLUGIN_NAME_VAR]['language'] == 'english') {
						$swvalidate['msg'] = "Error, please enter a URL for Twitter or Facebook";
					}else{
						$swvalidate['msg']="Debe ingresar una URL de Twitter o Facebook";
					}
				}else{
					if ($data[SOCIAL_BL_PLUGIN_NAME_VAR]['url_twitter']) {
						if (!preg_match('/'.$this->twitter_validation.'/', $data[SOCIAL_BL_PLUGIN_NAME_VAR]['url_twitter'])) {
									$swvalidate['valid'] = false;
									if ($data[SOCIAL_BL_PLUGIN_NAME_VAR]['language'] == 'english') {
										$swvalidate['msg'] = "Error, twitter URL not valid";
									}else{
		       					$swvalidate['msg']="La URL de Twitter no es válida";
									}
						}
					}
					if ($data[SOCIAL_BL_PLUGIN_NAME_VAR]['url_facebook']) {
						if (!preg_match('/'.$this->facebook_validation.'/', $data[SOCIAL_BL_PLUGIN_NAME_VAR]['url_facebook'])) {
							$swvalidate['valid'] = false;
							if ($data[SOCIAL_BL_PLUGIN_NAME_VAR]['language'] == 'english') {
								$swvalidate['msg'] = "Error, Facebook URL not valid";
							}else{
								$swvalidate['msg']="La URL de Facebook no es válida";
							}
						}
					}
	       }
				if(!$data[SOCIAL_BL_PLUGIN_NAME_VAR]['message']){
	       			$swvalidate['valid'] = false;
							if ($data[SOCIAL_BL_PLUGIN_NAME_VAR]['language'] == 'english') {
								$swvalidate['msg'] = "Error, you must enter a message";
							}else{
	       				$swvalidate['msg']="El mensaje de la barra no puede estar vacío";
							}
	        }

			}else{
				$swvalidate['valid'] = false;
				if ($data[SOCIAL_BL_PLUGIN_NAME_VAR]['language'] == 'english') {
					$swvalidate['msg'] = "Error, please complete all the fields";
				}else{
					$swvalidate['msg']="Ingrese los campos correspondientes por favor";
				}
			}
        return $swvalidate;

		}

		public function social_bl_saveSettings($data){

			$swv = $this->social_bl_validateSettings($data);
			$good = $swv['msg'];

	        if($swv['valid']===true){
				$good = true;
	        	$this->data->social_bl_updateSettings($data);
	    	}
			return $good;
		}

		public function social_bl_init(){

			$title_module = "Social Bar Lite Settings";
			$this->social_bl_set('title_module',$title_module);
			$msgtype="danger";
			$msg = "";
			if($_POST){
				if ( ! isset( $_POST['settings_for_socialbarlite'] )  || ! wp_verify_nonce( $_POST['settings_for_socialbarlite'], 'post_settings_for_socialbarlite' ) ){
					if ($data[SOCIAL_BL_PLUGIN_NAME_VAR]['language'] == 'english') {
						$msg = "Error, token mismatch.";
					}else{
						$msg = "Error, el token de seguridad no coincide.";
					}
						$data = $this->data->social_bl_getSettings();
				}else{
					if ( current_user_can( 'administrator' ) ) {
						$data = $_POST['data'];
						if(!empty($data)){
							$data[SOCIAL_BL_PLUGIN_NAME_VAR]['colortext'] =  $_POST['colortext'];
							$data[SOCIAL_BL_PLUGIN_NAME_VAR]['background'] =  $_POST['background'];
						//	print_r($data);
							$saved = $this->social_bl_saveSettings($data);
							if($saved === true){
								$msgtype="success";
								if ($data[SOCIAL_BL_PLUGIN_NAME_VAR]['language'] == 'english') {
									$msg = "Changes saved!";
								}else{
									$msg = 'Cambios Guardados!';
								}
							}else{
								$msg = $saved;
							}
						}
					}else{
						if ($data[SOCIAL_BL_PLUGIN_NAME_VAR]['language'] == 'english') {
							$msg = "Error, you must be admin to make this changes";
						}else{
							$msg = "Error, debes ser administrator para ejecutar estos cambios";
						}

						$data = $this->data->social_bl_getSettings();
					}
				}
			}else{
				$data = $this->data->social_bl_getSettings();
			}

			$this->social_bl_set('data',$data);

			$this->social_bl_set('msgtype',$msgtype);
			$this->social_bl_set('msg',$msg);

			$this->social_bl_loadView('settings');

		}

	}
