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
                    <span id='texteministere'><?php echo NMIN; ?></span><table><tr><td style="height:2px;"></td></tr></table><table><tr><td style="height:2px;"></td></tr></table>
                    <span id='textedgee'>DIRECTION GENERALE DE L’EDUCATION<table><tr><td style="height:2px;"></td></tr></table>ET DES ENSEIGNEMENTS<table><tr><td style="height:2px;"></td></tr></table></span><table><tr><td style="height:2px;"></td></tr></table>
                    <span id='textedgee'>Référence de la convention : <?php echo $tabconvention["reference"]; ?><table><tr><td style="height:2px;"></td></tr></table></span><table><tr><td style="height:2px;"></td></tr></table>

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
   
    <table>
        <tr>
            <td style="width:700px;text-align:center;" class="fontbold">
                <span style="font-size:14px;text-decoration:underline;" >CONVENTION RELATIVE AUX STAGES DES ETUDIANTS INSCRITS EN BTS</span>
            </td>
        </tr>
    </table>
	
	 <table class="txtarticle">
        <tr>
            <td class="lignetext">
				<p style="font-size:13px;">Vu la loi organique n° 2004-192 du 27 février 2004 modifiée, portant statut d’autonomie de la Polynésie française;</p>
				<p style="font-size:13px;">Vu le code de l’éducation applicable en Polynésie Française, notamment ses articles L.331-4 et L.911-4;</p>
				<p style="font-size:13px;">Vu le code civil, notamment l’article 1242;</p>
				<p style="font-size:13px;">Vu la loi du Pays n° 2011-15 du 4 mai 2011 modifiée, relative à la codification du droit du travail, notamment les articles Lp. 3241-1 et Lp. 4152-1 à Lp. 4152-3;</p>
				<p style="font-size:13px;">Vu la loi du Pays n° 2017-15 du 13 juillet 2017 modifiée, relative à la Charte de l’éducation de la Polynésie française;</p>
				<p style="font-size:13px;">Vu l’arrêté n° 732 CM du 17 juin 1987 modifié, portant organisation administrative et financière des établissements publics d’enseignement de la Polynésie française;</p>
				<p style="font-size:13px;">Vu l’arrêté n°925 CM modifié, relatif à la codification du droit du travail, notamment les articles A 4152-1 à A 4152-34;</p>
				<p style="font-size:13px;">Vu la convention n° 99-16 du 22 octobre 2016 modifiée, relative à l’éducation entre la Polynésie française et l’Etat;</p>
				<p style="font-size:13px;">Vu la circulaire n° 35777/MEA/DGEE/DOI du 10 août 2023 relative à la procédure de déclaration des accidents du travail et des accidents scolaires des élèves;</p>
				<p style="font-size:13px;">Vu la délibération du conseil d’établissement en date du  <?php echo ($tabconvention["uai_delib"]); ?>.  approuvant la convention-type et autorisant le chef d’établissement à conclure au nom de l’établissement toute convention relative aux stages des élèves inscrits en BTS.</p>
			</td>
		</tr>
	</table>
   <table><tr><td style="height:3px;"></td></tr></table>
	<table>
        <tr>
            <td style="text-align:left;font-size:16px;font-weight:bold;">
                Entre :
            </td>
        </tr>
    </table>
	<table>
        <tr>
            <td style="text-align:left;">
                <span class="fontbold" >L’entreprise (ou l’organisme d’accueil) ci-dessous désigné(e)</span>
            </td>
        </tr>
    </table>
	<table><tr><td style="height:3px;"></td></tr></table>
    <table style="border-collapse: collapse;" border=1 class="tableentite">
        <tr>
            <td style="width:900px;text-align:left;">

                <table>
                    <tr>
                        <td style="text-align:left;font-weight:bold;">
                            Nom de l’entreprise (ou de l’organisme) d’accueil : <?php echo ($tabconvention["ent_nom"]); ?>
                        </td>
                    </tr>
                </table>
				 <table>
                    <tr>
                        <td style="text-align:left;font-weight:bold;">
                            Adresse de l’entreprise :  <?php echo ($tabconvention["ent_adr"]); ?>
                        </td>
                    </tr>
                </table>
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
                        <td colspan=2 style="width:700px;text-align:left;">
                            N° d’immatriculation de l’entreprise :  <?php echo ($tabconvention["ent_numtahiti"]); ?>
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
                            Courriel :  <?php echo ($tabconvention["ent_represant_mail"]); ?>
                        </td>
                    </tr>
					<tr>
                        <td style="width:450px;text-align:left;">
                           Nom du tuteur de stage : <?php echo ($tabconvention["ent_tuteur"]); ?>
                        </td>
                        <td style="width:450px;text-align:left;">
                            <span style="font-weight:bold;">Fonction</span>
                            : <?php echo ($tabconvention["ent_tuteur_funct"]); ?>
                        </td>
                    </tr>
					<tr>
                        <td style="width:450px;text-align:left;">
                            Courriel :  <?php echo ($tabconvention["ent_tuteur_mail"]); ?>
                        </td>
						<td style="width:450px;text-align:left;">
                            N° téléphone :  <?php echo ($tabconvention["ent_tuteur_tel"]); ?>
                        </td>
                    </tr>
                 </table>
            </td>
        </tr>
    </table>
	<table><tr><td style="height:3px;"></td></tr></table>
   <table>
        <tr>
            <td style="text-align:left;">
                <span class="fontbold" style="font-size:14px;">L’établissement d’enseignement professionnel :</span>
            </td>
        </tr>
    </table>
	<table><tr><td style="height:3px;"></td></tr></table>
    <table style="border-collapse: collapse;" border=1 class="tableentite">
        <tr>
            <td style="width:900px;text-align:left;">

                <table>
                    <tr>
                        <td style="text-align:left;" class="fontbold">
                            Nom de l’établissement : <?php echo ($tabeleve["uai_ll"]); ?>
                        </td>
                    </tr>
                </table>
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
                            Courriel : <?php echo ($tabconvention["uai_represant_mail"]); ?>
                        </td>
						
                    </tr>
					 <tr>
                        <td style="width:450px;text-align:left;">
                            Nom de l’enseignant -référent : <?php echo ($tabconvention["referent_nom"]); ?>
                        </td>
                        <td style="width:450px;text-align:left;">
                            N° téléphone : <?php echo ($tabconvention["referent_tel"]); ?>
                        </td>
                    </tr>
					 <tr>
                        <td colspan=2 style="text-align:left;">
                            Courriel : <?php echo ($tabconvention["referent_mail"]); ?>
                        </td>
						
                    </tr>
                 </table>
            </td>
        </tr>
    </table>
    
    <table><tr><td style="height:3px;"></td></tr></table>
    <table>
        <tr>
            <td style="text-align:left;">
                <span class="fontbold" style="font-size:14px;">L'étudiant :</span>
            </td>
        </tr>
    </table>
	<table><tr><td style="height:3px;"></td></tr></table>
    <table style="border-collapse: collapse;" border=1 class="tableentite">
        <tr>
            <td style="width:900px;text-align:left;">

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
                            Adresse personnelle : <?php echo ($tabconvention["elv_adr"]); ?>
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
                Page 1 sur 3
            </td>
        </tr>
    </table>
