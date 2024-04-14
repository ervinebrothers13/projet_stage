<html>
<head>
    <link href="model/stylempdf.css" rel="stylesheet">
</head>
<body>


<page orientation='1' backtop='5mm' backbottom='5mm' backleft='1mm'>

    <table style="width: 100%; padding: 0px;" border="0">
        <tr>
            <td style="text-align:center; width: 45%;">
                <img src="<?php echo get_template_directory_uri(); ?>/images/logo-ministere.png"/>
                <p>
                    <span id='texteministere'><?php echo NMIN; ?></span><table><tr><td style="height:10px;"></td></tr></table><table><tr><td style="height:10px;"></td></tr></table>
                    <span id='textedgee'>DIRECTION GENERALE DE L’EDUCATION<table><tr><td style="height:10px;"></td></tr></table>ET DES ENSEIGNEMENTS<table><tr><td style="height:10px;"></td></tr></table></span><table><tr><td style="height:10px;"></td></tr></table>
                    <span id='textedgee'>Référence de la convention : <?php echo $tabconvention["reference"]; ?><table><tr><td style="height:10px;"></td></tr></table></span><table><tr><td style="height:10px;"></td></tr></table>

                </p>
            </td>
            <td style="text-align:center; vertical-align:middle; width: 55%;padding-top:20px;">
                <span id='textepolynesie'>P&nbsp;&nbsp;O&nbsp;&nbsp;L&nbsp;&nbsp;Y&nbsp;&nbsp;N&nbsp;&nbsp;É&nbsp;&nbsp;S&nbsp;&nbsp;I&nbsp;&nbsp;E&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;F&nbsp;&nbsp;R&nbsp;&nbsp;A&nbsp;&nbsp;N&nbsp;&nbsp;Ç&nbsp;&nbsp;A&nbsp;&nbsp;I&nbsp;&nbsp;S&nbsp;&nbsp;E</span>
                <hr style="height:1px; color:#000;margin-top:14px;"/>

                <?php

                if ($tabeleve["uai_logo"] != "" and $tabeleve["uai_logo"] != null) {

                    ?>

                    <img src="<?php echo get_site_url(); ?>/wp-content/uploads/logouai/<?php echo $tabeleve["uai_logo"]; ?>"/>

                <?php } else { ?>


                    <?php
                }

                ?>
            </td>
        </tr>

    </table>
    
    <table style="border-collapse: collapse;border-bottom:1px solid black;">
        <tr>
            <td style="width:700px;text-align:center;" class="fontbold">
                <span id='textepolynesie'>CONVENTION TYPE RELATIVE A LA PERIODE DE FORMATION EN MILIEU PROFESSIONNEL</span>
            </td>
        </tr>
    </table>
   
    <table style="border-collapse: collapse;" border=1 class="bloccenter">
        <tr>
            <td style="padding:5 10 5 10;width:900px; text-align:left;">
               Intitulé du diplôme préparé et de la spécialité : <?php echo ($tabconvention["elv_diplome"]); ?>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td style="text-align:left;">
                <span class="fontbold">Entre l’entreprise (ou l’organisme) ci-dessous désigné(e)</span>
            </td>
        </tr>
    </table>
	<table><tr><td style="height:5px;"></td></tr></table>
    <table style="border-collapse: collapse;" border=1 class="tableentitepfmp">
        <tr>
            <td style="padding:10px;width:900px;text-align:left;">

                <table>
                    <tr>
                        <td style="text-align:left;">
                            Nom de l’entreprise (ou de l’organisme) d’accueil : <?php echo ($tabconvention["ent_nom"]); ?>
                        </td>
                    </tr>
					<tr><td style="height:10px;"></td></tr>
                    <tr>
                        <td style="text-align:left;" class="fontbold">
                            Adresse de l’entreprise : <?php echo ($tabconvention["ent_adr"]); ?>
                    </tr>
                </table>
				<table>
				<tr>
				<td style="width:15px"></td>
				<td>
                <table>
                    <tr>
                        <td colspan=2 style="text-align:left;">
                            Domaine d’activités de l’entreprise : <?php echo ($tabconvention["sect_lib"]); ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:450px;text-align:left;">
                            N° téléphone : <?php echo ($tabconvention["ent_tel"]); ?>
                        </td>
                        <td style="width:450px;text-align:left;">
                            N° télécopieur : <?php echo ($tabconvention["ent_copier"]); ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan=2 style="text-align:left;">
                            N° d’immatriculation de l’entreprise : <?php echo ($tabconvention["ent_numtahiti"]); ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:450px;text-align:left;">
                            Représenté(e) par : <?php echo ($tabconvention["ent_represant"]); ?>
                        </td>
                        <td style="width:450px;text-align:left;">
                            <span style="font-weight:bold;">Fonction</span>
                            : <?php echo ($tabconvention["ent_represant_funct"]); ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan=2 style="text-align:left;">
                            Mail : <?php echo ($tabconvention["ent_mail"]); ?>
                        </td>
                    </tr>
                </table>
				</td>
				</tr>
				</table>
            </td>
        </tr>
    </table>
	<table><tr><td style="height:20px;"></td></tr></table>
    <table>
        <tr>
            <td style="text-align:left;">
                <span class="fontbold">L’établissement d’enseignement professionnel :</span>
            </td>
        </tr>
    </table>
	<table><tr><td style="height:5px;"></td></tr></table>
    <table style="border-collapse: collapse;" border=1 class="tableentitepfmp">
        <tr>
            <td style="padding:10px;width:900px;text-align:left;">

                <table>
                    <tr>
                        <td style="text-align:left;" class="fontbold">
                            Nom de l’établissement :
                        </td>
                    </tr>
                </table>
				<table>
				<tr>
				<td style="width:15px"></td>
				<td>
                <table>
                    <tr>
                        <td colspan=2 style="text-align:left;">
                            Adresse : <?php echo ($tabconvention["uai_adr"]); ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:450px;text-align:left;">
                            N° téléphone : <?php echo ($tabconvention["uai_tel"]); ?>
                        </td>
                        <td style="width:450px;text-align:left;">
                            N° télécopieur : <?php echo ($tabconvention["uai_copier"]); ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:450px;text-align:left;">
                            Représenté(e) par : <?php echo ($tabconvention["uai_represant"]); ?>
                        </td>
                        <td style="width:450px;text-align:left;">
                            en qualité de chef d’établissement
                        </td>
                    </tr>
                    <tr>
                        <td colspan=2 style="text-align:left;">
                            Mail : <?php echo ($tabconvention["uai_mail"]); ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:450px;text-align:left;">
                            Nom de l’enseignant-référent : <?php echo ($tabconvention["referent_nom"]); ?>
                        </td>
                        <td style="width:450px;text-align:left;">
                            N° téléphone : <?php echo ($tabconvention["referent_tel"]); ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan=2 style="text-align:left;">
                            Mail : <?php echo ($tabconvention["referent_mail"]); ?>
                        </td>
                    </tr>
                </table>
				</td>
				</tr>
				</table>
            </td>
        </tr>
    </table>
	<table><tr><td style="height:20px;"></td></tr></table>
    <table>
        <tr>
            <td style="text-align:left;">
                <span class="fontbold">L’élève :</span>
            </td>
        </tr>
    </table>
	<table><tr><td style="height:5px;"></td></tr></table>
    <table style="border-collapse: collapse;" border=1 class="tableentitepfmp">
        <tr>
            <td style="padding:10px;width:900px;text-align:left;">

                <table>

                    <tr>
                        <td style="width:450px;text-align:left;" class="fontbold">
                            Nom : <?php echo ($tabconvention["elv_nom"]); ?>
                        </td>
                        <td style="width:450px;text-align:left;" class="fontbold">
                            Prénom : <?php echo ($tabconvention["elv_pren"]); ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan=2 style="text-align:left;">
                            Date de naissance : <?php echo fDate($tabconvention["elv_datenaiss"], "html"); ?>
                        </td>
                    </tr>
					<tr>
                        <td colspan=2 style="text-align:left;">
                            Adresse personnelle : <?php echo $tabconvention["elv_adr"]; ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:450px;text-align:left;">
                            N° téléphone ou Vini : <?php echo ($tabconvention["elv_tel"]); ?>
                        </td>
                        <td style="width:450px;text-align:left;">
                            Mail : <?php echo ($tabconvention["elv_mail"]); ?>
                        </td>
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
                Page 1 sur 6
            </td>
        </tr>
    </table>
