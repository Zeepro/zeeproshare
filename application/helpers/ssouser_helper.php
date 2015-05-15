<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

$CI = &get_instance();
$CI->load->helper('errorcode');

if (!defined('SSOUSER_URL_SSO')) {
	define('SSOUSER_URL_SSO',			'https://sso.zeepro.com/');
	define('SSOUSER_URI_GET_USERINFO',	'getuserinfo.ashx');
	define('SSOUSER_URI_SET_USERINFO',	'setuserinfo.ashx');
	define('SSOUSER_URI_OPTIN',			'optin.ashx');
	define('SSOUSER_URI_CHANGE_PWD',	'changepassword.ashx');
	define('SSOUSER_URI_DEL_ACCOUNT',	'deleteaccount.ashx');
	
	define('SSOUSER_PRM_TOKEN',		'token');
	define('SSOUSER_PRM_EMAIL',		'email');
	define('SSOUSER_PRM_PASSWORD',	'password');
	define('SSOUSER_PRM_OPTIN',		'optin');
	define('SSOUSER_PRM_OLD_PWD',	'old_password');
	define('SSOUSER_PRM_NEW_PWD',	'new_password');
	
	define('SSOUSER_TITLE_COUNTRY',		'country');
	define('SSOUSER_TITLE_CITY',		'city');
	define('SSOUSER_TITLE_BIRTHDAY',	'birth_date');
	define('SSOUSER_TITLE_WHY',			'why');
	define('SSOUSER_TITLE_WHAT',		'what');
	
	define('SSOUSER_PRM_OPTIN_ON',	'on');
	define('SSOUSER_PRM_OPTIN_OFF',	'off');
	
	define('SSOUSER_TITLE_SESSION_USER_TOKEN',	'user_token');
	define('SSOUSER_TITLE_SESSION_EMAIL',		'email');
	define('SSOUSER_TITLE_SESSION_PASSWORD',	'password');
	
	define('SSOUSER_RESPONSE_OK',			200);
	define('SSOUSER_RESPONSE_MISS_PRM',		432);
	define('SSOUSER_RESPONSE_WRONG_PRM',	433);
	define('SSOUSER_RESPONSE_UF_USER',		442);
	define('SSOUSER_RESPONSE_LOGIN_FAIL',	434);
	define('SSOUSER_RESPONSE_TOOMANY_REQ',	435);
}

function SSOUser__requestSSO($uri, $post_data, &$response = FALSE) {
	$ret_code = 0;
	$curl = curl_init();
	
	// set parameters
	curl_setopt($curl, CURLOPT_URL, SSOUSER_URL_SSO . $uri);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, TRUE);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
	curl_setopt($curl, CURLOPT_CAINFO, BASEPATH . "../StartComCertificationAuthority.crt");
	curl_setopt($curl, CURLOPT_POST, TRUE);
	
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, ($response !== FALSE));
	curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post_data));
	
	$response = curl_exec($curl);
	$ret_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	
	curl_close($curl);
	
	return $ret_code;
}

function SSOUser_getUserInfo(&$user_info) {
	$CI = &get_instance();
	$ret_val = 0;
	$cr = 0;
	$response = NULL;
	
	// send request
	$ret_val = SSOUser__requestSSO(SSOUSER_URI_GET_USERINFO, array(
			SSOUSER_PRM_TOKEN	=> $CI->session->userdata(SSOUSER_TITLE_SESSION_USER_TOKEN),
	), $response);
	
	$user_info = array();
	switch ($ret_val) {
		case SSOUSER_RESPONSE_OK:
			$array_return = NULL; //array()
				
			$cr = ERROR_OK;
			$array_return = json_decode($response, TRUE);
			if (is_array($array_return)) {
				foreach (array(
						SSOUSER_TITLE_COUNTRY, SSOUSER_TITLE_CITY, SSOUSER_TITLE_BIRTHDAY,
						SSOUSER_TITLE_WHY, SSOUSER_TITLE_WHAT
				) as $info_key) {
					$user_info[$info_key] = isset($array_return[$info_key]) ? $array_return[$info_key] : NULL;
				}
			}
			break;
				
		case SSOUSER_RESPONSE_MISS_PRM:
			$cr = ERROR_MISS_PRM;
			break;
				
		case SSOUSER_RESPONSE_UF_USER:
			$cr = ERROR_AUTHOR_USER;
				
		default:
			if ($cr == 0) $cr = ERROR_INTERNAL;
			break;
	}
	
	return $cr;
}

