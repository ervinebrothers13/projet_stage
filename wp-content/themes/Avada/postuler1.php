
<div id="addoffer">
<div class="step">Etape 1 sur 4</div>
<div class="steplib">Mon profil</div>
<div class="fr-stepper__steps2" data-fr-current-step="1" data-fr-steps="4"></div>
<i>Etape suivant : Date du stage</i>
</br></br>
<form id="addstage1-form" method="POST" action="<?php echo get_template_directory_uri(); ?>/actiondev2.php?act=postuler1">
<input type="hidden" name="stage_id" value="<?php echo $stagehash; ?>" />
<input type="hidden" name="cand_id" value="<?php echo $candhash; ?>" />
<div class="row">
	<div class="col-md-6">
		<h3>Votre Profil</h3>
		<label for="username">Nom :</label>
		<input type="text" id="username" name="username" value="<?php echo ($tabeleve["elv_nom"]); ?>" />
		<br>
	</div>
</div><br>
<div class="row">
	<div class="col-md-6">
		<label for="userprename">prénom :</label>
		<input type="text" id="userprename" name="userprename" value="<?php echo ($tabeleve["elv_pren"]); ?>" />
		<br>
	</div>
</div><br>
<div class="row">
	<div class="col-md-6">
		<label for="usertel">Téléphone :</label>
		<input type="text" id="usertel" name="usertel" value="<?php echo ($tabeleve["elv_tel"]); ?>" />
		<br>
	</div>
</div>
<br>
<div class="row">
	<div class="col-md-6">
		<label for="userdatenais">Date de naissance :</label>
		<div class="input-group date" id="ddnais">
				<input type="text" name="chpddnais" id="chpddnais" class="form-control" value="<?php echo fDate($tabeleve["elv_datenaiss"],"html"); ?>">
				<span class="input-group-addon btn-primary smallradio padding5"><i class="fa fa-calendar"></i></span>
			</div>
		<br>
	</div>
</div><br>
<div class="row">
	<div class="col-md-6">
		<label class="col-md-12" for="usersexe">Sexe :</label>
		<select  class="col-md-12 " id="usersexe" name="usersexe">
			<?php echo(BLst('sexe','sex_id','sex_lib',$tabeleve["elv_sexe"],"","","","",""));?>
		</select>
		
	</div>
</div>
<br>
<div class="row">
	<div class="col-md-6">
		<label class="col-md-12" for="usercommune">Commune :</label>
		<select  class="col-md-12 " id="usercommune" name="usercommune">
			<?php echo(BLst('commune','IDGeo','Geo',$tabeleve["elv_com"],"","","","",""));?>
		</select>
		
	</div>
	
</div><br>
<div class="row">
	<div class="col-md-6">
		<label for="usergeo">Adresse géographique :</label>
		<input type="text" id="usergeo" name="usergeo" value="<?php echo ($tabeleve["elv_adr"]); ?>">
		<br>
	</div>
</div>
<br>
<div class="row">
	<div class="col-md-6">
		<label for="useretab">Etablissement Scolaire fréquenté :</label>
		<select id="useretab" class="col-md-12" name="useretab">
			<?php echo(BLst('uai','uai_rne','uai_lc',$tabeleve["elv_uai"],"","","","",""));?>
		</select>
		<br>
	</div>
</div>
<br>
<div class="row">
	<div class="col-md-6">
		<label for="userclass">Classe:</label>
		<select id="userclass" class="col-md-12" name="userclass">
			 <?php echo(BLst('classe', 'class_id', 'class_lib', $tabeleve["elv_class"], "", "", "", "", "")); ?>
		</select>
		<br>
	</div>
</div><br>
<div class="row">
	<div class="col-md-6">
		<label for="userdiplome">Spécialité (facultatif):</label>
		<input type="text" id="userdiplome" name="userdiplome" value="<?php echo ($tabeleve["elv_diplome"]); ?>" />
		<br>
	</div>
</div><br>


<div class="col-lg-12">
		<?php if(lgchkpeda()){ ?>
		
			<br><a href="<?php echo get_site_url(); ?>/espace-pedagogique/" class="btn btn-default"><i class="fa fa-mail-reply"></i> Annuler</a>
        
		
		<?php }else{ ?>
			
			<br><a href="<?php echo get_site_url(); ?>/espace-eleve/" class="btn btn-default"><i class="fa fa-mail-reply"></i> Annuler</a>
        
		
		<?php } ?>
        <button type="submit" class="btn btn-warning"> Suivant</button><br><br>
 </div>
</form>