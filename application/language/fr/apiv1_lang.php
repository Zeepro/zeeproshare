<?php

// Print STL

$lang['titre'] = "API Zim \"1-click-to-print\"";
$lang['titre2'] = "Imprimer sur une Zim en un click depuis un site ou une application";
$lang['service'] = "SITE";
$lang['service_description'] = "1 - envoyer une requête en POST à l'URL :<br/><br/>https://zeeproshare.com/apiv1/printstl<br/><br/>avec les champs \"stl\", \"id_partner\" et \"return_type\" (voir ci-dessous) depuis le serveur.<br/><br/>2 - rediriger le client vers l'URL retournée";
$lang['application'] = "APPLICATION";
$lang['application_description'] = "1 - envoyer une requête en POST à l'URL :<br/><br/>https://zeeproshare.com/apiv1/printstl<br/><br/>avec les champs \"stl\", \"id_partner\" et \"return_type\" (voir ci-dessous) depuis l'application.<br/><br/>2 - afficher l'URL retournée dans un explorateur";
$lang['descrition'] = "Simulateur de service web REST";
$lang['stl'] = "Fichier STL";
$lang['stl_error_required'] = "saisie obligatoire";
$lang['stl_error_too_big'] = "la taille du fichier ne doit pas excéder 100 Mo";
$lang['id_partner'] = "Identifiant partenaire";
$lang['id_partner_info'] = "(si vous ne disposez pas d'un identifiant partenaire, ou si vous souhaitez simplement tester l'API, laisser ce champ vide : le modèle STL sera affiché dans une page de prévisualisation)";
$lang['id_partner_error'] = "identifiant inconnu";
$lang['return_type'] = "Format de retour";
$lang['plain_text'] = "plain text (par défaut)";
$lang['json'] = "json";
$lang['xml'] = "XML";
$lang['html'] = "html / javascript";
$lang['submit'] = "Imprimer";
$lang['note'] = "Pour tester cette API, remplisser simplement le formulaire suivant (il génère excatement le requête qui devra être envoyée au service web), puis accèder à l'URL retournée (si vous avez choisi l'option \"html / javascript\" vous serez automatiquement redirigé).";
$lang['error_blog'] = "Cette API est momentanément indisponible ; merci de réessayer ultérieurement";

// Rendering
$lang['rendering_pagetitle'] = "Prévisualisation";
$lang['reset_model_button'] = "Réinitialiser";
$lang['congratulation'] = "<br/>Félicitation : vous avez presque terminé !<br/><br/>Pour obtenir un identifiant de partenaire qui permettra aux utilisateurs d’accéder directement à leur imprimante, merci de nous envoyer un mail à : <a href=\"mailto:contact@zeepro.com\">api@zeepro.com</a><br/><br/>Merci !<br/><br/><br/>L'Equipe Zeepro";
$lang['msg_webgl_failed'] = "WebGL non supporté";
$lang['msg_fetch_failed'] = "Cette API est momentanément indisponible ; merci de réessayer ultérieurement";