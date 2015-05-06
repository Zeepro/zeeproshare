<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Threedslash extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

	}

	public function index()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			if (isset($_POST['name']) &&
				isset($_POST['depth']) &&
				isset($_POST['token']) &&
				isset($_POST['userid'])) {
				$this->session->set_userdata('3dslash_name', $_POST['name']);
				$this->session->set_userdata('3dslash_depth', $_POST['depth']);
				$this->session->set_userdata('3dslash_token', $_POST['token']);
				$this->session->set_userdata('3dslash_userid', $_POST['userid']);
				if ($this->session->userdata('logged_in') == false) {
					$this->output->set_header("Location: /login?url=" . urlencode("/3dslash"));
					return;
				}
			} else {
				$this->output->set_header("Location: /login");
				return;
			}
		} else {
			if (!($this->session->userdata('3dslash_name') &&
				$this->session->userdata('3dslash_depth') &&
				$this->session->userdata('3dslash_token') &&
				$this->session->userdata('3dslash_userid'))) {
// 				$this->output->set_header("Location: /login");
				echo "<!DOCTYPE html><html xmlns=\"http://www.w3.org/1999/xhtml\"><head><meta http-equiv=Content-Type content=\"text/html; charset=utf-8\" /><title></title></head>" .
						"<body><form  method=\"post\" action=\"/3dslash\" accept-charset=utf-8\">" .
						"name <input id=\"name\" name=\"name\" type=\"text\" /><br />" .
						"depth <input id=\"depth\" name=\"depth\" type=\"text\" /><br />" .
						"token <input id=\"token\" name=\"token\" type=\"text\" /><br />" .
						"userid <input id=\"userid\" name=\"userid\" type=\"text\" /><br />" .
						"<input id=\"Submit1\" type=\"submit\" value=\"Ok\" /></form></body></html>";
				return;
			}
		}			
		
		$this->lang->load('user', $this->config->item('language'));
		
		$tab = array("email" => $this->session->userdata('email'),
					"password" => $this->session->userdata('password'));
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, "https://sso.zeepro.com/listprinter.ashx");
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($curl, CURLOPT_CAINFO, getcwd() . "/StartComCertificationAuthority.crt");
		curl_setopt($curl, CURLOPT_POST, 2);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($tab));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		$output = curl_exec($curl);
		curl_close($curl);
		
		$printers = json_decode($output);

		if ($printers != NULL) {
			$title = t('select');
			foreach ($printers as $printer)
				$printer->remote_token = json_encode(array('token' => $printer->token, 'user' => '', 'redirection' => json_encode(array('url' => '/3dslash', 'parameter' => json_encode(array('name' => $this->session->userdata('3dslash_name'), 'token' => $this->session->userdata('3dslash_token')))))));
		} else
			$title = t('no_printer');
				
        $body = $this->load->view('3dslash/index', array("printers" => $printers, "user_token" => $this->session->userdata('user_token')), true);
		
// 		if (count($printer) == 1)
// 			$body = $this->load->view('3dslash/index', array("printers" => $printers), true);
// 		else
// 			$body = $this->load->view('3dslash/index', array("printers" => $printers), true);

		$template_data = array('body_content'	=> $body,
				'signout'		=> t('signout'),
				'connected'		=> $title,
				'change_pass'	=> t('change_pass'));
		
		$this->parser->parse('basetemplate', $template_data);
		}
}