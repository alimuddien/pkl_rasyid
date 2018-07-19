<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	var $base_url_site = "";
	var $user_logged_level = "";
	var $cms_title = "";
	var $cms_active_config = array();
	var $date_now = "";
	function __construct(){
		parent::__construct();
		$this->load->library("breadcrumbs");
		$this->base_url_site = base_url();
		$this->_check_language();
	}
	
	public function _render($template,$cnf = array()){
		$this->_checkValidateUser();
		$template = (isset($cnf['template'])) ? $cnf['template'] : 'template/default';
		
        //loop for css custom file
        $css_script = '';
        if (isset($cnf['custom_css']) && is_array($cnf['custom_css']))
        {
            foreach ($cnf['custom_css'] as $val)
            {
                $css_script .= "<link rel=\"stylesheet\" href=\"" . $val . "\" />\n\t";
            }
        }
        else
        {
            $css_script = isset($cnf['custom_css']) ? isset($cnf['custom_css']) : '';
        }
        //end loop
        //loop for js custom file
        $js_script = '';
        if (isset($cnf['custom_js']) && is_array($cnf['custom_js']))
        {
            foreach ($cnf['custom_js'] as $val)
            {
                $js_script .= "<script type=\"text/javascript\" src=\"" . $val . "\"></script>\n\t\t";
            }
        }
        else
        {
            $js_script = isset($cnf['custom_js']) ? isset($cnf['custom_js']) : '';
        }
        //end loop
        
        $meta_refresh = '1800';
        if(isset($cnf['meta_refresh'])){
            $meta_refresh = '<meta http-equiv="Refresh" content="'.$cnf['meta_refresh'].'" />';
        }

        $subCat = (isset($cnf['sub_categori'])) ? $cnf['sub_categori'] : '';
        // set expire
        $my_time = time();
        $expired_header = gmdate('D, d M Y H:i:s', $my_time + 120) . " GMT";
		
		$company = 'Technobit.id';
        $dt = array(
            'meta_title' => isset($cnf['title']) ? $cnf['title'] : $site_name,
            'description' => isset($cnf['description']) ? $cnf['description'] : '',
            'keywords' => isset($cnf['keywords']) ? $cnf['keywords'] : '',
            'url' => isset($cnf['url']) ? $cnf['url'] : '',
            'og_image' => isset($cnf['og_image']) ? $cnf['og_image'] : '',
            'meta_refresh' => $meta_refresh,
            'expires' => '',
			'header_title' => (isset($cnf['header'])) ? $cnf['header'] : '', 
            'custom_css' => $css_script,
			'assets_css_url' => ASSETS_CSS_URL,
			'assets_js_url' => ASSETS_JS_URL,
			'assets_image_url' => ASSETS_IMAGE_URL,
            'custom_js' => $js_script,
			'base_url_admin' => $this->base_url_site,
            'main_content' => (isset($cnf['container'])) ? $cnf['container'] : '',
			"top_navbar" => $this->_get_header_nav(),
			"side_navbar" => $this->_get_sidebar_nav(),
			"main_footer" => $this->_get_footer(),
        );
		$this->load->view($template,$dt);
	}
	public function _render_antrian($template,$cnf = array()){
		$template = (isset($cnf['template'])) ? $cnf['template'] : 'template/default_antrian';
        //loop for css custom file
        $css_script = '';
        if (isset($cnf['custom_css']) && is_array($cnf['custom_css']))
        {
            foreach ($cnf['custom_css'] as $val)
            {
                $css_script .= "<link rel=\"stylesheet\" href=\"" . $val . "\" />\n\t";
            }
        }
        else
        {
            $css_script = isset($cnf['custom_css']) ? isset($cnf['custom_css']) : '';
        }
        //end loop
        //loop for js custom file
        $js_script = '';
        if (isset($cnf['custom_js']) && is_array($cnf['custom_js']))
        {
            foreach ($cnf['custom_js'] as $val)
            {
                $js_script .= "<script type=\"text/javascript\" src=\"" . $val . "\"></script>\n\t\t";
            }
        }
        else
        {
            $js_script = isset($cnf['custom_js']) ? isset($cnf['custom_js']) : '';
        }
        //end loop
		/// Cek Apakah Menu Dapat Diakses Atau TIdak
		$main_content = (isset($cnf['container'])) ? $cnf['container'] : '';
        $meta_refresh = '1800';
        if(isset($cnf['meta_refresh'])){
            $meta_refresh = '<meta http-equiv="Refresh" content="'.$cnf['meta_refresh'].'" />';
        }
		$site_name = "eMedica";

        $subCat = (isset($cnf['sub_categori'])) ? $cnf['sub_categori'] : '';
        // set expire
        $my_time = time();
        $expired_header = gmdate('D, d M Y H:i:s', $my_time + 120) . " GMT";
		$company = 'Technobit.id';
        $dt = array(
            'meta_title' => isset($cnf['title']) ? $cnf['title'] : $site_name,
			'header_title' => (isset($cnf['header'])) ? $cnf['header'] : '', 
            'custom_css' => $css_script,
			'assets_css_url' => ASSETS_CSS_URL,
			'assets_js_url' => ASSETS_JS_URL,
			'assets_image_url' => ASSETS_IMAGE_URL,
            'custom_js' => $js_script,
			'base_url_admin' => $this->base_url_site,
            'main_content' => $main_content,
			"top_navbar" => $this->_get_header_antrian(),
			"side_navbar" => $this->_get_sidebar_nav(),
			"main_footer" => $this->_get_footer(),
			"logo" => ASSETS_URL."img/emedica_white.png"
        );
		$this->load->view($template,$dt);
	}

	private function _get_header_antrian(){
		$menu = array(
			"logo" => LOGO_URL
		);
		$ret = $this->load->view("template/navbar/topbar_antrian" , $menu , true);
		return $ret;
	}

	private function _get_header_nav(){
		$menu = array();
		$menu['username'] = $this->session->userdata("pcw_username");
		$menu["useremail"] = $this->session->userdata("pcw_email");
//		$menu["logout_link"] = $this->base_url_site."logout/";
		$menu["link_edit_profil"] = $this->base_url_site."user/edit/".$this->session->userdata("pcw_is_staff_id");
		$menu["link_logout"] = base_url()."logout/";
		$ret = $this->load->view("template/navbar/topbar" , $menu , true);
		return $ret;
	}
	
	private function _get_sidebar_nav(){
		$menu = array();
		$submenuConfig = $this->config->item("submenu_nav");
		$subMenuDB = $this->session->userdata("pelayanan");
		$subLoket = $this->session->userdata("loket");
		
		foreach ($subMenuDB as $value) {
			$arrSubMenuDB["sub_klinik"]['sub_klinik_'.$value['intIDJenisPelayanan']] = array(
					  	"class" => $value['txtIcon'],
					  	"url" => "pelayanan/poliklinik/".$value['intIDJenisPelayanan'],
					  	"desc" => $value['txtSingkat'],
					  	"subsub_menu" => ''
				);
		}
		
		foreach ($subLoket as $value) {
			$icon = "";
			$idLoket = $value['intIDLoket'];
			if($idLoket == 1){
				$icon = "fa fa-credit-card";
			}elseif ($idLoket == 2) {
				$icon = "fa fa-random";
			}elseif ($idLoket == 3) {
				$icon = "fa fa-hospital";
			}else {
				$icon = "fa fa-folder";
			}
			$arrSubMenuLoket["sub_loket"]['sub_loket_'.$value['intIDLoket']] = array(
					  	"class" => $icon,
					  	"url" => "loket/antrian/".$value['intIDLoket'],
					  	"desc" => $value['txtLoket'],
					  	"subsub_menu" => ''
				);
		}
		$menu["sidebar_nav"] = $this->config->item("menu_nav");
		$menu["submenu_side"] = array_merge($submenuConfig,$arrSubMenuDB,$arrSubMenuLoket);
		$menu["subsubmenu_side"] =$this->config->item("subsubmenu_nav");
		$ret = $this->load->view("template/navbar/sidebar" , $menu , true);
		return $ret;
	}
	
	private function _get_footer(){
		$dt = array();
		$ret = $this->load->view("template/footer" , $dt , true);
		return $ret;
	}
	
	
	
	public function _build_pagination($base_url = "",$total =100, $per_page = 10, $query_string=TRUE,$url_string="&search="){
		
		$config_pagination['base_url'] = $base_url;
		$config_pagination['total_rows'] = $total;
		$config_pagination['per_page'] = $per_page;
		
		$config_pagination['page_query_string'] = $query_string;
		$config_pagination['query_string_segment'] = 'page';
		$config_pagination['suffix'] = $url_string;
		$config_pagination['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
		$config_pagination['full_tag_close'] = '</ul>';
		
		$config_pagination['next_tag_open'] = '<li>';
		$config_pagination['next_tag_close'] = '</li>';
		
		
		$config_pagination['use_page_numbers'] = TRUE;
		//$config_pagination['prefix'] = 'search';
		
		$config_pagination['prev_tag_open'] = '<li>';
		$config_pagination['prev_tag_close'] = '</li>';	
		
		$config_pagination['cur_tag_open'] = '<li class="active"><a href="#">';
		$config_pagination['cur_tag_close'] = '</li></a>';
		$config_pagination['num_tag_open'] = '<li>';
		$config_pagination['num_tag_close'] = '</li>';
		$config_pagination['first_tag_open'] = '';
		$config_pagination['first_link'] = '';
		$config_pagination['last_link'] = '';
		
		
		$this->pagination->initialize($config_pagination);
		$ret = $this->pagination->create_links();
		return $ret;
	}
	
	public function setBreadcrumbs($arrBreadcrumbs = array()){
		$res = "";
		foreach($arrBreadcrumbs as $label=>$url){
			$this->breadcrumbs->add($label , $url);
		}
		$res = $this->breadcrumbs->output();
		return $res;
	}
	
	public function _checkValidateUser(){
		$base_url = base_url();
		$login = base_url()."login/";
		if(!isset($_SESSION["user_validated"])){
			redirect($login);
		}
	}
	
	private function _check_language(){
		$lang = $this->session->userdata("pcw_user_language");
		if($lang=="ID"){
			$this->lang->load('id_site', 'id');
		}else{
			$this->lang->load('en_site', 'en');
		}
	}
	public function isAjaxRequest(){
		if(!$this->input->is_ajax_request()){
		
			echo "Ilegal";
			die;	
		}
	}
	public function setJsonOutput($response){
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}
}
