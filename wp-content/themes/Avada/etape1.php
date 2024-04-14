<?php

$stageid=0;if(isset($_GET["stage"]))$stageid=$_GET["stage"];

?>
<div id="addoffer">
<div class="step">Etape 1 sur 5</div>
<div class="steplib">Information sur l'entreprise</div>
<div class="fr-stepper__steps" data-fr-current-step="1" data-fr-steps="5"></div>
<i>Etape suivant : L'offre de stage</i>
</br></br>
<form id="addstage1-form" enctype="multipart/form-data" method="POST" action="<?php echo get_template_directory_uri(); ?>/actiondev2.php?act=addstage1">
<input type="hidden" name="stageid" value="<?php echo $stageid; ?>" />
<input type="hidden" name="type_id" value="<?php echo $type; ?>" />
<div class="row">
	<div class="col-md-6">
		<h3>L'entreprise</h3>
		<label for="useretahiti">Numéro tahiti :</label>
		<h3><?php echo ($tabarray["ent_numtahiti"]); ?></h3>
		<br><br>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<label for="usernom">Nom de l'entreprise :</label>
		<h3><?php echo ($tabarray["ent_nom"]); ?></h3>
		<br><br>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<label for="usercommune">Commune :</label>
		<select  class="form-control" id="usercommune" name="usercommune">
			<?php echo(BLst('commune','IDGeo','Geo',$tabarray["ent_com"],"","","","",""));?>
		</select>
		<br><br>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<label for="usergeo">Adresse géographique :</label>
		<input type="text" id="usergeo" name="usergeo" value="<?php echo ($tabarray["ent_adr"]); ?>" />
		<br><br>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<label for="usercodepos">Code postale (facultatif):</label>
		<input type="text" id="usercodepos" name="usercodepos" value="<?php echo ($tabarray["ent_codepos"]); ?>" />
		<br><br>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<label for="userpk">PK (facultatif):</label>
		<input type="text" id="userpk" name="userpk" value="<?php echo ($tabarray["ent_pk"]); ?>" />
		<br><br>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<label for="userquart">Quartier (facultatif):</label>
		<input type="text" id="userquart" name="userquart" value="<?php echo ($tabarray["ent_quart"]); ?>" />
		<br><br>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<label for="userrue">Rue (facultatif):</label>
		<input type="text" id="userrue" name="userrue" value="<?php echo ($tabarray["ent_rue"]); ?>" />
		<br><br>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<label for="userimmeuble">Immeuble (facultatif) :</label>
		<input type="text" id="userimmeuble" name="userimmeuble" value="<?php echo $tabarray["ent_imm"]; ?>" />
		<br><br>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="row">
			<label  class="control-label col-md-4" for="usersect">Secteur :</label>
			<span class="control-label col-md-1"><input type="radio" class="form-control " name="usersect" <?php if($tabarray["ent_sect"]=="1"){ echo "checked"; } ?> value="1" /></span><span class="control-label col-md-2 smallradio">Public</span>
			<span class="control-label col-md-1"><input type="radio" class="form-control " name="usersect" <?php if($tabarray["ent_sect"]=="2"){ echo "checked"; } ?> value="2" /></span><span class="control-label col-md-2 smallradio">Privé</span>
		</div>
		<br><br>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<label for="userdesc">Présentation de l'entreprise :</label>
		<textarea id="userdesc" name="userdesc" rows=6 class="form-control"><?php echo $tabarray["ent_desc"]; ?></textarea>
		<br>
	</div>
	<div class="col-md-6 smallradio">
		<div class="fenetreconseil">
			<div class="fenetreconseilgauche">
				<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
			</div>
			<div class="fenetreconseildroite">
				<h3 class="fenetreconseil_title">Conseil</h3>
				<p>La présentation de l’entreprise est un des éléments déterminant dans le choix du stage. Utilisez un vocabulaire simple, facile à comprendre. N’hésitez pas à ajouter des détails sur les principales activités de l’entreprise.</p>
			</div>
		</div>
	</div>	
</div>
<div class="row">
	<div class="col-md-6">
		<label for="userweb">Site web (Facultatif) :</label>
		<input type="text" id="userweb" name="userweb" value="<?php echo ($tabarray["ent_web"]); ?>" />
		
	</div>
</div><br><br>
<div class="row">
	<div class="col-md-6">
		<label for="userlogo">Logo de l'entreprise (Facultatif) :</label>
		<input type="file" id="logoent" name="logoent" />
		<br>
	</div>
	<?php
						
		if($tabarray["ent_logo"]!="" and $tabarray["ent_logo"]!=null){
		
		?>
		
		<div class="col-md-6">
			<h3>Vous avez déjà un logo, vous pouvez le remplacer si vous le souhaitez</h3>
			<img src="<?php echo get_site_url(); ?>/wp-content/uploads/logo/<?php echo $tabarray["ent_logo"]; ?>"  />
			
		</div>
		
		
		<?php
		
		}
		
		?>
</div>
<div class="col-lg-12">
       <button type="submit" class="btn btn-warning"> Suivant</button>
		<br><br> <a href="<?php echo get_site_url(); ?>/espace-entreprise/" class="btn btn-primary"><i class="fa fa-user"></i> Retour</a>
 </div>
</form>