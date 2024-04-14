<?php
/*************************************************/
/***************Entreprise*****************************/
/*************************************************/

//********************************************************************
// Fonction : seconnecterent
// Paramètre(s): usrlg -- identifiant saisi par l'utilisateur
//               pwd -- Mot de passe saisi par l'utilisateur  
// Description : Sécurisation des variables de sessions
//********************************************************************
function seconnecterent($tab)   //form connexion compte elv
{
    try {

        //initialisation du message d'erreur
        $err = "";
		
        if (isset($tab['useremail'], $tab['userpassword'])) {

            // Formatage et validation des donn�es du formulaire
            $usrlog = $tab['useremail'];    //filtre champs maiil
            $usrpass = $tab['userpassword'];

            //Connexion à la base de données
            $conn = ConnBDDpdo();

            if (!session_id()) {
                session_start();
            }

            if (!empty($conn)) {

                $stmt = $conn->prepare("SELECT * FROM entreprise WHERE ent_mail = :ent_mail");
                $stmt->bindParam(':ent_mail', $usrlog);
                $stmt->execute();
                $res = $stmt->fetch(PDO::FETCH_ASSOC);
                $stmt->closeCursor();

                if(!empty($res)){
					
					$usr_id = $res['ent_id'];
					$usr_mail = $res['ent_mail'];
					$usr_pwd = $res['ent_password'];
					$usr_salt = $res['ent_hash'];
					$ent_token = $res['ent_token'];
					$suspend = $res['suspend'];
					
					$pwd = hash('sha512', $usrpass.$usr_salt);
					
					if($suspend=="0"){
						
						if($ent_token==null){
							
							if($usr_pwd == $pwd) {
								
								close_session();
								
								$usr_browser = $_SERVER['HTTP_USER_AGENT']; // Obtention de la chaine user-agent de l'utilisateur.
								$usr_id = preg_replace("/[^0-9]+/", "", $usr_id); // protection XSS si l'on doit afficher cette valeur
								$usr_id=encryptIt($usr_id,$_SESSION["hashsession"]);
								$_SESSION['ent_id'] = $usr_id;
								$_SESSION['ent_string'] = hash('sha512', $pwd.$usr_browser);
								$_SESSION['ent_mail'] = $usr_mail;
								$_SESSION['user_typ'] = 2;
								
								if($tab["remember"]=="1"){
									
									setcookie("pseudocookieent", $usr_mail, time() + 365*24*3600, "/", null, false, true);
									setcookie("passwordcookieent", $usr_pwd, time() + 365*24*3600, "/", null, false, true);
								
								}
								
							}else{

								$err = "errpassword";

							}

						}else{
							
							$err = "errtoken";
							
						}
					}else{
							
							$err = "errsuspens";
							
						}
					
                } else
                    $err = "errpassword";

                $conn = null;

            } else
                $err = "connerr";
        } else
            $err = "erroblg";


        return $err;

    } catch
    (PDOException $e) {
        $err = $e;
        $conn = null;
        return $err;
    }
}



//********************************************************************
// Fonction : lgchk
// Paramètre(s): aucun 
// Description : Compte le nombre de tentatives de login
//********************************************************************
function lgchkent() {
    // Vérifie si les variables de sessions sont remplies
	if(isset($_SESSION['ent_string']))
        return true;
    else
        return false;
}



//********************************************************************
// Fonction : seconnecterurlent 
// Description : se connecter avec un token
//********************************************************************
function seconnecterurlent($tab)
{
    try {
        //initialisation du message d'erreur
        $err = "";
        //connexion � la base de donn�es
        $conn = ConnBDDpdo();

        if (!empty($conn)) {

            //Ouverture d'une transaction
            //$conn->beginTransaction();

            if (isset($tab['token']) and ($tab['token']!="" and $tab['token']!=null)) {

                $activetoken = $tab['token'];

                $stmt = $conn->prepare("SELECT * FROM entreprise WHERE entreprise.ent_token3 = :ent_token");
                $stmt->bindParam(':ent_token', $activetoken);
                $stmt->execute();
				
				


                if ($stmt->rowCount() > 0) {

                    $res = $stmt->fetch(PDO::FETCH_ASSOC);
                    // Modification de l'utilisateur dans la BDD
                    $stmt = $conn->prepare("UPDATE entreprise SET ent_token=null WHERE entreprise.ent_id=:ent_id and entreprise.ent_token = :activetoken");
                    $stmt->bindParam(':activetoken', $activetoken);
                    $stmt->bindParam(':ent_id', $res['ent_id']);
                    $stmt->execute();

                    $stmt->closeCursor();

					$usr_id = $res['ent_id'];
					$usr_mail = $res['ent_mail'];
					$usr_pwd = $res['ent_password'];
					$usr_salt = $res['ent_hash'];
					
					$suspend = $res['suspend'];
					
					if($suspend=="0"){
						
						close_session();
						
						$usr_browser = $_SERVER['HTTP_USER_AGENT']; // Obtention de la chaine user-agent de l'utilisateur.
						$usr_id = preg_replace("/[^0-9]+/", "", $usr_id); // protection XSS si l'on doit afficher cette valeur
						$usr_id=encryptIt($usr_id,$_SESSION["hashsession"]);
						$_SESSION['ent_id'] = $usr_id;
						$_SESSION['ent_string'] = hash('sha512', $pwd.$usr_browser);
						$_SESSION['ent_mail'] = $usr_mail;
						$_SESSION['user_typ'] = 2;
					
					} else {

                        $err = "errtoken";

                    }

                } else {
                    $err = "errortoken";
                }

                $conn = null;

            } else {
                $err = "noactivetoken";
            }

        } else
            $err = "connerr";

        return $err;

    } catch
    (PDOException $e) {
        $err = $e;
        $conn = null;
        return $err;
    }
}

//********************************************************************
// Fonction : registerent
// Paramètre(s): usrlg -- identifiant saisi par l'utilisateur
//               pwd -- Mot de passe saisi par l'utilisateur  
// Description : Sécurisation des variables de sessions
//********************************************************************
function registerent($tab)  //form creation compte ent
{

    try {
        //Connexion à la base de données
        $conn = ConnBDDpdo();

        if (!session_id()) {
            session_start();
        }
        //initialisation du message d'erreur
        $err = "";              //var en cas d'erreur
		
        if (!empty($conn)) {
			
			if (isset($tab['useremailcrea'], $tab['usertahiti'], $tab['password1'], $tab['password2'])) {
                // Formatage et validation des donn�es du formulaire
               
			  // echo "1</br>";
			   $ent_mail = stripslashes((filter_var($tab['useremailcrea'], FILTER_VALIDATE_EMAIL)));    //filtre champs maiil
                $ent_mail = stripslashes((filter_var($ent_mail, FILTER_VALIDATE_EMAIL)));
                $usertahiti = stripslashes((filter_var($tab['usertahiti'], FILTER_SANITIZE_STRING)));
                $usrmdp = stripslashes((filter_var($tab['password1'], FILTER_SANITIZE_STRING)));
               
				if($tab['password1']!=$tab['password2']){
					
					$err="errorsame";
					return $err;
				}
				
				$tabtest=explode("-", $usertahiti);
				if(sizeof($tabtest)!=2){
					
					$err="errornumtahiti";
					return $err;
					
				}
				
				if(strlen($usertahiti)!=10){
					
					$err="errornumtahiti";
					return $err;
					
				}
				//echo "2</br>";
				 // Cr�ation d'un SALT al�atoire
                $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
                // Cryptage PHP du mot de passe
                $ent_password = hash('sha512', $usrmdp . $random_salt);
                $usrhash = hash('sha512', $ent_mail . $random_salt);
                $activetoken = hash('sha512', $ent_password . $usrhash);
				
				$ent_nom="";
				$ent_com=0;
				$ent_adr="";
				$ent_codepos="";
				$ent_pk="";
				$ent_quart="";
				$ent_rue="";
				$ent_imm="";
				$tel_etab="";
				$copier_etab="";
				$sect_etab="";
				$web_etab="";
				$desc_etab="";
				$domaine_etab="";
				$represant_etab="";
				$represant_funct_etab="";
				$logo_etab="";
				
				$new=0;
				
				$stmt = $conn->prepare("SELECT * FROM ispf_ent WHERE ispf_ent.num_tahiti_etab = :num_tahiti_etab");
				$stmt->bindParam(':num_tahiti_etab', $usertahiti);
				$stmt->execute();

				//echo "3</br>";
				if ($stmt->rowCount() > 0) {

					$res = $stmt->fetch(PDO::FETCH_ASSOC);
					
					$ent_nom=$res["nom_etab"];
					$ent_com=$res["com_etab"];
					$ent_adr=$res["adrgeo"];
					$ent_codepos=$res["code_postal_ENT"];
					$ent_pk=$res["pk"];
					$ent_quart=$res["quartier"];
					$ent_rue=$res["rue"];
					$ent_imm=$res["immeuble"];
					$tel_etab=$res["tel_etab"];
					$copier_etab=$res["copier_etab"];
					$sect_etab=$res["sect_etab"];
					$web_etab=$res["web_etab"];
					$desc_etab=$res["desc_etab"];
					$domaine_etab=$res["domaine_etab"];
					$represant_etab=$res["represant_etab"];
					$represant_funct_etab=$res["represant_funct_etab"];
					$logo_etab=$res["logo_etab"];
					
				}else{
					
					$tabtahiti=explode("-",$usertahiti);
					
					if(sizeof($tabtahiti)==2){
						
						$num_tahiti=$tabtahiti[0];
					
						$stmt = $conn->prepare("INSERT INTO ispf_ent (num_tahiti_etab, num_tahiti) VALUES (:num_tahiti_etab, :num_tahiti)");
						$stmt->bindParam(':num_tahiti_etab', $usertahiti);
						$stmt->bindParam(':num_tahiti', $num_tahiti);
						$stmt->execute();
						
						$new=1;
					
					}else{
						
						$err="errornumtahiti";
						return $err;
						
					}
					
				}
			
					
					$stmt = $conn->prepare("INSERT INTO entreprise (ent_mail, ent_password, ent_hash, ent_token, ent_numtahiti, ent_nom, ent_tel, ent_copier, ent_com, ent_adr, ent_codepos, ent_pk, ent_quart, ent_rue, ent_imm, ent_sect, ent_web, ent_desc, ent_domaine, ent_represant, ent_represant_funct, ent_logo, new, d_crea) VALUES (:ent_mail, :ent_password, :ent_hash, :ent_token, :ent_numtahiti, :ent_nom, :ent_tel, :ent_copier, :ent_com, :ent_adr, :ent_codepos, :ent_pk, :ent_quart, :ent_rue, :ent_imm, :ent_sect, :ent_web, :ent_desc, :ent_domaine, :ent_represant, :ent_represant_funct, :ent_logo, :new, NOW())");
					$stmt->bindParam(':ent_mail', $ent_mail);
					$stmt->bindParam(':ent_password', $ent_password);
					$stmt->bindParam(':ent_hash', $random_salt);
					$stmt->bindParam(':ent_token', $activetoken);
					$stmt->bindParam(':ent_numtahiti', $usertahiti);
					$stmt->bindParam(':ent_nom', $ent_nom);
					$stmt->bindParam(':ent_tel', $tel_etab);
					$stmt->bindParam(':ent_copier', $copier_etab);
					$stmt->bindParam(':ent_com', $ent_com);
					$stmt->bindParam(':ent_adr', $ent_adr);
					$stmt->bindParam(':ent_codepos', $ent_codepos);
					$stmt->bindParam(':ent_pk', $ent_pk);
					$stmt->bindParam(':ent_quart', $ent_quart);
					$stmt->bindParam(':ent_rue', $ent_rue);
					$stmt->bindParam(':ent_imm', $ent_imm);
					$stmt->bindParam(':ent_sect', $sect_etab);
					$stmt->bindParam(':ent_web', $web_etab);
					$stmt->bindParam(':ent_desc', $desc_etab);
					$stmt->bindParam(':ent_domaine', $domaine_etab);
					$stmt->bindParam(':ent_represant', $represant_etab);
					$stmt->bindParam(':ent_represant_funct', $represant_funct_etab);
					$stmt->bindParam(':ent_logo', $logo_etab);
					$stmt->bindParam(':new', $new);
					$stmt->execute();

					$url = get_template_directory_uri() . "/actiondev2.php?act=accountactiveent&token=" . $activetoken;
                $_SESSION["urlcrea_ent"]= $url;

                //message-validation-envoyé
					$to = $ent_mail;
					$subject = 'Validation de compte sur monstage.education.pf';

					$message = "Bonjour,<br>Veuillez trouver ci-dessous le lien pour activer votre compte sur monstage.education.pf.";
					$message .= "<p><a href='" . $url . "'>Activer mon compte</a></p>";
					$message .= "<p>Cordialement,</p>";
					$message .= "<p>DGEE - Direction Générale de l'Education et des enseignements</p>";
					$message .= "<p></p><p><i>Ce mail a été envoyé automatiquement via une application, merci de ne pas y répondre</i>.</p>";

					$headers = array('Content-Type: text/html; charset=UTF-8');

					wp_mail($to, $subject, $message, $headers);

				
				
				
                $stmt->closeCursor();

                

                $conn = null; //Fermeture de la connexion
            } else
                $err = "connerr"; // Problème de connexion

            return $err;
        }
    } catch
    (PDOException $e) {
        $err = $e;
        $conn = null;
        return $err;
    }
}

//********************************************************************
// Fonction : accountactiveent
// Paramètre(s): usrlg -- identifiant saisi par l'utilisateur
//               pwd -- Mot de passe saisi par l'utilisateur  
// Description : Sécurisation des variables de sessions
//********************************************************************
function accountactiveent($tab)
{
    try {
        //initialisation du message d'erreur
        $err = "";
        //connexion � la base de donn�es
        $conn = ConnBDDpdo();

        if (!empty($conn)) {

            //Ouverture d'une transaction
            //$conn->beginTransaction();

            if (isset($tab['token']) and ($tab['token']!="" and $tab['token']!=null)) {

                $activetoken = $tab['token'];

                $stmt = $conn->prepare("SELECT * FROM entreprise WHERE entreprise.ent_token = :ent_token");
                $stmt->bindParam(':ent_token', $activetoken);
                $stmt->execute();


                if ($stmt->rowCount() > 0) {

                    $res = $stmt->fetch(PDO::FETCH_ASSOC);
                    // Modification de l'utilisateur dans la BDD
                    $stmt = $conn->prepare("UPDATE entreprise SET ent_token=null WHERE entreprise.ent_id=:ent_id and entreprise.ent_token = :activetoken");
                    $stmt->bindParam(':activetoken', $activetoken);
                    $stmt->bindParam(':ent_id', $res['ent_id']);
                    $stmt->execute();

                    $stmt->closeCursor();

					$usr_id = $res['ent_id'];
					$usr_mail = $res['ent_mail'];
					$usr_pwd = $res['ent_password'];
					$usr_salt = $res['ent_hash'];
					
					$suspend = $res['suspend'];
					
					if($suspend=="0"){
						
						
					close_session();
					
						$usr_browser = $_SERVER['HTTP_USER_AGENT']; // Obtention de la chaine user-agent de l'utilisateur.
						$usr_id = preg_replace("/[^0-9]+/", "", $usr_id); // protection XSS si l'on doit afficher cette valeur
						$usr_id=encryptIt($usr_id,$_SESSION["hashsession"]);
						$_SESSION['ent_id'] = $usr_id;
						$_SESSION['ent_string'] = hash('sha512', $pwd.$usr_browser);
						$_SESSION['ent_mail'] = $usr_mail;
						$_SESSION['user_typ'] = 2;
						
						$blogusers = get_users('role=Administrator');
						
						foreach ($blogusers as $user) {
						
							$to = $user->user_email;
							
							$subject = 'Vous avez une nouvelle demande d\'authentification sur monstage.education.pf';
							$message .= "<p>Connectez-vous sur la plateforme pour valider ton identité</p>";
							$message = "Bonjour,<br>une nouvelle entreprise s'est inscrite sur le site monstage.education.pf</p>";
							$message .= "<p>Cordialement,</p>";
							$message .= "<p>DGEE - Direction Générale de l'Education et des enseignements</p>";
							$message .= "<p></p><p><i>Ce mail a été envoyé automatiquement via une application, merci de ne pas y répondre</i>.</p>";

							$headers = array('Content-Type: text/html; charset=UTF-8');

							wp_mail($to, $subject, $message, $headers);
						
						}
					
					}else{

                        $err = "errtoken";

                    }

                } else {
                    $err = "errortoken";
                }

                $conn = null;

            } else {
                $err = "noactivetoken";
            }

        } else
            $err = "connerr";

        return $err;

    } catch
    (PDOException $e) {
        $err = $e;
        $conn = null;
        return $err;
    }
}

function forgetpasswordent($tab){
	
	 try {
        //initialisation du message d'erreur
        $err = "";
        //connexion � la base de donn�es
        $conn = ConnBDDpdo();

        if (!empty($conn)) {

            if (isset($tab['useremailrecup'])) {
				
				$stmt = $conn->prepare("SELECT * FROM entreprise WHERE entreprise.ent_mail = :ent_mail");
				$stmt->bindParam(':ent_mail', $tab["useremailrecup"]);
				$stmt->execute();


				if ($stmt->rowCount() > 0) {

					$res = $stmt->fetch(PDO::FETCH_ASSOC);
							
					$activetoken = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
					
					$stmt = $conn->prepare("UPDATE entreprise SET ent_token2=:activetoken WHERE entreprise.ent_id=:ent_id");
					$stmt->bindParam(':activetoken', $activetoken);
					$stmt->bindParam(':ent_id', $res["ent_id"]);
					$stmt->execute();

					$url = get_site_url() . "/reinitialiser-votre-mot-de-passe/?token=" . $activetoken;
                    $_SESSION["urlmdp_ent"]= $url;

                    //message-validation-envoyé
					$to = $tab["useremailrecup"];
					$subject = 'Vous avez demandé une réinitialisation de votre mot de passe sur monstage.education.pf';

					$message = "Bonjour,<br>Vous avez demandé une réinitialisation de votre mot de passe. Si ce n'est pas vous qui avez fait cette demande, ne tenez pas compte de ce mail.<br>";
					$message .= "Pour réinitialisé votre mot de passe, cliquez sur le lien suivant :";
					$message .= "<p><a href='" . $url . "'>Réinitialiser mon mot de passe</a></p>";
					$message .= "<p>Cordialement,</p>";
					$message .= "<p>DGEE - Direction Générale de l'Education et des enseignements</p>";
					$message .= "<p></p><p><i>Ce mail a été envoyé automatiquement via une application, merci de ne pas y répondre</i>.</p>";

					$headers = array('Content-Type: text/html; charset=UTF-8');

					wp_mail($to, $subject, $message, $headers);
				
				}else{
					
					$err = "errnomail";
					
				}
				$stmt->closeCursor();
			}
				
				
		 } else
            $err = "connerr";

        return $err;

    } catch
    (PDOException $e) {
        $err = $e;
        $conn = null;
        return $err;
    }
	
}


function reinitpasswordent($tab){
	
		 try {
        //initialisation du message d'erreur
        $err = "";
        //connexion � la base de donn�es
        $conn = ConnBDDpdo();

        if (!empty($conn)) {

            if (isset($tab['token'],$tab['password1'],$tab['password2']) and ($tab['token']!="" and $tab['token']!=null)) {
				
				if($tab['password1']!=$tab['password2']){
					
					$err="errorsame";
					return $err;
				}
				
				$usrmdp=$tab['password1'];
				
				 // Cr�ation d'un SALT al�atoire
                $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
                // Cryptage PHP du mot de passe
                $mdphash = hash('sha512', $usrmdp . $random_salt);
				
				$stmt = $conn->prepare("UPDATE entreprise SET ent_token2=NULL, ent_password=:ent_password, ent_hash=:ent_hash WHERE entreprise.ent_token2=:token");
					$stmt->bindParam(':token', $tab['token']);
					$stmt->bindParam(':ent_password', $mdphash);
					$stmt->bindParam(':ent_hash', $random_salt);
					$stmt->execute();
				
			
			}
				
				
		 } else
            $err = "connerr";

        return $err;

    } catch
    (PDOException $e) {
        $err = $e;
        $conn = null;
        return $err;
    }
	
}



function messageactiveent($tab){
	
	 try {
        //initialisation du message d'erreur
        $err = "";
        //connexion � la base de donn�es
        $conn = ConnBDDpdo();

        if (!empty($conn)) {

            if (isset($tab['useremailresend'])) {
				
				$stmt = $conn->prepare("SELECT * FROM entreprise WHERE entreprise.ent_mail = :ent_mail");
				$stmt->bindParam(':ent_mail', $tab["useremailresend"]);
				$stmt->execute();


				if ($stmt->rowCount() > 0) {

					$res = $stmt->fetch(PDO::FETCH_ASSOC);
					
					if($res["ent_token"]==null){
						
						$err="erralact";
						
					}else{
						
						 $url = get_template_directory_uri() . "/actiondev2.php?act=accountactiveent&token=" . $res["ent_token"];
                        $_SESSION["urlresend_ent"]= $url;

                        //message-validation-envoyé
						$to = $tab["useremailresend"];
						$subject = 'Validation de compte sur monstage.education.pf';

						$message = "Bonjour,<br>Veuillez trouver ci-dessous le lien pour activer votre compte sur monstage.education.pf.";
						$message .= "<p><a href='" . $url . "'>Activer mon compte</a></p>";
						$message .= "<p>Cordialement,</p>";
						$message .= "<p>DGEE - Direction Générale de l'Education et des enseignements</p>";
						$message .= "<p></p><p><i>Ce mail a été envoyé automatiquement via une application, merci de ne pas y répondre</i>.</p>";

						$headers = array('Content-Type: text/html; charset=UTF-8');

						wp_mail($to, $subject, $message, $headers);
				
				
					}
					
				}else{
					
					$err = "errnomail2";
					
				}
				
			}
				
				
		 } else
            $err = "connerr";

        return $err;

    } catch
    (PDOException $e) {
        $err = $e;
        $conn = null;
        return $err;
    }
	
}



