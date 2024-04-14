<?php
	
	
	$backgroundcontent='';
	$elv_diplomeattr='';
	$backgroundentreprise='';
	$ent_adrattr='';
	$ent_nomattr='';
	$ent_domaineattr='';
	$ent_copierattr='';
	$ent_numtahitiattr='';
	$ent_represantattr='';
	$ent_represant_functattr='';
	$ent_represant_mailattr='';
	$ent_represant_telattr='';
	$ent_tuteurattr='';
	$ent_tuteur_functattr='';
	$ent_tuteur_mailattr='';
	$ent_tuteur_telattr='';
	$ent_mailattr='';
	$backgroundpedareprise='';
	$uai_adrattr='';
	$uai_telattr='';
	$uai_copierattr='';
	$uai_represantattr='';
	$uai_represant_mailattr='';
	$uai_mailattr='';
	$referent_nomattr='';
	$referent_telattr='';
	$referent_mailattr='';
	$elv_nomattr='';
	$elv_prenattr='';
	$elv_datenaissattr='';
	$elv_adrattr='';
	$elv_telattr='';
	$elv_mailattr='';
	$uai_delibclass='';
	$uai_delibdisabled='';
	$elv_nom2attr='';
	$elv_pren2attr='';
	$elv_classattr='';
	$elv_diplome2attr='';
	$referent_nom2attr='';
	$date_stageattr='';
	$responsableattr='';
	$etudiantattr='';
	$typ_horaire_opt1_h1attr='';
	$typ_horaire_opt1_h2attr='';
	$ent_lieustageattr='';
	$horairejourattr='';
	$horaireweekattr='';
	$lundimatinattr='';
	$pause_dej_h1_lundiattr='';
	$pause_dej_h2_lundiattr='';
	$lundiapremattr='';
	$mardimatinattr='';
	$pause_dej_h1_mardiattr='';
	$pause_dej_h2_mardiattr='';
	$mardiapremattr='';
	$mercredimatinattr='';
	$pause_dej_h1_mercrediattr='';
	$pause_dej_h2_mercrediattr='';
	$mercrediapremattr='';
	$jeudimatinattr='';
	$pause_dej_h1_jeudiattr='';
	$pause_dej_h2_jeudiattr='';
	$jeudiapremattr='';
	$vendredimatinattr='';
	$pause_dej_h1_vendrediattr='';
	$pause_dej_h2_vendrediattr='';
	$vendrediapremattr='';
	$samedimatinattr='';
	$pause_dej_h1_samediattr='';
	$pause_dej_h2_samediattr='';
	$samediapremattr='';
	$finance_entdisabled='';
	$finance_rest1attr='';
	$finance_transp1attr='';
	$finance_heberg1attr='';
	$finance_rest2attr='';
	$finance_transp2attr='';
	$finance_heberg2attr='';
	$finance_gratattr='';
	$finance_grat_montantattr='';
	$finance_versementattr='';
	$ent_assurreurattr='';
	$ent_numcontratattr='';
	$uai_assureurattr='';
	$uai_numcontratattr='';
	
	if(lgchkelv()){
		
		$responsableattr='class="backgroundgray2" disabled';
		$etudiantattr='class="backgroundgray2" disabled';
		$backgroundentreprise='backgroundgray';
		$ent_adrattr='class="backgroundgray2" disabled';
		$ent_nomattr='class="backgroundgray2" disabled';
		$ent_domaineattr='disabled';
		$ent_copierattr='class="backgroundgray2" disabled';
		$ent_numtahitiattr='class="backgroundgray2" disabled';
		$ent_represantattr='class="backgroundgray2" disabled';
		$ent_represant_functattr='class="backgroundgray2" disabled';
		$ent_represant_mailattr='class="backgroundgray2" disabled';
		$ent_represant_telattr='class="backgroundgray2" disabled';
		$ent_tuteurattr='class="backgroundgray2" disabled';
		$ent_tuteur_functattr='class="backgroundgray2" disabled';
		$ent_tuteur_mailattr='class="backgroundgray2" disabled';
		$ent_tuteur_telattr='class="backgroundgray2" disabled';
		$ent_mailattr='class="backgroundgray2" disabled';
		$backgroundpedareprise='backgroundgray';
		$uai_adrattr='class="backgroundgray2" disabled';
		$uai_telattr='class="backgroundgray2" disabled';
		$uai_copierattr='class="backgroundgray2" disabled';
		$uai_represantattr='class="backgroundgray2" disabled';
		$uai_represant_mailattr='class="backgroundgray2" disabled';
		$uai_mailattr='class="backgroundgray2" disabled';
		$referent_nomattr='class="backgroundgray2" disabled';
		$referent_telattr='class="backgroundgray2" disabled';
		$referent_mailattr='class="backgroundgray2" disabled';
		$uai_delibclass='backgroundgray2';
		$horairejourattr='class="backgroundgray2" disabled';
		$horaireweekattr='class="backgroundgray2" disabled';
		$lundimatinattr='class="backgroundgray2" disabled';
		$pause_dej_h1_lundiattr='class="backgroundgray2" disabled';
		$pause_dej_h2_lundiattr='class="backgroundgray2" disabled';
		$lundiapremattr='class="backgroundgray2" disabled';
		$mardimatinattr='class="backgroundgray2" disabled';
		$pause_dej_h1_mardiattr='class="backgroundgray2" disabled';
		$pause_dej_h2_mardiattr='class="backgroundgray2" disabled';
		$mardiapremattr='class="backgroundgray2" disabled';
		$mercredimatinattr='class="backgroundgray2" disabled';
		$pause_dej_h1_mercrediattr='class="backgroundgray2" disabled';
		$pause_dej_h2_mercrediattr='class="backgroundgray2" disabled';
		$mercrediapremattr='class="backgroundgray2" disabled';
		$jeudimatinattr='class="backgroundgray2" disabled';
		$pause_dej_h1_jeudiattr='class="backgroundgray2" disabled';
		$pause_dej_h2_jeudiattr='class="backgroundgray2" disabled';
		$jeudiapremattr='class="backgroundgray2" disabled';
		$vendredimatinattr='class="backgroundgray2" disabled';
		$pause_dej_h1_vendrediattr='class="backgroundgray2" disabled';
		$pause_dej_h2_vendrediattr='class="backgroundgray2" disabled';
		$vendrediapremattr='class="backgroundgray2" disabled';
		$samedimatinattr='class="backgroundgray2" disabled';
		$pause_dej_h1_samediattr='class="backgroundgray2" disabled';
		$pause_dej_h2_samediattr='class="backgroundgray2" disabled';
		$samediapremattr='class="backgroundgray2" disabled';
		$finance_entdisabled='disabled';
		$finance_rest1attr='class="backgroundgray2" disabled';
		$finance_transp1attr='class="backgroundgray2" disabled';
		$finance_heberg1attr='class="backgroundgray2" disabled';
		$finance_rest2attr='class="backgroundgray2" disabled';
		$finance_transp2attr='class="backgroundgray2" disabled';
		$finance_heberg2attr='class="backgroundgray2" disabled';
		$finance_gratattr='class="backgroundgray2" disabled';
		$finance_grat_montantattr='class="backgroundgray2" disabled';
		$finance_versementattr='class="backgroundgray2" disabled';
		$ent_assurreurattr='class="backgroundgray2" disabled';
		$ent_numcontratattr='class="backgroundgray2" disabled';
		$elv_nom2attr='class="backgroundgray2" disabled';
		$elv_pren2attr='class="backgroundgray2" disabled';
		$elv_classattr='class="backgroundgray2" disabled';
		$elv_diplome2attr='class="backgroundgray2" disabled';
		$referent_nom2attr='class="backgroundgray2" disabled';
		$date_stageattr='class="backgroundgray2" disabled';
		$typ_horaire_opt1_h1attr='class="backgroundgray2" disabled';
		$typ_horaire_opt1_h2attr='class="backgroundgray2" disabled';
		$ent_lieustageattr='class="backgroundgray2" disabled';
		$uai_assureurattr='class="backgroundgray2" disabled';
		$uai_numcontratattr='class="backgroundgray2" disabled';
	}else if(lgchkpeda()){
	
		$backgroundentreprise='backgroundgray';
		$ent_adrattr='class="backgroundgray2" disabled';
		$ent_nomattr='class="backgroundgray2" disabled';
		$ent_domaineattr='disabled';
		$ent_copierattr='class="backgroundgray2" disabled';
		$ent_numtahitiattr='class="backgroundgray2" disabled';
		$ent_represantattr='class="backgroundgray2" disabled';
		$ent_represant_functattr='class="backgroundgray2" disabled';
		$ent_represant_mailattr='class="backgroundgray2" disabled';
		$ent_represant_telattr='class="backgroundgray2" disabled';
		$ent_tuteurattr='class="backgroundgray2" disabled';
		$ent_tuteur_functattr='class="backgroundgray2" disabled';
		$ent_tuteur_mailattr='class="backgroundgray2" disabled';
		$ent_tuteur_telattr='class="backgroundgray2" disabled';
		$ent_mailattr='class="backgroundgray2" disabled';
		$horairejourattr='class="backgroundgray2" disabled';
		$horaireweekattr='class="backgroundgray2" disabled';
		$lundimatinattr='class="backgroundgray2" disabled';
		$pause_dej_h1_lundiattr='class="backgroundgray2" disabled';
		$pause_dej_h2_lundiattr='class="backgroundgray2" disabled';
		$lundiapremattr='class="backgroundgray2" disabled';
		$mardimatinattr='class="backgroundgray2" disabled';
		$pause_dej_h1_mardiattr='class="backgroundgray2" disabled';
		$pause_dej_h2_mardiattr='class="backgroundgray2" disabled';
		$mardiapremattr='class="backgroundgray2" disabled';
		$mercredimatinattr='class="backgroundgray2" disabled';
		$pause_dej_h1_mercrediattr='class="backgroundgray2" disabled';
		$pause_dej_h2_mercrediattr='class="backgroundgray2" disabled';
		$mercrediapremattr='class="backgroundgray2" disabled';
		$jeudimatinattr='class="backgroundgray2" disabled';
		$pause_dej_h1_jeudiattr='class="backgroundgray2" disabled';
		$pause_dej_h2_jeudiattr='class="backgroundgray2" disabled';
		$jeudiapremattr='class="backgroundgray2" disabled';
		$vendredimatinattr='class="backgroundgray2" disabled';
		$pause_dej_h1_vendrediattr='class="backgroundgray2" disabled';
		$pause_dej_h2_vendrediattr='class="backgroundgray2" disabled';
		$vendrediapremattr='class="backgroundgray2" disabled';
		$samedimatinattr='class="backgroundgray2" disabled';
		$pause_dej_h1_samediattr='class="backgroundgray2" disabled';
		$pause_dej_h2_samediattr='class="backgroundgray2" disabled';
		$samediapremattr='class="backgroundgray2" disabled';
		$finance_entdisabled='disabled';
		$finance_rest1attr='class="backgroundgray2" disabled';
		$finance_transp1attr='class="backgroundgray2" disabled';
		$finance_heberg1attr='class="backgroundgray2" disabled';
		$finance_rest2attr='class="backgroundgray2" disabled';
		$finance_transp2attr='class="backgroundgray2" disabled';
		$finance_heberg2attr='class="backgroundgray2" disabled';
		$finance_gratattr='class="backgroundgray2" disabled';
		$finance_grat_montantattr='class="backgroundgray2" disabled';
		$finance_versementattr='class="backgroundgray2" disabled';
		$ent_assurreurattr='class="backgroundgray2" disabled';
		$ent_numcontratattr='class="backgroundgray2" disabled';
		
		
	}else if(lgchkent()){
		
		$backgroundcontent='backgroundgray';
		$elv_diplomeattr='class="backgroundgray2" disabled';
		$backgroundentreprise='backgroundwhite';
		$uai_adrattr='class="backgroundgray2" disabled';
		$uai_telattr='class="backgroundgray2" disabled';
		$uai_copierattr='class="backgroundgray2" disabled';
		$uai_represantattr='class="backgroundgray2" disabled';
		$uai_represant_mailattr='class="backgroundgray2" disabled';
		$uai_mailattr='class="backgroundgray2" disabled';
		$referent_nomattr='class="backgroundgray2" disabled';
		$referent_telattr='class="backgroundgray2" disabled';
		$referent_mailattr='class="backgroundgray2" disabled';
		$elv_nomattr='class="backgroundgray2" disabled';
		$elv_prenattr='class="backgroundgray2" disabled';
		$elv_datenaissattr='class="backgroundgray2" disabled';
		$elv_adrattr='class="backgroundgray2" disabled';
		$elv_telattr='class="backgroundgray2" disabled';
		$elv_mailattr='class="backgroundgray2" disabled';
		$uai_delibclass='backgroundgray2';
		$uai_delibdisabled='disabled';
		$elv_nom2attr='class="backgroundgray2" disabled';
		$elv_pren2attr='class="backgroundgray2" disabled';
		$elv_classattr='class="backgroundgray2" disabled';
		$elv_diplome2attr='class="backgroundgray2" disabled';
		$referent_nom2attr='class="backgroundgray2" disabled';
		
		
		$uai_assureurattr='class="backgroundgray2" disabled';
		$uai_numcontratattr='class="backgroundgray2" disabled';
		
		
	}


