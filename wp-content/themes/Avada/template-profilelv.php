<?php
/**
 * Template Name: profil eleve
 * Description: Pages de profil élève
 */
//definis le nom du template à enregistrer sur wp // tab_bord> avada_builder> Attribut de page> Modèle>

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

    if (lgchkelv()) { //si usr_lv
        //recup id déchiffré du usr_lv //func decrypt permet déchiffré une session chiffré -> fonction.php
        $elv_id = decryptIt($_SESSION["elv_id"], $_SESSION["hashsession"]);
        //recup toutes les infos d'un elv//fonc° recData utilisé pour récup les données dans BDD -> fonction.php
        $tabarray = recData("eleve", $elv_id);

        $tabnotifcand1 = recData("elevenotificationcand1", $elv_id);
        $tabnotifcand2 = recData("elevenotificationcand2", $elv_id);
        $tabnotifcand3 = recData("elevenotificationcand3", $elv_id);
        $tabnotifconv = recData("elevenotificationconv", $elv_id);

        ?>
        <!--msg qui s'affiche après avoir cliqué sur le lien d'activation-->
        <?php if (isset($_GET["msg"]) && $_GET["msg"] == "verified") { ?>

            <div class='alert alert-success ctr'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                Votre compte a bien été vérifié, bienvenue, <?php echo $_SESSION['elv_mail']; ?>.
            </div>

        <?php } ?>
        <!--si il existe un msg et que le msg envoyé est "connected" alors affiche "bienvenue 'usr_lv'" //info visible dans l'url du site-->
        <?php if (isset($_GET["msg"]) && $_GET["msg"] == "connected") { ?>
            <!--div-bootstrap-->
            <div class='alert alert-success ctr'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                Bienvenue , <?php echo $_SESSION['elv_mail']; ?>.
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
                        <a class="nav-link <?php if (isset($_GET["ong"]) && $_GET["ong"] == "info") {
                            echo "active";
                        } ?>" data-toggle="tab" role="tab" aria-controls="informationtab"
                           aria-selected="false" href="#informationtab">Mes informations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if (isset($_GET["ong"]) && $_GET["ong"] == "cv") {
                            echo "active";
                        } ?>" data-toggle="tab" role="tab" aria-controls="moncvtab"
                           aria-selected="false" href="#moncvtab">Mon CV</a>
                    </li>

                    <li class="nav-item" onclick="viewnotifcandelv1()">
                        <a class="nav-link <?php if (isset($_GET["ong"]) && $_GET["ong"] == "3eme") {
                            echo "active";
                        } ?>" data-toggle="tab" role="tab" aria-controls="troisemetab"
                           aria-selected="false" href="#troisemetab">Mes candidatures 3ème
                            <?php

                            if ($tabnotifcand1["NB"] > 0) {

                                ?>
                                <span id="notificationcand1"><i class="fa fa-bell fontsize17px animateringring"
                                                                aria-hidden="true"></i><?php echo $tabnotifcand1["NB"]; ?></Span>
                                <?php

                            }

                            ?>
                        </a>
                    </li>
                    <li class="nav-item" onclick="viewnotifcandelv2()">
                        <a class="nav-link <?php if (isset($_GET["ong"]) && $_GET["ong"] == "pfmp") {
                            echo "active";
                        } ?>" data-toggle="tab" role="tab" aria-controls="pfmptab"
                           aria-selected="false" href="#pfmptab">Mes candidatures PFMP
                            <?php

                            if ($tabnotifcand2["NB"] > 0) {

                                ?>
                                <span id="notificationcand2"><i class="fa fa-bell fontsize17px animateringring"
                                                                aria-hidden="true"></i><?php echo $tabnotifcand2["NB"]; ?></Span>
                                <?php

                            }

                            ?>
                        </a>
                    </li>
                    <li class="nav-item" onclick="viewnotifcandelv3()">
                        <a class="nav-link <?php if (isset($_GET["ong"]) && $_GET["ong"] == "bts") {
                            echo "active";
                        } ?>" data-toggle="tab" role="tab" aria-controls="btstab"
                           aria-selected="false" href="#btstab">Mes candidatures BTS
                            <?php

                            if ($tabnotifcand3["NB"] > 0) {

                                ?>
                                <span id="notificationcand3"><i class="fa fa-bell fontsize17px animateringring"
                                                                aria-hidden="true"></i><?php echo $tabnotifcand3["NB"]; ?></Span>
                                <?php

                            }

                            ?>
                        </a>
                    </li>
                    <li class="nav-item" onclick="viewnotifconvelv()">
                        <a class="nav-link <?php if (isset($_GET["ong"]) && $_GET["ong"] == "convention") {
                            echo "active";
                        } ?>" data-toggle="tab" role="tab" aria-controls="conventionstab" aria-selected="false"
                           href="#conventionstab">Conventions
                            <?php

                            if ($tabnotifconv["NB"] > 0) {

                                ?>
                                <span id="notificationconv"><i class="fa fa-bell fontsize17px animateringring"
                                                               aria-hidden="true"></i><?php echo $tabnotifconv["NB"]; ?></Span>
                                <?php

                            }

                            ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link deconnexion" onclick="sedeconnecter()">Se déconnecter</a>
                    </li>
                </ul>
            </header>
            <div class="tab-content col-md-9" id="myTabContent">
                <!--initialise ce bloc en un 'onglet'='profil' // bloc profil_elv-->
                <div id="profiltab" role="tabpanel"
                     class="tab-pane <?php if (!isset($_GET["ong"]) or (isset($_GET["ong"]) && $_GET["ong"] == "profil")) {
                         echo "active";
                     } ?>">
                    <h1>Modifier mon adresse électronique</h1>
                    <!-- redirige vers url '/actiondev1.php?act=modifmailelv' en cas de modif_mail//en bref appel ma fonction 'modifmailelv'-->
                    <form id="changemail-form" method="POST"
                          action="<?php echo get_template_directory_uri(); ?>/actiondev1.php?act=modifmailelv">
                        <label for="useremail">Mon adresse électronique actuel :</label>
                        <input type="email" disabled id="useremail" name="useremail"
                               value="<?php echo $tabarray["elv_mail"]; ?>">
                        <br>
                        <label for="useremailnew">Ma nouvelle adresse électronique :</label>
                        <input type="email" id="useremailnew" name="useremailnew">
                        <br>
                        <br>
                        <button class="bouttonconnex" type="submit">Enregistrer</button>
                        <!--msg qui s'affiche après avoir cliqué sur le btn// div bootstrap-->
                        <?php if (isset($_GET["msg"]) && $_GET["msg"] == "mailsend") { ?>

                            <div class='alert alert-success ctr'>
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                Un email a été envoyé sur votre nouvelle boite mail. Pour confirmer votre nouvelle
                                adresse email, cliquez sur le lien d'activation
                            </div>

                        <?php } ?>
                        <!-- Ervine SOLUTION pour résoudre PB d'envoyer un lien par mail-->
                        <?php if (isset($_SESSION["urlnewmail_elv"]) && $_GET["msg"] == "mailsend") { ?>
                            <h2>Cliquez ici pour :</h2>
                            <div class='alert alert-success ctr'>
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                <?php echo '<a href="' . $_SESSION["urlnewmail_elv"] . '">Confirmer votre nouvel email</a>'; ?>
                            </div>

                        <?php } ?>
                        <!--msg qui s'affiche si il l'email a bien été changé // div bootstrap-->
                        <?php if (isset($_GET["msg"]) && $_GET["msg"] == "newemail") { ?>

                            <div class='alert alert-success ctr'>
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                Votre email a bien été changé
                            </div>

                        <?php } ?>
                        <!--msg qui s'affiche si il une erreur s'est prduite // div bootstrap-->
                        <?php if (isset($_GET["msg"]) && $_GET["msg"] == "errortoken") { ?>

                            <div class='alert alert-danger ctr'>
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                Une error s'est produite.
                            </div>

                        <?php } ?>
                    </form>
                    </hr>
                    <h1>Modifier mon mot de passe</h1>
                    <!-- redirige vers url '/actiondev1.php?act=modifpasswordelv' en cas de modif_mdp//en bref appel ma fonction 'modifpasswordelv'-->
                    <form id="changepassword-form" method="POST"
                          action="<?php echo get_template_directory_uri(); ?>/actiondev1.php?act=modifpasswordelv">
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
                    <!-- important de mettre cette condition après le btn/ si le msg est 'passchange' alors... -->
                    <?php if (isset($_GET["msg"]) && $_GET["msg"] == "passchange") { ?>

                        <div class='alert alert-success ctr'>
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                            Votre mot de passe a bien été changé
                        </div>

                    <?php } ?>
                    <!--msg qui s'affiche si quand les mdp PAS identique // div bootstrap-->
                    <?php if (isset($_GET["msg"]) && $_GET["msg"] == "errorsame") { ?>

                        <div class='alert alert-danger ctr'>
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                            Les 2 mots de passe doivent être identiques
                        </div>

                    <?php } ?>
                    <!--msg qui s'affiche si l'ancien mdp tapé n'est pas le bon // div bootstrap-->
                    <?php if (isset($_GET["msg"]) && $_GET["msg"] == "errorexpwd") { ?>

                        <div class='alert alert-danger ctr'>
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                            Votre ancien mot de passe est incorrecte
                        </div>

                    <?php } ?>

                </div>
                <!--initialise ce bloc en un 'onglet'='info' // bloc info_elv-->
                <div id="informationtab" role="tabpanel"
                     class="tab-pane <?php if (isset($_GET["ong"]) && $_GET["ong"] == "info") {
                         echo "active";
                     } ?>">
                    <!-- redirige vers url '/actiondev1.php?act=modifinfoelv' en cas de modif_info_lv //en bref appel ma fonction 'modifinfoelv'-->
                    <form id="modifinfo-form" method="POST"
                          action="<?php echo get_template_directory_uri(); ?>/actiondev1.php?act=modifinfoelv">
                        <h1>Modifier mes informations</h1>
                        <div class="row">
                            <div class="col-md-6">

                                <label class="col-md-12" for="username">Nom :</label>
                                <input class="col-md-10" type="text" id="username" name="username"
                                       value="<?php echo $tabarray["elv_nom"]; ?>"/>
                                <br>
                            </div>

                            <div class="col-md-6">
                                <label class="col-md-12" for="userprename">prénom :</label>
                                <input class="col-md-10" type="text" id="userprename" name="userprename"
                                       value="<?php echo $tabarray["elv_pren"]; ?>"/>

                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="col-md-12" for="usertel">Téléphone :</label>
                                <input class="col-md-10" type="text" id="usertel" name="usertel"
                                       value="<?php echo $tabarray["elv_tel"]; ?>"/>
                                <br>
                            </div>


                            <div class="col-md-6">
                                <label class="col-md-12" for="userdatenais">Date de naissance :</label>
                                <div class="input-group date col-md-10" id="ddnais">
                                    <input type="text" name="chpddnais" id="chpddnais" class="form-control"
                                           value="<?php echo fDate($tabarray["elv_datenaiss"], "html"); ?>">
                                    <span class="input-group-addon btn-primary smallradio padding5"><i
                                                class="fa fa-calendar"></i></span>
                                </div>
                                <br>
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="col-md-12" for="usersexe">Sexe :</label>
                                <select class="col-md-10 colorblack" id="usersexe" name="usersexe">
                                    <!-- affichage des champs de bdd en liste-option//fonc BLst->function.php-->
                                    <?php echo(BLst('sexe', 'sex_id', 'sex_lib', $tabarray["elv_sexe"], "", "", "", "", "")); ?>
                                </select>

                            </div>
                            <div class="col-md-6">
                                <label class="col-md-12" for="usercommune">Commune :</label>
                                <select class="col-md-10 colorblack" id="usercommune" name="usercommune">
                                    <!-- affichage des champs de bdd en liste-option//fonc BLst->function.php-->
                                    <?php echo(BLst('commune', 'IDGeo', 'Geo', $tabarray["elv_com"], "", "", "", "", "")); ?>
                                </select>

                            </div>

                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="col-md-12" for="usergeo">Adresse géographique :</label>
                                <input class="col-md-10" type="text" id="usergeo" name="usergeo"
                                       value="<?php echo $tabarray["elv_adr"]; ?>">

                            </div>
                            <div class="col-md-6">
                                <label class="col-md-12" for="useretab">Etablissement Scolaire fréquenté :</label>
                                <select id="useretab" class="colorblack col-md-10" name="useretab">
                                    <?php echo(BLst('uai', 'uai_rne', 'uai_lc', $tabarray["elv_uai"], "", "", "", "", "")); ?>
                                </select>
                                <br>
                            </div>


                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="col-md-12" for="userclass">Classe:</label>
                                <select id="userclass" class="colorblack col-md-10" name="userclass">
                                    <?php echo(BLst('classe', 'class_id', 'class_lib', $tabarray["elv_class"], "", "", "", "", "")); ?>
                                </select>
                                <br>
                            </div>
                            <div class="col-md-6">
                                <label class="col-md-12" for="userdiplome">Spécialité :</label>
                                <input class="col-md-10" type="text" id="userdiplome" name="userdiplome"
                                       value="<?php echo $tabarray["elv_diplome"]; ?>"/>

                            </div>
                        </div>
                        <br>
                        <div class="row">

                            <div class="col-md-6">
                                <label class="col-md-12" for="userine">Votre numéro INE :</br><i>Comment trouver mon
                                        numéro INE? <a href="https://applications.education.pf/ine/" target=_blank
                                                       class="colorblue">Cliquez ici</a></i></label>
                                <input class="col-md-10" type="text" id="userine" name="userine"
                                       value="<?php echo $tabarray["elv_ine"]; ?>"/>

                            </div>
                        </div>
                        <br>
                        <br>
                        <button class="bouttonconnex" type="submit">Modifier</button>
                        <!-- si des modifs ont été faites alors..-->
                        <?php if (isset($_GET["msg"]) && $_GET["msg"] == "infochange") { ?>

                            <div class='alert alert-success ctr'>
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                Vos informations ont bien été changé
                            </div>

                        <?php } ?>
                    </form>
                </div>

                <!--ong cv-->
                <div id="moncvtab" role="tabpanel"
                     class="tab-pane <?php if (isset($_GET["ong"]) && $_GET["ong"] == "cv") {
                         echo "active";
                     } ?>">
                    <!-- on utilise  enctype="multipart/form-data" pour envoyer des images via un formulaire -->
                    <form id="modifcv-form" enctype="multipart/form-data" method="POST"
                          action="<?php echo get_template_directory_uri(); ?>/actiondev1.php?act=modifcvelv">
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Votre curriculum vitae</h3>
                                <label for="userexp">Expériences professionnels précédentes (Facultatif) :</label>
                                <textarea id="userexp" name="userexp" rows="6"
                                          class="form-control"><?php echo $tabarray["elv_cv"]; ?></textarea>
                                <br>
                            </div>
                            <div class="col-md-6 smallradio">
                                <div class="fenetreconseil">
                                    <div class="fenetreconseilgauche">
                                        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                    </div>
                                    <div class="fenetreconseildroite">
                                        <h3 class="fenetreconseil_title">Conseil</h3>
                                        <p>Si vous avez effectué d'autres stages ou avez de l'expérience dans le
                                            domaine du stage demandé. Vous pouvez l'ajouter ici pour motiver
                                            l'entreprise</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="useractivite">Activités extra-scolaires (Facultatif) :<i>Sports,
                                        loisirs, engagements associatifs, etc.</i></label>
                                <textarea id="useractivite" name="useractivite" rows="6"
                                          class="form-control"><?php echo $tabarray["elv_activite"]; ?></textarea>
                                <br>
                            </div>
                            <div class="col-md-6 smallradio">
                                <div class="fenetreconseil">
                                    <div class="fenetreconseilgauche">
                                        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                    </div>
                                    <div class="fenetreconseildroite">
                                        <h3 class="fenetreconseil_title">Conseil</h3>
                                        <p>Si vous avez effectué des activités sportifs, des loisirs ou autres pour
                                            montrer vos centres d'intérêts</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="userlangue">Langues vivantes :<i>Langues étudiées et/ou
                                        parlées</i></label>
                                <textarea id="userlangue" name="userlangue"
                                          class="form-control"><?php echo $tabarray["elv_lang"]; ?></textarea>
                                <br>
                            </div>

                        </div>

                        <hr>
                        <!-- div correspondant au dépôt de fichier (pdf) // img d'un CV-->
                        <div class="form-group row">
                            <label class="control-label col-md-4" for="chpnum">Téléverser mon cv (Facultatif)
                                (format pdf)</label>
                            <div class="col-lg-4"><input type="file" name="cveleve" id="cveleve"
                                                         class="form-control"/></div>
                            <?php

                            //en bref, si il existe déjà un CV du usr_lv (dans bdd>elv) > affiche un curseur supprimer cv
                            if ($tabarray["elv_cvpdf"] != "" and $tabarray["elv_cvpdf"] != null) {

                                ?>
                                <div class="col-lg-4">
                                    <div class="suppcv cursorpointer btn btn-danger" onclick="supprimercvelv()"><i
                                                class="fa fa-trash" aria-hidden="true"></i> Supprimer mon CV
                                    </div>
                                </div>
                                <?php

                            }

                            ?>
                        </div>

                        <?php
                        //en bref, si il existe déjà un CV du usr_lv (dans bdd>elv) > affiche l'image en question //lien de l'img du cv enregistré
                        if ($tabarray["elv_cvpdf"] != "" and $tabarray["elv_cvpdf"] != null) {

                            ?>
                            <embed src="<?php echo get_site_url(); ?>/wp-content/uploads/cvpdf/<?php echo $tabarray["elv_cvpdf"]; ?>"
                                   width="100%" height="700px" type="application/pdf">

                            <?php

                        }

                        ?>
                        <button class="bouttonconnex" type="submit">Modifier</button>
                        <!--si le cv à changer et msg='cvchange'..-->
                        <?php if (isset($_GET["msg"]) && $_GET["msg"] == "cvchange") { ?>

                            <div class='alert alert-success ctr'>
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                Votre cv a bien été changé
                            </div>

                        <?php } ?>
                    </form>
                </div>

                <!-- ong stage3e-->
                <div id="troisemetab" role="tabpanel"
                     class="tab-pane offrecontentclass <?php if (isset($_GET["ong"]) && $_GET["ong"] == "3eme") {
                         echo "active";
                     } ?>">
                    <!-- si elv3e a compléter son formulaire pour une offre alors..-->
                    <?php if (isset($_GET["msg"]) && $_GET["msg"] == "candidated1") { ?>

                        <div class='alert alert-success ctr'>
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                            Votre candidature est complète
                        </div>

                    <?php } ?>
                    <!-- si elv3e a supprimer sa candidature pur une offre alors..-->
                    <?php if (isset($_GET["msg"]) && $_GET["msg"] == "suppgood1") { ?>

                        <div class='alert alert-danger ctr'>
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                            Votre candidature a été supprimé
                        </div>

                    <?php } ?>

                    <!-- liste stage3e profilelv-->
                    <table class="table width100" data-toggle="table" data-search="true" data-pagination="true"
                           data-thead-classes="theadec">
                        <thead>
                        <tr>
                            <th>Intitulé du stage</th>
                            <th>Période du stage</th>
                            <th>Statut</th>
                            <th>Action(s)</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        //func lstData ("case:",var de référence) récup les infos candidature3e du usr_lv//voir dans func.php
                        $lstcand3eme = lstData("candidature3eme", $elv_id);

                        foreach ($lstcand3eme as $value) {

                            //encode l'id_candid
                            $candhash = encryptIt($value["cand_id"], $_SESSION["hashsession"]);

                            $candidaturesuspend = "";
                            if ($value["suspend"] == "1") $candidaturesuspend = "candidaturesuspend";

                            ?>

                            <tr class="<?php echo $candidaturesuspend; ?>">
                                <!-- recup dans bdd la val du chmp "metier" du stage-->
                                <th><?php echo($value["metier"]); ?></th>
                                <th>
                                    <?php

                                    //dispo = disponibilité du stage (1=an, 2=nbsemaine, 3=entre2date)//recup dans bdd
                                    if ($value["dispo"] == "1" or $value["dispo"] == "3") {

                                        //si dipo=1 ou =3 récup les dates du stage
                                        echo fDate($value["date_deb"], "html") . " - " . fDate($value["date_fin"], "html");

                                    } else {

                                        //nb de semaine requis sur la candidature
                                        $weeks = getWeek();

                                        foreach ($weeks as $week) {

                                            if ($week[0] == $value["semaine"]) {

                                                ?>
                                                <!-- affiche sur profilelv les dates stages -->
                                                <p>Semaine <?php echo $week[0]; ?> - du <?php echo $week[1]; ?>
                                                    au <?php echo $week[2]; ?></p>

                                                <?php

                                            }
                                        }

                                    }

                                    ?>
                                </th>
                                <th>
                                    <?php

                                    if ($value["statut"] == "3") {

                                        if ($value["ent_ok"] == "0") {


                                            echo '<span class="colorred">en attente de la signature de l\'entreprise</span>';

                                        } else {

                                            if ($value["elv_ok"] == "0") {

                                                echo '<a href="' . get_site_url() . '/modifier-convention/?cand=' . $candhash . '#entsignaturesign" class="colorred">en attente de votre signature</span>';

                                            } else {

                                                if ($value["ref_ok"] == "0") {

                                                    echo '<span class="colorred">en attente de la signature du référent</span>';

                                                } else {

                                                    if ($value["prof_ok"] == "0") {

                                                        echo '<span class="colorred">en attente de la signature du professeur principale</span>';

                                                    } else {

                                                        if ($value["etab_ok"] == "0") {

                                                            echo '<span class="colorred">en attente de la signature du chef d\'établissement</span>';

                                                        } else {

                                                            echo '<span class="colorgreen">Signé</span>';

                                                        }

                                                    }

                                                }

                                            }

                                        }


                                    } else {

                                        //typ de réponse possible à la candidature
                                        if ($value["statut"] == "1") echo "en attente";
                                        else if ($value["statut"] == "2") echo "Incomplète";
                                        else if ($value["statut"] == "3") echo "Accepté";
                                        else if ($value["statut"] == "4") echo "Refusé";
                                        else echo 'Non finalisé';
                                    }
                                    ?>
                                </th>
                                <th>

                                    <?php


                                    if ($value["suspend"] == "0") {


                                        //si candid Accepté pour tel-tel stage > affiche icon pour pouvoir déposer sa convention
                                        if ($value["statut"] == "3") {

                                            ?>

                                            <a class="btn btn-primary"
                                               href="<?php echo get_site_url(); ?>/modifier-convention/?cand=<?php echo $candhash; ?>"><i
                                                        class="fa fa-pencil" aria-hidden="true"></i></a>

                                            <a target=blank
                                               href="<?php echo get_template_directory_uri(); ?>/print_convention.php?cand=<?php echo $candhash; ?>"
                                               class="btn btn-info"><i class="fa fa-print"></i></a>


                                            <?php
                                            //si candid Refusé pour tel-tel stage > affiche icon pour pouvoir retourner sur page_candid
                                        } else if ($value["statut"] == "4") {

                                            ?>

                                            <a target=_blank class="btn btn-warning"
                                               href="<?php echo get_site_url(); ?>/voir-candidature/?cand=<?php echo $candhash; ?>"><i
                                                        class="fa fa-eye" aria-hidden="true"></i></a>

                                            <?php

                                        } else {

                                            //sinon affiche icon possible de postuler ou supprimer pour tel-tel candidature
                                            ?>

                                            <a class="btn btn-primary"
                                               href="<?php echo get_site_url(); ?>/postuler/?cand=<?php echo $candhash; ?>"><i
                                                        class="fa fa-pencil" aria-hidden="true"></i></a>
                                            <a href="#deldata" class="btn btn-danger" role="button" data-toggle="modal"
                                               data-id="<?php echo $candhash; ?>" data-typ="supprimercand2"
                                               onClick="aChpDel(this)" title="suppression"><i class="fa fa-trash-o"></i></a>

                                        <?php }

                                    } else {

                                        echo "Le compte de l'entreprise a été suspendu temporairement";


                                    }

                                    ?>
                                </th>

                            </tr>

                            <?php

                        }

                        ?>
                        </tbody>
                    </table>
                </div>

                <!-- ong pfmp-->
                <div id="pfmptab" role="tabpanel"
                     class="tab-pane offrecontentclasspfmp <?php if (isset($_GET["ong"]) && $_GET["ong"] == "pfmp") {
                         echo "active";
                     } ?>">
                    <?php if (isset($_GET["msg"]) && $_GET["msg"] == "candidated2") { ?>

                        <div class='alert alert-success ctr'>
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                            Votre candidature est complète
                        </div>

                    <?php } ?>
                    <?php if (isset($_GET["msg"]) && $_GET["msg"] == "suppgood2") { ?>

                        <div class='alert alert-danger ctr'>
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                            Votre candidature a été supprimé
                        </div>

                    <?php } ?>
                    <!-- liste PFMP profilelv-->
                    <table class="table width100" data-toggle="table" data-search="true" data-pagination="true"
                           data-thead-classes="theadec">
                        <thead>
                        <tr>
                            <th>Intitulé du stage</th>
                            <th>Période du stage</th>
                            <th>Statut</th>
                            <th>Action(s)</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        //func lstData ("case:",var de référence) récup les infos candidaturepfmp du usr_lv//voir dans func.php
                        $lstcandpfmp = lstData("candidaturepfmp", $elv_id);

                        foreach ($lstcandpfmp as $value) {
                            //encode l'id_candid
                            $candhash = encryptIt($value["cand_id"], $_SESSION["hashsession"]);

                            $candidaturesuspend = "";
                            if ($value["suspend"] == "1") $candidaturesuspend = "candidaturesuspend";

                            ?>

                            <tr class="<?php echo $candidaturesuspend; ?>">
                                <!-- recup dans bdd la val du chmp "metier" du PFMP-->
                                <th><?php echo($value["metier"]); ?></th>
                                <th>
                                    <?php

                                    //dispo = disponibilité du stage (1=an, 2=nbsemaine, 3=entre2date)//recup dans bdd
                                    if ($value["dispo"] == "1" or $value["dispo"] == "3") {

                                        //si dipo=1 ou =3 affiche récup dates de PFMP
                                        echo fDate($value["date_deb"], "html") . " - " . fDate($value["date_fin"], "html");

                                    } else {

                                        //nb de semaine requis sur la candidature
                                        $weeks = getWeek();

                                        foreach ($weeks as $week) {

                                            if ($week[0] == $value["semaine"]) {

                                                ?>
                                                <!-- affiche sur profilelv les dates PFMP -->
                                                <p>Semaine <?php echo $week[0]; ?> - du <?php echo $week[1]; ?>
                                                    au <?php echo $week[2]; ?></p>

                                                <?php

                                            }
                                        }

                                    }

                                    ?>
                                </th>
                                <th>
                                    <?php

                                    if ($value["statut"] == "3") {

                                        if ($value["ent_ok"] == "0") {


                                            echo '<span class="colorred">en attente de la signature de l\'entreprise</span>';

                                        } else {

                                            if ($value["elv_ok"] == "0") {

                                                echo '<a href="' . get_site_url() . '/modifier-convention/?cand=' . $candhash . '#entsignaturesign" class="colorred">en attente de votre signature</span>';

                                            } else {

                                                if ($value["ref_ok"] == "0") {

                                                    echo '<span class="colorred">en attente de la signature du référent</span>';

                                                } else {

                                                    if ($value["prof_ok"] == "0") {

                                                        echo '<span class="colorred">en attente de la signature du professeur principale</span>';

                                                    } else {

                                                        if ($value["etab_ok"] == "0") {

                                                            echo '<span class="colorred">en attente de la signature du chef d\'établissement</span>';

                                                        } else {

                                                            echo '<span class="colorgreen">Signé</span>';

                                                        }

                                                    }

                                                }

                                            }

                                        }


                                    } else {

                                        //typ de réponse possible à la candidature
                                        if ($value["statut"] == "1") echo "en attente";
                                        else if ($value["statut"] == "2") echo "Incomplète";
                                        else if ($value["statut"] == "3") echo "Accepté";
                                        else if ($value["statut"] == "4") echo "Refusé";
                                        else echo 'Non finalisé';
                                    }
                                    ?>
                                </th>
                                <!--btn postuler et supp candid_PFMP-->
                                <th>

                                    <?php


                                    if ($value["suspend"] == "0") {


                                        //si candid Accepté pour tel-tel stage > affiche icon pour pouvoir déposer sa convention
                                        if ($value["statut"] == "3") {

                                            ?>

                                            <a class="btn btn-primary"
                                               href="<?php echo get_site_url(); ?>/modifier-convention/?cand=<?php echo $candhash; ?>"><i
                                                        class="fa fa-pencil" aria-hidden="true"></i></a>

                                            <a target=blank
                                               href="<?php echo get_template_directory_uri(); ?>/print_convention.php?cand=<?php echo $candhash; ?>"
                                               class="btn btn-info"><i class="fa fa-print"></i></a>


                                            <?php
                                            //si candid Refusé pour tel-tel stage > affiche icon pour pouvoir retourner sur page_candid
                                        } else if ($value["statut"] == "4") {

                                            ?>

                                            <a target=_blank class="btn btn-warning"
                                               href="<?php echo get_site_url(); ?>/voir-candidature/?cand=<?php echo $candhash; ?>"><i
                                                        class="fa fa-eye" aria-hidden="true"></i></a>

                                            <?php

                                        } else {

                                            //sinon affiche icon possible de postuler ou supprimer pour tel-tel candidature
                                            ?>

                                            <a class="btn btn-primary"
                                               href="<?php echo get_site_url(); ?>/postuler/?cand=<?php echo $candhash; ?>"><i
                                                        class="fa fa-pencil" aria-hidden="true"></i></a>
                                            <a href="#deldata" class="btn btn-danger" role="button" data-toggle="modal"
                                               data-id="<?php echo $candhash; ?>" data-typ="supprimercand2"
                                               onClick="aChpDel(this)" title="suppression"><i class="fa fa-trash-o"></i></a>

                                        <?php }

                                    } else {

                                        echo "Le compte de l'entreprise a été suspendu temporairement";


                                    }
                                    ?>


                                </th>

                            </tr>

                            <?php

                        }

                        ?>
                        </tbody>
                    </table>

                </div>
                <!-- ong pfmp-->
                <div id="btstab" role="tabpanel"
                     class="tab-pane offrecontentclasspfmp <?php if (isset($_GET["ong"]) && $_GET["ong"] == "bts") {
                         echo "active";
                     } ?>">
                    <?php if (isset($_GET["msg"]) && $_GET["msg"] == "candidated3") { ?>

                        <div class='alert alert-success ctr'>
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                            Votre candidature est complète
                        </div>

                    <?php } ?>
                    <?php if (isset($_GET["msg"]) && $_GET["msg"] == "suppgood3") { ?>

                        <div class='alert alert-danger ctr'>
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                            Votre candidature a été supprimé
                        </div>

                    <?php } ?>
                    <!-- liste PFMP profilelv-->
                    <table class="table width100" data-toggle="table" data-search="true" data-pagination="true"
                           data-thead-classes="theadec">
                        <thead>
                        <tr>
                            <th>Intitulé du stage</th>
                            <th>Période du stage</th>
                            <th>Statut</th>
                            <th>Action(s)</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        //func lstData ("case:",var de référence) récup les infos candidaturepfmp du usr_lv//voir dans func.php
                        $lstcandbts = lstData("candidaturebts", $elv_id);

                        foreach ($lstcandbts as $value) {
                            //encode l'id_candid
                            $candhash = encryptIt($value["cand_id"], $_SESSION["hashsession"]);

                            $candidaturesuspend = "";
                            if ($value["suspend"] == "1") $candidaturesuspend = "candidaturesuspend";

                            ?>

                            <tr class="<?php echo $candidaturesuspend; ?>">
                                <!-- recup dans bdd la val du chmp "metier" du PFMP-->
                                <th><?php echo($value["metier"]); ?></th>
                                <th>
                                    <?php

                                    //dispo = disponibilité du stage (1=an, 2=nbsemaine, 3=entre2date)//recup dans bdd
                                    if ($value["dispo"] == "1" or $value["dispo"] == "3") {

                                        //si dipo=1 ou =3 affiche récup dates de PFMP
                                        echo fDate($value["date_deb"], "html") . " - " . fDate($value["date_fin"], "html");

                                    } else {

                                        //nb de semaine requis sur la candidature
                                        $weeks = getWeek();

                                        foreach ($weeks as $week) {

                                            if ($week[0] == $value["semaine"]) {

                                                ?>
                                                <!-- affiche sur profilelv les dates PFMP -->
                                                <p>Semaine <?php echo $week[0]; ?> - du <?php echo $week[1]; ?>
                                                    au <?php echo $week[2]; ?></p>

                                                <?php

                                            }
                                        }

                                    }

                                    ?>
                                </th>
                                <th>
                                    <?php

                                    if ($value["statut"] == "3") {

                                        if ($value["ent_ok"] == "0") {


                                            echo '<span class="colorred">en attente de la signature de l\'entreprise</span>';

                                        } else {

                                            if ($value["elv_ok"] == "0") {

                                                echo '<a href="' . get_site_url() . '/modifier-convention/?cand=' . $candhash . '#entsignaturesign" class="colorred">en attente de votre signature</span>';

                                            } else {

                                                if ($value["ref_ok"] == "0") {

                                                    echo '<span class="colorred">en attente de la signature du référent</span>';

                                                } else {

                                                    if ($value["prof_ok"] == "0") {

                                                        echo '<span class="colorred">en attente de la signature du professeur principale</span>';

                                                    } else {

                                                        if ($value["etab_ok"] == "0") {

                                                            echo '<span class="colorred">en attente de la signature du chef d\'établissement</span>';

                                                        } else {

                                                            echo '<span class="colorgreen">Signé</span>';

                                                        }

                                                    }

                                                }

                                            }

                                        }


                                    } else {

                                        //typ de réponse possible à la candidature
                                        if ($value["statut"] == "1") echo "en attente";
                                        else if ($value["statut"] == "2") echo "Incomplète";
                                        else if ($value["statut"] == "3") echo "Accepté";
                                        else if ($value["statut"] == "4") echo "Refusé";
                                        else echo 'Non finalisé';
                                    }
                                    ?>
                                </th>

                                <th>

                                    <?php

                                    if ($value["suspend"] == "0") {

                                        //si candid Accepté pour tel-tel stage > affiche icon pour pouvoir déposer sa convention
                                        if ($value["statut"] == "3") {

                                            ?>

                                            <a class="btn btn-primary"
                                               href="<?php echo get_site_url(); ?>/modifier-convention/?cand=<?php echo $candhash; ?>"><i
                                                        class="fa fa-pencil" aria-hidden="true"></i></a>

                                            <a target=blank
                                               href="<?php echo get_template_directory_uri(); ?>/print_convention.php?cand=<?php echo $candhash; ?>"
                                               class="btn btn-info"><i class="fa fa-print"></i></a>


                                            <?php
                                            //si candid Refusé pour tel-tel stage > affiche icon pour pouvoir retourner sur page_candid
                                        } else if ($value["statut"] == "4") {

                                            ?>

                                            <a target=_blank class="btn btn-warning"
                                               href="<?php echo get_site_url(); ?>/voir-candidature/?cand=<?php echo $candhash; ?>"><i
                                                        class="fa fa-eye" aria-hidden="true"></i></a>

                                            <?php

                                        } else {

                                            //sinon affiche icon possible de postuler ou supprimer pour tel-tel candidature
                                            ?>

                                            <a class="btn btn-primary"
                                               href="<?php echo get_site_url(); ?>/postuler/?cand=<?php echo $candhash; ?>"><i
                                                        class="fa fa-pencil" aria-hidden="true"></i></a>
                                            <a href="#deldata" class="btn btn-danger" role="button" data-toggle="modal"
                                               data-id="<?php echo $candhash; ?>" data-typ="supprimercand2"
                                               onClick="aChpDel(this)" title="suppression"><i class="fa fa-trash-o"></i></a>

                                        <?php }

                                    } else {

                                        echo "Le compte de l'entreprise a été suspendu temporairement";


                                    }

                                    ?>


                                </th>

                            </tr>

                            <?php

                        }

                        ?>
                        </tbody>
                    </table>

                </div>
                <div id="conventionstab" role="tabpanel"
                     class="tab-pane <?php if (isset($_GET["ong"]) && $_GET["ong"] == "convention") {
                         echo "active";
                     } ?>">

                    <?php if (isset($_GET["msg"]) && $_GET["msg"] == "accepted") { ?>

                        <div class='alert alert-success ctr'>
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                            Cette candidature a bien été accepté
                        </div>

                    <?php } ?>
                    <?php if (isset($_GET["msg"]) && $_GET["msg"] == "refused") { ?>

                        <div class='alert alert-danger ctr'>
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                            Cette candidature a bien été refusé
                        </div>

                    <?php } ?>
                    <table class="table width100" data-toggle="table" data-search="true" data-pagination="true"
                           data-thead-classes="theadec">
                        <thead>
                        <tr>
                            <th>Type de stage</th>
                            <th>Intitulé du stage</th>
                            <th>Période du stage</th>
                            <th>Statut</th>
                            <th>Action(s)</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        $lstcand = lstData("mesconventionselv", $elv_id);

                        foreach ($lstcand as $value) {

                            $candhash = encryptIt($value["cand_id"], $_SESSION["hashsession"]);

                            $candidaturesuspend = "";
                            if ($value["suspend"] == "1") $candidaturesuspend = "candidaturesuspend";

                            ?>

                            <tr class="<?php echo $candidaturesuspend; ?>">
                                <th><?php echo($value["type_lib"]); ?></th>
                                <th><?php echo($value["metier"]); ?></th>
                                <th>
                                    <?php

                                    if ($value["dispo"] == "1" or $value["dispo"] == "3") {


                                        echo fDate($value["date_deb"], "html") . " - " . fDate($value["date_fin"], "html");

                                    } else {


                                        $weeks = getWeek();

                                        foreach ($weeks as $week) {

                                            if ($week[0] == $value["semaine"]) {

                                                ?>

                                                <p>Semaine <?php echo $week[0]; ?> - du <?php echo $week[1]; ?>
                                                    au <?php echo $week[2]; ?></p>


                                                <?php

                                            }
                                        }


                                    }


                                    ?>
                                </th>
                                <th>

                                    <?php

                                    if ($value["ent_ok"] == "0") {


                                        echo '<span class="colorred">en attente de la signature de l\'entreprise</span>';

                                    } else {

                                        if ($value["elv_ok"] == "0") {

                                            echo '<a href="' . get_site_url() . '/modifier-convention/?cand=' . $candhash . '#entsignaturesign" class="colorred">en attente de votre signature</span>';

                                        } else {

                                            if ($value["ref_ok"] == "0") {

                                                echo '<span class="colorred">en attente de la signature du référent</span>';

                                            } else {

                                                if ($value["prof_ok"] == "0") {

                                                    echo '<span class="colorred">en attente de la signature du professeur principale</span>';

                                                } else {

                                                    if ($value["etab_ok"] == "0") {

                                                        echo '<span class="colorred">en attente de la signature du chef d\'établissement</span>';

                                                    } else {

                                                        echo '<span class="colorgreen">Signé</span>';

                                                    }

                                                }

                                            }

                                        }

                                    }

                                    ?>


                                </th>

                                <th>
                                    <?php
                                    if ($value["suspend"] == "0") {
                                        ?>
                                        <a class="btn btn-primary"
                                           href="<?php echo get_site_url(); ?>/modifier-convention/?cand=<?php echo $candhash; ?>"><i
                                                    class="fa fa-pencil" aria-hidden="true"></i></a>

                                        <a target=blank
                                           href="<?php echo get_template_directory_uri(); ?>/print_convention.php?cand=<?php echo $candhash; ?>"
                                           class="btn btn-info"><i class="fa fa-print"></i></a>

                                        <?php

                                    } else {

                                        echo "Le compte de l'entreprise a été suspendu temporairement";


                                    }

                                    ?>
                                    <?php //}
                                    ?>
                                </th>

                            </tr>

                            <?php

                        }

                        ?>
                        </tbody>
                    </table>


                </div>
            </div>


        </div>

    <?php } else {

        //si Øconnex_cmpt (ici elv) > redirige vers pag_log /garde en mémoire la dernière page ouverte et le renvoi dessus après pag_log
        $redirect = "";
        if (isset($_GET["redirect"])) $redirect = $_GET["redirect"];
        //si usr_lv a déjà un stage > recup 'stage'
        $stage = "";
        if (isset($_GET["stage"])) $stage = $_GET["stage"];

        ?>

        <!--formulaire pour se connecter-->
        <div id="connexiondiv"
             class="formconnect <?php if (!isset($_GET["ong"]) or (isset($_GET["ong"]) && $_GET["ong"] == "connexion")) {
                 //ouverture du bloc lorsque je clique dessus
                 echo "windowopen";
             } else {
                 //fermeture du bloc
                 echo "windowclose";
             } ?>" data-heightmin="120" data-heightmax="360">
            <h1>Vous êtes déjà inscrit?</h1>
            <!--en gros c'est un bloc lorsque je clique dessus, il s'ouvre grâce à "connexiondiv" (code javascrip)-->
            <div class="bouttonconnex2 <?php if (!isset($_GET["ong"]) or (isset($_GET["ong"]) && $_GET["ong"] == "connexion")) echo "displaynone"; ?>"
                 onclick="connexiondiv();">Se connecter avec mes identifiants
            </div>
            <form id="login-form" method="POST"
                  action="<?php echo get_template_directory_uri(); ?>/actiondev1.php?act=seconnecterelv">
                <input type="hidden" id="redirect" name="redirect" value="<?php echo $redirect; ?>"/>
                <input type="hidden" id="stage" name="stage" value="<?php echo $stage; ?>"/>

                <label for="useremail">Votre adresse électronique :</label>
                <input type="email" id="useremail" name="useremail">
                <br>
                <label for="userpassword">Votre mot de passe :</label>
                <input type="password" id="userpassword" name="userpassword">
                <br>
                <label>
                    <input type="checkbox" checked="checked" name="remember" value="1"> Se souvenir de moi
                </label>
                <button class="bouttonconnex" type="submit">S'identifier</button>
                <!--msg qui s'affiche si il ya une erreur pour se connecter // div bootstrap-->
                <?php if (isset($_GET["msg"]) && $_GET["msg"] == "errpassword") { ?>
                    <div class='alert alert-danger ctr'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        Cette identifiant ou ce mot de passe sont érronés.
                    </div>

                <?php } ?>
                <!--msg qui s'affiche après le Form_mdp_oublié / après avoir réinitialiser son mdp-->
                <?php if (isset($_GET["msg"]) && $_GET["msg"] == "reinitok") { ?>

                    <div class='alert alert-success ctr'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        Votre mot de passe a bien été réinitialisé.
                    </div>

                <?php } ?>
                <!--msg qui s'affiche si il le compte concerné est désactivé-->
                <?php if (isset($_GET["msg"]) && $_GET["msg"] == "errsuspens") { ?>

                    <div class='alert alert-danger ctr'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        Votre compte a été suspendu, veuillez contacter le DOI.
                    </div>

                <?php } ?>
            </form>
        </div>

        <!--formulaire quand mdp oublié-->
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
                  action="<?php echo get_template_directory_uri(); ?>/actiondev1.php?act=forgetpasswordelv">
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
                <?php if (isset($_SESSION["urlmdp_elv"]) && $_GET["msg"] == "sendgood") { ?>
                    <!--le lien concerné s'affiche sur le formulaire-->
                    <h2>Cliquez ici pour :</h2>
                    <div class='alert alert-success ctr'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <?php echo '<a href="' . $_SESSION["urlmdp_elv"] . '">modifier votre mot de passe</a>'; ?>
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

        <!--formulaire creation compte-->
        <!-- en bref, je définis mon bloc en onglet "create" avec une balise #createaccountdiv-->
        <div id="createaccountdiv" class="formconnect <?php if (isset($_GET["ong"]) && $_GET["ong"] == "create") {
            echo "windowopen"; //ouverture du bloc
        } else {
            echo "windowclose"; //fermeture du bloc
        } ?>" data-heightmin="170" data-heightmax="1050">
            <!--txt d'affichage quand bloc fermé-->
            <h1>Vous n'avez pas de compte?</h1>
            <div class="bouttonconnex2 <?php if (isset($_GET["ong"]) && $_GET["ong"] == "create") echo "displaynone"; ?>"
                 onclick="createaccountdiv();" href="">Créer un compte
            </div><!--function js "createaccountdiv()" -->

            <!-- redirige vers url '/actiondev1.php?act=registerelv' en cas de creation de compte//en bref appel ma fonction 'registerelv'-->
            <form id="createaccountelv-form" method="POST"
                  action="<?php echo get_template_directory_uri(); ?>/actiondev1.php?act=registerelv">
                <label>Pour pouvoir postuler sur nos offres de stage, vous devez créer un compte.</label>
                <label><a href="http://localhost/monstage/politique-de-confidentialite/" target=_blank>Lire la Politique de confidentialité <i class="fa fa-external-link" aria-hidden="true"></i></a>
                    pour connaître les modalités d'utilisations de mes informations récoltées.</label>
                <i>Sauf mention contraire, tous les champs sont obligatoires.</i>
                <br><br>
                <label for="useremailcrea">Votre adresse électronique :</label>
                <input type="text" id="useremailcrea" name="useremailcrea" class="colorblack">
                <br>
                <label for="usercommune">Votre commune : </label>
                <select id="usercommune" class="colorblack width100" name="usercommune">
                    <?php echo(BLst('commune', 'IDGeo', 'Geo', "", "", "", "ee", "", "")); ?>
                </select>
                <br>
                <label for="usernom">Votre nom :</label>
                <input type="text" id="usernom" name="usernom">
                <br>
                <label for="userprenom">Votre prénom :</label>
                <input type="text" id="userprenom" name="userprenom">
                <br>
                <label for="userdatenais">Votre date de naissance :</label>
                <input type="date" id="userdatenais" name="userdatenais"/>
                <br>
                <label for="usersexe">Votre sexe :</label>
                <div class="displayflex usersexeradio">
                    <?php

                    //func lstData (dans fonction.php)récup des infos dans bdd pour afficher sous forme de liste
                    $tabsexe = lstData("sexe");

                    foreach ($tabsexe as $value) {
                        ?>
                        <span class="radioclass"><input type="radio" name="usersexe"
                                                        value="<?php echo $value["sex_id"]; ?>"/><?php echo($value["sex_lib"]); ?></span>

                        <?php

                    }

                    ?>
                </div>
                <br>
                <label for="useretab">Votre établissement scolaire :</label>
                <select id="useretab" class="colorblack width100" name="useretab">
                    <!--func BLst affiche les infos choisis de bdd pour des SELECT-->
                    <?php echo(BLst('uai', 'uai_rne', 'uai_lc', "", "", "", "ee", "", "")); ?>
                </select>

                <br>
                <label for="userclass">Votre niveau :</label>
                <select id="userclass" class="colorblack width100" name="userclass">
                    <?php echo(BLst('classe', 'class_id', 'class_lib', "", "", "", "ee", "", "")); ?>
                </select>
                <br>
                <label for="userdiplome">Votre spécialité (facultatif):</label>
                <input type="text" id="userdiplome" name="userdiplome">
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

                <br> <br>
                <button class="bouttonconnex" type="submit">Valider</button>
            </form>
            <!-- div bootstrap qui reçoit un GET msg ; si msg = errorsame alors affiche le div -->
            <?php if (isset($_GET["msg"]) && $_GET["msg"] == "errorsame") { ?>

                <div class='alert alert-danger ctr'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    Les 2 mots de passe sont différents.
                </div>

            <?php } ?>
            <!--msg qui s'affiche pour l'envoi d'un lien d'activation par mail-->
            <?php if (isset($_GET["msg"]) && $_GET["msg"] == "mailsend") { ?>

                <div class='alert alert-success ctr'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    Un email d'activation a été envoyé sur votre email, veuillez consulter votre boite électronique.
                    Pour activer votre compte, cliquez sur le lien d'activation.
                </div>

            <?php } ?>
            <!-- Ervine SOLUTION pour résoudre PB d'envoyer un lien par mail-->
            <?php if (isset($_SESSION["urlcrea_elv"]) && $_GET["msg"] == "mailsend") { ?>
                <!--le lien concerné s'affiche sur le formulaire-->
                <h2>Lien d'activation :</h2>
                <div class='alert alert-success ctr'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <?php echo '<a href="' . $_SESSION["urlcrea_elv"] . '">Activer mon compte</a>'; ?>
                </div>
            <?php } ?>

        </div>

        <!--formulaire renvoie lien d'activation-->
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
                  action="<?php echo get_template_directory_uri(); ?>/actiondev1.php?act=messageactiveelv">
                <label>Pour finaliser votre inscription, nous devons d’abord vérifier votre identité.</label>
                <label>Pour cela indiquez-nous l’adresse électronique associée à votre compte.</label>
                <label for="useremailresend">Votre adresse électronique :</label>
                <input type="email" id="useremailresend" name="useremailresend">
                <br><br>
                <button class="bouttonconnex" id="" type="submit">Renvoyer</button>

                <!--msg qui s'affiche si un user essaie de se connecter sans avoir valider son compte-->
                <?php if (isset($_GET["msg"]) && $_GET["msg"] == "errtoken") { ?>

                    <div class='alert alert-danger ctr'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        Votre compte n'est pas encore actif. Vous devez cliquer sur le lien envoyé sur votre email
                        pour activer votre compte. Si vous n'avez pas reçu d'email, vous pouvez le renvoyer ici.
                    </div>

                <?php } ?>
                <!--msg qui s'affiche si aucun lien n'a été envoyé-->
                <?php if (isset($_GET["msg"]) && $_GET["msg"] == "noactivetoken") { ?>

                    <div class='alert alert-danger ctr'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        Une erreur s'est produite.
                    </div>

                <?php } ?>
                <!-- msg qui s'affiche lorsque le form_renvoi_mail est confirmé-->
                <?php if (isset($_GET["msg"]) && $_GET["msg"] == "resendgood") { ?>

                    <div class='alert alert-success ctr'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        Un email d'activation a été envoyé sur votre email, veuillez consulter votre boite
                        électronique. Pour activer votre compte, cliquez sur le lien d'activation.
                    </div>

                <?php } ?>
                <!-- Ervine SOLUTION pour résoudre PB d'envoyer un lien par mail-->
                <?php if (isset($_SESSION["urlresend_elv"]) && $_GET["msg"] == "resendgood") { ?>
                    <!--le lien concerné s'affiche sur le formulaire-->
                    <h2>Lien activation :</h2>
                    <div class='alert alert-success ctr'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <?php echo '<a href="' . $_SESSION["urlresend_elv"] . '">Activer mon compte</a>'; ?>
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
</section>


<?php do_action('avada_after_content'); ?><!--recup info_avada-->
<?php get_footer(); ?><!--recup footer-->
<?php include("modal.php"); ?><!--modal.php = page confirma°-->