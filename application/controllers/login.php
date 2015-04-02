<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

define('HTTP_OK', 202);

class Login extends CI_Controller
{
	public function index()
    {
		$template_data = array();
		$template_data['custom_error'] = "";
		$this->lang->load('login', $this->config->item('language'));
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'required');
			if ($this->form_validation->run()) {
				extract($_POST);
				if($remember) {
					$three_months = time() + 7776000;
					setcookie('remember_me_home_zeepro', $email . ':' . $password, $three_months, '/');
				} else if (!$remember && isset($_COOKIE['remember_me_home_zeepro'])) {
					unset($_COOKIE['remember_me_home_zeepro']);
					$past = time() - 100;
					setcookie('remember_me_home_zeepro', null, $past, '/');
				}
				if ($optin)
					$optin = "on";
				else
					$optin = "off";
				$tab = array("email" => $email, "password" => $password, "optin" => $optin);
				$curl = curl_init();
				curl_setopt($curl, CURLOPT_URL, "https://sso.zeepro.com/login.ashx");
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
				curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
				curl_setopt($curl, CURLOPT_CAINFO, getcwd() . "/StartComCertificationAuthority.crt");
				curl_setopt($curl, CURLOPT_POST, 2);
				curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($tab));
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
				$result = curl_exec($curl);
				$output = curl_getinfo($curl, CURLINFO_HTTP_CODE);
				curl_close($curl);
				if ($output == HTTP_OK)
				{
					$result_array = json_decode($result, TRUE);
					$custom_data = array('email' => $email,
										'logged_in' => true,
										'password' => $password,
										'user_token' => $result_array["token_id"]);
					$this->session->set_userdata($custom_data);
					if (isset($_GET['url'])) {
						$this->output->set_header("Location: https://zeeproshare.com" . $_GET['url']);
					}else {
						$this->output->set_header("Location: /user");
					}
					return ;
				}
				else if ($output == 434) //Wrong parameter
				{
					$template_data['custom_error'] = t("custom_error");
				}
			}
		}
		
		
		$template_data['optin'] = 'checked';
		if (isset ( $_COOKIE ['remember_me_home_zeepro'] )) {
			$cred = explode ( ':', $_COOKIE ['remember_me_home_zeepro'] );
			if (count($cred) >= 2) {
				$tab = array("email" => $cred[0], "password" => $cred[1]);
				$curl = curl_init();
				curl_setopt($curl, CURLOPT_URL, "https://sso.zeepro.com/optin.ashx");
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
				curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
				curl_setopt($curl, CURLOPT_CAINFO, getcwd() . "/StartComCertificationAuthority.crt");
				curl_setopt($curl, CURLOPT_POST, 2);
				curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($tab));
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
				$result = curl_exec($curl);
				$output = curl_getinfo($curl, CURLINFO_HTTP_CODE);
				curl_close($curl);
				if ($output == 200) {
					$result_array = json_decode($result, TRUE);
					if ($result_array["optin"] == "off")
						$template_data['optin'] = "";
				}
			}
		}
				
		$body_content = $this->parser->parse('Login/index', $template_data, TRUE);
        $template_data['body_content'] = $body_content;
		$template_data['zeepro_account'] = t("zeepro_account");
		$template_data['email'] = t("email");
		$template_data['password'] = t("password");
		$template_data['show_password'] = t("show_password");
		$template_data['remember_box'] = t("remember_box");
		$template_data['newsletter_box'] = t("newsletter_box");
		$template_data['create'] = t("create");
		$template_data['signup'] = t("signup");
		$template_data['forgot_pass'] = t("forgot_pass");
		$template_data['privacy_policy_link'] = t("privacy_policy_link");
		$template_data['apply_text'] = t("apply_text");
		$template_data['zim_owner'] = t("zim_owner");
		$template_data['apply'] = t("apply");
		$this->parser->parse('basetemplate', $template_data);
	}

    public function forgot_pass()
    {
		$this->lang->load('login', $this->config->item('language'));
        
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			if ($this->form_validation->run())
			{
				extract($_POST);
				$curl = curl_init();
				curl_setopt($curl, CURLOPT_URL, 'https://sso.zeepro.com/sendpassword.ashx?email=' . $email);
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
				curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
				curl_setopt($curl, CURLOPT_CAINFO, getcwd() . "/StartComCertificationAuthority.crt");
				curl_exec($curl);
				$code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
				echo "<script>console.log(".$code.");</script>";
				curl_close($curl);
				if ($code == 200)
				{
					echo "<script>
							alert('".t('forgot_success')."');
							setTimeout(\"window.location.href = '/';\", 500);
						</script>";
				}
			}
		}
		$body_content = $this->parser->parse('Login/forgot_pass', array('reset_pass' => t('reset_pass')), TRUE);
        $template_data['body_content'] = $body_content;
        $this->parser->parse('basetemplate', $template_data);
    }

	public function disconnect()
	{
		$this->session->set_userdata('logged_in', FALSE);
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('password');
		redirect("/");
	}
	
	public function privacy()
	{
		$this->lang->load('privacy', $this->config->item('language'));

		$template_data = array('body_content'	=> $this->parser->parse("Login/privacy", array(), true),
								'privacy_policy'=> t('privacy_policy'),
								'back'			=> t('back')
								);
        $this->parser->parse('basetemplate', $template_data);
	}
}