<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class User extends CI_Controller
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

		if ($printers != NULL)
			$title = t('connected');
		else
			$title = t('no_printer');
				
        $body = $this->load->view('User/index', array( "printers" => $printers, "user_token" => $this->session->userdata('user_token')), true);
		
		$template_data = array('body_content'	=> $body,
								'signout'		=> t('signout'),
								'connected'		=> $title,
								'change_pass'	=> t('change_pass'));
		$this->parser->parse('basetemplate', $template_data);
	}
	
	public function v2()
	{
		if ($this->session->userdata('logged_in') == false)
		{
			$this->output->set_header("Location: /login");
			return;
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

		if ($printers != NULL)
			$title = t('connected');
		else
			$title = t('no_printer');
				
        $body = $this->load->view('User/v2', array( "printers" => $printers, "user_token" => $this->session->userdata('user_token')), true);
		
		$template_data = array('body_content'	=> $body,
				'connected'		=> $title,
				'change_pass'	=> t('change_pass'),
				'areyousure'	=> t('areyousure'),
				'yes'			=> t('yes'),
				'no'			=> t('no'),
				'news'			=> t('news'),
				'inspiration'	=> t('inspiration'),
				'myzeeproshare'	=> t('myzeeproshare'),
				'channels'		=> t('channels'),
				'share'			=> t('share'),
				'follow'		=> t('follow'),
				'store'			=> t('store'),
				'support'		=> t('support'));
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
				'areyousure' => t('areyousure'),
				'yes' => t('yes'),
				'no' => t('no'),
				'tellus' => t('tellus'),
				'description' => t('description'),
				'description_placeholder' => t('description_placeholder'),
				'attach' => t('attach'),
				'submit' => t('submit'));
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
				'areyousure' => t('areyousure'),
				'yes' => t('yes'),
				'no' => t('no'),
				'follow_us' => t('follow_us'),
				'facebook' => t('facebook'),
				'youtube' => t('youtube'),
				'pinterest' => t('pinterest'),
				'twitter' => t('twitter'),
				'googleplus' => t('googleplus'),
				'fancy' => t('fancy'));
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
				'areyousure' => t('areyousure'),
				'yes' => t('yes'),
				'no' => t('no'));
        $this->parser->parse('basetemplate', $template_data);
	}
}