//********************************************************************
// Fonction : modifmailelv
// Paramètre(s): usrlg -- identifiant saisi par l'utilisateur
//               pwd -- Mot de passe saisi par l'utilisateur  
// Description : Sécurisation des variables de sessions
//********************************************************************
function modifmailent($tab)   //form connexion compte elv
{
    try {

        //initialisation du message d'erreur
        $err = "";

        if (isset($tab['useremailnew'])) {

            //Connexion à la base de données
            $conn = ConnBDDpdo();

            if (!session_id()) {
                session_start();
            }

				if (!empty($conn)) {
					
					$ent_id=decryptIt($_SESSION["ent_id"],$_SESSION["hashsession"]);
					
					 $token = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
					
					$stmt = $conn->prepare("UPDATE entreprise SET new_mail=:new_mail, ent_token2=:ent_token2 WHERE entreprise.ent_id=:ent_id");
					$stmt->bindParam(':ent_token2', $token);
					$stmt->bindParam(':new_mail', $tab['useremailnew']);
					$stmt->bindParam(':ent_id', $ent_id);		
					$stmt->execute();
					$stmt->closeCursor();	
					
					
					 $url = get_template_directory_uri() . "/actiondev2.php?act=validnewemailent&token=" . $token;
                    $_SESSION["urlnewmail_ent"]= $url;

                    //message-validation-envoyé
					$to = $tab['useremailnew'];
					$subject = 'Validation de votre nouvelle adresse email sur monstage.education.pf';

					$message = "Bonjour,<br>Veuillez trouver ci-dessous le lien pour valider la nouvelle adresse email votre compte sur monstage.education.pf.";
					$message .= "<p><a href='" . $url . "'>Valider mon mail</a></p>";
					$message .= "<p>Cordialement,</p>";
					$message .= "<p>DGEE - Direction Générale de l'Education et des enseignements</p>";
					$message .= "<p></p><p><i>Ce mail a été envoyé automatiquement via une application, merci de ne pas y répondre</i>.</p>";

					$headers = array('Content-Type: text/html; charset=UTF-8');

					wp_mail($to, $subject, $message, $headers);
					
					$conn = null;

				} else
					$err = "connerr";
        } else
            $err = "erroblg";


        return $err;

    } catch
    (PDOException $e) {
        $err = $e;
        $conn = null;
        return $err;
    }
}




//********************************************************************
// Fonction : modiftahitient
// Paramètre(s): usrlg -- identifiant saisi par l'utilisateur
//               pwd -- Mot de passe saisi par l'utilisateur  
// Description : Sécurisation des variables de sessions
//********************************************************************
function modiftahitient($tab)   //form connexion compte elv
{
    try {

        //initialisation du message d'erreur
        $err = "";

        if (isset($tab['usernewtahiti'])) {

            //Connexion à la base de données
            $conn = ConnBDDpdo();

            if (!session_id()) {
                session_start();
            }

				if (!empty($conn)) {
					
					$ent_id=decryptIt($_SESSION["ent_id"],$_SESSION["hashsession"]);
					
					$stmt = $conn->prepare("UPDATE entreprise SET ent_numtahiti=:ent_numtahiti, confirm=0, suspend=1 WHERE entreprise.ent_id=:ent_id");
					$stmt->bindParam(':ent_numtahiti', $tab['usernewtahiti']);
					$stmt->bindParam(':ent_id', $ent_id);		
					$stmt->execute();
					$stmt->closeCursor();


					$stmt = $conn->prepare("SELECT * FROM ispf_ent WHERE ispf_ent.num_tahiti_etab = :num_tahiti_etab");
					$stmt->bindParam(':num_tahiti_etab', $tab['usernewtahiti']);
					$stmt->execute();


					if ($stmt->rowCount() > 0) {

						$res = $stmt->fetch(PDO::FETCH_ASSOC);
						
						$ent_nom=$res["nom_etab"];
						$ent_com=$res["com_etab"];
						$ent_adr=$res["adrgeo"];
						$ent_codepos=$res["code_postal_ENT"];
						$ent_pk=$res["pk"];
						$ent_quart=$res["quartier"];
						$ent_rue=$res["rue"];
						$ent_imm=$res["immeuble"];
						
						$stmt = $conn->prepare("UPDATE entreprise SET ent_nom=:ent_nom, ent_com=:ent_com, ent_adr=:ent_adr, ent_codepos=:ent_codepos, ent_pk=:ent_pk, ent_quart=:ent_quart, ent_rue=:ent_rue, ent_imm=:ent_imm,ent_tel=NULL, ent_desc=NULL, ent_sect=NULL, ent_web=NULL, ent_logo=NULL WHERE entreprise.ent_id=:ent_id");
						$stmt->bindParam(':ent_nom', $ent_nom);
						$stmt->bindParam(':ent_com', $ent_com);
						$stmt->bindParam(':ent_adr', $ent_adr);
						$stmt->bindParam(':ent_codepos', $ent_codepos);
						$stmt->bindParam(':ent_pk', $ent_pk);
						$stmt->bindParam(':ent_quart', $ent_quart);
						$stmt->bindParam(':ent_rue', $ent_rue);
						$stmt->bindParam(':ent_imm', $ent_imm);
						$stmt->bindParam(':ent_id', $ent_id);		
						$stmt->execute();
						
						
					}else{
					
						$tabtahiti=explode("-",$tab['usernewtahiti']);
						
						if(sizeof($tabtahiti)==2){
							
							$num_tahiti=$tabtahiti[0];
						
							$stmt = $conn->prepare("INSERT INTO ispf_ent (num_tahiti_etab, num_tahiti) VALUES (:num_tahiti_etab, :num_tahiti)");
							$stmt->bindParam(':num_tahiti_etab', $tab['usernewtahiti']);
							$stmt->bindParam(':num_tahiti', $num_tahiti);
							$stmt->execute();
							
							$new=1;
						
						}else{
							
							$err="errornumtahiti";
							return $err;
							
						}
						
					}
					
					$_SESSION = array();
						// récupérer les paramètres du cookie 
						$params = session_get_cookie_params();
						// Effacer le cookie actuel.
						setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
						
					
					$blogusers = get_users('role=Administrator');
					
					foreach ($blogusers as $user) {
						
						$to = $user->user_email;
						
						$subject = 'Vous avez une nouvelle demande d\'authentification sur monstage.education.pf';
						$message .= "<p>Connectez-vous sur la plateforme pour valider ton identité</p>";
						$message = "Bonjour,<br>une nouvelle entreprise s'est inscrite sur le site monstage.education.pf</p>";
						$message .= "<p>Cordialement,</p>";
						$message .= "<p>DGEE - Direction Générale de l'Education et des enseignements</p>";
						$message .= "<p></p><p><i>Ce mail a été envoyé automatiquement via une application, merci de ne pas y répondre</i>.</p>";

						$headers = array('Content-Type: text/html; charset=UTF-8');

						wp_mail($to, $subject, $message, $headers);
						
					}  
					
					
					$conn = null;

				} else
					$err = "connerr";
        } else
            $err = "erroblg";


        return $err;

    } catch
    (PDOException $e) {
        $err = $e;
        $conn = null;
        return $err;
    }
}

function validnewemailent($tab){
	
		 try {
        //initialisation du message d'erreur
        $err = "";
        //connexion � la base de donn�es
        $conn = ConnBDDpdo();

        if (!empty($conn)) {

            if (isset($tab['token']) and ($tab['token']!="" and $tab['token']!=null)) {
				
				$stmt = $conn->prepare("SELECT * FROM entreprise WHERE entreprise.ent_token2 = :token");
				$stmt->bindParam(':token', $tab["token"]);
				$stmt->execute();


				if ($stmt->rowCount() > 0) {

					$res = $stmt->fetch(PDO::FETCH_ASSOC);
					
					$stmt = $conn->prepare("UPDATE entreprise SET ent_token2=NULL, ent_mail=new_mail WHERE entreprise.ent_id=:ent_id");
					$stmt->bindParam(':ent_id', $res['ent_id']);
					$stmt->execute();
					$stmt->closeCursor();
					
					$stmt = $conn->prepare("UPDATE entreprise SET new_mail=NULL WHERE entreprise.ent_id=:ent_id");
					$stmt->bindParam(':ent_id', $res['ent_id']);
					$stmt->execute();
					$stmt->closeCursor();
				}else{
					
					$err="errortoken";
					
				}
			
			}
				
				
		 } else
            $err = "connerr";

        return $err;

    } catch
    (PDOException $e) {
        $err = $e;
        $conn = null;
        return $err;
    }
	
}




//********************************************************************
// Fonction : modifpasswordent
// Paramètre(s): usrlg -- identifiant saisi par l'utilisateur
//               pwd -- Mot de passe saisi par l'utilisateur  
// Description : Sécurisation des variables de sessions
//********************************************************************
function modifpasswordent($tab)   //form connexion compte elv
{
    try {

        //initialisation du message d'erreur
        $err = "";

        if (isset($tab['expassword'],$tab['password1'],$tab['password2'])) {

            //Connexion à la base de données
            $conn = ConnBDDpdo();

            if (!session_id()) {
                session_start();
            }

            if (!empty($conn)) {
				
				$ent_id=decryptIt($_SESSION["ent_id"],$_SESSION["hashsession"]);
				
				
				$stmt = $conn->prepare("SELECT * FROM entreprise WHERE ent_id = :ent_id");
                $stmt->bindParam(':ent_id', $ent_id);
                $stmt->execute();
                $res = $stmt->fetch(PDO::FETCH_ASSOC);
                $stmt->closeCursor();
				
				$mdphash = hash('sha512', $tab['expassword'] . $res['ent_hash']);
				
				if( $mdphash!=$res['ent_password']){
					
					$err = "errorexpwd";
					
				}
				
				if($tab['password1']!=$tab['password2']){
					
					$err = "errorsame";
					
				}
				
				
				$newmdphash = hash('sha512', $tab['password1'] . $res['ent_hash']);
				
               	$stmt = $conn->prepare("UPDATE entreprise SET ent_password=:ent_password WHERE entreprise.ent_id=:ent_id");
				$stmt->bindParam(':ent_password', $newmdphash);
				$stmt->bindParam(':ent_id', $ent_id);		
				$stmt->execute();
				$stmt->closeCursor();	

                $conn = null;

            } else
                $err = "connerr";
        } else
            $err = "erroblg";


        return $err;

    } catch
    (PDOException $e) {
        $err = $e;
        $conn = null;
        return $err;
    }
}



