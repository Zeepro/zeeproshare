<?php

// Print STL

$lang['titre'] = "Imprimer sur une Zim en un click depuis votre service ou votre application";
$lang['service'] = "Depuis un service<br/><br/>1 - envoyer une requête en POST à l'URL :<br/><br/>https://zeeproshare.com/apiv1/printstl<br/><br/>avec les champs \"stl\", \"id_partner\" et \"return_type\" depuis votre serveur.<br/><br/>2 - envoyer au client une redirection vers l'URL retournée";
$lang['application'] = "Depuis une application<br/><br/>1 - envoyer une requête en POST à l'URL :<br/><br/>https://zeeproshare.com/apiv1/printstl<br/><br/>avec les champs \"stl\", \"id_partner\" et \"return_type\" depuis votre application.<br/><br/>2 - ouvrir un explorateur avec l'URL retournée";
$lang['descrition'] = "Ce formulaire simule la requête à réaliser :";
$lang['stl'] = "Fichier STL";
$lang['stl_error_required'] = "saisie obligatoire";
$lang['stl_error_too_big'] = "la taille du fichier ne doit pas excéder 100 Mo";
$lang['id_partner'] = "Identifiant partenaire";
$lang['id_partner_info'] = "(si vous ne disposez pas d'un identifiant partenaire, ou si vous souhaitez tester votre intégration, laisser ce champ vide : le modèle STL sera affiché dans une page simulant une Zim)";
$lang['id_partner_error'] = "identifiant inconnu";
$lang['return_type'] = "Format de retour";
$lang['plain_text'] = "plain text (par défaut)";
$lang['json'] = "json";
$lang['xml'] = "XML";
$lang['html'] = "html / javascript";
$lang['submit'] = "Imprimer";
$lang['note'] = "Pour tester cette API, remplisser les champs, puis accèder à l'URL retournée (si vous avez choisi l'option \"html / javascript\" vous serez automatiquement redirigé vers l'imprimante).";
