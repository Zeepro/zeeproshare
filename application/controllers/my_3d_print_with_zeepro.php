<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class my_3d_print_with_zeepro extends CI_Controller
{
	public function index()
    {
		$template_data = array();
		$template_data['custom_error'] = "";
		$this->lang->load('my_3d_print_with_zeepro', $this->config->item('language'));
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			extract($_POST);

			$json = json_encode(array('email' => date("$email"),
				'first_name' => date("$first_name"),
				'last_name' => date("$last_name"),
				'address1' => date("$address1"),
				'address2' => date("$address2"),
				'city' => date("$city"),
				'state' => date("$state"),
				'zip' => date("$zip"),
				'country' => date("$country"),
				'cell_phone' => date("$cell_phone")
			));
			$url = 'https://stat.service.zeepro.com/log.ashx';
			$data = array('printersn' => '000000000000', 'version' => '1', 'category' => 'My3DPrintWithZeepro', 'action' => 'collect', 'label' => $json);
			$options = array('http' => array('header'  => "Content-type: application/x-www-form-urlencoded\r\n",
					'method'  => 'POST',
					'content' => http_build_query($data)));
			$context  = stream_context_create($options);
			@file_get_contents($url, false, $context);
							
			$this->output->set_header("Location: /my_3d_print_with_zeepro/confirmation");
			return ;
		}
		
				
		$body_content = $this->parser->parse('my_3d_print_with_zeepro/index', $template_data, TRUE);
        $template_data['body_content'] = $body_content;
		$template_data['back'] = t("back");
		$template_data['title'] = t("title");
		$template_data['terms_of_service_agreement'] = t("terms_of_service_agreement");
		$template_data['email'] = t("email");
		$template_data['first_name'] = t("first_name");
		$template_data['last_name'] = t("last_name");
		$template_data['address'] = t("address");
		$template_data['why_address'] = t("why_address");		
		$template_data['city'] = t("city");
		$template_data['state'] = t("state");
		$template_data['zip'] = t("zip");
		$template_data['cell_phone'] = t("cell_phone");
		$template_data['country'] = t("country");
		$template_data['country01'] = t("country01");
		$template_data['country02'] = t("country02");
		$template_data['country03'] = t("country03");
		$template_data['country04'] = t("country04");
		$template_data['3D_printer_owner'] = t("3D_printer_owner");
		$template_data['yes'] = t("yes");
		$template_data['no'] = t("no");
		$template_data['ThreeDprinter01'] = t("ThreeDprinter01");
		$template_data['ThreeDprinter02'] = t("ThreeDprinter02");
		$template_data['ThreeDprinter03'] = t("ThreeDprinter03");
		$template_data['ThreeDprinter04'] = t("ThreeDprinter04");
		$template_data['ever_use'] = t("ever_use");
		$template_data['criteriaA'] = t("criteriaA");
		$template_data['criteriaA01'] = t("criteriaA01");
		$template_data['criteriaA02'] = t("criteriaA02");
		$template_data['criteriaA03'] = t("criteriaA03");
		$template_data['criteriaA04'] = t("criteriaA04");
		$template_data['websiteURL'] = t("websiteURL");
		$template_data['criteriaB'] = t("criteriaB");
		$template_data['criteriaB01'] = t("criteriaB01");
		$template_data['criteriaB02'] = t("criteriaB02");
		$template_data['criteriaB03'] = t("criteriaB03");
		$template_data['social_media'] = t("social_media");
		$template_data['social_media01'] = t("social_media01");
		$template_data['social_media02'] = t("social_media02");
		$template_data['social_media03'] = t("social_media03");
		$template_data['social_media04'] = t("social_media04");
		$template_data['social_media05'] = t("social_media05");
		$template_data['social_media06'] = t("social_media06");
		$template_data['social_media_custom'] = t("social_media_custom");
		$template_data['handle'] = t("handle");
		
		$this->parser->parse('basetemplate', $template_data);
	}

	public function terms_of_service()
	{
		$this->lang->load('my_3d_print_with_zeepro', $this->config->item('language'));

		$template_data = array('body_content'	=> $this->parser->parse("my_3d_print_with_zeepro/terms_of_service", array(), true),
								'terms_of_service_text'=> t('terms_of_service_text'),
								'back'			=> t('back')
								);
        $this->parser->parse('basetemplate', $template_data);
	}

	public function confirmation()
	{
		$this->lang->load('my_3d_print_with_zeepro', $this->config->item('language'));

		$template_data = array('body_content'	=> $this->parser->parse("my_3d_print_with_zeepro/confirmation", array(), true),
								'confirmation_text'=> t('confirmation_text'),
								'back'			=> t('back')
								);
        $this->parser->parse('basetemplate', $template_data);
	}
}