function SSOUser_setUserInfo($array_info) {
	$CI = &get_instance();
	$ret_val = 0;
	$cr = 0;
	
	// send request
	$ret_val = SSOUser__requestSSO(SSOUSER_URI_SET_USERINFO, array(
			SSOUSER_PRM_TOKEN		=> $CI->session->userdata(SSOUSER_TITLE_SESSION_USER_TOKEN),
			SSOUSER_TITLE_COUNTRY	=> $array_info[SSOUSER_TITLE_COUNTRY],
			SSOUSER_TITLE_CITY		=> $array_info[SSOUSER_TITLE_CITY],
			SSOUSER_TITLE_BIRTHDAY	=> $array_info[SSOUSER_TITLE_BIRTHDAY],
			SSOUSER_TITLE_WHY		=> $array_info[SSOUSER_TITLE_WHY],
			SSOUSER_TITLE_WHAT		=> $array_info[SSOUSER_TITLE_WHAT],
	));
	
	switch ($ret_val) {
		case SSOUSER_RESPONSE_OK:
			$cr = ERROR_OK;
			break;
			
		case SSOUSER_RESPONSE_MISS_PRM:
			$cr = ERROR_MISS_PRM;
			break;
			
		case SSOUSER_RESPONSE_WRONG_PRM:
			$cr = ERROR_WRONG_PRM;
			break;
			
		case SSOUSER_RESPONSE_UF_USER:
			$cr = ERROR_AUTHOR_USER;
			
		default:
			if ($cr == 0) $cr = ERROR_INTERNAL;
			break;
	}
	
	return $cr;
}

function SSOUser_requestOptin(&$state, $set = FALSE) {
	$cr = $ret_val = 0;
	$CI = &get_instance();
	$response = NULL;
	$post_data = array(
			SSOUSER_PRM_EMAIL		=> $CI->session->userdata(SSOUSER_TITLE_SESSION_EMAIL),
			SSOUSER_PRM_PASSWORD	=> $CI->session->userdata(SSOUSER_TITLE_SESSION_PASSWORD),
	);
	
	if ($set) {
		$post_data[SSOUSER_PRM_OPTIN] = $state ? SSOUSER_PRM_OPTIN_ON : SSOUSER_PRM_OPTIN_OFF;
		$response = FALSE; // we don't need response
	}
	$ret_val = SSOUser__requestSSO(SSOUSER_URI_OPTIN, $post_data, $response);
	
	switch ($ret_val) {
		case SSOUSER_RESPONSE_OK:
			$cr = ERROR_OK;
			if (!$set) {
				$tmp_json = json_decode($response, TRUE);
				if (is_array($tmp_json) && isset($tmp_json[SSOUSER_PRM_OPTIN])) {
					$state = ($tmp_json[SSOUSER_PRM_OPTIN] == SSOUSER_PRM_OPTIN_ON);
				}
				else {
					$cr = ERROR_INTERNAL;
				}
			}
			break;
			
		case SSOUSER_RESPONSE_MISS_PRM:
			$cr = ERROR_MISS_PRM;
			break;
			
		case SSOUSER_RESPONSE_WRONG_PRM:
			$cr = ERROR_WRONG_PRM;
			break;
			
		case SSOUSER_RESPONSE_TOOMANY_REQ:
			$cr = ERROR_TOOMANY_REQ;
			break;
			
		case SSOUSER_RESPONSE_LOGIN_FAIL:
			$cr = ERROR_AUTHOR_USER;
			break;
			
		default:
			$cr = ERROR_INTERNAL;
			break;
	}
	
	return $cr;
}

function SSOUser_changePassword($pwd_old, $pwd_new) {
	$cr = 0;
	$CI = &get_instance();
	$ret_val = SSOUser__requestSSO(SSOUSER_URI_DEL_ACCOUNT, array(
			SSOUSER_PRM_EMAIL	=> $CI->session->userdata(SSOUSER_TITLE_SESSION_EMAIL),
			SSOUSER_PRM_OLD_PWD	=> $pwd_old,
			SSOUSER_PRM_NEW_PWD	=> $pwd_new,
	));
	
	switch ($ret_val) {
		case SSOUSER_RESPONSE_MISS_PRM:
			$cr = ERROR_MISS_PRM;
			break;
			
		case SSOUSER_RESPONSE_WRONG_PRM:
			$cr = ERROR_WRONG_PRM;
			break;
			
		case SSOUSER_RESPONSE_LOGIN_FAIL:
			$cr = ERROR_AUTHOR_USER;
			break;
			
		default:
			$cr = ERROR_INTERNAL;
			break;
	}
	
	return $cr;
}

function SSOUser_deleteAccount($password) {
	$cr = 0;
	$CI = &get_instance();
	$ret_val = SSOUser__requestSSO(SSOUSER_URI_DEL_ACCOUNT, array(
			SSOUSER_PRM_EMAIL		=> $CI->session->userdata(SSOUSER_TITLE_SESSION_EMAIL),
			SSOUSER_PRM_PASSWORD	=> $password,
	));
	
	switch ($ret_val) {
		case SSOUSER_RESPONSE_OK:
			$cr = ERROR_OK;
			break;
			
		case SSOUSER_RESPONSE_MISS_PRM:
			$cr = ERROR_MISS_PRM;
			break;
			
		case SSOUSER_RESPONSE_WRONG_PRM:
			$cr = ERROR_WRONG_PRM;
			break;
			
		case SSOUSER_RESPONSE_LOGIN_FAIL:
			$cr = ERROR_AUTHOR_USER;
			break;
			
		default:
			$cr = ERROR_INTERNAL;
			break;
	}
	
	return $cr;
}
