<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Share extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

	}

	public function index()
	{
		if ($this->session->userdata('logged_in') == false)
		{
			$this->output->set_header("Location: /login");
			return;
		}
		$this->lang->load('share', $this->config->item('language'));
		
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'required|matches[confirm]');
			$this->form_validation->set_rules('confirm', 'Password confirmation', 'required');
			if ($this->form_validation->run())
			{
				extract($_POST);
				$tab = array("email" => $email, "password" => $password);
				$curl = curl_init();
				curl_setopt($curl, CURLOPT_URL, "https://sso.zeepro.com/createaccount.ashx");
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
				curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
				curl_setopt($curl, CURLOPT_CAINFO, getcwd() . "/StartComCertificationAuthority.crt");
				curl_setopt($curl, CURLOPT_POST, 2);
				curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($tab));
				curl_exec($curl);
				$code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
				curl_close($curl);
				if ($code == 200)
				{
					$this->session->set_userdata('email', $email);
					redirect("/user/confirm_signup");
				}
			}
		}
		$template_data = array('body_content'	=> $this->parser->parse("share/index", array(), true),
								'tellus'		=> t('tellus'),
								'description'		=> t('description'),
								'attach'		=> t('attach'),
								'submit'		=> t('submit'));
        $this->parser->parse('basetemplate', $template_data);
	}
}