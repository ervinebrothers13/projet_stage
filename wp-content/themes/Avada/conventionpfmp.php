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
	$ent_mailattr='';
	$backgroundpedareprise='';
	$uai_adrattr='';
	$uai_telattr='';
	$uai_copierattr='';
	$uai_represantattr='';
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
		
		$backgroundentreprise='backgroundgray';
		$ent_adrattr='class="backgroundgray2" disabled';
		$ent_nomattr='class="backgroundgray2" disabled';
		$ent_domaineattr='disabled';
		$ent_copierattr='class="backgroundgray2" disabled';
		$ent_numtahitiattr='class="backgroundgray2" disabled';
		$ent_represantattr='class="backgroundgray2" disabled';
		$ent_represant_functattr='class="backgroundgray2" disabled';
		$ent_mailattr='class="backgroundgray2" disabled';
		$backgroundpedareprise='backgroundgray';
		$uai_adrattr='class="backgroundgray2" disabled';
		$uai_telattr='class="backgroundgray2" disabled';
		$uai_copierattr='class="backgroundgray2" disabled';
		$uai_represantattr='class="backgroundgray2" disabled';
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
		<h3>CONVENTION TYPE RELATIVE A LA PERIODE DE FORMATION EN MILIEU PROFESSIONNEL</h3>
	</div>
	<div class="col-md-12 marginbottom40">
			<div class="row displayflexmiddle"><label  class="col-md-4" >Intitulé du diplôme préparé et de la spécialité :</label><div class="col-md-8"><input  type="text" name="elv_diplome" <?php echo $elv_diplomeattr; ?> value="<?php echo $elv_diplome; ?>"  /></div></div>
	</div>
	<h4>Entre l’entreprise (ou l’organisme) ci-dessous désigné(e)</h4>
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
					<div class="row displayflexmiddle"><label  class="col-md-4" >N° d’immatriculation de l’entreprise :</label><div class="col-md-8"><input  type="text" <?php echo $ent_numtahitiattr; ?> name="ent_numtahiti" value="<?php echo $ent_numtahiti; ?>" /></div></div>
			</div>
			<div class="col-md-6">
					<div class="row displayflexmiddle"><label  class="col-md-4" >Représenté(e) par :</label><div class="col-md-8"><input  type="text" name="ent_represant" <?php echo $ent_represantattr; ?> value="<?php echo $ent_represant; ?>" /></div></div>
			</div>
			<div class="col-md-6 marginbottom10">
					<div class="row displayflexmiddle"><label  class="col-md-4" >Fonction :</label><div class="col-md-8"><input  type="text" name="ent_represant_funct" <?php echo $ent_represant_functattr; ?> value="<?php echo $ent_represant_funct; ?>" /></div></div>
			</div>
			<div class="col-md-12">
					<div class="row displayflexmiddle"><label  class="col-md-2"  >Mail :</label><div class="col-md-10"><input  type="text" name="ent_mail" <?php echo $ent_mailattr; ?> value="<?php echo $ent_mail; ?>" /></div></div>
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
					<div class="row displayflexmiddle"><label  class="col-md-2" >Mail :</label><div class="col-md-10"><input  type="text" name="uai_mail" <?php echo $uai_mailattr; ?> value="<?php echo $uai_mail; ?>" /></div></div>
			</div>
			<div class="col-md-6">
					<div class="row displayflexmiddle"><label  class="col-md-4" >Nom de l’enseignant -référent :</label><div class="col-md-8"><input  type="text" name="referent_nom" <?php echo $referent_nomattr; ?> value="<?php echo $referent_nom; ?>" /></div></div>
			</div>
			<div class="col-md-6 marginbottom10">
					<div class="row displayflexmiddle"><label  class="col-md-4" >N° téléphone :</label><div class="col-md-8"><input  type="text" name="referent_tel" <?php echo $referent_telattr; ?> value="<?php echo $referent_tel; ?>" /></div></div>
			</div>
			<div class="col-md-12">
					<div class="row displayflexmiddle"><label  class="col-md-2" >Mail :</label><div class="col-md-10"><input  type="text" name="referent_mail" <?php echo $referent_mailattr; ?> value="<?php echo $referent_mail; ?>" /></div></div>
			</div>
		</div>
	</div>
	
	<h4>L’élève :</h4>
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
					<div class="row displayflexmiddle"><label  class="col-md-4" >Mail :</label><div class="col-md-8"><input  type="text" name="elv_mail" <?php echo $elv_mailattr; ?> value="<?php echo $elv_mail; ?>" /></div></div>
			</div>
			
		</div>
	</div>
	<div class="textlois marginbottom40">
		<p>Vu la loi organique n° 2004-192 du 27 février 2004 modifiée, portant statut d’autonomie de la Polynésie française ;</p>
		<p>Vu le code de l’éducation applicable en Polynésie Française, notamment les articles L.331- 4 et L.911- 4 ;</p>
		<p>Vu le code civil, notamment l’article 1242 ;</p>
		<p>Vu la loi du Pays n° 2011-15 du 4 mai 2011 modifiée, relative à la codification du droit du travail, notamment les articles Lp. 3241-1 et Lp. 4152-1 à Lp. 4152-3 ;</p>
		<p>Vu la loi du Pays n° 2017-15 du 13 juillet 2017 modifiée, relative à la Charte de l’éducation de la Polynésie française ;</p>
		<p>Vu l’arrêté n° 732 CM du 17 juin 1987 modifié, portant organisation administrative et financière des établissements publics d’enseignement de la Polynésie française ;</p>
		<p>Vu l’arrêté n°925 CM modifié, relatif à la codification du droit du travail, notamment les articles A 4152-1 à A 4152-34 ;</p>
		<p>Vu la convention n° 99-16 du 22 octobre 2016 modifiée, relative à l’éducation entre la Polynésie française et l’Etat ;</p>
		<p>Vu la circulaire n° 35777/MEA/DGEE/DOI du 10 août 2023 relative à la procédure de déclaration des accidents du travail et des accidents scolaires des élèves ;</p>
		<p>Vu la délibération du conseil d’établissement en date du <input  type="text" class="width160 <?php echo $uai_delibclass; ?>" <?php echo $uai_delibdisabled; ?> name="uai_delib" value="<?php echo $uai_delib; ?>" />.  approuvant la convention-type et autorisant le chef d’établissement à conclure au nom de l’établissement toute convention relative à la période de formation en milieu professionnel conforme à la convention-type.</p>
		<p>Il a été convenu ce qui suit :</p>
		
		<h4 class="margintop20">Article 1 - Objet de la convention </h4>
		<p>La présente convention a pour objet la mise en œuvre, au bénéfice de l’élève de l’établissement désigné, de périodes de formation en milieu professionnel (PFMP) réalisées dans le cadre de l’enseignement professionnel.</p>

		<h4 class="margintop20">Article 2 - Finalité de la formation en milieu professionnel</h4>

		<p>La finalité des périodes de formation en milieu professionnel corresponde à des périodes temporaires de mise en situation en milieu professionnel au cours desquelles l’élève acquiert des compétences professionnelles et met en œuvre les acquis de sa formation en vue d’obtenir un diplôme ou une certification et de favoriser son insertion professionnelle. Le stagiaire se voit confier une ou des missions conformes au projet pédagogique défini par son établissement d’enseignement et approuvées par l’entreprise ou l’organisme d’accueil. En aucun cas, sa participation à ces activités ne doit porter préjudice à la situation de l’emploi dans l’entreprise.</p>

		<h4 class="margintop20">Article 3 - Dispositions de la convention</h4>

		<p>La convention comprend des dispositions générales et des dispositions particulières constituées par les annexes pédagogique et financière. L’annexe pédagogique définit les objectifs et les modalités pédagogiques de la période de formation en milieu professionnel. Cette annexe prend la forme d’un livret de suivi. L’annexe financière définit les modalités de prise en charge des frais afférents à la période, ainsi que les modalités d’assurance. La convention accompagnée de ses annexes est signée par le chef d’établissement et le représentant de l’entreprise ou de l’organisme d’accueil de l’élève. Elle est également signée par l’élève ou, s’il est mineur, par son représentant légal. Elle doit, en outre, être portée à la connaissance des enseignants et du tuteur en entreprise chargés du suivi de l’élève. La convention est ensuite adressée à la famille pour information.</p>

		<h4 class="margintop20">Article 4 - Statut et obligations de l’élève</h4>

		<p>L’élève demeure, durant ces périodes de formation en milieu professionnel, sous statut scolaire. Il reste sous la responsabilité du chef d’établissement. L’élève ne doit pas être pris en compte dans le calcul de l’effectif de l’entreprise. Il ne peut participer aux éventuelles élections professionnelles. L’élève est soumis aux règles générales en vigueur dans l’entreprise, notamment en matière de sécurité, d’horaires et de discipline, sous réserve des dispositions des articles 6 et 7 de la présente convention. L’élève est soumis au secret professionnel. Il est tenu d’observer une entière discrétion sur l’ensemble des renseignements qu’il pourra recueillir à l’occasion de ses fonctions ou du fait de sa présence dans l’entreprise. En outre, l’élève s’engage à ne faire figurer dans son rapport de stage aucun renseignement confidentiel concernant l’entreprise.</p>

		<h4 class="margintop20">Article 5-Gratification</h4>

		<p>L’élève ne peut prétendre à aucune rémunération de l’entreprise ou de l’organisme d’accueil. Toutefois, il peut lui être alloué une gratification. 
		Cette gratification n’a pas le caractère d’un salaire au sens de l’article Lp. 3312-2 de la loi du Pays n° 2011- 15 du 04 mai 2011.</p>

		<h4 class="margintop20">Article 6 - Durée du travail</h4>

		<p>En ce qui concerne la durée du travail, tous les élèves sont soumis à la durée hebdomadaire légale ou conventionnelle si celle-ci est inférieure à la durée légale.</p>

		<h4 class="margintop20">Article 7- Durée et horaires de travail des élèves majeurs</h4>

		<p>Dans l’hypothèse où l’élève majeur est soumis à une durée hebdomadaire modulée, la moyenne des durées de travail   hebdomadaires effectuées pendant la période en milieu professionnel ne pourra excéder les limites indiquées ci-dessus.
		En ce qui concerne le travail de nuit, seul l’élève majeur nommément désigné par le chef d’établissement scolaire peut être incorporé à une équipe de nuit.</p>
		<h4 class="margintop20">Article 8- Durée et horaires de travail des élèves mineurs</h4>

		<p>La durée de travail de l’élève mineur ne peut excéder 8 heures par jour et 39 heures par semaine.
		Le repos hebdomadaire de l’élève mineur doit être d’une durée minimale de deux jours consécutifs. La période minimale de repos hebdomadaire doit comprendre le dimanche, sauf en cas de dérogation légale. Pour chaque période de vingt-quatre heures, la période minimale de repos quotidien est fixée à onze heures consécutives. Au-delà de quatre heures et demie de travail quotidien, l’élève mineur doit bénéficier d’une pause d’au moins trente minutes consécutives.  
		Le travail de nuit est interdit aux élèves de moins de dix-huit ans entre vingt heures et six heures.
		Aucune dérogation ne peut être accordée à cette interdiction.</p>

		<h4 class="margintop20">Article 9 –Avantages offerts par l’entreprise ou l’organisme d’accueil :</h4>

		<p>Le stagiaire a accès au restaurant d’entreprise ou aux titres de-restaurant s’il existe, dans les mêmes conditions que les salariés de l’entreprise ou de l’organisme d’accueil. Il bénéficie également de la prise en charge des frais de transport, s’il existe.    

		<h4 class="margintop20">Article 10- Sécurité - travaux interdits aux mineurs</h4>

		<p>En application des articles A.4152-1 à 4152-34, l’élève mineur de quinze ans au moins, peut être affecté aux travaux réglementés après que l’entreprise ait adressé à l’inspecteur du travail une dérogation aux travaux interdits aux mineurs. La déclaration de dérogation, doit préciser le secteur d’activité de l’entreprise, les formations professionnelles pour lesquelles elle est établie, les différents lieux de formation, la liste des travaux susceptibles de dérogation et les équipements de travail liés à ces travaux ainsi que la qualité et la fonction de la (ou des) personnes(s)compétente(s) pour encadrer le jeune pendant l’exécution des travaux précités. Elle est signée par le chef d’entreprise et adressée à l’inspecteur du travail.</p>

		<h4 class="margintop20">Article 11 - Sécurité électrique</h4> 

		<p>L’élève ayant à intervenir, au cours de sa période de formation en milieu professionnel, sur - ou à proximité - des installations et des équipements électriques, doit y être habilité par le chef de l’entreprise d’accueil en fonction de la nature des travaux à effectuer. Cette habilitation ne peut être accordée qu’à l’issue d’une formation à la prévention des risques électriques suivie par l’élève en établissement scolaire, préalablement à sa période de formation en milieu professionnel. L’habilitation est délivrée au vu d’un carnet individuel de formation établi par l’établissement scolaire qui certifie que, pour les niveaux d’habilitation mentionnés, la formation correspondante a été suivie avec succès par l’élève.</p>

		<h4 class="margintop20">Article 12 - Déclaration d’accident ((Voir la Circulaire n° 35777/MEA/DGEE/DOI du 10 août 2023 ci-dessus référencée)</h4>

		<p>Le responsable de l’entreprise ou de l’organisme d’accueil s’engage à signaler à l’établissement ou au référent dans la journée ou au plus tard dans les 24 heures, tout accident survenant au jeune stagiaire, tant au cours du stage que pendant les trajets de l’élève. L'obligation de déclaration d'accident incombe à l’établissement de formation (lycée). Celui-ci adressera à la CPS, par télécopie dans les 48 heures suivant l’accident, la déclaration d’accident accompagnée de la copie de la convention. Pour le calcul de ce délai de 48 heures, les dimanches et jours fériés ne sont pas comptés. L'établissement de formation fait parvenir, sans délai, l’original de la déclaration en deux exemplaires à la division des affaires financières de la Direction de l’Education et des Enseignements</p>

		<h4 class="margintop20">Article 13-Autorisation d’absence</h4>

		<p>En cas de grossesse, de paternité ou d’adoption, le stagiaire bénéficie de congés et d’autorisations d’absence d’une durée équivalente à celles prévues pour les salariés relevant du régime de la caisse de prévoyance sociale</p>
		<h4 class="margintop20">Article 14 - Assurance responsabilité civile</h4>

		<p>Le chef de l’entreprise d’accueil prend les dispositions nécessaires pour garantir sa responsabilité civile chaque fois qu’elle peut être engagée. Le chef d’établissement contracte une assurance couvrant la responsabilité civile de l’élève pour les dommages qu’il pourrait causer pendant la durée de sa période de formation en milieu professionnel dans l’entreprise ou à l’occasion de la préparation de celle-ci.</p>

		<h4 class="margintop20">Article 15- Encadrement et suivi de la période de formation en milieu professionnel.</h4>

		<p>Les conditions dans lesquelles l’enseignant-référent de l’établissement et le tuteur dans l’entreprise (ou l’organisme) d’accueil assurent l’encadrement et le suivi du stagiaire figurent dans l’annexe pédagogique jointe à la présente convention.</p>

		<h4 class="margintop20">Article 16-Suspension et résiliation de la convention de stage </h4>

		<p>Le chef d’établissement et le représentant de l’entreprise d’accueil se tiendront mutuellement informés des difficultés qui   pourraient être rencontrées à l’occasion de la période de formation en milieu professionnel. Le cas échéant, ils prendront, d’un commun accord et en liaison avec l’équipe pédagogique, les dispositions propres à résoudre les problèmes d’absentéisme ou de manquement à la discipline. Au besoin, ils étudieront ensemble les modalités de suspension ou de résiliation de la période de formation en milieu professionnel</p>

		<h4 class="margintop20">Article 17-Validation de la période de formation en milieu professionnel en cas d’interruption</h4>

		<p>Lorsque le stagiaire interrompt sa période de formation en milieu professionnel pour un motif lié à la maladie, à un accident, à la grossesse, à la paternité, à l’adoption, ou en accord avec l’établissement, en cas de non respect des stipulations pédagogiques de la convention ou en cas de rupture de la convention à l’initiative de l’organisme d’accueil, l’établissement propose au stagiaire une modalité alternative de validation de sa formation. En cas d’accord des parties à la convention, un report de la fin de la période de formation en milieu professionnel ou du stage, en tout ou partie, est également possible.</p>


		<h4 class="margintop20">Article 18 –Attestation de stage.</h4>

		<p>A l’issue de la période de formation en milieu professionnel, le responsable de l’entreprise (ou organisme d’accueil) délivre une attestation conforme à l’attestation type figurant en annexe de la présente convention.</p>

		<h4 class="margintop20">Article 19 - Durée, enregistrement et exemplaire de la Convention</h4>

		<p>La présente convention est établie au jour de la signature, pour la durée du stage d’initiation en milieu professionnel, soit du XXXX au XXXX, en trois (3) exemplaires originaux 1 pour l’entreprise ,1 pour le collège, 1 pour les parents.</p>

		<p>Elle n’est pas renouvelable par tacite reconduction. </p>

		<p>Elle est exempte de tous droits de timbre et d’enregistrement.</p>

	
	</div>
	
	<div class="col-md-12 cadrestyle marginbottom40">
		<div class="row">
			<div class="col-md-4 marginbottom10 <?php echo $backgroundpedareprise; ?>">
					<div class="row displayflexmiddle"><label  class="col-md-4" >Nom de l'élève :</label><div class="col-md-8"><input  type="text" name="elv_nom2" <?php echo $elv_nom2attr; ?> value="<?php echo $elv_nom2; ?>" /></div></div>
			</div>
			<div class="col-md-4 marginbottom10">
					<div class="row displayflexmiddle"><label  class="col-md-4" >Prénom :</label><div class="col-md-8"><input  type="text" name="elv_pren2" <?php echo $elv_pren2attr; ?> value="<?php echo $elv_pren2; ?>" /></div></div>
			</div>
			<div class="col-md-4 marginbottom10">
					<div class="row displayflexmiddle"><label  class="col-md-4" >classe :</label><div class="col-md-8"><input  type="text" name="elv_class" <?php echo $elv_classattr; ?> value="<?php echo $elv_class; ?>" /></div></div>
			</div>
			<div class="col-md-12 marginbottom10">
					<div class="row displayflexmiddle"><label  class="col-md-2" >Diplôme préparé :</label><div class="col-md-10"><input  type="text" name="elv_diplome2" <?php echo $elv_diplome2attr; ?> value="<?php echo $elv_diplome2; ?>" /></div></div>
			</div>
			<div class="col-md-12 marginbottom10">
					<span class="fontbold">Nom du (ou des) enseignant(s)- référent(s)</span> chargés de suivre le déroulement de la formation en entreprise :
			</div>
			<div class="col-md-12 marginbottom10">
					<div class="row displayflexmiddle"><label  class="col-md-2" >Nom du tuteur :</label><div class="col-md-10"><input  type="text" name="referent_nom2" <?php echo $referent_nom2attr; ?> value="<?php echo $referent_nom2; ?>" /></div></div>
			</div>
			<div class="col-md-12 marginbottom10">
					<div class="row displayflexmiddle"><label  class="col-md-2" >Dates du stage :</label><div class="col-md-10"><input  type="text" name="date_stage" <?php echo $date_stageattr; ?> value="<?php echo $date_stage; ?>" /></div></div>
			</div>
			
		</div>
	</div>
	
	
	<div class="col-md-12 marginbottom40 padding10 <?php echo $backgroundentreprise; ?>">
	<div class="col-md-12 cadrestyle marginbottom40 textcenter fontsize30 fontbold">
		Annexe pédagogique
	</div>
		<div class="row">
			
			
				
			<div class="col-md-6 marginbottom10">
					<div class="row displayflexmiddle"><label  class="col-md-6" >Horaires journaliers de l’élève :</label><div class="col-md-6"><input  type="text" name="horairejour" <?php echo $horairejourattr; ?> value="<?php echo $horairejour; ?>" /></div></div>
			</div>
			<div class="col-md-6 marginbottom10">
					<div class="row displayflexmiddle"><label  class="col-md-6" >Soit une durée totale hebdomadaire de :</label><div class="col-md-6"><input  type="text" name="horaireweek" <?php echo $horaireweekattr; ?> value="<?php echo $horaireweek; ?>" /></div></div>
			</div>
			<div class="col-md-12 marginbottom10">
			
				<table border=1 id="tablehoraireconv" class="tablehoraire width100" >
					<tbody>
						<tr><td></td><td class="fontbold">Matin</td><td class="fontbold">Après-midi</td></tr>
						<tr><td>Lundi</td>
						<td>
						<?php if($lundimatin!=""){ ?>
						de <input type="text" name="lundimatin"  <?php echo $lundimatinattr; ?> value="<?php echo $lundimatin; ?>" /> à <input type="text" name="pause_dej_h1_lundi"  <?php echo $pause_dej_h1_lundiattr; ?> value="<?php echo $pause_dej_h1_lundi; ?>" />
						<?php }else{ ?>
						de <input type="text"  name="lundimatin" <?php echo $lundimatinattr; ?> /> à <input type="text" name="pause_dej_h1_lundi" <?php echo $pause_dej_h1_lundiattr; ?>  />
						<?php } ?>
						</td>
						<td>
						<?php if($lundiaprem!=""){ ?>
						de <input type="text" name="pause_dej_h2_lundi"  <?php echo $pause_dej_h2_lundiattr; ?> value="<?php echo $pause_dej_h2_lundi; ?>" /> à <input type="text" name="lundiaprem"  <?php echo $lundiapremattr; ?> value="<?php echo $lundiaprem; ?>" /></td>
						<?php }else{ ?>
						de <input type="text"  <?php echo $pause_dej_h2_lundiattr; ?> name="pause_dej_h2_lundi" /> à <input type="text" name="lundiaprem" <?php echo $lundiapremattr; ?>  />
						<?php } ?>
						</tr>
						<tr><td>Mardi</td>
						<td>
						<?php if($mardimatin!=""){ ?>
						de <input type="text" name="mardimatin"  <?php echo $mardimatinattr; ?> value="<?php echo $mardimatin; ?>" /> à <input type="text" name="pause_dej_h1_mardi"  <?php echo $pause_dej_h1_mardiattr; ?> value="<?php echo $pause_dej_h1_mardi; ?>" />
						<?php }else{ ?>
						de <input type="text"  name="mardimatin" <?php echo $mardimatinattr; ?> /> à <input type="text" name="pause_dej_h1_mardi"   <?php echo $pause_dej_h1_mardiattr; ?> />
						<?php } ?>
						</td>
						<td>
						<?php if($mardiaprem!=""){ ?>
						de <input type="text" name="pause_dej_h2_mardi"  <?php echo $pause_dej_h2_mardiattr; ?> value="<?php echo $pause_dej_h2_mardi; ?>" /> à <input type="text" name="mardiaprem"  <?php echo $mardiapremattr; ?> value="<?php echo $mardiaprem; ?>" /></td>
						<?php }else{ ?>
						de <input type="text"  name="pause_dej_h2_mardi" <?php echo $pause_dej_h2_mardiattr; ?> /> à <input type="text" name="mardiaprem"  <?php echo $mardiapremattr; ?> />
						<?php } ?>
						</tr>
						<tr><td>Mercredi</td>
						<td>
						<?php if($mercredimatin!=""){ ?>
						de <input type="text" name="mercredimatin"  <?php echo $mercredimatinattr; ?> value="<?php echo $mercredimatin; ?>" /> à <input type="text" name="pause_dej_h1_mercredi"  <?php echo $pause_dej_h1_mercrediattr; ?> value="<?php echo $pause_dej_h1_mercredi; ?>" />
						<?php }else{ ?>
						de <input type="text"  name="mercredimatin" <?php echo $mercredimatinattr; ?> /> à <input type="text" name="pause_dej_h1_mercredi"  <?php echo $pause_dej_h1_mercrediattr; ?> />
						<?php } ?>
						</td>
						<td>
						<?php if($mercrediaprem!=""){ ?>
						de <input type="text" name="pause_dej_h2_mercredi"  <?php echo $pause_dej_h2_mercrediattr; ?> value="<?php echo $pause_dej_h2_mercredi; ?>" /> à <input type="text"  name="mercrediaprem" <?php echo $mercrediapremattr; ?> value="<?php echo $mercrediaprem; ?>" /></td>
						<?php }else{ ?>
						de <input type="text"  name="pause_dej_h2_mercredi" <?php echo $pause_dej_h2_mercrediattr; ?> /> à <input type="text" name="mercrediaprem"  <?php echo $mercrediapremattr; ?> />
						<?php } ?>
						</tr>
						<tr><td>Jeudi</td>
						<td>
						<?php if($jeudimatin!=""){ ?>
						de <input type="text" name="jeudimatin"  <?php echo $jeudimatinattr; ?> value="<?php echo $jeudimatin; ?>" /> à <input type="text"  name="pause_dej_h1_jeudi" <?php echo $pause_dej_h1_jeudiattr; ?> value="<?php echo $pause_dej_h1_jeudi; ?>" />
						<?php }else{ ?>
						de <input type="text"  name="jeudimatin" <?php echo $jeudimatinattr; ?> /> à <input type="text" name="pause_dej_h1_jeudi"  <?php echo $pause_dej_h1_jeudiattr; ?> />
						<?php } ?>
						</td>
						<td>
						<?php if($jeudiaprem!=""){ ?>
						de <input type="text" name="pause_dej_h2_jeudi"  <?php echo $pause_dej_h2_jeudiattr; ?> value="<?php echo $pause_dej_h2_jeudi; ?>" /> à <input type="text"  name="jeudiaprem" <?php echo $jeudiapremattr; ?> value="<?php echo $jeudiaprem; ?>" /></td>
						<?php }else{ ?>
						de <input type="text"  name="pause_dej_h2_jeudi" <?php echo $pause_dej_h2_jeudiattr; ?> /> à <input type="text" name="jeudiaprem"  <?php echo $jeudiapremattr; ?> />
						<?php } ?>
						</tr>
						<tr><td>Vendredi</td>
						<td>
						<?php if($vendredimatin!=""){ ?>
						de <input type="text" name="vendredimatin"  <?php echo $vendredimatinattr; ?> value="<?php echo $vendredimatin; ?>" /> à <input type="text" name="pause_dej_h1_vendredi"  <?php echo $pause_dej_h1_vendrediattr; ?> value="<?php echo $pause_dej_h1_vendredi; ?>" />
						<?php }else{ ?>
						de <input type="text"  name="vendredimatin" <?php echo $vendredimatinattr; ?> /> à <input type="text" name="pause_dej_h1_vendredi"  <?php echo $pause_dej_h1_vendrediattr; ?> />
						<?php } ?>
						</td>
						<td>
						<?php if($vendrediaprem!=""){ ?>
						de <input type="text" name="pause_dej_h2_vendredi"  <?php echo $pause_dej_h2_vendrediattr; ?> value="<?php echo $pause_dej_h2_vendredi; ?>" /> à <input type="text"  name="vendrediaprem" <?php echo $vendrediapremattr; ?> value="<?php echo $vendrediaprem; ?>" /></td>
						<?php }else{ ?>
						de <input type="text"  name="pause_dej_h2_vendredi" <?php echo $pause_dej_h2_vendrediattr; ?> /> à <input type="text" name="vendrediaprem"  <?php echo $vendrediapremattr; ?> />
						<?php } ?>
						</tr>
						<tr><td>Samedi</td>
						<td>
						<?php if($samedimatin!=""){ ?>
						de <input type="text"  name="samedimatin" <?php echo $samedimatinattr; ?> value="<?php echo $samedimatin; ?>" /> à <input type="text" name="pause_dej_h1_samedi"  <?php echo $pause_dej_h1_samediattr; ?> value="<?php echo $pause_dej_h1_samedi; ?>" />
						<?php }else{ ?>
						de <input type="text"  name="samedimatin" <?php echo $samedimatinattr; ?> /> à <input type="text" name="pause_dej_h1_samedi"  <?php echo $pause_dej_h1_samediattr; ?> />
						<?php } ?>
						</td>
						<td>
						<?php if($samediaprem!=""){ ?>
						de <input type="text"  name="pause_dej_h2_samedi" <?php echo $pause_dej_h2_samediattr; ?> value="<?php echo $pause_dej_h2_samedi; ?>" /> à <input type="text" name="samediaprem"  <?php echo $samediapremattr; ?> value="<?php echo $samediaprem; ?>" /></td>
						<?php }else{ ?>
						de <input type="text"  name="pause_dej_h2_samedi" <?php echo $pause_dej_h2_samediattr; ?> /> à <input type="text" name="samediaprem"  <?php echo $samediapremattr; ?> />
						<?php } ?>
						</tr>
					</tbody>
				</table>
				
				<h3>L’annexe pédagogique à la convention prend la forme d’un livret de suivi des périodes de formation en milieu professionnel</h3>
				<p>Ce document élaboré par l’équipe pédagogique doit préciser :</p>
				<ul class="listnostyle">
					
					<li>-	le nom de l’élève, les coordonnées de l’établisement ,le nom des enseignants référents</li>
					<li>-	le nom du tuteur, les coordonnées de l’entreprise ;</li>
					<li>-	le diplôme préparé ;</li>
					<li>-	le nom du ou des professeurs chargés de suivre le déroulement de la formation en milieu professionnel ;</li>
					<li>-	les dates de début et de fin pour toutes les périodes ;</li>
					<li>-	les modalités de concertation entre le(s) professeur(s) et le tuteur pour contrôler le déroulement de la période ;</li>
					<li>-	les objectifs assignés à la PFMP ;</li>
					<li>-	les activités prévues en milieu professionnel ;</li>
					<li>-	les travaux effectués, équipements ou produits utilisés soumis à la procédure de dérogation pour travaux interdits aux mineurs (élèves bénéficiant de la dérogation en application des articles A.4152-1 à 4152-34 , cf. article 10 de la convention) ;</li>
					<li>-	modalités d’évaluation de la période de formation en milieu professionnel, en référence au règlement d’examen du diplôme préparé.</li>

				
				</ul>
			</div>			
			
		</div>
	</div>
	
	<div class="col-md-12 marginbottom40 padding10 <?php echo $backgroundentreprise; ?>">
	<div class="col-md-12 cadrestyle marginbottom40 textcenter fontsize30 fontbold">
		Annexe financière
	</div>
		<p>Pour aider l’établissement à mieux gérer ses frais d’organisation des périodes de formation en milieu professionnel, nous vous serions reconnaissants de bien vouloir remplir le questionnaire suivant et le retourner avec la convention signée.</p>
		<p>L’entreprise participe-t-elle aux frais d’organisation des périodes de formation en milieu professionnel.</p>
		<div class="row">
			<div class="col-md-2">
				<div class="fontsize15 displayflexmiddle marginbottom10"><span>OUI</span><input type="radio" class="checkboxclass" <?php echo $finance_entdisabled; ?> <?php if($finance_ent=="1"){ echo "checked"; } ?> name="finance_ent" value="1" /></div>
				<div class="fontsize15 displayflexmiddle"><span>NON</span><input type="radio" class="checkboxclass" name="finance_ent" <?php echo $finance_entdisabled; ?> <?php if($finance_ent=="0"){ echo "checked"; } ?> value="0" /></div>
			</div>
			<div class="col-md-2">
				<p>Si oui :</p>
			</div>
			<div class="col-md-4">
				
				<div class="fontsize15 displayflexmiddle marginbottom10"><span>Frais de restauration :</span><input type="text"  name="finance_rest1" <?php echo $finance_rest1attr; ?> value="<?php echo $finance_rest1; ?>" /></div>
				<div class="fontsize15 displayflexmiddle marginbottom10"><span>Frais de transport :</span><input type="text"  name="finance_transp1" <?php echo $finance_transp1attr; ?> value="<?php echo $finance_transp1; ?>" /></div>
				<div class="fontsize15 displayflexmiddle"><span>Frais d’hébergement :</span><input type="text" name="finance_heberg1" <?php echo $finance_heberg1attr; ?> value="<?php echo $finance_heberg1; ?>" /></div>
			
			</div>
			<div class="col-md-4">
				
				<div class="fontsize15 displayflexmiddle marginbottom10"><span>soit par repas :</span><input type="text"  name="finance_rest2" <?php echo $finance_rest2attr; ?> value="<?php echo $finance_rest2; ?>" /></div>
				<div class="fontsize15 displayflexmiddle marginbottom10"><span>soit par jour :</span><input type="text"  name="finance_transp2" <?php echo $finance_transp2attr; ?> value="<?php echo $finance_transp2; ?>" /></div>
				<div class="fontsize15 displayflexmiddle"><span>soit par nuit :</span><input type="text" name="finance_heberg2" <?php echo $finance_heberg2attr; ?> value="<?php echo $finance_heberg2; ?>" /></div>
			
			</div>
			
		</div>

	</div>
	<div class="col-md-12 marginbottom40 padding10 <?php echo $backgroundentreprise; ?>">
		<div class="row">
			<div class="col-md-12 marginbottom10">
					<div class="row displayflexmiddle"><label  class="col-md-3" >Gratification éventuelle :</label><div class="col-md-9"><input  type="text" name="finance_grat" <?php echo $finance_gratattr; ?> value="<?php echo $finance_grat; ?>" /></div></div>
			</div>
			<div class="col-md-6 marginbottom10">
					<div class="row displayflexmiddle"><label  class="col-md-4" >Montant de la gratification :</label><div class="col-md-8"><input  type="text" name="finance_grat_montant" <?php echo $finance_grat_montantattr; ?> value="<?php echo $finance_grat_montant; ?>" /></div></div>
			</div>
			<div class="col-md-6 marginbottom10">
					<div class="row displayflexmiddle"><label  class="col-md-4" >Modalités de versement :</label><div class="col-md-8"><input  type="text" name="finance_versement" <?php echo $finance_versementattr; ?> value="<?php echo $finance_versement; ?>" /></div></div>
			</div>
			
		</div>
	</div>
	<div class="col-md-12 marginbottom40 padding10 <?php echo $backgroundentreprise; ?>">
		<table border=1 class="tablehoraire width100" >
			<tbody>
				<tr><td colspan="2" class="fontbold fontsize15">Assurance  (Obligatoire) : article 14 de la convention – Assurance responsabilité civile</td></tr>
				<tr><td class="fontbold fontsize15">Pour l’entreprise</td><td class="fontbold fontsize15">Pour le lycée professionnel</td></tr>
				<tr>
					<td>
						<div class="row">
							<div class="col-md-12 marginbottom10">
									<div class="row displayflexmiddle"><label  class="col-md-4" >Nom de l’assureur :</label><div class="col-md-9"><input  type="text" name="ent_assurreur" <?php echo $ent_assurreurattr; ?> value="<?php echo $ent_assurreur; ?>" /></div></div>
							</div>
							<div class="col-md-12 marginbottom10">
									<div class="row displayflexmiddle"><label  class="col-md-4" >N° du contrat :</label><div class="col-md-8"><input  type="text" name="ent_numcontrat" <?php echo $ent_numcontratattr; ?> value="<?php echo $ent_numcontrat; ?>" /></div></div>
							</div>
							
						</div>
					</td>
					<td>
						<div class="row">
							<div class="col-md-12 marginbottom10">
									<div class="row displayflexmiddle"><label  class="col-md-4" >Nom de l’assureur :</label><div class="col-md-9"><input  type="text" name="uai_assureur" <?php echo $uai_assureurattr; ?> value="<?php echo $uai_assureur; ?>" /></div></div>
							</div>
							<div class="col-md-12 marginbottom10">
									<div class="row displayflexmiddle"><label  class="col-md-4" >N° du contrat :</label><div class="col-md-8"><input  type="text" name="uai_numcontrat" <?php echo $uai_numcontratattr; ?> value="<?php echo $uai_numcontrat; ?>" /></div></div>
							</div>
							
						</div>
					</td>
				</tr>
			</tbody>
		</table>
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