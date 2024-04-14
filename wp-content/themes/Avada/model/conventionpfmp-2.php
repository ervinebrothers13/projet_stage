<html>
<head>
    <link href="model/stylempdf.css" rel="stylesheet">
</head>
<body>


<page orientation='1' backtop='5mm' backbottom='5mm' backleft='1mm'>
    <table style="border-collapse: collapse;margin-bottom:20px;!important" border=1 >
        <tr>
            <td style="width:900px;text-align:left;">

                <table>

                    <tr>
						<td>
						<table style="width:100%;">
						<tr>
                        <td style="text-align:left;">
                            <span class="fontbold" style="font-size:18px;width:300px;">Nom de l'élève</span> : <span style="font-size:18px;"><?php echo ($tabconvention["elv_nom2"]); ?></span>
                        </td>
                        <td style="text-align:left;">
                            <span class="fontbold" style="font-size:18px;width:300px;">Prénom</span> : <span style="font-size:18px;"><?php echo ($tabconvention["elv_pren2"]); ?></span>
                        </td>
                        <td style="text-align:left;">
                            <span class="fontbold" style="font-size:18px;">Classe</span> : <span style="font-size:18px;"><?php echo ($tabconvention["elv_class"]); ?></span>
                        </td>
						</tr>
						</table>
						</td>
                    </tr>
                    <tr>
                        <td style="text-align:left;">
                            <span class="fontbold" style="font-size:18px;">Diplôme préparé</span>
                            : <span style="font-size:18px;"><?php echo ($tabconvention["elv_diplome2"]); ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:left;width:800px;">
                            <span class="fontbold" style="font-size:18px;">Nom du (ou des) enseignant(s)- référent(s)</span><span style="font-size:18px;">chargés de suivre le déroulement de la formation en entreprise :</span>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:left;">
                            <span class="fontbold" style="font-size:18px;">Nom du tuteur</span>
                            : <span style="font-size:18px;"><?php echo ($tabconvention["referent_nom2"]); ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:left;font-size:18px">
                            Dates du stage : <?php echo ($tabconvention["date_stage"]); ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table style="border-collapse: collapse;" border=1 class="fontbold">
        <tr>
            <td style="padding:10 10 10 10;width:900px;text-align:center;font-size:23px;">
                Annexe pédagogique
            </td>
        </tr>
    </table>

    <table class="fonthoraire" style="width:100%;">
        <tr>
            <td style="text-align:left;font-size:13px;width:50%;height:20px;">
                Horaires journaliers de l’élève : <?php echo ($tabconvention["horairejour"]); ?>
            </td>
            <td style="text-align:right;width:50%;font-size:13px;">
                Soit une durée totale hebdomadaire de : <?php echo ($tabconvention["horaireweek"]); ?>
            </td>
        </tr>
    </table>
    <table id="tablehoraire" border=1 class="marginspace">
        <tr>
            <td></td>
            <td class="aligncenter">Matin</td>
            <td class="aligncenter">Après-midi</td>
        </tr>
        <tr>
            <td>Lundi</td>
            <td class="tdhoraire"><?php if ($tabconvention["lundimatin"] != "") { ?>De <?php echo $tabconvention["lundimatin"]; ?> à <?php echo $tabconvention["pause_dej_h1_lundi"]; ?><?php } ?></td>
            <td class="tdhoraire"><?php if ($tabconvention["lundiaprem"] != "") { ?>De <?php echo $tabconvention["pause_dej_h2_lundi"]; ?> à <?php echo $tabconvention["lundiaprem"]; ?><?php } ?></td>
        </tr>
        <tr>
            <td>Mardi</td>
            <td class="tdhoraire"><?php if ($tabconvention["mardimatin"] != "") { ?>De <?php echo $tabconvention["mardimatin"]; ?> à <?php echo $tabconvention["pause_dej_h1_mardi"]; ?><?php } ?></td>
            <td class="tdhoraire"><?php if ($tabconvention["mardiaprem"] != "") { ?>De <?php echo $tabconvention["pause_dej_h2_mardi"]; ?> à <?php echo $tabconvention["mardiaprem"]; ?><?php } ?></td>
        </tr>
        <tr>
            <td>Mercredi</td>
            <td class="tdhoraire"><?php if ($tabconvention["mercredimatin"] != "") { ?>De <?php echo $tabconvention["mercredimatin"]; ?> à <?php echo $tabconvention["pause_dej_h1_mercredi"]; ?><?php } ?></td>
            <td class="tdhoraire"><?php if ($tabconvention["mercrediaprem"] != "") { ?>De <?php echo $tabconvention["pause_dej_h2_mercredi"]; ?> à <?php echo $tabconvention["mercrediaprem"]; ?><?php } ?></td>
        </tr>
        <tr>
            <td>Jeudi</td>
            <td class="tdhoraire"><?php if ($tabconvention["jeudimatin"] != "") { ?>De <?php echo $tabconvention["jeudimatin"]; ?> à <?php echo $tabconvention["pause_dej_h1_jeudi"]; ?><?php } ?></td>
            <td class="tdhoraire"><?php if ($tabconvention["jeudiaprem"] != "") { ?>De <?php echo $tabconvention["pause_dej_h2_jeudi"]; ?> à <?php echo $tabconvention["jeudiaprem"]; ?><?php } ?></td>
        </tr>
        <tr>
            <td>Vendredi</td>
            <td class="tdhoraire"><?php if ($tabconvention["vendredimatin"] != "") { ?>De <?php echo $tabconvention["vendredimatin"]; ?> à <?php echo $tabconvention["pause_dej_h1_vendredi"]; ?><?php } ?></td>
            <td class="tdhoraire"><?php if ($tabconvention["vendrediaprem"] != "") { ?>De <?php echo $tabconvention["pause_dej_h2_vendredi"]; ?> à <?php echo $tabconvention["vendrediaprem"]; ?><?php } ?></td>
        </tr>
        <tr>
            <td>Samedi</td>
            <td class="tdhoraire"><?php if ($tabconvention["samedimatin"] != "") { ?>De <?php echo $tabconvention["samedimatin"]; ?> à <?php echo $tabconvention["pause_dej_h1_samedi"]; ?><?php } ?></td>
            <td class="tdhoraire"><?php if ($tabconvention["samediaprem"] != "") { ?>De <?php echo $tabconvention["pause_dej_h2_samedi"]; ?> à <?php echo $tabconvention["samediaprem"]; ?><?php } ?></td>
        </tr>
    </table>
    <table>
        <tr>
            <td class="fontsize15">
                <h3>L’annexe pédagogique à la convention prend la forme d’un livret de suivi des périodes de formation
                    en milieu professionnel</h3>
                <p>Ce document élaboré par l’équipe pédagogique doit préciser :</p>
                <span class="center">
                    <ul class="tiret">
                        <li>Le nom de l’élève, les coordonnées de l’établisement ,le nom des enseignants référents.</li>
                        <li>Le nom du tuteur, les coordonnées de l’entreprise.</li>
                        <li>Le diplôme préparé.</li>
                        <li>Le nom du ou des professeurs chargés de suivre le déroulement de la formation en milieu
                            professionnel.
                        </li>
                        <li>Les dates de début et de fin pour toutes les périodes.</li>
                        <li>Les modalités de concertation entre le(s) professeur(s) et le tuteur pour contrôler le
                            déroulement de la période.
                        </li>
                        <li>Les objectifs assignés à la PFMP.</li>
                        <li>Les activités prévues en milieu professionnel.</li>
                        <li>Les travaux effectués, équipements ou produits utilisés soumis à la procédure de dérogation
                            pour travaux interdits aux mineurs (élèves bénéficiant de la dérogation en application des
                            articles A.4152-1 à 4152-34 , cf. article 10 de la convention).
                        </li>
                        <li>Modalités d’évaluation de la période de formation en milieu professionnel, en référence au
                            règlement d’examen du diplôme préparé.
                        </li>
                    </ul>
                </span>


            </td>
        </tr>
    </table>
    <table style="border-collapse: collapse;" border=1 class="fontbold">
        <tr>
            <td style="padding:10 10 10 10;width:900px;text-align:center;font-size:23px;">
                Annexe financière
            </td>
        </tr>
    </table>
    <table style="width:100%;" class="fontsize15"><!---->
        <tr>
            <td style="text-align: left;">
                <p>Pour aider l’établissement à mieux gérer ses frais d’organisation des périodes de formation en milieu
                    professionnel, nous vous serions reconnaissants de bien vouloir remplir le questionnaire suivant et
                    le retourner avec la convention signée.</p>
                <p>L’entreprise participe-t-elle aux frais d’organisation des périodes de formation en milieu
                    professionnel.</p>
            </td><!---->
            <table style="width:100%;" class="fontsize15">
                <tr>
                    <td>OUI
                        <?php if ($tabconvention["finance_ent"] == "1") { ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/images/choixvalid.png" height="15"
                                 width="20"/>
                        <?php } else { ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/images/choixvide.png" height="15"
                                 width="20"/>
                        <?php } ?>
                    </td>
                    <td>
                        <span class="fontbold">Si oui :</span>
                    </td>
                    <td>Frais de restauration : <?php echo ($tabconvention["finance_rest1"]); ?></td>
                    <td>soit par repas : <?php echo ($tabconvention["finance_rest2"]); ?></td>
                </tr>
                <tr>
                    <td>NON
                        <?php if ($tabconvention["finance_ent"] == "0") { ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/images/choixvalid.png" height="15"
                                 width="20"/>
                        <?php } else { ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/images/choixvide.png" height="15"
                                 width="20"/>
                        <?php } ?>
                    </td>
                    <td></td>
                    <td>Frais de transport : <?php echo ($tabconvention["finance_transp1"]); ?></td>
                    <td>soit par jour : <?php echo ($tabconvention["finance_transp2"]); ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>Frais d’hébergement : <?php echo ($tabconvention["finance_rest1"]); ?></td>
                    <td>soit par nuit : <?php echo ($tabconvention["finance_rest2"]); ?></td>
                </tr>
            </table>
            <!--            </td>-->
        </tr>
    </table>
    <table style="width:100%;" class="fontsize15">
        <tr>
            <td colspan=2>Gratification éventuelle : <?php echo ($tabconvention["finance_grat"]); ?></td>

        <tr>
            <td style="width:50%;">Montant de la gratification
                : <?php echo ($tabconvention["finance_grat_montant"]); ?></td>
            <td style="width:50%;">Modalités de versement : <?php echo ($tabconvention["finance_versement"]); ?></td>
        </tr>
    </table>

    <table style="width:100%;border-collapse: collapse;" border=1 class="fontsize15">
        <tr>
            <td colspan=2 style="text-align:center;padding:10px;font-weight: bold;">Assurance (Obligatoire) : article 14
                de la convention
                – Assurance responsabilité civile
            </td>
        </tr>
        <tr>
            <td style="width:50%;text-align:center;padding:10px;font-weight: bold;">Pour l’entreprise</td>
            <td style="width:50%;text-align:center;padding:10px;font-weight: bold;">Pour le lycée professionnel</td>
        </tr>
        <tr>
            <td style="padding:10px;">
                <table>
                    <tr>
                        <td>Nom de l’assureur :</td>
                        <td><?php echo ($tabconvention["ent_assurreur"]); ?></td>
                    </tr>
                    <tr>
                        <td>N° du contrat :</td>
                        <td><?php echo ($tabconvention["ent_numcontrat"]); ?></td>
                    </tr>
                </table>
            </td>
            <td style="padding:10px;" class="border">
                <table>
                    <tr>
                        <td>Nom de l’assureur :</td>
                        <td><?php echo ($tabconvention["uai_assureur"]); ?></td>
                    </tr>
                    <tr>
                        <td>N° du contrat :</td>
                        <td><?php echo ($tabconvention["uai_numcontrat"]); ?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>


</page>
<htmlpagefooter name="page1">
    <table style="width: 100%;">
        <tr>
            <td style="text-align: right; font-size:10px;width: 100%">
                Page 6 sur 6
            </td>
        </tr>
    </table>
</htmlpagefooter>
<sethtmlpagefooter name="page1" value="on" show-this-page="1"/>

</body>
</html>
