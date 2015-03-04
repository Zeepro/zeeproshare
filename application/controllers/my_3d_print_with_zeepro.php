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
			if ($_POST['3D_printer_owner'] == "no") {
				$ThreeDprinter = "";
				$printer_make = "";
			} else if ($_POST['ThreeDprinter'] != t("ThreeDprinter04")) {
				$ThreeDprinter = $_POST['ThreeDprinter'];
				$printer_make = "";
			} else {
				$ThreeDprinter = $_POST['ThreeDprinter'];
				$printer_make = $_POST['printer_make'];
			}
			
			if ($_POST['social_media'] != t("social_media06"))
				$social_media_custom = "";
			else
				$social_media_custom = $_POST['social_media_custom'];
				
			$json = json_encode(array('email' => $_POST['email'],
				'first_name' => $_POST['first_name'],
				'last_name' => $_POST['last_name'],
				'address1' => $_POST['address1'],
				'address2' => $_POST['address2'],
				'city' => $_POST['city'],
				'state' => $_POST['state'],
				'zip' => $_POST['zip'],
				'country' => $_POST['country'],
				'3D_printer_owner' => $_POST['3D_printer_owner'],
				'ThreeDprinter' => $ThreeDprinter,
				'Printer_make' => $printer_make,
				'ever_use_3D_printer' => $_POST['ever_use_3D_printer'],
				'occupation' => $_POST['criteriaA'],
				'websiteURL' => $_POST['websiteURL'],
				'social_media' => $_POST['social_media'],
				'other_social_media' => $social_media_custom,
				'handle' => $_POST['handle']
			));

			// Via Log
