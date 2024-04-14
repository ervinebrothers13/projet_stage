<?php
/**
 * Template Name: profil pédagogique
 * Description: Pages de profil pédagogique
 */


// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}
?>
<?php get_header("cust"); ?>

<section id="content" <?php Avada()->layout->add_style('content_style'); ?>>

    <?php while (have_posts()) : ?>
        <?php the_post(); ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <?php echo fusion_render_rich_snippets_for_pages(); // phpcs:ignore WordPress.Security.EscapeOutput ?>

            <?php avada_singular_featured_image(); ?>

            <div class="post-content">
                <?php the_content(); ?>
                <?php fusion_link_pages(); ?>
            </div>
            <?php if (!post_password_required($post->ID)) : ?>
                <?php do_action('avada_before_additional_page_content'); ?>
                <?php if (class_exists('WooCommerce')) : ?>
                    <?php $woo_thanks_page_id = get_option('woocommerce_thanks_page_id'); ?>
                    <?php $is_woo_thanks_page = (!get_option('woocommerce_thanks_page_id')) ? false : is_page(get_option('woocommerce_thanks_page_id')); ?>
                    <?php if (Avada()->settings->get('comments_pages') && !is_cart() && !is_checkout() && !is_account_page() && !$is_woo_thanks_page) : ?>
                        <?php comments_template(); ?>
                    <?php endif; ?>
                <?php else : ?>
                    <?php if (Avada()->settings->get('comments_pages')) : ?>
                        <?php comments_template(); ?>
                    <?php endif; ?>
                <?php endif; ?>
                <?php do_action('avada_after_additional_page_content'); ?>
            <?php endif; // Password check. ?>
        </div>
    <?php endwhile; ?>


    <?php

    if (lgchkpeda()) {


        $peda_id = decryptIt($_SESSION["peda_id"], $_SESSION["hashsession"]);

        $tabarray = recData("pedagogique", $peda_id);

//            $nblvsuivi=recData("lstlvsuivi",$peda_id);


        ?>

        <?php if (isset($_GET["msg"]) && $_GET["msg"] == "verified") { ?>

            <div class='alert alert-success ctr'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                Votre compte a bien été vérifié, bienvenue, <?php echo $_SESSION['peda_mail']; ?>.
            </div>

        <?php } ?>
        <?php if (isset($_GET["msg"]) && $_GET["msg"] == "connected") { ?>

            <div class='alert alert-success ctr'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                Bienvenue, <?php echo $_SESSION['peda_mail']; ?>.
            </div>

        <?php } ?>
        <div class="row" id="profileleve">

            <header class="panel-heading tab-bg-dark-navy-blue col-md-3">
                <ul class="nav nav-tabs mb-2" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link <?php if (!isset($_GET["ong"]) or (isset($_GET["ong"]) && $_GET["ong"] == "profil")) {
                            echo "active";
                        } ?> " data-toggle="tab" role="tab" aria-controls="profiltab"
                           aria-selected="true" href="#profiltab">profil et sécurité</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if (isset($_GET["ong"]) && $_GET["ong"] == "preinsc") {
                            echo "active";
                        } ?>" data-toggle="tab" role="tab" aria-controls="inseleveetab"
                           aria-selected="false" href="#inseleveetab">Pré-inscrire un élève</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if (isset($_GET["ong"]) && $_GET["ong"] == "followlv") {
                            echo "active";
                        } ?>" data-toggle="tab" role="tab" aria-controls="suiveleveetab"
                           aria-selected="false" href="#suiveleveetab">Suivre un élève</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if (isset($_GET["ong"]) && $_GET["ong"] == "lstlv") {
                            echo "active";
                        } ?>" data-toggle="tab" role="tab" aria-controls="eleveetab"
                           aria-selected="false" href="#eleveetab">Mes élèves</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link deconnexion" onclick="sedeconnecter()">Se déconnecter</a>
                    </li>
                </ul>
            </header>
            <div class="tab-content col-md-9" id="myTabContent">

                <div id="profiltab" role="tabpanel"
                     class="tab-pane <?php if (!isset($_GET["ong"]) or (isset($_GET["ong"]) && $_GET["ong"] == "profil")) {
                         echo "active";
                     } ?>">
                    <h1>Modifier mon établissement</h1>
                    <form id="changeetab-form" method="POST"
                          action="<?php echo get_template_directory_uri(); ?>/actiondev1.php?act=modifetabpeda">
                        <label for="useretab">Mon établissement scolaire :</label>
                        <select id="useretab" class="colorblack col-md-10 marginbottom20" name="useretab">
                            <?php echo(BLst('uai', 'uai_rne', 'uai_lc', $tabarray["peda_uai"], "", "", "", "", "")); ?>
                        </select>
                        </br>

                        <button class="bouttonconnex" type="submit">Enregistrer</button>
                        <?php if (isset($_GET["msg"]) && $_GET["msg"] == "etabchange") { ?>

                            <div class='alert alert-success ctr'>
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                Votre établissement a bien été changé
                            </div>

                        <?php } ?>
                    </form>
                    </hr>
                    <h1>Modifier mon adresse électronique</h1>
                    <form id="changemail-form" method="POST"
                          action="<?php echo get_template_directory_uri(); ?>/actiondev1.php?act=modifmailpeda">
                        <label for="useremail">Mon adresse électronique actuel :</label>
                        <input type="email" disabled id="useremail" name="useremail"
                               value="<?php echo $tabarray["peda_mail"]; ?>">
                        <br>
                        <label for="useremailnew">Mon nouvelle adresse électronique :</label>
                        <input type="email" id="useremailnew" name="useremailnew">
                        <br>
                        <br>
                        <button class="bouttonconnex" type="submit">Enregistrer</button>
                        <?php if (isset($_GET["msg"]) && $_GET["msg"] == "mailsend") { ?>

                            <div class='alert alert-success ctr'>
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                Un email a été envoyé sur votre nouvelle boite mail. Pour confirmer votre nouvelle
                                adresse email, cliquez sur le lien d'activation
                            </div>

                        <?php } ?>
                        <?php if (isset($_GET["msg"]) && $_GET["msg"] == "newemail") { ?>

                            <div class='alert alert-success ctr'>
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                Votre email a bien été changé
                            </div>

                        <?php } ?>
                        <!-- Ervine SOLUTION pour résoudre PB d'envoyer un lien par mail-->
                        <?php if (isset($_SESSION["urlnewmail_peda"]) && $_GET["msg"] == "newemail") { ?>
                            <!--le lien concerné s'affiche sur le formulaire-->
                            <h2>Lien :</h2>
                            <div class='alert alert-success ctr'>
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                <?php echo '<a href="' . $_SESSION["urlnewmail_peda"] . '">Vérifier mon nouvel email</a>'; ?>
                            </div>

                        <?php } ?>
                        <?php if (isset($_GET["msg"]) && $_GET["msg"] == "errortoken") { ?>

                            <div class='alert alert-danger ctr'>
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                Une error s'est produite.
                            </div>

                        <?php } ?>
                    </form>
                    </hr>
                    <h1>Modifier mon mot de passe</h1>
                    <form id="changepassword-form" method="POST"
                          action="<?php echo get_template_directory_uri(); ?>/actiondev1.php?act=modifpasswordpeda">
                        <label for="expassword">Mon ancien mot de passe :</label>
                        <input type="password" id="expassword" name="expassword">
                        <br>
                        <label for="password1">Mon nouveau mot de passe :</label>
                        <input type="password" id="password1" name="password1">
                        <br>
                        <label for="password2">Retapez votre mot de passe :</label>
                        <input type="password" id="password2" name="password2">
                        <br><br>
                        <button class="bouttonconnex" type="submit">Modifier</button>
                    </form>

                    <?php if (isset($_GET["msg"]) && $_GET["msg"] == "passchange") { ?>

                        <div class='alert alert-success ctr'>
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                            Votre mot de passe a bien été changé
                        </div>

                    <?php } ?>
                    <?php if (isset($_GET["msg"]) && $_GET["msg"] == "errorsame") { ?>

                        <div class='alert alert-danger ctr'>
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                            Les 2 mots de passe doivent être identiques
                        </div>

                    <?php } ?>
                    <?php if (isset($_GET["msg"]) && $_GET["msg"] == "errorexpwd") { ?>

                        <div class='alert alert-danger ctr'>
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                            Votre ancien mot de passe est incorrecte
                        </div>

                    <?php } ?>

                </div>

                <div id="inseleveetab" role="tabpanel"
                     class="tab-pane <?php if (isset($_GET["ong"]) && $_GET["ong"] == "preinsc") {
                         echo "active";
                     } ?>">
                    <h1>Pré-inscrire et suivre un élève</h1>
                    <p>Vous pouvez inscrire un élève et même postuler aux stages à la place.</p>
                    <form id="inscrire-form" method="POST"
                          action="<?php echo get_template_directory_uri(); ?>/actiondev1.php?act=inscrireelvpeda">

                        <label for="useremailins">Adresse électronique de l'élève:</br><i>Un email sera envoyé à l'élève
                                pour l'activation de son compte. Vous pourrez toutefois postuler à la place de l'élève
                                même si son compte n'est pas encore actif</i></label>
                        <input type="text" id="useremailins" name="useremailins" class="colorblack">
                        <br><br>
                        <label for="usernomins">Nom de l'élève :</label>
                        <input type="text" id="usernomins" name="usernomins">
                        <br><br>
                        <label for="userprenomins">Prénom de l'élève :</label>
                        <input type="text" id="userprenomins" name="userprenomins">
                        <br><br>
                        <label for="userdatenaisins">Date de naissance de l'élève :</label>
                        <input type="date" id="userdatenaisins" name="userdatenaisins"/>
                        <br>
                        <br>
                        <label for="usersexe">Sexe de l'élève :</label>
                        <div class="displayflex usersexeradio">
                            <?php

                            $tabsexe = lstData("sexe");

                            foreach ($tabsexe as $value) {
                                ?>
                                <span class="radioclass marginright20"><input type="radio" name="usersexe"
                                                                              value="<?php echo $value["sex_id"]; ?>"/><?php echo($value["sex_lib"]); ?></span>

                                <?php

                            }

                            ?>
                        </div>
                        <br>
                        <label for="useretab">Etablissement scolaire de l'élève :</label>
                        <select id="useretab" class="colorblack width100" name="useretab">
                            <?php echo(BLst('uai', 'uai_rne', 'uai_lc', $tabarray["peda_uai"], "", "", "ee", "", "")); ?>
                        </select>

                        <br>
                        <label for="userclass">Niveau de l'élève :</label>
                        <select id="userclass" class="colorblack width100" name="userclass">
                            <?php echo(BLst('classe', 'class_id', 'class_lib', "", "", "", "ee", "", "")); ?>
                        </select>
                        <br>
                        <label for="userdiplome">Spécialité de l'élève (facultatif):</label>
                        <input type="text" id="userdiplome" name="userdiplome">

                        <br>
                        <br>
                        <button class="bouttonconnex" type="submit">Inscrire et suivre</button>
                    </form>
                    <?php if (isset($_GET["msg"]) && $_GET["msg"] == "suivgood") { ?>

                        <div class='alert alert-success ctr'>
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                            Vous suivez désormais cette élève
                        </div>

                    <?php } ?>
                    <?php if (isset($_GET["msg"]) && $_GET["msg"] == "registergood") { ?>

                        <div class='alert alert-success ctr'>
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                            L'élève a bien été inscrit, vous pouvez maintenant suivre sa progression ou postuler aux
                            stages à sa place
                        </div>

                    <?php } ?>
                    <?php if (isset($_GET["msg"]) && $_GET["msg"] == "alreadyregister") { ?>

                        <div class='alert alert-danger ctr'>
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                            Cette élève est déjà inscrit dans l'application, voulez-vous le suivre?
                            <form method="POST"
                                  action="<?php echo get_template_directory_uri(); ?>/actiondev1.php?act=suivreelv">
                                <input type="hidden" name="suivreelvid" value="<?php echo $_GET["elvid"]; ?>"/>
                                <input type='submit' class="btn btn-success" value="oui"/>
                                <button type='button' class='btn btn-danger' data-dismiss='alert'>non</button>

                            </form>

                        </div>

                    <?php } ?>

                </div>
                <div id="suiveleveetab" role="tabpanel"
                     class="tab-pane <?php if ((isset($_GET["ong"]) && $_GET["ong"] == "followlv")) {
                         echo "active";
                     } ?>">
                    <h1>Suivre un élève déjà inscrit sur la plateforme</h1>
                    <form id="suivi-form" method="POST"
                          action="<?php echo get_template_directory_uri(); ?>/actiondev1.php?act=searchlv">

                        <label for="rcheleve">Chercher un élève :</label>
                        <input type="hidden" id="ideleve" name="ideleve">
                        <input type="text" id="rcheleve" name="rcheleve" placeholder="Nom prénom">

                        <br>
                        <br>
                        <button class="bouttonconnex" type="submit">Suivre</button>

                        <?php if (isset($_GET["msg"]) && $_GET["msg"] == "lvfound") { ?>

                            <div class='alert alert-success ctr'>
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                Élève suivi !
                            </div>

                        <?php } ?>


                    </form>
                    <?php if (isset($_GET["msg"]) && $_GET["msg"] == "alreadysuiv") { ?>

                        <div class='alert alert-danger ctr'>
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                            Vous suivez déjà cette élève
                        </div>

                    <?php } ?>
                    <?php if (isset($_GET["msg"]) && $_GET["msg"] == "erroblg") { ?>

                        <div class='alert alert-danger ctr'>
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                            Pas d'élève recherché
                        </div>

                    <?php } ?>

                </div>
                <!-- list elv_suivi par un prof-->
                <div id="eleveetab" role="tabpanel"
                     class="tab-pane <?php if ((isset($_GET["ong"]) && $_GET["ong"] == "lstlv")) {
                         echo "active";
                     } ?>">
                    <table class="table width100" data-url="inc/json-inc.php?typ=listeeleve" data-toggle="table"
                           data-search="true" data-pagination="true" data-thead-classes="theadec">
                        <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Classe</th>
                            <th>Candidature en attente</th>
                            <th>Convention en attente</th>
                            <!--colonne voir plus-->
                            <th class="ctr">Voir</th>
                            <th class="ctr">Ne plus suivre</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php //ervine

                        $lstelv = lstData("lstlvsuivi", $peda_id);


                        foreach ($lstelv as $value) {

                            $elv_id = encryptIt($value["elv_id"], $_SESSION["hashsession"]);

                            ?>

                            <tr>
                                <th><?php echo($value["elv_nom"]); ?></th>
                                <th><?php echo($value["elv_pren"]); ?></th>
                                <th><?php echo($value["elv_class"]); ?></th>
                                <th>
                                    <?php

                                    $reccandcours = recData("candcours", $value["elv_id"]);

                                    echo $reccandcours["NB"];

                                    ?>
                                </th>
                                <th>
                                    <?php

                                    $recconvcours = recData("convcours", $value["elv_id"]);

                                    echo $recconvcours["NB"];

                                    ?>
                                </th>
                                <th><a href="#voireleve" class="btn btn-success" role="button" data-toggle="modal"
                                       data-id="<?php echo $elv_id; ?>"
                                       data-name="<?php echo($value["elv_nom"] . " " . $value["elv_pren"]); ?>"
                                       onClick="voireleve(this)"
                                       title="voir eleve"><i class="fa fa-eye"></i></a></th>
                                <th><a href="#deldata" class="btn btn-danger" role="button" data-toggle="modal"
                                       data-id="<?php echo $elv_id; ?>" data-typ="supprimerelv" onClick="aChpDel(this)"
                                       title="suppression"><i class="fa fa-trash-o"></i></a></th>

                            </tr>

                            <?php

                        }

                        ?>
                        </tbody>

                    </table>


                </div>

            </div>


        </div>


    <?php } else { ?>

        <!--form se connecter-->
        <div id="connexiondiv"
             class="formconnect <?php if (!isset($_GET["ong"]) or (isset($_GET["ong"]) && $_GET["ong"] == "connexion")) {
                 echo "windowopen";
             } else {
                 echo "windowclose";
             } ?>" data-heightmin="120" data-heightmax="360">
            <h1>Vous êtes déjà inscrit?</h1>
            <div class="bouttonconnex2 <?php if (!isset($_GET["ong"]) or (isset($_GET["ong"]) && $_GET["ong"] == "connexion")) echo "displaynone"; ?>"
                 onclick="connexiondiv();">Se connecter avec mes identifiants
            </div>
            <form id="login-form-peda" method="POST"
                  action="<?php echo get_template_directory_uri(); ?>/actiondev1.php?act=seconnecterpeda">
                <label for="useremail">Votre adresse électronique :</label>
                <input type="email" id="useremail" name="useremail" placeholder="xxxxxx@ac-polynesie.pf">
                <br>
                <label for="userpassword">Votre mot de passe :</label>
                <input type="password" id="userpassword" name="userpassword">
                <br>
                <label>
                    <input type="checkbox" checked="checked" name="remember" value="1"> Se souvenir de moi
                </label>
                <button class="bouttonconnex" type="submit">S'identifier</button>
                <?php if (isset($_GET["msg"]) && $_GET["msg"] == "errpassword") { ?>

                    <div class='alert alert-danger ctr'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        Cette identifiant ou ce mot de passe sont érronés.
                    </div>

                <?php } ?>
                <?php if (isset($_GET["msg"]) && $_GET["msg"] == "reinitok") { ?>

                    <div class='alert alert-success ctr'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        Votre mot de passe a bien été réinitialisé.
                    </div>

                <?php } ?>
                <?php if (isset($_GET["msg"]) && $_GET["msg"] == "errsuspens") { ?>

                    <div class='alert alert-danger ctr'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        Votre compte a été suspendu, veuillez contacter le DOI.
                    </div>

                <?php } ?>
            </form>
        </div>

        <!--form mdp oublier-->
        <div id="passwordforgetdiv"
             class="formconnect <?php if (isset($_GET["ong"]) && $_GET["ong"] == "passforget") {
                 echo "windowopen";
             } else {
                 echo "windowclose";
             } ?>" data-heightmin="190" data-heightmax="280">
            <h1>Vous avez oublié votre mot de passe?</h1>
            <div class="bouttonconnex2 <?php if (isset($_GET["ong"]) && $_GET["ong"] == "passforget") echo "displaynone"; ?>"
                 onclick="passwordforgetdiv();">Retrouvez mon mot de passe
            </div>
            <form id="passwordforget-form" method="POST"
                  action="<?php echo get_template_directory_uri(); ?>/actiondev1.php?act=forgetpasswordpeda">
                <label for="useremailrecup">Votre adresse électronique :</label>
                <input type="email" id="useremailrecup" name="useremailrecup">
                <br><br>
                <button class="bouttonconnex" type="submit">Envoyer</button>
                <?php if (isset($_GET["msg"]) && $_GET["msg"] == "sendgood") { ?>

                    <div class='alert alert-success ctr'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        Un email a été envoyé sur votre email avec le lien de réinitialisation de votre mot de
                        passe.
                    </div>

                <?php } ?>
                <!-- Ervine SOLUTION pour résoudre PB d'envoyer un lien par mail-->
                <?php if (isset($_SESSION["urlmdp_peda"]) && $_GET["msg"] == "sendgood") { ?>
                    <!--le lien concerné s'affiche sur le formulaire-->
                    <h2>Lien :</h2>
                    <div class='alert alert-success ctr'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <?php echo '<a href="' . $_SESSION["urlmdp_peda"] . '">Réinitialiser mon mot de passe</a>'; ?>
                    </div>

                <?php } ?>

                <?php if (isset($_GET["msg"]) && $_GET["msg"] == "errnomail") { ?>

                    <div class='alert alert-danger ctr'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        Cette email n'existe pas dans nos bases.
                    </div>

                <?php } ?>
            </form>
        </div>

        <!--form creat compte-->
        <div id="createaccountdiv" class="formconnect <?php if (isset($_GET["ong"]) && $_GET["ong"] == "create") {
            echo "windowopen";
        } else {
            echo "windowclose";
        } ?>" data-heightmin="170" data-heightmax="1050">
            <h1>Vous n'avez pas de compte?</h1>
            <div class="bouttonconnex2 <?php if (isset($_GET["ong"]) && $_GET["ong"] == "create") echo "displaynone"; ?>"
                 onclick="createaccountdiv();" href="">Créer un compte en tant qu'enseignant
            </div>
            <form id="createaccountpeda-form" method="POST"
                  action="<?php echo get_template_directory_uri(); ?>/actiondev1.php?act=registerpeda">
                <label>Vous souhaitez que vos élèves trouvent un stage de qualité. Cet outil vous permettra
                    d'accéder à un tableau de suivi de vos élèves tout au long de leurs recherches de leur stage.
                    Vous ne pourrez vous inscrire qu'avec <span
                            style="color:red;">une adresse en ac-polynesie.pf</span>.</label>
                <i>Sauf mention contraire, tous les champs sont obligatoires.</i>
                <br><br>
                <label for="useremailcrea">Votre adresse électronique :</label>
                <input type="text" id="useremailcrea" name="useremailcrea" class="colorblack"
                       placeholder="xxxxxx@ac-polynesie.pf">
                <br>

                <label for="usernom">Votre nom :</label>
                <input type="text" id="usernom" name="usernom">
                <br>
                <label for="userprenom">Votre prénom :</label>
                <input type="text" id="userprenom" name="userprenom">
                <br>
                <label for="useretab">Votre établissement scolaire :</label>
                <select id="useretab" class="colorblack width100" name="useretab">
                    <?php echo(BLst('uai', 'uai_rne', 'uai_lc', "", "", "", "ee", "", "")); ?>
                </select>
                <br>
                <br>
                <label for="password1">Tapez un mot de passe :</label>
                <input type="password" id="password1" name="password1">
                <br>
                <label for="password2">Retapez le mot de passe :</label>
                <input type="password" id="password2" name="password2">
                <br>
                <label for="password2"><input type="checkbox" id="checkcond" name="checkcond"> j'accepte les conditions
                    générales d'utilisations de mes données (<a target=_blank
                                                                href="<?php echo get_site_url(); ?>/conditions-generales-dutilisation-cgu/">voir
                        les conditions ici</a>):</label>
                <br>
                <br>
                <button class="bouttonconnex" type="submit">Valider</button>
            </form>
            <?php if (isset($_GET["msg"]) && $_GET["msg"] == "errorsame") { ?>

                <div class='alert alert-danger ctr'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    Les 2 mots de passe sont différents.
                </div>

            <?php } ?>

            <?php if (isset($_GET["msg"]) && $_GET["msg"] == "mailsend") { ?>

                <div class='alert alert-success ctr'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    Un email d'activation a été envoyé sur votre email, veuillez consulter votre boite électronique.
                    Pour activer votre compte, cliquez sur le lien d'activation.
                </div>

            <?php } ?>

            <!-- Ervine SOLUTION pour résoudre PB d'envoyer un lien par mail-->
            <?php if (isset($_SESSION["urlcrea_peda"]) && $_GET["msg"] == "mailsend") { ?>
                <!--le lien concerné s'affiche sur le formulaire-->
                <h2>Lien :</h2>
                <div class='alert alert-success ctr'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <?php echo '<a href="' . $_SESSION["urlcrea_peda"] . '">Activer mon compte</a>'; ?>
                </div>

            <?php } ?>

            <?php if (isset($_GET["msg"]) && $_GET["msg"] == "errormail") { ?>
                <div class='alert alert-danger ctr'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    L'e-mail doit se terminer par "ac-polynesie.pf".
                </div>
            <?php } ?>

        </div>

        <!--form renvoie msg activ-->
        <div id="messageactivediv" class="formconnect <?php if (isset($_GET["ong"]) && $_GET["ong"] == "resend") {
            echo "windowopen";
        } else {
            echo "windowclose";
        } ?>" data-heightmin="170" data-heightmax="390">
            <h1>Vous n’avez pas reçu le message d'activation ?</h1>
            <div class="bouttonconnex2 <?php if (isset($_GET["ong"]) && $_GET["ong"] == "resend") echo "displaynone"; ?>"
                 onclick="messageactivediv();">Renvoyer le message d'activation
            </div>
            <form id="messageactive-form" method="POST"
                  action="<?php echo get_template_directory_uri(); ?>/actiondev1.php?act=messageactivepeda">
                <label>Pour finaliser votre inscription, nous devons d’abord vérifier votre identité.</label>
                <label>Pour cela indiquez-nous l’adresse électronique associée à votre compte.</label>
                <label for="useremailresend">Votre adresse électronique :</label>
                <input type="email" id="useremailresend" name="useremailresend">
                <br><br>
                <button class="bouttonconnex" id="" type="submit">Renvoyer</button>

                <?php if (isset($_GET["msg"]) && $_GET["msg"] == "errtoken") { ?>

                    <div class='alert alert-danger ctr'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        Votre compte n'est pas encore actif. Vous devez cliquer sur le lien envoyé sur votre email
                        pour activer votre compte. Si vous n'avez pas reçu d'email, vous pouvez le renvoyer ici.
                    </div>

                <?php } ?>
                <?php if (isset($_GET["msg"]) && $_GET["msg"] == "noactivetoken") { ?>

                    <div class='alert alert-danger ctr'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        Une error s'est produite.
                    </div>

                <?php } ?>
                <?php if (isset($_GET["msg"]) && $_GET["msg"] == "resendgood") { ?>

                    <div class='alert alert-success ctr'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        Un email d'activation a été envoyé sur votre email, veuillez consulter votre boite
                        électronique. Pour activer votre compte, cliquez sur le lien d'activation.
                    </div>

                <?php } ?>
                <!-- Ervine SOLUTION pour résoudre PB d'envoyer un lien par mail-->
                <?php if (isset($_SESSION["urlresend_peda"]) && $_GET["msg"] == "resendgood") { ?>
                    <!--le lien concerné s'affiche sur le formulaire-->
                    <h2>Lien :</h2>
                    <div class='alert alert-success ctr'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <?php echo '<a href="' . $_SESSION["urlresend_peda"] . '">Activer mon compte</a>'; ?>
                    </div>

                <?php } ?>


                <?php if (isset($_GET["msg"]) && $_GET["msg"] == "errnomail2") { ?>

                    <div class='alert alert-danger ctr'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        Cette email n'existe pas dans nos bases.
                    </div>

                <?php } ?>
            </form>
        </div>

    <?php } ?>

    <script>
        jQuery(document).ready(function ($) {
            <?php if(isset($_GET["showelv"])){ ?>

            $('#voireleve').modal('show');
            <?php } ?>
        })
    </script>
</section>

<!--recup info_avada-->
<?php do_action('avada_after_content'); ?>
<!--recup footer-->
<?php get_footer(); ?>
<!--modal.php = page confirma°-->
<?php include("modal.php"); ?>
