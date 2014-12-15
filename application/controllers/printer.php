<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');x

class Printer extends CI_Controller
{
	public function index()
	{
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
		
        $body = $this->load->view('Printer/index', array("printers" => $printers), true);
        $template_data = array('body_content'	=> $body,
								'connected'		=> t('connected'),
								'back'			=> t('back'));
        $this->parser->parse('basetemplate', $template_data);
	}
}