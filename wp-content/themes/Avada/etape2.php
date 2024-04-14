
<?php

if(isset($_GET["stage"])){
	
?>

<div id="addoffer">
<div class="step">Etape 2 sur 5</div>
<div class="steplib">L'offre de stage</div>
<div class="fr-stepper__steps" data-fr-current-step="2" data-fr-steps="5"></div>
<i>Etape suivant : L'accueil du stagiaire</i>
</br>
</br>
<form id="addstage2-form" method="POST" action="<?php echo get_template_directory_uri(); ?>/actiondev2.php?act=addstage2">
<input type="hidden" name="stageid" value="<?php echo $_GET["stage"]; ?>" />
<h3>Description du stage</h3>
<div class="row">
	<div class="col-md-6">
		<div class="row">
			<label  class="control-label col-md-12" for="stagesecteur">Type de stage :</label>
			<div class="row col-md-12 cursorpointer" id="usersecteurid1">
				<span class="control-label col-md-3"><input type="radio" id="usersecteurinput1" class="form-control usersecteurclass" name="stagesecteur" <?php if($tabstage["type_id"]=="1" or $tabstage["type_id"]==null){ echo "checked"; } ?> value="1" /></span><span class="control-label col-md-9 smallradio">Stage découverte de 3ème</span>
			</div>
			<div class="row col-md-12 margintop10 cursorpointer" id="usersecteurid2">
				<span class="control-label col-md-3"><input type="radio" id="usersecteurinput2" class="form-control usersecteurclass" name="stagesecteur" <?php if($tabstage["type_id"]=="2"){ echo "checked"; } ?> value="2" /></span><span class="control-label col-md-9 smallradio">Stage PFMP</span>
			</div>
			<div class="row col-md-12 margintop10 cursorpointer" id="usersecteurid3">
				<span class="control-label col-md-3"><input type="radio" id="usersecteurinput3" class="form-control usersecteurclass" name="stagesecteur" <?php if($tabstage["type_id"]=="3"){ echo "checked"; } ?> value="3" /></span><span class="control-label col-md-9 smallradio">Stage BTS</span>
			</div>
		</div>
	</div>
	
	<br><br>
</div>
<div id="usersecteurdiv1" <?php if($tabstage["type_id"]=="2" or $tabstage["type_id"]=="3"){ echo 'class="displaynone"'; } ?> >
<div class="row margintop20">
	<div class="col-md-6">
		<label for="secteuractivite1">Domaine d'activité :</label>
		<select name="secteuractivite1" class="form-control">
			<option value="">-- Veuillez sélectionner un domaine --</option>
			<?php
						
				$lstsecteur1=lstData("secteur1");
							
				foreach($lstsecteur1 as $value1){
					
					$selected="";if($value1["sect_id"]==$tabstage["dom_id"])$selected="selected";			
			?>
				
					<option value="<?php echo $value1["sect_id"]; ?>" <?php echo $selected; ?> ><?php echo ($value1["sect_lib"]); ?></option>
						
						
			<?php
				
				}
							
			?>
		</select>
		<br>
	</div>
</div>
</div>
<div id="usersecteurdiv2" <?php if($tabstage["type_id"]=="1"  or $tabstage["type_id"]=="3" or $tabstage["type_id"]==null){ echo 'class="displaynone"'; } ?>>
<div class="row margintop20 ">
	<div class="col-md-6">
		<label for="secteuractivite2">Domaine d'activité :</label>
		<select name="secteuractivite2" class="form-control">
			<?php
						
				$lstsecteur2=lstData("secteur2");
							
				foreach($lstsecteur2 as $value2){
					
					$selected="";if($value2["sect_id"]==$tabstage["dom_id"])$selected="selected";			
			?>
				

				<option value="<?php echo $value2["sect_id"]; ?>" <?php echo $selected; ?> ><?php echo ($value2["sect_lib"]); ?></option>
						
						
			<?php
				
				}
							
			?>
			</select>
		<br>
	</div>
</div>
</div>
<div id="usersecteurdiv3" <?php if($tabstage["type_id"]=="2" or $tabstage["type_id"]=="1" or $tabstage["type_id"]==null){ echo 'class="displaynone"'; } ?> >
<div class="row margintop20">
	<div class="col-md-6">
		<label for="secteuractivite3">Domaine d'activité :</label>
		<select name="secteuractivite3" class="form-control">
			<option value="">-- Veuillez sélectionner un domaine --</option>
			<?php
						
				$lstsecteur1=lstData("secteur3");
							
				foreach($lstsecteur1 as $value1){
					
					$selected="";if($value1["sect_id"]==$tabstage["dom_id"])$selected="selected";			
			?>
				
					<option value="<?php echo $value1["sect_id"]; ?>" <?php echo $selected; ?> ><?php echo ($value1["sect_lib"]); ?></option>
						
						
			<?php
				
				}
							
			?>
		</select>
		<br>
	</div>
</div>
</div>
<div class="row">
	<div class="col-md-6">
		<label for="metierdecouv">Métier à découvrir :</br><i>Indiquez clairement le métier à découvrir par l’élève</i></label>
		<input type="text" id="metierdecouv" name="metierdecouv" placeholder="Animateur sportif, Métiers de l'hotellerie..." value="<?php echo ($tabstage["metier"]); ?>" >
		<br>
	</div>
	<div class="col-md-6 smallradio">
		<div class="fenetreconseil">
			<div class="fenetreconseilgauche">
				<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
			</div>
			<div class="fenetreconseildroite">
				<h3 class="fenetreconseil_title">Conseil</h3>
				<p>Nommez le(s) métiers qui sont concernés par le stage, cela facilitera la recherche de l’élève. Attention à l’utilisation des acronymes.</p>
			</div>
		</div>
	</div>	
</div>
<div class="row">
	<div class="col-md-6">
		<label for="activestage">Activité(s) du stage :</label>
		<textarea id="activestage" name="activestage" rows="6" class="form-control"><?php echo ($tabstage["activity"]); ?></textarea>
		<br>
	</div>
	<div class="col-md-6 smallradio">
		<div class="fenetreconseil">
			<div class="fenetreconseilgauche">
				<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
			</div>
			<div class="fenetreconseildroite">
				<h3 class="fenetreconseil_title">Conseil</h3>
				<p>Ce paragraphe est très important car il va permettre à l'élève de se projeter dans son futur stage. Il est important d'utiliser des mots simples. N'hésitez pas à ajouter des détails.</p>
			</div>
		</div>
	</div>	
</div>

<div class="col-lg-12">
        <a href="<?php echo get_site_url(); ?>/deposer-une-offre/?etape=1&stage=<?php echo $_GET["stage"]; ?>" class="btn btn-secondary"><i class="fa fa-mail-reply"></i> Précédent</a>
        <button type="submit" class="btn btn-warning"> Suivant</button>
		<br><br> <a href="<?php echo get_site_url(); ?>/espace-entreprise/" class="btn btn-primary"><i class="fa fa-user"></i> Retour</a>
 </div>
</form>

<?php

}

?>