<?php
/**
 * Template Name: profil entreprise
 * Description: Pages de profil entreprise
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


        if (lgchkent()) {


            $ent_id = decryptIt($_SESSION["ent_id"], $_SESSION["hashsession"]);

            $tabarray = recData("entreprise", $ent_id);

            $tabnotifcand = recData("entreprisenotificationcand", $ent_id);
            $tabnotifconv = recData("entreprisenotificationconv", $ent_id);

            $nbstagenotpublish = recData("stagenotpublish", $ent_id);

            ?>
            <?php if (isset($_GET["msg"]) && $_GET["msg"] == "verified") { ?>

                <div class='alert alert-success ctr'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    Votre compte a bien été vérifié, bienvenue, <?php echo $_SESSION['ent_mail']; ?>.
                </div>

            <?php } ?>
            <?php if (isset($_GET["msg"]) && $_GET["msg"] == "connected") { ?>

                <div class='alert alert-success ctr'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    Bienvenue , <?php echo $_SESSION['ent_mail']; ?>.
                </div>

            <?php } ?>
            <div class="row" id="profileleve">

                <header class="panel-heading tab-bg-dark-navy-blue col-md-3">
                    <ul class="nav nav-tabs mb-2" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link <?php if (!isset($_GET["ong"]) or (isset($_GET["ong"]) && $_GET["ong"] == "profil")) {
                                echo "active";
                            } ?> " data-toggle="tab" role="tab" aria-controls="profiltab" aria-selected="true"
                               href="#profiltab">Profil et sécurité</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if (isset($_GET["ong"]) && $_GET["ong"] == "info") {
                                echo "active";
                            } ?>" data-toggle="tab" role="tab" aria-controls="informationtab" aria-selected="false"
                               href="#informationtab">Mes informations</a>
                        </li>
                        <li class="nav-item">
                            <?php if ($nbstagenotpublish["NB"] == "0") { ?>
                                <a class="nav-link <?php if (isset($_GET["ong"]) && $_GET["ong"] == "deposeoffre") {
                                    echo "active";
                                } ?>" target=_blank href="<?php echo get_site_url(); ?>/deposer-une-offre/">Déposer une
                                    offre de stage</a>
                            <?php } else { ?>
                                <a class="nav-link <?php if (isset($_GET["ong"]) && $_GET["ong"] == "deposeoffre") {
                                    echo "active";
                                } ?>" data-toggle="tab" role="tab" aria-controls="deposeoffretab" aria-selected="false"
                                   href="#deposeoffretab">Déposer une offre de stage</a>
                            <?php } ?>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if (isset($_GET["ong"]) && $_GET["ong"] == "3eme") {
                                echo "active";
                            } ?>" data-toggle="tab" role="tab" aria-controls="troisemetab" aria-selected="false"
                               href="#troisemetab">Mes offres de stage 3ème</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if (isset($_GET["ong"]) && $_GET["ong"] == "pfmp") {
                                echo "active";
                            } ?>" data-toggle="tab" role="tab" aria-controls="pfmptab" aria-selected="false"
                               href="#pfmptab">Mes offres de stage PFMP</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if (isset($_GET["ong"]) && $_GET["ong"] == "bts") {
                                echo "active";
                            } ?>" data-toggle="tab" role="tab" aria-controls="btstab" aria-selected="false"
                               href="#btstab">Mes offres de stage BTS</a>
                        </li>
                        <li class="nav-item" onclick="viewnotifcandent()">
                            <a class="nav-link displayinline <?php if (isset($_GET["ong"]) && $_GET["ong"] == "candidature") {
                                echo "active";
                            } ?>" data-toggle="tab" role="tab" aria-controls="candidaturetab" aria-selected="false"
                               href="#candidaturetab">Candidatures
                                <?php

                                if ($tabnotifcand["NB"] > 0) {

                                    ?>
                                    <span id="notificationcand"><i class="fa fa-bell fontsize17px animateringring"
                                                                   aria-hidden="true"></i><?php echo $tabnotifcand["NB"]; ?></Span>
                                    <?php

                                }

                                ?>
                            </a>
                        </li>
                        <li class="nav-item" onclick="viewnotifconvent()">
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

                    <div id="profiltab" role="tabpanel"
                         class="tab-pane <?php if (!isset($_GET["ong"]) or (isset($_GET["ong"]) && $_GET["ong"] == "profil")) {
                             echo "active";
                         } ?>">
                        <h1>Modifier mon numéro tahiti</h1>
                        <form id="changtahiti-form" method="POST"
                              action="<?php echo get_template_directory_uri(); ?>/actiondev2.php?act=modiftahitient">
                            <label for="userextahiti">Mon numéro tahiti actuel :</label>
                            <input type="text" disabled id="userextahiti" name="userextahiti"
                                   value="<?php echo $tabarray["ent_numtahiti"]; ?>">
                            <br>
                            <label for="usernewtahiti">Mon nouveau numéro tahiti :</br><i>Pour trouver votre numéro
                                    tahiti, allez sur le site de l'ispf <a class="colorblue"
                                                                           href="https://www.ispf.pf/rte" target=_blank>ici</a>
                                    (Format : numéro_de_tahiti-Numéro_de_l'établissement)</i></label>
                            <input type="text" id="usernewtahiti" name="usernewtahiti">
                            <br>
                            <br>
                            <button class="bouttonconnex" type="submit">Enregistrer</button>


                        </form>
                        </hr>
                        <h1>Modifier mon adresse électronique</h1>
                        <form id="changemail-form" method="POST"
                              action="<?php echo get_template_directory_uri(); ?>/actiondev2.php?act=modifmailent">
                            <label for="useremail">Mon adresse électronique actuel :</label>
                            <input type="email" disabled id="useremail" name="useremail"
                                   value="<?php echo $tabarray["ent_mail"]; ?>">
                            <br>
                            <label for="useremailnew">Ma nouvelle adresse électronique :</label>
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
                            <!-- Ervine SOLUTION pour résoudre PB d'envoyer un lien par mail-->
                            <?php if (isset($_SESSION["urlnewmail_ent"]) && $_GET["msg"] == "mailsend") { ?>
                                <!--le lien concerné s'affiche sur le formulaire-->
                                <h2>Lien :</h2>
                                <div class='alert alert-success ctr'>
                                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                    <?php echo '<a href="' . $_SESSION["urlnewmail_ent"] . '">Vérifier votre nouvel email</a>'; ?>
                                </div>

                            <?php } ?>
                            <?php if (isset($_GET["msg"]) && $_GET["msg"] == "newemail") { ?>

                                <div class='alert alert-success ctr'>
                                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                    Votre email a bien été changé
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
                              action="<?php echo get_template_directory_uri(); ?>/actiondev2.php?act=modifpasswordent">
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

                    <div id="informationtab" role="tabpanel"
                         class="tab-pane <?php if (isset($_GET["ong"]) && $_GET["ong"] == "info") {
                             echo "active";
                         } ?>">

                        <form id="modifinfo-form" enctype="multipart/form-data" method="POST"
                              action="<?php echo get_template_directory_uri(); ?>/actiondev2.php?act=modifinfoent">
                            <h1>Modifier mes informations</h1>
                            <div class="row">

                                <div class="col-md-6">
                                    <label class="col-md-12" for="username">Nom de l'entreprise :</label>
                                    <input class="col-md-10" type="text" id="username" name="username"
                                           value="<?php echo $tabarray["ent_nom"]; ?>"/>

                                </div>
                                <div class="col-md-6">
                                    <label class="col-md-12" for="usertel">Téléphone :</label>
                                    <input class="col-md-10" type="text" id="usertel" name="usertel"
                                           value="<?php echo $tabarray["ent_tel"]; ?>"/>
                                    <br>
                                </div>
                            </div>
                            <br>
                            <div class="row">


                                <div class="col-md-6">
                                    <label class="col-md-12" for="usercommune">Commune :</label>
                                    <select class="col-md-10 colorblack" id="usercommune" name="usercommune">
                                        <?php echo(BLst('commune', 'IDGeo', 'Geo', $tabarray["ent_com"], "", "", "", "", "")); ?>
                                    </select>

                                </div>
                                .
                                <div class="col-md-6">
                                    <label class="col-md-12" for="usergeo">Adresse géographique :</label>
                                    <input class="col-md-10" type="text" id="usergeo" name="usergeo"
                                           value="<?php echo $tabarray["ent_adr"]; ?>">

                                </div>
                            </div>
                            <br>

                            <div class="row">

                                <div class="col-md-6">
                                    <label class="col-md-12" for="usercodepos">Code postal (facultatif) :</label>
                                    <input class="col-md-10" type="text" id="usercodepos" name="usercodepos"
                                           value="<?php echo $tabarray["ent_codepos"]; ?>">

                                </div>
                                <div class="col-md-6">
                                    <label class="col-md-12" for="userpk">PK (facultatif) :</label>
                                    <input class="col-md-10" type="text" id="userpk" name="userpk"
                                           value="<?php echo $tabarray["ent_pk"]; ?>">

                                </div>

                            </div>
                            <br>
                            <div class="row">

                                <div class="col-md-6">
                                    <label class="col-md-12" for="userquart">Quartier (facultatif) :</label>
                                    <input class="col-md-10" type="text" id="userquart" name="userquart"
                                           value="<?php echo $tabarray["ent_quart"]; ?>">

                                </div>
                                <div class="col-md-6">
                                    <label class="col-md-12" for="userrue">Rue (facultatif) :</label>
                                    <input class="col-md-10" type="text" id="userrue" name="userrue"
                                           value="<?php echo $tabarray["ent_rue"]; ?>">

                                </div>

                            </div>
                            <br>
                            <div class="row">

                                <div class="col-md-6">
                                    <label class="col-md-12" for="userimmeuble">Immeuble (facultatif) :</label>
                                    <input class="col-md-10" type="text" id="userimmeuble" name="userimmeuble"
                                           value="<?php echo $tabarray["ent_imm"]; ?>">

                                </div>
                                <div class="col-md-6">
                                    <label class="col-md-6" for="usersect">Secteur (facultatif) :</label>
                                    <div class="displayflex usersexeradio col-md-6">

                                        <span class="radioclass col-md-6"><input type="radio"
                                                                                 name="usersect" <?php if ($tabarray["ent_sect"] == "1") {
                                                echo "checked";
                                            } ?>  value="1"/>Public</span>
                                        <span class="radioclass col-md-6"><input type="radio"
                                                                                 name="usersect" <?php if ($tabarray["ent_sect"] == "2") {
                                                echo "checked";
                                            } ?> value="2"/>Privé</span>


                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <label class="col-md-12" for="userweb">Site internet (facultatif) :</label>
                                    <input class="col-md-10" type="text" id="userweb" name="userweb"
                                           value="<?php echo $tabarray["ent_web"]; ?>">

                                </div>
                                <div class="col-md-6">
                                    <label class="col-md-12" for="userdesc">Présentation de l'entreprise :</label>
                                    <textarea class="col-md-10" id="userdesc" rows="6"
                                              name="userdesc"><?php echo $tabarray["ent_desc"]; ?></textarea>
                                </div>

                            </div>
                            </br></br>
                            <div class="row">

                                <div class="col-md-8">
                                    <label class="control-label col-md-8" for="logoent">Ajouter mon logo d'entreprise
                                        (Facultatif) (format image)</label>
                                    <div class="col-md-4"><input type="file" name="logoent" id="logoent"
                                                                 class="form-control"/></div>
                                </div>
                                <?php

                                if ($tabarray["ent_logo"] != "" and $tabarray["ent_logo"] != null) {

                                    ?>

                                    <div class="col-md-4">
                                        <img src="<?php echo get_site_url(); ?>/wp-content/uploads/logo/<?php echo $tabarray["ent_logo"]; ?>"/>
                                        <div class="suppcv cursorpointer btn btn-danger" onclick="supprimerlogo()"><i
                                                    class="fa fa-trash" aria-hidden="true"></i> Supprimer ce logo
                                        </div>

                                    </div>


                                    <?php

                                }

                                ?>
                            </div>


                            <br>
                            <br>
                            <button class="bouttonconnex" type="submit">Modifier</button>
                            <?php if (isset($_GET["msg"]) && $_GET["msg"] == "infochange") { ?>

                                <div class='alert alert-success ctr'>
                                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                    Vos informations ont bien été changé
                                </div>

                            <?php } ?>
                        </form>
                    </div>


                    <div id="deposeoffretab" role="tabpanel"
                         class="tab-pane <?php if (isset($_GET["ong"]) && $_GET["ong"] == "deposeoffre") {
                             echo "active";
                         } ?>">
                        <div class="pull-right">
                            <a href="<?php echo get_site_url(); ?>/deposer-une-offre/" class="btn btn-success">Déposer
                                une nouvelle offre de stage</a>
                        </div>
                        <table class="table width100" data-toggle="table" data-search="true" data-pagination="true"
                               data-thead-classes="theadec">
                            <thead>
                            <tr>
                                <th>Type</th>
                                <th>Secteur</th>
                                <th>Métier</th>
                                <th>Pours.</th>
                                <th>Supp.</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            $lststage = lstData("stagenotpublish", $ent_id);

                            foreach ($lststage as $value) {

                                $stageid = encryptIt($value["stage_id"], $_SESSION["hashsession"]);

                                ?>

                                <tr>
                                    <th><?php echo($value["type_lib"]); ?></th>
                                    <th><?php echo($value["sect_lib"]); ?></th>
                                    <th><?php echo($value["metier"]); ?></th>
                                    <th><a class="btn btn-primary"
                                           href="<?php echo get_site_url(); ?>/deposer-une-offre/?etape=<?php echo $value["etape"]; ?>&stage=<?php echo $stageid; ?>"><i
                                                    class="fa fa-pencil" aria-hidden="true"></i></a></th>
                                    <th><a href="#deldata" class="btn btn-danger" role="button" data-toggle="modal"
                                           data-idp="deposeoffre" data-id="<?php echo $stageid; ?>"
                                           data-typ="supprimerstage" onClick="aChpDel(this)" title="suppression"><i
                                                    class="fa fa-trash-o"></i></a></th>

                                </tr>

                                <?php

                            }

                            ?>
                            </tbody>
                        </table>

                    </div>

                    <div id="troisemetab" role="tabpanel"
                         class="tab-pane offrecontentclass <?php if (isset($_GET["ong"]) && $_GET["ong"] == "3eme") {
                             echo "active";
                         } ?>">
                        <button class="btn btn-success"><i class="fa fa-toggle-on"></i></button>
                        Ce stage est ouvert aux candidatures /
                        <button class="btn btn-danger"><i class="fa fa-toggle-off"></i></button>
                        Ce stage est fermé aux candidatures</br></br>

                        <table class="table width100" data-toggle="table" data-search="true" data-pagination="true"
                               data-thead-classes="theadec">
                            <thead>
                            <tr>

                                <th>Secteur</th>
                                <th>Métier</th>
                                <th>Cand.</th>
                                <th>Modif.</th>
                                <th>Clore/Ouvrir</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            $lststage = lstData("lststage3eme", $ent_id);

                            foreach ($lststage as $value) {

                                $stagehash = encryptIt($value["stage_id"], $_SESSION["hashsession"]);

                                $tabarray = recData("candstage", $value["stage_id"]);

                                ?>

                                <tr>

                                    <th><?php echo($value["sect_lib"]); ?></th>
                                    <th><?php echo($value["metier"]); ?></th>
                                    <th><?php echo($tabarray["NB"]); ?></th>
                                    <th><a class="btn btn-primary"
                                           href="<?php echo get_site_url(); ?>/deposer-une-offre/?etape=<?php echo $value["etape"]; ?>&stage=<?php echo $stagehash; ?>"><i
                                                    class="fa fa-pencil" aria-hidden="true"></i></a></th>
                                    <th>
                                        <?php if ($value["publish"] == "1") { ?>
                                            <div data-id="<?php echo $stagehash; ?>" class="btn btn-success"
                                                 onclick="changepublish(this)"><i class="fa fa-toggle-on"></i></div>
                                        <?php } else { ?>
                                            <div data-id="<?php echo $stagehash; ?>" class="btn btn-danger"
                                                 onclick="changepublish(this)"><i class="fa fa-toggle-off"></i></div>
                                        <?php } ?>

                                    </th>

                                </tr>

                                <?php

                            }

                            ?>
                            </tbody>
                        </table>

                    </div>
                    <div id="pfmptab" role="tabpanel"
                         class="tab-pane offrecontentclasspfmp <?php if (isset($_GET["ong"]) && $_GET["ong"] == "pfmp") {
                             echo "active";
                         } ?>">
                        <button class="btn btn-success"><i class="fa fa-toggle-on"></i></button>
                        Ce stage est ouvert aux candidatures /
                        <button class="btn btn-danger"><i class="fa fa-toggle-off"></i></button>
                        Ce stage est fermé aux candidatures</br></br>
                        <table class="table width100" data-toggle="table" data-search="true" data-pagination="true"
                               data-thead-classes="theadec">
                            <thead>
                            <tr>

                                <th>Domaine</th>
                                <th>Métier</th>
                                <th>Cand.</th>
                                <th>Modif.</th>
                                <th>Clore/Ouvrir</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            $lststage = lstData("lststagepfmp", $ent_id);

                            foreach ($lststage as $value) {

                                $stagehash = encryptIt($value["stage_id"], $_SESSION["hashsession"]);

                                $tabarray = recData("candstage", $value["stage_id"]);

                                ?>

                                <tr>
                                    <th><?php echo($value["sect_lib"]); ?></th>
                                    <th><?php echo($value["metier"]); ?></th>
                                    <th><?php echo($tabarray["NB"]); ?></th>
                                    <th><a class="btn btn-primary"
                                           href="<?php echo get_site_url(); ?>/deposer-une-offre/?etape=<?php echo $value["etape"]; ?>&stage=<?php echo $stagehash; ?>"><i
                                                    class="fa fa-pencil" aria-hidden="true"></i></a></th>
                                    <th>
                                        <?php if ($value["publish"] == "1") { ?>
                                            <div data-id="<?php echo $stagehash; ?>" class="btn btn-success"
                                                 onclick="changepublish(this)"><i class="fa fa-toggle-on"></i></div>
                                        <?php } else { ?>
                                            <div data-id="<?php echo $stagehash; ?>" class="btn btn-danger"
                                                 onclick="changepublish(this)"><i class="fa fa-toggle-off"></i></div>
                                        <?php } ?>

                                    </th>

                                </tr>

                                <?php

                            }

                            ?>
                            </tbody>
                        </table>


                    </div>

                    <div id="btstab" role="tabpanel"
                         class="tab-pane offrecontentclass <?php if (isset($_GET["ong"]) && $_GET["ong"] == "bts") {
                             echo "active";
                         } ?>">
                        <button class="btn btn-success"><i class="fa fa-toggle-on"></i></button>
                        Ce stage est ouvert aux candidatures /
                        <button class="btn btn-danger"><i class="fa fa-toggle-off"></i></button>
                        Ce stage est fermé aux candidatures</br></br>
                        <table class="table width100" data-toggle="table" data-search="true" data-pagination="true"
                               data-thead-classes="theadec">
                            <thead>
                            <tr>

                                <th>Secteur</th>
                                <th>Métier</th>
                                <th>Cand.</th>
                                <th>Modif.</th>
                                <th>Clore/Ouvrir</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            $lststage = lstData("lststagebts", $ent_id);

                            foreach ($lststage as $value) {

                                $stagehash = encryptIt($value["stage_id"], $_SESSION["hashsession"]);

                                $tabarray = recData("candstage", $value["stage_id"]);

                                ?>

                                <tr>

                                    <th><?php echo($value["sect_lib"]); ?></th>
                                    <th><?php echo($value["metier"]); ?></th>
                                    <th><?php echo($tabarray["NB"]); ?></th>
                                    <th><a class="btn btn-primary"
                                           href="<?php echo get_site_url(); ?>/deposer-une-offre/?etape=<?php echo $value["etape"]; ?>&stage=<?php echo $stagehash; ?>"><i
                                                    class="fa fa-pencil" aria-hidden="true"></i></a></th>
                                    <th>
                                        <?php if ($value["publish"] == "1") { ?>
                                            <div data-id="<?php echo $stagehash; ?>" class="btn btn-success"
                                                 onclick="changepublish(this)"><i class="fa fa-toggle-on"></i></div>
                                        <?php } else { ?>
                                            <div data-id="<?php echo $stagehash; ?>" class="btn btn-danger"
                                                 onclick="changepublish(this)"><i class="fa fa-toggle-off"></i></div>
                                        <?php } ?>

                                    </th>

                                </tr>

                                <?php

                            }

                            ?>
                            </tbody>
                        </table>

                    </div>
                    <div id="candidaturetab" role="tabpanel"
                         class="tab-pane <?php if (isset($_GET["ong"]) && $_GET["ong"] == "candidature") {
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
                                <th>Identité élève</th>
                                <th>Statut</th>
                                <th>Voir</th>
                                <th>Action(s)</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            $lstcand = lstData("mescandidatures", $ent_id);

                            foreach ($lstcand as $value) {

                                $candhash = encryptIt($value["cand_id"], $_SESSION["hashsession"]);

                                ?>

                                <tr>
                                    <th><?php echo($value["type_lib"]); ?></th>
                                    <th><?php echo($value["metier"]); ?></th>
                                    <th>
                                        <?php

                                        if ($value["dispo"] == "1" or $value["dispo"] == "3") {


                                            echo fDate($value["date_deb"], "html") . " - " . fDate($value["date_fin"], "html");

                                        } else {

                                            $weeks = getWeek();

                                            foreach ($weeks as $week) {

                                                $checked = "";
                                                if ($week[0] == $value["semaine"]) {

                                                    ?>

                                                    Semaine <?php echo $week[0]; ?> - du <?php echo $week[1]; ?> au <?php echo $week[2]; ?>


                                                    <?php

                                                }
                                            }


                                        }


                                        ?>
                                    </th>
                                    <th><?php echo($value["elv_nom"] . " " . $value["elv_pren"]); ?></br>
                                        <?php if ($value["CONFIRM"] > 0) { ?>

                                            <i class="colorgreen">Suivi par un professeur</i>
                                        <?php } ?>

                                    </th>
                                    <th>
                                        <?php

                                        if ($value["ent_ok"] == "1" and $value["elv_ok"] == "1" and $value["ref_ok"] == "1" and $value["prof_ok"] == "1" and $value["etab_ok"] == "1") {

                                            echo '<span class="colorgreen">Signé</span>';

                                        } else {

                                            if ($value["statut"] == "1") echo "en attente";
                                            else if ($value["statut"] == "2") echo "Incomplète";
                                            else if ($value["statut"] == "3") echo "Accepté";
                                            else if ($value["statut"] == "4") echo "Refusé";

                                        }

                                        ?>
                                    </th>
                                    <th>
                                        <?php
                                        if ($value["ent_ok"] == "1" and $value["elv_ok"] == "1" and $value["ref_ok"] == "1" and $value["prof_ok"] == "1" and $value["etab_ok"] == "1") {
                                            ?>
                                            <a target=blank
                                               href="<?php echo get_template_directory_uri(); ?>/print_convention.php?cand=<?php echo $candhash; ?>"
                                               class="btn btn-info"><i class="fa fa-print"></i></a>

                                            <?php
                                        } else {
                                            ?>
                                            <a target=_blank class="btn btn-warning"
                                               href="<?php echo get_site_url(); ?>/voir-candidature/?cand=<?php echo $candhash; ?>"><i
                                                        class="fa fa-eye" aria-hidden="true"></i></a>
                                            <?php

                                        }

                                        ?>
                                    </th>
                                    <th>

                                        <?php
                                        if ($value["ent_ok"] == "1" and $value["elv_ok"] == "1" and $value["ref_ok"] == "1" and $value["prof_ok"] == "1" and $value["etab_ok"] == "1") {
                                            ?>

                                            Annuler conv.</br>
                                            <a href="#refusdata" class="btn btn-danger" role="button"
                                               data-toggle="modal" data-id="<?php echo $candhash; ?>"
                                               data-typ="refuscand" onClick="aChpRefus(this)" title="suppression"><i
                                                        class="fa fa-window-close"></i></a>


                                            <?php
                                        } else {
                                            ?>
                                            Accept/Refus</br>
                                            <a href="#acceptdata" class="btn btn-success" role="button"
                                               data-toggle="modal" data-id="<?php echo $candhash; ?>"
                                               data-typ="acceptcand" onClick="aChpAccept(this)" title="suppression"><i
                                                        class="fa fa-check-square"></i></a>
                                            <a href="#refusdata" class="btn btn-danger" role="button"
                                               data-toggle="modal" data-id="<?php echo $candhash; ?>"
                                               data-typ="refuscand" onClick="aChpRefus(this)" title="suppression"><i
                                                        class="fa fa-window-close"></i></a>

                                            <?php

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
                                <th>Elève</th>
                                <th>Statut</th>
                                <th>Action(s)</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            $lstcand = lstData("mesconventions", $ent_id);

                            foreach ($lstcand as $value) {

                                $candhash = encryptIt($value["cand_id"], $_SESSION["hashsession"]);

                                ?>

                                <tr>
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

                                                    <div>Semaine <?php echo $week[0]; ?> - du <?php echo $week[1]; ?>
                                                        au <?php echo $week[2]; ?></div>


                                                    <?php

                                                }
                                            }


                                        }


                                        ?>
                                    </th>
                                    <th>
                                        <?php echo($value["NOM"] . " " . $value["PRENOM"]); ?><br>
                                        <?php if ($value["CONFIRM"] > 0) { ?>

                                            <i class="colorgreen">Suivi par un professeur</i>
                                        <?php } ?>
                                    </th>
                                    <th>
                                        <?php


                                        if ($value["ent_ok"] == "0") {

                                            echo '<a href="' . get_site_url() . '/modifier-convention/?cand=' . $candhash . '#entsignaturesign" class="colorred">en attente de votre signature</span>';

                                        } else {

                                            if ($value["elv_ok"] == "0") {

                                                echo '<span class="colorred">en attente de la signature de l\'élève</span>';

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
                                        <a class="btn btn-primary"
                                           href="<?php echo get_site_url(); ?>/modifier-convention/?cand=<?php echo $candhash; ?>"><i
                                                    class="fa fa-pencil" aria-hidden="true"></i></a>

                                        <a target=blank
                                           href="<?php echo get_template_directory_uri(); ?>/print_convention.php?cand=<?php echo $candhash; ?>"
                                           class="btn btn-info"><i class="fa fa-print"></i></a>

                                        <?php

                                        if ($value["ent_ok"] == "1" and $value["elv_ok"] == "1" and $value["ref_ok"] == "1" and $value["prof_ok"] == "1" and $value["etab_ok"] == "1") {

                                            ?>
                                            <a href="#refusdata" class="btn btn-danger" role="button"
                                               data-toggle="modal" data-id="<?php echo $candhash; ?>"
                                               data-typ="refuscand" onClick="aChpRefus(this)" title="suppression"><i
                                                        class="fa fa-window-close"></i></a>
                                            <?php

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

            $redirect = "";
            if (isset($_GET["redirect"])) $redirect = $_GET["redirect"];
            $type_id = "";
            if (isset($_GET["type"])) $type_id = $_GET["type"];

            ?>


            <?php if (isset($_GET["msg"]) && $_GET["msg"] == "tahitichange") { ?>

                <div class='alert alert-success ctr'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    Le numéro tahiti a été modifier avec success. Votre compte doit être revalidé par l'administration.
                    Merci pour votre patiente...
                </div>

            <?php } ?>
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
                    Votre compte doit être revalidé par l'administration. Merci pour votre patiente....
                </div>

            <?php } ?>
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
                <form id="login-form" method="POST"
                      action="<?php echo get_template_directory_uri(); ?>/actiondev2.php?act=seconnecterent">
                    <input type="hidden" id="redirect" name="redirect" value="<?php echo $redirect; ?>"/>
                    <input type="hidden" id="type_id" name="type_id" value="<?php echo $type_id; ?>"/>
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


                </form>
            </div>

            <!--form mdp oublier-->
            <div id="passwordforgetdiv"
                 class="formconnect <?php if (isset($_GET["ong"]) && $_GET["ong"] == "passforget") {
                     echo "windowopen";
                 } else {
                     echo "windowclose";
                 } ?>" data-heightmin="150" data-heightmax="280">
                <h1>Vous avez oublié votre mot de passe?</h1>
                <div class="bouttonconnex2 <?php if (isset($_GET["ong"]) && $_GET["ong"] == "passforget") echo "displaynone"; ?>"
                     onclick="passwordforgetdiv();">Retrouvez mon mot de passe
                </div>
                <form id="passwordforget-form" method="POST"
                      action="<?php echo get_template_directory_uri(); ?>/actiondev2.php?act=forgetpasswordent">
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
                    <?php if (isset($_SESSION["urlmdp_ent"]) && $_GET["msg"] == "sendgood") { ?>
                        <!--le lien concerné s'affiche sur le formulaire-->
                        <h2>Lien :</h2>
                        <div class='alert alert-success ctr'>
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                            <?php echo '<a href="' . $_SESSION["urlmdp_ent"] . '">Réinitialiser votre mot de passe</a>'; ?>
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
            } ?>" data-heightmin="120" data-heightmax="1050">
                <h1>Vous n'avez pas de compte?</h1>
                <div class="bouttonconnex2 <?php if (isset($_GET["ong"]) && $_GET["ong"] == "create") echo "displaynone"; ?>"
                     onclick="createaccountdiv();" href="">Créer un compte en tant qu'offreur
                </div>
                <form id="createaccountent-form" method="POST"
                      action="<?php echo get_template_directory_uri(); ?>/actiondev2.php?act=registerent">
                    <label>Déposez vos offres de stages à l'aide de votre compte personnalisé. Il vous permettra à tout
                        moment de modifier vos offres et de suivre leur avancement.</br>Un numéro Tahiti vous ai demandé
                        afin de vérifier t'authentifer votre compte.</label>
                    <i>Sauf mention contraire, tous les champs sont obligatoires.</i>
                    <br><br>
                    <label for="useremailcrea">Votre adresse électronique :</label>
                    <input type="text" id="useremailcrea" name="useremailcrea" class="colorblack">
                    <br>
                    <label for="usertahiti">Votre numéro Tahiti :</br><i>Pour trouver votre numéro tahiti, allez sur le
                            site de l'ispf <a class="colorblue" href="https://www.ispf.pf/rte" target=_blank>ici</a>
                            (Format : numéro_de_tahiti-Numéro_de_l'établissement)</i></label>
                    <input type="text" id="usertahiti" name="usertahiti" placeholder="001226-001"/>


                    <br>
                    <label for="password1">Tapez un mot de passe :</label>
                    <input type="password" id="password1" name="password1">
                    <br>
                    <label for="password2">Retapez le mot de passe :</label>
                    <input type="password" id="password2" name="password2">
                    <br>
                    <label for="password2"><input type="checkbox" id="checkcond" name="checkcond"> j'accepte les
                        conditions générales d'utilisations de mes données (<a target=_blank
                                                                               href="<?php echo get_site_url(); ?>/conditions-generales-dutilisation-cgu/">voir
                            les conditions ici</a>):</label>

                    <br>
                    <button class="bouttonconnex" type="submit">Valider</button>
                </form>
                <?php if (isset($_GET["msg"]) && $_GET["msg"] == "errornumtahiti") { ?>

                    <div class='alert alert-danger ctr'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        Ce numéro tahiti est incorrecte.
                    </div>

                <?php } ?>
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
                <?php if (isset($_SESSION["urlcrea_ent"]) && $_GET["msg"] == "mailsend") { ?>
                    <!--le lien concerné s'affiche sur le formulaire-->
                    <h2>Lien :</h2>
                    <div class='alert alert-success ctr'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <?php echo '<a href="' . $_SESSION["urlcrea_ent"] . '">Activer votre compte</a>'; ?>
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
                      action="<?php echo get_template_directory_uri(); ?>/actiondev2.php?act=messageactiveent">
                    <label>Pour finaliser votre inscription, nous devons d’abord vérifier votre identité.</label>
                    <label>Pour cela indiquez-nous l’adresse électronique associée à votre compte.</label>
                    <label for="useremailresend">Votre adresse électronique :</label>
                    <input type="email" id="useremailresend" name="useremailresend">
                    <br><br>
                    <button class="bouttonconnex" id="" type="submit">Renvoyer</button>

                    <?php if (isset($_GET["msg"]) && $_GET["msg"] == "erralact") { ?>

                        <div class='alert alert-danger ctr'>
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                            Votre compte est déjà actif. utiliser l'option "mot de passe oubliée" pour réinitialiser
                            votre mot de passe.
                        </div>

                    <?php } ?>
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
                    <?php
                    if (isset($_SESSION["urlresend_ent"]) && $_GET["msg"] == "resendgood") { ?>
                        <!--le lien concerné s'affiche sur le formulaire-->
                        <h2>Lien :</h2>
                        <div class='alert alert-success ctr'>
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                            <?php echo '<a href="' . $_SESSION["urlresend_ent"] . '">Activer votre compte</a>'; ?>
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


<?php do_action('avada_after_content'); ?>
<?php get_footer(); ?>
<?php include("modal.php"); ?>