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
				}
				catch(ServiceException $e){
					$code = $e->getCode();
					$error_message = $e->getMessage();
					echo $code.": ".$error_message."<br />";
				}
				
			} else {
				$this->output->set_header("Location: /login");
				return;
			}
		}
		
		$template_data['body_content'] = $this->load->view('apiv1/printstl', '', true);
		
		$this->parser->parse('basetemplate', $template_data);
	}	
	
	public function checkpear()
	{
		require_once 'System.php';
		var_dump(class_exists('System', false));
	}

	public function createcontainer()
	{
		$connectionString = "DefaultEndpointsProtocol=https;AccountName=zeepro;AccountKey=h+1YL4YpN64VfR21SUeWyfM2MyNZI9X08Cwi9WSFAjLnJAGDsxcRLsuQSGZX6Ibe3/VtJKUi7x9lvZOyI7RI+w==";

		require_once "/application/third_party/WindowsAzure/WindowsAzure.php";
	
		// Create blob REST proxy.
		$blobRestProxy = ServicesBuilder::getInstance()->createBlobService($connectionString);
		
		
		// OPTIONAL: Set public access policy and metadata.
		// Create container options object.
		$createContainerOptions = new CreateContainerOptions();
		
		// Set public access policy. Possible values are
		// PublicAccessType::CONTAINER_AND_BLOBS and PublicAccessType::BLOBS_ONLY.
		// CONTAINER_AND_BLOBS:
		// Specifies full public read access for container and blob data.
		// proxys can enumerate blobs within the container via anonymous
		// request, but cannot enumerate containers within the storage account.
		//
		// BLOBS_ONLY:
		// Specifies public read access for blobs. Blob data within this
		// container can be read via anonymous request, but container data is not
		// available. proxys cannot enumerate blobs within the container via
		// anonymous request.
		// If this value is not specified in the request, container data is
		// private to the account owner.
		$createContainerOptions->setPublicAccess(PublicAccessType::CONTAINER_AND_BLOBS);
		
		// Set container metadata
		//$createContainerOptions->addMetaData("key1", "value1");
		//$createContainerOptions->addMetaData("key2", "value2");
		
		try {
			// Create container.
			$blobRestProxy->createContainer("printstlapi", $createContainerOptions);
			echo "Yo!";
		}
		catch(ServiceException $e){
			// Handle exception based on error codes and messages.
			// Error codes and messages are here:
			// http://msdn.microsoft.com/library/azure/dd179439.aspx
			$code = $e->getCode();
			$error_message = $e->getMessage();
			echo $code.": ".$error_message."<br />";
		}
	}
}