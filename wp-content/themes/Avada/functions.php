<?php
/**
 * Extra files & functions are hooked here.
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package Avada
 * @subpackage Core
 * @since 1.0
 */

// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

if (!defined('AVADA_VERSION')) {
    define('AVADA_VERSION', '7.4.1');
}

if (!defined('AVADA_MIN_PHP_VER_REQUIRED')) {
    define('AVADA_MIN_PHP_VER_REQUIRED', '5.6');
}

if (!defined('AVADA_MIN_WP_VER_REQUIRED')) {
    define('AVADA_MIN_WP_VER_REQUIRED', '4.9');
}

// Developer mode.
if (!defined('AVADA_DEV_MODE')) {
    define('AVADA_DEV_MODE', false);
}

/**
 * Compatibility check.
 *
 * Check that the site meets the minimum requirements for the theme before proceeding.
 *
 * @since 6.0
 */
if (version_compare($GLOBALS['wp_version'], AVADA_MIN_WP_VER_REQUIRED, '<') || version_compare(PHP_VERSION, AVADA_MIN_PHP_VER_REQUIRED, '<')) {
    require_once get_template_directory() . '/includes/bootstrap-compat.php';
    return;
}

//rajoute table_ent en attente sur menu Avada
add_action('admin_menu', 'entreprisewait');
function entreprisewait() { 
  add_menu_page( 
      'Entreprise en attente', 
      'Entreprise en attente', 
      'edit_posts', 
      'entrepris_ewait', 
      'entrepris_ewait_call', 
      'dashicons-media-spreadsheet',
	  2
     );
}

//rajoute table_ent confirm sur menu Avada
add_action('admin_menu', 'lstentreprise');
function lstentreprise() { 
  add_menu_page( 
      'Liste des entreprises', 
      'Liste des entreprises', 
      'edit_posts', 
      'entrepris_list', 
      'entrepris_list_call', 
      'dashicons-media-spreadsheet',
	  2
     );
}

//rajoute table_elv sur menu Avada
add_action('admin_menu', 'lsteleve');
function lsteleve() { 
  add_menu_page( 
      'Liste des élèves', 
      'Liste des élèves', 
      'edit_posts', 
      'eleve_list', 
      'eleve_list_call', 
      'dashicons-media-spreadsheet',
	  2
     );
}

//rajoute table_peda sur menu Avada
add_action('admin_menu', 'lstpeda');
function lstpeda() { 
  add_menu_page( 
      'Liste des professeurs', 
      'Liste des professeurs', 
      'edit_posts', 
      'peda_list', 
      'peda_list_call', 
      'dashicons-media-spreadsheet',
	  2
     );
}

 

//encryptage - chiffrement
function encryptIt( $q, $cryptKey ) {
    
	$ciphering = "AES-128-CTR";
	$iv = '1234517891011121';
	$iv_length = openssl_cipher_iv_length($ciphering);
	$options = 0;
	
	$qEncoded = openssl_encrypt($q, $ciphering,$cryptKey, $options, $iv);

	$qEncoded = str_replace(array('+','/'),array('-','_'),$qEncoded);
  
	return( $qEncoded );
}

//decryptage
function decryptIt( $q,$cryptKey ) {
    
	$q = str_replace(array('-','_'),array( '+','/'),$q);
	
	$ciphering = "AES-128-CTR";
	$iv = '1234517891011121';
	$iv_length = openssl_cipher_iv_length($ciphering);
	$options = 0;
	$qDecoded=openssl_decrypt ($q, $ciphering,$cryptKey, $options, $iv);

   
    return( $qDecoded );
}

//hashage
function get_hash(){
	
	$random_salt = str_replace(" ","",hash('sha512', uniqid(openssl_random_pseudo_bytes(4), TRUE)));
	$random_salt = str_replace( array( '=','%', '@', '\'', ';', '<', '>' ), '', $random_salt);
	return $random_salt;
	
}


/**
 * Bootstrap the theme.
 *
 * @since 6.0
 */
require_once get_template_directory() . '/includes/bootstrap.php';



/* Omit closing PHP tag to avoid "Headers already sent" issues. */


/**
 * Enqueue scripts and styles.
 */
function wp_avada_scripts()
{
    global $wp_scripts;
    global $wp_styles;


    wp_enqueue_style('wp-fanzone-style', get_stylesheet_uri());

    wp_enqueue_script('googlemaps', get_template_directory_uri() . '/js/gmap3/src/gmap3.js', array('jquery'));

    wp_enqueue_script('wp_avada_custom_js', get_template_directory_uri() . '/js/custom.js', array('jquery'));


}

add_action('wp_enqueue_scripts', 'wp_avada_scripts');


register_nav_menus(array(
    'bandeau' => __('bandeau', 'wp-fanzone'),
    'primary' => __('Primary Menu', 'wp-fanzone'),
    'postbac' => __('postbac Menu', 'wp-fanzone'),
    'top-menu' => __('Top Menu', 'wp-fanzone')
));


//Enregistre le shortcode
add_shortcode("ajouterweblink", "ajouterweblink_shortcode");

