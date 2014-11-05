<?php

class User extends CI_Controller
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
		
        $body = $this->load->view('User/index', array("printers" => $printers), true);
		
		$template_data = array('body_content'	=> $body,
								'signout'		=> t('signout'),
								'connected'		=> t('connected'),
								'change_pass'	=> t('change_pass'));
		$this->parser->parse('basetemplate', $template_data);
	}
	
	public function signup()
	{
		$this->lang->load('user', $this->config->item('language'));

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
		$template_data = array('body_content'	=> $this->parser->parse("User/signup", array(), true),
								'signup'		=> t('signup'),
								'signup_text'	=> t('signup_text'),
								'show_password'	=> t('show_password'),
								'back'			=> t('back'));
        $this->parser->parse('basetemplate', $template_data);
	}
	
	public function confirm_signup()
    {
		$this->lang->load('user', $this->config->item('language'));

		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('confirm_code', 'Confirmation code', 'required|numeric|exact_length[4]');
			if ($this->form_validation->run())
			{
				extract($_POST);
				$tab = array('email' => $this->session->userdata('email'), 'code' => $confirm_code);
				$curl = curl_init();
				curl_setopt($curl, CURLOPT_URL, "https://sso.zeepro.com/confirmaccount.ashx");
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
				curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
				curl_setopt($curl, CURLOPT_CAINFO, getcwd() . "/StartComCertificationAuthority.crt");
				curl_setopt($curl, CURLOPT_POST, 2);
				curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($tab));
				curl_exec($curl);
				$code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
				if ($code == 200)
				{
					echo "<script>
							alert('". t('create_success') ."');
							setTimeout(\"window.location.href = '/user';\", 500);
						</script>";
				}
			}
		}
		$template_data = array('body_content' => $this->parser->parse("User/confirm_signup", array(), true));
        $this->parser->parse('basetemplate', $template_data);
	}

	public function change_password()
	{
		$this->lang->load('user', $this->config->item('language'));
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('old_pass', 'Old password', 'required');
			$this->form_validation->set_rules('new_pass', 'New password',
										'required|matches[confirm_pass]');
			$this->form_validation->set_rules('confirm_pass', 'Password confirmation', 'required');
			if ($this->form_validation->run())
			{
				extract($_POST);
				$tab = array("email" => $this->session->userdata('email'),
							"old_password" => $old_pass,
							"new_password" => $new_pass);
				$curl = curl_init();
				curl_setopt($curl, CURLOPT_URL, "https://sso.zeepro.com/changepassword.ashx");
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
				curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
				curl_setopt($curl, CURLOPT_CAINFO, getcwd() . "/StartComCertificationAuthority.crt");
				curl_setopt($curl, CURLOPT_POST, 3);
				curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($tab));
				curl_exec($curl);
				$code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
				curl_close($curl);
				if ($code == 200)
				{
					$this->session->set_userdata('password', $new_pass);
					echo "<script type='text/javascript'>
							alert('" . t('pass_change_success') . "');
							setTimeout(\"window.location.href = '/user';\", 500);
						</script>";
				}
			}
		}
		$template_data = array('body_content'	=> $this->parser->parse("User/change_password", array(), true),
								'submit_change'	=> t('submit_change'),
								'show_password'	=> t('show_password'),
								'back'			=> t('back'));
        $this->parser->parse('basetemplate', $template_data);
	}
}