//********************************************************************
// Fonction : modifinfoent
//********************************************************************
function modifinfoent($tab,$files)   //form connexion compte elv
{
    try {

        //initialisation du message d'erreur
        $err = "";

        if (isset($tab['username'])) {

            //Connexion à la base de données
            $conn = ConnBDDpdo();

            if (!session_id()) {
                session_start();
            }
			
			$ent_id=decryptIt($_SESSION["ent_id"],$_SESSION["hashsession"]);
			
			$username="";if(!empty($tab['username']))$username = stripslashes((filter_var($tab['username'], FILTER_SANITIZE_STRING)));
			$usertel="";if(!empty($tab['usertel']))$usertel = stripslashes((filter_var($tab['usertel'], FILTER_SANITIZE_STRING)));
			$usercommune="";if(!empty($tab['usercommune']))$usercommune = $tab['usercommune'];
			$usergeo="";if(!empty($tab['usergeo']))$usergeo = stripslashes((filter_var($tab['usergeo'], FILTER_SANITIZE_STRING)));
			$usercodepos="";if(!empty($tab['usercodepos']))$usercodepos = stripslashes((filter_var($tab['usercodepos'], FILTER_SANITIZE_STRING)));
			$userpk="";if(!empty($tab['userpk']))$userpk = stripslashes((filter_var($tab['userpk'], FILTER_SANITIZE_STRING)));
			$userquart="";if(!empty($tab['userquart']))$userquart = stripslashes((filter_var($tab['userquart'], FILTER_SANITIZE_STRING)));
			$userrue="";if(!empty($tab['userrue']))$userrue = stripslashes((filter_var($tab['userrue'], FILTER_SANITIZE_STRING)));
			$userimmeuble="";if(!empty($tab['userimmeuble']))$userimmeuble = stripslashes((filter_var($tab['userimmeuble'], FILTER_SANITIZE_STRING)));
			$usersect="1";if(!empty($tab['usersect']))$usersect = $tab['usersect'];
			$userweb="";if(!empty($tab['userweb']))$userweb = stripslashes((filter_var($tab['userweb'], FILTER_SANITIZE_STRING)));
			$userdesc="";if(!empty($tab['userdesc']))$userdesc = stripslashes((filter_var($tab['userdesc'], FILTER_SANITIZE_STRING)));
			
            if (!empty($conn)) {
				
               	$stmt = $conn->prepare("UPDATE entreprise SET ent_desc=:ent_desc, ent_web=:ent_web, ent_sect=:ent_sect, ent_tel=:ent_tel, ent_nom=:ent_nom,ent_com=:ent_com,ent_adr=:ent_adr,ent_codepos=:ent_codepos,ent_pk=:ent_pk,ent_quart=:ent_quart,ent_rue=:ent_rue,ent_imm=:ent_imm WHERE entreprise.ent_id=:ent_id");
				$stmt->bindParam(':ent_nom', $username);
				$stmt->bindParam(':ent_tel', $usertel);
				$stmt->bindParam(':ent_com', $usercommune);
				$stmt->bindParam(':ent_adr', $usergeo);
				$stmt->bindParam(':ent_codepos', $usercodepos);
				$stmt->bindParam(':ent_pk', $userpk);
				$stmt->bindParam(':ent_quart', $userquart);
				$stmt->bindParam(':ent_rue', $userrue);
				$stmt->bindParam(':ent_imm', $userimmeuble);
				$stmt->bindParam(':ent_sect', $usersect);
				$stmt->bindParam(':ent_web', $userweb);
				$stmt->bindParam(':ent_desc', $userdesc);
				$stmt->bindParam(':ent_id', $ent_id);		
				$stmt->execute();
				$stmt->closeCursor();	
				
				$stmt = $conn->prepare("SELECT * FROM entreprise WHERE ent_id = :ent_id");
                $stmt->bindParam(':ent_id', $ent_id);
                $stmt->execute();
                $res = $stmt->fetch(PDO::FETCH_ASSOC);
                $stmt->closeCursor();
				
				if($res["new"]=="1" or $res["confirm"]=="1"){
					
					$stmt = $conn->prepare("UPDATE ispf_ent SET desc_etab=:ent_desc, web_etab=:ent_web, sect_etab=:ent_sect, nom_ent=:nom_etab, nom_etab=:nom_etab, code_postal_ENT=:ent_codepos, com_etab=:ent_com, pk=:ent_pk,quartier=:ent_quart,rue=:ent_rue,immeuble=:ent_imm,adrgeo=:ent_adr WHERE ispf_ent.num_tahiti_etab=:num_tahiti_etab");
					$stmt->bindParam(':nom_etab', $username);
					$stmt->bindParam(':ent_com', $usercommune);
					$stmt->bindParam(':ent_codepos', $usercodepos);
					$stmt->bindParam(':ent_adr', $usergeo);
					$stmt->bindParam(':ent_pk', $userpk);
					$stmt->bindParam(':ent_quart', $userquart);
					$stmt->bindParam(':ent_rue', $userrue);
					$stmt->bindParam(':ent_imm', $userimmeuble);
					$stmt->bindParam(':ent_sect', $usersect);
					$stmt->bindParam(':ent_web', $userweb);
					$stmt->bindParam(':ent_desc', $userdesc);
					$stmt->bindParam(':num_tahiti_etab', $res["ent_numtahiti"]);		
					$stmt->execute();
					$stmt->closeCursor();	
					
					$stmt = $conn->prepare("UPDATE entreprise SET new=0 WHERE entreprise.ent_id=:ent_id");
					$stmt->bindParam(':ent_id', $ent_id);		
					$stmt->execute();
					$stmt->closeCursor();	
					
					
				}
				
				
				if(file_exists($files['logoent']['tmp_name']) && is_uploaded_file($files['logoent']['tmp_name'])){
					 
					
						$nom = hash('sha512', uniqid(openssl_random_pseudo_bytes(8), TRUE));
						
						$infosfichier = pathinfo($files['logoent']['name']);
						$extension_upload = $infosfichier['extension'];
						
						$nom_img=$nom.'.'.$extension_upload;
						
						if(in_array($extension_upload,array("png","jpeg","gif","jpg"))){
							
							if(move_uploaded_file($files['logoent']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/logo/'. $nom_img)){
								
								if($res["ent_logo"]!=null and file_exists($_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/logo/'.$res["ent_logo"]))unlink($_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/logo/'.$res["ent_logo"]);
							
							
								$chemin=$nom_img;
								$stmt = $conn->prepare("UPDATE entreprise SET ent_logo=:chemin WHERE entreprise.ent_id=:ent_id");
								$stmt->bindParam(':chemin', $chemin);
								$stmt->bindParam(':ent_id', $ent_id);			
								$stmt->execute();
								$stmt->closeCursor();
								
								if($res["confirm"]=="1"){
					
									$stmt = $conn->prepare("UPDATE ispf_ent SET logo_etab=:chemin WHERE ispf_ent.num_tahiti_etab=:num_tahiti_etab");
									$stmt->bindParam(':chemin', $chemin);
									$stmt->bindParam(':num_tahiti_etab', $res["ent_numtahiti"]);		
									$stmt->execute();
									$stmt->closeCursor();	
									
								}
								
							}
						
						}
					}

                $conn = null;

            } else
                $err = "connerr";
        } else
            $err = "erroblg";


        return $err;

    } catch
    (PDOException $e) {
        $err = $e;
        $conn = null;
        return $err;
    }
}




function entrepris_ewait_call() { 
	$result='';
	
	$result.='<table class="wp-list-table widefat fixed striped table-view-list pages">
	<thead>
	<tr>
		<th class="manage-column column-title column-primary" ><span>Numéro tahiti de l\'entreprise</span></th>
		<th class="manage-column column-title column-primary" ><span>Nom de l\'entreprise</span></th>
		<th class="manage-column column-title column-primary" ><span>Email de l`\'utilisateur</span></th>
		<th class="manage-column column-title column-primary" ><span>Confirmer</span></th>
		<th class="manage-column column-title column-primary" ><span>Réformer</span></th>
	</tr>
	</thead>

	<tbody id="the-list">';
	
	
	try{
		//Connexion à la base de données
		$conn = ConnBDDpdo();
			
		if(!empty($conn)){
			//requête de sélection des données  
			$sql = "SELECT * FROM entreprise WHERE confirm=0 and ent_token IS NULL";
			
			foreach  ($conn->query($sql) as $row) {
				
					$result .= '<tr>';
					$result .='<td>'.$row['ent_numtahiti'].'</td>';
					$result .='<td>'.$row['ent_nom'].'</td>';
					$result .='<td>'.$row['ent_mail'].'</td>';
					$result .='<td><a href="'.get_template_directory_uri().'/actiondev2.php?act=confirmedent&id='.$row["ent_id"].'" >Confirmer</a></td>';
					$result .='<td><a href="'.get_template_directory_uri().'/actiondev2.php?act=reclinedent&id='.$row["ent_id"].'" >Décliner</a></td>';
					$result .= '</tr>';
			
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
	$result.='</tbody></table>';
	
	
	echo $result;
  
}


function confirmedent($tab){
	
		 try {
        //initialisation du message d'erreur
        $err = "";
        //connexion � la base de donn�es
        $conn = ConnBDDpdo();

        if (!empty($conn)) {

            if (isset($tab['id'])){
				
				
					
					$stmt = $conn->prepare("UPDATE entreprise SET confirm=1, suspend=0 WHERE entreprise.ent_id=:ent_id");
					$stmt->bindParam(':ent_id', $tab['id']);
					$stmt->execute();
					$stmt->closeCursor();
				
			}
				
				
		 } else
            $err = "connerr";

        return $err;

    } catch
    (PDOException $e) {
        $err = $e;
        $conn = null;
        return $err;
    }
	
}



function reclinedent($tab){
	
		 try {
        //initialisation du message d'erreur
        $err = "";
        //connexion � la base de donn�es
        $conn = ConnBDDpdo();

        if (!empty($conn)) {

            if (isset($tab['id'])) {
				
					$stmt = $conn->prepare("DELETE FROM entreprise WHERE entreprise.ent_id=:ent_id");
					$stmt->bindParam(':ent_id', $tab['id']);
					$stmt->execute();
					$stmt->closeCursor();
					
					$sql = "SELECT * FROM stage WHERE ent_id=".$tab['id'];
					
					foreach  ($conn->query($sql) as $row) {
						
						$sql2 = "SELECT * FROM candidature WHERE stage_id=".$row['stage_id'];
					
						foreach  ($conn->query($sql2) as $row2) {
							
							$stmt3 = $conn->prepare("DELETE FROM convention WHERE convention.cand_id=:cand_id");
							$stmt3->bindParam(':cand_id', $row2['cand_id']);
							$stmt3->execute();
							$stmt3->closeCursor();
							
						}
						
						$stmt2 = $conn->prepare("DELETE FROM stage_sem WHERE stage_sem.stage_id=:stage_id");
						$stmt2->bindParam(':stage_id', $row['stage_id']);
						$stmt2->execute();
						$stmt2->closeCursor();
						
						$stmt2 = $conn->prepare("DELETE FROM stage_horaire WHERE stage_horaire.stage_id=:stage_id");
						$stmt2->bindParam(':stage_id', $row['stage_id']);
						$stmt2->execute();
						$stmt2->closeCursor();
						
						$stmt2 = $conn->prepare("DELETE FROM stage_uai WHERE stage_uai.stage_id=:stage_id");
						$stmt2->bindParam(':stage_id', $row['stage_id']);
						$stmt2->execute();
						$stmt2->closeCursor();
					
						$stmt2 = $conn->prepare("DELETE FROM candidature WHERE candidature.stage_id=:stage_id");
						$stmt2->bindParam(':stage_id', $row['stage_id']);
						$stmt2->execute();
						$stmt2->closeCursor();
						
					}
					
					$stmt = $conn->prepare("DELETE FROM stage WHERE stage.ent_id=:ent_id");
					$stmt->bindParam(':ent_id', $tab['id']);
					$stmt->execute();
					$stmt->closeCursor();
					
					
				
			}
				
				
		 } else
            $err = "connerr";

        return $err;

    } catch
    (PDOException $e) {
        $err = $e;
        $conn = null;
        return $err;
    }
	
}

function entrepris_list_call() { 
	$result='';
	
	$result.='<table class="wp-list-table widefat fixed striped table-view-list pages">
	<thead>
	<tr>
		<th class="manage-column column-title column-primary" ><span>Numéro tahiti de l\'entreprise</span></th>
		<th class="manage-column column-title column-primary" ><span>Nom de l\'entreprise</span></th>
		<th class="manage-column column-title column-primary" ><span>Email de l`\'utilisateur</span></th>
		<th class="manage-column column-title column-primary" ><span>Nombre d\'offres</span></th>
		<th class="manage-column column-title column-primary" ><span>Action(s)</span></th>
	</tr>
	</thead>

	<tbody id="the-list">';
	
	
	try{
		//Connexion à la base de données
		$conn = ConnBDDpdo();
			
		if(!empty($conn)){
			//requête de sélection des données  
			$sql = "SELECT entreprise.*, (select COUNT(*) as NB from stage where stage.ent_id=entreprise.ent_id and publish=1) as NB FROM entreprise WHERE confirm=1 and ent_token IS NULL";
			
			foreach  ($conn->query($sql) as $row) {
				
					$result .= '<tr>';
					$result .='<td>'.$row['ent_numtahiti'].'</td>';
					$result .='<td>'.$row['ent_nom'].'</td>';
					$result .='<td>'.$row['ent_mail'].'</td>';
					$result .='<td>'.$row['NB'].'</td>';
					$result .='<td>';
					
					if($row['suspend']=="0"){
						
						$result .='<a href="'.get_template_directory_uri().'/actiondev2.php?act=desactiverent&id='.$row["ent_id"].'" >Désactiver</a>';
						
					}else{
					
						$result .='<a href="'.get_template_directory_uri().'/actiondev2.php?act=activerent&id='.$row["ent_id"].'" >Réactiver</a>';
					
					}
					$result .= '</tr>';
			
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
	$result.='</tbody></table>';
	
	
	echo $result;
  
}

function desactiverent($tab){
	
		 try {
        //initialisation du message d'erreur
        $err = "";
        //connexion � la base de donn�es
        $conn = ConnBDDpdo();

        if (!empty($conn)) {

            if (isset($tab['id'])){
				
				
					
					$stmt = $conn->prepare("UPDATE entreprise SET suspend=1 WHERE entreprise.ent_id=:ent_id");
					$stmt->bindParam(':ent_id', $tab['id']);
					$stmt->execute();
					$stmt->closeCursor();
					
					$sql = "SELECT * FROM stage WHERE ent_id=".$tab['id'];
					
					foreach  ($conn->query($sql) as $row) {
						
						$sql2 = "SELECT * FROM candidature WHERE stage_id=".$row['stage_id'];
					
						foreach  ($conn->query($sql2) as $row2) {
							
							$stmt3 = $conn->prepare("UPDATE convention SET suspend=1 WHERE convention.cand_id=:cand_id");
							$stmt3->bindParam(':cand_id', $row2['cand_id']);
							$stmt3->execute();
							$stmt3->closeCursor();
							
						}
						
						$stmt2 = $conn->prepare("UPDATE candidature SET suspend=1 WHERE candidature.stage_id=:stage_id");
						$stmt2->bindParam(':stage_id', $row['stage_id']);
						$stmt2->execute();
						$stmt2->closeCursor();
					
						
					}
					
					$stmt = $conn->prepare("UPDATE stage SET suspend=1 WHERE stage.ent_id=:ent_id");
					$stmt->bindParam(':ent_id', $tab['id']);
					$stmt->execute();
					$stmt->closeCursor();
				
			}
				
				
		 } else
            $err = "connerr";

        return $err;

    } catch
    (PDOException $e) {
        $err = $e;
        $conn = null;
        return $err;
    }
	
}



function activerent($tab){
	
		 try {
        //initialisation du message d'erreur
        $err = "";
        //connexion � la base de donn�es
        $conn = ConnBDDpdo();

        if (!empty($conn)) {

            if (isset($tab['id'])) {
				
					$stmt = $conn->prepare("UPDATE entreprise SET suspend=0 WHERE entreprise.ent_id=:ent_id");
					$stmt->bindParam(':ent_id', $tab['id']);
					$stmt->execute();
					$stmt->closeCursor();
					
					$sql = "SELECT * FROM stage WHERE ent_id=".$tab['id'];
					
					foreach  ($conn->query($sql) as $row) {
						
						$sql2 = "SELECT * FROM candidature WHERE stage_id=".$row['stage_id'];
					
						foreach  ($conn->query($sql2) as $row2) {
							
							$stmt3 = $conn->prepare("UPDATE convention SET suspend=0 WHERE convention.cand_id=:cand_id");
							$stmt3->bindParam(':cand_id', $row2['cand_id']);
							$stmt3->execute();
							$stmt3->closeCursor();
							
						}
						
						$stmt2 = $conn->prepare("UPDATE candidature SET suspend=0 WHERE candidature.stage_id=:stage_id");
						$stmt2->bindParam(':stage_id', $row['stage_id']);
						$stmt2->execute();
						$stmt2->closeCursor();
					
						
					}
					
					$stmt = $conn->prepare("UPDATE stage SET suspend=0 WHERE stage.ent_id=:ent_id");
					$stmt->bindParam(':ent_id', $tab['id']);
					$stmt->execute();
					$stmt->closeCursor();
						
					
					
				
			}
				
				
		 } else
            $err = "connerr";

        return $err;

    } catch
    (PDOException $e) {
        $err = $e;
        $conn = null;
        return $err;
    }
	
}




function eleve_list_call() { 
	$result='';
	
	$result.='<table class="wp-list-table widefat fixed striped table-view-list pages">
	<thead>
	<tr>
		<th class="manage-column column-title column-primary" ><span>Nom de l\'élève</span></th>
		<th class="manage-column column-title column-primary" ><span>Prénom de l\'élève</span></th>
		<th class="manage-column column-title column-primary" ><span>Email de l`\'utilisateur</span></th>
		<th class="manage-column column-title column-primary" ><span>date de naissance</span></th>
		<th class="manage-column column-title column-primary" ><span>Nombre de candidature</span></th>
		<th class="manage-column column-title column-primary" ><span>Action(s)</span></th>
	</tr>
	</thead>

	<tbody id="the-list">';
	
	
	try{
		//Connexion à la base de données
		$conn = ConnBDDpdo();
			
		if(!empty($conn)){
			//requête de sélection des données  
			$sql = "SELECT eleve.*, (select COUNT(*) as NB from candidature where candidature.elv_id=eleve.elv_id and suspend=0) as NB FROM eleve WHERE elv_token IS NULL";
			
			foreach  ($conn->query($sql) as $row) {
				
					$result .= '<tr>';
					$result .='<td>'.$row['elv_nom'].'</td>';
					$result .='<td>'.$row['elv_pren'].'</td>';
					$result .='<td>'.$row['elv_mail'].'</td>';
					$result .='<td>'.fDate($row['elv_datenaiss'],"html").'</td>';
					$result .='<td>'.$row['NB'].'</td>';
					$result .='<td>';
					
					if($row['suspend']=="0"){
						
						$result .='<a href="'.get_template_directory_uri().'/actiondev2.php?act=desactiverelv&id='.$row["elv_id"].'" >Désactiver</a>';
						
					}else{
					
						$result .='<a href="'.get_template_directory_uri().'/actiondev2.php?act=activerelv&id='.$row["elv_id"].'" >Réactiver</a>';
					
					}
					$result .= '</tr>';
			
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
	$result.='</tbody></table>';
	
	
	echo $result;
  
}

function desactiverelv($tab){
	
		 try {
        //initialisation du message d'erreur
        $err = "";
        //connexion � la base de donn�es
        $conn = ConnBDDpdo();

        if (!empty($conn)) {

            if (isset($tab['id'])){
				
				
					
					$stmt = $conn->prepare("UPDATE eleve SET suspend=1 WHERE eleve.elv_id=:elv_id");
					$stmt->bindParam(':elv_id', $tab['id']);
					$stmt->execute();
					$stmt->closeCursor();
					
					$stmt3 = $conn->prepare("UPDATE convention left join candidature on candidature.cand_id=convention.cand_id SET suspend=1 WHERE candidature.elv_id=:elv_id");
					$stmt3->bindParam(':elv_id', $tab['id']);
					$stmt3->execute();
					$stmt3->closeCursor();
						
					
					
					$stmt2 = $conn->prepare("UPDATE candidature SET suspend=1 WHERE candidature.elv_id=:elv_id");
					$stmt2->bindParam(':elv_id', $tab['id']);
					$stmt2->execute();
					$stmt2->closeCursor();
					
				
			}
				
				
		 } else
            $err = "connerr";

        return $err;

    } catch
    (PDOException $e) {
        $err = $e;
        $conn = null;
        return $err;
    }
	
}



function activerelv($tab){
	
		 try {
        //initialisation du message d'erreur
        $err = "";
        //connexion � la base de donn�es
        $conn = ConnBDDpdo();

        if (!empty($conn)) {

            if (isset($tab['id'])) {
				
					$stmt = $conn->prepare("UPDATE eleve SET suspend=0 WHERE eleve.elv_id=:elv_id");
					$stmt->bindParam(':elv_id', $tab['id']);
					$stmt->execute();
					$stmt->closeCursor();
					
					$sql2 = "SELECT * FROM candidature WHERE elv_id=".$tab['id'];
				
					foreach  ($conn->query($sql2) as $row2) {
						
						$stmt3 = $conn->prepare("UPDATE convention SET suspend=0 WHERE convention.cand_id=:cand_id");
						$stmt3->bindParam(':cand_id', $row2['cand_id']);
						$stmt3->execute();
						$stmt3->closeCursor();
						
					}
					
					$stmt2 = $conn->prepare("UPDATE candidature SET suspend=0 WHERE candidature.elv_id=:elv_id");
					$stmt2->bindParam(':elv_id', $tab['id']);
					$stmt2->execute();
					$stmt2->closeCursor();
						
					
					
				
			}
				
				
		 } else
            $err = "connerr";

        return $err;

    } catch
    (PDOException $e) {
        $err = $e;
        $conn = null;
        return $err;
    }
	
}




function peda_list_call() { 
	$result='';
	
	$result.='<table class="wp-list-table widefat fixed striped table-view-list pages">
	<thead>
	<tr>
		<th class="manage-column column-title column-primary" ><span>Nom du prof</span></th>
		<th class="manage-column column-title column-primary" ><span>Prénom du prof</span></th>
		<th class="manage-column column-title column-primary" ><span>Email de l`\'utilisateur</span></th>
		<th class="manage-column column-title column-primary" ><span>Nombre d\'élève(s) suivi(s)</span></th>
		<th class="manage-column column-title column-primary" ><span>Action(s)</span></th>
	</tr>
	</thead>

	<tbody id="the-list">';
	
	
	try{
		//Connexion à la base de données
		$conn = ConnBDDpdo();
			
		if(!empty($conn)){
			//requête de sélection des données  
			$sql = "SELECT pedagogique.*, (select COUNT(*) as NB from peda_elv where peda_elv.peda_id=pedagogique.peda_id) as NB FROM pedagogique WHERE peda_token IS NULL";
			
			foreach  ($conn->query($sql) as $row) {
				
					$result .= '<tr>';
					$result .='<td>'.$row['peda_nom'].'</td>';
					$result .='<td>'.$row['peda_pren'].'</td>';
					$result .='<td>'.$row['peda_mail'].'</td>';
					$result .='<td>'.$row['NB'].'</td>';
					$result .='<td>';
					
					if($row['suspend']=="0"){
						
						$result .='<a href="'.get_template_directory_uri().'/actiondev2.php?act=desactiverpeda&id='.$row["peda_id"].'" >Désactiver</a>';
						
					}else{
					
						$result .='<a href="'.get_template_directory_uri().'/actiondev2.php?act=activerpeda&id='.$row["peda_id"].'" >Réactiver</a>';
					
					}
					$result .= '</tr>';
			
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
	$result.='</tbody></table>';
	
	
	echo $result;
  
}

function desactiverpeda($tab){
	
		 try {
        //initialisation du message d'erreur
        $err = "";
        //connexion � la base de donn�es
        $conn = ConnBDDpdo();

        if (!empty($conn)) {

            if (isset($tab['id'])){
				
				$stmt = $conn->prepare("UPDATE pedagogique SET suspend=1 WHERE pedagogique.peda_id=:peda_id");
				$stmt->bindParam(':peda_id', $tab['id']);
				$stmt->execute();
				$stmt->closeCursor();
					
				
			}
				
				
		 } else
            $err = "connerr";

        return $err;

    } catch
    (PDOException $e) {
        $err = $e;
        $conn = null;
        return $err;
    }
	
}



function activerpeda($tab){
	
		 try {
        //initialisation du message d'erreur
        $err = "";
        //connexion � la base de donn�es
        $conn = ConnBDDpdo();

        if (!empty($conn)) {

            if (isset($tab['id'])) {
				
					$stmt = $conn->prepare("UPDATE pedagogique SET suspend=0 WHERE pedagogique.peda_id=:peda_id");
					$stmt->bindParam(':peda_id', $tab['id']);
					$stmt->execute();
					$stmt->closeCursor();
					
					
				
			}
				
				
		 } else
            $err = "connerr";

        return $err;

    } catch
    (PDOException $e) {
        $err = $e;
        $conn = null;
        return $err;
    }
	
}




//********************************************************************
// Fonction : addstage1
//********************************************************************
function addstage1($tab,$files)   //form connexion compte elv
{
    try {

        //initialisation du message d'erreur
        $err = "";

       
            //Connexion à la base de données
            $conn = ConnBDDpdo();

            if (!session_id()) {
                session_start();
            }
			
			$ent_id=decryptIt($_SESSION["ent_id"],$_SESSION["hashsession"]);
			
			$stmt = $conn->prepare("SELECT * FROM entreprise WHERE ent_id = :ent_id");
			$stmt->bindParam(':ent_id', $ent_id);
			$stmt->execute();
			$res = $stmt->fetch(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
			
			$usercommune="";if(!empty($tab['usercommune']))$usercommune = $tab['usercommune'];
			$usergeo="";if(!empty($tab['usergeo']))$usergeo = stripslashes(filter_var($tab['usergeo'], FILTER_SANITIZE_STRING));
			$usercodepos="";if(!empty($tab['usercodepos']))$usercodepos = stripslashes(filter_var($tab['usercodepos'], FILTER_SANITIZE_STRING));
			$userpk="";if(!empty($tab['userpk']))$userpk = stripslashes(filter_var($tab['userpk'], FILTER_SANITIZE_STRING));
			$userquart="";if(!empty($tab['userquart']))$userquart = stripslashes(filter_var($tab['userquart'], FILTER_SANITIZE_STRING));
			$userrue="";if(!empty($tab['userrue']))$userrue = stripslashes(filter_var($tab['userrue'], FILTER_SANITIZE_STRING));
			$userimmeuble="";if(!empty($tab['userimmeuble']))$userimmeuble = stripslashes(filter_var($tab['userimmeuble'], FILTER_SANITIZE_STRING));
			$usersect="1";if(!empty($tab['usersect']))$usersect = stripslashes($tab['usersect']);
			$userweb="";if(!empty($tab['userweb']))$userweb = stripslashes(filter_var($tab['userweb'], FILTER_SANITIZE_STRING));
			$userdesc="";if(!empty($tab['userdesc']))$userdesc = stripslashes(filter_var($tab['userdesc'], FILTER_SANITIZE_STRING));
			
            if (!empty($conn)) {
				
				if($tab['stageid']=="0"){
					
					$type_id=0;if(!empty($tab['type_id']))$type_id = filter_var($tab['type_id'], FILTER_SANITIZE_STRING);
			
					$reference=random_str_generator(8);
					
					if($type_id==0){
						
						$stmt = $conn->prepare("INSERT INTO stage (ent_id, reference, etape, d_crea) VALUES (:ent_id, :reference, 2, NOW())");
						$stmt->bindParam(':reference', $reference);
						$stmt->bindParam(':ent_id', $ent_id);
						$stmt->execute();
						
					}else{
						
						$stmt = $conn->prepare("INSERT INTO stage (ent_id, type_id, reference, etape, d_crea) VALUES (:ent_id, :type_id, :reference, 2, NOW())");
						$stmt->bindParam(':reference', $reference);
						$stmt->bindParam(':type_id', $type_id);
						$stmt->bindParam(':ent_id', $ent_id);
						$stmt->execute();
						
					}
					
					$lastid=$conn->lastInsertId();
					
					$GLOBALS["lastid"]=encryptIt($lastid,$_SESSION["hashsession"]);
				
				
				}else{
					
					$stage_id=decryptIt($tab['stageid'],$_SESSION["hashsession"]);
					
					$stmt = $conn->prepare("UPDATE stage SET etape=2 WHERE stage.stage_id=:stage_id");
					$stmt->bindParam(':stage_id', $stage_id);		
					$stmt->execute();
					$stmt->closeCursor();
					
					$GLOBALS["lastid"]=$tab['stageid'];
					
				}
				
               $stmt = $conn->prepare("UPDATE entreprise SET ent_desc=:ent_desc, ent_web=:ent_web, ent_sect=:ent_sect,
				ent_com=:ent_com,ent_adr=:ent_adr,ent_codepos=:ent_codepos,
				ent_pk=:ent_pk,ent_quart=:ent_quart,ent_rue=:ent_rue,ent_imm=:ent_imm
				WHERE entreprise.ent_id=:ent_id");
				$stmt->bindParam(':ent_desc', $userdesc);
				$stmt->bindParam(':ent_web', $userweb);
				$stmt->bindParam(':ent_sect', $usersect);
				$stmt->bindParam(':ent_com', $usercommune);
				$stmt->bindParam(':ent_adr', $usergeo);
				$stmt->bindParam(':ent_codepos', $usercodepos);
				$stmt->bindParam(':ent_pk', $userpk);
				$stmt->bindParam(':ent_quart', $userquart);
				$stmt->bindParam(':ent_rue', $userrue);
				$stmt->bindParam(':ent_imm', $userimmeuble);
				$stmt->bindParam(':ent_id', $ent_id);		
				$stmt->execute();
				$stmt->closeCursor();	
				
				if($res["confirm"]=="1"){
					
					$stmt = $conn->prepare("UPDATE ispf_ent SET desc_etab=:ent_desc, web_etab=:ent_web, sect_etab=:ent_sect, code_postal_ENT=:ent_codepos, com_etab=:ent_com, pk=:ent_pk,adrgeo=:ent_adr,quartier=:ent_quart,rue=:ent_rue,immeuble=:ent_imm WHERE ispf_ent.num_tahiti_etab=:num_tahiti_etab");
					$stmt->bindParam(':ent_desc', $userdesc);
					$stmt->bindParam(':ent_web', $userweb);
					$stmt->bindParam(':ent_sect', $usersect);
					$stmt->bindParam(':ent_codepos', $usercodepos);
					$stmt->bindParam(':ent_com', $usercommune);
					$stmt->bindParam(':ent_pk', $userpk);
					$stmt->bindParam(':ent_adr', $usergeo);
					$stmt->bindParam(':ent_quart', $userquart);
					$stmt->bindParam(':ent_rue', $userrue);
					$stmt->bindParam(':ent_imm', $userimmeuble);
					$stmt->bindParam(':num_tahiti_etab', $res["ent_numtahiti"]);		
					$stmt->execute();
					$stmt->closeCursor();	
					
				}
				
				if(file_exists($files['logoent']['tmp_name']) && is_uploaded_file($files['logoent']['tmp_name'])){
					 
					
						$nom = hash('sha512', uniqid(openssl_random_pseudo_bytes(8), TRUE));
						
						$infosfichier = pathinfo($files['logoent']['name']);
						$extension_upload = $infosfichier['extension'];
						
						$nom_img=$nom.'.'.$extension_upload;
						
						if(in_array($extension_upload,array("png","jpeg","gif","jpg","svg"))){
							
							if(move_uploaded_file($files['logoent']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/logo/'. $nom_img)){
								
								if($res["ent_logo"]!=null and file_exists($_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/logo/'.$res["ent_logo"]))unlink($_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/logo/'.$res["ent_logo"]);
							
							
								$chemin=$nom_img;
								$stmt = $conn->prepare("UPDATE entreprise SET ent_logo=:chemin WHERE entreprise.ent_id=:ent_id");
								$stmt->bindParam(':chemin', $chemin);
								$stmt->bindParam(':ent_id', $ent_id);			
								$stmt->execute();
								$stmt->closeCursor();
								
								
								if($res["confirm"]=="1"){
					
									$stmt = $conn->prepare("UPDATE ispf_ent SET logo_etab=:chemin WHERE ispf_ent.num_tahiti_etab=:num_tahiti_etab");
									$stmt->bindParam(':chemin', $chemin);
									$stmt->bindParam(':num_tahiti_etab', $res["ent_numtahiti"]);		
									$stmt->execute();
									$stmt->closeCursor();	
									
								}
								
							}
						
						}
					}

                $conn = null;

            } else
                $err = "connerr";
     
        return $err;

    } catch
    (PDOException $e) {
        $err = $e;
        $conn = null;
        return $err;
    }
}





//********************************************************************
// Fonction : addstage2
//********************************************************************
function addstage2($tab)   //form connexion compte elv
{
    try {

        //initialisation du message d'erreur
        $err = "";

       
            //Connexion à la base de données
            $conn = ConnBDDpdo();

            if (!session_id()) {
                session_start();
            }
			$GLOBALS["lastid"]=$tab['stageid'];

			$ent_id=decryptIt($_SESSION["ent_id"],$_SESSION["hashsession"]);
			$stage_id=decryptIt($tab['stageid'],$_SESSION["hashsession"]);
			
			$stagesecteur="1";if(!empty($tab['stagesecteur']))$stagesecteur = $tab['stagesecteur'];
			$secteuractivite1="1";if(!empty($tab['secteuractivite1']))$secteuractivite1 = $tab['secteuractivite1'];
			$secteuractivite2="1";if(!empty($tab['secteuractivite2']))$secteuractivite2 = $tab['secteuractivite2'];
			$secteuractivite3="1";if(!empty($tab['secteuractivite3']))$secteuractivite3 = $tab['secteuractivite3'];
			$metierdecouv="";if(!empty($tab['metierdecouv']))$metierdecouv = stripslashes(filter_var($tab['metierdecouv'], FILTER_SANITIZE_STRING));
			$activestage="";if(!empty($tab['activestage']))$activestage = stripslashes(filter_var($tab['activestage'], FILTER_SANITIZE_STRING));
			
			$secteuractivite=1;
			if($stagesecteur=="1")$secteuractivite=$secteuractivite1;
			else if($stagesecteur=="2")$secteuractivite=$secteuractivite2;
			else $secteuractivite=$secteuractivite3;
			
			if (!empty($conn)) {
				
               	$stmt = $conn->prepare("UPDATE stage SET etape=3,type_id=:stagesecteur, dom_id=:secteuractivite, metier=:metierdecouv,
				activity=:activestage WHERE stage.stage_id=:stage_id and stage.ent_id=:ent_id");
				$stmt->bindParam(':stagesecteur', $stagesecteur);
				$stmt->bindParam(':secteuractivite', $secteuractivite);
				$stmt->bindParam(':metierdecouv', $metierdecouv);
				$stmt->bindParam(':activestage', $activestage);
				$stmt->bindParam(':ent_id', $ent_id);
				$stmt->bindParam(':stage_id', $stage_id);		
				$stmt->execute();
				$stmt->closeCursor();	
				
                $conn = null;

            } else
                $err = "connerr";
     
        return $err;

    } catch
    (PDOException $e) {
        $err = $e;
        $conn = null;
        return $err;
    }
}



//********************************************************************
// Fonction : addstage3
//********************************************************************
function addstage3($tab)   //form connexion compte elv
{
    try {

        //initialisation du message d'erreur
        $err = "";

       
            //Connexion à la base de données
            $conn = ConnBDDpdo();

            if (!session_id()) {
                session_start();
            }
			$GLOBALS["lastid"]=$tab['stageid'];
				
			$ent_id=decryptIt($_SESSION["ent_id"],$_SESSION["hashsession"]);
			$stage_id=decryptIt($tab['stageid'],$_SESSION["hashsession"]);
			
			$datestage="1";if(!empty($tab['datestage']))$datestage = $tab['datestage'];
			$chpdddebut=null;if(!empty($tab['chpdddebut']) and $datestage=="3")$chpdddebut = fDate($tab['chpdddebut'],"sql");
			$chpddfin=null;if(!empty($tab['chpddfin']) and $datestage=="3")$chpddfin = fDate($tab['chpddfin'],"sql");
			$stageradionb=1;if(!empty($tab['stageradionb']))$stageradionb = $tab['stageradionb'];
			$nbmaxelv=1;if(!empty($tab['nbmaxelv']) and $stageradionb=="2")$nbmaxelv = $tab['nbmaxelv'];
			$nbmaxelvannee=1;if(!empty($tab['nbmaxelvannee']))$nbmaxelvannee = $tab['nbmaxelvannee'];
			$reserveetab=0;if(!empty($tab['reserveetab']))$reserveetab = $tab['reserveetab'];
			
			if (!empty($conn)) {
				
               	$stmt = $conn->prepare("UPDATE stage SET etape=4,dispo=:datestage, dispo_opt3_d1=:chpdddebut,
				dispo_opt3_d2=:chpddfin,typ_nb=:stageradionb,typ_nb_opt2=:nbmaxelv,
				nb_elv_an=:nbmaxelvannee,reserv_uai=:reserveetab
				WHERE stage.stage_id=:stage_id and stage.ent_id=:ent_id");
				$stmt->bindParam(':datestage', $datestage);
				$stmt->bindParam(':chpdddebut', $chpdddebut);
				$stmt->bindParam(':chpddfin', $chpddfin);
				$stmt->bindParam(':stageradionb', $stageradionb);
				$stmt->bindParam(':nbmaxelv', $nbmaxelv);
				$stmt->bindParam(':nbmaxelvannee', $nbmaxelvannee);
				$stmt->bindParam(':reserveetab', $reserveetab);
				$stmt->bindParam(':ent_id', $ent_id);
				$stmt->bindParam(':stage_id', $stage_id);		
				$stmt->execute();
				$stmt->closeCursor();	
				
				$stmt = $conn->prepare("DELETE FROM stage_sem WHERE stage_sem.stage_id=:stage_id");
				$stmt->bindParam(':stage_id', $stage_id);
				$stmt->execute();
				$stmt->closeCursor();
					
				if(isset($tab['hosting_info']) and $datestage=="2"){
					
					foreach($tab['hosting_info'] as $semaine){
						
						$stmt = $conn->prepare("INSERT INTO stage_sem (stage_id, semaine) VALUES (:stage_id, :semaine)");
						$stmt->bindParam(':stage_id', $stage_id);
						$stmt->bindParam(':semaine', $semaine);
						$stmt->execute();
						
					}
					
				}
				
				
				$stmt = $conn->prepare("DELETE FROM stage_uai WHERE stage_uai.stage_id=:stage_id");
				$stmt->bindParam(':stage_id', $stage_id);
				$stmt->execute();
				$stmt->closeCursor();
				
				
				if(isset($tab['basicuai']) and $reserveetab=="1"){
					
					foreach($tab['basicuai'] as $uai){
						
						$stmt = $conn->prepare("INSERT INTO stage_uai (stage_id, uai_rne) VALUES (:stage_id, :uai_rne)");
						$stmt->bindParam(':stage_id', $stage_id);
						$stmt->bindParam(':uai_rne', $uai);
						$stmt->execute();
						
					}
					
				}
				
                $conn = null;

            } else
                $err = "connerr";
     
        return $err;

    } catch
    (PDOException $e) {
        $err = $e;
        $conn = null;
        return $err;
    }
}




//********************************************************************
// Fonction : addstage4
//********************************************************************
function addstage4($tab)   //form connexion compte elv
{
    try {

        //initialisation du message d'erreur
        $err = "";

       
            //Connexion à la base de données
            $conn = ConnBDDpdo();

            if (!session_id()) {
                session_start();
            }
			
			$ent_id=decryptIt($_SESSION["ent_id"],$_SESSION["hashsession"]);
			$stage_id=decryptIt($tab['stageid'],$_SESSION["hashsession"]);
			$GLOBALS["lastid"]=$tab['stageid'];
				
			$contactdepo=null;if(!empty($tab['contactdepo']))$contactdepo = stripslashes(filter_var($tab['contactdepo'], FILTER_SANITIZE_STRING));
			$contactname=null;if(!empty($tab['contactname']))$contactname = stripslashes(filter_var($tab['contactname'], FILTER_SANITIZE_STRING));
			$contactcommune=0;if(!empty($tab['contactcommune']))$contactcommune = stripslashes(filter_var($tab['contactcommune'], FILTER_SANITIZE_STRING));
			$contactgeo=null;if(!empty($tab['contactgeo']))$contactgeo = stripslashes((filter_var($tab['contactgeo'], FILTER_SANITIZE_STRING)));
			$contactcodpost=null;if(!empty($tab['contactcodpost']))$contactcodpost = stripslashes((filter_var($tab['contactcodpost'], FILTER_SANITIZE_STRING)));
			$contactpk=null;if(!empty($tab['contactpk']))$contactpk = stripslashes((filter_var($tab['contactpk'], FILTER_SANITIZE_STRING)));
			$contactquartier=null;if(!empty($tab['contactquartier']))$contactquartier = stripslashes((filter_var($tab['contactquartier'], FILTER_SANITIZE_STRING)));
			$contactrue=null;if(!empty($tab['contactrue']))$contactrue = stripslashes((filter_var($tab['contactrue'], FILTER_SANITIZE_STRING)));
			$contactimm=null;if(!empty($tab['contactimm']))$contactimm = stripslashes((filter_var($tab['contactimm'], FILTER_SANITIZE_STRING)));
			$horairesemaine=0;if(!empty($tab['horairesemaine']))$horairesemaine = $tab['horairesemaine'];
			$horairesemainedebut=null;if(!empty($tab['horairesemainedebut']))$horairesemainedebut = $tab['horairesemainedebut'];
			$horairesemainefin=null;if(!empty($tab['horairesemainefin']))$horairesemainefin = $tab['horairesemainefin'];
			$horairepausedebut=null;if(!empty($tab['horairepausedebut']))$horairepausedebut = $tab['horairepausedebut'];
			$horairepausefin=null;if(!empty($tab['horairepausefin']))$horairepausefin = $tab['horairepausefin'];
			
			if (!empty($conn)) {
				
               	$stmt = $conn->prepare("UPDATE stage SET etape=5, stage_contact=:stage_contact, stage_tel=:stage_tel, stage_com=:stage_com, stage_adr=:stage_adr,
				stage_codepos=:stage_codepos,stage_pk=:stage_pk,stage_quart=:stage_quart,stage_rue=:stage_rue,stage_imm=:stage_imm,
				typ_horaire=:typ_horaire,typ_horaire_opt1_h1=:typ_horaire_opt1_h1,typ_horaire_opt1_h2=:typ_horaire_opt1_h2,
				pause_dej_h1=:pause_dej_h1,pause_dej_h2=:pause_dej_h2 WHERE stage.stage_id=:stage_id and stage.ent_id=:ent_id");
				$stmt->bindParam(':stage_tel', $contactdepo);
				$stmt->bindParam(':stage_contact', $contactname);
				$stmt->bindParam(':stage_com', $contactcommune);
				$stmt->bindParam(':stage_adr', $contactgeo);
				$stmt->bindParam(':stage_codepos', $contactcodpost);
				$stmt->bindParam(':stage_pk', $contactpk);
				$stmt->bindParam(':stage_quart', $contactquartier);
				$stmt->bindParam(':stage_rue', $contactrue);
				$stmt->bindParam(':stage_imm', $contactimm);
				$stmt->bindParam(':typ_horaire', $horairesemaine);
				$stmt->bindParam(':typ_horaire_opt1_h1', $horairesemainedebut);
				$stmt->bindParam(':typ_horaire_opt1_h2', $horairesemainefin);
				$stmt->bindParam(':pause_dej_h1', $horairepausedebut);
				$stmt->bindParam(':pause_dej_h2', $horairepausefin);
				$stmt->bindParam(':ent_id', $ent_id);
				$stmt->bindParam(':stage_id', $stage_id);		
				$stmt->execute();
				$stmt->closeCursor();	
				
				$stmt = $conn->prepare("DELETE FROM stage_horaire WHERE stage_horaire.stage_id=:stage_id");
				$stmt->bindParam(':stage_id', $stage_id);
				$stmt->execute();
				$stmt->closeCursor();
					
				if($horairesemaine=="0"){
						
					$horairesemainedebut1=null;if(!empty($tab['horairesemainedebut1']))$horairesemainedebut1 = $tab['horairesemainedebut1'];
					$horairesemainefin1=null;if(!empty($tab['horairesemainefin1']))$horairesemainefin1 = $tab['horairesemainefin1'];
			
					$stmt = $conn->prepare("INSERT INTO stage_horaire (stage_id, day_id, heure1, heure2) VALUES (:stage_id, 1, :heure1, :heure2)");
					$stmt->bindParam(':stage_id', $stage_id);
					$stmt->bindParam(':heure1', $horairesemainedebut1);
					$stmt->bindParam(':heure2', $horairesemainefin1);
					$stmt->execute();
					
					$horairesemainedebut2=null;if(!empty($tab['horairesemainedebut2']))$horairesemainedebut2 = $tab['horairesemainedebut2'];
					$horairesemainefin2=null;if(!empty($tab['horairesemainefin2']))$horairesemainefin2 = $tab['horairesemainefin2'];
			
					$stmt = $conn->prepare("INSERT INTO stage_horaire (stage_id, day_id, heure1, heure2) VALUES (:stage_id, 2, :heure1, :heure2)");
					$stmt->bindParam(':stage_id', $stage_id);
					$stmt->bindParam(':heure1', $horairesemainedebut2);
					$stmt->bindParam(':heure2', $horairesemainefin2);
					$stmt->execute();
					
					$horairesemainedebut3=null;if(!empty($tab['horairesemainedebut3']))$horairesemainedebut3 = $tab['horairesemainedebut3'];
					$horairesemainefin3=null;if(!empty($tab['horairesemainefin3']))$horairesemainefin3 = $tab['horairesemainefin3'];
						
					$stmt = $conn->prepare("INSERT INTO stage_horaire (stage_id, day_id, heure1, heure2) VALUES (:stage_id, 3, :heure1, :heure2)");
					$stmt->bindParam(':stage_id', $stage_id);
					$stmt->bindParam(':heure1', $horairesemainedebut3);
					$stmt->bindParam(':heure2', $horairesemainefin3);
					$stmt->execute();
						
					$horairesemainedebut4=null;if(!empty($tab['horairesemainedebut4']))$horairesemainedebut4 = $tab['horairesemainedebut4'];
					$horairesemainefin4=null;if(!empty($tab['horairesemainefin4']))$horairesemainefin4 = $tab['horairesemainefin4'];
			
					$stmt = $conn->prepare("INSERT INTO stage_horaire (stage_id, day_id, heure1, heure2) VALUES (:stage_id, 4, :heure1, :heure2)");
					$stmt->bindParam(':stage_id', $stage_id);
					$stmt->bindParam(':heure1', $horairesemainedebut4);
					$stmt->bindParam(':heure2', $horairesemainefin4);
					$stmt->execute();
					
					$horairesemainedebut5=null;if(!empty($tab['horairesemainedebut5']))$horairesemainedebut5 = $tab['horairesemainedebut5'];
					$horairesemainefin5=null;if(!empty($tab['horairesemainefin5']))$horairesemainefin5 = $tab['horairesemainefin5'];
			
					$stmt = $conn->prepare("INSERT INTO stage_horaire (stage_id, day_id, heure1, heure2) VALUES (:stage_id, 5, :heure1, :heure2)");
					$stmt->bindParam(':stage_id', $stage_id);
					$stmt->bindParam(':heure1', $horairesemainedebut5);
					$stmt->bindParam(':heure2', $horairesemainefin5);
					$stmt->execute();
					
					$horairesemainedebut6=null;if(!empty($tab['horairesemainedebut6']))$horairesemainedebut6 = $tab['horairesemainedebut6'];
					$horairesemainefin6=null;if(!empty($tab['horairesemainefin6']))$horairesemainefin6 = $tab['horairesemainefin6'];
			
					$stmt = $conn->prepare("INSERT INTO stage_horaire (stage_id, day_id, heure1, heure2) VALUES (:stage_id, 6, :heure1, :heure2)");
					$stmt->bindParam(':stage_id', $stage_id);
					$stmt->bindParam(':heure1', $horairesemainedebut6);
					$stmt->bindParam(':heure2', $horairesemainefin6);
					$stmt->execute();
						
				}
				

                $conn = null;

            } else
                $err = "connerr";
     
        return $err;

    } catch
    (PDOException $e) {
        $err = $e;
        $conn = null;
        return $err;
    }
}



//********************************************************************
// Fonction : addstage5
//********************************************************************
function addstage5($tab)   //form connexion compte elv
{
    try {

        //initialisation du message d'erreur
        $err = "";

       
            //Connexion à la base de données
            $conn = ConnBDDpdo();

            if (!session_id()) {
                session_start();
            }
			$GLOBALS["lastid"]=$tab['stageid'];
			$ent_id=decryptIt($_SESSION["ent_id"],$_SESSION["hashsession"]);
			$stage_id=decryptIt($tab['stageid'],$_SESSION["hashsession"]);
			
			if (!empty($conn)) {
				
				$stmt = $conn->prepare("SELECT * FROM stage WHERE stage.stage_id=:stage_id and stage.ent_id=:ent_id");
				$stmt->bindParam(':ent_id', $ent_id);
				$stmt->bindParam(':stage_id', $stage_id);
				$stmt->execute();
				$res = $stmt->fetch(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				
				if($res["type_id"]=="1"){
					
					$GLOBALS["ongstage"]="3eme";
					
				}else if($res["type_id"]=="2"){
					
					$GLOBALS["ongstage"]="pfmp";
					
				}else{
					
					$GLOBALS["ongstage"]="bts";
					
				}
			
			
               	$stmt = $conn->prepare("UPDATE stage SET publish=1 WHERE stage.stage_id=:stage_id and stage.ent_id=:ent_id");
				$stmt->bindParam(':ent_id', $ent_id);
				$stmt->bindParam(':stage_id', $stage_id);		
				$stmt->execute();
				$stmt->closeCursor();	
				

                $conn = null;

            } else
                $err = "connerr";
     
        return $err;

    } catch
    (PDOException $e) {
        $err = $e;
        $conn = null;
        return $err;
    }
}




//********************************************************************
// Fonction : supprimerstage
//********************************************************************
function supprimerstage($tab)   //form connexion compte elv
{
    try {

        //initialisation du message d'erreur
        $err = "";

       
            //Connexion à la base de données
            $conn = ConnBDDpdo();

            if (!session_id()) {
                session_start();
            }
			
			$ent_id=decryptIt($_SESSION["ent_id"],$_SESSION["hashsession"]);
			$stage_id=decryptIt($tab['chpiddel'],$_SESSION["hashsession"]);
			
			if (!empty($conn)) {
				
				$stmt = $conn->prepare("DELETE FROM stage WHERE stage.stage_id=:stage_id and stage.ent_id=:ent_id");
				$stmt->bindParam(':stage_id', $stage_id);
				$stmt->bindParam(':ent_id', $ent_id);
				$stmt->execute();
				$stmt->closeCursor();
				
				$stmt = $conn->prepare("DELETE FROM stage_sem WHERE stage_sem.stage_id=:stage_id");
				$stmt->bindParam(':stage_id', $stage_id);
				$stmt->execute();
				$stmt->closeCursor();
				
				$stmt = $conn->prepare("DELETE FROM stage_horaire WHERE stage_horaire.stage_id=:stage_id");
				$stmt->bindParam(':stage_id', $stage_id);
				$stmt->execute();
				$stmt->closeCursor();
				
				$stmt = $conn->prepare("DELETE FROM stage_uai WHERE stage_uai.stage_id=:stage_id");
				$stmt->bindParam(':stage_id', $stage_id);
				$stmt->execute();
				$stmt->closeCursor();

                $conn = null;

            } else
                $err = "connerr";
     
        return $err;

    } catch
    (PDOException $e) {
        $err = $e;
        $conn = null;
        return $err;
    }
}



//********************************************************************
// Fonction : closestage
//********************************************************************
function closestage($tab)   //form connexion compte elv
{
    try {

        //initialisation du message d'erreur
        $err = "";

       
            //Connexion à la base de données
            $conn = ConnBDDpdo();

            if (!session_id()) {
                session_start();
            }
			
			$ent_id=decryptIt($_SESSION["ent_id"],$_SESSION["hashsession"]);
			$stage_id=decryptIt($tab['chpiddel'],$_SESSION["hashsession"]);
			
			if (!empty($conn)) {
				
				 $stmt = $conn->prepare("UPDATE stage SET publish=0 WHERE stage.stage_id=:stage_id");
				$stmt->bindParam(':stage_id', $stage_id);
				$stmt->execute();
				$stmt->closeCursor();
				
				
                $conn = null;

            } else
                $err = "connerr";
     
        return $err;

    } catch
    (PDOException $e) {
        $err = $e;
        $conn = null;
        return $err;
    }
}



//********************************************************************
// Fonction : openstage
//********************************************************************
function openstage($tab)   //form connexion compte elv
{
    try {

        //initialisation du message d'erreur
        $err = "";

       
            //Connexion à la base de données
            $conn = ConnBDDpdo();

            if (!session_id()) {
                session_start();
            }
			
			$ent_id=decryptIt($_SESSION["ent_id"],$_SESSION["hashsession"]);
			$stage_id=decryptIt($tab['chpiddel'],$_SESSION["hashsession"]);
			
			if (!empty($conn)) {
				
				 $stmt = $conn->prepare("UPDATE stage SET publish=1 WHERE stage.stage_id=:stage_id");
				$stmt->bindParam(':stage_id', $stage_id);
				$stmt->execute();
				$stmt->closeCursor();
				
				
                $conn = null;

            } else
                $err = "connerr";
     
        return $err;

    } catch
    (PDOException $e) {
        $err = $e;
        $conn = null;
        return $err;
    }
}




//********************************************************************
// Fonction : postuler1
//********************************************************************
function postuler1($tab)   //form connexion compte elv
{
    try {

        //initialisation du message d'erreur
        $err = "";

       
            //Connexion à la base de données
            $conn = ConnBDDpdo();

            if (!session_id()) {
                session_start();
            }
			
			if(lgchkpeda() and isset($_SESSION["elv_id2"])){
				
				$elv_id=decryptIt($_SESSION["elv_id2"],$_SESSION["hashsession"]);
			
			}else{
				
				$elv_id=decryptIt($_SESSION["elv_id"],$_SESSION["hashsession"]);
				
			}
				
			$stage_id=decryptIt($tab["stage_id"],$_SESSION["hashsession"]);
			
			 $username = "";
            if (!empty($tab['username'])) $username = stripslashes((filter_var($tab['username'], FILTER_SANITIZE_STRING)));
            $userprename = "";
            if (!empty($tab['userprename'])) $userprename = stripslashes((filter_var($tab['userprename'], FILTER_SANITIZE_STRING)));
            $usertel = "";
            if (!empty($tab['usertel'])) $usertel = stripslashes((filter_var($tab['usertel'], FILTER_SANITIZE_STRING)));
			
            $chpddnais = "";
            if (!empty($tab['chpddnais'])) {
                $chpddnais = stripslashes((filter_var($tab['chpddnais'], FILTER_SANITIZE_STRING)));
                $chpddnais = fDate($chpddnais, "sql");
            }
            $usergeo = "";
            if (!empty($tab['usergeo'])) $usergeo = stripslashes((filter_var($tab['usergeo'], FILTER_SANITIZE_STRING)));
            $usercommune = "";
            if (!empty($tab['usercommune'])) $usercommune = $tab['usercommune'];
            $useretab = "0";
            if (!empty($tab['useretab'])) $useretab = $tab['useretab'];
            $usersexe = "";
            if (!empty($tab['usersexe'])) $usersexe = $tab['usersexe'];
            $userclass = 0;
            if (!empty($tab['userclass'])) $userclass = $tab['userclass'];
			$userdiplome = "";
            if (!empty($tab['userdiplome'])) $userdiplome = stripslashes((filter_var($tab['userdiplome'], FILTER_SANITIZE_STRING)));
			
            if (!empty($conn)) {
				
				if($tab['cand_id']=="0"){
					
					$stmt = $conn->prepare("INSERT INTO candidature (elv_id, stage_id, etape, d_crea) VALUES (:elv_id, :stage_id, 2, NOW())");
					$stmt->bindParam(':stage_id', $stage_id);
					$stmt->bindParam(':elv_id', $elv_id);
					$stmt->execute();
					
					$lastid=$conn->lastInsertId();
					
					$GLOBALS["lastid"]=encryptIt($lastid,$_SESSION["hashsession"]);
				
				
				}else{
					
					$cand_id=decryptIt($tab['cand_id'],$_SESSION["hashsession"]);
					
					$stmt = $conn->prepare("UPDATE candidature SET etape=2 WHERE candidature.cand_id=:cand_id");
					$stmt->bindParam(':cand_id', $cand_id);		
					$stmt->execute();
					$stmt->closeCursor();
					
					$GLOBALS["lastid"]=$tab['cand_id'];
					
				}
				
				
					
				
				$stmt = $conn->prepare("UPDATE eleve SET elv_nom=:elv_nom,elv_pren=:elv_pren,elv_tel=:elv_tel,elv_sexe=:elv_sexe,elv_datenaiss=:elv_datenaiss,elv_adr=:elv_adr,elv_com=:elv_com,elv_uai=:elv_uai,elv_class=:elv_class,elv_diplome=:elv_diplome WHERE eleve.elv_id=:elv_id");
                $stmt->bindParam(':elv_nom', $username);
                $stmt->bindParam(':elv_pren', $userprename);
                $stmt->bindParam(':elv_tel', $usertel);
                $stmt->bindParam(':elv_sexe', $usersexe);
                $stmt->bindParam(':elv_datenaiss', $chpddnais);
                $stmt->bindParam(':elv_adr', $usergeo);
                $stmt->bindParam(':elv_com', $usercommune);
                $stmt->bindParam(':elv_uai', $useretab);
                $stmt->bindParam(':elv_class', $userclass);
				$stmt->bindParam(':elv_diplome', $userdiplome);
                $stmt->bindParam(':elv_id', $elv_id);
                $stmt->execute();
                $stmt->closeCursor();
				
                $conn = null;

            } else
                $err = "connerr";
     
        return $err;

    } catch
    (PDOException $e) {
        $err = $e;
        $conn = null;
        return $err;
    }
}





//********************************************************************
// Fonction : postuler2
//********************************************************************
function postuler2($tab)   //form connexion compte elv
{
    try {

        //initialisation du message d'erreur
        $err = "";

		
            //Connexion à la base de données
            $conn = ConnBDDpdo();

            if (!session_id()) {
                session_start();
            }
			$GLOBALS["lastid"]=$tab['cand_id'];
				
			$cand_id=decryptIt($tab['cand_id'],$_SESSION["hashsession"]);
			
			$chpdddebut=null;if(!empty($tab['chpdddebut']))$chpdddebut = fDate($tab['chpdddebut'],"sql");
			$chpddfin=null;if(!empty($tab['chpddfin']))$chpddfin = fDate($tab['chpddfin'],"sql");
			
			$semaine=null;if(isset($tab['hosting_info']))$semaine=$tab['hosting_info'];
					
					
			
			if (!empty($conn)) {
				
				if($chpdddebut!=null){
					
					$tabdate=explode("-",$chpdddebut);
					if($tabdate[1]>12 or $tabdate[1]<0){
						
						$err = "errordate";
						
					}
					
					if($tabdate[2]>31 or $tabdate[2]<0){
						
						$err = "errordate";
						
					}
					
					
				}
				
				if($chpddfin!=null){
					
					$tabdate=explode("-",$chpddfin);
					if($tabdate[1]>12 or $tabdate[1]<0){
						
						$err = "errordate";
						
					}
					
					if($tabdate[2]>31 or $tabdate[2]<0){
						
						$err = "errordate";
						
						
					}
					
					
				}
				
				if($err!=""){
					
					$stmt = $conn->prepare("UPDATE candidature SET etape=2 WHERE candidature.cand_id=:cand_id");
					$stmt->bindParam(':cand_id', $cand_id);		
					$stmt->execute();
					$stmt->closeCursor();	
					
					return $err;
				
				}
				
               	$stmt = $conn->prepare("UPDATE candidature SET etape=3, semaine=:semaine, date_deb=:chpdddebut, date_fin=:chpddfin WHERE candidature.cand_id=:cand_id");
				$stmt->bindParam(':chpdddebut', $chpdddebut);
				$stmt->bindParam(':chpddfin', $chpddfin);
				$stmt->bindParam(':semaine', $semaine);
				$stmt->bindParam(':cand_id', $cand_id);		
				$stmt->execute();
				$stmt->closeCursor();	
				
				
				
				
				
                $conn = null;

            } else
                $err = "connerr";
     
        return $err;

    } catch
    (PDOException $e) {
        $err = $e;
        $conn = null;
        return $err;
    }
}




//********************************************************************
// Fonction : postuler3
//********************************************************************
function postuler3($tab,$files)   //form connexion compte elv
{
    try {

        //initialisation du message d'erreur
        $err = "";

       
            //Connexion à la base de données
            $conn = ConnBDDpdo();

            if (!session_id()) {
                session_start();
            }
			
			if(lgchkpeda() and isset($_SESSION["elv_id2"])){
				
				$elv_id=decryptIt($_SESSION["elv_id2"],$_SESSION["hashsession"]);
			
			}else{
				
				$elv_id=decryptIt($_SESSION["elv_id"],$_SESSION["hashsession"]);
				
			}
			
			$cand_id=decryptIt($tab['cand_id'],$_SESSION["hashsession"]);
			$GLOBALS["lastid"]=$tab['cand_id'];
				
			$userexp=null;if(!empty($tab['userexp']))$userexp = stripslashes((filter_var($tab['userexp'], FILTER_SANITIZE_STRING)));
			$useractivite=null;if(!empty($tab['useractivite']))$useractivite = stripslashes((filter_var($tab['useractivite'], FILTER_SANITIZE_STRING)));
			$userlangue=0;if(!empty($tab['userlangue']))$userlangue = stripslashes((filter_var($tab['userlangue'], FILTER_SANITIZE_STRING)));
			$usermotivation=null;if(!empty($tab['usermotivation']))$usermotivation = stripslashes((filter_var($tab['usermotivation'], FILTER_SANITIZE_STRING)));
			
			if (!empty($conn)) {
				
               	$stmt = $conn->prepare("UPDATE candidature SET etape=4, cand_cv=:cand_cv, cand_activite=:cand_activite, cand_lang=:cand_lang, cand_motiv=:cand_motiv WHERE candidature.cand_id=:cand_id");
				$stmt->bindParam(':cand_cv', $userexp);
				$stmt->bindParam(':cand_activite', $useractivite);
				$stmt->bindParam(':cand_lang', $userlangue);
				$stmt->bindParam(':cand_motiv', $usermotivation);
				$stmt->bindParam(':cand_id', $cand_id);		
				$stmt->execute();
				$stmt->closeCursor();	
				
				$stmt = $conn->prepare("UPDATE eleve SET elv_cv=:elv_cv, elv_activite=:elv_activite, elv_lang=:elv_lang WHERE eleve.elv_id=:elv_id");
				$stmt->bindParam(':elv_cv', $userexp);
				$stmt->bindParam(':elv_activite', $useractivite);
				$stmt->bindParam(':elv_lang', $userlangue);
				$stmt->bindParam(':elv_id', $elv_id);		
				$stmt->execute();
				$stmt->closeCursor();

				if (file_exists($files['cveleve']['tmp_name']) && is_uploaded_file($files['cveleve']['tmp_name'])) {    //verif si fichier exist et upload sur site


					$nom = hash('sha512', uniqid(openssl_random_pseudo_bytes(8), TRUE)); //hash le nom du fichier pour éviter les doublons//

					$infosfichier = pathinfo($files['cveleve']['name']);  //récup le nom du fichier dans une var
					$extension_upload = $infosfichier['extension']; //récup extension du fichier

					$nom_img = $nom . '.' . $extension_upload;  //nom-complet du fichier

					if ($extension_upload == "pdf") {   //si l'extension == pdf

						if (move_uploaded_file($files['cveleve']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/wp-content/uploads/cvpdf/' . $nom_img)) {   //téléverse le fichier vers l'url indiqué

							$chemin = $nom_img;
							//Modification des champs de l'utilisateur dans BDD
							$stmt = $conn->prepare("UPDATE eleve SET elv_cvpdf=:chemin WHERE eleve.elv_id=:elv_id");
							$stmt->bindParam(':chemin', $chemin);
							$stmt->bindParam(':elv_id', $elv_id);
							$stmt->execute();
							$stmt->closeCursor();

						}

					}
				}
				
                $conn = null;

            } else
                $err = "connerr";
     
        return $err;

    } catch
    (PDOException $e) {
        $err = $e;
        $conn = null;
        return $err;
    }
}


//********************************************************************
// Fonction : postuler4
//********************************************************************
function postuler4($tab)   //form connexion compte elv
{
    try {

        //initialisation du message d'erreur
        $err = "";

       
            //Connexion à la base de données
            $conn = ConnBDDpdo();

            if (!session_id()) {
                session_start();
            }
			
			
			$cand_id=decryptIt($tab['cand_id'],$_SESSION["hashsession"]);
			$GLOBALS["lastid"]=$tab['cand_id'];
			
			if(lgchkpeda() and isset($_SESSION["elv_id2"])){
				
				$GLOBALS["lastelv"]=$_SESSION["elv_id2"];
			
			}
			
			
			
			if (!empty($conn)) {
				
				$stmt = $conn->prepare("SELECT stage.type_id,candidature.stage_id,entreprise.ent_id,entreprise.ent_mail FROM candidature left join stage on stage.stage_id=candidature.stage_id left join entreprise on entreprise.ent_id=stage.ent_id WHERE candidature.cand_id=:cand_id");
				$stmt->bindParam(':cand_id', $cand_id);
				$stmt->execute();
				$res = $stmt->fetch(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
					
				$GLOBALS["lasttyp"]=$res["type_id"];
				
				$ent_id=$res["ent_id"];
				$ent_mail=$res["ent_mail"];
				
				
               	$stmt = $conn->prepare("UPDATE candidature SET statut=1, notif_elv=NOW(), d_crea=NOW() WHERE candidature.cand_id=:cand_id");
				$stmt->bindParam(':cand_id', $cand_id);
				$stmt->execute();
				$stmt->closeCursor();

				$activetoken = hash('sha512', uniqid(openssl_random_pseudo_bytes(8), TRUE));
                
				$stmt = $conn->prepare("UPDATE entreprise SET ent_token3=:token WHERE entreprise.ent_id=:ent_id");
				$stmt->bindParam(':token', $activetoken);
				$stmt->bindParam(':ent_id', $ent_id);
				$stmt->execute();
				$stmt->closeCursor();
				
				$url = get_template_directory_uri() . "/actiondev2.php?act=seconnecterurlent&token=".$activetoken."&redirect=candidature";
					
				//message-validation-envoyé
				$to = $ent_mail;
				$subject = 'Vous avez une nouvelle candidature pour un stage';

				$message = "Bonjour,<br>Veuillez trouver ci-dessous le lien pour accèder à votre compte sur monstage.education.pf.";
				$message .= "<p><a href='" . $url . "'>Accéder à mon compte</a></p>";
				$message .= "<p>Cordialement,</p>";
				$message .= "<p>DGEE - Direction Générale de l'Education et des enseignements</p>";
				$message .= "<p></p><p><i>Ce mail a été envoyé automatiquement via une application, merci de ne pas y répondre</i>.</p>";

				$headers = array('Content-Type: text/html; charset=UTF-8');

				wp_mail($to, $subject, $message, $headers);
				

                $conn = null;

            } else
                $err = "connerr";
     
        return $err;

    } catch
    (PDOException $e) {
        $err = $e;
        $conn = null;
        return $err;
    }
}



//********************************************************************
// Fonction : supprimercand
//********************************************************************
function supprimercand($tab)   //form connexion compte elv
{
    try {

        //initialisation du message d'erreur
        $err = "";

       
            //Connexion à la base de données
            $conn = ConnBDDpdo();

            if (!session_id()) {
                session_start();
            }
			
			$elv_id=decryptIt($_SESSION["elv_id"],$_SESSION["hashsession"]);
			$cand_id=decryptIt($tab['chpiddel'],$_SESSION["hashsession"]);
			
			if (!empty($conn)) {
				
				$GLOBALS["lastid"]=$tab['chpiddel'];
				
				$stmt = $conn->prepare("SELECT stage.type_id,candidature.stage_id FROM candidature left join stage on stage.stage_id=candidature.stage_id WHERE candidature.cand_id=:cand_id");
				$stmt->bindParam(':cand_id', $cand_id);
				$stmt->execute();
				$res = $stmt->fetch(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
					
				$GLOBALS["lasttyp"]=$res["type_id"];
				
				$staghash=encryptIt($res["stage_id"],$_SESSION["hashsession"]);
				
				$GLOBALS["laststage"]=$staghash;	
				
				$stmt = $conn->prepare("DELETE FROM candidature WHERE candidature.cand_id=:cand_id and candidature.elv_id=:elv_id");
				$stmt->bindParam(':cand_id', $cand_id);
				$stmt->bindParam(':elv_id', $elv_id);
				$stmt->execute();
				$stmt->closeCursor();
				
				
				
				

                $conn = null;

            } else
                $err = "connerr";
     
        return $err;

    } catch
    (PDOException $e) {
        $err = $e;
        $conn = null;
        return $err;
    }
}



//********************************************************************
// Fonction : supprimercand2
//********************************************************************
function supprimercand2($tab)   //form connexion compte elv
{
    try {

        //initialisation du message d'erreur
        $err = "";

       
            //Connexion à la base de données
            $conn = ConnBDDpdo();

            if (!session_id()) {
                session_start();
            }
			
			$elv_id=decryptIt($_SESSION["elv_id"],$_SESSION["hashsession"]);
			$cand_id=decryptIt($tab['chpiddel'],$_SESSION["hashsession"]);
			
			if (!empty($conn)) {
				
				$GLOBALS["lastid"]=$tab['chpiddel'];
				
				$stmt = $conn->prepare("SELECT stage.type_id,candidature.stage_id FROM candidature left join stage on stage.stage_id=candidature.stage_id WHERE candidature.cand_id=:cand_id");
				$stmt->bindParam(':cand_id', $cand_id);
				$stmt->execute();
				$res = $stmt->fetch(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
					
				$GLOBALS["lasttyp"]=$res["type_id"];
				
				$staghash=encryptIt($res["stage_id"],$_SESSION["hashsession"]);
				
				$GLOBALS["laststage"]=$staghash;	
				
				$stmt = $conn->prepare("DELETE FROM candidature WHERE candidature.cand_id=:cand_id and candidature.elv_id=:elv_id");
				$stmt->bindParam(':cand_id', $cand_id);
				$stmt->bindParam(':elv_id', $elv_id);
				$stmt->execute();
				$stmt->closeCursor();
				
				
				
				

                $conn = null;

            } else
                $err = "connerr";
     
        return $err;

    } catch
    (PDOException $e) {
        $err = $e;
        $conn = null;
        return $err;
    }
}



//********************************************************************
// Fonction : supprimercand3
//********************************************************************
function supprimercand3($tab)   //form connexion compte elv
{
    try {

        //initialisation du message d'erreur
        $err = "";

       
            //Connexion à la base de données
            $conn = ConnBDDpdo();

            if (!session_id()) {
                session_start();
            }
			
			
			$cand_id=decryptIt($tab['chpiddel'],$_SESSION["hashsession"]);
			
			if (!empty($conn)) {
				
				
				
				$stmt = $conn->prepare("SELECT stage.type_id,candidature.stage_id,candidature.elv_id FROM candidature left join stage on stage.stage_id=candidature.stage_id WHERE candidature.cand_id=:cand_id");
				$stmt->bindParam(':cand_id', $cand_id);
				$stmt->execute();
				$res = $stmt->fetch(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				
				$elv_id=$res["elv_id"];
				
				$elvhash=encryptIt($elv_id,$_SESSION["hashsession"]);
					
				$GLOBALS["lasttyp"]=$res["type_id"];
				
				$staghash=encryptIt($res["stage_id"],$_SESSION["hashsession"]);
				
				$GLOBALS["laststage"]=$staghash;
				$GLOBALS["lastelv"]=$elvhash;				
				
				$stmt = $conn->prepare("DELETE FROM candidature WHERE candidature.cand_id=:cand_id and candidature.elv_id=:elv_id");
				$stmt->bindParam(':cand_id', $cand_id);
				$stmt->bindParam(':elv_id', $elv_id);
				$stmt->execute();
				$stmt->closeCursor();
				
				
				
				

                $conn = null;

            } else
                $err = "connerr";
     
        return $err;

    } catch
    (PDOException $e) {
        $err = $e;
        $conn = null;
        return $err;
    }
}





//********************************************************************
// Fonction : acceptcand
//********************************************************************
function acceptcand($tab)   //form connexion compte elv
{
    try {

        //initialisation du message d'erreur
        $err = "";

       
            //Connexion à la base de données
            $conn = ConnBDDpdo();

            if (!session_id()) {
                session_start();
            }
			
			$cand_id=decryptIt($tab['chpidaccept'],$_SESSION["hashsession"]);
			
			
			if (!empty($conn)) {
				
				
				$stmt = $conn->prepare("SELECT candidature.*,eleve.*,stage.*,entreprise.*,uai.*, classe.class_lib FROM candidature left join eleve on eleve.elv_id=candidature.elv_id left join uai on uai.uai_rne=eleve.elv_uai left join classe on classe.class_id=eleve.elv_class left join stage on stage.stage_id=candidature.stage_id left join entreprise on entreprise.ent_id=stage.ent_id WHERE candidature.cand_id=:cand_id");
				$stmt->bindParam(':cand_id', $cand_id);
				$stmt->execute();
				$res = $stmt->fetch(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				
				$elv_id=$res["elv_id"];
				$stage_id=$res["stage_id"];
				$elv_diplome=$res["elv_diplome"];
				$ent_adr=$res["ent_adr"];
				$ent_nom=$res["ent_nom"];
				$ent_domaine=$res["ent_domaine"];
				$ent_tel=$res["ent_tel"];
				$ent_copier=$res["ent_copier"];
				$ent_numtahiti=$res["ent_numtahiti"];
				$ent_represant=$res["ent_represant"];
				$ent_represant_funct=$res["ent_represant_funct"];
				$ent_represant_mail=$res["ent_represant_mail"];
				$ent_tuteur=$res["ent_tuteur"];
				$ent_tuteur_funct=$res["ent_tuteur_funct"];
				$ent_tuteur_mail=$res["ent_tuteur_mail"];
				$ent_tuteur_tel=$res["ent_tuteur_tel"];
				$ent_mail=$res["ent_mail"];
				$uai_adr=$res["uai_adr"];
				$uai_tel=$res["uai_tel"];
				$uai_delib=$res["uai_delib"];
				$uai_copier=$res["uai_copier"];
				$uai_represant=$res["uai_represant"];
				$uai_mail=$res["uai_mail"];
				$referent_nom="";
				$referent_mail="";
				$elv_nom=$res["elv_nom"];
				$elv_pren=$res["elv_pren"];
				$elv_datenaiss=$res["elv_datenaiss"];
				$elv_adr=$res["elv_adr"];
				$elv_tel=$res["elv_tel"];
				$elv_mail=$res["elv_mail"];
				$elv_class=$res["class_lib"];
				$date_stage="";
				$typ_horaire_opt1_h1="";
				$typ_horaire_opt1_h2="";
				$ent_lieustage=$res["ent_adr"];
				$responsable="";
				$etudiant=$res["elv_nom"]." ".$res["elv_pren"];
				
				if($res["dispo"]=="1" or $res["dispo"]=="3"){
			
					$date_stage="Du ".fDate($res["date_deb"],"html")." au ".fDate($res["date_fin"],"html");
					
				}else{
					
					$weeks=getWeek();

					foreach($weeks as $value){
						
						$tabdate1=explode("/",$value[1]);
						$tabdate2=explode("/",$value[2]);
						
						$mois1=getmois($tabdate1[1]);
						$mois2=getmois($tabdate2[1]);
						
						
						
						
						if($value[0]==$res["semaine"]){
							
							if($mois1==$mois2){
							
								$date_stage= "Du ".$tabdate1[0]." au ".$tabdate2[0]." ".$mois1." ".$tabdate1[2];
						
							}else{
							
								$date_stage= "Du ".$tabdate1[0]." ".$mois1." au ".$tabdate2[0]." ".$mois2." ".$tabdate1[2];												
								
							}
							
							
						}
							
					}
					
				}
		
		
		
				$uai_assureur=$res["uai_assureur"];
				$uai_numcontrat=$res["uai_numcontrat"];
				
				$lundimatin="";$pause_dej_h1_lundi="";$pause_dej_h2_lundi="";$lundiaprem="";	
				$mardimatin="";$pause_dej_h1_mardi="";$pause_dej_h2_mardi="";$mardiaprem="";
				$mercredimatin="";$pause_dej_h1_mercredi="";$pause_dej_h2_mercredi="";$mercrediaprem="";
				$jeudimatin="";$pause_dej_h1_jeudi="";$pause_dej_h2_jeudi="";$jeudiaprem="";
				$vendredimatin="";$pause_dej_h1_vendredi="";$pause_dej_h2_vendredi="";$vendrediaprem="";
				$samedimatin="";$pause_dej_h1_samedi="";$pause_dej_h2_samedi="";$samediaprem="";
							
				if($res["typ_horaire"]=="1"){
					
					$typ_horaire_opt1_h1=$res["typ_horaire_opt1_h1"];
					$typ_horaire_opt1_h2=$res["typ_horaire_opt1_h2"];
									
					$lundimatin=$res["typ_horaire_opt1_h1"];
					$pause_dej_h1_lundi=$res["pause_dej_h1"];
					$pause_dej_h2_lundi=$res["pause_dej_h2"];
					$lundiaprem=$res["typ_horaire_opt1_h2"];
					
					$mardimatin=$res["typ_horaire_opt1_h1"];
					$pause_dej_h1_mardi=$res["pause_dej_h1"];
					$pause_dej_h2_mardi=$res["pause_dej_h2"];
					$mardiaprem=$res["typ_horaire_opt1_h2"];
					
					$mercredimatin=$res["typ_horaire_opt1_h1"];
					$pause_dej_h1_mercredi=$res["pause_dej_h1"];
					$pause_dej_h2_mercredi=$res["pause_dej_h2"];
					$mercrediaprem=$res["typ_horaire_opt1_h2"];
					
					$jeudimatin=$res["typ_horaire_opt1_h1"];
					$pause_dej_h1_jeudi=$res["pause_dej_h1"];
					$pause_dej_h2_jeudi=$res["pause_dej_h2"];
					$jeudiaprem=$res["typ_horaire_opt1_h2"];
					
					$vendredimatin=$res["typ_horaire_opt1_h1"];
					$pause_dej_h1_vendredi=$res["pause_dej_h1"];
					$pause_dej_h2_vendredi=$res["pause_dej_h2"];
					$vendrediaprem=$res["typ_horaire_opt1_h2"];
					
				}else{
					
					$res_horaire1=recData("stage_horaire1",$stage_id);
					if($res_horaire1["heure1"]!=null){
						$lundimatin=$res_horaire1["heure1"];
						$typ_horaire_opt1_h1=$res_horaire1["heure1"];
					}
					$pause_dej_h1_lundi=$res["pause_dej_h1"];
					$pause_dej_h2_lundi=$res["pause_dej_h2"];
					if($res_horaire1["heure2"]!=null){
						$lundiaprem=$res_horaire1["heure2"];
						$typ_horaire_opt1_h2=$res_horaire1["heure2"];
					}
					
					
					
					$res_horaire2=recData("stage_horaire2",$stage_id);
					if($res_horaire2["heure1"]!=null){
						$mardimatin=$res_horaire2["heure1"];
						$typ_horaire_opt1_h1=$res_horaire2["heure1"];
					}
					$pause_dej_h1_mardi=$res["pause_dej_h1"];
					$pause_dej_h2_mardi=$res["pause_dej_h2"];
					if($res_horaire2["heure2"]!=null){
						$mardiaprem=$res_horaire2["heure2"];
						$typ_horaire_opt1_h2=$res_horaire2["heure2"];
					}
					
					$res_horaire3=recData("stage_horaire3",$stage_id);
					if($res_horaire3["heure1"]!=null){
						$mercredimatin=$res_horaire3["heure1"];
						$typ_horaire_opt1_h1=$res_horaire3["heure1"];
					}
					$pause_dej_h1_mercredi=$res["pause_dej_h1"];
					$pause_dej_h2_mercredi=$res["pause_dej_h2"];
					if($res_horaire3["heure2"]!=null){
						$mercrediaprem=$res_horaire3["heure2"];
						$typ_horaire_opt1_h2=$res_horaire3["heure2"];
					}
					
					$res_horaire4=recData("stage_horaire4",$stage_id);
					if($res_horaire4["heure1"]!=null)$jeudimatin=$res_horaire4["heure1"];
					$pause_dej_h1_jeudi=$res["pause_dej_h1"];
					$pause_dej_h2_jeudi=$res["pause_dej_h2"];
					if($res_horaire4["heure2"]!=null)$jeudiaprem=$res_horaire4["heure2"];
					
					$res_horaire5=recData("stage_horaire5",$stage_id);
					if($res_horaire5["heure1"]!=null)$vendredimatin=$res_horaire5["heure1"];
					$pause_dej_h1_vendredi=$res["pause_dej_h1"];
					$pause_dej_h2_vendredi=$res["pause_dej_h2"];
					if($res_horaire5["heure2"]!=null)$vendrediaprem=$res_horaire5["heure2"];
					
					$res_horaire6=recData("stage_horaire6",$stage_id);
					if($res_horaire6["heure1"]!=null)$samedimatin=$res_horaire6["heure1"];
					$pause_dej_h1_samedi=$res["pause_dej_h1"];
					$pause_dej_h2_samedi=$res["pause_dej_h2"];
					if($res_horaire6["heure2"]!=null)$samediaprem=$res_horaire6["heure2"];
					
				}
				
				$nbjour=0;
				
				$nbheurelundimatin=0;
				$nbminutelundimatin=0;
				
				if($lundimatin!="" or $lundiaprem!="")$nbjour++;
					
				if($lundimatin!=""){
					
					$tabhorairelundimatin=explode("h",$lundimatin);
					
					
					$nbminutetotal1=($tabhorairelundimatin[0]*60)+$tabhorairelundimatin[1];
					
					$tabpause_dej_h1=explode("h",$res["pause_dej_h1"]);
					
					$nbminutetotal2=$tabpause_dej_h1[0]*60+$tabpause_dej_h1[1];
					
					$nbminutetotal=$nbminutetotal2-$nbminutetotal1;
					
					$nbheurelundimatin=floor($nbminutetotal/60);
					$nbminutelundimatin=$nbminutetotal-($nbheurelundimatin*60);
					
					
				}
				
				$nbheurelundiaprem=0;
				$nbminutelundiaprem=0;
				if($lundiaprem!=""){
					$tabhorairelundiaprem=explode("h",$lundiaprem);
					
					
					$nbminutetotal1=$tabhorairelundiaprem[0]*60+$tabhorairelundiaprem[1];
					
					$tabpause_dej_h2=explode("h",$res["pause_dej_h2"]);
					
					$nbminutetotal2=$tabpause_dej_h2[0]*60+$tabpause_dej_h2[1];
					
					$nbminutetotal=$nbminutetotal1-$nbminutetotal2;
					
					$nbheurelundiaprem=floor($nbminutetotal/60);
					$nbminutelundiaprem=$nbminutetotal-($nbheurelundiaprem*60);
					
					
				}
				
				
				
				if($mardimatin!="" or $mardiaprem!="")$nbjour++;
				
				$nbheuremardimatin=0;
				$nbminutemardimatin=0;
				if($mardimatin!=""){
					$tabhorairemardimatin=explode("h",$mardimatin);
					
					
					$nbminutetotal1=$tabhorairemardimatin[0]*60+$tabhorairemardimatin[1];
					
					$tabpause_dej_h1=explode("h",$res["pause_dej_h1"]);
					
					$nbminutetotal2=$tabpause_dej_h1[0]*60+$tabpause_dej_h1[1];
					
					$nbminutetotal=$nbminutetotal2-$nbminutetotal1;
					
					$nbheuremardimatin=floor($nbminutetotal/60);
					$nbminutemardimatin=$nbminutetotal-($nbheuremardimatin*60);
					
					
				}
				
				$nbheuremardiaprem=0;
				$nbminutemardiaprem=0;
				if($mardiaprem!=""){
					$tabhorairemardiaprem=explode("h",$mardiaprem);
					
					
					$nbminutetotal1=$tabhorairemardiaprem[0]*60+$tabhorairemardiaprem[1];
					
					$tabpause_dej_h2=explode("h",$res["pause_dej_h2"]);
					
					$nbminutetotal2=$tabpause_dej_h2[0]*60+$tabpause_dej_h2[1];
					
					$nbminutetotal=$nbminutetotal1-$nbminutetotal2;
					
					$nbheuremardiaprem=floor($nbminutetotal/60);
					$nbminutemardiaprem=$nbminutetotal-($nbheuremardiaprem*60);
					
					
				}
				
				if($mercredimatin!="" or $mercrediaprem!="")$nbjour++;
				
				$nbheuremercredimatin=0;
				$nbminutemercredimatin=0;
				if($mercredimatin!=""){
					$tabhorairemercredimatin=explode("h",$mercredimatin);
					
					
					$nbminutetotal1=$tabhorairemercredimatin[0]*60+$tabhorairemercredimatin[1];
					
					$tabpause_dej_h1=explode("h",$res["pause_dej_h1"]);
					
					$nbminutetotal2=$tabpause_dej_h1[0]*60+$tabpause_dej_h1[1];
					
					$nbminutetotal=$nbminutetotal2-$nbminutetotal1;
					
					$nbheuremercredimatin=floor($nbminutetotal/60);
					$nbminutemercredimatin=$nbminutetotal-($nbheuremercredimatin*60);
					
					
				}
				
				$nbheuremercrediaprem=0;
				$nbminutemercrediaprem=0;
				if($mercrediaprem!=""){
					$tabhorairemercrediaprem=explode("h",$mercrediaprem);
					
					
					$nbminutetotal1=$tabhorairemercrediaprem[0]*60+$tabhorairemercrediaprem[1];
					
					$tabpause_dej_h2=explode("h",$res["pause_dej_h2"]);
					
					$nbminutetotal2=$tabpause_dej_h2[0]*60+$tabpause_dej_h2[1];
					
					$nbminutetotal=$nbminutetotal1-$nbminutetotal2;
					
					$nbheuremercrediaprem=floor($nbminutetotal/60);
					$nbminutemercrediaprem=$nbminutetotal-($nbheuremercrediaprem*60);
					
					
				}
				
				if($jeudimatin!="" or $jeudiaprem!="")$nbjour++;
				
				$nbheurejeudimatin=0;
				$nbminutejeudimatin=0;
				if($jeudimatin!=""){
					$tabhorairejeudimatin=explode("h",$jeudimatin);
					
					
					$nbminutetotal1=$tabhorairejeudimatin[0]*60+$tabhorairejeudimatin[1];
					
					$tabpause_dej_h1=explode("h",$res["pause_dej_h1"]);
					
					$nbminutetotal2=$tabpause_dej_h1[0]*60+$tabpause_dej_h1[1];
					
					$nbminutetotal=$nbminutetotal2-$nbminutetotal1;
					
					$nbheurejeudimatin=floor($nbminutetotal/60);
					$nbminutejeudimatin=$nbminutetotal-($nbheurejeudimatin*60);
					
					
				}
				
				$nbheurejeudiaprem=0;
				$nbminutejeudiaprem=0;
				if($jeudiaprem!=""){
					$tabhorairejeudiaprem=explode("h",$jeudiaprem);
					
					
					$nbminutetotal1=$tabhorairejeudiaprem[0]*60+$tabhorairejeudiaprem[1];
					
					$tabpause_dej_h2=explode("h",$res["pause_dej_h2"]);
					
					$nbminutetotal2=$tabpause_dej_h2[0]*60+$tabpause_dej_h2[1];
					
					$nbminutetotal=$nbminutetotal1-$nbminutetotal2;
					
					$nbheurejeudiaprem=floor($nbminutetotal/60);
					$nbminutejeudiaprem=$nbminutetotal-($nbheurejeudiaprem*60);
					
					
				}
				
				if($vendredimatin!="" or $vendrediaprem!="")$nbjour++;
				
				$nbheurevendredimatin=0;
				$nbminutevendredimatin=0;
				if($vendredimatin!=""){
					$tabhorairevendredimatin=explode("h",$vendredimatin);
					
					
					$nbminutetotal1=$tabhorairevendredimatin[0]*60+$tabhorairevendredimatin[1];
					
					$tabpause_dej_h1=explode("h",$res["pause_dej_h1"]);
					
					$nbminutetotal2=$tabpause_dej_h1[0]*60+$tabpause_dej_h1[1];
					
					$nbminutetotal=$nbminutetotal2-$nbminutetotal1;
					
					$nbheurevendredimatin=floor($nbminutetotal/60);
					$nbminutevendredimatin=$nbminutetotal-($nbheurevendredimatin*60);
					
					
				}
				
				$nbheurevendrediaprem=0;
				$nbminutevendrediaprem=0;
				if($vendrediaprem!=""){
					$tabhorairevendrediaprem=explode("h",$vendrediaprem);
					
					
					$nbminutetotal1=$tabhorairevendrediaprem[0]*60+$tabhorairevendrediaprem[1];
					
					$tabpause_dej_h2=explode("h",$res["pause_dej_h2"]);
					
					$nbminutetotal2=$tabpause_dej_h2[0]*60+$tabpause_dej_h2[1];
					
					$nbminutetotal=$nbminutetotal1-$nbminutetotal2;
					
					$nbheurevendrediaprem=floor($nbminutetotal/60);
					$nbminutevendrediaprem=$nbminutetotal-($nbheurevendrediaprem*60);
					
					
				}
				
				if($samedimatin!="" or $samediaprem!="")$nbjour++;
				
				$nbheuresamedimatin=0;
				$nbminutesamedimatin=0;
				if($samedimatin!=""){
					$tabhorairesamedimatin=explode("h",$samedimatin);
					
					
					$nbminutetotal1=$tabhorairesamedimatin[0]*60+$tabhorairesamedimatin[1];
					
					$tabpause_dej_h1=explode("h",$res["pause_dej_h1"]);
					
					$nbminutetotal2=$tabpause_dej_h1[0]*60+$tabpause_dej_h1[1];
					
					$nbminutetotal=$nbminutetotal2-$nbminutetotal1;
					
					$nbheuresamedimatin=floor($nbminutetotal/60);
					$nbminutesamedimatin=$nbminutetotal-($nbheuresamedimatin*60);
					
					
				}
				
				$nbheuresamediaprem=0;
				$nbminutesamediaprem=0;
				if($samediaprem!=""){
					$tabhorairesamediaprem=explode("h",$samediaprem);
					
					
					$nbminutetotal1=$tabhorairesamediaprem[0]*60+$tabhorairesamediaprem[1];
					
					$tabpause_dej_h2=explode("h",$res["pause_dej_h2"]);
					
					$nbminutetotal2=$tabpause_dej_h2[0]*60+$tabpause_dej_h2[1];
					
					$nbminutetotal=$nbminutetotal1-$nbminutetotal2;
					
					$nbheuresamediaprem=floor($nbminutetotal/60);
					$nbminutesamediaprem=$nbminutetotal-($nbheuresamediaprem*60);
					
					
				}
				
				$horairesemaine=($nbheurelundimatin*60)+$nbminutelundimatin+($nbheurelundiaprem*60)+$nbminutelundiaprem+($nbheuremardimatin*60)+$nbminutemardimatin+($nbheuremardiaprem*60)+$nbminutemardiaprem+($nbheuremercredimatin*60)+$nbminutemercredimatin+($nbheuremercrediaprem*60)+$nbminutemercrediaprem+($nbheurejeudimatin*60)+$nbminutejeudimatin+($nbheurejeudiaprem*60)+$nbminutejeudiaprem+($nbheurevendredimatin*60)+$nbminutevendredimatin+($nbheurevendrediaprem*60)+$nbminutevendrediaprem+($nbheuresamedimatin*60)+$nbminutesamedimatin+($nbheuresamediaprem*60)+$nbminutesamediaprem;
				
				$horairejournalier=$horairesemaine/$nbjour;
				
				$heurejournalier=floor($horairejournalier/60);
				
				$minutejournalier=$horairejournalier-($heurejournalier*60);
				
				if($heurejournalier<10)$heurejournalier="0".$heurejournalier;
				if($minutejournalier<10)$minutejournalier="0".$minutejournalier;
				
				$horairejour=$heurejournalier."h".$minutejournalier;
				
				
				
				$heuretotal=floor($horairesemaine/60);
				$minutetotal=$horairesemaine-($heuretotal*60);
				
				if($heuretotal<10)$heuretotal="0".$heuretotal;
				if($minutetotal<10)$minutetotal="0".$minutetotal;
				
				$horaireweek=$heuretotal."h".$minutetotal;
				
				
				$ent_assurreur=$res["ent_assurreur"];
				$ent_numcontrat=$res["ent_numcontrat"];
				$uai_assureur=$res["uai_assureur"];
				$uai_numcontrat=$res["uai_numcontrat"];			
				
				
				
				$stmt = $conn->prepare("SELECT pedagogique.* FROM peda_elv left join pedagogique on pedagogique.peda_id=peda_elv.peda_id WHERE peda_elv.elv_id=:elv_id order by d_crea desc LIMIT 1");
				$stmt->bindParam(':elv_id', $elv_id);
				$stmt->execute();
				
				$peda_id=0;
				
				if($stmt->rowCount()>0){
					
					$res = $stmt->fetch(PDO::FETCH_ASSOC);
					$stmt->closeCursor();
					
					$peda_id=$res["peda_id"];
					$referent_nom=$res["peda_nom"]." ".$res["peda_pren"];
					$referent_mail=$res["peda_mail"];
					$responsable=$referent_nom;
				
				}
				
               	$stmt = $conn->prepare("UPDATE candidature SET statut=3 WHERE candidature.cand_id=:cand_id");
				$stmt->bindParam(':cand_id', $cand_id);
				$stmt->execute();
				$stmt->closeCursor();
				
				$stmt = $conn->prepare("SELECT COUNT(*) as NB FROM convention WHERE convention.cand_id=:cand_id and convention.elv_id=:elv_id");
				$stmt->bindParam(':cand_id', $cand_id);
				$stmt->bindParam(':elv_id', $elv_id);
				$stmt->execute();
				$res = $stmt->fetch(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				
				if($res["NB"]=="0"){
					
					$reference=random_str_generator(8);
				
					$stmt = $conn->prepare("INSERT INTO convention (cand_id, elv_id, reference, elv_diplome, ent_adr, ent_nom, ent_domaine, ent_tel, ent_copier, ent_numtahiti, ent_represant, ent_represant_funct, ent_represant_mail, ent_tuteur, ent_tuteur_funct, ent_tuteur_mail, ent_tuteur_tel, ent_mail, uai_adr, uai_tel, uai_copier, uai_represant, uai_mail, referent_nom, referent_mail, elv_nom, elv_pren, elv_datenaiss, elv_adr, elv_tel, elv_mail, uai_delib, elv_nom2, elv_pren2, elv_class, elv_diplome2, referent_nom2, date_stage, responsable, etudiant, typ_horaire_opt1_h1, typ_horaire_opt1_h2, ent_lieustage, lundimatin, pause_dej_h1_lundi, pause_dej_h2_lundi, lundiaprem, mardimatin, pause_dej_h1_mardi, pause_dej_h2_mardi, mardiaprem, mercredimatin, pause_dej_h1_mercredi, pause_dej_h2_mercredi, mercrediaprem, jeudimatin, pause_dej_h1_jeudi, pause_dej_h2_jeudi, jeudiaprem, vendredimatin, pause_dej_h1_vendredi, pause_dej_h2_vendredi, vendrediaprem, samedimatin, pause_dej_h1_samedi, pause_dej_h2_samedi, samediaprem, horairejour, horaireweek, ent_assurreur, ent_numcontrat, uai_assureur, uai_numcontrat, notif_elv, notif_ent, notif_peda, d_crea) VALUES (:cand_id, :elv_id, :reference, :elv_diplome, :ent_adr, :ent_nom, :ent_domaine, :ent_tel, :ent_copier, :ent_numtahiti, :ent_represant, :ent_represant_funct, :ent_represant_mail, :ent_tuteur, :ent_tuteur_funct, :ent_tuteur_mail, :ent_tuteur_tel, :ent_mail, :uai_adr, :uai_tel, :uai_copier, :uai_represant, :uai_mail, :referent_nom, :referent_mail, :elv_nom, :elv_pren, :elv_datenaiss, :elv_adr, :elv_tel, :elv_mail, :uai_delib, :elv_nom2, :elv_pren2, :elv_class, :elv_diplome2, :referent_nom2, :date_stage, :responsable, :etudiant, :typ_horaire_opt1_h1, :typ_horaire_opt1_h2, :ent_lieustage, :lundimatin, :pause_dej_h1_lundi, :pause_dej_h2_lundi, :lundiaprem, :mardimatin, :pause_dej_h1_mardi, :pause_dej_h2_mardi, :mardiaprem, :mercredimatin, :pause_dej_h1_mercredi, :pause_dej_h2_mercredi, :mercrediaprem, :jeudimatin, :pause_dej_h1_jeudi, :pause_dej_h2_jeudi, :jeudiaprem, :vendredimatin, :pause_dej_h1_vendredi, :pause_dej_h2_vendredi, :vendrediaprem, :samedimatin, :pause_dej_h1_samedi, :pause_dej_h2_samedi, :samediaprem, :horairejour, :horaireweek, :ent_assurreur, :ent_numcontrat, :uai_assureur, :uai_numcontrat, NULL, NOW(), NULL, NOW())");
					$stmt->bindParam(':cand_id', $cand_id);
					$stmt->bindParam(':elv_id', $elv_id);
					$stmt->bindParam(':reference', $reference);
					$stmt->bindParam(':elv_diplome', $elv_diplome);
					$stmt->bindParam(':ent_adr', $ent_adr);
					$stmt->bindParam(':ent_nom', $ent_nom);
					$stmt->bindParam(':ent_domaine', $ent_domaine);
					$stmt->bindParam(':ent_tel', $ent_tel);
					$stmt->bindParam(':ent_copier', $ent_copier);
					$stmt->bindParam(':ent_numtahiti', $ent_numtahiti);
					$stmt->bindParam(':ent_represant', $ent_represant);
					$stmt->bindParam(':ent_represant_funct', $ent_represant_funct);
					$stmt->bindParam(':ent_represant_mail', $ent_represant_mail);
					$stmt->bindParam(':ent_tuteur', $ent_tuteur);
					$stmt->bindParam(':ent_tuteur_funct', $ent_tuteur_funct);
					$stmt->bindParam(':ent_tuteur_mail', $ent_tuteur_mail);
					$stmt->bindParam(':ent_tuteur_tel', $ent_tuteur_tel);
					$stmt->bindParam(':ent_mail', $ent_mail);
					$stmt->bindParam(':uai_adr', $uai_adr);
					$stmt->bindParam(':uai_tel', $uai_tel);
					$stmt->bindParam(':uai_copier', $uai_copier);
					$stmt->bindParam(':uai_represant', $uai_represant);
					$stmt->bindParam(':uai_mail', $uai_mail);
					$stmt->bindParam(':referent_nom', $referent_nom);
					$stmt->bindParam(':referent_mail', $referent_mail);
					$stmt->bindParam(':elv_nom', $elv_nom);
					$stmt->bindParam(':elv_pren', $elv_pren);
					$stmt->bindParam(':elv_datenaiss', $elv_datenaiss);
					$stmt->bindParam(':elv_adr', $elv_adr);
					$stmt->bindParam(':elv_tel', $elv_tel);
					$stmt->bindParam(':elv_mail', $elv_mail);
					$stmt->bindParam(':uai_delib', $uai_delib);
					$stmt->bindParam(':elv_nom2', $elv_nom);
					$stmt->bindParam(':elv_pren2', $elv_pren);
					$stmt->bindParam(':elv_class', $elv_class);
					$stmt->bindParam(':elv_diplome2', $elv_diplome);
					$stmt->bindParam(':referent_nom2', $referent_nom);
					$stmt->bindParam(':date_stage', $date_stage);
					$stmt->bindParam(':responsable', $responsable);
					$stmt->bindParam(':etudiant', $etudiant);
					$stmt->bindParam(':typ_horaire_opt1_h1', $typ_horaire_opt1_h1);
					$stmt->bindParam(':typ_horaire_opt1_h2', $typ_horaire_opt1_h2);
					$stmt->bindParam(':ent_lieustage', $ent_lieustage);
					$stmt->bindParam(':lundimatin', $lundimatin);
					$stmt->bindParam(':pause_dej_h1_lundi', $pause_dej_h1_lundi);
					$stmt->bindParam(':pause_dej_h2_lundi', $pause_dej_h2_lundi);
					$stmt->bindParam(':lundiaprem', $lundiaprem);
					$stmt->bindParam(':mardimatin', $mardimatin);
					$stmt->bindParam(':pause_dej_h1_mardi', $pause_dej_h1_mardi);
					$stmt->bindParam(':pause_dej_h2_mardi', $pause_dej_h2_mardi);
					$stmt->bindParam(':mardiaprem', $mardiaprem);
					$stmt->bindParam(':mercredimatin', $mercredimatin);
					$stmt->bindParam(':pause_dej_h1_mercredi', $pause_dej_h1_mercredi);
					$stmt->bindParam(':pause_dej_h2_mercredi', $pause_dej_h2_mercredi);
					$stmt->bindParam(':mercrediaprem', $mercrediaprem);
					$stmt->bindParam(':jeudimatin', $jeudimatin);
					$stmt->bindParam(':pause_dej_h1_jeudi', $pause_dej_h1_jeudi);
					$stmt->bindParam(':pause_dej_h2_jeudi', $pause_dej_h2_jeudi);
					$stmt->bindParam(':jeudiaprem', $jeudiaprem);
					$stmt->bindParam(':vendredimatin', $vendredimatin);
					$stmt->bindParam(':pause_dej_h1_vendredi', $pause_dej_h1_vendredi);
					$stmt->bindParam(':pause_dej_h2_vendredi', $pause_dej_h2_vendredi);
					$stmt->bindParam(':vendrediaprem', $vendrediaprem);
					$stmt->bindParam(':samedimatin', $samedimatin);
					$stmt->bindParam(':pause_dej_h1_samedi', $pause_dej_h1_samedi);
					$stmt->bindParam(':pause_dej_h2_samedi', $pause_dej_h2_samedi);
					$stmt->bindParam(':samediaprem', $samediaprem);
					$stmt->bindParam(':horairejour', $horairejour);
					$stmt->bindParam(':horaireweek', $horaireweek);
					$stmt->bindParam(':ent_assurreur', $ent_assurreur);
					$stmt->bindParam(':ent_numcontrat', $ent_numcontrat);
					$stmt->bindParam(':uai_assureur', $uai_assureur);
					$stmt->bindParam(':uai_numcontrat', $uai_numcontrat);
					$stmt->execute();
					
					$activetoken = hash('sha512', uniqid(openssl_random_pseudo_bytes(8), TRUE));
                
					$stmt = $conn->prepare("UPDATE eleve SET elv_token3=:token WHERE eleve.elv_id=:elv_id");
					$stmt->bindParam(':token', $activetoken);
					$stmt->bindParam(':elv_id', $elv_id);
					$stmt->execute();
					$stmt->closeCursor();
					
					
					store_signature($cand_id);
					
					$url = get_template_directory_uri() . "/actiondev1.php?act=seconnecterurlelv&token=".$activetoken."&redirect=convention";
						
					//message-validation-envoyé
					$to = $elv_mail;
					$subject = 'Votre candidature a été accepté';

					$message = "Bonjour,<br>Veuillez trouver ci-dessous le lien pour accéder à votre compte sur monstage.education.pf.";
					$message .= "<p><a href='" . $url . "'>Accéder à mon compte</a></p>";
					$message .= "<p>Cordialement,</p>";
					$message .= "<p>DGEE - Direction Générale de l'Education et des enseignements</p>";
					$message .= "<p></p><p><i>Ce mail a été envoyé automatiquement via une application, merci de ne pas y répondre</i>.</p>";

					$headers = array('Content-Type: text/html; charset=UTF-8');

					wp_mail($to, $subject, $message, $headers);
				
				}
				
				
				

                $conn = null;

            } else
                $err = "connerr";
     
        return $err;

    } catch
    (PDOException $e) {
        $err = $e;
        $conn = null;
        return $err;
    }
}


function store_signature($cand_id){
	
	 date_default_timezone_set('Pacific/Tahiti'); //Définir le fuseau horaire de tahiti pour l'affichage des dates
    setlocale (LC_TIME, 'fr_FR.utf8','fra'); 

	ini_set('memory_limit', '2048M');
	ini_set('max_execution_time', '300');
	ini_set("pcre.backtrack_limit", "3000000");
	
		$tabcand=recData("candidature",$cand_id);
		$elv_id=$tabcand["elv_id"];
		$stage_id=$tabcand["stage_id"];
		$tabstage=recData("stage",$stage_id);
		$tabeleve=recData("eleve",$elv_id);
		$type=$tabstage["type_id"];
		$tabconvention=recData("convention",array($cand_id,$elv_id));
		
		 // récupération du contenu HTML
		ob_start();
		
		switch($tabstage["type_id"]){
			case "1":
				include("model/signature-3eme.php");
			break;
			case "2":
				include("model/signature-pfmp.php");
			break;
			case "3":
				include("model/signature-bts.php");
			break;
		}
		//include("model/test2.php");
				
		$content = ob_get_clean();
		//echo $content;
		ob_end_clean();

		// conversion HTML => PDF
		require_once 'assets/mpdf/vendor/autoload.php';
			
			
			
		$ort = "A4-P";
		$sfont = "12";
				
				
		try{		
			
				$prm = ['format' => $ort,
					'default_font' => 'Times New Roman',
					'default_font_size' => $sfont,
					'margin_left' => 10,
					'margin_right' => 10,
					'margin_top' => 5,
					'margin_bottom' => 5,
					'margin_header' => 0,
					'margin_footer' => 0,
					'tempDir' => __DIR__ . '/tmp'];
			
			
			
			$urlout = $_SERVER['DOCUMENT_ROOT']."/wp-content/uploads/signature/".$tabconvention["reference"].".pdf";
			
			$mpdf = new \Mpdf\Mpdf($prm);
			$mpdf->allow_charset_conversion = true;
			$mpdf->charset_in = 'utf8';
			$mpdf->WriteHTML($content);
			$mpdf->Output($urlout,'F');
			
		}
		catch(\Mpdf\MpdfException $e) {
			echo $e->getMessage();
			exit;
		}
		
		
		 
}



//********************************************************************
// Fonction : refuscand
//********************************************************************
function refuscand($tab)   //form connexion compte elv
{
    try {

        //initialisation du message d'erreur
        $err = "";

       
            //Connexion à la base de données
            $conn = ConnBDDpdo();

            if (!session_id()) {
                session_start();
            }
			
			$cand_id=decryptIt($tab['chpidrefus'],$_SESSION["hashsession"]);
			
			
			if (!empty($conn)) {
				
				$stmt = $conn->prepare("SELECT candidature.*, eleve.elv_mail, stage.type_id FROM candidature left join stage on stage.stage_id=candidature.stage_id left join eleve on eleve.elv_id=candidature.elv_id WHERE candidature.cand_id=:cand_id");
				$stmt->bindParam(':cand_id', $cand_id);
				$stmt->execute();
				$res = $stmt->fetch(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				
				$elv_id=$res["elv_id"];
				$elv_mail=$res["elv_mail"];
				$type_id=$res["type_id"];
				
               	$stmt = $conn->prepare("UPDATE candidature SET statut=4 WHERE candidature.cand_id=:cand_id");
				$stmt->bindParam(':cand_id', $cand_id);
				$stmt->execute();
				$stmt->closeCursor();

				$stmt = $conn->prepare("SELECT * FROM convention WHERE convention.cand_id=:cand_id and convention.elv_id=:elv_id");
				$stmt->bindParam(':cand_id', $cand_id);
				$stmt->bindParam(':elv_id', $elv_id);
				$stmt->execute();
				
				
				if($stmt->rowCount()>0){
					
					$res = $stmt->fetch(PDO::FETCH_ASSOC);
					

					$stmt = $conn->prepare("DELETE FROM convention WHERE convention.cand_id=:cand_id and convention.elv_id=:elv_id");
					$stmt->bindParam(':cand_id', $cand_id);
					$stmt->bindParam(':elv_id', $elv_id);
					$stmt->execute();
					$stmt->closeCursor();
					
					if(file_exists($_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/signature/'.$res["reference"].'.pdf'))unlink($_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/signature/'.$res["reference"].'.pdf');
					if(file_exists($_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/convention/'.$res["reference"].'-1.pdf'))unlink($_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/convention/'.$res["reference"].'-1.pdf');
					if(file_exists($_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/convention/'.$res["reference"].'-2.pdf'))unlink($_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/convention/'.$res["reference"].'-2.pdf');
					if(file_exists($_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/convention/convention-3eme-'.$res["reference"].'.pdf'))unlink($_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/convention/convention-3eme-'.$res["reference"].'.pdf');
					if(file_exists($_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/convention/convention-pfmp-'.$res["reference"].'.pdf'))unlink($_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/convention/convention-pfmp-'.$res["reference"].'.pdf');
					if(file_exists($_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/convention/convention-bts-'.$res["reference"].'.pdf'))unlink($_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/convention/convention-bts-'.$res["reference"].'.pdf');
					
					$activetoken = hash('sha512', uniqid(openssl_random_pseudo_bytes(8), TRUE));
                
					$stmt = $conn->prepare("UPDATE eleve SET elv_token3=:token WHERE eleve.elv_id=:elv_id");
					$stmt->bindParam(':token', $activetoken);
					$stmt->bindParam(':elv_id', $elv_id);
					$stmt->execute();
					$stmt->closeCursor();
					
					
					switch($type_id){
						case "1":
						
							$url = get_template_directory_uri() . "/actiondev1.php?act=seconnecterurlelv&token=".$activetoken."&redirect=3eme";
					
						break;
						case "2":
						
							$url = get_template_directory_uri() . "/actiondev1.php?act=seconnecterurlelv&token=".$activetoken."&redirect=pfmp";
					
						break;
						case "3":
						
							$url = get_template_directory_uri() . "/actiondev1.php?act=seconnecterurlelv&token=".$activetoken."&redirect=bts";
					
						break;
					
					}
					//message-validation-envoyé
					$to = $elv_mail;
					$subject = 'Votre candidature a été refusé';

					$message = "Bonjour,<br>Veuillez trouver ci-dessous le lien pour accéder à votre compte sur monstage.education.pf.";
					$message .= "<p><a href='" . $url . "'>Accéder à mon compte</a></p>";
					$message .= "<p>Cordialement,</p>";
					$message .= "<p>DGEE - Direction Générale de l'Education et des enseignements</p>";
					$message .= "<p></p><p><i>Ce mail a été envoyé automatiquement via une application, merci de ne pas y répondre</i>.</p>";

					$headers = array('Content-Type: text/html; charset=UTF-8');

					wp_mail($to, $subject, $message, $headers);
					
				}	

				$stmt->closeCursor();				
				

                $conn = null;

            } else
                $err = "connerr";
     
        return $err;

    } catch
    (PDOException $e) {
        $err = $e;
        $conn = null;
        return $err;
    }
}





//********************************************************************
// Fonction : modifconv
//********************************************************************
function modifconv($tab,$files)   //form connexion compte elv
{
    try {

        //initialisation du message d'erreur
        $err = "";

       
            //Connexion à la base de données
            $conn = ConnBDDpdo();

            if (!session_id()) {
                session_start();
            }
			
			$cand_id=decryptIt($tab['candid'],$_SESSION["hashsession"]);
			
			if (!empty($conn)) {
				
				$stmt = $conn->prepare("SELECT candidature.*,stage.ent_id,eleve.elv_uai,uai.uai_logo FROM candidature left join stage on stage.stage_id=candidature.stage_id left join eleve on eleve.elv_id=candidature.elv_id left join uai on eleve.elv_uai=uai.uai_rne WHERE candidature.cand_id=:cand_id");
				$stmt->bindParam(':cand_id', $cand_id);
				$stmt->execute();
				$res = $stmt->fetch(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				
				$elv_id=$res["elv_id"];
				$ent_id=$res["ent_id"];
				$uai_rne=$res["elv_uai"];
				$uai_logo=$res["uai_logo"];
				
				$stmt = $conn->prepare("SELECT COUNT(*) as NB FROM convention WHERE convention.cand_id=:cand_id and convention.elv_id=:elv_id");
				$stmt->bindParam(':cand_id', $cand_id);
				$stmt->bindParam(':elv_id', $elv_id);
				$stmt->execute();
				$res = $stmt->fetch(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				
				
				
				if($res["NB"]>0){
					
					
					if(lgchkelv()){
						
						$elv_diplome =null;if(!empty($tab['elv_diplome']))$elv_diplome = stripslashes(filter_var($tab['elv_diplome'], FILTER_SANITIZE_STRING));
						$elv_nom =null;if(!empty($tab['elv_nom']))$elv_nom = stripslashes(filter_var($tab['elv_nom'], FILTER_SANITIZE_STRING));
						$elv_pren =null;if(!empty($tab['elv_pren']))$elv_pren = stripslashes(filter_var($tab['elv_pren'], FILTER_SANITIZE_STRING));
						$elv_datenaiss =null;if(!empty($tab['elv_datenaiss']))$elv_datenaiss = fDate($tab['elv_datenaiss'], "sql");
						$elv_adr =null;if(!empty($tab['elv_adr']))$elv_adr = stripslashes(filter_var($tab['elv_adr'], FILTER_SANITIZE_STRING));
						$elv_tel =null;if(!empty($tab['elv_tel']))$elv_tel = stripslashes(filter_var($tab['elv_tel'], FILTER_SANITIZE_STRING));
						$elv_mail =null;if(!empty($tab['elv_mail']))$elv_mail = stripslashes(filter_var($tab['elv_mail'], FILTER_SANITIZE_STRING));
						
						$stmt = $conn->prepare("UPDATE convention SET elv_diplome=:elv_diplome,elv_nom=:elv_nom,elv_pren=:elv_pren,elv_datenaiss=:elv_datenaiss,elv_adr=:elv_adr,elv_tel=:elv_tel,elv_mail=:elv_mail WHERE convention.cand_id=:cand_id and convention.elv_id=:elv_id");
						$stmt->bindParam(':elv_diplome', $elv_diplome);
						$stmt->bindParam(':elv_nom', $elv_nom);
						$stmt->bindParam(':elv_pren', $elv_pren);
						$stmt->bindParam(':elv_datenaiss', $elv_datenaiss);
						$stmt->bindParam(':elv_adr', $elv_adr);
						$stmt->bindParam(':elv_tel', $elv_tel);
						$stmt->bindParam(':elv_mail', $elv_mail);
						$stmt->bindParam(':cand_id', $cand_id);
						$stmt->bindParam(':elv_id', $elv_id);
						$stmt->execute();
						$stmt->closeCursor();
						
						
						
						$stmt = $conn->prepare("UPDATE eleve SET elv_diplome=:elv_diplome WHERE eleve.elv_id=:elv_id");
						$stmt->bindParam(':elv_diplome', $elv_diplome);
						$stmt->bindParam(':elv_id', $elv_id);
						$stmt->execute();
						$stmt->closeCursor();
						
						if(file_exists($files['uai_logo']['tmp_name']) && is_uploaded_file($files['uai_logo']['tmp_name'])){
					 
					
							$nom = hash('sha512', uniqid(openssl_random_pseudo_bytes(8), TRUE));
							
							$infosfichier = pathinfo($files['uai_logo']['name']);
							$extension_upload = $infosfichier['extension'];
							
							$nom_img=$nom.'.'.$extension_upload;
							
							if(in_array($extension_upload,array("png","jpeg","gif","jpg"))){
								
								if(move_uploaded_file($files['uai_logo']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/logouai/'. $nom_img)){
									
									if($uai_logo!=null and file_exists($_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/logouai/'.$uai_logo))unlink($_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/logouai/'.$uai_logo);
								
								
									$chemin=$nom_img;
									$stmt = $conn->prepare("UPDATE uai SET uai_logo=:chemin WHERE uai.uai_rne=:uai_rne");
									$stmt->bindParam(':chemin', $chemin);
									$stmt->bindParam(':uai_rne', $uai_rne);			
									$stmt->execute();
									$stmt->closeCursor();
									
								}
							
							}
						}
						
					}else if(lgchkpeda()){
						
						$elv_diplome =null;if(!empty($tab['elv_diplome']))$elv_diplome = stripslashes(filter_var($tab['elv_diplome'], FILTER_SANITIZE_STRING));
						$uai_adr =null;if(!empty($tab['uai_adr']))$uai_adr = stripslashes(filter_var($tab['uai_adr'], FILTER_SANITIZE_STRING));
						$uai_tel =null;if(!empty($tab['uai_tel']))$uai_tel = stripslashes(filter_var($tab['uai_tel'], FILTER_SANITIZE_STRING));
						$uai_delib =null;if(!empty($tab['uai_delib']))$uai_delib = stripslashes(filter_var($tab['uai_delib'], FILTER_SANITIZE_STRING));
						$uai_copier =null;if(!empty($tab['uai_copier']))$uai_copier = stripslashes(filter_var($tab['uai_copier'], FILTER_SANITIZE_STRING));
						$uai_represant =null;if(!empty($tab['uai_represant']))$uai_represant = stripslashes(filter_var($tab['uai_represant'], FILTER_SANITIZE_STRING));
						$uai_mail =null;if(!empty($tab['uai_mail']))$uai_mail = stripslashes(filter_var($tab['uai_mail'], FILTER_SANITIZE_STRING));
						$referent_nom =null;if(!empty($tab['referent_nom']))$referent_nom = stripslashes(filter_var($tab['referent_nom'], FILTER_SANITIZE_STRING));
						$referent_tel =null;if(!empty($tab['referent_tel']))$referent_tel = stripslashes(filter_var($tab['referent_tel'], FILTER_SANITIZE_STRING));
						$referent_mail =null;if(!empty($tab['referent_mail']))$referent_mail = stripslashes(filter_var($tab['referent_mail'], FILTER_SANITIZE_STRING));
						$elv_nom =null;if(!empty($tab['elv_nom']))$elv_nom = stripslashes(filter_var($tab['elv_nom'], FILTER_SANITIZE_STRING));
						$elv_pren =null;if(!empty($tab['elv_pren']))$elv_pren = stripslashes(filter_var($tab['elv_pren'], FILTER_SANITIZE_STRING));
						$elv_datenaiss =null;if(!empty($tab['elv_datenaiss']))$elv_datenaiss = fDate($tab['elv_datenaiss'], "sql");
						$elv_adr =null;if(!empty($tab['elv_adr']))$elv_adr = stripslashes(filter_var($tab['elv_adr'], FILTER_SANITIZE_STRING));
						$elv_tel =null;if(!empty($tab['elv_tel']))$elv_tel = stripslashes(filter_var($tab['elv_tel'], FILTER_SANITIZE_STRING));
						$elv_mail =null;if(!empty($tab['elv_mail']))$elv_mail = stripslashes(filter_var($tab['elv_mail'], FILTER_SANITIZE_STRING));
						
						$elv_nom2 =null;if(!empty($tab['elv_nom2']))$elv_nom2 = stripslashes(filter_var($tab['elv_nom2'], FILTER_SANITIZE_STRING));
						$elv_pren2 =null;if(!empty($tab['elv_pren2']))$elv_pren2 = stripslashes(filter_var($tab['elv_pren2'], FILTER_SANITIZE_STRING));
						$elv_class =null;if(!empty($tab['elv_class']))$elv_class = stripslashes(filter_var($tab['elv_class'], FILTER_SANITIZE_STRING));
						$elv_diplome2 =null;if(!empty($tab['elv_diplome2']))$elv_diplome2 = stripslashes(filter_var($tab['elv_diplome2'], FILTER_SANITIZE_STRING));
						$referent_nom2 =null;if(!empty($tab['referent_nom2']))$referent_nom2 = stripslashes(filter_var($tab['referent_nom2'], FILTER_SANITIZE_STRING));
						$date_stage =null;if(!empty($tab['date_stage']))$date_stage = stripslashes(filter_var($tab['date_stage'], FILTER_SANITIZE_STRING));
						$typ_horaire_opt1_h1 =null;if(!empty($tab['typ_horaire_opt1_h1']))$typ_horaire_opt1_h1 = stripslashes(filter_var($tab['typ_horaire_opt1_h1'], FILTER_SANITIZE_STRING));
						$typ_horaire_opt1_h2 =null;if(!empty($tab['typ_horaire_opt1_h2']))$typ_horaire_opt1_h2 = stripslashes(filter_var($tab['typ_horaire_opt1_h2'], FILTER_SANITIZE_STRING));
						$ent_lieustage =null;if(!empty($tab['ent_lieustage']))$ent_lieustage = stripslashes(filter_var($tab['ent_lieustage'], FILTER_SANITIZE_STRING));
						$uai_assureur =null;if(!empty($tab['uai_assureur']))$uai_assureur = stripslashes(filter_var($tab['uai_assureur'], FILTER_SANITIZE_STRING));
						$uai_numcontrat =null;if(!empty($tab['uai_numcontrat']))$uai_numcontrat = stripslashes(filter_var($tab['uai_numcontrat'], FILTER_SANITIZE_STRING));
						
						$stmt = $conn->prepare("UPDATE convention SET elv_diplome=:elv_diplome,uai_adr=:uai_adr,uai_tel=:uai_tel,uai_delib=:uai_delib,uai_copier=:uai_copier,uai_represant=:uai_represant,uai_mail=:uai_mail,referent_nom=:referent_nom,referent_tel=:referent_tel,referent_mail=:referent_mail,elv_nom=:elv_nom,elv_pren=:elv_pren,elv_datenaiss=:elv_datenaiss,elv_adr=:elv_adr,elv_tel=:elv_tel,elv_mail=:elv_mail,elv_nom2=:elv_nom2,elv_pren2=:elv_pren2,elv_class=:elv_class,elv_diplome2=:elv_diplome2,referent_nom2=:referent_nom2,date_stage=:date_stage, typ_horaire_opt1_h1=:typ_horaire_opt1_h1, typ_horaire_opt1_h2=:typ_horaire_opt1_h2, ent_lieustage=:ent_lieustage, uai_assureur=:uai_assureur,uai_numcontrat=:uai_numcontrat WHERE convention.cand_id=:cand_id and convention.elv_id=:elv_id");
						$stmt->bindParam(':elv_diplome', $elv_diplome);
						$stmt->bindParam(':uai_adr', $uai_adr);
						$stmt->bindParam(':uai_tel', $uai_tel);
						$stmt->bindParam(':uai_delib', $uai_delib);
						$stmt->bindParam(':uai_copier', $uai_copier);
						$stmt->bindParam(':uai_represant', $uai_represant);
						$stmt->bindParam(':uai_mail', $uai_mail);
						$stmt->bindParam(':referent_nom', $referent_nom);
						$stmt->bindParam(':referent_tel', $referent_tel);
						$stmt->bindParam(':referent_mail', $referent_mail);
						$stmt->bindParam(':elv_nom', $elv_nom);
						$stmt->bindParam(':elv_pren', $elv_pren);
						$stmt->bindParam(':elv_datenaiss', $elv_datenaiss);
						$stmt->bindParam(':elv_adr', $elv_adr);
						$stmt->bindParam(':elv_tel', $elv_tel);
						$stmt->bindParam(':elv_mail', $elv_mail);
						$stmt->bindParam(':elv_nom2', $elv_nom2);
						$stmt->bindParam(':elv_pren2', $elv_pren2);
						$stmt->bindParam(':elv_class', $elv_class);
						$stmt->bindParam(':elv_diplome2', $elv_diplome2);
						$stmt->bindParam(':referent_nom2', $referent_nom2);
						$stmt->bindParam(':date_stage', $date_stage);
						$stmt->bindParam(':typ_horaire_opt1_h1', $typ_horaire_opt1_h1);
						$stmt->bindParam(':typ_horaire_opt1_h2', $typ_horaire_opt1_h2);
						$stmt->bindParam(':ent_lieustage', $ent_lieustage);
						$stmt->bindParam(':uai_assureur', $uai_assureur);
						$stmt->bindParam(':uai_numcontrat', $uai_numcontrat);
						
						
						$stmt->bindParam(':cand_id', $cand_id);
						$stmt->bindParam(':elv_id', $elv_id);
						$stmt->execute();
						$stmt->closeCursor();
						
						
						
						$stmt = $conn->prepare("UPDATE eleve SET elv_diplome=:elv_diplome WHERE eleve.elv_id=:elv_id");
						$stmt->bindParam(':elv_diplome', $elv_diplome);
						
						$stmt->bindParam(':elv_id', $elv_id);
						$stmt->execute();
						$stmt->closeCursor();
						
						$stmt = $conn->prepare("UPDATE uai SET uai_adr=:uai_adr,uai_tel=:uai_tel,uai_delib=:uai_delib,uai_copier=:uai_copier,uai_represant=:uai_represant,uai_mail=:uai_mail,uai_assureur=:uai_assureur,uai_numcontrat=:uai_numcontrat WHERE uai.uai_rne=:uai_rne");
						$stmt->bindParam(':uai_adr', $uai_adr);
						$stmt->bindParam(':uai_tel', $uai_tel);
						$stmt->bindParam(':uai_delib', $uai_delib);
						$stmt->bindParam(':uai_copier', $uai_copier);
						$stmt->bindParam(':uai_represant', $uai_represant);
						$stmt->bindParam(':uai_mail', $uai_mail);
						$stmt->bindParam(':uai_assureur', $uai_assureur);
						$stmt->bindParam(':uai_numcontrat', $uai_numcontrat);
						$stmt->bindParam(':uai_rne', $uai_rne);
						$stmt->execute();
						$stmt->closeCursor();
						
						
						if(file_exists($files['uai_logo']['tmp_name']) && is_uploaded_file($files['uai_logo']['tmp_name'])){
					 
					
							$nom = hash('sha512', uniqid(openssl_random_pseudo_bytes(8), TRUE));
							
							$infosfichier = pathinfo($files['uai_logo']['name']);
							$extension_upload = $infosfichier['extension'];
							
							$nom_img=$nom.'.'.$extension_upload;
							
							if(in_array($extension_upload,array("png","jpeg","gif","jpg"))){
								
								if(move_uploaded_file($files['uai_logo']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/logouai/'. $nom_img)){
									
									if($uai_logo!=null and file_exists($_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/logouai/'.$uai_logo))unlink($_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/logouai/'.$uai_logo);
								
								
									$chemin=$nom_img;
									$stmt = $conn->prepare("UPDATE uai SET uai_logo=:chemin WHERE uai.uai_rne=:uai_rne");
									$stmt->bindParam(':chemin', $chemin);
									$stmt->bindParam(':uai_rne', $uai_rne);			
									$stmt->execute();
									$stmt->closeCursor();
									
								}
							
							}
						}
						
					}else{
						
						$ent_nom =null;if(!empty($tab['ent_nom']))$ent_nom = stripslashes(filter_var($tab['ent_nom'], FILTER_SANITIZE_STRING));
						$ent_adr =null;if(!empty($tab['ent_adr']))$ent_adr = stripslashes(filter_var($tab['ent_adr'], FILTER_SANITIZE_STRING));
						$ent_domaine =null;if(!empty($tab['ent_domaine']))$ent_domaine = $tab['ent_domaine'];
						$ent_tel =null;if(!empty($tab['ent_tel']))$ent_tel = stripslashes(filter_var($tab['ent_tel'], FILTER_SANITIZE_STRING));
						$ent_copier =null;if(!empty($tab['ent_copier']))$ent_copier = stripslashes(filter_var($tab['ent_copier'], FILTER_SANITIZE_STRING));
						$ent_numtahiti =null;if(!empty($tab['ent_numtahiti']))$ent_numtahiti = stripslashes(filter_var($tab['ent_numtahiti'], FILTER_SANITIZE_STRING));
						$ent_represant =null;if(!empty($tab['ent_represant']))$ent_represant = stripslashes(filter_var($tab['ent_represant'], FILTER_SANITIZE_STRING));
						$ent_represant_funct =null;if(!empty($tab['ent_represant_funct']))$ent_represant_funct = stripslashes(filter_var($tab['ent_represant_funct'], FILTER_SANITIZE_STRING));
						$ent_represant_mail =null;if(!empty($tab['ent_represant_mail']))$ent_represant_mail = stripslashes(filter_var($tab['ent_represant_mail'], FILTER_SANITIZE_STRING));
						
						$ent_tuteur =null;if(!empty($tab['ent_tuteur']))$ent_tuteur = stripslashes(filter_var($tab['ent_tuteur'], FILTER_SANITIZE_STRING));
						$ent_tuteur_funct =null;if(!empty($tab['ent_tuteur_funct']))$ent_tuteur_funct = stripslashes(filter_var($tab['ent_tuteur_funct'], FILTER_SANITIZE_STRING));
						$ent_tuteur_mail =null;if(!empty($tab['ent_tuteur_mail']))$ent_tuteur_mail = stripslashes(filter_var($tab['ent_tuteur_mail'], FILTER_SANITIZE_STRING));
						$ent_tuteur_tel =null;if(!empty($tab['ent_tuteur_tel']))$ent_tuteur_tel = stripslashes(filter_var($tab['ent_tuteur_tel'], FILTER_SANITIZE_STRING));
						
						$ent_mail =null;if(!empty($tab['ent_mail']))$ent_mail = stripslashes(filter_var($tab['ent_mail'], FILTER_SANITIZE_STRING));
						$horairejour =null;if(!empty($tab['horairejour']))$horairejour = stripslashes(filter_var($tab['horairejour'], FILTER_SANITIZE_STRING));
						$horaireweek =null;if(!empty($tab['horaireweek']))$horaireweek = stripslashes(filter_var($tab['horaireweek'], FILTER_SANITIZE_STRING));
						
						$lundimatin =null;if(!empty($tab['lundimatin']))$lundimatin = stripslashes(filter_var($tab['lundimatin'], FILTER_SANITIZE_STRING));
						$pause_dej_h1_lundi =null;if(!empty($tab['pause_dej_h1_lundi']))$pause_dej_h1_lundi = stripslashes(filter_var($tab['pause_dej_h1_lundi'], FILTER_SANITIZE_STRING));
						$pause_dej_h2_lundi =null;if(!empty($tab['pause_dej_h2_lundi']))$pause_dej_h2_lundi = stripslashes(filter_var($tab['pause_dej_h2_lundi'], FILTER_SANITIZE_STRING));
						$lundiaprem =null;if(!empty($tab['lundiaprem']))$lundiaprem = stripslashes(filter_var($tab['lundiaprem'], FILTER_SANITIZE_STRING));
						
						$mardimatin =null;if(!empty($tab['mardimatin']))$mardimatin = stripslashes(filter_var($tab['mardimatin'], FILTER_SANITIZE_STRING));
						$pause_dej_h1_mardi =null;if(!empty($tab['pause_dej_h1_mardi']))$pause_dej_h1_mardi = stripslashes(filter_var($tab['pause_dej_h1_mardi'], FILTER_SANITIZE_STRING));
						$pause_dej_h2_mardi =null;if(!empty($tab['pause_dej_h2_mardi']))$pause_dej_h2_mardi = stripslashes(filter_var($tab['pause_dej_h2_mardi'], FILTER_SANITIZE_STRING));
						$mardiaprem =null;if(!empty($tab['mardiaprem']))$mardiaprem = stripslashes(filter_var($tab['mardiaprem'], FILTER_SANITIZE_STRING));
						
						$mercredimatin =null;if(!empty($tab['mercredimatin']))$mercredimatin = stripslashes(filter_var($tab['mercredimatin'], FILTER_SANITIZE_STRING));
						$pause_dej_h1_mercredi =null;if(!empty($tab['pause_dej_h1_mercredi']))$pause_dej_h1_mercredi = stripslashes(filter_var($tab['pause_dej_h1_mercredi'], FILTER_SANITIZE_STRING));
						$pause_dej_h2_mercredi =null;if(!empty($tab['pause_dej_h2_mercredi']))$pause_dej_h2_mercredi = stripslashes(filter_var($tab['pause_dej_h2_mercredi'], FILTER_SANITIZE_STRING));
						$mercrediaprem =null;if(!empty($tab['mercrediaprem']))$mercrediaprem = stripslashes(filter_var($tab['mercrediaprem'], FILTER_SANITIZE_STRING));
						
						$jeudimatin =null;if(!empty($tab['jeudimatin']))$jeudimatin = stripslashes(filter_var($tab['jeudimatin'], FILTER_SANITIZE_STRING));
						$pause_dej_h1_jeudi =null;if(!empty($tab['pause_dej_h1_jeudi']))$pause_dej_h1_jeudi = stripslashes(filter_var($tab['pause_dej_h1_jeudi'], FILTER_SANITIZE_STRING));
						$pause_dej_h2_jeudi =null;if(!empty($tab['pause_dej_h2_jeudi']))$pause_dej_h2_jeudi = stripslashes(filter_var($tab['pause_dej_h2_jeudi'], FILTER_SANITIZE_STRING));
						$jeudiaprem =null;if(!empty($tab['jeudiaprem']))$jeudiaprem = stripslashes(filter_var($tab['jeudiaprem'], FILTER_SANITIZE_STRING));
						
						$vendredimatin =null;if(!empty($tab['vendredimatin']))$vendredimatin = stripslashes(filter_var($tab['vendredimatin'], FILTER_SANITIZE_STRING));
						$pause_dej_h1_vendredi =null;if(!empty($tab['pause_dej_h1_vendredi']))$pause_dej_h1_vendredi = stripslashes(filter_var($tab['pause_dej_h1_vendredi'], FILTER_SANITIZE_STRING));
						$pause_dej_h2_vendredi =null;if(!empty($tab['pause_dej_h2_vendredi']))$pause_dej_h2_vendredi = stripslashes(filter_var($tab['pause_dej_h2_vendredi'], FILTER_SANITIZE_STRING));
						$vendrediaprem =null;if(!empty($tab['vendrediaprem']))$vendrediaprem = stripslashes(filter_var($tab['vendrediaprem'], FILTER_SANITIZE_STRING));
						
						$samedimatin =null;if(!empty($tab['samedimatin']))$samedimatin = stripslashes(filter_var($tab['samedimatin'], FILTER_SANITIZE_STRING));
						$pause_dej_h1_samedi =null;if(!empty($tab['pause_dej_h1_samedi']))$pause_dej_h1_samedi = stripslashes(filter_var($tab['pause_dej_h1_samedi'], FILTER_SANITIZE_STRING));
						$pause_dej_h2_samedi =null;if(!empty($tab['pause_dej_h2_samedi']))$pause_dej_h2_samedi = stripslashes(filter_var($tab['pause_dej_h2_samedi'], FILTER_SANITIZE_STRING));
						$samediaprem =null;if(!empty($tab['samediaprem']))$samediaprem = stripslashes(filter_var($tab['samediaprem'], FILTER_SANITIZE_STRING));
						
						$finance_ent =null;if(!empty($tab['finance_ent']))$finance_ent = $tab['finance_ent'];
						$finance_rest1 =null;if(!empty($tab['finance_rest1']))$finance_rest1 = stripslashes(filter_var($tab['finance_rest1'], FILTER_SANITIZE_STRING));
						$finance_rest2 =null;if(!empty($tab['finance_rest2']))$finance_rest2 = stripslashes(filter_var($tab['finance_rest2'], FILTER_SANITIZE_STRING));
						$finance_transp1 =null;if(!empty($tab['finance_transp1']))$finance_transp1 = stripslashes(filter_var($tab['finance_transp1'], FILTER_SANITIZE_STRING));
						$finance_transp2 =null;if(!empty($tab['finance_transp2']))$finance_transp2 = stripslashes(filter_var($tab['finance_transp2'], FILTER_SANITIZE_STRING));
						$finance_heberg1 =null;if(!empty($tab['finance_heberg1']))$finance_heberg1 = stripslashes(filter_var($tab['finance_heberg1'], FILTER_SANITIZE_STRING));
						$finance_heberg2 =null;if(!empty($tab['finance_heberg2']))$finance_heberg2 = stripslashes(filter_var($tab['finance_heberg2'], FILTER_SANITIZE_STRING));
						
						$finance_grat =null;if(!empty($tab['finance_grat']))$finance_grat = stripslashes(filter_var($tab['finance_grat'], FILTER_SANITIZE_STRING));
						$finance_grat_montant =null;if(!empty($tab['finance_grat_montant']))$finance_grat_montant = stripslashes(filter_var($tab['finance_grat_montant'], FILTER_SANITIZE_STRING));
						$finance_versement =null;if(!empty($tab['finance_versement']))$finance_versement = stripslashes(filter_var($tab['finance_versement'], FILTER_SANITIZE_STRING));
						$ent_assurreur =null;if(!empty($tab['ent_assurreur']))$ent_assurreur = stripslashes(filter_var($tab['ent_assurreur'], FILTER_SANITIZE_STRING));
						$ent_numcontrat =null;if(!empty($tab['ent_numcontrat']))$ent_numcontrat = stripslashes(filter_var($tab['ent_numcontrat'], FILTER_SANITIZE_STRING));
						$date_stage =null;if(!empty($tab['date_stage']))$date_stage = stripslashes(filter_var($tab['date_stage'], FILTER_SANITIZE_STRING));
						$typ_horaire_opt1_h1 =null;if(!empty($tab['typ_horaire_opt1_h1']))$typ_horaire_opt1_h1 = stripslashes(filter_var($tab['typ_horaire_opt1_h1'], FILTER_SANITIZE_STRING));
						$typ_horaire_opt1_h2 =null;if(!empty($tab['typ_horaire_opt1_h2']))$typ_horaire_opt1_h2 = stripslashes(filter_var($tab['typ_horaire_opt1_h2'], FILTER_SANITIZE_STRING));
						$ent_lieustage =null;if(!empty($tab['ent_lieustage']))$ent_lieustage = stripslashes(filter_var($tab['ent_lieustage'], FILTER_SANITIZE_STRING));
						
						$stmt = $conn->prepare("UPDATE convention SET ent_lieustage=:ent_lieustage, typ_horaire_opt1_h1=:typ_horaire_opt1_h1, typ_horaire_opt1_h2=:typ_horaire_opt1_h2, date_stage=:date_stage, ent_adr=:ent_adr, ent_nom=:ent_nom,ent_domaine=:ent_domaine,ent_tel=:ent_tel,ent_copier=:ent_copier,ent_numtahiti=:ent_numtahiti,ent_represant=:ent_represant,ent_represant_funct=:ent_represant_funct,ent_represant_mail=:ent_represant_mail, ent_tuteur=:ent_tuteur, ent_tuteur_funct=:ent_tuteur_funct, ent_tuteur_mail=:ent_tuteur_mail, ent_tuteur_tel=:ent_tuteur_tel,    ent_mail=:ent_mail,horairejour=:horairejour,horaireweek=:horaireweek,lundimatin=:lundimatin,pause_dej_h1_lundi=:pause_dej_h1_lundi,pause_dej_h2_lundi=:pause_dej_h2_lundi,lundiaprem=:lundiaprem,mardimatin=:mardimatin,pause_dej_h1_mardi=:pause_dej_h1_mardi,pause_dej_h2_mardi=:pause_dej_h2_mardi,mardiaprem=:mardiaprem,mercredimatin=:mercredimatin,pause_dej_h1_mercredi=:pause_dej_h1_mercredi,pause_dej_h2_mercredi=:pause_dej_h2_mercredi,mercrediaprem=:mercrediaprem,jeudimatin=:jeudimatin,pause_dej_h1_jeudi=:pause_dej_h1_jeudi,pause_dej_h2_jeudi=:pause_dej_h2_jeudi,jeudiaprem=:jeudiaprem,vendredimatin=:vendredimatin,pause_dej_h1_vendredi=:pause_dej_h1_vendredi,pause_dej_h2_vendredi=:pause_dej_h2_vendredi,vendrediaprem=:vendrediaprem,samedimatin=:samedimatin,pause_dej_h1_samedi=:pause_dej_h1_samedi,pause_dej_h2_samedi=:pause_dej_h2_samedi,samediaprem=:samediaprem,finance_ent=:finance_ent,finance_rest1=:finance_rest1,finance_rest2=:finance_rest2,finance_transp1=:finance_transp1,finance_transp2=:finance_transp2,finance_heberg1=:finance_heberg1,finance_heberg2=:finance_heberg2,finance_grat=:finance_grat,finance_grat_montant=:finance_grat_montant,finance_versement=:finance_versement,ent_assurreur=:ent_assurreur,ent_numcontrat=:ent_numcontrat WHERE convention.cand_id=:cand_id and convention.elv_id=:elv_id");
						$stmt->bindParam(':ent_adr', $ent_adr);
						$stmt->bindParam(':ent_nom', $ent_nom);
						$stmt->bindParam(':ent_domaine', $ent_domaine);
						$stmt->bindParam(':ent_tel', $ent_tel);
						$stmt->bindParam(':ent_copier', $ent_copier);
						$stmt->bindParam(':ent_numtahiti', $ent_numtahiti);
						$stmt->bindParam(':ent_represant', $ent_represant);
						$stmt->bindParam(':ent_represant_funct', $ent_represant_funct);
						$stmt->bindParam(':ent_represant_mail', $ent_represant_mail);
						$stmt->bindParam(':ent_tuteur', $ent_tuteur);
						$stmt->bindParam(':ent_tuteur_funct', $ent_tuteur_funct);
						$stmt->bindParam(':ent_tuteur_mail', $ent_tuteur_mail);
						$stmt->bindParam(':ent_tuteur_tel', $ent_tuteur_tel);
						$stmt->bindParam(':ent_mail', $ent_mail);
						$stmt->bindParam(':horairejour', $horairejour);
						$stmt->bindParam(':horaireweek', $horaireweek);
						$stmt->bindParam(':lundimatin', $lundimatin);
						$stmt->bindParam(':pause_dej_h1_lundi', $pause_dej_h1_lundi);
						$stmt->bindParam(':pause_dej_h2_lundi', $pause_dej_h2_lundi);
						$stmt->bindParam(':lundiaprem', $lundiaprem);
						$stmt->bindParam(':mardimatin', $mardimatin);
						$stmt->bindParam(':pause_dej_h1_mardi', $pause_dej_h1_mardi);
						$stmt->bindParam(':pause_dej_h2_mardi', $pause_dej_h2_mardi);
						$stmt->bindParam(':mardiaprem', $mardiaprem);
						$stmt->bindParam(':mercredimatin', $mercredimatin);
						$stmt->bindParam(':pause_dej_h1_mercredi', $pause_dej_h1_mercredi);
						$stmt->bindParam(':pause_dej_h2_mercredi', $pause_dej_h2_mercredi);
						$stmt->bindParam(':mercrediaprem', $mercrediaprem);
						$stmt->bindParam(':jeudimatin', $jeudimatin);
						$stmt->bindParam(':pause_dej_h1_jeudi', $pause_dej_h1_jeudi);
						$stmt->bindParam(':pause_dej_h2_jeudi', $pause_dej_h2_jeudi);
						$stmt->bindParam(':jeudiaprem', $jeudiaprem);
						$stmt->bindParam(':vendredimatin', $vendredimatin);
						$stmt->bindParam(':pause_dej_h1_vendredi', $pause_dej_h1_vendredi);
						$stmt->bindParam(':pause_dej_h2_vendredi', $pause_dej_h2_vendredi);
						$stmt->bindParam(':vendrediaprem', $vendrediaprem);
						$stmt->bindParam(':samedimatin', $samedimatin);
						$stmt->bindParam(':pause_dej_h1_samedi', $pause_dej_h1_samedi);
						$stmt->bindParam(':pause_dej_h2_samedi', $pause_dej_h2_samedi);
						$stmt->bindParam(':samediaprem', $samediaprem);
						$stmt->bindParam(':finance_ent', $finance_ent);
						$stmt->bindParam(':finance_rest1', $finance_rest1);
						$stmt->bindParam(':finance_rest2', $finance_rest2);
						$stmt->bindParam(':finance_transp1', $finance_transp1);
						$stmt->bindParam(':finance_transp2', $finance_transp2);
						$stmt->bindParam(':finance_heberg1', $finance_heberg1);
						$stmt->bindParam(':finance_heberg2', $finance_heberg2);
						$stmt->bindParam(':finance_grat', $finance_grat);
						$stmt->bindParam(':finance_grat_montant', $finance_grat_montant);
						$stmt->bindParam(':finance_versement', $finance_versement);
						$stmt->bindParam(':ent_assurreur', $ent_assurreur);
						$stmt->bindParam(':ent_numcontrat', $ent_numcontrat);
						$stmt->bindParam(':date_stage', $date_stage);
						$stmt->bindParam(':typ_horaire_opt1_h1', $typ_horaire_opt1_h1);
						$stmt->bindParam(':typ_horaire_opt1_h2', $typ_horaire_opt1_h2);
						$stmt->bindParam(':ent_lieustage', $ent_lieustage);
						
						$stmt->bindParam(':cand_id', $cand_id);
						$stmt->bindParam(':elv_id', $elv_id);
						$stmt->execute();
						$stmt->closeCursor();
						
						$stmt = $conn->prepare("UPDATE entreprise SET ent_adr=:ent_adr, ent_domaine=:ent_domaine,ent_tel=:ent_tel, ent_copier=:ent_copier,ent_represant=:ent_represant,ent_represant_funct=:ent_represant_funct, ent_represant_mail=:ent_represant_mail, ent_tuteur=:ent_tuteur, ent_tuteur_funct=:ent_tuteur_funct, ent_tuteur_mail=:ent_tuteur_mail, ent_tuteur_tel=:ent_tuteur_tel, ent_assurreur=:ent_assurreur,ent_numcontrat=:ent_numcontrat WHERE entreprise.ent_id=:ent_id");
						$stmt->bindParam(':ent_adr', $ent_adr);
						$stmt->bindParam(':ent_domaine', $ent_domaine);
						$stmt->bindParam(':ent_tel', $ent_tel);
						$stmt->bindParam(':ent_copier', $ent_copier);
						$stmt->bindParam(':ent_represant', $ent_represant);
						$stmt->bindParam(':ent_represant_funct', $ent_represant_funct);
						$stmt->bindParam(':ent_represant_mail', $ent_represant_mail);
						$stmt->bindParam(':ent_tuteur', $ent_tuteur);
						$stmt->bindParam(':ent_tuteur_funct', $ent_tuteur_funct);
						$stmt->bindParam(':ent_tuteur_mail', $ent_tuteur_mail);
						$stmt->bindParam(':ent_tuteur_tel', $ent_tuteur_tel);
						$stmt->bindParam(':ent_assurreur', $ent_assurreur);
						$stmt->bindParam(':ent_numcontrat', $ent_numcontrat);
						
						$stmt->bindParam(':ent_id', $ent_id);
						$stmt->execute();
						$stmt->closeCursor();
						
						
						$stmt = $conn->prepare("SELECT entreprise.* FROM entreprise WHERE entreprise.ent_id=:ent_id");
						$stmt->bindParam(':ent_id', $ent_id);
						$stmt->execute();
						$res = $stmt->fetch(PDO::FETCH_ASSOC);
						$stmt->closeCursor();
						
						if($res["confirm"]=="1"){
					
							$stmt = $conn->prepare("UPDATE ispf_ent SET domaine_etab=:ent_domaine, tel_etab=:ent_tel, copier_etab=:ent_copier, represant_etab=:ent_represant, represant_funct_etab=:ent_represant_funct, assurreur_etab=:ent_assurreur, numcontrat_etab=:ent_numcontrat WHERE ispf_ent.num_tahiti_etab=:num_tahiti_etab");
							$stmt->bindParam(':ent_domaine', $ent_domaine);
							$stmt->bindParam(':ent_tel', $ent_tel);
							$stmt->bindParam(':ent_copier', $ent_copier);
							$stmt->bindParam(':ent_represant', $ent_represant);
							$stmt->bindParam(':ent_represant_funct', $ent_represant_funct);
							$stmt->bindParam(':ent_assurreur', $ent_assurreur);
							$stmt->bindParam(':ent_numcontrat', $ent_numcontrat);
							$stmt->bindParam(':num_tahiti_etab', $res["ent_numtahiti"]);		
							$stmt->execute();
							$stmt->closeCursor();	
							
						}
						
					}
					
					
				}
				

                $conn = null;

            } else
                $err = "connerr";
     
        return $err;

    } catch
    (PDOException $e) {
        $err = $e;
        $conn = null;
        return $err;
    }
}



?>