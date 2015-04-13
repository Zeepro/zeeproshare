<?php

// Print STL

$lang['titre'] = "Zim \"1-click-to-print\" API";
$lang['titre2'] = "Print on a Zim in one click from your site or from your app";
$lang['service'] = "SITE";
$lang['service_description'] = "1 - send a POST request to:<br/><br/>https://zeeproshare.com/apiv1/printstl<br/><br/>with the fields \"stl\", \"id_partner\" and \"return_type\" (see below) from the server.<br/><br/>2 - redirect the client to the returned URL";
$lang['application'] = "APP";
$lang['application_description'] = "1 - send a POST request to:<br/><br/>https://zeeproshare.com/apiv1/printstl<br/><br/>with the fields \"stl\", \"id_partner\" and \"return_type\" (see below) from the app.<br/><br/>2 - display the returned URL in a browser";
$lang['descrition'] = "REST web-service simulator";
$lang['stl'] = "STL file";
$lang['stl_error_required'] = "required";
$lang['stl_error_too_big'] = "the file must stay below 100Mb";
$lang['id_partner'] = "Partner id";
$lang['id_partner_info'] = "(if you don't have a partner id yet, or if you just want to test the API, leave this field empty: the model will then be displayed on a preview page)";
$lang['id_partner_error'] = "unknow id";
$lang['return_type'] = "Return format";
$lang['plain_text'] = "plain text (by default)";
$lang['json'] = "json";
$lang['xml'] = "XML";
$lang['html'] = "html / javascript";
$lang['submit'] = "Print";
$lang['note'] = "To test the API, simply fill the following form (it creates exactly the request you'll have to send to the web-service); then open the returned URL in a browser (if you have chosen \"html / javascript\" option, you'll be automatically redirected).";
$lang['error_blog'] = "The API is temporarily unavilaible, please try later";

// Rendering
$lang['rendering_pagetitle'] = "Preview";
$lang['reset_model_button'] = "Reset";
$lang['congratulation'] = "<br/>Congratulation: you're almost done!<br/><br/>To get a partner id to let users print directly on their Zim, please send an email to: <a href=\"mailto:contact@zeepro.com\">api@zeepro.com</a><br/><br/>Thank you!<br/><br/><br/>The Zeepro Team";
$lang['msg_webgl_failed'] = "WebGL not supported";
$lang['msg_fetch_failed'] = "The API is temporarily unavilaible, please try later";