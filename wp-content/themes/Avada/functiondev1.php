<?php


//********************************************************************
// Fonction : seconnecterelv
// Paramètre(s): usrlg -- identifiant saisi par l'utilisateur
//               pwd -- Mot de passe saisi par l'utilisateur  
// Description : Sécurisation des variables de sessions
//********************************************************************
function seconnecterelv($tab)   //utilisé dans template_profilelv
{
    try {

        //initialisation du message d'erreur
        $err = "";

        if (isset($tab['useremail'], $tab['userpassword'])) {   //vérifie si les champs useremail et userpassword sont remplis

            // Formatage et validation des donn�es du formulaire
            $usrlog = $tab['useremail'];    //stock la val du chmp useremail dans var $usrlog
            $usrpass = $tab['userpassword'];   //stock la val du chmp userpassword dans var $usrlog

            //Connexion à la base de données
            $conn = ConnBDDpdo();

            if (!session_id()) {
                session_start();
            }

            if (!empty($conn)) {    //vérifie si la connexion à la base de données a été établie avec succès en vérifiant si la variable $conn n'est pas vide

                $stmt = $conn->prepare("SELECT * FROM eleve WHERE elv_mail = :elv_mail");   //req préparée pour select * info du user_lv co//cherche et recup le $usrlog à la bdd
                $stmt->bindParam(':elv_mail', $usrlog); //stock la var $usrlog dans param :elv_mail
                $stmt->execute();
                $res = $stmt->fetch(PDO::FETCH_ASSOC);  //$res va stocker le résultat de l'appel à la méthode fetch()//récupère le résult de la req
                $stmt->closeCursor();   //fermeture de execute//soucis si non-fermé lors de réutilisa° stmt

                if (!empty($res)) { //vérifie si la var $res contient des données
                    //récup les val utiles de ma table elv
                    $usr_id = $res['elv_id'];   //stock la val de bdd->elv->elv_id dans var $res->$usr_id//
                    $usr_mail = $res['elv_mail'];
                    $usr_pwd = $res['elv_password'];
                    $usr_salt = $res['elv_hash']; //var pour reconnaître l'utilisateur
                    $uai_rne = $res['elv_uai']; //uai = établissement//on ne garde que quelques infos num des etab --> rne int
                    $elv_token = $res['elv_token'];
                    $suspend = $res['suspend'];

                    if ($suspend == "0") {

                        $pwd = hash('sha512', $usrpass . $usr_salt);    //hash mon mdp tapé sur mon form ($usrpass) et $usr_salt->hash du user//hash stocké dans var $pwd

                        if ($elv_token == null) {   //vérif si le cmpt enregistré à bien cliqué sur le lien d'activ envoyé par mail//etap réalisé normalement lors de la crea_cmpt

                            if ($usr_pwd == $pwd) { //vérif si password enregistré dans bdd ($usr_pwd) corresponds au mdp tapé ($pwd)//verif que les hash_code->rien en clair

                                close_session(); //fermeture des autres sessions

                                $usr_browser = $_SERVER['HTTP_USER_AGENT']; // Obtention de la chaine user-agent de l'utilisateur.
                                // protection XSS si l'on doit afficher cette valeur
                                $usr_id = preg_replace("/[^0-9]+/", "", $usr_id); //recherche tous les caract != des chiffres dans $usr_id et les remplace par une chaîne vide //nettoyage ou filtrage pour ne conserver que les chiffres dans la var $usr_id.
                                $usr_id = encryptIt($usr_id, $_SESSION["hashsession"]); //appel fonc encryptIT (fonc.php) pour encoder le $usr_id en tant que hashsession
                                $_SESSION['elv_id'] = $usr_id;  //stock var $usr_id dans var $_SESSION['elv_id']// var de SESSION utile pour pouvoir réutiliser cte var dans autres pages_codes
                                $_SESSION['elv_string'] = hash('sha512', $pwd . $usr_browser);  //hash le mdp tapé ($pwd) et la chaine user-agent de l'utilisateur ($usr_browser) //stock dans var $_SESSION['elv_string']
                                $_SESSION['elv_uai'] = $uai_rne;
                                $_SESSION['elv_mail'] = $usr_mail;
                                $_SESSION['user_typ'] = 1;  //var pour diff les typ d'utilisateur (elv ou peda ou ent)// rejoint la fonc lgchk

                                if ($tab["remember"] == "1") {  //se souvenir de moi//si le chmp "remember"(bool) du form est coché

                                    //enregistre les infos de connex dans cookies du site pdt 1an
                                    setcookie("pseudocookieelv", $usr_mail, time() + 365 * 24 * 3600, "/", null, false, true);
                                    setcookie("passwordcookieelv", $usr_pwd, time() + 365 * 24 * 3600, "/", null, false, true);

                                }

                            } else {    //sinon//si le mdp tapé ne corresponds pas au mdp du cmpt_elv

                                $err = "errpassword";

                            }

                        } else {  //sinon//si le lien d'activ du cmpt_elv n'as pas été "cliqué"

                            $err = "errtoken";

                        }
                    } else {

                        $err = "errsuspens";

                    }

                } else
                    $err = "errpassword";

                $conn = null;

            } else
                $err = "connerr";
        } else  //sinon//si le login et le mdp
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
// Description : Check si c'est un élève
//********************************************************************
function lgchkelv()
{
    // Vérifie si les variables de sessions sont remplies
    if (isset($_SESSION['elv_string'])) //verif si sessi elv ouvert
        return true;
    else
        return false;
}


//********************************************************************
// Fonction : seconnecterurlelv
// Description : se connecter avec un token
//********************************************************************
function seconnecterurlelv($tab)
{
    try {
        //initialisation du message d'erreur//cette var est repris pour afficher les erreurs possibles qui peuvent arriver
        $err = "";
        //connexion � la base de donn�es
        $conn = ConnBDDpdo();   //stock la connexion à la bdd dans var $conn

        if (!empty($conn)) {

            //Ouverture d'une transaction
            //$conn->beginTransaction();

            if (isset($tab['token']) and ($tab['token'] != "" and $tab['token'] != null)) { //si le champ token est rempli

                $activetoken = $tab['token'];  //stock sa val dans var $activetoken

                $stmt = $conn->prepare("SELECT * FROM eleve WHERE eleve.elv_token3 = :elv_token"); //req sql qui verif le token_elv où $activetoken est semblable
                $stmt->bindParam(':elv_token', $activetoken);
                $stmt->execute();


                if ($stmt->rowCount() > 0) {    //si la req à réussi

                    $res = $stmt->fetch(PDO::FETCH_ASSOC);   //pour recup info dans bdd
                    // Modification (UPDATE) de l'utilisateur dans la BDD
                    $stmt = $conn->prepare("UPDATE eleve SET elv_token=null WHERE eleve.elv_id=:elv_id and eleve.elv_token = :activetoken");//le chmp elv_token = NULL quand l'elv_user click sur le lien d'activ
                    $stmt->bindParam(':activetoken', $activetoken); //stock la var $activetoken dans param :activetoken
                    $stmt->bindParam(':elv_id', $res['elv_id']);    //stock la reponse de bb du chhmp elv_id dans param :elv_id
                    $stmt->execute();

                    $stmt->closeCursor();

                    //recup les info_elv dans bdd
                    $usr_id = $res['elv_id'];    //stock la reponse de bb du chhmp elv_id dans var $usr_id
                    $usr_mail = $res['elv_mail'];
                    $usr_pwd = $res['elv_password'];
                    $usr_salt = $res['elv_hash'];
                    $uai_rne = $res['elv_uai'];

                    $suspend = $res['suspend'];

                    if ($suspend == "0") {
                        //ferme toutes les autres sessions actives
                        close_session();

                        $usr_browser = $_SERVER['HTTP_USER_AGENT']; // Obtention de la chaine user-agent de l'utilisateur.
                        $usr_id = preg_replace("/[^0-9]+/", "", $usr_id); // protection XSS si l'on doit afficher cette valeur
                        $usr_id = encryptIt($usr_id, $_SESSION["hashsession"]);     //$encrypt la SESSION activ dans var $usr_id
                        $_SESSION['elv_id'] = $usr_id;
                        $_SESSION['elv_string'] = hash('sha512', $pwd . $usr_browser);  //hash le mdp tapé avec la chaine user-agent de l'utilisateur //stock dans var $_SESSION['elv_string']
                        $_SESSION['elv_uai'] = $uai_rne;
                        $_SESSION['elv_mail'] = $usr_mail;
                        $_SESSION['user_typ'] = 1;

                    } else {

                        $err = "errsuspens";

                    }

                } else {  //sinon //si le token d'activ n'est pas le bon
                    $err = "errortoken";
                }

                $conn = null;   //fermeture de la connexion à la bdd

            } else {    //sinon //si le token d'activ n'as pas été envoyé
                $err = "noactivetoken";
            }

        } else  //sinon //si la connexion à la bb à échoué
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
// Fonction : registerelv
// Paramètre(s): usrlg -- identifiant saisi par l'utilisateur
//               pwd -- Mot de passe saisi par l'utilisateur  
// Description : Création d'un compte élève
//********************************************************************
function registerelv($tab) //form-crea-elv

{

    try {
        //Connexion à la base de données
        $conn = ConnBDDpdo();

        if (!session_id()) {
            session_start();
        }
        //initialisation du message d'erreur
        $err = "";              //var en cas d'erreur

        if (!empty($conn)) {    //vérifie si la connexion à la base de données a été établie avec succès en vérifiant si la variable $conn n'est pas vide

            if (isset($tab['useremailcrea'], $tab['usercommune'], $tab['usernom'], $tab['userprenom'], $tab['userdatenais'], $tab['password1'])) { //si les champs de mon formulaire sont remplis; alors..
                // Formatage et validation des donn�es du formulaire
                $usrmail = filter_var($tab['useremailcrea'], FILTER_VALIDATE_EMAIL);    //filtre champs maiil
                $usrmail = filter_var($usrmail, FILTER_VALIDATE_EMAIL);
                $usrcommune = $tab['usercommune'];    //stock mes valeurs de champs_form dans des variables
                $usrnom = stripslashes((filter_var($tab['usernom'], FILTER_SANITIZE_STRING)));
                $usrnom = ucfirst($usrnom);                                   //mets en maj la 1e lettre
                $usrprenom = stripslashes((filter_var($tab['userprenom'], FILTER_SANITIZE_STRING)));
                $usrprenom = ucfirst(strtolower($usrprenom));   //mets en maj la 1e lettre et verif aucun autre maj
                $usrdatenaiss = stripslashes((filter_var($tab['userdatenais'], FILTER_SANITIZE_STRING)));
                $usrmdp = stripslashes((filter_var($tab['password1'], FILTER_SANITIZE_STRING)));
                $usersexe = $tab['usersexe'];
                $useretab = $tab['useretab'];
                $userclass = $tab['userclass'];
                $userdiplome = stripslashes((filter_var($tab['userdiplome'], FILTER_SANITIZE_STRING)));

                if ($tab['password1'] != $tab['password2']) {   //compare les 2 mdp tapés, si non identique = error

                    $err = "errorsame";
                    return $err;
                }

                // Cr�ation d'un SALT al�atoire
                $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
                // Cryptage PHP du mot de passe
                $mdphash = hash('sha512', $usrmdp . $random_salt);  //hash le mdp tapé par le user
                $usrhash = hash('sha512', $usrmail . $random_salt); //hash le mail du user
                $activetoken = hash('sha512', $mdphash . $usrhash); //hash les 2 var déjà hashé = 2*plus de sécu

                //req sql pour insérer les infos dans bdd->table->eleve //diff champs de ma table eleve
                $stmt = $conn->prepare("INSERT INTO eleve (elv_mail, elv_password, elv_hash, elv_token, elv_nom, elv_pren, elv_sexe, elv_com, elv_datenaiss, elv_uai, elv_class, elv_diplome, d_crea) VALUES (:elv_mail, :elv_password, :elv_hash, :elv_token, :elv_nom, :elv_pren, :elv_sexe, :elv_com, :elv_datenaiss, :elv_uai, :elv_class, :elv_diplome, NOW())");
                $stmt->bindParam(':elv_mail', $usrmail);    //stock ma var $usrmail dans un param :elv_mail //param utilisé pour l'insert° dans bdd
                $stmt->bindParam(':elv_password', $mdphash);
                $stmt->bindParam(':elv_hash', $random_salt);     //utilisé pour reconnaître le hash du user
                $stmt->bindParam(':elv_token', $activetoken);    //utilisé pour lien activ cmpt
                $stmt->bindParam(':elv_nom', $usrnom);
                $stmt->bindParam(':elv_pren', $usrprenom);
                $stmt->bindParam(':elv_sexe', $usersexe);    //insér dans bdd comme int car sexe = table nomenclature
                $stmt->bindParam(':elv_uai', $useretab);
                $stmt->bindParam(':elv_class', $userclass);
                $stmt->bindParam(':elv_diplome', $userdiplome);
                $stmt->bindParam(':elv_com', $usrcommune);    //pareil
                $stmt->bindParam(':elv_datenaiss', $usrdatenaiss);
                $stmt->execute();

                //génère le lien de verif
                $url = get_template_directory_uri() . "/actiondev1.php?act=accountactiveelv&token=" . $activetoken;  //appel fonc°accountactiveelv lorsque je clique sur le lien//redirige vers actiondev1
                $_SESSION["urlcrea_elv"] = $url;

                //message-validation-envoyé
                $to = $usrmail; //envoie à $usrmail == mail du user
                $subject = 'Validation de compte sur monstage.education.pf'; //objet du mail
                //msg mail contenu
                $message = "Bonjour,<br>Veuillez trouver ci-dessous le lien pour activer votre compte sur monstage.education.pf.";
                $message .= "<p><a href='" . $url . "'>Activer mon compte</a></p>"; //lien activ
                $message .= "<p>Cordialement,</p>";
                $message .= "<p>DGEE - Direction Générale de l'Education et des enseignements</p>";
                $message .= "<p></p><p><i>Ce mail a été envoyé automatiquement via une application, merci de ne pas y répondre</i>.</p>";

                $headers = array('Content-Type: text/html; charset=UTF-8'); //syntaxe d'écriture du mail//normalement..prends bien en compte tout les caract du clavier

                //envoie de mail normalement ACTIF en localhost
                wp_mail($to, $subject, $message, $headers); //plug wp envoie msg de mail_site --> mail_user($to) avec objet du mail($subject) et le contenu ($message)


                $conn = null; //Fermeture de la connexion
            } else
                $err = "connerr"; // Problème de connexion

            return $err;
        }
    } catch         //fin test co try-catch
    (PDOException $e) {
        $err = $e;
        $conn = null;
        return $err;
    }
}

//********************************************************************
// Fonction : accountactiveelv
// Paramètre(s): usrlg -- identifiant saisi par l'utilisateur
//               pwd -- Mot de passe saisi par l'utilisateur  
// Description : Activation du compte d'un élève
//********************************************************************
function accountactiveelv($tab)
{
    try {
        //initialisation du message d'erreur//cette var est repris pour afficher les erreurs possibles qui peuvent arriver
        $err = "";
        //connexion � la base de donn�es
        $conn = ConnBDDpdo();   //stock la connexion à la bdd dans var $conn

        if (!empty($conn)) {

            //Ouverture d'une transaction
            //$conn->beginTransaction();

            if (isset($tab['token']) and ($tab['token'] != "" and $tab['token'] != null)) {

                $activetoken = $tab['token'];  //stock sa val dans var $activetoken

                $stmt = $conn->prepare("SELECT * FROM eleve WHERE eleve.elv_token = :elv_token"); //req sql qui verif le token_elv où $activetoken est semblable
                $stmt->bindParam(':elv_token', $activetoken);
                $stmt->execute();


                if ($stmt->rowCount() > 0) {    //si il y a bien plusieurs requêtes envoyées

                    $res = $stmt->fetch(PDO::FETCH_ASSOC);   //pour recup info dans bdd
                    // Modification (UPDATE) de l'utilisateur dans la BDD
                    $stmt = $conn->prepare("UPDATE eleve SET elv_token=null WHERE eleve.elv_id=:elv_id and eleve.elv_token = :activetoken");//le chmp elv_token = NULL quand l'elv_user click sur le lien d'activ
                    $stmt->bindParam(':activetoken', $activetoken); //stock la var $activetoken dans param :activetoken
                    $stmt->bindParam(':elv_id', $res['elv_id']);    //stock la reponse de bb du chhmp elv_id dans param :elv_id
                    $stmt->execute();

                    $stmt->closeCursor();

                    //recup les info_elv dans bdd
                    $usr_id = $res['elv_id'];    //stock la reponse de bb du chhmp elv_id dans var $usr_id
                    $usr_mail = $res['elv_mail'];
                    $usr_pwd = $res['elv_password'];
                    $usr_salt = $res['elv_hash'];
                    $uai_rne = $res['elv_uai'];

                    $suspend = $res['suspend'];

                    if ($suspend == "0") {

                        close_session();

                        $usr_browser = $_SERVER['HTTP_USER_AGENT']; // Obtention de la chaine user-agent de l'utilisateur.
                        $usr_id = preg_replace("/[^0-9]+/", "", $usr_id); // protection XSS si l'on doit afficher cette valeur
                        $usr_id = encryptIt($usr_id, $_SESSION["hashsession"]);     //$encrypt la SESSION activ dans var $usr_id
                        $_SESSION['elv_id'] = $usr_id;
                        $_SESSION['elv_string'] = hash('sha512', $pwd . $usr_browser);  //hash le mdp tapé avec la chaine user-agent de l'utilisateur //stock dans var $_SESSION['elv_string']
                        $_SESSION['elv_uai'] = $uai_rne;
                        $_SESSION['elv_mail'] = $usr_mail;
                        $_SESSION['user_typ'] = 1;

                    } else {

                        $err = "errsuspens";

                    }

                } else {  //sinon //si le token d'activ n'est pas le bon
                    $err = "errortoken";
                }

                $conn = null;   //fermeture de la connexion à la bdd

            } else {    //sinon //si le token d'activ n'as pas été envoyé
                $err = "noactivetoken";
            }

        } else  //sinon //si la connexion à la bb à échoué
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
// Fonction : forgetpasswordelv
// Paramètre(s):
// Description : Mail de modification mdp  de l'élève
//********************************************************************
function forgetpasswordelv($tab)    //fonc° en cas d'oubli de mdp
{

    try {
        //initialisation du message d'erreur
        $err = "";
        //connexion � la base de donn�es
        $conn = ConnBDDpdo();

        if (!empty($conn)) {

            if (isset($tab['useremailrecup'])) {    //si le chmp useremailrecup est complété (form_mdp_oulié)

                $stmt = $conn->prepare("SELECT * FROM eleve WHERE eleve.elv_mail = :elv_mail"); //req prépapré//select* dans bdd->eleve les info du mail tapé dans le chmp 'useremailrecup'(form_passforget)
                $stmt->bindParam(':elv_mail', $tab["useremailrecup"]);
                $stmt->execute();


                if ($stmt->rowCount() > 0) {    //verif si le résultat de la req a bien été trouvé

                    $res = $stmt->fetch(PDO::FETCH_ASSOC);  //stock la réponse à la bdd dans $res -> recup info dans bdd


                    $activetoken = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE)); //hash une chaîne de carac aléatoire généré par uniqid(openssl_random_pseudo_bytes(16)

                    $stmt = $conn->prepare("UPDATE eleve SET elv_token2=:activetoken WHERE eleve.elv_id=:elv_id");  //req sql -> modifie dans bdd->eleve->elv_token2 de l'elv concerné
                    $stmt->bindParam(':activetoken', $activetoken);
                    $stmt->bindParam(':elv_id', $res["elv_id"]);    //stock ID elv concerné $res["elv_id"] dans param :elv_id
                    $stmt->execute();

                    $url = get_site_url() . "/reinitialisation-de-votre-mot-de-passe/?token=" . $activetoken;   //génére le lien d'activ //après clique redirige vers page reinitialisation-de-votre-mot-de-passe
                    $_SESSION["urlmdp_elv"] = $url;

                    //message-validation-envoyé
                    $to = $tab["useremailrecup"];   //destinataire du mail//ici c'est le mail tapé dans le form_mdp_oublié
                    $subject = 'Vous avez demandé une réinitialisation de votre mot de passe sur monstage.education.pf';    //objet du mail
                    //msg contenu
                    $message = "Bonjour,<br>Vous avez demandé une réinitialisation de mot de passe. Si ce n'est pas vous qui avez fait cette demande, ne tenez pas compte de ce mail.<br>";
                    $message .= "Pour réinitialiser votre mot de passe, cliquez sur le lien suivant :";
                    $message .= "<p><a href='" . $url . "'>Réinitialisation de mot de passe</a></p>";//lien d'activ dans var $url
                    $message .= "<p>Cordialement,</p>";
                    $message .= "<p>DGEE - Direction Générale de l'Education et des enseignements</p>";
                    $message .= "<p></p><p><i>Ce mail a été envoyé automatiquement via une application, merci de ne pas y répondre</i>.</p>";

                    $headers = array('Content-Type: text/html; charset=UTF-8');

                    wp_mail($to, $subject, $message, $headers);

                } else {

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

//********************************************************************
// Fonction : reinitpasswordelv
// Paramètre(s):
// Description : Réinitialisation du mdp de l'élève
//********************************************************************
function reinitpasswordelv($tab) //fonc pour reinitialiser mdp elv
{

    try {
        //initialisation du message d'erreur
        $err = "";
        //connexion � la base de donn�es
        $conn = ConnBDDpdo();

        if (!empty($conn)) {

            if (isset($tab['token'], $tab['password1'], $tab['password2']) and ($tab['token'] != "" and $tab['token'] != null)) {   //si les chmp sont remplis

                if ($tab['password1'] != $tab['password2']) {   //si chmps != mdp ->error

                    $err = "errorsame";
                    return $err;
                }

                $usrmdp = $tab['password1'];

                // Cr�ation d'un SALT al�atoire
                $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
                // Cryptage PHP du mot de passe
                $mdphash = hash('sha512', $usrmdp . $random_salt);
                //Modification des infos de l'elv concerné
                $stmt = $conn->prepare("UPDATE eleve SET elv_token2=NULL, elv_password=:elv_password, elv_hash=:elv_hash WHERE eleve.elv_token2=:token");
                $stmt->bindParam(':token', $tab['token']);
                $stmt->bindParam(':elv_password', $mdphash);
                $stmt->bindParam(':elv_hash', $random_salt);
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

//********************************************************************
// Fonction : messageactiveelv
// Paramètre(s):
// Description : Activation par mail du compte de l'élève
//********************************************************************
function messageactiveelv($tab)//fonc° pour renvoie du lien d'activ
{

    try {
        //initialisation du message d'erreur
        $err = "";
        //connexion � la base de donn�es
        $conn = ConnBDDpdo();

        if (!empty($conn)) {

            if (isset($tab['useremailresend'])) {   //si le chmp useremailresend (form_renvoi_mail) est rempli

                $stmt = $conn->prepare("SELECT * FROM eleve WHERE eleve.elv_mail = :elv_mail"); //select*info de l'elv concerné
                $stmt->bindParam(':elv_mail', $tab["useremailresend"]);
                $stmt->execute();


                if ($stmt->rowCount() > 0) {

                    $res = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($res["elv_token"] == null) { //si user_elv a déjà validé son cmpt = error

                        $err = "erralact";

                    } else {

                        $url = get_template_directory_uri() . "/actiondev1.php?act=accountactiveelv&token=" . $res["elv_token"];    //renvoi vers la fonc accountactiveelv après le clique du lien activ
                        $_SESSION["urlresend_elv"] = $url;

                        //message-validation-envoyé
                        $to = $tab["useremailresend"];
                        $subject = 'Validation de compte sur monstage.education.pf';
                        //msg contenu
                        $message = "Bonjour,<br>Veuillez trouver ci-dessous le lien pour activer votre compte sur monstage.education.pf.";
                        $message .= "<p><a href='" . $url . "'>Activer mon compte</a></p>"; //lien activ
                        $message .= "<p>Cordialement,</p>";
                        $message .= "<p>DGEE - Direction Générale de l'Education et des enseignements</p>";
                        $message .= "<p></p><p><i>Ce mail a été envoyé automatiquement via une application, merci de ne pas y répondre</i>.</p>";

                        $headers = array('Content-Type: text/html; charset=UTF-8');

                        wp_mail($to, $subject, $message, $headers);


                    }

                } else {

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
// Paramètre(s):
// Description : Modification du mail de l'élève
// A savoir : Les modification se font dans profil_élève
//********************************************************************
function modifmailelv($tab)
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

                $elv_id = decryptIt($_SESSION["elv_id"], $_SESSION["hashsession"]);     //$elv_id=user_elv

                $token = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
                //Modification des infos de l'élève concerné
                $stmt = $conn->prepare("UPDATE eleve SET new_mail=:new_mail, elv_token2=:elv_token2 WHERE eleve.elv_id=:elv_id");
                $stmt->bindParam(':elv_token2', $token);
                $stmt->bindParam(':new_mail', $tab['useremailnew']);
                $stmt->bindParam(':elv_id', $elv_id);
                $stmt->execute();
                $stmt->closeCursor();


                $url = get_template_directory_uri() . "/actiondev1.php?act=validnewemailelv&token=" . $token;   //url_activ redirige vers actiondev1 et lance la fonc validnewemailelv
                $_SESSION["urlnewmail_elv"] = $url;

                //message-validation-envoyé
                $to = $tab['useremailnew'];
                $subject = 'Validation de votre nouvelle adresse email sur monstage.education.pf';
                //msg contenu
                $message = "Bonjour,<br>Veuillez trouver ci-dessous le lien pour valider la nouvelle adresse email votre compte sur monstage.education.pf.";
                $message .= "<p><a href='" . $url . "'>Valider mon mail</a></p>";   //lien activ
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
// Fonction : validnewemailelv
// Paramètre(s):
// Description : Validation du nouveau mail de l'élève
//********************************************************************
function validnewemailelv($tab)     //fonc valider le nouveau mail
{

    try {
        //initialisation du message d'erreur
        $err = "";
        //connexion � la base de donn�es
        $conn = ConnBDDpdo();

        if (!empty($conn)) {

            if (isset($tab['token']) and ($tab['token'] != "" and $tab['token'] != null)) {

                $stmt = $conn->prepare("SELECT * FROM eleve WHERE eleve.elv_token2 = :token");//select usr_lv où token2= token envoyé par mail
                $stmt->bindParam(':token', $tab["token"]);
                $stmt->execute();


                if ($stmt->rowCount() > 0) {

                    $res = $stmt->fetch(PDO::FETCH_ASSOC);
                    //Modification du usr_lv concerné
                    $stmt = $conn->prepare("UPDATE eleve SET elv_token2=NULL, elv_mail=new_mail WHERE eleve.elv_id=:elv_id"); //newmail devient elvmail
                    $stmt->bindParam(':elv_id', $res['elv_id']);
                    $stmt->execute();
                    $stmt->closeCursor();

                    $stmt = $conn->prepare("UPDATE eleve SET new_mail=NULL WHERE eleve.elv_id=:elv_id");//newmail=null sinon bug bdd
                    $stmt->bindParam(':elv_id', $res['elv_id']);
                    $stmt->execute();
                    $stmt->closeCursor();
                } else {

                    $err = "errortoken";

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
// Fonction : modifpasswordelv
// Paramètre(s):
// Description : Modification du mdp de l'élève
// A savoir : Les modification se font dans profil_élève
//********************************************************************
function modifpasswordelv($tab)
{
    try {

        //initialisation du message d'erreur
        $err = "";

        if (isset($tab['expassword'], $tab['password1'], $tab['password2'])) {

            //Connexion à la base de données
            $conn = ConnBDDpdo();

            if (!session_id()) {
                session_start();
            }

            if (!empty($conn)) {

                $elv_id = decryptIt($_SESSION["elv_id"], $_SESSION["hashsession"]); //$elv_id = id_sessionlv


                $stmt = $conn->prepare("SELECT * FROM eleve WHERE elv_id = :elv_id");
                $stmt->bindParam(':elv_id', $elv_id);
                $stmt->execute();
                $res = $stmt->fetch(PDO::FETCH_ASSOC);
                $stmt->closeCursor();

                $mdphash = hash('sha512', $tab['expassword'] . $res['elv_hash']);   //ancien mdp

                if ($mdphash != $res['elv_password']) { //verif si ex_password corresponds bien à celui enregistré avant

                    $err = "errorexpwd";

                }

                if ($tab['password1'] != $tab['password2']) {   //verif si chmps_mdp pareils

                    $err = "errorsame";

                }


                $newmdphash = hash('sha512', $tab['password1'] . $res['elv_hash']); //nouveau mdp
                //Modification du password de l'utilisateur
                $stmt = $conn->prepare("UPDATE eleve SET elv_password=:elv_password WHERE eleve.elv_id=:elv_id");
                $stmt->bindParam(':elv_password', $newmdphash);
                $stmt->bindParam(':elv_id', $elv_id);
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
// Fonction : modifinfoelv
// Paramètre(s):
// Description : Modification des informations enregistrées
// A savoir : Les modification se font dans profil_élève
//********************************************************************
function modifinfoelv($tab)
{
    try {

        //initialisation du message d'erreur
        $err = "";

        if (isset($tab['username'])) {  //si il y'a bien un utilisateur-profil

            //Connexion à la base de données
            $conn = ConnBDDpdo();

            if (!session_id()) {
                session_start();
            }

            $elv_id = decryptIt($_SESSION["elv_id"], $_SESSION["hashsession"]);

            //Récupération des informations présentes sur le profil_user
            $username = ""; //init° var vide pour éviter les bug
            if (!empty($tab['username'])) $username = stripslashes((filter_var($tab['username'], FILTER_SANITIZE_STRING))); //si il existe tel donnée -> var $user.. filtré ici en str
            $userprename = "";
            if (!empty($tab['userprename'])) $userprename = stripslashes((filter_var($tab['userprename'], FILTER_SANITIZE_STRING)));
            $usertel = "";
            if (!empty($tab['usertel'])) $usertel = stripslashes((filter_var($tab['usertel'], FILTER_SANITIZE_STRING))); //num-tel
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
            $userclass = "";
            if (!empty($tab['userclass'])) $userclass = $tab['userclass'];
            $userdiplome = "";
            if (!empty($tab['userdiplome'])) $userdiplome = stripslashes((filter_var($tab['userdiplome'], FILTER_SANITIZE_STRING)));
            $userine = "";
            if (!empty($tab['userine'])) $userine = stripslashes((filter_var($tab['userine'], FILTER_SANITIZE_STRING)));

            if (!empty($conn)) {

                //Modification des informations du profil_user
                $stmt = $conn->prepare("UPDATE eleve SET elv_nom=:elv_nom,elv_pren=:elv_pren,elv_tel=:elv_tel,elv_sexe=:elv_sexe,elv_datenaiss=:elv_datenaiss,elv_adr=:elv_adr,elv_com=:elv_com,elv_uai=:elv_uai,elv_class=:elv_class,elv_diplome=:elv_diplome,elv_ine=:elv_ine WHERE eleve.elv_id=:elv_id");
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
                $stmt->bindParam(':elv_ine', $userine);
                $stmt->bindParam(':elv_id', $elv_id);
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
// Fonction : modifcvelv
// Paramètre(s):
// Description : Modification du CV et LM
// A savoir : Les modification se font dans profil_élève
//********************************************************************
function modifcvelv($tab, $files) //$files corresponds aux images joints sur le site
{
    try {

        //initialisation du message d'erreur
        $err = "";


        //Connexion à la base de données
        $conn = ConnBDDpdo();

        if (!session_id()) {
            session_start();
        }

        $elv_id = decryptIt($_SESSION["elv_id"], $_SESSION["hashsession"]);

        //chmps pour CV
        $userexp = "";
        if (!empty($tab['userexp'])) $userexp = stripslashes((filter_var($tab['userexp'], FILTER_SANITIZE_STRING)));
        $useractivite = "";
        if (!empty($tab['useractivite'])) $useractivite = stripslashes((filter_var($tab['useractivite'], FILTER_SANITIZE_STRING)));
        $userlangue = "";
        if (!empty($tab['userlangue'])) $userlangue = stripslashes((filter_var($tab['userlangue'], FILTER_SANITIZE_STRING)));

        if (!empty($conn)) {
            //Modification des champs de l'élève concerné dans bdd
            $stmt = $conn->prepare("UPDATE eleve SET elv_cv=:elv_cv,elv_activite=:elv_activite,elv_lang=:elv_lang WHERE eleve.elv_id=:elv_id");
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


/*************************************************/
/***************Pédagogique*****************************/
/*************************************************/


//********************************************************************
// Fonction : seconnecterpeda
// Paramètre(s): usrlg -- identifiant saisi par l'utilisateur
//               pwd -- Mot de passe saisi par l'utilisateur  
// Description : Sécurisation des variables de sessions
//********************************************************************
function seconnecterpeda($tab)   //form connexion compte peda
{
    try {

        //initialisation du message d'erreur
        $err = "";

        if (isset($tab['useremail'], $tab['userpassword'])) {

            // Formatage et validation des donn�es du formulaire
            $usrlog = $tab['useremail'];
            $usrpass = $tab['userpassword'];

            //Connexion à la base de données
            $conn = ConnBDDpdo();

            if (!session_id()) {
                session_start();
            }

            if (!empty($conn)) {

                $stmt = $conn->prepare("SELECT * FROM pedagogique WHERE peda_mail = :peda_mail");
                $stmt->bindParam(':peda_mail', $usrlog);
                $stmt->execute();
                $res = $stmt->fetch(PDO::FETCH_ASSOC);
                $stmt->closeCursor();

                if (!empty($res)) {

                    $usr_id = $res['peda_id'];
                    $usr_mail = $res['peda_mail'];
                    $usr_pwd = $res['peda_password'];
                    $usr_salt = $res['peda_hash'];
//					$uai_rne = $res['elv_uai'];
                    $peda_token = $res['peda_token'];

                    $suspend = $res['suspend'];

                    if ($suspend == "0") {

                        $pwd = hash('sha512', $usrpass . $usr_salt);

                        if ($peda_token == null) {

                            if ($usr_pwd == $pwd) {

                                close_session();

                                $usr_browser = $_SERVER['HTTP_USER_AGENT']; // Obtention de la chaine user-agent de l'utilisateur.
                                $usr_id = preg_replace("/[^0-9]+/", "", $usr_id); // protection XSS si l'on doit afficher cette valeur
                                $usr_id = encryptIt($usr_id, $_SESSION["hashsession"]);
                                $_SESSION['peda_id'] = $usr_id;
                                $_SESSION['peda_string'] = hash('sha512', $pwd . $usr_browser);
                                $_SESSION['peda_mail'] = $usr_mail;
                                $_SESSION['user_typ'] = 1;
                                $_SESSION['elv_id2'] = 0;

                                if ($tab["remember"] == "1") {  //se souvenir de moi


                                    setcookie("pseudocookiepeda", $usr_mail, time() + 365 * 24 * 3600, "/", null, false, true);
                                    setcookie("passwordcookiepeda", $usr_pwd, time() + 365 * 24 * 3600, "/", null, false, true);

                                }

                            } else {

                                $err = "errpassword";

                            }

                        } else {

                            $err = "errsuspens";

                        }

                    } else {

                        $err = "errtoken";

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
// Fonction : lgchkpeda
// Paramètre(s): aucun 
// Description : Compte le nombre de tentatives de login
//********************************************************************
function lgchkpeda()
{
    // Vérifie si les variables de sessions sont remplies
    if (isset($_SESSION['peda_string']))
        return true;
    else
        return false;
}


//********************************************************************
// Fonction : registerpeda
// Paramètre(s): usrlg -- identifiant saisi par l'utilisateur
//               pwd -- Mot de passe saisi par l'utilisateur  
// Description : Sécurisation des variables de sessions
//********************************************************************

//vérifier si l'email se termine par "@ac-polynesie.pf"
function validmailpeda($email)
{

    $pattern = '/@ac-polynesie\.pf$/i'; // Le "i" à la fin rend la recherche insensible à la casse
    return preg_match($pattern, $email); // Retourne vrai si l'email correspond au pattern
}

function registerpeda($tab)  //form creation compte peda

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

            if (isset($tab['useremailcrea'], $tab['usernom'], $tab['userprenom'], $tab['password1'])) {
                // Formatage et validation des donn�es du formulaire
                $usrmail = filter_var($tab['useremailcrea'], FILTER_VALIDATE_EMAIL);    //filtre champs maiil
                $usrmail = filter_var($usrmail, FILTER_VALIDATE_EMAIL);
                $usrnom = stripslashes((filter_var($tab['usernom'], FILTER_SANITIZE_STRING)));
                $usrnom = ucfirst($usrnom);                                   //mets en maj la 1e lettre
                $usrprenom = stripslashes((filter_var($tab['userprenom'], FILTER_SANITIZE_STRING)));
                $usrprenom = ucfirst(strtolower($usrprenom));   //mets en maj la 1e lettre et verif aucun autre maj
                $useretab = $tab['useretab'];

                $usrmdp = stripslashes((filter_var($tab['password1'], FILTER_SANITIZE_STRING)));

                // Utilisation de la fonction de validation
                $email = $usrmail;
                /*if (!validmailpeda($email)) {
                    $err = "errormail";
                    return $err;
                }*/

                //compare les 2 mdp tapés, si non identique = error
                if ($tab['password1'] != $tab['password2']) {

                    $err = "errorsame";
                    return $err;
                }


                // Cr�ation d'un SALT al�atoire
                $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
                // Cryptage PHP du mot de passe
                $mdphash = hash('sha512', $usrmdp . $random_salt);      //hash le mdp
                $usrhash = hash('sha512', $usrmail . $random_salt);     //hash le mail
                $activetoken = hash('sha512', $mdphash . $usrhash);     //hash mdp + mail

                //remplissage de ma table pedagogique --> le chmp peda_mail est rempli avec le param :peda_mail
                $stmt = $conn->prepare("INSERT INTO pedagogique (peda_mail, peda_password, peda_hash, peda_token, peda_nom, peda_pren, peda_uai, d_crea) VALUES (:peda_mail, :peda_password, :peda_hash, :peda_token, :peda_nom, :peda_pren, :peda_uai, NOW())");
                $stmt->bindParam(':peda_mail', $usrmail);   //stock la val de ma var $usrmail dans param :peda_mail
                $stmt->bindParam(':peda_password', $mdphash);
                $stmt->bindParam(':peda_hash', $random_salt);
                $stmt->bindParam(':peda_token', $activetoken);
                $stmt->bindParam(':peda_nom', $usrnom);
                $stmt->bindParam(':peda_pren', $usrprenom);
                $stmt->bindParam(':peda_uai', $useretab);
                $stmt->execute();

                $url = get_template_directory_uri() . "/actiondev1.php?act=accountactivepeda&token=" . $activetoken;
                $_SESSION["urlcrea_peda"] = $url;

                //message-validation-envoyé
                $to = $usrmail;
                $subject = 'Validation de compte sur monstage.education.pf';

                $message = "Bonjour,<br>Veuillez trouver ci-dessous le lien pour activer votre compte sur monstage.education.pf.";
                $message .= "<p><a href='" . $url . "'>Activer mon compte</a></p>";
                $message .= "<p>Cordialement,</p>";
                $message .= "<p>DGEE - Direction Générale de l'Education et des enseignements</p>";
                $message .= "<p></p><p><i>Ce mail a été envoyé automatiquement via une application, merci de ne pas y répondre</i>.</p>";

                $headers = array('Content-Type: text/html; charset=UTF-8');

                wp_mail($to, $subject, $message, $headers);


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
// Fonction : accountactivepeda
// Paramètre(s): usrlg -- identifiant saisi par l'utilisateur
//               pwd -- Mot de passe saisi par l'utilisateur  
// Description : Sécurisation des variables de sessions
//********************************************************************
function accountactivepeda($tab)
{
    try {
        //initialisation du message d'erreur
        $err = "";
        //connexion � la base de donn�es
        $conn = ConnBDDpdo();

        if (!empty($conn)) {

            //Ouverture d'une transaction
            //$conn->beginTransaction();

            if (isset($tab['token']) and ($tab['token'] != "" and $tab['token'] != null)) {

                $activetoken = $tab['token'];

                $stmt = $conn->prepare("SELECT * FROM pedagogique WHERE pedagogique.peda_token = :peda_token");
                $stmt->bindParam(':peda_token', $activetoken);
                $stmt->execute();


                if ($stmt->rowCount() > 0) {

                    $res = $stmt->fetch(PDO::FETCH_ASSOC);
                    // Modification de l'utilisateur dans la BDD
                    $stmt = $conn->prepare("UPDATE pedagogique SET peda_token=null WHERE pedagogique.peda_id=:peda_id and pedagogique.peda_token = :activetoken");
                    $stmt->bindParam(':activetoken', $activetoken);
                    $stmt->bindParam(':peda_id', $res['peda_id']);
                    $stmt->execute();

                    $stmt->closeCursor();

                    $usr_id = $res['peda_id'];
                    $usr_mail = $res['peda_mail'];
                    $usr_pwd = $res['peda_password'];
                    $usr_salt = $res['peda_hash'];
//                    $uai_rne = $res['elv_uai'];

                    close_session();

                    $usr_browser = $_SERVER['HTTP_USER_AGENT']; // Obtention de la chaine user-agent de l'utilisateur.
                    $usr_id = preg_replace("/[^0-9]+/", "", $usr_id); // protection XSS si l'on doit afficher cette valeur
                    $usr_id = encryptIt($usr_id, $_SESSION["hashsession"]);
                    $_SESSION['peda_id'] = $usr_id;
                    $_SESSION['peda_string'] = hash('sha512', $pwd . $usr_browser);
                    $_SESSION['peda_mail'] = $usr_mail;
                    $_SESSION['elv_id2'] = 0;
                    $_SESSION['user_typ'] = 1;

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

function forgetpasswordpeda($tab)
{

    try {
        //initialisation du message d'erreur
        $err = "";
        //connexion � la base de donn�es
        $conn = ConnBDDpdo();

        if (!empty($conn)) {

            if (isset($tab['useremailrecup'])) {

                $stmt = $conn->prepare("SELECT * FROM pedagogique WHERE pedagogique.peda_mail = :peda_mail");
                $stmt->bindParam(':peda_mail', $tab["useremailrecup"]);
                $stmt->execute();


                if ($stmt->rowCount() > 0) {

                    $res = $stmt->fetch(PDO::FETCH_ASSOC);

                    $activetoken = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));

                    $stmt = $conn->prepare("UPDATE pedagogique SET peda_token2=:activetoken WHERE pedagogique.peda_id=:peda_id");
                    $stmt->bindParam(':activetoken', $activetoken);
                    $stmt->bindParam(':peda_id', $res["peda_id"]);
                    $stmt->execute();

                    $url = get_site_url() . "/reinitialisation-de-mot-de-passe/?token=" . $activetoken;
                    $_SESSION["urlmdp_peda"] = $url;


                    //message-validation-envoyé
                    $to = $tab["useremailrecup"];
                    $subject = 'Vous avez demandé une réinitialisation de votre mot de passe sur monstage.education.pf';

                    $message = "Bonjour,<br>Vous avez demandé une réinitialisation de votre mot de passe. Si ce n'est pas vous qui avez fait cette demande, ne tenez pas compte de ce mail.<br>";
                    $message .= "Pour réinitialiser votre mot de passe, cliquez sur le lien suivant :";
                    $message .= "<p><a href='" . $url . "'>Réinitialisation de mon mot de passe</a></p>";
                    $message .= "<p>Cordialement,</p>";
                    $message .= "<p>DGEE - Direction Générale de l'Education et des enseignements</p>";
                    $message .= "<p></p><p><i>Ce mail a été envoyé automatiquement via une application, merci de ne pas y répondre</i>.</p>";

                    $headers = array('Content-Type: text/html; charset=UTF-8');

                    wp_mail($to, $subject, $message, $headers);

                } else {

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


function reinitpasswordpeda($tab)
{

    try {
        //initialisation du message d'erreur
        $err = "";
        //connexion � la base de donn�es
        $conn = ConnBDDpdo();

        if (!empty($conn)) {

            if (isset($tab['token'], $tab['password1'], $tab['password2']) and ($tab['token'] != "" and $tab['token'] != null)) {

                if ($tab['password1'] != $tab['password2']) {

                    $err = "errorsame";
                    return $err;
                }

                $usrmdp = $tab['password1'];

                // Cr�ation d'un SALT al�atoire
                $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
                // Cryptage PHP du mot de passe
                $mdphash = hash('sha512', $usrmdp . $random_salt);

                $stmt = $conn->prepare("UPDATE pedagogique SET peda_token2=NULL, peda_password=:peda_password, peda_hash=:peda_hash WHERE pedagogique.peda_token2=:token");
                $stmt->bindParam(':token', $tab['token']);
                $stmt->bindParam(':peda_password', $mdphash);
                $stmt->bindParam(':peda_hash', $random_salt);
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


function messageactivepeda($tab)
{

    try {
        //initialisation du message d'erreur
        $err = "";
        //connexion � la base de donn�es
        $conn = ConnBDDpdo();

        if (!empty($conn)) {

            if (isset($tab['useremailresend'])) {

                $stmt = $conn->prepare("SELECT * FROM pedagogique WHERE pedagogique.peda_mail = :peda_mail");
                $stmt->bindParam(':peda_mail', $tab["useremailresend"]);
                $stmt->execute();


                if ($stmt->rowCount() > 0) {

                    $res = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($res["peda_token"] == null) {

                        $err = "erralact";

                    } else {

                        $url = get_template_directory_uri() . "/actiondev1.php?act=accountactivepeda&token=" . $res["peda_token"];
                        $_SESSION["urlresend_peda"] = $url;


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

                } else {

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
// Fonction : modifmailpeda
// Paramètre(s): usrlg -- identifiant saisi par l'utilisateur
//               pwd -- Mot de passe saisi par l'utilisateur  
// Description : Sécurisation des variables de sessions
//********************************************************************
function modifmailpeda($tab)
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

                $peda_id = decryptIt($_SESSION["peda_id"], $_SESSION["hashsession"]);

                $token = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));

                $stmt = $conn->prepare("UPDATE pedagogique SET new_mail=:new_mail, peda_token2=:peda_token2 WHERE pedagogique.peda_id=:peda_id");
                $stmt->bindParam(':peda_token2', $token);
                $stmt->bindParam(':new_mail', $tab['useremailnew']);
                $stmt->bindParam(':peda_id', $peda_id);
                $stmt->execute();
                $stmt->closeCursor();


                $url = get_template_directory_uri() . "/actiondev1.php?act=validnewemailpeda&token=" . $token;
                $_SESSION["urlnewmail_peda"] = $url;


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


function validnewemailpeda($tab)
{

    try {
        //initialisation du message d'erreur
        $err = "";
        //connexion � la base de donn�es
        $conn = ConnBDDpdo();

        if (!empty($conn)) {

            if (isset($tab['token']) and ($tab['token'] != "" and $tab['token'] != null)) {

                $stmt = $conn->prepare("SELECT * FROM pedagogique WHERE pedagogique.peda_token2 = :token");
                $stmt->bindParam(':token', $tab["token"]);
                $stmt->execute();


                if ($stmt->rowCount() > 0) {

                    $res = $stmt->fetch(PDO::FETCH_ASSOC);

                    $stmt = $conn->prepare("UPDATE pedagogique SET peda_token2=NULL, peda_mail=new_mail WHERE pedagogique.peda_id=:peda_id");
                    $stmt->bindParam(':peda_id', $res['peda_id']);
                    $stmt->execute();
                    $stmt->closeCursor();

                    $stmt = $conn->prepare("UPDATE pedagogique SET new_mail=NULL WHERE pedagogique.peda_id=:peda_id");
                    $stmt->bindParam(':peda_id', $res['peda_id']);
                    $stmt->execute();
                    $stmt->closeCursor();
                } else {

                    $err = "errortoken";

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
// Fonction : modifpasswordpeda
// Paramètre(s): usrlg -- identifiant saisi par l'utilisateur
//               pwd -- Mot de passe saisi par l'utilisateur  
// Description : Sécurisation des variables de sessions
//********************************************************************
function modifpasswordpeda($tab)
{
    try {

        //initialisation du message d'erreur
        $err = "";

        if (isset($tab['expassword'], $tab['password1'], $tab['password2'])) {

            //Connexion à la base de données
            $conn = ConnBDDpdo();

            if (!session_id()) {
                session_start();
            }

            if (!empty($conn)) {

                $peda_id = decryptIt($_SESSION["peda_id"], $_SESSION["hashsession"]);


                $stmt = $conn->prepare("SELECT * FROM pedagogique WHERE peda_id = :peda_id");
                $stmt->bindParam(':peda_id', $peda_id);
                $stmt->execute();
                $res = $stmt->fetch(PDO::FETCH_ASSOC);
                $stmt->closeCursor();

                $mdphash = hash('sha512', $tab['expassword'] . $res['peda_hash']);

                if ($mdphash != $res['peda_password']) {

                    $err = "errorexpwd";

                }

                if ($tab['password1'] != $tab['password2']) {

                    $err = "errorsame";

                }


                $newmdphash = hash('sha512', $tab['password1'] . $res['peda_hash']);

                $stmt = $conn->prepare("UPDATE pedagogique SET peda_password=:peda_password WHERE pedagogique.peda_id=:peda_id");
                $stmt->bindParam(':peda_password', $newmdphash);
                $stmt->bindParam(':peda_id', $peda_id);
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
// Fonction : searchlv
//********************************************************************
function searchlv($tab)     //profil prof/suivre un elv
{
    try {

        //initialisation du message d'erreur
        $err = "";

        if (isset($tab['ideleve']) and $tab['ideleve'] != "") {

            //Connexion à la base de données
            $conn = ConnBDDpdo();

            if (!session_id()) {
                session_start();
            }

            $peda_id = decryptIt($_SESSION["peda_id"], $_SESSION["hashsession"]);
            $elv_id = decryptIt($tab['ideleve'], $_SESSION["hashsession"]);

            if (!empty($conn)) {


                $stmt = $conn->prepare("SELECT COUNT(*) as NB FROM peda_elv WHERE peda_elv.peda_id=:peda_id and peda_elv.elv_id=:elv_id");
                $stmt->bindParam(':peda_id', $peda_id);
                $stmt->bindParam(':elv_id', $elv_id);
                $stmt->execute();
                $res = $stmt->fetch(PDO::FETCH_ASSOC);
                $stmt->closeCursor();
                if ($res["NB"] > 0) {

                    $err = "alreadysuiv";
                    return $err;

                }

                $stmt = $conn->prepare("INSERT INTO peda_elv (peda_id, elv_id,d_crea) VALUES (:peda_id ,:elv_id, NOW())");
                $stmt->bindParam(':peda_id', $peda_id);
                $stmt->bindParam(':elv_id', $elv_id);

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
// Fonction : modiftabpeda
// Paramètre(s): usrlg -- identifiant saisi par l'utilisateur
//               eta -- etablissement saisi par l'utilisateur
// Description : Sécurisation des variables de sessions
//********************************************************************

function modifetabpeda($tab)   //form peda etablissement
{
    try {

        //initialisation du message d'erreur
        $err = "";

        if (isset($tab['useretab'])) {

            //Connexion à la base de données
            $conn = ConnBDDpdo();

            if (!session_id()) {
                session_start();
            }

            $peda_id = decryptIt($_SESSION["peda_id"], $_SESSION["hashsession"]);

            $useretab = "0";
            if (!empty($tab['useretab'])) $useretab = $tab['useretab'];

            if (!empty($conn)) {

                $stmt = $conn->prepare("UPDATE pedagogique SET peda_uai=:peda_uai WHERE pedagogique.peda_id=:peda_id");
                $stmt->bindParam(':peda_uai', $useretab);
                $stmt->bindParam(':peda_id', $peda_id);
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
// Fonction : supprimerelv
//********************************************************************
function supprimerelv($tab)
{


    try {

        //initialisation du message d'erreur
        $err = "";


        //Connexion à la base de données
        $conn = ConnBDDpdo();

        if (!session_id()) {
            session_start();
        }

        $peda_id = decryptIt($_SESSION["peda_id"], $_SESSION["hashsession"]);
        $elv_id = decryptIt($tab["chpiddel"], $_SESSION["hashsession"]);

        if (!empty($conn)) {

            $stmt = $conn->prepare("DELETE FROM peda_elv WHERE peda_elv.elv_id=:elv_id and peda_elv.peda_id=:peda_id");
            $stmt->bindParam(':elv_id', $elv_id);
            $stmt->bindParam(':peda_id', $peda_id);
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
// Fonction : inscrireelvpeda
//********************************************************************
function inscrireelvpeda($tab)   //form connexion compte elv
{
    try {

        //initialisation du message d'erreur
        $err = "";


        //Connexion à la base de données
        $conn = ConnBDDpdo();

        if (!session_id()) {
            session_start();
        }

        $peda_id = decryptIt($_SESSION["peda_id"], $_SESSION["hashsession"]);
        $GLOBALS["lastid"] = 0;
        if (!empty($conn)) {

            $useremailins = "";
            if (!empty($tab['useremailins'])) $useremailins = stripslashes((filter_var($tab['useremailins'], FILTER_SANITIZE_STRING)));
            $usernomins = "";
            if (!empty($tab['usernomins'])) $usernomins = stripslashes((filter_var($tab['usernomins'], FILTER_SANITIZE_STRING)));
            $userprenomins = "";
            if (!empty($tab['userprenomins'])) $userprenomins = stripslashes((filter_var($tab['userprenomins'], FILTER_SANITIZE_STRING)));
            $userdatenaisins = "";
            if (!empty($tab['userdatenaisins'])) $userdatenaisins = stripslashes((filter_var($tab['userdatenaisins'], FILTER_SANITIZE_STRING)));
            $usersexe = 0;
            if (!empty($tab['usersexe'])) $usersexe = $tab['usersexe'];
            $useretab = 0;
            if (!empty($tab['useretab'])) $useretab = $tab['useretab'];
            $userclass = 0;
            if (!empty($tab['userclass'])) $userclass = $tab['userclass'];
            $userdiplome = "";
            if (!empty($tab['userdiplome'])) $userdiplome = stripslashes((filter_var($tab['userdiplome'], FILTER_SANITIZE_STRING)));


            $stmt = $conn->prepare("SELECT eleve.* FROM eleve WHERE eleve.elv_mail LIKE '%" . $useremailins . "%' or (eleve.elv_nom LIKE '%" . $usernomins . "%' and eleve.elv_pren LIKE '%" . $userprenomins . "%' and eleve.elv_datenaiss LIKE '%" . $userdatenaisins . "%') limit 1");
            $stmt->execute();

            if ($stmt->rowCount() > 0) {

                $res = $stmt->fetch(PDO::FETCH_ASSOC);

                $elvash = encryptIt($res["elv_id"], $_SESSION["hashsession"]);

                $GLOBALS["lastid"] = $elvash;
                $err = "alreadyregister";


                return $err;

            }

            $stmt->closeCursor();

            $usrmdp = random_str_generator(6);
            $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
            // Cryptage PHP du mot de passe
            $mdphash = hash('sha512', $usrmdp . $random_salt);
            $usrhash = hash('sha512', $useremailins . $random_salt);
            $activetoken = hash('sha512', $mdphash . $usrhash);

            $stmt = $conn->prepare("INSERT INTO eleve (elv_mail, elv_password, elv_hash, elv_token, elv_nom, elv_pren, elv_sexe, elv_datenaiss, elv_uai, elv_class, elv_diplome, d_crea) VALUES (:elv_mail, :elv_password, :elv_hash, :elv_token, :elv_nom, :elv_pren, :elv_sexe, :elv_datenaiss, :elv_uai, :elv_class, :elv_diplome, NOW())");
            $stmt->bindParam(':elv_mail', $useremailins);    //stock ma var $usrmail dans un param :elv_mail //param utilisé pour l'insert° dans bdd
            $stmt->bindParam(':elv_password', $mdphash);
            $stmt->bindParam(':elv_hash', $random_salt);     //utilisé pour reconnaître le hash du user
            $stmt->bindParam(':elv_token', $activetoken);    //utilisé pour lien activ cmpt
            $stmt->bindParam(':elv_nom', $usernomins);
            $stmt->bindParam(':elv_pren', $userprenomins);
            $stmt->bindParam(':elv_datenaiss', $userdatenaisins);
            $stmt->bindParam(':elv_sexe', $usersexe);
            $stmt->bindParam(':elv_uai', $useretab);
            $stmt->bindParam(':elv_class', $userclass);
            $stmt->bindParam(':elv_diplome', $userdiplome);
            $stmt->execute();

            $elv_id = $conn->lastInsertId();

            $stmt = $conn->prepare("INSERT INTO peda_elv (peda_id, elv_id, d_crea) VALUES (:peda_id ,:elv_id, NOW())");
            $stmt->bindParam(':peda_id', $peda_id);
            $stmt->bindParam(':elv_id', $elv_id);
            $stmt->execute();

            //génère le lien de verif
            $url = get_template_directory_uri() . "/actiondev1.php?act=accountactiveelv&token=" . $activetoken;  //appel fonc°accountactiveelv lorsque je clique sur le lien//redirige vers actiondev1
            $_SESSION["urlcrea_pedalv"] = $url;


            //message-validation-envoyé
            $to = $useremailins; //envoie à $useremailins == mail du user
            $subject = 'Un compte a été crée en votre nom sur monstage.education.pf'; //objet du mail
            //msg mail contenu
            $message = "<p>Bonjour,<br> Un de vos professeur a crée un compte sur le site monstage.education.pf.</p>";
            $message .= "<p>Voici votre mot de passe généré automatiquement par l'application.</p>";
            $message .= "<h2>" . $usrmdp . "</h2>";
            $message .= "<p>Vous pouvez modifier ce mot de passe directement via l'application dans votre profil.</p>";
            $message .= "<p>Veuillez trouver ci-dessous le lien pour activer votre compte sur monstage.education.pf.</p>";
            $message .= "<p><a href='" . $url . "'>Activer mon compte</a></p>"; //lien activ
            $message .= "<p>Cordialement,</p>";
            $message .= "<p>DGEE - Direction Générale de l'Education et des enseignements</p>";
            $message .= "<p></p><p><i>Ce mail a été envoyé automatiquement via une application, merci de ne pas y répondre</i>.</p>";

            $headers = array('Content-Type: text/html; charset=UTF-8'); //syntaxe d'écriture du mail//normalement..prends bien en compte tout les caract du clavier

            wp_mail($to, $subject, $message, $headers); //plug wp envoie msg de mail_site --> mail_user($to) avec objet du mail($subject) et le contenu ($message)


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


function suivreelv($tab)     //prifl prof/suivre un elv
{
    try {

        //initialisation du message d'erreur
        $err = "";

        if (isset($tab['suivreelvid'])) {

            //Connexion à la base de données
            $conn = ConnBDDpdo();

            if (!session_id()) {
                session_start();
            }

            $peda_id = decryptIt($_SESSION["peda_id"], $_SESSION["hashsession"]);
            $elv_id = decryptIt($tab["suivreelvid"], $_SESSION["hashsession"]);


            if (!empty($conn)) {

                $stmt = $conn->prepare("SELECT COUNT(*) as NB FROM peda_elv WHERE peda_elv.peda_id=:peda_id and peda_elv.elv_id=:elv_id");
                $stmt->bindParam(':peda_id', $peda_id);
                $stmt->bindParam(':elv_id', $elv_id);
                $stmt->execute();
                $res = $stmt->fetch(PDO::FETCH_ASSOC);
                $stmt->closeCursor();

                if ($res["NB"] > 0) {

                    $err = "alreadysuiv";
                    return $err;

                }

                $stmt = $conn->prepare("INSERT INTO peda_elv (peda_id, elv_id, d_crea) VALUES (:peda_id ,:elv_id, NOW())");
                $stmt->bindParam(':peda_id', $peda_id);
                $stmt->bindParam(':elv_id', $elv_id);

                $stmt->execute();
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