</htmlpagefooter>
<sethtmlpagefooter name="page1" value="on" show-this-page="1"/>

<page orientation='1' backtop='5mm' backbottom='5mm' backleft='1mm'>
    <table class="txtarticlepfmp" style="100%">
        <tr>
            <td style="width:900px;">
                <p style="font-size:17px;">Vu la loi organique n° 2004-192 du 27 février 2004 modifiée, portant statut d’autonomie de la
                    Polynésie française ;</p>
                <p style="font-size:17px;">Vu le code de l’éducation applicable en Polynésie Française, notamment les articles L.331- 4 et
                    L.911- 4 ;</p>
                <p style="font-size:17px;">Vu le code civil, notamment l’article 1242 ;</p>
                <p style="font-size:17px;">Vu la loi du Pays n° 2011-15 du 4 mai 2011 modifiée, relative à la codification du droit du travail,
                    notamment les articles Lp. 3241-1 et Lp. 4152-1 à Lp. 4152-3 ; </p>
                <p style="font-size:17px;">Vu la loi du Pays n° 2017-15 du 13 juillet 2017 modifiée, relative à la Charte de l’éducation de la
                    Polynésie française ;</p>
                <p style="font-size:17px;">Vu l’arrêté n° 732 CM du 17 juin 1987 modifié, portant organisation administrative et financière des
                    établissements publics d’enseignement de la Polynésie française ;</p>
                <p style="font-size:17px;">Vu l’arrêté n°925 CM modifié, relatif à la codification du droit du travail, notamment les articles A
                    4152-1 à A 4152-34 ;</p>
                <p style="font-size:17px;">Vu la convention n° 99-16 du 22 octobre 2016 modifiée, relative à l’éducation entre la Polynésie
                    française et l’Etat ;</p>
                <p style="font-size:17px;">Vu la circulaire n° 35777/MEA/DGEE/DOI du 10 août 2023 relative à la procédure de déclaration des
                    accidents du travail et des accidents scolaires des élèves ;</p>
                <p style="font-size:17px;">Vu la délibération du conseil d’établissement en date du <?php echo ($tabconvention["uai_delib"]); ?>.
                    approuvant la convention-type et autorisant le chef d’établissement à conclure au nom de
                    l’établissement toute convention relative à la période de formation en milieu professionnel conforme
                    à la convention-type.</p>
                <table><tr><td style="height:5px;"></td></tr></table>

                <p>Il a été convenu ce qui suit :</p>
                <table><tr><td style="height:5px;"></td></tr></table>

                <h3 style="font-size:19px;">Article 1 - Objet de la convention</h3>
                <table><tr><td style="height:5px;"></td></tr></table>

                <p>La présente convention a pour objet la mise en œuvre, au bénéfice de l’élève de l’établissement
                    désigné, de périodes de formation en milieu professionnel (PFMP) réalisées dans le cadre de
                    l’enseignement professionnel.</p>
                <table><tr><td style="height:5px;"></td></tr></table>

                <h3 style="font-size:19px;">Article 2 - Finalité de la formation en milieu professionnel</h3>
                <table><tr><td style="height:5px;"></td></tr></table>

                <p>La finalité des périodes de formation en milieu professionnel corresponde à des périodes temporaires
                    de mise en situation en milieu professionnel au cours desquelles l’élève acquiert des compétences
                    professionnelles et met en œuvre les acquis de sa formation en vue d’obtenir un diplôme ou une
                    certification et de favoriser son insertion professionnelle. Le stagiaire se voit confier une ou des
                    missions conformes au projet pédagogique défini par son établissement d’enseignement et approuvées
                    par l’entreprise ou l’organisme d’accueil. En aucun cas, sa participation à ces activités ne doit
                    porter préjudice à la situation de l’emploi dans l’entreprise.</p>
                <table><tr><td style="height:5px;"></td></tr></table>

                <h3 style="font-size:19px;">Article 3 - Dispositions de la convention</h3>
                <table><tr><td style="height:5px;"></td></tr></table>

                <p>La convention comprend des dispositions générales et des dispositions particulières constituées par
                    les annexes pédagogique et financière. L’annexe pédagogique définit les objectifs et les modalités
                    pédagogiques de la période de formation en milieu professionnel. Cette annexe prend la forme d’un
                    livret de suivi. L’annexe financière définit les modalités de prise en charge des frais afférents à
                    la période, ainsi que les modalités d’assurance. La convention accompagnée de ses annexes est signée
                    par le chef d’établissement et le représentant de l’entreprise ou de l’organisme d’accueil de
                    l’élève. Elle est également signée par l’élève ou, s’il est mineur, par son représentant légal. Elle
                    doit, en outre, être portée à la connaissance des enseignants et du tuteur en entreprise chargés du
                    suivi de l’élève. La convention est ensuite adressée à la famille pour information.</p>
                <table><tr><td style="height:5px;"></td></tr></table>

                <h3 style="font-size:19px;">Article 4 - Statut et obligations de l’élève</h3>
                <table><tr><td style="height:5px;"></td></tr></table>

                <p>L’élève demeure, durant ces périodes de formation en milieu professionnel, sous statut scolaire. Il
                    reste sous la responsabilité du chef d’établissement. L’élève ne doit pas être pris en compte dans
                    le calcul de l’effectif de l’entreprise. Il ne peut participer aux éventuelles élections
                    professionnelles. L’élève est soumis aux règles générales en vigueur dans l’entreprise, notamment en
                    matière de sécurité, d’horaires et de discipline, sous réserve des dispositions des articles 6 et 7
                    de la présente convention. L’élève est soumis au secret professionnel. Il est tenu d’observer une
                    entière discrétion sur l’ensemble des renseignements qu’il pourra recueillir à l’occasion de ses
                    fonctions ou du fait de sa présence dans l’entreprise. En outre, l’élève s’engage à ne faire figurer
                    dans son rapport de stage aucun renseignement confidentiel concernant l’entreprise.</p>
                <table><tr><td style="height:5px;"></td></tr></table>

                <h3 style="font-size:19px;">Article 5 - Gratification</h3>
                <table><tr><td style="height:5px;"></td></tr></table>

                <p>L’élève ne peut prétendre à aucune rémunération de l’entreprise ou de l’organisme d’accueil.
                    Toutefois, il peut lui être alloué une gratification.</p>
                    
               
            </td>
        </tr>
    </table>