// 			$url = 'https://stat.service.zeepro.com/log.ashx';
// 			$data = array('printersn' => '000000000000', 'version' => '1', 'category' => 'My3DPrintWithZeepro', 'action' => 'collect', 'label' => $json);
// 			$options = array('http' => array('header'  => "Content-type: application/x-www-form-urlencoded\r\n",
// 					'method'  => 'POST',
// 					'content' => http_build_query($data)));
// 			$context  = stream_context_create($options);
// 			@file_get_contents($url, false, $context);

			// Direct
			$server = "tcp:p8jt5i2tn6.database.windows.net,1433";
			$user = "zssologin@p8jt5i2tn6";
			$pwd = "V8lu7hb1";
			$db = "zsso";

			try{
				$conn = new PDO("sqlsrv:Server= $server ; Database = $db ", $user, $pwd);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "INSERT INTO My3DPrintWithZeepro (data) VALUES (:data)";
				$q = $conn->prepare($sql);
				$q->execute(array(':data' => $json));
			} catch(Exception $e){
				die($e);
			}
				
			include_once "/application/third_party/swiftmailer-master/lib/swift_required.php";
			
			$subject = t("confirmation_email_subject");
			$from = array('my3dprint@zeepro.com' => t("confirmation_email_alias"));
			$to = array($_POST['email']);
			
			$transport = Swift_SmtpTransport::newInstance('smtp.mandrillapp.com', 587);
			$transport->setUsername('service-informatique@zee3dcompany.com');
			$transport->setPassword('uBXf9JhuFAg7FfeJVAVvkA');
			$swift = Swift_Mailer::newInstance($transport);
			
			$message = new Swift_Message($subject);
			$message->setFrom($from);
			$message->setTo($to);
			$message->setBody(str_replace("{first_name}", $_POST['first_name'], t("confirmation_email_html")), 'text/html');
			
			$recipients = $swift->send($message, $failures);
			
			$this->output->set_header("Location: /my_3d_print_with_zeepro/confirmation");
			return ;
		}
				
		$body_content = $this->parser->parse('my_3d_print_with_zeepro/index', $template_data, TRUE);
        $template_data['body_content'] = $body_content;
		$template_data['back'] = t("back");
		$template_data['title'] = t("title");
		$template_data['description'] = t("description");
		$template_data['terms_of_service_agreement'] = t("terms_of_service_agreement");
		$template_data['email'] = t("email");
		$template_data['first_name'] = t("first_name");
		$template_data['last_name'] = t("last_name");
		$template_data['address1'] = t("address1");
		$template_data['address2'] = t("address2");
		$template_data['why_address'] = t("why_address");		
		$template_data['city'] = t("city");
		$template_data['state'] = t("state");
		$template_data['zip'] = t("zip");
		$template_data['country'] = t("country");
		$template_data['country001'] = t("country001");
		$template_data['country002'] = t("country002");
		$template_data['country003'] = t("country003");
		$template_data['country004'] = t("country004");
		$template_data['country005'] = t("country005");
		$template_data['country006'] = t("country006");
		$template_data['country007'] = t("country007");
		$template_data['country008'] = t("country008");
		$template_data['country009'] = t("country009");
		$template_data['country010'] = t("country010");
		$template_data['country011'] = t("country011");
		$template_data['country012'] = t("country012");
		$template_data['country013'] = t("country013");
		$template_data['country014'] = t("country014");
		$template_data['country015'] = t("country015");
		$template_data['country016'] = t("country016");
		$template_data['country017'] = t("country017");
		$template_data['country018'] = t("country018");
		$template_data['country019'] = t("country019");
		$template_data['country020'] = t("country020");
		$template_data['country021'] = t("country021");
		$template_data['country022'] = t("country022");
		$template_data['country023'] = t("country023");
		$template_data['country024'] = t("country024");
		$template_data['country025'] = t("country025");
		$template_data['country026'] = t("country026");
		$template_data['country027'] = t("country027");
		$template_data['country028'] = t("country028");
		$template_data['country029'] = t("country029");
		$template_data['country030'] = t("country030");
		$template_data['country031'] = t("country031");
		$template_data['country032'] = t("country032");
		$template_data['country033'] = t("country033");
		$template_data['country034'] = t("country034");
		$template_data['country035'] = t("country035");
		$template_data['country036'] = t("country036");
		$template_data['country037'] = t("country037");
		$template_data['country038'] = t("country038");
		$template_data['country039'] = t("country039");
		$template_data['country040'] = t("country040");
		$template_data['country041'] = t("country041");
		$template_data['country042'] = t("country042");
		$template_data['country043'] = t("country043");
		$template_data['country044'] = t("country044");
		$template_data['country045'] = t("country045");
		$template_data['country046'] = t("country046");
		$template_data['country047'] = t("country047");
		$template_data['country048'] = t("country048");
		$template_data['country049'] = t("country049");
		$template_data['country050'] = t("country050");
		$template_data['country051'] = t("country051");
		$template_data['country052'] = t("country052");
		$template_data['country053'] = t("country053");
		$template_data['country054'] = t("country054");
		$template_data['country055'] = t("country055");
		$template_data['country056'] = t("country056");
		$template_data['country057'] = t("country057");
		$template_data['country058'] = t("country058");
		$template_data['country059'] = t("country059");
		$template_data['country060'] = t("country060");
		$template_data['country061'] = t("country061");
		$template_data['country062'] = t("country062");
		$template_data['country063'] = t("country063");
		$template_data['country064'] = t("country064");
		$template_data['country065'] = t("country065");
		$template_data['country066'] = t("country066");
		$template_data['country067'] = t("country067");
		$template_data['country068'] = t("country068");
		$template_data['country069'] = t("country069");
		$template_data['country070'] = t("country070");
		$template_data['country071'] = t("country071");
		$template_data['country072'] = t("country072");
		$template_data['country073'] = t("country073");
		$template_data['country074'] = t("country074");
		$template_data['country075'] = t("country075");
		$template_data['country076'] = t("country076");
		$template_data['country077'] = t("country077");
		$template_data['country078'] = t("country078");
		$template_data['country079'] = t("country079");
		$template_data['country080'] = t("country080");
		$template_data['country081'] = t("country081");
		$template_data['country082'] = t("country082");
		$template_data['country083'] = t("country083");
		$template_data['country084'] = t("country084");
		$template_data['country085'] = t("country085");
		$template_data['country086'] = t("country086");
		$template_data['country087'] = t("country087");
		$template_data['country088'] = t("country088");
		$template_data['country089'] = t("country089");
		$template_data['country090'] = t("country090");
		$template_data['country091'] = t("country091");
		$template_data['country092'] = t("country092");
		$template_data['country093'] = t("country093");
		$template_data['country094'] = t("country094");
		$template_data['country095'] = t("country095");
		$template_data['country096'] = t("country096");
		$template_data['country097'] = t("country097");
		$template_data['country098'] = t("country098");
		$template_data['country099'] = t("country099");
		$template_data['country100'] = t("country100");
		$template_data['country101'] = t("country101");
		$template_data['country102'] = t("country102");
		$template_data['country103'] = t("country103");
		$template_data['country104'] = t("country104");
		$template_data['country105'] = t("country105");
		$template_data['country106'] = t("country106");
		$template_data['country107'] = t("country107");
		$template_data['country108'] = t("country108");
		$template_data['country109'] = t("country109");
		$template_data['country110'] = t("country110");
		$template_data['country111'] = t("country111");
		$template_data['country112'] = t("country112");
		$template_data['country113'] = t("country113");
		$template_data['country114'] = t("country114");
		$template_data['country115'] = t("country115");
		$template_data['country116'] = t("country116");
		$template_data['country117'] = t("country117");
		$template_data['country118'] = t("country118");
		$template_data['country119'] = t("country119");
		$template_data['country120'] = t("country120");
		$template_data['country121'] = t("country121");
		$template_data['country122'] = t("country122");
		$template_data['country123'] = t("country123");
		$template_data['country124'] = t("country124");
		$template_data['country125'] = t("country125");
		$template_data['country126'] = t("country126");
		$template_data['country127'] = t("country127");
		$template_data['country128'] = t("country128");
		$template_data['country129'] = t("country129");
		$template_data['country130'] = t("country130");
		$template_data['country131'] = t("country131");
		$template_data['country132'] = t("country132");
		$template_data['country133'] = t("country133");
		$template_data['country134'] = t("country134");
		$template_data['country135'] = t("country135");
		$template_data['country136'] = t("country136");
		$template_data['country137'] = t("country137");
		$template_data['country138'] = t("country138");
		$template_data['country139'] = t("country139");
		$template_data['country140'] = t("country140");
		$template_data['country141'] = t("country141");
		$template_data['country142'] = t("country142");
		$template_data['country143'] = t("country143");
		$template_data['country144'] = t("country144");
		$template_data['country145'] = t("country145");
		$template_data['country146'] = t("country146");
		$template_data['country147'] = t("country147");
		$template_data['country148'] = t("country148");
		$template_data['country149'] = t("country149");
		$template_data['country150'] = t("country150");
		$template_data['country151'] = t("country151");
		$template_data['country152'] = t("country152");
		$template_data['country153'] = t("country153");
		$template_data['country154'] = t("country154");
		$template_data['country155'] = t("country155");
		$template_data['country156'] = t("country156");
		$template_data['country157'] = t("country157");
		$template_data['country158'] = t("country158");
		$template_data['country159'] = t("country159");
		$template_data['country160'] = t("country160");
		$template_data['country161'] = t("country161");
		$template_data['country162'] = t("country162");
		$template_data['country163'] = t("country163");
		$template_data['country164'] = t("country164");
		$template_data['country165'] = t("country165");
		$template_data['country166'] = t("country166");
		$template_data['country167'] = t("country167");
		$template_data['country168'] = t("country168");
		$template_data['country169'] = t("country169");
		$template_data['country170'] = t("country170");
		$template_data['country171'] = t("country171");
		$template_data['country172'] = t("country172");
		$template_data['country173'] = t("country173");
		$template_data['country174'] = t("country174");
		$template_data['country175'] = t("country175");
		$template_data['country176'] = t("country176");
		$template_data['country177'] = t("country177");
		$template_data['country178'] = t("country178");
		$template_data['country179'] = t("country179");
		$template_data['country180'] = t("country180");
		$template_data['country181'] = t("country181");
		$template_data['country182'] = t("country182");
		$template_data['country183'] = t("country183");
		$template_data['country184'] = t("country184");
		$template_data['country185'] = t("country185");
		$template_data['country186'] = t("country186");
		$template_data['country187'] = t("country187");
		$template_data['country188'] = t("country188");
		$template_data['country189'] = t("country189");
		$template_data['country190'] = t("country190");
		$template_data['country191'] = t("country191");
		$template_data['country192'] = t("country192");
		$template_data['country193'] = t("country193");
		$template_data['country194'] = t("country194");
		$template_data['country195'] = t("country195");
		$template_data['country196'] = t("country196");
		$template_data['country197'] = t("country197");
		$template_data['country198'] = t("country198");
		$template_data['country199'] = t("country199");
		$template_data['country200'] = t("country200");
		$template_data['country201'] = t("country201");
		$template_data['country202'] = t("country202");
		$template_data['country203'] = t("country203");
		$template_data['country204'] = t("country204");
		$template_data['country205'] = t("country205");
		$template_data['country206'] = t("country206");
		$template_data['country207'] = t("country207");
		$template_data['country208'] = t("country208");
		$template_data['country209'] = t("country209");
		$template_data['country210'] = t("country210");
		$template_data['country211'] = t("country211");
		$template_data['country212'] = t("country212");
		$template_data['country213'] = t("country213");
		$template_data['country214'] = t("country214");
		$template_data['country215'] = t("country215");
		$template_data['country216'] = t("country216");
		$template_data['country217'] = t("country217");
		$template_data['country218'] = t("country218");
		$template_data['country219'] = t("country219");
		$template_data['country220'] = t("country220");
		$template_data['country221'] = t("country221");
		$template_data['country222'] = t("country222");
		$template_data['country223'] = t("country223");
		$template_data['country224'] = t("country224");
		$template_data['country225'] = t("country225");
		$template_data['country226'] = t("country226");
		$template_data['country227'] = t("country227");
		$template_data['country228'] = t("country228");
		$template_data['country229'] = t("country229");
		$template_data['country230'] = t("country230");
		$template_data['country231'] = t("country231");
		$template_data['country232'] = t("country232");
		$template_data['country233'] = t("country233");
		$template_data['country234'] = t("country234");
		$template_data['country235'] = t("country235");
		$template_data['country236'] = t("country236");
		$template_data['country237'] = t("country237");
		$template_data['country238'] = t("country238");
		$template_data['country239'] = t("country239");
		$template_data['country240'] = t("country240");
		$template_data['country241'] = t("country241");
		$template_data['country242'] = t("country242");
		$template_data['country243'] = t("country243");
		$template_data['country244'] = t("country244");
		$template_data['country245'] = t("country245");
		$template_data['country246'] = t("country246");
		$template_data['country247'] = t("country247");
		$template_data['country248'] = t("country248");
		$template_data['country249'] = t("country249");
		$template_data['country250'] = t("country250");
		$template_data['country251'] = t("country251");
		$template_data['country252'] = t("country252");
		$template_data['country253'] = t("country253");
		$template_data['country254'] = t("country254");
		$template_data['country255'] = t("country255");
		$template_data['country256'] = t("country256");
		$template_data['country257'] = t("country257");
		$template_data['country258'] = t("country258");
		$template_data['country259'] = t("country259");
		$template_data['country260'] = t("country260");
		$template_data['country261'] = t("country261");
		$template_data['country262'] = t("country262");
		$template_data['country263'] = t("country263");
		$template_data['country264'] = t("country264");
		$template_data['country265'] = t("country265");
		$template_data['country266'] = t("country266");
		$template_data['country267'] = t("country267");
		$template_data['country268'] = t("country268");
		$template_data['country269'] = t("country269");
		$template_data['3D_printer_owner'] = t("3D_printer_owner");
		$template_data['yes'] = t("yes");
		$template_data['no'] = t("no");
		$template_data['ThreeDprinter02'] = t("ThreeDprinter02");
		$template_data['ThreeDprinter03'] = t("ThreeDprinter03");
		$template_data['ThreeDprinter04'] = t("ThreeDprinter04");
		$template_data['printer_make'] = t("printer_make");
		$template_data['ever_use'] = t("ever_use");
		$template_data['criteriaA'] = t("criteriaA");
		$template_data['criteriaA01'] = t("criteriaA01");
		$template_data['criteriaA02'] = t("criteriaA02");
		$template_data['criteriaA03'] = t("criteriaA03");
		$template_data['criteriaA04'] = t("criteriaA04");
		$template_data['websiteURL'] = t("websiteURL");
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

	public function extract94110()
	{
		$this->load->helper('download');
		
		$server = "tcp:p8jt5i2tn6.database.windows.net,1433";
		$user = "zssologin@p8jt5i2tn6";
		$pwd = "V8lu7hb1";
		$db = "zsso";

		$csv = "#;Date;Email;First name;Last name;Address1;Address2;City;State;Zip;Country;3D printer owner;3D printer;Other 3D printer;Ever use 3D printer;Description;Website;Social media;Other social media;Handle\r\n";
		
		try{
			$conn = new PDO("sqlsrv:Server= $server ; Database = $db ", $user, $pwd);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "SELECT id, date, data FROM My3DPrintWithZeepro";

			foreach ($conn->query($sql) as $row) {
				try {
					$result_array = json_decode($row['data'], TRUE);

					$line = $row['id'] . ';' .
						$row['date'] . ';' .
						'"' . str_replace('"', '""', $result_array["email"]) . '";' .
						'"' . str_replace('"', '""', $result_array["first_name"]) . '";' .
						'"' . str_replace('"', '""', $result_array["last_name"]) . '";' .
						'"' . str_replace('"', '""', $result_array["address1"]) . '";' .
						'"' . str_replace('"', '""', $result_array["address2"]) . '";' .
						'"' . str_replace('"', '""', $result_array["city"]) . '";' .
						'"' . str_replace('"', '""', $result_array["state"]) . '";' .
						'"' . str_replace('"', '""', $result_array["zip"]) . '";' .
						'"' . str_replace('"', '""', $result_array["country"]) . '";' .
						'"' . str_replace('"', '""', $result_array["3D_printer_owner"]) . '";' .
						'"' . str_replace('"', '""', $result_array["ThreeDprinter"]) . '";' .
						'"' . str_replace('"', '""', $result_array["Printer_make"]) . '";' .
						'"' . str_replace('"', '""', $result_array["ever_use_3D_printer"]) . '";' .
						'"' . str_replace('"', '""', $result_array["occupation"]) . '";' .
						'"' . str_replace('"', '""', $result_array["websiteURL"]) . '";' .
						'"' . str_replace('"', '""', $result_array["social_media"]) . '";' .
						'"' . str_replace('"', '""', $result_array["other_social_media"]) . '";' .
						'"' . str_replace('"', '""', $result_array["handle"]) . "\"\r\n";
					$csv = $csv . $line;
				} catch(Exception $e) {
				}				
			}			
		} catch(Exception $e){
			die($e);
		}
	
		force_download("My3DPrintWithZeepro.csv", $csv);
		return;
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

	public function terms_of_service()
	{
		$this->lang->load('my_3d_print_with_zeepro', $this->config->item('language'));

		$template_data = array('body_content'	=> $this->parser->parse("my_3d_print_with_zeepro/terms_of_service", array(), true),
								'confirmation_text'=> t('terms_of_service_text'),
								'back'			=> t('back')
								);
        $this->parser->parse('basetemplate', $template_data);
	}
}