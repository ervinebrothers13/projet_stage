<?php 
include_once("../../../wp-load.php"); 
include_once("../../../wp-config.php"); 

if(session_id()=="")session_start(); 
if(!isset($_SESSION["hashsession"]))$_SESSION["hashsession"]=get_hash();
				
//Récupération du mode d'action
if (array_key_exists('act',$_POST))
  $action = $_POST["act"];
if (array_key_exists('act',$_GET))
  $action = $_GET["act"]; 

//********************************************************************************************************************************
// 												TRAITEMENT DES DONNEES
//********************************************************************************************************************************

$balise = "";

switch ($action){
/**************************GESTION CMS*************************************************/
   //Entreprise
   case "seconnecterent":

        $err = seconnecterent($_POST);
		if($_POST["redirect"]!=""){
			
			if($_POST["type_id"]!=""){
				
				$urlok = "/".$_POST["redirect"]."/?msg=connected&type=".$_POST["type_id"];
				
			}else{
				
				$urlok = "/".$_POST["redirect"]."/?msg=connected";
				
			}
			
			 
			 
		}else{
			
			 $urlok = "/espace-entreprise/?msg=connected";
			
		}
		
		
		
		 
		if($err=="errtoken"){
			$urlko = "/espace-entreprise/?ong=resend";
			$balise = "#messageactivediv";
			
		}else  $urlko = "/espace-entreprise/?ong=connexion";
		
        break;
	case "seconnecterurlent":
		$err = seconnecterurlent($_GET);
		$redirect="";if(isset($_GET["redirect"]))$redirect="&ong=".$_GET["redirect"];
		$urlok = "/espace-entreprise/?msg=connected".$redirect;
        $urlko = "/espace-entreprise/";
	break;
    case "registerent":

        $err = registerent($_POST);
        $urlok = "/espace-entreprise/?ong=create&msg=mailsend";
        $urlko = "/espace-entreprise/?ong=create";
        $balise = "#createaccountdiv";
        break;
    case "accountactiveent":

        $err = accountactiveent($_GET);
        $urlok = "/espace-entreprise/?msg=verified";
        $urlko = "/espace-entreprise/?ong=resend";
        break;
	 case "forgetpasswordent":

        $err = forgetpasswordent($_POST);
        $urlok = "/espace-entreprise/?ong=passforget&msg=sendgood";
        $urlko = "/espace-entreprise/?ong=passforget";
		$balise = "#passwordforgetdiv";
        break;
	 case "reinitpasswordent":

        $err = reinitpasswordent($_POST);
        $urlok = "/espace-entreprise/?ong=connexion&msg=reinitok";
        $urlko = "/reinitialisation-de-votre-mot-de-passe/?token=".$_POST["token"];
		
        break;
	case "messageactiveent":

        $err = messageactiveent($_POST);
        $urlok = "/espace-entreprise/?ong=resend&msg=resendgood";
        $urlko = "/espace-entreprise/?ong=resend";
		$balise = "#messageactivediv";
        break;
	case "modifmailent":

        $err = modifmailent($_POST);
        $urlok = "/espace-entreprise/?ong=profil&msg=mailsend";
        $urlko = "/espace-entreprise/?ong=profil";

        break;
	case "modiftahitient":

        $err = modiftahitient($_POST);
        $urlok = "/espace-entreprise/?ong=connexion&msg=tahitichange";
        $urlko = "/espace-entreprise/?ong=profil";

        break;
	 case "validnewemailent":

        $err = validnewemailent($_GET);
        $urlok = "/espace-entreprise/?ong=profil&msg=newemail";
        $urlko = "/espace-entreprise/?ong=profil";

        break;
	case "modifpasswordent":

        $err = modifpasswordent($_POST);
        $urlok = "/espace-entreprise/?ong=profil&msg=passchange";
        $urlko = "/espace-entreprise/?ong=profil";

        break;
	case "modifinfoent":

        $err = modifinfoent($_POST, $_FILES);
        $urlok = "/espace-entreprise/?ong=info&msg=infochange";
        $urlko = "/espace-entreprise/?ong=info";

     break;
	case "confirmedent":

        $err = confirmedent($_GET);
        $urlok = "/wp-admin/admin.php?page=entrepris_ewait";
        $urlko = "/wp-admin/admin.php?page=entrepris_ewait";

     break;
	case "reclinedent":

        $err = reclinedent($_GET);
        $urlok = "/wp-admin/admin.php?page=entrepris_ewait";
        $urlko = "/wp-admin/admin.php?page=entrepris_ewait";

     break;
	 case "desactiverent":

        $err = desactiverent($_GET);
        $urlok = "/wp-admin/admin.php?page=entrepris_list";
        $urlko = "/wp-admin/admin.php?page=entrepris_list";

     break;
	case "activerent":

        $err = activerent($_GET);
        $urlok = "/wp-admin/admin.php?page=entrepris_list";
        $urlko = "/wp-admin/admin.php?page=entrepris_list";

     break;
	  case "desactiverelv":

        $err = desactiverelv($_GET);
        $urlok = "/wp-admin/admin.php?page=eleve_list";
        $urlko = "/wp-admin/admin.php?page=eleve_list";

     break;
	case "activerelv":

        $err = activerelv($_GET);
        $urlok = "/wp-admin/admin.php?page=eleve_list";
        $urlko = "/wp-admin/admin.php?page=eleve_list";

     break;
	  case "desactiverpeda":

        $err = desactiverpeda($_GET);
        $urlok = "/wp-admin/admin.php?page=peda_list";
        $urlko = "/wp-admin/admin.php?page=peda_list";

     break;
	case "activerpeda":

        $err = activerpeda($_GET);
        $urlok = "/wp-admin/admin.php?page=peda_list";
        $urlko = "/wp-admin/admin.php?page=peda_list";

     break;
	 case "addstage1":

        $err = addstage1($_POST, $_FILES);
        $urlok = "/deposer-une-offre/?etape=2&stage=".$lastid;
        $urlko = "/deposer-une-offre/?etape=1&stage=".$lastid;

     break;
	  case "addstage2":

        $err = addstage2($_POST);
        $urlok = "/deposer-une-offre/?etape=3&stage=".$lastid;
        $urlko = "/deposer-une-offre/?etape=2&stage=".$lastid;

     break;
	  case "addstage3":

        $err = addstage3($_POST);
        $urlok = "/deposer-une-offre/?etape=4&stage=".$lastid;
        $urlko = "/deposer-une-offre/?etape=3&stage=".$lastid;

     break;
	  case "addstage4":

        $err = addstage4($_POST);
        $urlok = "/deposer-une-offre/?etape=5&stage=".$lastid;
        $urlko = "/deposer-une-offre/?etape=4&stage=".$lastid;

     break;
	  case "addstage5":

        $err = addstage5($_POST);
        $urlok = "/espace-entreprise/?ong=".$ongstage;
        $urlko = "/deposer-une-offre/?etape=5&stage=".$lastid;

     break;
	 case "supprimerstage":

        $err = supprimerstage($_POST);
        $urlok = "/espace-entreprise/?ong=".$_POST["chpidp"];
        $urlko = "/espace-entreprise/?ong=".$_POST["chpidp"];

     break;
	  case "closestage":

        $err = closestage($_POST);
        $urlok = "/espace-entreprise/?ong=".$_POST["chpidp"];
        $urlko = "/espace-entreprise/?ong=".$_POST["chpidp"];

     break;
	 case "openstage":

        $err = openstage($_POST);
        $urlok = "/espace-entreprise/?ong=".$_POST["chpidp"];
        $urlko = "/espace-entreprise/?ong=".$_POST["chpidp"];

     break;
	  case "postuler1":

        $err = postuler1($_POST);
        $urlok = "/postuler/?cand=".$lastid;
        $urlko = "/postuler/?cand=".$lastid;

     break;
	  case "postuler2":

        $err = postuler2($_POST);
        $urlok = "/postuler/?cand=".$lastid;
        $urlko = "/postuler/?cand=".$lastid;

     break;
	  case "postuler3":

        $err = postuler3($_POST, $_FILES);
        $urlok = "/postuler/?cand=".$lastid;
        $urlko = "/postuler/?cand=".$lastid;

     break;
	  case "postuler4":

        $err = postuler4($_POST);
		
		if(lgchkpeda()){
			
			if($lasttyp=="1"){
				
				$urlok = "/espace-pedagogique/?ong=lstlv&showelv=".$lastelv."&ong2=3eme";
				
			}else if($lasttyp=="2"){
				
				$urlok = "/espace-pedagogique/?ong=lstlv&showelv=".$lastelv."&ong2=pfmp";
				
			}else{
				
				$urlok = "/espace-pedagogique/?ong=lstlv&showelv=".$lastelv."&ong2=bts";
				
			}
		}else{
			
			if($lasttyp=="1"){
			
				$urlok = "/espace-eleve/?ong=3eme&msg=candidated1";
			
			}else if($lasttyp=="2"){
			
				$urlok = "/espace-eleve/?ong=pfmp&msg=candidated2";
			
			}else{
				
				 $urlok = "/espace-eleve/?ong=bts&msg=candidated3";
				 
			}
		
		}
        $urlko = "/postuler/?cand=".$lastid;

     break;
	case "supprimercand":

        $err = supprimercand($_POST);
		if($lasttyp=="1"){
			
			$urlok = "/offre-stage/?offre3eme=".$laststage;
		
		}else if($lasttyp=="2"){
			
			$urlok = "/offre-stage/?pfmp=".$laststage;
		
		}else{
			
			 $urlok = "/offre-stage/?bts=".$laststage;
			 
		}
		$urlko = "/postuler/?cand=".$lastid;

     break;
	 case "supprimercand2":

        $err = supprimercand($_POST);
		if($lasttyp=="1"){
			
			$urlok = "/espace-eleve/?ong=3eme&msg=suppgood1";
			$urlko = "/espace-eleve/?ong=3eme";
		
		}else if($lasttyp=="2"){
			
			$urlok = "/espace-eleve/?ong=pfmp&msg=suppgood2";
			$urlko = "/espace-eleve/?ong=pfmp";
		
		}else{
			
			 $urlok = "/espace-eleve/?ong=bts&msg=suppgood2";
			 $urlko = "/espace-eleve/?ong=bts";
			 
		}
		

     break;
	 case "supprimercand3":

        $err = supprimercand3($_POST);
		if($lasttyp=="1"){
			
			$urlok = "/espace-pedagogique/?ong=lstlv&showelv=".$lastelv."&ong2=3eme";
			$urlko = "/espace-pedagogique/?ong=lstlv&showelv=".$lastelv."&ong2=3eme";
		
		}else if($lasttyp=="2"){
			
			$urlok = "/espace-pedagogique/?ong=lstlv&showelv=".$lastelv."&ong2=pfmp";
			$urlko = "/espace-pedagogique/?ong=lstlv&showelv=".$lastelv."&ong2=pfmp";
		
		}else{
			
			 $urlok = "/espace-pedagogique/?ong=lstlv&showelv=".$lastelv."&ong2=bts";
			 $urlko = "/espace-pedagogique/?ong=lstlv&showelv=".$lastelv."&ong2=bts";
			 
		}
		

     break;
	  case "supprimercand4":

        $err = supprimercand3($_POST);
		if($lasttyp=="1"){
			
			$urlok = "/espace-pedagogique/?ong=lstlv&showelv=".$lastelv."&ong2=3eme";
			$urlko = "/espace-pedagogique/?ong=lstlv&showelv=".$lastelv."&ong2=3eme";
		
		}else if($lasttyp=="2"){
			
			$urlok = "/espace-pedagogique/?ong=lstlv&showelv=".$lastelv."&ong2=pfmp";
			$urlko = "/espace-pedagogique/?ong=lstlv&showelv=".$lastelv."&ong2=pfmp";
		
		}else{
			
			 $urlok = "/espace-pedagogique/?ong=lstlv&showelv=".$lastelv."&ong2=bts";
			 $urlko = "/espace-pedagogique/?ong=lstlv&showelv=".$lastelv."&ong2=bts";
			 
		}
		

     break;
    case "supprimerelv":

        $err = supprimerelv($_POST);
        $urlok = "/espace-pedagogique/?ong=lstlv&msg=lvsup";
        $urlko = "/espace-pedagogique/?ong=profil";

        break;
	case "acceptcand":

        $err = acceptcand($_POST);
        $urlok = "/espace-entreprise/?ong=convention&msg=accepted";
        $urlko = "/espace-entreprise/?ong=candidature";

    break;
	case "refuscand":

        $err = refuscand($_POST);
        $urlok = "/espace-entreprise/?ong=candidature&msg=refused";
        $urlko = "/espace-entreprise/?ong=candidature";

    break;
	case "modifconv":

        $err = modifconv($_POST, $_FILES);
        $urlok = "/modifier-convention/?cand=".$_POST["candid"]."&msg=modified";
        $urlko = "/modifier-convention/?cand=".$_POST["candid"];

    break;
}
if(!empty($err)){	
	
	$url = $urlko."&msg=".$err;
	
}
else{


	$url = $urlok;
}
if(isset($url))
	header("Location: ".get_site_url().$url. $balise);
?>
