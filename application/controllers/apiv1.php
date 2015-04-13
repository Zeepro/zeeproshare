<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

use WindowsAzure\Common\ServicesBuilder;
use WindowsAzure\Blob\Models\CreateContainerOptions;
use WindowsAzure\Blob\Models\PublicAccessType;
use WindowsAzure\Common\ServiceException;

class apiv1 extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

	}

	public function printstl()
	{
		$this->load->helper('log');
		$this->lang->load('apiv1', $this->config->item('language'));
		
		$template_data = array();
		
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			if ($_FILES['stl']['error'] == UPLOAD_ERR_OK) { 			
				
				require_once "/application/third_party/WindowsAzure/WindowsAzure.php";
								
				$connectionString = "DefaultEndpointsProtocol=https;AccountName=zeepro;AccountKey=h+1YL4YpN64VfR21SUeWyfM2MyNZI9X08Cwi9WSFAjLnJAGDsxcRLsuQSGZX6Ibe3/VtJKUi7x9lvZOyI7RI+w==";
				$blobRestProxy = ServicesBuilder::getInstance()->createBlobService($connectionString);

				$content = fopen($_FILES["stl"]["tmp_name"], "r");
				$blob_name = "STL" . date("YmdHis") . substr("abcdefghijklmnopqrstuvwxyz0123456789", mt_rand(0, 35), 1) . substr(md5(microtime()), 1) . ".stl";
				try {
					$blobRestProxy->createBlockBlob("printstlapi", $blob_name, $content);
					
					if (!isset($_POST['return_type']) || $_POST['return_type'] == "plain_text") {
						$this->output
						->set_content_type('text/plain')
						->set_output('https://zeeproshare.com/apiv1/printr?i=' . $blob_name);
					} else if ($_POST['return_type'] == "json") {
						$this->output
						->set_content_type('application/json')
						->set_output(json_encode(array('url' => 'https://zeeproshare.com/apiv1/printr?i=' . $blob_name)));
					}  else if ($_POST['return_type'] == "xml") {
						$this->output
						->set_content_type('text/xml')
						->set_output("<?xml version='1.0' encoding='utf-8'?><redirection url=\"https://zeeproshare.com/apiv1/printr?i=" . $blob_name . "\"/>");
					}  else {
						$this->output
						->set_content_type('text/html')
						->set_output("<!DOCTYPE html><html><body onload=\"window.location='https://zeeproshare.com/apiv1/printr?i=" . $blob_name . "'\"></body></html>");
					}
					return;
				}
				catch(ServiceException $e){
//					ZLog("Error", $e->getCode(), $e->getMessage());
//					$error = t("error_blog");
					echo "Error:" . $e->getCode() . $e->getMessage();
					return;
				}

			} else {
				$this->output->set_header("Location: /login");
				return;
			}
		}

		$template_data['body_content'] = $this->load->view('apiv1/printstl', '', true);

		$this->parser->parse('basetemplate', $template_data);
	}
	
	public function printr()
	{
		if (!isset($_GET['i'])) {
			$this->output->set_header("Location: /user");
			return;
		}

//		if (sha1(substr($_GET['i'], 0, 12) . "") 
		
//		if ($this->session->userdata('logged_in') == false) {
//			$this->output->set_header("Location: /login?url=" . urlencode("/apiv1/printr?i=" . $_GET['i']));
//			return;
//		}

		$this->lang->load('apiv1', $this->config->item('language'));
		
		$template_data = array(
				'back'					=> t('back'),
				'rendering_pagetitle'	=> t('rendering_pagetitle'),
				'congratulation'		=> t('congratulation'),
				'reset_model_button'	=> t('reset_model_button'),
				'msg_webgl_failed'		=> t('msg_webgl_failed'),
				'msg_fetch_failed'		=> t('msg_fetch_failed'),
				'rendering_stl_url'		=> '/apiv1/fetchstl_ajax?token=' . $_GET['i'],
		);
		$body_page = $this->parser->parse('/apiv1/zim_rendering', $template_data, TRUE);
		
		$this->parser->parse('basetemplate', array('body_content' => $body_page));
	}
	
	public function fetchstl_ajax() {

		require_once "/application/third_party/WindowsAzure/WindowsAzure.php";
								
		$connectionString = "DefaultEndpointsProtocol=https;AccountName=zeepro;AccountKey=h+1YL4YpN64VfR21SUeWyfM2MyNZI9X08Cwi9WSFAjLnJAGDsxcRLsuQSGZX6Ibe3/VtJKUi7x9lvZOyI7RI+w==";
		
		
		try {
			$blobRestProxy = ServicesBuilder::getInstance()->createBlobService($connectionString);
			$blob = $blobRestProxy->getBlob("printstlapi", $this->input->get('token'));
			$this->load->helper('download');
			force_download('rendering.stl', stream_get_contents($blob->getContentStream()));
		}
		catch(ServiceException $e){
//			ZLog("Error", $e->getCode(), $e->getMessage());
//			$this->output->set_status_header(404);
			echo "Error:" . $e->getCode() . $e->getMessage();
		}
				
		return;
	}
	
	public function checkpear()
	{
		require_once 'System.php';
		var_dump(class_exists('System', false));
	}
}