</htmlpagefooter>
<sethtmlpagefooter name="page1" value="on" show-this-page="1"/>

<page orientation='1' backtop='5mm' backbottom='5mm' backleft='1mm'>
    <table class="txtarticlebts">
        <tr>
            <td class="lignetext" style="width:900px;">
			
				<p style="text-decoration:underline;">Il a été convenu ce qui suit :</p>
				 
               <table><tr><td style="height:3px;"></td></tr></table>
				
				<p style="font-size:18px;line-height:22px;">Mme, M <?php echo ($tabconvention["responsable"]); ?> accepte de prendre en stage de formation l’étudiant (e) <?php echo ($tabconvention["etudiant"]); ?> scolarisé(e) en classe de <?php echo ($tabconvention["elv_class"]); ?></p>
				<table><tr><td style="height:3px;"></td></tr></table>

               <h3 style="font-weight:300;font-size:14px;">Art. I – <span style="text-decoration:underline;font-size:17px;font-weight:bold;" >OBJECTIFS ET ORGANISATION</span></h3>
			   <table><tr><td style="height:2px;"></td></tr></table>
			   <table>
			   <tr>
			   <td style="width:30px"></td>
			   <td style="width:870px">
			   
				   <table>
					
					<tr>
					
						<td style="width:150px;text-decoration:underline;font-weight:bold;">Objectif :</td>
						<td style="text-align:justify;">Le stage a pour objet l’application pratique de l’enseignement dispensé dans 
		l’établissement, sans que l’employeur ou l’organisme d’accueil ne puisse retirer aucun profit direct de la présence dans son entreprise ou dans son organisme d’accueil d’un étudiant stagiaire.
		</td>
						
						</tr>
						<tr>
						
						<td style="width:150px;text-decoration:underline;font-weight:bold;">Durée :</td>
						<td>
							<p style="text-align:justify;">Le stage se déroulera suivant le calendrier joint ou durant la période suivante :</p>
							<p style="text-align:justify;"><?php echo $tabconvention["date_stage"]; ?></p>
							<p style="text-align:justify;">Horaires de l’entreprise (ou de l’organisme d’accueil) : De <?php echo $tabconvention["typ_horaire_opt1_h1"]; ?> à <?php echo $tabconvention["typ_horaire_opt1_h2"]; ?></p>
							<p style="text-align:justify;">Lieu du stage : <?php echo $tabconvention["ent_lieustage"]; ?></p>
						</td>
						
						</tr>
						<tr>
						
						<td style="width:150px;text-decoration:underline;font-weight:bold;">Programme :</td>
						<td style="text-align:justify;">Le stage a pour objet l’application pratique de l’enseignement dispensé dans 
		l’établissement, sans que l’employeur ou l’organisme d’accueil ne puisse retirer aucun profit direct de la présence dans son entreprise ou dans son organisme d’accueil d’un étudiant stagiaire.
		</td>
					
					</tr>
				   
				   
				   </table>
			   </td>
			   </tr>
			   </table>
				<table><tr><td style="height:2px;"></td></tr></table>
				
				<h3 style="font-weight:300;font-size:14px;">Art. II – <span style="text-decoration:underline;font-size:17px;font-weight:bold;" >OBLIGATIONS DU STAGIAIRE</span></h3>
				<table><tr><td style="height:3px;"></td></tr></table>
				<p>Durant le stage, l’étudiant demeure sous statut scolaire et reste sous la responsabilité du chef d’établissement.</p>
				<table><tr><td style="height:0px;"></td></tr></table>
				<p>Il sera soumis au règlement intérieur de l’entreprise ou de l’organisme d’accueil. L’étudiant ne doit pas être pris en compte dans le calcul de l’effectif de l’entreprise ou de l’organisme d’accueil. Il ne peut participer aux éventuelles élections professionnelles. L’étudiant est soumis aux règles générales en vigueur dans l’entreprise ou dans l’organisme d’accueil, notamment en matière de sécurité, d’horaires et de discipline. L’étudiant est soumis au secret professionnel. Il est tenu d’observer une entière discrétion sur l’ensemble des renseignements qu’il pourra recueillir à l’occasion de ses fonctions ou du fait de sa présence dans l’entreprise ou dans l’organisme d’accueil. En outre, l’élève s’engage à ne faire figurer dans son compte-rendu de fin de stage aucun renseignement confidentiel concernant l’entreprise.</p>
				<table><tr><td style="height:0px;"></td></tr></table>
				<p>L’étudiant adoptera une attitude respectueuse vis-à-vis du personnel et des responsables de l’entreprise ou de l’organisme d’accueil. Il sera suivi conjointement par son tuteur désigné par l’entreprise et par un professeur de l’établissement scolaire. A l’issue du stage un compte-rendu rédigé par l’élève sera communiqué à l’entreprise. </p>
				<table><tr><td style="height:0px;"></td></tr></table>
				<p>Pendant la durée du stage, l’étudiant est susceptible de revenir au lycée pour y suivre certains cours dont la date sera portée à la connaissance du Chef d’Entreprise ou du responsable de l’organisme d’accueil avant le commencement du stage.</p>
				<table><tr><td style="height:3px;"></td></tr></table>
				<h3 style="font-weight:300;font-size:14px;">Art. III – <span style="text-decoration:underline;font-size:17px;font-weight:bold;" >DUREE DU TRAVAIL</span></h3>

				<table><tr><td style="height:3px;"></td></tr></table>
				<p>En ce qui concerne la durée du travail, tous les élèves sont soumis à la durée hebdomadaire légale ou conventionnelle si celle-ci est inférieure à la durée légale.</p> 
				<table><tr><td style="height:0px;"></td></tr></table>
				<p>En ce qui concerne la durée du travail, tous les élèves sont soumis à la durée hebdomadaire légale ou conventionnelle si celle-ci est inférieure à la durée légale.</p>
				<p>Dans l’hypothèse où l’étudiant est mineur, la durée de travail ne peut excéder 8 heures par jour et 39 heures par semaine.</p>
				<table><tr><td style="height:0px;"></td></tr></table>
				<p>Le repos hebdomadaire de l’étudiant mineur doit être d’une durée minimale de deux jours consécutifs. La période minimale de repos hebdomadaire doit comprendre le dimanche, sauf en cas de dérogation légale. Pour chaque période de vingt-quatre heures, la période minimale de repos quotidien est fixée à onze heures consécutives. Au-delà de quatre heures et demie de travail quotidien, l’étudiant mineur doit bénéficier d’une pause d’au moins trente minutes consécutives.</p>
				<table><tr><td style="height:0px;"></td></tr></table>
				<p>Le travail de nuit est interdit aux étudiants de moins de dix-huit ans entre vingt heures et six heures.</p>
				<table><tr><td style="height:0px;"></td></tr></table>
				<p>Aucune dérogation ne peut être accordée à cette interdiction.</p>
				<table><tr><td style="height:3px;"></td></tr></table>
				<h3 style="font-weight:300;font-size:14px;">Art. IV – <span style="text-decoration:underline;font-size:17px;font-weight:bold;" >OBLIGATIONS DU TUTEUR EN ENTREPRISE</span></h3>

				<table><tr><td style="height:3px;"></td></tr></table>
				<p>Le tuteur n’emploiera le stagiaire qu’à des tâches relatives à la formation pour laquelle le stage a été demandé. Il assumera pendant la durée du stage un rôle pédagogique. Néanmoins, il guidera le stagiaire par ses conseils en lui confiant des tâches de plus en plus complexes afin de développer son sens des responsabilités et assurer ainsi son perfectionnement professionnel.</p>
				<table><tr><td style="height:0px;"></td></tr></table>
				<p>Il veillera à l’assiduité du stagiaire et alertera l’établissement en cas d’absence.</p>
				<table><tr><td style="height:3px;"></td></tr></table>
				<h3 style="font-weight:300;font-size:14px;">Art. V – <span style="text-decoration:underline;font-size:17px;font-weight:bold;" >SECURITE ELECTRIQUE</span></h3>
				<table><tr><td style="height:3px;"></td></tr></table>
				<p>L’étudiant ayant à intervenir, au cours de sa période de stage, sur - ou à proximité - des installations et des équipements électriques, doit y être habilité par le chef d’entreprise ou le responsable de l’organisme d’accueil en fonction de la nature des travaux à effectuer. Cette habilitation ne peut être accordée qu’à l’issue d’une formation à la prévention des risques électriques suivie par l’étudiant en établissement scolaire, préalablement à sa période de stage. L’habilitation est délivrée au vu d’un carnet individuel de formation établi par l’établissement scolaire qui certifie que, pour les niveaux d’habilitation mentionnés, la formation correspondante a été suivie avec succès par l’étudiant.</p> 
			</td>
        </tr>
    </table>
</page>
<htmlpagefooter name="page2">
    <table style="width: 100%;">
        <tr>
            <td style="text-align: right; font-size:10px;width: 100%">
                Page 2 sur 3
            </td>
        </tr>
    </table>
</htmlpagefooter>
<sethtmlpagefooter name="page2" value="on" show-this-page="2"/>


</body>
</html>
