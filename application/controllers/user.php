<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class User extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('errorcode');
	}

	public function index()
	{
		$this->load->helper('url');
		redirect('/user/v2');
		
		return;
		
// 		if ($this->session->userdata('logged_in') == false)
// 		{
// 			$this->output->set_header("Location: /login");
// 			return;
// 		}
// 		$this->lang->load('user', $this->config->item('language'));
		
// 		$tab = array("email" => $this->session->userdata('email'),
// 					"password" => $this->session->userdata('password'));
// 		$curl = curl_init();
// 		curl_setopt($curl, CURLOPT_URL, "https://sso.zeepro.com/listprinter.ashx");
// 		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
// 		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
// 		curl_setopt($curl, CURLOPT_CAINFO, getcwd() . "/StartComCertificationAuthority.crt");
// 		curl_setopt($curl, CURLOPT_POST, 2);
// 		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($tab));
// 		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
// 		$output = curl_exec($curl);
// 		curl_close($curl);
		
// 		$printers = json_decode($output);

// 		if ($printers != NULL)
// 			$title = t('connected');
// 		else
// 			$title = t('no_printer');
				
//         $body = $this->load->view('User/index', array( "printers" => $printers, "user_token" => $this->session->userdata('user_token')), true);
		
// 		$template_data = array('body_content'	=> $body,
// 								'signout'		=> t('signout'),
// 								'connected'		=> $title,
// 								'change_pass'	=> t('change_pass'));
// 		$this->parser->parse('basetemplate', $template_data);
	}
	
	public function v2() {
		// check whether login or not
		if ($this->session->userdata('logged_in') == false) {
			$this->output->set_header("Location: /login");
			return;
		}
		
		// get list of printer
		$tab = array(
				"email"		=> $this->session->userdata('email'),
				"password"	=> $this->session->userdata('password')
		);
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
		
		// decode printer list and start to treat data
		// prepare template data for display
		$printers = json_decode($output, TRUE);
		$nb_printer = count($printers);
		$printers_display = array();
		$upgrades_display = array();
		$printer_info = NULL; //array()
		
		$id_printer = 1;
		foreach ($printers as $printer) {
			$printer_info = array(
					'v1system'		=> 'true',
			); // empty array
			foreach (array(
					'token'			=> 'token',
					'URL'			=> 'rdv_url',
					'printername'	=> 'name',
					'localIP'		=> 'loc_ip',
			) as $check_key => $display_key) {
				$printer_info[$display_key] = (isset($printer[$check_key])) ? $printer[$check_key] : NULL;
			}
			$printer_info['id'] = $id_printer . '_' . rand();
			
			if (isset($printer['current_software'])) {
				$printer_info['v1system'] = 'false';
				
				if (isset($printer['next_software'])
						&& $printer['current_software'] != $printer['next_software']) {
					$upgrades_display[] = $printer_info;
				}
			}
			$printers_display[] = $printer_info;
			
			++$id_printer;
		}
		
		$this->lang->load('user', $this->config->item('language'));
		$template_data = array(
				'back'					=> t('back'),
				'user_token'			=> $this->session->userdata('user_token'),
// 				'user_multi_printer'	=> ($nb_printer > 1) ? 'true' : 'false',
				'user_nb_printer'		=> count($printers_display),
				'msg_no_printer'		=> t('msg_no_printer'),
				'mono_printer_token'	=> $printer_info['token'],
				'mono_printer_rdv_url'	=> $printer_info['rdv_url'],
				'mono_printer_name'		=> $printer_info['name'],
				'mono_printer_loc_ip'	=> $printer_info['loc_ip'],
				'mono_printer_v1system'	=> isset($printer_info['v1system']) ? $printer_info['v1system'] : 'true',
				'multi_printers'		=> $printers_display,
				'show_upgrade'			=> (count($upgrades_display) > 0) ? 'true' : 'false',
				'upgrades_display'		=> $upgrades_display,
				'msg_load_wait'			=> t('msg_load_wait'),
				'link_print'			=> t('link_print'),
				'link_config'			=> t('link_config'),
				'link_account'			=> t('link_account'),
				'msg_upgrade'			=> t('msg_upgrade'),
				'upgrade_title'			=> t('upgrade_title'),
				'link_news_more'		=> t('link_news_more'),
// 				'link_tutorial'			=> t('link_tutorial'),
// 				'link_faq'				=> t('link_faq'),
// 				'link_support'			=> t('link_support'),
				'link_printers'			=> t('link_printers'),
// 				'connected'				=> ($nb_printer ? t('connected') : t('no_printer')),
// 				'change_pass'			=> t('change_pass'),
				'areyousure'			=> t('areyousure', $this->session->userdata('email')),
				'yes'					=> t('yes'),
				'no'					=> t('no'),
				'news'					=> t('news'),
				'inspiration'			=> t('inspiration'),
				'myzeeproshare'			=> t('myzeeproshare'),
				'channels'				=> t('channels'),
				'share'					=> t('share'),
				'follow'				=> t('follow'),
				'store'					=> t('store'),
				'support'				=> t('support'),
		);
		$body = $this->parser->parse('user/v2', $template_data, TRUE);
		
// 		$body = $this->load->view('User/v2', array( "printers" => $printers, "user_token" => $this->session->userdata('user_token')), true);
		
		$this->parser->parse('basetemplate', array('body_content' => $body));
		
		return;
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
								'email'		=> t('email'),
								'password'		=> t('password'),
								'confirmpassword'		=> t('confirmpassword'),
								'signup'		=> t('signup'),
								'signup_text'	=> t('signup_text'),
								'privacy_policy_link'	=> t('privacy_policy_link'),
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
		if ($this->session->userdata('logged_in') == false)
		{
			$this->output->set_header("Location: /Login");
			return;
		}
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

	public function change_password_guest()
	{
		$this->lang->load('user', $this->config->item('language'));
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('old_pass', 'Old password', 'required');
			$this->form_validation->set_rules('new_pass', 'New password',
										'required|matches[confirm_pass]');
			$this->form_validation->set_rules('confirm_pass', 'Password confirmation', 'required');
			if ($this->form_validation->run())
			{
				extract($_POST);
				$tab = array("email" => $email,
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
		$template_data = array('body_content'	=> $this->parser->parse("User/change_password_guest", array(), true),
								'submit_change'	=> t('submit_change'),
								'show_password'	=> t('show_password'));
        $this->parser->parse('basetemplate', $template_data);
	}

	public function share()
	{
		if ($this->session->userdata('logged_in') == false)
		{
			$this->output->set_header("Location: /login");
			return;
		}
		$this->lang->load('user', $this->config->item('language'));
		
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			include_once "/application/third_party/swiftmailer-master/lib/swift_required.php";
			
			$subject = t("shareideas_email_subject");
			$from = array('zim@zeepro.com' => t("shareideas_email_alias"));
			$to = array(t("shareideas_email_address"));
			
			$transport = Swift_SmtpTransport::newInstance('smtp.mandrillapp.com', 587);
			$transport->setUsername('service-informatique@zee3dcompany.com');
			$transport->setPassword('uBXf9JhuFAg7FfeJVAVvkA');
			$swift = Swift_Mailer::newInstance($transport);
			
			$message = new Swift_Message($subject);
			$message->setFrom($from);
			$message->setTo($to);
			$message->setBody(str_replace("{email}", $this->session->userdata('email'), str_replace("{suggestion}", $_POST['description'], t("shareideas_email_html"))), 'text/html');
			
			if (isset($_FILES['file']['error']) && !is_array($_FILES['file']['error']) && $_FILES['file']['size'] > 0)
			{
				$message->attach(Swift_Attachment::fromPath($_FILES['file']['tmp_name'])->setFilename($_FILES['file']['name']));
			}
			
			$recipients = $swift->send($message, $failures);
			
			redirect("/user/v2");
		}
		$template_data = array('body_content' => $this->parser->parse("user/share", array(), true),
// 				'areyousure' => t('areyousure'),
// 				'yes' => t('yes'),
// 				'no' => t('no'),
				'tellus' => t('tellus'),
				'description' => t('description'),
				'description_placeholder' => t('description_placeholder'),
				'attach' => t('attach'),
				'submit' => t('submit'),
				'home'	=> t('home'),
				'back'	=> t('back'),
		);
        $this->parser->parse('basetemplate', $template_data);
	}

	public function follow()
	{
		if ($this->session->userdata('logged_in') == false)
		{
			$this->output->set_header("Location: /login");
			return;
		}
		$this->lang->load('user', $this->config->item('language'));
		
		$template_data = array('body_content' => $this->parser->parse("user/follow", array(), true),
// 				'areyousure' => t('areyousure'),
// 				'yes' => t('yes'),
// 				'no' => t('no'),
				'follow_us' => t('follow_us'),
				'facebook' => t('facebook'),
				'youtube' => t('youtube'),
				'pinterest' => t('pinterest'),
				'twitter' => t('twitter'),
				'googleplus' => t('googleplus'),
				'fancy' => t('fancy'),
				'home'		=> t('home'),
				'back'		=> t('back'),
				'instagram'	=> t('instagram'),
				'linkedin'	=> t('linkedin'),
		);
        $this->parser->parse('basetemplate', $template_data);
	}
	public function support()
	{
		if ($this->session->userdata('logged_in') == false)
		{
			$this->output->set_header("Location: /login");
			return;
		}
		$this->lang->load('user', $this->config->item('language'));
		
		$template_data = array('body_content' => $this->parser->parse("user/support", array(), true),
// 				'areyousure' => t('areyousure'),
// 				'yes' => t('yes'),
// 				'no' => t('no'),
				'home'					=> t('home'),
				'back'					=> t('back'),
				'how_load_cartridge'	=> t('how_load_cartridge'),
				'how_zeeproshare'		=> t('how_zeeproshare'),
				'how_init_setup'		=> t('how_init_setup'),
		);
        $this->parser->parse('basetemplate', $template_data);
	}
	
	public function support_menu() {
		$this->lang->load('user', $this->config->item('language'));
		
		$template_data = array(
				'body_content'	=> $this->parser->parse("user/support_menu", array(), true),
				'home'			=> t('home'),
				'back'			=> t('back'),
				'link_tutorial'	=> t('link_tutorial'),
				'link_faq'		=> t('link_faq'),
				'link_support'	=> t('link_support'),
		);
		$this->parser->parse('basetemplate', $template_data);
		
		return;
	}
	
	public function account() {
		$optin_news = FALSE;
		$optin_update = FALSE;
		$option_selected = 'selected';
		$error = NULL;
		$template_data = NULL; //array()
		$user_info = array();
		$assign_func = NULL; //function()
		$user_birth = NULL;
		$delete_account = $this->input->post('delete');
		$change_password = $this->input->post('change');
		$change_info = $this->input->post('info');
		
		if ($this->session->userdata('logged_in') == false) {
			$this->output->set_header("Location: /login");
			return;
		}
		
		$this->load->helper('ssouser');
		$this->lang->load('user', $this->config->item('language'));
		if ($change_info) {
			$this->load->library('form_validation');
			
// 			$this->form_validation->set_rules('user_country', 'lang:title_country', 'required');
// 			$this->form_validation->set_rules('user_city', 'lang:title_city', 'required');
// 			$this->form_validation->set_rules('user_birth', 'lang:title_birth', 'required');
			$this->form_validation->set_rules('user_why', 'lang:title_why', 'max_length[200]');
			$this->form_validation->set_rules('user_what', 'lang:title_what', 'max_length[200]');
			
			if ($this->form_validation->run() == FALSE) {
				$error = validation_errors();
			}
			else {
				$array_info = array();
				
				foreach (array(
						SSOUSER_TITLE_COUNTRY	=> 'user_country',
// 						SSOUSER_TITLE_CITY		=> 'user_city',
						SSOUSER_TITLE_BIRTHDAY	=> 'user_birth',
						SSOUSER_TITLE_WHY		=> 'user_why',
						SSOUSER_TITLE_WHAT		=> 'user_what',
				) as $key => $value) {
					$array_info[$key] = ($this->input->post($value) !== FALSE) ? $this->input->post($value) : "";
				}
				$array_info[SSOUSER_TITLE_CITY] = "";
				foreach (array('user_city_input', 'user_city') as $value) {
					if ($this->input->post($value) !== FALSE && strlen($this->input->post($value)) > 0) {
						$array_info[SSOUSER_TITLE_CITY] = $this->input->post($value);
						break;
					}
				}
				
				$ret_val = SSOUser_setUserInfo($array_info);
				
				switch ($ret_val) {
					case ERROR_OK:
						$this->output->set_header('Location: /user/account');
						
						return;
						break; // never reach here
						
					case ERROR_MISS_PRM:
					case ERROR_WRONG_PRM:
						$error = t('error_parameter');
						break;
						
					case ERROR_AUTHOR_USER:
						$error = t('error_authorize');
						break;
						
					default:
						$error = t('error_unknown');
						break;
				}
			}
		}
		else if ($change_password) {
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('old_pwd', 'lang:title_old_password', 'required');
			$this->form_validation->set_rules('new_pwd', 'lang:title_new_password', 'required|matches[confirm_pwd]');
			$this->form_validation->set_rules('confirm_pwd', 'lang:title_confirm_pwd', 'required');
			
			if ($this->form_validation->run()) {
				$ret_val = SSOUser_changePassword($this->input->post('old_pwd'), $this->input->post('new_pwd'));
				
				switch ($ret_val) {
					case ERROR_OK:
						$error = t('msg_pwd_change_success');
						break;
						
					case ERROR_AUTHOR_USER:
						$error = t('msg_password_error');
						break;
						
					default:
						$error = t('msg_pwd_change_fail');
						break;
				}
			}
			else {
				$error = validation_errors();
			}
		}
		else if ($delete_account) {
			$ret_val = SSOUser_deleteAccount($this->input->post('old_pwd'));
			
			if ($ret_val == ERROR_OK) {
				redirect('/login/disconnect');
				
				return;
			}
			else {
				$error = t('msg_password_error');
			}
		}
		SSOUser_requestOptin($optin_news); // we ignore as optin off
		
		$ret_val = SSOUser_getUserInfo($user_info);
		if ($ret_val == ERROR_AUTHOR_USER) {
			$error = t('error_authorize');
		}
		
		$assign_func = function ($key_array) use (&$user_info) {
			return (isset($user_info[$key_array]) ? htmlspecialchars($user_info[$key_array]) : NULL);
		};
		$user_birth = $assign_func(SSOUSER_TITLE_BIRTHDAY);
		if ($user_birth) {
			$obj_date = DateTime::createFromFormat('n/j/Y', $user_birth);
			$user_birth = $obj_date->format('Y-m-d');
		}
		
		$template_data = array(
				'home'					=> t('home'),
				'back'					=> t('back'),
				'title_change_pwd'		=> t('title_change_pwd'),
				'link_user_info'		=> t('link_user_info'),
				'title_account_optin'	=> t('title_account_optin'),
				'title_account_delete'	=> t('title_account_delete'),
				'hint_account_optin'	=> t('hint_account_optin'),
				'title_optin_news'		=> t('title_optin_news'),
				'title_optin_update'	=> t('title_optin_update'),
				'function_off'			=> t('function_off'),
				'function_on'			=> t('function_on'),
				'optin_update_on'		=> $optin_update ? $option_selected : NULL,
				'optin_news_on'			=> $optin_news ? $option_selected : NULL,
				'title_old_password'	=> t('title_old_password'),
				'title_new_password'	=> t('title_new_password'),
				'title_confirm_pwd'		=> t('title_confirm_pwd'),
				'option_show_pwd'		=> t('option_show_pwd'),
				'button_pwd_change'		=> t('button_pwd_change'),
				'hint_account_delete'	=> t('hint_account_delete'),
				'button_account_delete'	=> t('button_account_delete'),
				'error'					=> $error,
				'title_location'		=> t('title_location'),
				'title_birth'			=> t('title_birth'),
				'label_why'				=> t('label_why'),
				'label_what'			=> t('label_what'),
				'msg_head_hint'			=> t('msg_head_hint'),
				'button_confirm'		=> t('button_confirm'),
				'hint_country'			=> t('hint_country'),
				'hint_city'				=> t('hint_city'),
				'hint_not_found'		=> t('hint_not_found'),
				'hint_why'				=> t('hint_why'),
				'hint_what'				=> t('hint_what'),
				'value_country'			=> $assign_func(SSOUSER_TITLE_COUNTRY),
				'value_city'			=> $assign_func(SSOUSER_TITLE_CITY),
				'value_birth'			=> $user_birth,
				'value_why'				=> $assign_func(SSOUSER_TITLE_WHY),
				'value_what'			=> $assign_func(SSOUSER_TITLE_WHAT),
				'max_birth'				=> date('Y-m-d', time() - 409968000), // a little less than 13 years, 13 * 365 * 24 * 3600
				'msg_max_birthday'		=> t('msg_max_birthday'),
				'msg_download'			=> t('msg_download'),
				'msg_delete_user'		=> t('msg_delete_user'),
				'button_delete_no'		=> t('button_delete_no'),
				'button_delete_ok'		=> t('button_delete_ok'),
		);
		
		$this->parser->parse('basetemplate', array(
				'body_content'	=> $this->parser->parse('user/account', $template_data, TRUE),
		));
		
		return;
	}
	
// 	public function info() {
// 		$template_data = NULL; //array()
// 		$user_info = array();
// 		$assign_func = NULL; //function()
// 		$user_birth = NULL;
// 		$error = NULL;
// 		$ret_val = 0;
		
// 		$this->load->helper('ssouser');
// 		$this->lang->load('user', $this->config->item('language'));
		
// 		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
// 			$this->load->library('form_validation');
			
// // 			$this->form_validation->set_rules('user_country', 'lang:title_country', 'required');
// // 			$this->form_validation->set_rules('user_city', 'lang:title_city', 'required');
// // 			$this->form_validation->set_rules('user_birth', 'lang:title_birth', 'required');
// 			$this->form_validation->set_rules('user_why', 'lang:title_why', 'max_length[200]');
// 			$this->form_validation->set_rules('user_what', 'lang:title_what', 'max_length[200]');
			
// 			if ($this->form_validation->run() == FALSE) {
// 				$error = validation_errors();
// 			}
// 			else {
// 				$array_info = array();
				
// 				foreach (array(
// 						SSOUSER_TITLE_COUNTRY	=> 'user_country',
// // 						SSOUSER_TITLE_CITY		=> 'user_city',
// 						SSOUSER_TITLE_BIRTHDAY	=> 'user_birth',
// 						SSOUSER_TITLE_WHY		=> 'user_why',
// 						SSOUSER_TITLE_WHAT		=> 'user_what',
// 				) as $key => $value) {
// 					$array_info[$key] = ($this->input->post($value) !== FALSE) ? $this->input->post($value) : "";
// 				}
// 				$array_info[SSOUSER_TITLE_CITY] = "";
// 				foreach (array('user_city_input', 'user_city') as $value) {
// 					if ($this->input->post($value) !== FALSE && strlen($this->input->post($value)) > 0) {
// 						$array_info[SSOUSER_TITLE_CITY] = $this->input->post($value);
// 						break;
// 					}
// 				}
				
// 				$ret_val = SSOUser_setUserInfo($array_info);
				
// 				switch ($ret_val) {
// 					case ERROR_OK:
// 						$this->output->set_header('Location: /user/account');
						
// 						return;
// 						break; // never reach here
						
// 					case ERROR_MISS_PRM:
// 					case ERROR_WRONG_PRM:
// 						$error = t('error_parameter');
// 						break;
						
// 					case ERROR_AUTHOR_USER:
// 						$error = t('error_authorize');
// 						break;
						
// 					default:
// 						$error = t('error_unknown');
// 						break;
// 				}
// 			}
// 		}
		
// 		$ret_val = SSOUser_getUserInfo($user_info);
// 		if ($ret_val == ERROR_AUTHOR_USER) {
// 			$error = t('error_authorize');
// 		}
		
// 		$assign_func = function ($key_array) use (&$user_info) {
// 			return (isset($user_info[$key_array]) ? htmlspecialchars($user_info[$key_array]) : NULL);
// 		};
// 		$user_birth = $assign_func(SSOUSER_TITLE_BIRTHDAY);
// 		if ($user_birth) {
// 			$obj_date = DateTime::createFromFormat('n/j/Y', $user_birth);
// 			$user_birth = $obj_date->format('Y-m-d');
// 		}
		
// 		$template_data = array(
// 				'home'				=> t('home'),
// 				'back'				=> t('back'),
// 				'title_location'	=> t('title_location'),
// 				'title_birth'		=> t('title_birth'),
// 				'label_why'			=> t('label_why'),
// 				'label_what'		=> t('label_what'),
// 				'msg_head_hint'		=> t('msg_head_hint'),
// 				'button_confirm'	=> t('button_confirm'),
// 				'hint_country'		=> t('hint_country'),
// 				'hint_city'			=> t('hint_city'),
// 				'hint_not_found'	=> t('hint_not_found'),
// 				'hint_why'			=> t('hint_why'),
// 				'hint_what'			=> t('hint_what'),
// 				'msg_error'			=> $error,
// 				'value_country'		=> $assign_func(SSOUSER_TITLE_COUNTRY),
// 				'value_city'		=> $assign_func(SSOUSER_TITLE_CITY),
// 				'value_birth'		=> $user_birth,
// 				'value_why'			=> $assign_func(SSOUSER_TITLE_WHY),
// 				'value_what'		=> $assign_func(SSOUSER_TITLE_WHAT),
// 		);
		
// 		$this->parser->parse('basetemplate', array(
// 				'body_content'	=> $this->parser->parse('user/info', $template_data, TRUE),
// 		));
		
// 		return;
// 	}
	
	public function set_optin_ajax() {
		$cr = 0;
		$type = $this->input->get('p');
		$value = $this->input->get('v');
		
		$this->load->helper('ssouser');
		
		if ($type) {
			switch ($type) {
				case 'news':
					if (!$value) {
						$cr = ERROR_MISS_PRM;
					}
					else if (!in_array($value, array('on', 'off'))) {
						$cr = ERROR_WRONG_PRM;
					}
					else {
						$state = ($value == 'on');
						$cr = SSOUser_requestOptin($state, TRUE);
					}
					break;
					
				default:
					$cr = ERROR_WRONG_PRM;
					break;
			}
		}
		else {
			$cr = ERROR_MISS_PRM;
		}
		
		$this->output->set_status_header($cr, 'API code');
		
		return;
	}
	
	public function rss_ajax() {
		$cr = ERROR_OK;
		$content = FALSE;
		
		if (FALSE !== $this->input->get('news')) {
			$content = @file_get_contents('http://www.repeatserver.com/Users/zeepro/news.xml');
		}
		else if (FALSE !== $this->input->get('model')) {
			$content = @file_get_contents('http://www.repeatserver.com/Users/zeepro/model.xml');
		}
		else {
			$cr = ERROR_MISS_PRM;
		}
		
		if ($content) {
			$this->output->set_content_type('xml')->set_output($content);
			
			return;
		}
		else if ($cr == ERROR_OK) {
			$cr = ERROR_INTERNAL;
		}
		
		$this->output->set_status_header($cr, 'API code');
		
		return;
	}
}