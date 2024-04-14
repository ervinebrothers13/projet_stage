<?php
include_once("../../../wp-load.php");
include_once("../../../wp-config.php");

if (session_id() == "") session_start();
if (!isset($_SESSION["hashsession"])) $_SESSION["hashsession"] = get_hash();

//Récupération du mode d'action
if (array_key_exists('act', $_POST))
    $action = $_POST["act"];
if (array_key_exists('act', $_GET))
    $action = $_GET["act"];

//********************************************************************************************************************************
// 												TRAITEMENT DES DONNEES
//********************************************************************************************************************************

//term Visiteur = ni usr_elv, ni usr_peda, ni usr_ent

$balise = "";   //balise de repère

switch ($action) {
    /**************************GESTION CMS*************************************************/
    //Elève
    case "seconnecterelv":

        $err = seconnecterelv($_POST);
        //si un Visiteur a postuler sur offre (3e/PFMP) > redirige vers form_seco
        if ($_POST["redirect"] != "") {

            $stageurl = "";
            //si il y a un stage du usr_lv
            if ($_POST["stage"] != "") $stageurl = "&stage=" . $_POST["stage"];
            //après log > ramène sur pa_offre ouvert en dernier
            $urlok = "/" . $_POST["redirect"] . "/?msg=connected" . $stageurl;

        } else {

            //si tout va bien pour log > msg=connected 
            $urlok = "/espace-eleve/?msg=connected";

        }
        //si le cmpt n'a pas encore été validé > redirige sur balise
        if ($err == "errtoken") {
            $urlko = "/espace-eleve/?ong=resend";
            //repère la balise correspondante sur ma page et redirige vers..
            $balise = "#messageactivediv";

        } else  $urlko = "/espace-eleve/?ong=connexion";

        break;
    case "seconnecterurlelv":
        $err = seconnecterurlelv($_GET);
        $redirect = "";
        if (isset($_GET["redirect"])) $redirect = "&ong=" . $_GET["redirect"];
        $urlok = "/espace-eleve/?msg=connected" . $redirect;
        $urlko = "/espace-eleve/";
        break;
    //selon func registerelv > si fonctionne va sur $urlok sinon sur $urlko//écrit dans l'url du site
    case "registerelv":

        $err = registerelv($_POST);
        //si ok redirige vers page 'espace-eleve/onglet-create' avec un 'msg'-mailsend
        $urlok = "/espace-eleve/?ong=create&msg=mailsend";
        $urlko = "/espace-eleve/?ong=create";
        //repère la balise correspondante sur ma page et redirige vers..
        $balise = "#createaccountdiv";
        break;
    case "accountactiveelv":

        $err = accountactiveelv($_GET);
        //si le cmpt est activ > msg connected
        $urlok = "/espace-eleve/?msg=verified";;
        $urlko = "/espace-eleve/?ong=resend";
        break;
    case "forgetpasswordelv":

        $err = forgetpasswordelv($_POST);
        $urlok = "/espace-eleve/?ong=passforget&msg=sendgood";
        $urlko = "/espace-eleve/?ong=passforget";
        $balise = "#passwordforgetdiv";
        break;
    case "reinitpasswordelv":

        $err = reinitpasswordelv($_POST);
        $urlok = "/espace-eleve/?ong=connexion&msg=reinitok";
        //sinon ramène sur page reinitialisation-de-votre-mot-de-passe avec le token//si token != null alors cmpt pas verif
        $urlko = "/reinitialisation-de-votre-mot-de-passe/?token=" . $_POST["token"];

        break;
    case "messageactiveelv":

        $err = messageactiveelv($_POST);
        $urlok = "/espace-eleve/?ong=resend&msg=resendgood";
        $urlko = "/espace-eleve/?ong=resend";
        $balise = "#messageactivediv";
        break;
    case "modifmailelv":

        $err = modifmailelv($_POST);
        $urlok = "/espace-eleve/?ong=profil&msg=mailsend";
        $urlko = "/espace-eleve/?ong=profil";

        break;
    case "validnewemailelv":

        $err = validnewemailelv($_GET);
        $urlok = "/espace-eleve/?ong=profil&msg=newemail";
        $urlko = "/espace-eleve/?ong=profil";

        break;
    case "modifpasswordelv":

        $err = modifpasswordelv($_POST);
        $urlok = "/espace-eleve/?ong=profil&msg=passchange";
        $urlko = "/espace-eleve/?ong=profil";

        break;
    case "modifinfoelv":

        $err = modifinfoelv($_POST);
        $urlok = "/espace-eleve/?ong=info&msg=infochange";
        $urlko = "/espace-eleve/?ong=info";

        break;
    case "modifcvelv":

        $err = modifcvelv($_POST, $_FILES);
        $urlok = "/espace-eleve/?ong=cv&msg=cvchange";
        $urlko = "/espace-eleve/?ong=cv";

        break;

    //Pédagogique
    case "seconnecterpeda":

        $err = seconnecterpeda($_POST);
        $urlok = "/espace-pedagogique/?msg=connected";
        if ($err == "errtoken") {
            $urlko = "/espace-pedagogique/?ong=resend";
            $balise = "#messageactivediv";

        } else  $urlko = "/espace-pedagogique/?ong=connexion";

        break;
    case "registerpeda":

        $err = registerpeda($_POST);
        $urlok = "/espace-pedagogique/?ong=create&msg=mailsend";
        $urlko = "/espace-pedagogique/?ong=create";
        $balise = "#createaccountdiv";
        break;
    case "accountactivepeda":

        $err = accountactivepeda($_GET);
        $urlok = "/espace-pedagogique/?msg=verified";
        $urlko = "/espace-pedagogique/?ong=resend";
        break;
    case "forgetpasswordpeda":

        $err = forgetpasswordpeda($_POST);
        $urlok = "/espace-pedagogique/?ong=passforget&msg=sendgood";
        $urlko = "/espace-pedagogique/?ong=passforget";
        $balise = "#passwordforgetdiv";
        break;
    case "reinitpasswordpeda":

        $err = reinitpasswordpeda($_POST);
        $urlok = "/espace-pedagogique/?ong=connexion&msg=reinitok";
        $urlko = "/reinitialisation-de-votre-mot-de-passe/?token=" . $_POST["token"];

        break;
    case "messageactivepeda":

        $err = messageactivepeda($_POST);
        $urlok = "/espace-pedagogique/?ong=resend&msg=resendgood";
        $urlko = "/espace-pedagogique/?ong=resend";
        $balise = "#messageactivediv";
        break;
    case "modifmailpeda":

        $err = modifmailpeda($_POST);
        $urlok = "/espace-pedagogique/?ong=profil&msg=mailsend";
        $urlko = "/espace-pedagogique/?ong=profil";

        break;
    case "validnewemailpeda":

        $err = validnewemailpeda($_GET);
        $urlok = "/espace-pedagogique/?ong=profil&msg=newemail";
        $urlko = "/espace-pedagogique/?ong=profil";

        break;
    case "modifpasswordpeda":

        $err = modifpasswordpeda($_POST);
        $urlok = "/espace-pedagogique/?ong=profil&msg=passchange";
        $urlko = "/espace-pedagogique/?ong=profil";

        break;
    case "modifinfopeda":

        $err = modifinfopeda($_POST);
        $urlok = "/espace-pedagogique/?ong=info&msg=infochange";
        $urlko = "/espace-pedagogique/?ong=info";

        break;
    case "modifetabpeda":

        $err = modifetabpeda($_POST);
        $urlok = "/espace-pedagogique/?ong=profil&msg=etabchange";
        $urlko = "/espace-pedagogique/?ong=profil";

        break;
    case "searchlv":

        $err = searchlv($_POST);
        $urlok = "/espace-pedagogique/?ong=followlv&msg=lvfound";
        $urlko = "/espace-pedagogique/?ong=followlv";

        break;
    case "inscrireelvpeda":

        $err = inscrireelvpeda($_POST);
        $urlok = "/espace-pedagogique/?ong=preinsc&msg=registergood";
        $urlko = "/espace-pedagogique/?ong=preinsc&elvid=" . $lastid;

        break;
    case "suivreelv":

        $err = suivreelv($_POST);
        $urlok = "/espace-pedagogique/?ong=preinsc&msg=suivgood";
        $urlko = "/espace-pedagogique/?ong=followlv";

        break;


}

//url du site
$url = "";
if (!empty($err)) {

    $url = $urlko . "&msg=" . $err;
} else {

    $url = $urlok;
}

//si un url existe renvoie sur la page ..
if (isset($url))
    header("Location: " . get_site_url() . $url . $balise);
?>
