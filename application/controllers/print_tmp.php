<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

//TODO rename and integrate this class
// Need to change: Line 20, 30, 32; need to verify (optional): Line 17

class Print_tmp extends CI_Controller {
	function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$template_data = NULL; //array()
		$body_page = NULL;
		$token_stl = $this->input->get('stl');
		
		$this->load->library('parser');
// 		$this->lang->load('apiv1', $this->config->item('language'));
		
		$template_data = array(
				'back'					=> t('back'),
				'rendering_pagetitle'	=> t('rendering_pagetitle'),
				'preview_title'			=> t('preview_title'),
				'reset_model_button'	=> t('reset_model_button'),
				'request_button'		=> t('request_button'),
				'msg_webgl_failed'		=> t('msg_webgl_failed'),
				'msg_fetch_failed'		=> t('msg_fetch_failed'),
				'rendering_stl_url'		=> '/print_tmp/fetchstl_ajax?token=' . $token_stl,
		);
		$body_page = $this->parser->parse('/apiv1/zim_rendering', $template_data, TRUE);
		
		$this->parser->parse('basetemplate', array('body_content' => $body_page));
		
		return;
	}
	
	public function fetchstl_ajax() {
		$data_stl = NULL;
		$token_stl = $this->input->get('token');
		$azure_url = 'https://zeepro.blob.core.windows.net/printstlapi/STL' . $token_stl . '.stl';
		
		// curl part
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $azure_url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($curl, CURLOPT_HEADER, FALSE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($curl, CURLOPT_CAINFO, getcwd() . "/BaltimoreCyberTrustRoot.crt");
		$data_stl = curl_exec($curl);
		curl_close($curl);
		
		// force download
		if ($data_stl != FALSE) {
			$this->load->helper('download');
			force_download('rendering.stl', $data_stl);
		}
		else {
			$this->output->set_status_header(404);
		}
		
		return;
	}
}