?>
<form id="modifcv-form" enctype="multipart/form-data" method="POST" action="<?php echo get_template_directory_uri(); ?>/actiondev2.php?act=modifconv">
<input type="hidden" id="candid" name="candid" value="<?php echo $candhash; ?>" />
<?php if(isset($_GET["msg"]) && $_GET["msg"] == "modified"){ ?>

	<div class='alert alert-success ctr'><button type='button' class='close' data-dismiss='alert'>&times;</button>La convention a bien été modifié</div>

<?php } ?>
<div class="row conventionpanel margintop40 <?php echo $backgroundcontent; ?>">

	<div class="col-md-5 displayflexcenter">
		<div class="textcenter"><img src="<?php echo get_template_directory_uri(); ?>/images/logo-ministere.png" /></div>
		<div class="textcenter fontbold">MINISTERE</br>DE L’EDUCATION</div>
		<div class="textcenter margintop40 ">DIRECTION GENERALE DE L’EDUCATION</br>ET DES ENSEIGNEMENTS</div>
		<div class="textcenter margintop40 ">Référence de la convention : <?php echo $tabconvention["reference"]; ?></div>


	</div>
	<div class="col-md-7">
		<div class="titlepolynesie">POLYNESIE FRANÇAISE</div>
		<div class="displayflexcenter height220">
			
				<?php
						
				if($tabeleve["uai_logo"]!="" and $tabeleve["uai_logo"]!=null){
				
				?>
				
				<img src="<?php echo get_site_url(); ?>/wp-content/uploads/logouai/<?php echo $tabeleve["uai_logo"]; ?>"  />
				
				<?php }else{ ?>
			<h3>Logo établissement</h3>
			
				<?php
				}
				
				?>
			<?php
						
				if(lgchkpeda()){
				
						?>
				<div class="row margintop40">
					
					<?php
						
				if($tabeleve["uai_logo"]!="" and $tabeleve["uai_logo"]!=null){
				
				?>
					<div class="col-md-6 displayflex justifycontentcenter">
						<div class="suppcv cursorpointer btn btn-danger" data-uai="<?php echo $uai_rnehash; ?>" onclick="supprimerlogouai(this)" ><i class="fa fa-trash" aria-hidden="true"></i> Supprimer ce logo</div>
					</div>
					<?php
				}
				
				?>
					
					<div class="col-md-6 displayflex justifycontentcenter">
						<input type="file" name="uai_logo"/>
					</div>
				</div>
				<?php
				}
				
				?>
		</div>
	</div>
	<div class="col-md-12 borderbottom marginbottom40">
		<h3>CONVENTION RELATIVE AUX STAGES DES ETUDIANTS INSCRITS EN BTS</h3>
	</div>
	<div class="col-md-12 textlois marginbottom40">
		<p>Vu la loi organique n° 2004-192 du 27 février 2004 modifiée, portant statut d’autonomie de la Polynésie française ;</p>
		<p>Vu le code de l’éducation applicable en Polynésie Française, notamment ses articles L.331-4 et L.911-4 ;</p>
		<p>Vu le code civil, notamment l’article 1242 ;</p>
		<p>Vu la loi du Pays n° 2011-15 du 4 mai 2011 modifiée, relative à la codification du droit du travail, notamment les articles Lp. 3241-1 et Lp. 4152-1 à Lp. 4152-3;</p>
		<p>Vu la loi du Pays n° 2017-15 du 13 juillet 2017 modifiée, relative à la Charte de l’éducation de la Polynésie française ;</p>
		<p>Vu l’arrêté n° 732 CM du 17 juin 1987 modifié, portant organisation administrative et financière des établissements publics d’enseignement de la Polynésie française ;</p>
		<p>Vu l’arrêté n°925 CM modifié, relatif à la codification du droit du travail, notamment les articles A 4152-1 à A 4152-34 ;</p>
		<p>Vu la convention n° 99-16 du 22 octobre 2016 modifiée, relative à l’éducation entre la Polynésie française et l’Etat ;</p>
		<p>Vu la circulaire n° 35777/MEA/DGEE/DOI du 10 août 2023 relative à la procédure de déclaration des accidents du travail et des accidents scolaires des élèves ;</p>
		<p>Vu la délibération du conseil d’établissement en date du  <input  type="text" class="width160 <?php echo $uai_delibclass; ?>" <?php echo $uai_delibdisabled; ?> name="uai_delib" value="<?php echo $uai_delib; ?>" />.  approuvant la convention-type et autorisant le chef d’établissement à conclure au nom de l’établissement toute convention relative aux stages des élèves inscrits en BTS.</p>
	</div>
	<h4>Entre :</h4>
	<h4>L’entreprise (ou l’organisme d’accueil) ci-dessous désigné(e)</h4>
	<div class="col-md-12 cadrestyle marginbottom40 <?php echo $backgroundentreprise; ?>">
		<div class="row">
			<div class="col-md-12 marginbottom40">
					<div class="row displayflexmiddle"><label  class="col-md-4" >Nom de l’entreprise (ou de l’organisme) d’accueil :</label><div class="col-md-8"><input  type="text" name="ent_nom" <?php echo $ent_nomattr; ?> value="<?php echo $ent_nom; ?>" /></div></div>
			</div>
			<div class="col-md-12">
				<h4>Adresse de l’entreprise : <input  type="text" name="ent_adr" <?php echo $ent_adrattr; ?> value="<?php echo $ent_adr; ?>" /></h4>
			</div>
			<div class="col-md-12 marginbottom10">
					<div class="row displayflexmiddle"><label  class="col-md-4" >Domaine d’activités de l’entreprise :</label><div class="col-md-8">
					<select name="ent_domaine" class="form-control" <?php echo $ent_domaineattr; ?> >
					<option value="">-- Veuillez sélectionner un domaine --</option>
					<?php
								
						$lstsecteur1=lstData("secteur1");
									
						foreach($lstsecteur1 as $value1){
							
							$selected="";if($value1["sect_id"]==$ent_domaine)$selected="selected";			
					?>
						
							<option value="<?php echo $value1["sect_id"]; ?>" <?php echo $selected; ?> ><?php echo utf8_encode($value1["sect_lib"]); ?></option>
								
								
					<?php
						
						}
									
					?>
				</select>
		</div></div>
			</div>
			<div class="col-md-6">
					<div class="row displayflexmiddle"><label  class="col-md-4" >N° téléphone :</label><div class="col-md-8"><input  type="text" name="ent_tel" <?php echo $ent_nomattr; ?> value="<?php echo $ent_tel; ?>" /></div></div>
			</div>
			<div class="col-md-6 marginbottom10">
					<div class="row displayflexmiddle"><label  class="col-md-4" >N° télécopieur :</label><div class="col-md-8"><input  type="text" name="ent_copier" <?php echo $ent_copierattr; ?> value="<?php echo $ent_copier; ?>" /></div></div>
			</div>
			<div class="col-md-12 marginbottom10">
					<div class="row displayflexmiddle"><label  class="col-md-4" >N° d’immatriculation de l’entreprise :</label><div class="col-md-8"><input  type="text" name="ent_copier" <?php echo $ent_numtahitiattr; ?> value="<?php echo $ent_numtahiti; ?>" /></div></div>
			</div>
			<div class="col-md-6">
					<div class="row displayflexmiddle"><label  class="col-md-4" >Représenté(e) par :</label><div class="col-md-8"><input  type="text" name="ent_represant" <?php echo $ent_represantattr; ?> value="<?php echo $ent_represant; ?>" /></div></div>
			</div>
			<div class="col-md-6 marginbottom10">
					<div class="row displayflexmiddle"><label  class="col-md-4" >Fonction :</label><div class="col-md-8"><input  type="text" name="ent_represant_funct" <?php echo $ent_represant_functattr; ?> value="<?php echo $ent_represant_funct; ?>" /></div></div>
			</div>
			<div class="col-md-12">
					<div class="row displayflexmiddle"><label  class="col-md-2" >Courriel :</label><div class="col-md-10"><input  type="text" name="ent_represant_mail" <?php echo $ent_represant_mailattr; ?> value="<?php echo $ent_represant_mail; ?>" /></div></div>
			</div>
			<div class="col-md-6 margintop10">
					<div class="row displayflexmiddle"><label  class="col-md-4" >Nom du tuteur de stage :</label><div class="col-md-8"><input  type="text" name="ent_tuteur" <?php echo $ent_tuteurattr; ?> value="<?php echo $ent_tuteur; ?>" /></div></div>
			</div>
			<div class="col-md-6 margintop10">
					<div class="row displayflexmiddle"><label  class="col-md-4" >Fonction :</label><div class="col-md-8"><input  type="text" name="ent_tuteur_funct" <?php echo $ent_tuteur_functattr; ?> value="<?php echo $ent_tuteur_funct; ?>" /></div></div>
			</div>
			<div class="col-md-6 margintop10">
					<div class="row displayflexmiddle"><label  class="col-md-4" >Courriel :</label><div class="col-md-8"><input  type="text" name="ent_tuteur_mail" <?php echo $ent_tuteur_mailattr; ?> value="<?php echo $ent_tuteur_mail; ?>" /></div></div>
			</div>
			<div class="col-md-6 margintop10">
					<div class="row displayflexmiddle"><label  class="col-md-4" >N°télépone :</label><div class="col-md-8"><input  type="text" name="ent_tuteur_tel" <?php echo $ent_tuteur_telattr; ?> value="<?php echo $ent_tuteur_tel; ?>" /></div></div>
			</div>
		</div>
	</div>
	
	<h4>L’établissement d’enseignement professionnel :</h4>
	<div class="col-md-12 cadrestyle marginbottom40 <?php echo $backgroundpedareprise; ?>">
		<div class="row">
			<div class="col-md-12">
				<h4>Nom de l’établissement : <?php echo $tabeleve["uai_ll"]; ?></h4>
			</div>
			<div class="col-md-12 marginbottom10">
					<div class="row displayflexmiddle"><label  class="col-md-2" >Adresse :</label><div class="col-md-10"><input  type="text" name="uai_adr" <?php echo $uai_adrattr; ?> value="<?php echo $uai_adr; ?>" /></div></div>
			</div>
			<div class="col-md-6">
					<div class="row displayflexmiddle"><label  class="col-md-4" >N° téléphone :</label><div class="col-md-8"><input  type="text" name="uai_tel" <?php echo $uai_telattr; ?> value="<?php echo $uai_tel; ?>" /></div></div>
			</div>
			<div class="col-md-6 marginbottom10">
					<div class="row displayflexmiddle"><label  class="col-md-4" >N° télécopieur :</label><div class="col-md-8"><input  type="text" name="uai_copier" <?php echo $uai_copierattr; ?> value="<?php echo $uai_copier; ?>" /></div></div>
			</div>
			<div class="col-md-6">
					<div class="row displayflexmiddle marginbottom10"><label  class="col-md-4" >Représenté(e) par :</label><div class="col-md-8"><input  type="text" name="uai_represant" <?php echo $uai_represantattr; ?> value="<?php echo $uai_represant; ?>" /></div></div>
			</div>
			<div class="col-md-6 displayflexmiddle marginbottom10 height50">
					en qualité de chef d’établissement
			</div>
			<div class="col-md-12 marginbottom10">
					<div class="row displayflexmiddle"><label  class="col-md-2" >Courriel :</label><div class="col-md-10"><input  type="text" name="uai_represant_mail" <?php echo $uai_represant_mailattr; ?> value="<?php echo $uai_represant_mail; ?>" /></div></div>
			</div>
			<div class="col-md-6">
					<div class="row displayflexmiddle"><label  class="col-md-4" >Nom de l’enseignant - référent :</label><div class="col-md-8"><input  type="text" name="referent_nom" <?php echo $referent_nomattr; ?> value="<?php echo $referent_nom; ?>" /></div></div>
			</div>
			<div class="col-md-6">
					<div class="row displayflexmiddle"><label  class="col-md-4" >N°téléphone :</label><div class="col-md-8"><input  type="text" name="referent_tel" <?php echo $referent_telattr; ?> value="<?php echo $referent_tel; ?>" /></div></div>
			</div>
			<div class="col-md-12 marginbottom10">
					<div class="row displayflexmiddle"><label  class="col-md-2" >Courriel :</label><div class="col-md-10"><input  type="text" name="referent_mail" <?php echo $referent_mailattr; ?> value="<?php echo $referent_mail; ?>" /></div></div>
			</div>
		</div>
	</div>
	
	
	
	
	<h4>L’étudiant :</h4>
	<div class="col-md-12 cadrestyle marginbottom40">
		<div class="row">
			<div class="col-md-6">
					<div class="row displayflexmiddle"><label  class="col-md-4" >Nom :</label><div class="col-md-8"><input  type="text" name="elv_nom" <?php echo $elv_nomattr; ?> value="<?php echo $elv_nom; ?>" /></div></div>
			</div>
			<div class="col-md-6">
					<div class="row displayflexmiddle"><label  class="col-md-4" >Prénom :</label><div class="col-md-8"><input  type="text" name="elv_pren" <?php echo $elv_prenattr; ?> value="<?php echo $elv_pren; ?>" /></div></div>
			</div>
			<div class="col-md-12 marginbottom10">
					<div class="row displayflexmiddle"><label  class="col-md-2" >Date de naissance :</label><div class="col-md-10"><input  type="text" id="chpddnais" name="elv_datenaiss" <?php echo $elv_datenaissattr; ?> value="<?php echo fDate($elv_datenaiss,"html"); ?>" /></div></div>
			</div>
			<div class="col-md-12 marginbottom10">
					<div class="row displayflexmiddle"><label  class="col-md-2" >Adresse personnelle :</label><div class="col-md-10"><input  type="text" name="elv_adr" <?php echo $elv_adrattr; ?> value="<?php echo $elv_adr; ?>" /></div></div>
			</div>
			<div class="col-md-6">
					<div class="row displayflexmiddle"><label  class="col-md-4" >N° téléphone ou Vini :</label><div class="col-md-8"><input  type="text" name="elv_tel" <?php echo $elv_telattr; ?> value="<?php echo $elv_tel; ?>" /></div></div>
			</div>
			<div class="col-md-6 marginbottom10">
					<div class="row displayflexmiddle"><label  class="col-md-4" >Courriel :</label><div class="col-md-8"><input  type="text" name="elv_mail" <?php echo $elv_mailattr; ?> value="<?php echo $elv_mail; ?>" /></div></div>
			</div>
			
		</div>
	</div>
	
	 <p>Il a été convenu ce qui suit :</p>
	<p>Mme, M. <input  type="text" name="responsable" <?php echo $responsableattr; ?> value="<?php echo $responsable; ?>" /> accepte de prendre en stage de formation l’étudiant (e) <input  type="text" name="etudiant" <?php echo $etudiantattr; ?> value="<?php echo $etudiant; ?>" /> scolarisé(e) en classe de <?php echo $elv_class; ?>.</p>
	<div class="textlois marginbottom40">
	
		<h3>Art. I – OBJECTIFS ET ORGANISATION</h3>
			<p>Objectif :	Le stage a pour objet l’application pratique de l’enseignement dispensé dans 
			l’établissement, sans que l’employeur ou l’organisme d’accueil ne puisse retirer aucun profit direct de la présence dans son entreprise ou dans son organisme d’accueil d’un étudiant stagiaire.</p>
			
			<p>Durée :</p>		
			<p>Le stage se déroulera suivant le calendrier joint ou durant la période suivante :</p>
			<p><input  type="text" name="date_stage" <?php echo $date_stageattr; ?> value="<?php echo $date_stage; ?>" /></p>
			<p>
			<div class="row">
				<div class="col-md-5">Horaires de l’entreprise (ou de l’organisme d’accueil) :</div>
				<div class="col-md-3"><input  type="text" name="typ_horaire_opt1_h1" <?php echo $typ_horaire_opt1_h1attr; ?> value="<?php echo $typ_horaire_opt1_h1; ?>" /></div><div class="col-md-1"> à </div><div class="col-md-3"><input  type="text" name="typ_horaire_opt1_h2" <?php echo $typ_horaire_opt1_h2attr; ?> value="<?php echo $typ_horaire_opt1_h2; ?>" /></div>
			</div>
			</p>
			<p>
			<div class="row">
				<div class="col-md-3">
					Lieu du stage : 
				</div>
				<div class="col-md-9">
					<input  type="text" name="ent_lieustage" <?php echo $ent_lieustageattr; ?> value="<?php echo $ent_lieustage; ?>" />
				</div>
			</div>
			</p>	
			<p>Programme :	Le programme du stage sera établi par le Chef d’entreprise ou le responsable de l’organisme d’accueil en accord avec le Proviseur du Lycée ou ses représentants, selon l’annexe pédagogique.</p>

			<h3>Art. II – OBLIGATIONS DU STAGIAIRE</h3>
			<p>Durant le stage, l’étudiant demeure sous statut scolaire et reste sous la responsabilité du chef d’établissement.</p> 
			<p>Il sera soumis au règlement intérieur de l’entreprise ou de l’organisme d’accueil. L’étudiant ne doit pas être pris en compte dans le calcul de l’effectif de l’entreprise ou de l’organisme d’accueil. Il ne peut participer aux éventuelles élections professionnelles. L’étudiant est soumis aux règles générales en vigueur dans l’entreprise ou dans l’organisme d’accueil, notamment en matière de sécurité, d’horaires et de discipline. L’étudiant est soumis au secret professionnel. Il est tenu d’observer une entière discrétion sur l’ensemble des renseignements qu’il pourra recueillir à l’occasion de ses fonctions ou du fait de sa présence dans l’entreprise ou dans l’organisme d’accueil. En outre, l’élève s’engage à ne faire figurer dans son compte-rendu de fin de stage aucun renseignement confidentiel concernant l’entreprise.</p>
			<p>L’étudiant adoptera une attitude respectueuse vis-à-vis du personnel et des responsables de l’entreprise ou de l’organisme d’accueil. Il sera suivi conjointement par son tuteur désigné par l’entreprise et par un professeur de l’établissement scolaire. A l’issue du stage un compte-rendu rédigé par l’élève sera communiqué à l’entreprise.</p> 
			<p>Pendant la durée du stage, l’étudiant est susceptible de revenir au lycée pour y suivre certains cours dont la date sera portée à la connaissance du Chef d’Entreprise ou du responsable de l’organisme d’accueil avant le commencement du stage.</p>
			<h3>Art. III – DUREE DU TRAVAIL</h3>
			<p>En ce qui concerne la durée du travail, tous les élèves sont soumis à la durée hebdomadaire légale ou conventionnelle si celle-ci est inférieure à la durée légale.</p>
			<p>Dans l’hypothèse où l’étudiant majeur est soumis à une durée hebdomadaire modulée, la moyenne des durées de travail hebdomadaires effectuées pendant la période de stage ne pourra excéder les limites indiquées ci-dessus.</p>
			<p>En ce qui concerne le travail de nuit, seul l’étudiant majeur nommément désigné par le chef d’établissement scolaire peut être incorporé à une équipe de nuit.</p>
			<p>Dans l’hypothèse où l’étudiant est mineur, la durée de travail ne peut excéder 8 heures par jour et 39 heures par semaine.</p>
			<p>Le repos hebdomadaire de l’étudiant mineur doit être d’une durée minimale de deux jours consécutifs. La période minimale de repos hebdomadaire doit comprendre le dimanche, sauf en cas de dérogation légale. Pour chaque période de vingt-quatre heures, la période minimale de repos quotidien est fixée à onze heures consécutives. Au-delà de quatre heures et demie de travail quotidien, l’étudiant mineur doit bénéficier d’une pause d’au moins trente minutes consécutives.</p> 
			<p>Le travail de nuit est interdit aux étudiants de moins de dix-huit ans entre vingt heures et six heures.</p>
			<p>Aucune dérogation ne peut être accordée à cette interdiction.</p>

			<h3>Art. IV – OBLIGATIONS DU TUTEUR EN ENTREPRISE</h3>
			<p>Le tuteur n’emploiera le stagiaire qu’à des tâches relatives à la formation pour laquelle le stage a été demandé. Il assumera pendant la durée du stage un rôle pédagogique. Néanmoins, il guidera le stagiaire par ses conseils en lui confiant des tâches de plus en plus complexes afin de développer son sens des responsabilités et assurer ainsi son perfectionnement professionnel.</p>
			<p>Il veillera à l’assiduité du stagiaire et alertera l’établissement en cas d’absence.</p> 
			<h3>Art. V – SECURITE ELECTRIQUE</h3>
			<p>L’étudiant ayant à intervenir, au cours de sa période de stage, sur - ou à proximité - des installations et des équipements électriques, doit y être habilité par le chef d’entreprise ou le responsable de l’organisme d’accueil en fonction de la nature des travaux à effectuer. Cette habilitation ne peut être accordée qu’à l’issue d’une formation à la prévention des risques électriques suivie par l’étudiant en établissement scolaire, préalablement à sa période de stage. L’habilitation est délivrée au vu d’un carnet individuel de formation établi par l’établissement scolaire qui certifie que, pour les niveaux d’habilitation mentionnés, la formation correspondante a été suivie avec succès par l’étudiant.</p> 
			<h3>Art. VI– ACCIDENT DU TRAVAIL ET RESPONSABILITE CIVILE</h3>
			<p>Le chef d’entreprise ou le responsable de l’organisme d’accueil s’engage à signaler à l’établissement ou au référent dans la journée ou au plus tard dans les 24 heures, tout accident survenant au jeune stagiaire, tant au cours du stage que pendant les trajets de l’étudiant. L'obligation de déclaration d'accident incombe à l’établissement de formation (lycée). Celui-ci adressera à la CPS, par télécopie dans les 48 heures suivant l’accident, la déclaration d’accident accompagnée de la copie de la convention. Pour le calcul de ce délai de 48 heures, les dimanches et jours fériés ne sont pas comptés. L'établissement de formation fait parvenir, sans délai, l’original de la déclaration en deux exemplaires à la division des affaires financières de la Direction de l’Education et des Enseignements.</p>
			<p>Le chef d’entreprise ou le responsable de l’organisme d’accueil prend les dispositions nécessaires pour garantir sa responsabilité civile chaque fois qu’elle peut être engagée.</p> 
			<p>Le chef d’établissement contracte une assurance couvrant la responsabilité civile de l’étudiant pour les dommages qu’il pourrait causer pendant la durée de sa période de stage dans l’entreprise ou dans l’organisme d’accueil.</p> 

			<h3>Art. VII– SUSPENSION ET RESILIATION DE LA CONVENTION DE STAGE</h3>
			<p>En cas de manquement au règlement intérieur, après avoir recueilli l’accord du Proviseur du Lycée.</p>
			<p>Le chef d’établissement et le chef d’entreprise/le représentant de l’organisme d’accueil se tiendront mutuellement informés des difficultés qui   pourraient être rencontrées à l’occasion de la période de stage. Le cas échéant, ils prendront, d’un commun accord et en liaison avec l’équipe pédagogique, les dispositions propres à résoudre les problèmes d’absentéisme ou de manquement à la discipline ou de manquement au règlement intérieur. Au besoin, ils étudieront ensemble les modalités de suspension ou de résiliation de la période de stage. Après avoir recueilli l’accord du chef d’établissement, le Chef d’entreprise ou le responsable de l’organisme d’accueil se réservera le droit de mettre fin au stage de l’étudiant.</p>

			<h3>Art. VIII– CERTIFICAT DE FIN DE STAGE</h3>
			<p>En fin de stage, le tuteur donnera son appréciation sur le comportement et les progrès du stagiaire.</p>
			<p>Il sera remis à l’étudiant stagiaire un certificat indiquant la nature et la durée du stage.</p>
			<h3>Art. IX– AVANTAGE EN NATURE / DIVERS</h3>
			<p>Au cours du stage, l’étudiant stagiaire ne pourra prétendre à aucune rémunération de l’Entreprise. Une récompense pourra cependant lui être allouée.</p>
			<p>En cas de grossesse, de paternité ou d’adoption, le stagiaire bénéficie de congés et d’autorisations d’absence d’une durée équivalente à celles prévues pour les salariés relevant du régime de la caisse de prévoyance sociale.</p>
			<h3>Art. X– DUREE, ENREGISTREMENT ET NOMBRE D’EXEMPLAIRE</h3>
			<p>La présente convention est établie au jour de la signature, pour la durée du stage soit du XXXX au XXXX, en trois (3) exemplaires originaux 1 pour l’entreprise, 1 pour le lycée, 1 pour l’étudiant.</p> 
			<p>Elle n’est pas renouvelable par tacite reconduction.</p>
			<p>Elle est exempte de tous droits de timbre et d’enregistrement.</p>


	
	</div>
	
	
	<div class="col-md-12">
		<button class="bouttonconnex" type="submit"><i class="fa fa-save marginright10"></i> Enregistrer</button>
		<?php if(lgchkpeda()){ ?>
			<a href="<?php echo get_site_url(); ?>/espace-pedagogique/?ong=lstlv&showelv=<?php echo $elvhash; ?>&ong2=convention" class="btn btn-primary width100"><i class="fa fa-list marginright10"></i> Retour</a>
		<?php }else if(lgchkent()){ ?>
			<a href="<?php echo get_site_url(); ?>/espace-entreprise/?ong=convention" class="btn btn-primary width100"><i class="fa fa-list marginright10"></i> Retour</a>
		<?php }else if(lgchkelv()){ ?>
			<a href="<?php echo get_site_url(); ?>/espace-eleve/?ong=convention" class="btn btn-primary width100"><i class="fa fa-list marginright10"></i> Retour</a>
		<?php } ?>
		</br></br><a target=_blank href="<?php echo get_template_directory_uri(); ?>/print_convention.php?cand=<?php echo $candhash; ?>" class="btn btn-success width100"><i class="fa fa-print marginright10"></i> Imprimer la convention</a>
		</br></br><a target=_blank href="<?php echo get_site_url(); ?>/wp-content/uploads/signature/<?php echo $tabconvention["reference"]; ?>.pdf" class="btn btn-warning width100"><i class="fa fa-print marginright10"></i> Imprimer seulement la partie signature</a>
	</div>
	
</div>
</form>