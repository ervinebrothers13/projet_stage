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
                    <span id='texteministere'><?php echo NMIN; ?></span><br><br>
                    <span id='textedgee'>DIRECTION GENERALE DE L’EDUCATION<br>ET DES ENSEIGNEMENTS<br></span><br>
                    <span id='textedgee'>Référence de la convention : <?php echo $tabconvention["reference"]; ?><br></span><br>

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
            <td style="height:15px;"></td>
        </tr>

    </table>
    <table style="border-collapse: collapse;border-bottom:1px solid black;">
        <tr>
            <td style="text-align:center;" class="fontbold">
                <span>CONVENTION RELATIVE A L’ORGANISATION DE STAGE D'OBSERVATION EN MILIEU PROFESSIONNEL</span>
            </td>
        </tr>
    </table>
	 <table class="txtarticle">
        <tr>
            <td class="lignetext">
                <p style="font-size:13px;">Vu la loi organique n° 2004-192 du 27 février 2004 modifiée, portant statut d’autonomie de la Polynésie française ;</p>
                <p style="font-size:13px;">Vu le code de l’éducation applicable en Polynésie Française, notamment les articles L.331-4 et L.911-4 ;</p>
                <p style="font-size:13px;">Vu le code civil, notamment l’article 1242 ;</p>
                <p style="font-size:13px;">Vu la loi du Pays n° 2011-15 modifiée, du 4 mai 2011 relative à la codification du droit du travail, notamment les articles Lp. 3241-1 et Lp. 4152-1 à Lp. 4152-3 ;</p>
                <p style="font-size:13px;">Vu la loi du Pays n° 2017-15 du 13 juillet 2017modifiée, relative à la Charte de l’éducation de la Polynésie française ;</p>
                <p style="font-size:13px;">Vu l’arrêté n° 732 CM du 17 juin 1987 modifié, portant organisation administrative et financière des établissements publics d’enseignement de la Polynésie française ;</p>
                <p style="font-size:13px;">Vu l’arrêté n°925 CM modifié, relatif à la codification du droit du travail, notamment les articles A 4152-1 à A 4152-34 ;</p>
                <p style="font-size:13px;">Vu la convention n° 99-16 du 22 octobre 2016 modifiée, relative à l’éducation entre la Polynésie française et l’Etat ;</p>
                <p style="font-size:13px;">Vu la circulaire n° 35777/MEA/DGEE/DOI du 10 août 2023 relative à la procédure de déclaration des accidents du travail et des accidents scolaires des élèves ;</p>
				<p style="font-size:13px;">Vu la délibération du conseil d’établissement en date du <?php echo ($tabconvention["uai_delib"]); ?>.  approuvant la convention-type et autorisant le chef d’établissement à conclure au nom de l’établissement toute convention relative à l’organisation de stage d’observation en 3ème  conforme à la convention-type.</p>
               
			</td>
		</tr>
	</table>
    <table>
        <tr>
            <td style="height:0px;"></td>
        </tr>

    </table>
   <table>
        <tr>
            <td style="text-align:left;">
                <span class="fontbold">Entre le collège :</span>
            </td>
        </tr>
    </table>
    <table style="border-collapse: collapse;margin-top:10px;" border=1 class="tableentite" >
        <tr>
            <td style="text-align:left;width:900px;">

                <table>
                    <tr>
                        <td style="text-align:left;" class="fontbold">
                            Nom de l’établissement : <?php echo ($tabeleve["uai_ll"]); ?>
                        </td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td style="text-align:left;width:450px;">
                            Adresse : <?php echo ($tabconvention["uai_adr"]); ?>
                        </td>
						<td style="text-align:left;width:450px;">
                            Mail : <?php echo ($tabconvention["uai_mail"]); ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:left;width:450px;">
                            N° téléphone : <?php echo ($tabconvention["uai_tel"]); ?>
                        </td>
                        <td style="text-align:left;width:450px;">
                            N° télécopieur : <?php echo ($tabconvention["uai_copier"]); ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:left;width:450px;">
                            Représenté(e) par : <?php echo ($tabconvention["uai_represant"]); ?>
                        </td>
                        <td style="text-align:left;width:450px;">
                            en qualité de chef d’établissement
                        </td>
                    </tr>
                 </table>
            </td>
        </tr>
    </table>
	<table><tr><td style="height:15px;"></td></tr></table>
    <table>
        <tr>
            <td style="text-align:left;">
                <span class="fontbold">L'entreprise ou l’organisme d’accueil :</span>
            </td>
        </tr>
    </table>
	<table><tr><td style="height:15px;"></td></tr></table>
    <table style="border-collapse: collapse;margin-top:10px;" border=1 class="tableentite" >
        <tr>
            <td style="text-align:left;width:900px;" >

                <table>
                    <tr>
                        <td style="text-align:left;font-weight:bold;">
                            Raison sociale et adresse  : <?php echo ($tabconvention["ent_nom"]); ?>
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
                        <td style="text-align:left;width:450px;">
                            N° téléphone : <?php echo ($tabconvention["ent_tel"]); ?>
                        </td>
                        <td style="text-align:left;width:450px;">
                            Mail : <?php echo ($tabconvention["ent_mail"]); ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:left;width:450px;">
                            Représenté(e) par : <?php echo ($tabconvention["ent_represant"]); ?>
                        </td>
                        <td style="text-align:left;width:450px;">
                            Fonction
                            : <?php echo ($tabconvention["ent_represant_funct"]); ?>
                        </td>
                    </tr>
                 </table>
            </td>
        </tr>
    </table>
    <table><tr><td style="height:15px;"></td></tr></table>
    <table>
        <tr>
            <td style="text-align:left;">
                <span class="fontbold">Le stagiaire :</span>
            </td>
        </tr>
    </table>
	<table><tr><td style="height:15px;"></td></tr></table>
    <table style="border-collapse: collapse;margin-top:10px;" border=1 class="tableentite">
        <tr>
            <td style="text-align:left;width:900px;">

                <table>

                    <tr>
                        <td style="text-align:left;width:450px;" class="fontbold">
                            Nom : <?php echo ($tabconvention["elv_nom"]); ?>
                        </td>
                        <td style="text-align:left;width:450px;" class="fontbold">
                            Prénom : <?php echo ($tabconvention["elv_pren"]); ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:left;width:450px;">
                            Date de naissance : <?php echo fDate($tabconvention["elv_datenaiss"], "html"); ?>
                        </td>
						<td style="text-align:left;width:450px;">
                            Adresse personnelle : <?php echo ($tabconvention["elv_adr"]); ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:left;width:450px;">
                            N° téléphone ou Vini : <?php echo ($tabconvention["elv_tel"]); ?>
                        </td>
                        <td style="text-align:left;width:450px;">
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
    <table class="txtarticle3eme">
        <tr>
            <td class="lignetext" style="width:900px;">
			
				<p class="fontbold" style="text-decoration:underline;">Il a été convenu ce qui suit :</p>
				<table><tr><td style="height:2px;"></td></tr></table>
				<table style="border-collapse: collapse;" border=1 class="fontbold">
					<tr>
						<td style="padding:10 10 10 10;width:900px;text-align:center;">
							TITRE PREMIER /DISPOSITIONS GENERALES
						</td>
					</tr>
				</table> 
				
                <table><tr><td style="height:5px;"></td></tr></table>

               <h3 style="font-size:19px;">Article 1 - Objet de la convention :</h3>
				 <table><tr><td style="height:5px;"></td></tr></table>
				<p>La présente convention a pour objet la mise en œuvre d’une séquence d’observation en milieu professionnel, au bénéfice de l’élève de l’établissement désigné en annexe pédagogique.</p> 
				 <table><tr><td style="height:5px;"></td></tr></table>
				<h3 style="font-size:19px;">Article 2 - Objectifs et modalités du stage :</h3>
				 <table><tr><td style="height:5px;"></td></tr></table>
				<p>Les objectifs et les modalités d’observation sont consignés dans l’annexe pédagogique. Les modalités de prise en charge des frais afférents à cette séquence ainsi que les modalités d’assurances sont définies dans l’annexe financière.</p>
				 <table><tr><td style="height:5px;"></td></tr></table>
				<h3 style="font-size:19px;">Article 3 - Organisation:</h3>

				 <table><tr><td style="height:5px;"></td></tr></table>
				<p>L’organisation de la séquence d’observation est déterminée d’un commun accord entre le chef d’entreprise ou le responsable de l’organisme d’accueil et le chef d’établissement.</p> 
				 <table><tr><td style="height:5px;"></td></tr></table>
				<h3 style="font-size:19px;">Article  4 -Statut et obligations de l’élève :</h3>
				 <table><tr><td style="height:5px;"></td></tr></table>
				<p>L’élève demeure sous statut scolaire durant la période d’observation en milieu professionnel et reste sous l’autorité du chef d’établissement. Il ne peut prétendre à aucune rémunération de l’entreprise ou de l’organisme d’accueil.</p> 
				 <table><tr><td style="height:5px;"></td></tr></table>
				<h3 style="font-size:19px;">Article 5 - Les modalités :</h3>
				 <table><tr><td style="height:5px;"></td></tr></table>
				<p>L’élève n’a pas à concourir au travail dans l’entreprise ou organisme d’accueil. 
				Au cours des séquences d’observation, l’élève peut effectuer des enquêtes en liaison avec les enseignements. Il peut également participer à des activités de l’entreprise ou de l’organisme d’accueil, à des essais ou à des démonstrations en liaison avec les enseignements et les objectifs de formation de leur classe, sous contrôle des personnels responsables de leur encadrement en milieu professionnel.</p> 
				<table><tr><td style="height:0px;"></td></tr></table>
				<p>Au cours du stage, l’élève ne peut accéder aux machines, appareils ou produits dont l’usage est proscrit aux mineurs par les articles A 4152-1 à A 4152-34 de l’arrêté 925 CM du 08/07/2011 modifié.</p> 
				<table><tr><td style="height:0px;"></td></tr></table>
				<p>La durée de présence de l’élève mineur ne peut excéder 8 heures par jour et 39 heures par semaine.</p>
				<table><tr><td style="height:0px;"></td></tr></table>
				<p>Au-delà de 4 heures et demie de travail quotidien, l’élève doit bénéficier d’une pause d’au moins 30 minutes consécutives.</p>
				<table><tr><td style="height:0px;"></td></tr></table>
				<p>La présence sur le lieu de stage est interdite à l’élève de moins de 18 ans entre 20 heures et 6 heures.</p> 
				<table><tr><td style="height:0px;"></td></tr></table>
				<p>Le repos entre deux journées de travail doit avoir une durée minimum de 11 heures.
				Le travail de nuit est interdit aux élèves de moins de dix-huit ans. Aucune dérogation ne peut être accordée à cette interdiction.</p> 
				<table><tr><td style="height:0px;"></td></tr></table>
				<p>Les élèves bénéficient de la durée totale des divers congés scolaires, aux dates fixées par le Ministre en charge de l’Education.</p> 
				 <table><tr><td style="height:5px;"></td></tr></table>
				<h3 style="font-size:19px;">Article 6 – Devoirs de l’élève au sein de l’entreprise</h3>

				 <table><tr><td style="height:5px;"></td></tr></table>
				<p>Le jeune stagiaire doit se conformer aux règles générales en vigueur dans l’entreprise ou l’organisme d’accueil qui sont portées à sa connaissance. En cas de manquement à ces règles, le responsable de l’entreprise ou de l’organisme d’accueil peut mettre fin au stage d’un commun accord avec le Chef d’établissement. L’élève est tenu au respect du secret professionnel.</p>
				 <table><tr><td style="height:5px;"></td></tr></table>
				<h3 style="font-size:19px;">Article 7 – Obligation du tuteur en entreprise</h3>

				 <table><tr><td style="height:5px;"></td></tr></table>
				<p>La formation dispensée durant le stage d’observation en milieu professionnel est organisée à la diligence du chef d’entreprise ou du responsable de l’organisme d’accueil qui doit prendre en compte, dans son organisation, les objectifs pédagogiques de l’établissement de formation.</p>
				 <table><tr><td style="height:5px;"></td></tr></table>
				<h3 style="font-size:19px;">Article 8 – Assurance</h3>

				 <table><tr><td style="height:5px;"></td></tr></table>
				<p>Le chef d’entreprise ou le responsable de l’organisme d’accueil prend les dispositions nécessaires pour garantir sa responsabilité civile chaque fois qu’elle sera engagée :</p>
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
