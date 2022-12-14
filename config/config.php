<?php

	session_start();

	/*
	*---------------------------------------------------------------
	* Les clefs de l'API
	*---------------------------------------------------------------
	*	Note : A quoi servent-elle et comment trouver les clefs public et secret ?
	*
	* Pour cela il vous vous rendre sur le site : https://openagenda.com/settings/apiKey
	* et copier les Clés API. 
	*
	* La procédure d'authentification à suivre pour éditer du contenu sur OpenAgenda consiste à utiliser votre clé secrète 
	* pour récupérer un ticket d'accès qui vous servira pendant toute votre session. 
	*
	* ATTENTION : Celui-ci à une durée de vie limitée.
	* Votre clé secrète sera mise à disposition sur votre compte OA sur demande à support@openagenda.com
	*  
	*  Vous pouvez consulter la documentation ici : 
	*	INFO ...>  : https://developers.openagenda.com/authentification/
	*/
	
	$_SESSION['last_version'] ="V2022-06-30-TSK"; 

	$keys = array( /* Les clés API permettent de lire et écrire des données sur OpenAgenda via l'API. */
 	  "public"=>"1234567891234567891234567TSK", /* Pour OpenAgenda en lecture */
 	  "secret"=>"ABCDEFGHIJKMLNOPQRSTUVXWZ123"  /* Pour OpenAgenda en mode �criture et autres*/
	);

	$agendaUid=65630513; /* <uid:65630513> */
	$territoireIds=array("5693912"); /* Conseil de territoire : Pays de Martigues */ 
	// $selectionIds=array("133484");
	$selectionIds=array("130723","133484");
	
	$data_openagenda =array(); /* tableau qui va temporairement sauvegarder les données lu sur OpenAgenda 	*/
	$data_apidae	 =array(); /* tableau qui va également sauvegarder les données d'Apidae 				*/


	$apiDomain = "https://api.apidae-tourisme.com/api/";
	
	$apiKey="monapikey"; /* QTfpNkyX <- OK | PhrnH4Dd */
	$projetId="6775"; /*  	6556 Martigues - OpenAgenda */ 
	// $nbResult = '200';
	// $dureemax = "50";

	$requete = array();

	$requete['territoireIds'] = $territoireIds;
	$requete['selectionIds'] = $selectionIds;
	$requete['identifiants'] = $identifiants;
	$requete['apiKey'] = $apiKey;
	$requete['projetId'] = $projetId;
	// $requete['dateDebut'] = date("Y-m-d");   // $requete['dateDebut'] = "2022-09-10";

//	$requete["responseFields"] = array("@all");
	// $requete["responseFields"] = array("@default");

 
	 $requete["responseFields"] = array("id",
										"nom",
										"theme",
										"localisation",
										"descriptionTarif",
										"presentation",
										"reservation",
										"prestations",
										"illustrations",
										"aspects",
										"informations",
										"datesOuverture",
										"ouverture",
										"@informationsObjetTouristique");

	
	$url_Apidae = $apiDomain."v002/agenda/detaille/list-objets-touristiques/";

	$url_Apidae .= '?';
	$url_Apidae .= 'query='.urlencode(json_encode($requete));

	$url_OpenAgenda="https://openagenda.com/agendas/".$agendaUid."/events.v2.json?key=".$keys['public'];
	
	$department		= 	"Bouches-du-Rhône";
	$timezone		=	"Europe/Paris";
	$countryCode 	= 	"FR";
	
?>