<?php 
	/**
	 * 
	 */
	class Template
	{
		protected $ci ;
		function __construct()
		{
			$this->ci =& get_instance();
		}
		private function _meta($vars =''){
			if($vars == null){
				return $this->ci->load->view("tpl/meta_null",$vars,true);
			}else{
				return $this->ci->load->view("tpl/meta",$vars,true);
			}
		}
		private function _css($vars=''){
			return $this->ci->load->view("tpl/css",$vars,true);
		}
		private function _js($vars=''){
			return $this->ci->load->view('tpl/js',$vars,true);
		}
		private function _footer($vars=''){
			return $this->ci->load->view("tpl/footer",$vars,true);
		}
		private function _body($vars=''){
			$load = [
				'body' => $vars,
			];
			return $this->ci->load->view("tpl/body",$load,true);
		}
		private function _menu($vars=''){
			return $this->ci->load->view("tpl/menu",$vars,true);
		}

		public function output($vars)
		{
			$load = [
				'meta'   => $this->_meta($vars),
				'body'   => $this->_body($vars),
				'css'    => $this->_css($vars),
				'js'     => $this->_js($vars),
				'footer' => $this->_footer($vars),
				'menu'	 => $this->_menu($vars),
			];
			echo $this->ci->load->view("tpl/page",$load,true);
		}

	}