//fonction execut&eacute;e lorsque le shortcode est appel&eacute; (ici elle retourne  un iframe contenant la vid&eacute;o)
function ajouterweblink_shortcode($atts)
{
    extract(shortcode_atts(array(
        'url' => ' ',
        'name' => ' ',
        'nameid' => ' '
    ), $atts));
    $wp_embed = new WP_Embed();
    global $wpdb;
    if (is_numeric($url)) {
        //echo "<script>alert(\"lol\");</script>";
        $lien_vers_fichier = get_field('lien_vers_fichier', intval($url));
        if ($requetesolo = $wpdb->get_results("select * from educ_weblink where id_post='" . intval($url) . "'")) {

            $iteration = $requetesolo[0]->iteration;
            $date_dern = $requetesolo[0]->date_dern;

        }

        $html = "<a class=\"weblink3\" href=\"" . $lien_vers_fichier . "\" target=\"_blank\" data-id=\"" . $url . "\">" . $name . "</a>  <span class=\"nbvue\">" . $iteration . "</span> <span class=\"stylevue\">vues</span>";

    } else {
        $namesans = preg_replace("#[^a-zA-Z1-9]#", "", $nameid);

        if ($requetesolo = $wpdb->get_results("select * from educ_weblinksolo where nameid='" . $namesans . "'")) {

            $iteration = $requetesolo[0]->iteration;
            $date_dern = $requetesolo[0]->date_dern;

        } else {
            $date_dern = date("Y-m-d");
            $iteration = 1;

            $wpdb->insert('educ_weblinksolo', array('id' => 'DEFAULT', 'nameid' => $namesans, 'nom' => $name, 'iteration' => $iteration, 'date_dern' => $date_dern));


        }

        $html = "<a class=\"weblink2\" href=\"" . $url . "\" target=\"_blank\" data-name=\"" . $namesans . "\">" . $name . "</a>   <span class=\"nbvue\">" . $iteration . "</span> <span class=\"stylevue\">vues</span>";
    }

    $weblink_embed = $wp_embed->run_shortcode($html);
    return $weblink_embed;
}


add_action('init', "add_buttons");

function add_buttons()
{

    if (current_user_can('edit_posts') && current_user_can('edit_pages')) {

        add_filter('mce_external_plugins', 'add_plugins');

        add_filter('mce_buttons', 'register_buttons');

    }

}


function add_plugins($plugin_array)
{

    $plugin_array['ajouterweblink'] = get_bloginfo('template_url') . '/js/shortcode-weblink-button.js';

    return $plugin_array;

}


function register_buttons($buttons)
{

    array_push($buttons, 'ajouterweblink');

    return $buttons;

}


add_action('publish_post', 'send_notification');
function send_notification($post_id)
{

    global $wpdb;

    $post = get_post($post_id);
    $post_url = get_permalink($post_id);
    $post_title = get_the_title($post_id);
    $post_cate = wp_get_post_categories($post_id);

    $categories = "";

    $message = ""; //modif ervine ajout


    $subject = 'Publication d\'un nouvel article : ' . $post_title;
    $message .= '<body>';
    $message .= '<p>Bonjour,</p>';
    $message .= '<p>La Direction g&eacute;n&eacute;rale de l\'&eacute;ducation et des enseignements informe tous les int&eacute;ress&eacute;s de la publication d\'un nouvel article : ' . $post_title . '</p>';
    $message .= '<p>Pour voir la publication, <a href="' . $post_url . '">cliquez ici</a></p>';


    $message .= '	<p>Cordialement,</p>';
    $message .= '	<table class="tblmsi">';
    $message .= '		<tr>';
    $message .= '			<td rowspan="6" style="vertical-align: top;"><img src="https://www.education.pf/signmail/logomail2.jpg"></td>';
    $message .= '			<td>';
    $message .= '			</td>';
    $message .= '		</tr>';
    $message .= '		<tr>';
    $message .= '			<td>';
    $message .= '				<span class="msidgee" style="font-size:14px;">Direction G&eacute;n&eacute;rale de l\'&Eacute;ducation et des Enseignements</span><br>';
    $message .= '				<span class="msisite" style="font-size:14px;">B.P. 20673, 98713 Papeete - TAHITI - Rue Tuterai Tane, (route hippodrome) - Pirae</span>';
    $message .= '			</td>';
    $message .= '		</tr>';
    $message .= '		<tr>';
    $message .= '			<td>';
    $message .= '				<span class="msitel" style="font-size:13px;">T&eacute;l : 40 46 29 87</span><span class="msifax"></span>';
    $message .= '				<br><span class="msitel" style="font-size:13px;">E-mail : <a id="lkmail" href="mailto:webmestre@education.pf">webmestre@education.pf</a></span>';
    $message .= '			</td>';
    $message .= '		</tr>';
    $message .= '		<tr>';
    $message .= '			<td>';
    $message .= '				<a href="' . get_site_url() . '" target="_blank"><img src="https://www.education.pf/signmail/icon-website.png" width="25" height="25"></a>&nbsp;&nbsp;&nbsp;';
    $message .= '				<a id="lkmail" href="mailto:webmestre@education.pf"><img src="https://www.education.pf/signmail/icon-mail.png" width="25" height="25"></a>&nbsp;&nbsp;&nbsp;';
    $message .= '				<a href="https://www.facebook.com/educationtahiti/?fref=ts" target="_blank"><img src="http://www.education.pf/signmail/icon-facebook.png" width="25" height="25"></a>&nbsp;&nbsp;&nbsp;';
    $message .= '				<a href="https://www.google.fr/maps/place/Dgee/@-17.5349203,-149.542463,17.75z/data=!4m5!3m4!1s0x769a370400000001:0x77fa7f71a304166f!8m2!3d-17.5349944!4d-149.5413721" target="_blank"><img src="http://www.education.pf/signmail/icon-google_map.png" width="25" height="25"></a>';
    $message .= '			</td>';
    $message .= '		</tr> ';


    $headers = array('Content-Type: text/html; charset=UTF-8');

    foreach ($post_cate as $index => $cate) {

        $categories .= $cate;
        if ((sizeof($post_cate) - 1) != $index) $categories .= ",";

    }

    $requete = $wpdb->get_results("select * from educ_newsletter where cat_id IN (" . $categories . ") group by email");

    foreach ($requete as $requetesolo) {

        $email = $requetesolo->email;
        $cod = $requetesolo->cod;

        $message2 = $message;


        $message2 .= '		<tr>';
        $message2 .= '			<td>';
        $message2 .= '				<a style="font-size:13px;text-decoration:none;color:black;" href="' . get_site_url() . '?desinscription=' . $cod . '" >Se désinscrire de notre newsletter</a>';

        $message2 .= '			</td>';
        $message2 .= '		</tr> ';
        $message2 .= '		<tr>';
        $message2 .= '			<td>';
        $message2 .= '				<a style="font-size:13px;text-decoration:none;color:black;" href="' . get_site_url() . '?abus=' . $cod . '" >Reporter un abus, inscription involontaire</a>';

        $message2 .= '			</td>';
        $message2 .= '		</tr> ';
        $message2 .= '	</table>';
        $message2 .= '</body>';


        wp_mail($email, $subject, $message2, $headers);


    }

}