</page>
<htmlpagefooter name="page2">
    <table style="width: 100%;">
        <tr>
            <td style="text-align: right; font-size:10px;width: 100%">
                Page 2 sur 6
            </td>
        </tr>
    </table>
</htmlpagefooter>
<sethtmlpagefooter name="page2" value="on" show-this-page="2"/>

<page orientation='1' backtop='5mm' backbottom='5mm' backleft='1mm'>
    <table class="txtarticlepfmp" style="100%">
        <tr>
            <td style="width:900px;">
				<p>Cette gratification n’a pas le caractère d’un salaire au sens de l’article Lp. 3312-2 de la loi du Pays n° 2011- 15 du 04 mai 2011.</p>
				<table><tr><td style="height:5px;"></td></tr></table>
                <h3 style="font-size:19px;">Article 6 - Durée du travail</h3>
                <table><tr><td style="height:5px;"></td></tr></table>

                <p>En ce qui concerne la durée du travail, tous les élèves sont soumis à la durée hebdomadaire légale ou conventionnelle si celle-ci est inférieure à la durée légale.</p>
                <table><tr><td style="height:5px;"></td></tr></table>

                <h3 style="font-size:19px;">Article 7 - Durée et horaires de travail des élèves majeurs</h3>
                <table><tr><td style="height:5px;"></td></tr></table>

                <p>Dans l’hypothèse où l’élève majeur est soumis à une durée hebdomadaire modulée, la moyenne des durées de travail hebdomadaires effectuées pendant la période en milieu professionnel ne pourra excéder les limites indiquées ci-dessus.
                <p>En ce qui concerne le travail de nuit, seul l’élève majeur nommément désigné par le chef d’établissement scolaire peut être incorporé à une équipe de nuit.</p>
                <table><tr><td style="height:5px;"></td></tr></table>

                <h3 style="font-size:19px;">Article 8 - Durée et horaires de travail des élèves mineurs</h3>
                <table><tr><td style="height:5px;"></td></tr></table>

                <p>La durée de travail de l’élève mineur ne peut excéder 8 heures par jour et 39 heures par semaine.</p>
				<table><tr><td style="height:0px;"></td></tr></table>
                <p>Le repos hebdomadaire de l’élève mineur doit être d’une durée minimale de deux jours consécutifs. La période minimale de repos hebdomadaire doit comprendre le dimanche, sauf en cas de dérogation légale. Pour chaque période de vingt-quatre heures, la période minimale de repos quotidien est fixée à onze heures consécutives. Au-delà de quatre heures et demie de travail quotidien, l’élève mineur doit bénéficier d’une pause d’au moins trente minutes consécutives.</p>
					<table><tr><td style="height:0px;"></td></tr></table>
                <p>Le travail de nuit est interdit aux élèves de moins de dix-huit ans entre vingt heures et six
                    heures.</p>
					<table><tr><td style="height:0px;"></td></tr></table>
                <p>Aucune dérogation ne peut être accordée à cette interdiction.</p>
                <table><tr><td style="height:5px;"></td></tr></table>

                <h3 style="font-size:19px;">Article 9 – Avantages offerts par l’entreprise ou l’organisme d’accueil</h3>
                <table><tr><td style="height:5px;"></td></tr></table>

                <p>Le stagiaire a accès au restaurant d’entreprise ou aux titres de-restaurant s’il existe, dans les mêmes conditions que les salariés de l’entreprise ou de l’organisme d’accueil. Il bénéficie également de la prise en charge des frais de transport, s’il existe.</p>
                <table><tr><td style="height:5px;"></td></tr></table>

                <h3 style="font-size:19px;">Article 10- Sécurité - travaux interdits aux mineurs</h3>
                <table><tr><td style="height:5px;"></td></tr></table>

                <p>En application des articles A.4152-1 à 4152-34, l’élève mineur de quinze ans au moins, peut être affecté aux travaux réglementés après que l’entreprise ait adressé à l’inspecteur du travail une dérogation aux travaux interdits aux mineurs. La déclaration de dérogation, doit préciser le secteur d’activité de l’entreprise, les formations professionnelles pour lesquelles elle est établie, les différents lieux de formation, la liste des travaux susceptibles de dérogation et les équipements de travail liés à ces travaux ainsi que la qualité et la fonction de la (ou des) personnes(s)compétente(s) pour encadrer le jeune pendant l’exécution des travaux précités. Elle est signée par le chef d’entreprise et adressée à l’inspecteur du travail.</p>
                <table><tr><td style="height:5px;"></td></tr></table>

                <h3 style="font-size:19px;">Article 11 - Sécurité électrique</h3>
                <table><tr><td style="height:5px;"></td></tr></table>

                <p>L’élève ayant à intervenir, au cours de sa période de formation en milieu professionnel, sur - ou à proximité - des installations et des équipements électriques, doit y être habilité par le chef de l’entreprise d’accueil en fonction de la nature des travaux à effectuer. Cette habilitation ne peut être accordée qu’à l’issue d’une formation à la prévention des risques électriques suivie par l’élève en établissement scolaire, préalablement à sa période de formation en milieu professionnel.
                <p>L’habilitation est délivrée au vu d’un carnet individuel de formation établi par l’établissement scolaire qui certifie que, pour les niveaux d’habilitation mentionnés, la formation correspondante a été suivie avec succès par l’élève.</p>
                <table><tr><td style="height:5px;"></td></tr></table>

                <h3 style="font-size:19px;">Article 12 - Déclaration d’accident ((Voir la Circulaire n° 35777/MEA/DGEE/DOI du 10 août 2023
                    ci-dessus référencée)</h3>
                <table><tr><td style="height:5px;"></td></tr></table>

                <p>Le responsable de l’entreprise ou de l’organisme d’accueil s’engage à signaler à l’établissement ou au référent dans la journée ou au plus tard dans les 24 heures, tout accident survenant au jeune stagiaire, tant au cours du stage que pendant les trajets de l’élève. L'obligation de déclaration d'accident incombe à l’établissement de formation (lycée).</p>
            </td>
        </tr>
    </table>
</page>
<htmlpagefooter name="page3">
    <table style="width: 100%;">
        <tr>
            <td style="text-align: right; font-size:10px;width: 100%">
                Page 3 sur 6
            </td>
        </tr>
    </table>
</htmlpagefooter>
<sethtmlpagefooter name="page3" value="on" show-this-page="3"/>

<page orientation='1' backtop='5mm' backbottom='5mm' backleft='1mm'>
    <table class="txtarticlepfmp" style="100%">
        <tr>
            <td style="width:900px;">
				<p>Celui-ci adressera à la CPS, par télécopie dans les 48 heures suivant l’accident, la déclaration d’accident accompagnée de la copie de la convention. Pour le calcul de ce délai de 48 heures, les dimanches et jours fériés ne sont pas comptés. L'établissement de formation fait parvenir, sans délai, l’original de la déclaration en deux exemplaires à la division des affaires financières de la Direction de l’Education et des Enseignements.</p>
				<table><tr><td style="height:5px;"></td></tr></table>
                <h3 style="font-size:19px;">Article 13- Autorisation d’absence</h3>
                <table><tr><td style="height:5px;"></td></tr></table>

                <p>En cas de grossesse, de paternité ou d’adoption, le stagiaire bénéficie de congés et d’autorisations d’absence d’une durée équivalente à celles prévues pour les salariés relevant du régime de la caisse de prévoyance sociale.</p>
                <table><tr><td style="height:5px;"></td></tr></table>

                <h3 style="font-size:19px;">Article 14 - Assurance responsabilité civile</h3>
                <table><tr><td style="height:5px;"></td></tr></table>

                <p>Le chef de l’entreprise d’accueil prend les dispositions nécessaires pour garantir sa responsabilité civile chaque fois qu’elle peut être engagée. Le chef d’établissement contracte une assurance couvrant la responsabilité civile de l’élève pour les dommages qu’il pourrait causer pendant la durée de sa période de formation en milieu professionnel dans l’entreprise ou à l’occasion de la préparation de celle-ci.</p>
                <table><tr><td style="height:5px;"></td></tr></table>

                <h3 style="font-size:19px;">Article 15 - Encadrement et suivi de la période de formation en milieu professionnel</h3>
                <table><tr><td style="height:5px;"></td></tr></table>


                <p>Les conditions dans lesquelles l’enseignant-référent de l’établissement et le tuteur dans l’entreprise (ou l’organisme) d’accueil assurent l’encadrement et le suivi du stagiaire figurent dans l’annexe pédagogique jointe à la présente convention.</p>
                <table><tr><td style="height:5px;"></td></tr></table>

                <h3 style="font-size:19px;">Article 16 -Suspension et résiliation de la convention de stage</h3>
                <table><tr><td style="height:5px;"></td></tr></table>

                <p>Le chef d’établissement et le représentant de l’entreprise d’accueil se tiendront mutuellement informés des difficultés qui pourraient être rencontrées à l’occasion de la période de formation en milieu professionnel. Le cas échéant, ils prendront, d’un commun accord et en liaison avec l’équipe pédagogique, les dispositions propres à résoudre les problèmes d’absentéisme ou de manquement à la discipline. Au besoin, ils étudieront ensemble les modalités de suspension ou de résiliation de la période de formation en milieu professionnel.</p>
                <table><tr><td style="height:5px;"></td></tr></table>

                <h3 style="font-size:19px;">Article 17 - Validation de la période de formation en milieu professionnel en cas d’interruption</h3>
                <table><tr><td style="height:5px;"></td></tr></table>

                <p>Lorsque le stagiaire interrompt sa période de formation en milieu professionnel pour un motif lié à la maladie, à un accident, à la grossesse, à la paternité, à l’adoption, ou en accord avec l’établissement, en cas de non respect des stipulations pédagogiques de la convention ou en cas de rupture de la convention à l’initiative de l’organisme d’accueil, l’établissement propose au stagiaire une modalité alternative de validation de sa formation. En cas d’accord des parties à la convention, un report de la fin de la période de formation en milieu professionnel ou du stage, en tout ou partie, est également possible.</p>
                <table><tr><td style="height:5px;"></td></tr></table>

                <h3 style="font-size:19px;">Article 18 – Attestation de stage.</h3>
                <table><tr><td style="height:5px;"></td></tr></table>

                <p>A l’issue de la période de formation en milieu professionnel, le responsable de l’entreprise (ou organisme d’accueil) délivre une attestation conforme à l’attestation type figurant en annexe de la présente convention.</p>
                <table><tr><td style="height:0px;"></td></tr></table>

                <h3 style="font-size:19px;">Article 19 - Durée, enregistrement et exemplaire de la Convention</h3>
                <table><tr><td style="height:5px;"></td></tr></table>

                <p>La présente convention est établie au jour de la signature, pour la durée du stage d’initiation en milieu professionnel, soit du XXXX au XXXX, en trois (3) exemplaires originaux 1 pour l’entreprise, 1 pour le collège, 1 pour les parents.</p>
				<table><tr><td style="height:0px;"></td></tr></table>
				<p>Elle n’est pas renouvelable par tacite reconduction.</p>
				<table><tr><td style="height:0px;"></td></tr></table>
				<p>Elle est exempte de tous droits de timbre et d’enregistrement.</p>
              
            </td>
        </tr>
    </table>
</page>
<htmlpagefooter name="page4">
    <table style="width: 100%;">
        <tr>
            <td style="text-align: right; font-size:10px;width: 100%">
                Page 4 sur 6
            </td>
        </tr>
    </table>
</htmlpagefooter>
<sethtmlpagefooter name="page4" value="on" show-this-page="4"/>

</body>
</html>