function takefirstsword($content, $number)
{

    $newcontent = "";

    $words = explode(" ", $content);

    for ($i = 0; $i < $number; $i++) {

        $newcontent .= $words[$i];
        $newcontent .= " ";

    }

    return $newcontent;

}

function session_init()
{
    if (!session_id()) {
        session_start();
    }
}

add_action('init', 'session_init');


function ConnBDDpdo()
{  /*connexion à ma base de donnée bb_stage_doi*/
    try {

        $dbconn = new PDO("mysql:host=" . DB_HOST2 . ";dbname=" . DB_NAME2, DB_USER2, DB_PASSWORD2, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET lc_time_names='fr_FR'", PDO::MYSQL_ATTR_LOCAL_INFILE => true));
        $dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbconn->exec('SET NAMES utf8');

    } catch (PDOException|Exception $e) {
        $dbconn = null;
        echo $e->getMessage() . " | Fichier :" . $e->getFile() . " | Ligne :" . $e->getLine();
    }
    return $dbconn;
}




//*******************************************************************************
// Fonction : BLst
// paramètre(s) : $tbl -- table à traiter
//             $chp1 -- champ de valeur (de la balise option)
//             $chp2 -- champ à afficher dans la liste
//             $id --  identifiant sélectionné 
// Description : Construction de liste déroulante à partir des données de la BDD
//*******************************************************************************
function BLst($tbl, $chp1, $chp2, $id, $order='', $indact='', $typ='', $chp3='', $val=''){
	$arr = array();
	$result = empty($typ) ? "<option value=''></option>\n" : ""; 

	try{
		//Connexion à la base de données
		$conn = ConnBDDpdo();
	
		if(!empty($conn)){
			//requête de sélection des données  
			$sql = "SELECT DISTINCT ".$chp1. " as ID,".$chp2." as LIB FROM ".$tbl." WHERE 1=1";
			if (!empty($chp3) && !empty($val))
				$sql .= " AND ".$chp3." = '".$val."'";
			if (!empty($indact))
				$sql .= " AND IND_ACT = 0"; //Pour les tables de nomenclatures, on sélectionne uniquement les codes actifs
			$sql.= empty($order) ? " ORDER BY LIB" : ($order>1 ? " ORDER BY order_id DESC, LIB" : " ORDER BY ID");
			
			foreach  ($conn->query($sql) as $row) {
				if ($row['ID'] == $id) 
					$result .= "<option value='".$row['ID']."' selected>".(stripslashes($row['LIB']))."</option>\n";
				else
					$result .= "<option value='".$row['ID']."'>".(stripslashes($row['LIB']))."</option>\n";
			}
			$conn = null;
		}
		else {
		    echo("problème de connexion à la base de données");
		}
	}
	catch(PDOException | Exception $e){
    	echo $e->getMessage()." | Fichier :".$e->getFile()." | Ligne :".$e->getLine();
		$conn = null;
    }
	return $result;
}

//******************************************************
// Fonction : fDate
// Paramètres : $val -- valeur à formater
//              $typ -- Type de formattage (sql ou html)
// Description : Formate une date au format voulu
//******************************************************
function fDate($val,$typ){ 
	$newdate = $typ=='sql' ? NULL : "";
	
	if ($val != ""){
		switch($typ){
			case 'sql':
				$annee = substr($val,6,4);
				$mois = substr($val,3,2);
				$jour = substr($val,0,2);
				$newdate = $annee."-".$mois."-".$jour;
			break;
			case "html":
				$annee = substr($val, 0, 4);
				$mois = substr($val, 5, 2);
				$jour = substr($val, 8, 2);
				$newdate = $jour."/".$mois."/".$annee;
			break;
			case "htmlh":
				$annee = substr($val, 0, 4);
				$mois = substr($val, 5, 2);
				$jour = substr($val, 8, 2);
				$heure = substr($val, 11, 2);
				$minute = substr($val, 14, 2);
				$newdate = $jour."/".$mois."/".$annee." &agrave; ".$heure.":".$minute;
			break;
		}
	}
	return $newdate;
}

//******************************************************************************************************
// Fonction : lstData
// Paramètres : $typ -- type de liste à afficher
//				$tab -- tableau des critères d'affichage
// Description : Récupération des données de la base et stockage du résultat dans un tableau associatif
//******************************************************************************************************
function lstData($typ,$tab=""){

	try{
		//Connexion à la base de données
		$conn = ConnBDDpdo();
	
		if(!empty($conn)){
		
			switch($typ){
					//---- UTILISATEURS ----
				case "sexe":
					$sql = "SELECT * FROM sexe";
				break;
				case "lstsecteur1":
					$sql = "SELECT * FROM secteur where typ_id=1 ORDER BY sect_lib ASC";
				break;
				case "lstsecteur2":
					$sql = "SELECT * FROM secteur where typ_id=2 ORDER BY sect_lib ASC";
				break;
				case "lstsecteur3":
					$sql = "SELECT * FROM secteur where typ_id=3 ORDER BY sect_lib ASC";
				break;
				case "stage3eme":
					$sql = "SELECT * FROM stage where ent_id=".$tab." and type_id=1";
				break;
				case "uai":
					$sql = "SELECT * FROM uai order by uai_lc ASC";
				break;
				case "stagenotpublish":
					$sql = "SELECT stage.stage_id, type_stage.type_lib, secteur.sect_lib, stage.metier, stage.etape FROM stage left join type_stage on type_stage.type_id=stage.type_id left join secteur on secteur.sect_id=stage.dom_id and secteur.typ_id=stage.type_id WHERE stage.publish=0 and stage.ent_id =".$tab;
				break;
                
				case "alllststage3eme":
				
					if($tab[0]=="-1"){
						
						$sql = "SELECT entreprise.*, stage.*, type_stage.type_lib, secteur.sect_lib,commune.Ile,commune.Geo FROM stage left join commune on commune.IDGeo=stage.stage_com left join entreprise on entreprise.ent_id=stage.ent_id left join type_stage on type_stage.type_id=stage.type_id left join secteur on secteur.sect_id=stage.dom_id and secteur.typ_id=stage.type_id WHERE stage.type_id=1 and stage.publish=1 and stage.suspend=0 ORDER BY stage.d_crea desc LIMIT ".$tab[2]." OFFSET ".$tab[1];
						
					}else{
						
						$sql = "SELECT entreprise.*, stage.*, type_stage.type_lib, secteur.sect_lib,commune.Ile,commune.Geo FROM stage left join commune on commune.IDGeo=stage.stage_com left join entreprise on entreprise.ent_id=stage.ent_id left join type_stage on type_stage.type_id=stage.type_id left join secteur on secteur.sect_id=stage.dom_id and secteur.typ_id=stage.type_id WHERE stage.type_id=1 and stage.dom_id IN (".$tab[0].") and stage.publish=1 and stage.suspend=0  ORDER BY stage.d_crea desc LIMIT ".$tab[2]." OFFSET ".$tab[1];
						
					}
					
				break;
				case "alllststagebts":
				
					if($tab[0]=="-1"){
						
						$sql = "SELECT entreprise.*, stage.*, type_stage.type_lib, secteur.sect_lib,commune.Ile,commune.Geo FROM stage left join commune on commune.IDGeo=stage.stage_com left join entreprise on entreprise.ent_id=stage.ent_id left join type_stage on type_stage.type_id=stage.type_id left join secteur on secteur.sect_id=stage.dom_id and secteur.typ_id=stage.type_id WHERE stage.type_id=3 and stage.publish=1 and stage.suspend=0  ORDER BY stage.d_crea desc LIMIT ".$tab[2]." OFFSET ".$tab[1];
						
					}else{
						
						$sql = "SELECT entreprise.*, stage.*, type_stage.type_lib, secteur.sect_lib,commune.Ile,commune.Geo FROM stage left join commune on commune.IDGeo=stage.stage_com left join entreprise on entreprise.ent_id=stage.ent_id left join type_stage on type_stage.type_id=stage.type_id left join secteur on secteur.sect_id=stage.dom_id and secteur.typ_id=stage.type_id WHERE stage.type_id=3 and stage.dom_id IN (".$tab[0].") and stage.publish=1 and stage.suspend=0  ORDER BY stage.d_crea desc LIMIT ".$tab[2]." OFFSET ".$tab[1];
						
					}
					
				break;
				case "lststage3eme":
					$sql = "SELECT stage.stage_id, type_stage.type_lib, secteur.sect_lib, stage.metier, stage.etape,stage.publish FROM stage left join type_stage on type_stage.type_id=stage.type_id left join secteur on secteur.sect_id=stage.dom_id and secteur.typ_id=stage.type_id WHERE stage.type_id=1 and stage.suspend=0 and stage.ent_id =".$tab." order by stage.publish desc";
				break;
				case "lststagebts":
					$sql = "SELECT stage.stage_id, type_stage.type_lib, secteur.sect_lib, stage.metier, stage.etape,stage.publish FROM stage left join type_stage on type_stage.type_id=stage.type_id left join secteur on secteur.sect_id=stage.dom_id and secteur.typ_id=stage.type_id WHERE stage.type_id=3 and stage.suspend=0 and stage.ent_id =".$tab." order by stage.publish desc";
				break;
				case "alllststagepfmp":
					
					if($tab[0]=="-1"){
						
						$sql = "SELECT entreprise.*, stage.*, type_stage.type_lib, secteur.sect_lib,commune.Ile,commune.Geo FROM stage left join commune on commune.IDGeo=stage.stage_com left join entreprise on entreprise.ent_id=stage.ent_id left join type_stage on type_stage.type_id=stage.type_id left join secteur on secteur.sect_id=stage.dom_id and secteur.typ_id=stage.type_id WHERE stage.type_id=2 and stage.publish=1 and stage.suspend=0 ORDER BY stage.d_crea desc LIMIT ".$tab[2]." OFFSET ".$tab[1];
						
					}else{
						
						$sql = "SELECT entreprise.*, stage.*, type_stage.type_lib, secteur.sect_lib,commune.Ile,commune.Geo FROM stage left join commune on commune.IDGeo=stage.stage_com left join entreprise on entreprise.ent_id=stage.ent_id left join type_stage on type_stage.type_id=stage.type_id left join secteur on secteur.sect_id=stage.dom_id and secteur.typ_id=stage.type_id WHERE stage.type_id=2 and stage.dom_id IN (".$tab[0].") and stage.publish=1 and stage.suspend=0  ORDER BY stage.d_crea desc LIMIT ".$tab[2]." OFFSET ".$tab[1];
						
					}
					
					
					
				break;
				
				case "lststagepfmp":
					$sql = "SELECT stage.stage_id, type_stage.type_lib, secteur.sect_lib, stage.metier, stage.etape,stage.publish FROM stage left join type_stage on type_stage.type_id=stage.type_id left join secteur on secteur.sect_id=stage.dom_id and secteur.typ_id=stage.type_id WHERE stage.type_id=2 and stage.suspend=0 and stage.ent_id =".$tab." order by stage.publish desc";
				break;
				case "secteur1":
					$sql = "SELECT * FROM secteur WHERE typ_id=1 order by sect_lib ASC";
				break;
				case "secteur2":
					$sql = "SELECT * FROM secteur WHERE typ_id=2 order by sect_lib ASC";
				break;
				case "secteur3":
					$sql = "SELECT * FROM secteur WHERE typ_id=3 order by sect_lib ASC";
				break;
				case "stage_uai":
					$sql = "SELECT stage_uai.*,uai.uai_lc FROM stage_uai left join uai on uai.uai_rne=stage_uai.uai_rne where stage_id=".$tab;
				break;
				case "stage_sem":
					$sql = "SELECT * FROM stage_sem where stage_id=".$tab;
				break;
				case "candidature_sem":
					$sql = "SELECT * FROM candidature_sem where cand_id=".$tab;
				break;
                case "lstlvsuivi": //ervine
                    $sql = "SELECT eleve.* FROM peda_elv LEFT JOIN eleve ON eleve.elv_id = peda_elv.elv_id WHERE peda_elv.peda_id =".$tab;
                    break;
				case "candidature3eme":
					$sql = "SELECT candidature.*,stage.*,convention.ent_ok,convention.elv_ok,convention.prof_ok,convention.etab_ok,convention.ref_ok FROM candidature left join stage on stage.stage_id=candidature.stage_id left join convention on convention.cand_id=candidature.cand_id and convention.elv_id=candidature.elv_id where stage.type_id=1 and candidature.elv_id=".$tab;
				break;
				case "candidaturepfmp":
					$sql = "SELECT candidature.*,stage.*,convention.ent_ok,convention.elv_ok,convention.prof_ok,convention.etab_ok,convention.ref_ok FROM candidature left join stage on stage.stage_id=candidature.stage_id left join convention on convention.cand_id=candidature.cand_id and convention.elv_id=candidature.elv_id where stage.type_id=2 and candidature.elv_id=".$tab;
				break;
				case "candidaturebts":
					$sql = "SELECT candidature.*,stage.*,convention.ent_ok,convention.elv_ok,convention.prof_ok,convention.etab_ok,convention.ref_ok FROM candidature left join stage on stage.stage_id=candidature.stage_id left join convention on convention.cand_id=candidature.cand_id and convention.elv_id=candidature.elv_id where stage.type_id=3 and candidature.elv_id=".$tab;
				break;
				case "mescandidatures":
					$sql = "SELECT type_stage.type_lib,candidature.*,stage.*,eleve.*,convention.ent_ok,convention.elv_ok,convention.prof_ok,convention.etab_ok,convention.ref_ok, (select count(*) as NB from peda_elv where peda_elv.elv_id=candidature.elv_id) as CONFIRM FROM candidature left join stage on stage.stage_id=candidature.stage_id left join type_stage on type_stage.type_id=stage.type_id left join eleve on eleve.elv_id=candidature.elv_id left join convention on convention.cand_id=candidature.cand_id and convention.elv_id=candidature.elv_id where stage.ent_id=".$tab." order by candidature.statut ASC";
				break;
				case "mesconventions":
					$sql = "SELECT type_stage.type_lib,candidature.*,stage.*,eleve.elv_nom as NOM, eleve.elv_pren as PRENOM,convention.*,(select count(*) as NB from peda_elv where peda_elv.elv_id=candidature.elv_id) as CONFIRM FROM convention left join candidature on candidature.cand_id=convention.cand_id and candidature.elv_id=convention.elv_id left join stage on stage.stage_id=candidature.stage_id left join type_stage on type_stage.type_id=stage.type_id left join eleve on eleve.elv_id=candidature.elv_id  where stage.ent_id=".$tab;
				break;
				case "mesconventionselv":
					$sql = "SELECT type_stage.type_lib,candidature.*,stage.metier, stage.dispo, eleve.elv_nom, eleve.elv_pren,convention.*,convention.ent_ok FROM convention left join candidature on candidature.cand_id=convention.cand_id left join stage on stage.stage_id=candidature.stage_id left join type_stage on type_stage.type_id=stage.type_id left join eleve on eleve.elv_id=candidature.elv_id  where convention.elv_id=".$tab;
				break;
				
				
			}
			$stmt = $conn->prepare($sql);
			$stmt->execute();
			$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
			$conn = null;
			
			return $res;
		}
		else {
		    echo("problème de connexion à la base de données");
		}
	}
	catch(PDOException $e){
    	echo $e->getMessage()." | Fichier :".$e->getFile()." | Ligne :".$e->getLine();
		$conn = null;
    }
}

//****************************************************************************************
// Fonction : recData
// Paramètres : typ -- Type de récupération
// 				id - identifiant
// Description : Récupération des données par rapport a un identifiant 
//***************************************************************************************
function recData($typ,$tab=""){
	try{
		//Connexion à la base de données
		$conn = ConnBDDpdo();
	
		if(!empty($conn)){
			//requête de sélection des données		
			switch($typ){					
				case "eleve":
					$sql = "SELECT eleve.*,uai.*,classe.class_lib FROM eleve left join classe on classe.class_id=eleve.elv_class left join uai on uai.uai_rne=eleve.elv_uai WHERE eleve.elv_id =".$tab;
				break;
                case "entreprise":
                    $sql = "SELECT entreprise.* FROM entreprise WHERE entreprise.ent_id =".$tab;
                    break;
                case "pedagogique":
                    $sql = "SELECT pedagogique.* FROM pedagogique WHERE pedagogique.peda_id =".$tab;
                    break;
				case "stagenotpublish":
					$sql = "SELECT COUNT(*) as NB FROM stage WHERE stage.publish=0 and stage.ent_id =".$tab;
				break;
				case "stage":
					$sql = "SELECT entreprise.*, stage.*, type_stage.type_lib, secteur.sect_lib,commune.Ile,commune.Geo FROM stage left join entreprise on entreprise.ent_id=stage.ent_id left join commune on commune.IDGeo=stage.stage_com left join type_stage on type_stage.type_id=stage.type_id left join secteur on secteur.sect_id=stage.dom_id and secteur.typ_id=stage.type_id WHERE stage.stage_id =".$tab;
				break;
				case "stage_horaire1":
					$sql = "SELECT stage_horaire.* FROM stage_horaire WHERE stage_horaire.day_id=1 and stage_horaire.stage_id =".$tab;
				break;
				case "stage_horaire2":
					$sql = "SELECT stage_horaire.* FROM stage_horaire WHERE stage_horaire.day_id=2 and stage_horaire.stage_id =".$tab;
				break;
				case "stage_horaire3":
					$sql = "SELECT stage_horaire.* FROM stage_horaire WHERE stage_horaire.day_id=3 and stage_horaire.stage_id =".$tab;
				break;
				case "stage_horaire4":
					$sql = "SELECT stage_horaire.* FROM stage_horaire WHERE stage_horaire.day_id=4 and stage_horaire.stage_id =".$tab;
				break;
				case "stage_horaire5":
					$sql = "SELECT stage_horaire.* FROM stage_horaire WHERE stage_horaire.day_id=5 and stage_horaire.stage_id =".$tab;
				break;
				case "stage_horaire6":
					$sql = "SELECT stage_horaire.* FROM stage_horaire WHERE stage_horaire.day_id=6 and stage_horaire.stage_id =".$tab;
				break;
				case "lstoffre3emesize":
				
					if($tab=="-1"){
						
						$sql = "SELECT count(*) as NB FROM stage WHERE stage.type_id=1 and stage.publish=1 and suspend=0";
						
					}else{
						
						$sql = "SELECT count(*) as NB FROM stage WHERE stage.type_id=1 and stage.dom_id IN (".$tab[0].") and stage.publish=1 and suspend=0";
						
					}
					
				break;
				case "lstoffrepfmpsize":
					
					if($tab=="-1"){
						
						$sql = "SELECT count(*) as NB FROM stage WHERE stage.type_id=2 and stage.publish=1 and suspend=0";
						
					}else{
						
						$sql = "SELECT count(*) as NB FROM stage WHERE stage.type_id=2 and stage.dom_id IN (".$tab[0].") and stage.publish=1 and suspend=0";
						
					}
					
					
					
				break;
				case "lstoffrebtssize":
				
					if($tab=="-1"){
						
						$sql = "SELECT count(*) as NB FROM stage WHERE stage.type_id=3 and stage.publish=1 and suspend=0";
						
					}else{
						
						$sql = "SELECT count(*) as NB FROM stage WHERE stage.type_id=3 and stage.dom_id IN (".$tab[0].") and stage.publish=1 and suspend=0";
						
					}
					
				break;
				case "domaine":
					$sql = "SELECT secteur.* FROM secteur WHERE secteur.typ_id=2 and secteur.sect_id =".$tab;
				break;
				case "candidature":
					$sql = "SELECT candidature.* FROM candidature WHERE candidature.cand_id =".$tab;
				break;
				case "testcandidature":
					$sql = "SELECT candidature.* FROM candidature WHERE candidature.elv_id =".$tab[0]." and candidature.stage_id=".$tab[1];
				break;
				case "candstage":
					$sql = "SELECT COUNT(*) as NB FROM candidature WHERE candidature.stage_id =".$tab;
				break;
				case "convention":
					$sql = "SELECT convention.*,secteur.sect_lib, classe.class_lib FROM convention left join classe on classe.class_id=convention.elv_class left join secteur on secteur.sect_id=convention.ent_domaine and secteur.typ_id=1 WHERE convention.cand_id =".$tab[0]." and elv_id=".$tab[1];
				break;
				case "candcours":
					$sql = "SELECT COUNT(*) as NB FROM candidature WHERE candidature.elv_id =".$tab." and statut=1";
				break;
				case "convcours":
					$sql = "SELECT COUNT(*) as NB FROM convention WHERE convention.elv_id =".$tab." and ent_ok=0 and etab_ok=0 and elv_ok=0 and ref_ok=0 and prof_ok=0";
				break;
				case "entreprisenotificationcand":
					$sql = "SELECT COUNT(*) as NB FROM candidature left join stage on stage.stage_id=candidature.stage_id WHERE candidature.notif_ent IS NULL and stage.ent_id =".$tab;
				
				break;
				case "entreprisenotificationconv":
					$sql = "SELECT COUNT(*) as NB FROM convention left join candidature on candidature.cand_id=convention.cand_id left join stage on stage.stage_id=candidature.stage_id WHERE convention.notif_ent IS NULL and stage.ent_id =".$tab;
				
				break;
				case "elevenotificationcand1":
					$sql = "SELECT COUNT(*) as NB FROM candidature left join stage on stage.stage_id=candidature.stage_id WHERE candidature.notif_elv IS NULL and stage.type_id=1 and  candidature.elv_id=".$tab;
				
				break;
				case "elevenotificationcand2":
					$sql = "SELECT COUNT(*) as NB FROM candidature left join stage on stage.stage_id=candidature.stage_id WHERE candidature.notif_elv IS NULL and stage.type_id=2 and  candidature.elv_id=".$tab;
				
				break;
				case "elevenotificationcand3":
					$sql = "SELECT COUNT(*) as NB FROM candidature left join stage on stage.stage_id=candidature.stage_id WHERE candidature.notif_elv IS NULL and stage.type_id=3 and  candidature.elv_id=".$tab;
				
				break;
				case "elevenotificationconv":
					$sql = "SELECT COUNT(*) as NB FROM convention WHERE convention.notif_elv IS NULL and convention.elv_id =".$tab;
				
				break;
				case "pedanotificationcand1":
					$sql = "SELECT COUNT(*) as NB FROM candidature left join stage on stage.stage_id=candidature.stage_id WHERE candidature.notif_peda IS NULL and stage.type_id=1 and  candidature.elv_id=".$tab;
				
				break;
				case "pedanotificationcand2":
					$sql = "SELECT COUNT(*) as NB FROM candidature left join stage on stage.stage_id=candidature.stage_id WHERE candidature.notif_peda IS NULL and stage.type_id=2 and  candidature.elv_id=".$tab;
				
				break;
				case "pedanotificationcand3":
					$sql = "SELECT COUNT(*) as NB FROM candidature left join stage on stage.stage_id=candidature.stage_id WHERE candidature.notif_peda IS NULL and stage.type_id=3 and  candidature.elv_id=".$tab;
				
				break;
				case "pedanotificationconv":
					$sql = "SELECT COUNT(*) as NB FROM convention WHERE convention.notif_peda IS NULL and convention.elv_id =".$tab;
				
				break;
                /********NOMENCLATURE**********/
				              
            }
			$stmt = $conn->prepare($sql);
			$stmt->execute();
			$res = $stmt->fetch(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
			$conn = null;
			
			return $res;
		}
		else {
		    echo("problème de connexion à la base de données");
		}
	}
	catch(PDOException $e){
    	echo $e->getMessage()." | Fichier :".$e->getFile()." | Ligne :".$e->getLine();
		$conn = null;
    }
}


function close_session(){
	
	//$_SESSION = array();
	// récupérer les paramètres du cookie 
	//$params = session_get_cookie_params();
	// Effacer le cookie actuel.
	//setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
	// Détruire la session
	unset($_SESSION['elv_id']);
	unset($_SESSION['elv_string']);
	unset($_SESSION['elv_uai']);
	unset($_SESSION['elv_mail']);
	
	unset($_SESSION['ent_id']);
	unset($_SESSION['ent_string']);
	unset($_SESSION['ent_mail']);
	
	unset($_SESSION['peda_id']);
	unset($_SESSION['peda_string']);
	unset($_SESSION['peda_mail']);
	
	unset($_SESSION['user_typ']);
	
	
	unset($_COOKIE['pseudocookieelv']); 
	setcookie('pseudocookieelv', '', -1, '/'); 
	unset($_COOKIE['pseudocookieent']); 
	setcookie('pseudocookieent', '', -1, '/'); 
	unset($_COOKIE['pseudocookiepeda']); 
	setcookie('pseudocookiepeda', '', -1, '/'); 
	unset($_COOKIE['passwordcookieelv']); 
	setcookie('passwordcookieelv', '', -1, '/'); 
	unset($_COOKIE['passwordcookieent']); 
	setcookie('passwordcookieent', '', -1, '/'); 
	unset($_COOKIE['passwordcookiepeda']); 
	setcookie('passwordcookiepeda', '', -1, '/');
	
	
}

/***********CONNECT WITH COOKIE********************/

function setconnectfromcookie(){
	
	try {
         
		$conn = ConnBDDpdo();
		$err="";
		if(!empty($conn)){
				
			if(isset($_COOKIE["pseudocookieelv"]) and isset($_COOKIE["passwordcookieelv"])){
						
				$usrlg=$_COOKIE["pseudocookieelv"];
				$password=$_COOKIE["passwordcookieelv"];
				
				$sql = "SELECT * FROM eleve WHERE eleve.elv_mail = :elv_mail LIMIT 1"; 
				$stmt = $conn->prepare($sql);
				$stmt->bindParam(':elv_mail', $usrlg);
				$stmt->execute();
				$res = $stmt->fetch(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
					
				if(!empty($res)){
					
					$usr_id = $res['elv_id'];
					$usr_mail = $res['elv_mail'];
					$usr_pwd = $res['elv_password'];
					$usr_salt = $res['elv_hash'];
					$uai_rne = $res['elv_uai'];
						
					if($usr_pwd == $password) { 
					
						$usr_browser = $_SERVER['HTTP_USER_AGENT']; // Obtention de la chaine user-agent de l'utilisateur.
						$usr_id = preg_replace("/[^0-9]+/", "", $usr_id); // protection XSS si l'on doit afficher cette valeur
						$usr_id=encryptIt($usr_id,$_SESSION["hashsession"]);
						$_SESSION['elv_id'] = $usr_id;
						$_SESSION['elv_string'] = hash('sha512', $usr_pwd.$usr_browser);
						$_SESSION['elv_uai'] = $uai_rne;
						$_SESSION['user_typ'] = 1;
						$_SESSION['elv_mail'] = $usr_mail;
						
					 
					}else
						$err = "lgpwd"; 
						
				}
				
			}else if(isset($_COOKIE["pseudocookieent"],$_COOKIE["passwordcookieent"])){
						
				$usrlg=$_COOKIE["pseudocookieent"];
				$password=$_COOKIE["passwordcookieent"];
				
				$stmt = $conn->prepare("SELECT * FROM entreprise WHERE entreprise.ent_mail = :ent_mail LIMIT 1");
				$stmt->bindParam(':ent_mail', $usrlg);
				$stmt->execute();
				$res = $stmt->fetch(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				
				if(!empty($res)){
						$usr_id = $res['ent_id'];
						$usr_mail = $res['ent_mail'];
						$usr_pwd = $res['ent_password'];
						$usr_salt = $res['ent_hash'];
						
						if($usr_pwd == $password) { 
						
							$usr_browser = $_SERVER['HTTP_USER_AGENT']; // Obtention de la chaine user-agent de l'utilisateur.
							$usr_id = preg_replace("/[^0-9]+/", "", $usr_id); // protection XSS si l'on doit afficher cette valeur
							$usr_id=encryptIt($usr_id,$_SESSION["hashsession"]);
							$_SESSION['ent_id'] = $usr_id;
							$_SESSION['ent_string'] = hash('sha512', $usr_pwd.$usr_browser);
							$_SESSION['user_typ'] = 2;
							$_SESSION['ent_mail'] = $usr_mail;
							
						 
						}else
							$err = "lgpwd"; 
				}
			
			}else if(isset($_COOKIE["pseudocookiepeda"]) and isset($_COOKIE["passwordcookiepeda"])){
					
				$usrlg=$_COOKIE["pseudocookiepeda"];
				$password=$_COOKIE["passwordcookiepeda"];
				
				$sql = "SELECT * FROM pedagogique WHERE pedagogique.peda_mail = :peda_mail LIMIT 1"; 
				$stmt = $conn->prepare($sql);
				$stmt->bindParam(':peda_mail', $usrlg);
				$stmt->execute();
				$res = $stmt->fetch(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
					
				if(!empty($res)){
						$usr_id = $res['peda_id'];
						$usr_mail = $res['peda_mail'];
						$usr_pwd = $res['peda_password'];
						$usr_salt = $res['peda_hash'];
						$uai_rne = $res['peda_uai'];
							
						if($usr_pwd == $password) { 
						
							$usr_browser = $_SERVER['HTTP_USER_AGENT']; // Obtention de la chaine user-agent de l'utilisateur.
							$usr_id = preg_replace("/[^0-9]+/", "", $usr_id); // protection XSS si l'on doit afficher cette valeur
							$usr_id=encryptIt($usr_id,$_SESSION["hashsession"]);
							$_SESSION['peda_id'] = $usr_id;
							$_SESSION['peda_string'] = hash('sha512', $usr_pwd.$usr_browser);
							$_SESSION['peda_uai'] = $uai_rne;
							$_SESSION['user_typ'] = 3;
							$_SESSION['peda_mail'] = $usr_mail;
							
						 
						}else
							$err = "lgpwd"; 
				}
			
			}
				
				$err = "lgusr"; // Utilisateur inexistant. 
				
				$conn = null; //Fermeture de la connexion
				
			
		}
		else
			$err = "connerr"; // Problème de connexion
			
		return $err;
	}
	catch(PDOException $e){
    	$err = $e;
		$conn = null;
		return $err;
    }

}


function getWeek(){
	
$tabweeks=array();

$currYear = date("Y");

$firstDayOfYear = mktime(0, 0, 0, 1, 1, $currYear);
$nextMonday     = strtotime('monday', $firstDayOfYear);
$nextSunday     = strtotime('friday', $nextMonday);

$number=1;
while (date('Y', $nextMonday) == $currYear) {
	
   //$week=date('d/m/Y', $nextMonday).'-'.date('d/m/Y', $nextSunday);
   
	$array=array($number,date('d/m/Y', $nextMonday),date('d/m/Y', $nextSunday));
	
	if($nextMonday>strtotime("now"))array_push($tabweeks,$array);
	
	
    $nextMonday = strtotime('+1 week', $nextMonday);
    $nextSunday = strtotime('+1 week', $nextSunday);
	
	$number++;	
}
	

return $tabweeks;

}


function getmois($mois){
	
	$moislib="";
	
	switch($mois){
		
		case "01":
			$moislib="janvier";
		break;
		case "02":
			$moislib="février";
		break;
		case "03":
			$moislib="mars";
		break;
		case "04":
			$moislib="avril";
		break;
		case "05":
			$moislib="mai";
		break;
		case "06":
			$moislib="juin";
		break;
		case "07":
			$moislib="juillet";
		break;
		case "08":
			$moislib="aoùt";
		break;
		case "09":
			$moislib="septembre";
		break;
		case "10":
			$moislib="octobre";
		break;
		case "11":
			$moislib="novembre";
		break;
		case "12":
			$moislib="décembre";
		break;
		
	}
	
	return $moislib;
	
}

function random_str_generator($len_of_gen_str){
	
	try {

        //initialisation du message d'erreur
        $err = "";

		//Connexion à la base de données
		$conn = ConnBDDpdo();
		
		$chaine="";

		$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
		$var_size = strlen($chars);
		echo "Random string ="; 
		for( $x = 0; $x < $len_of_gen_str; $x++ ) {
			$random_str= $chars[ rand( 0, $var_size - 1 ) ];  
		   $chaine.=$random_str;  
		}

		
		$stmt = $conn->prepare("SELECT count(*) as NB FROM stage WHERE reference = :chaine");
		$stmt->bindParam(':chaine', $chaine);
		$stmt->execute();
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		$stmt->closeCursor();
		
		if($res["NB"]==0){
			
			return $chaine;
			
		}else{
			
			return random_str_generator($len_of_gen_str);
		}
			
	} catch (PDOException $e) {
        $err = $e;
        $conn = null;
        return $err;
    }
	
}


 function funct_encode($texte){
	
	$texte=utf8_encode($texte);
	
	return $texte;
	 
 }
 
  function funct_decode($texte){
	
	$texte=utf8_decode($texte);
	
	return $texte;
	 
 }

require_once get_template_directory() . '/functiondev1.php';
require_once get_template_directory() . '/functiondev2.php';