<?php

if(isset($_GET["stage"])){
	
?>

<div id="addoffer">
<div class="step">Etape 4 sur 5</div>
<div class="steplib">Informations pratiques</div>
<div class="fr-stepper__steps" data-fr-current-step="4" data-fr-steps="5"></div>
<i>Etape suivant : Récapitulatif</i>
</br></br>
<form id="addstage1-form" method="POST" action="<?php echo get_template_directory_uri(); ?>/actiondev2.php?act=addstage4">
<input type="hidden" name="stageid" value="<?php echo $_GET["stage"]; ?>" />
<div class="row">
	<div class="col-md-6">
		<h3>Contact du dépositaire</h3>
		<label for="contactdepo">Votre numéro de téléphone de correspondance :</br><i>Ce numéro ne sera pas partagé avec les élèves et sera utilisé éventuellement et uniquement par les équipes internes de monstagedetroisieme pour vous contacter au sujet de votre offre.</i></label>
		<?php
		
			$tel=0;
			if($tabstage["stage_tel"]==null)$tel=($tabarray["ent_tel"]);
			else $tel=($tabstage["stage_tel"]);
			
		?>
		
		<input type="text" id="contactdepo" name="contactdepo" value="<?php echo $tel; ?>">
		<h3>Nom et prénom du responsable de stage</h3>
		
		
		<input type="text" id="contactname" name="contactname" value="<?php echo ($tabstage["stage_contact"]); ?>">
		<br>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<h3>Adresse du stage</h3>
		<label for="contactcommune">Commune :</label>
		<?php
		
			$commune=0;
			if($tabstage["stage_com"]==null)$commune=($tabarray["ent_com"]);
			else $commune=($tabstage["stage_com"]);
			
		?>
		<select  class="form-control" id="contactcommune" name="contactcommune">
			<?php echo(BLst('commune','IDGeo','Geo',$commune,"","","","",""));?>
		</select>
		<br>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<label for="contactgeo">Adresse géographique :</label>
		<?php
		
			$adresse=0;
			if($tabstage["stage_adr"]==null)$adresse=($tabarray["ent_adr"]);
			else $adresse=($tabstage["stage_adr"]);
			
		?>
		<input type="text" id="contactgeo" name="contactgeo" value="<?php echo $adresse; ?>" >
		<br>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<label for="contactcodpost">Code postale (facultatif):</label>
		<?php
		
			$codepos=0;
			if($tabstage["stage_codepos"]==null)$codepos=($tabarray["ent_codepos"]);
			else $codepos=($tabstage["stage_codepos"]);
			
		?>
		<input type="text" id="contactcodpost" name="contactcodpost" value="<?php echo $codepos; ?>" >
		<br>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<label for="contactpk">PK (facultatif):</label>
		<?php
		
			$pk=0;
			if($tabstage["stage_pk"]==null)$pk=($tabarray["ent_pk"]);
			else $pk=($tabstage["stage_pk"]);
			
		?>
		<input type="text" id="contactpk" name="contactpk" value="<?php echo $pk; ?>">
		<br>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<label for="contactquartier">Quartier (facultatif):</label>
		<?php
		
			$quart=0;
			if($tabstage["stage_quart"]==null)$quart=$tabarray["ent_quart"];
			else $quart=$tabstage["stage_quart"];
			
		?>
		<input type="text" id="contactquartier" name="contactquartier" value="<?php echo $quart; ?>">
		<br>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<label for="contactrue">Rue (facultatif):</label>
		<?php
		
			$rue=0;
			if($tabstage["stage_rue"]==null)$rue=($tabarray["ent_rue"]);
			else $rue=($tabstage["stage_rue"]);
			
		?>
		<input type="text" id="contactrue" name="contactrue" value="<?php echo $rue; ?>">
		<br>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<label for="contactimm">Immeuble (facultatif) :</label>
		<?php
		
			$immeuble=0;
			if($tabstage["stage_imm"]==null)$immeuble=($tabarray["ent_imm"]);
			else $immeuble=($tabstage["stage_imm"]);
			
		?>
		<input type="text" id="contactimm" name="contactimm" value="<?php echo $immeuble; ?>">
		<br>
	</div>
</div>
<div class="row margintop20">
	<div class="col-md-6">
		<div class="row">
			
			<div class="row col-md-12" id="horairesemainetab">
				<?php
				
				$checked="";
				
				if($tabstage["typ_horaire"]=="1"){
					
					$checked="checked";
					
				}
				
				if($tabstage["typ_horaire"]==null){
					
					$checked="checked";
					
				}
				
				if($tabstage["typ_horaire"]=="0"){
					
					$checked="";
					
				}
				
				
				?>
				<span class="control-label col-md-3"><input type="checkbox" class="form-control horairesemainetabclass" name="horairesemaine" value="1" <?php echo $checked; ?> /></span><span class="control-label col-md-9 smallradio">Les horaires sont les mêmes toute la semaine</span>
			</div>
			<?php
				
				$displaynone="displaynone";
				
				if($tabstage["typ_horaire"]=="1"){
					
					$displaynone="";
					
				}
				
				if($tabstage["typ_horaire"]==null){
					
					$displaynone="";
					
				}
				
				if($tabstage["typ_horaire"]=="0"){
					
					$displaynone="displaynone";
					
				}
				
				
				?>
			<div id="horairesemainecontent1" class="<?php echo $displaynone; ?>" >
			<div class="row marginleft60" >
				<span class="col-md-5"><input type="text" id="horairesemainedebut" name="horairesemainedebut" placeholder="8h00" value="<?php echo $tabstage["typ_horaire_opt1_h1"]; ?>"></span><span class="col-md-2 smallradio">à</span><span class="col-md-5"><input type="text" id="horairesemainefin" name="horairesemainefin" placeholder="15h30" value="<?php echo $tabstage["typ_horaire_opt1_h2"]; ?>" /></span>
			</div>
			</div>
			
			<?php
				
				$displaynone1="";
				
				if($tabstage["typ_horaire"]=="1"){
					
					$displaynone1="displaynone";
					
				}
				
				if($tabstage["typ_horaire"]==null){
					
					$displaynone1="displaynone";
					
				}
				
				if($tabstage["typ_horaire"]=="0"){
					
					$displaynone1="";
					
				}
				
			?>
			<div id="horairesemainecontent2" class="marginleft60 <?php echo $displaynone1; ?>" >
			<div class="row">
				<?php $tabstage_horaire1=recData("stage_horaire1",$stage_id); ?>
				<div class="row" ><span class="col-md-3 smallradio">Lundi de</span><span class="col-md-4"><input type="text" id="horairesemainedebut1" name="horairesemainedebut1" placeholder="8h00" value="<?php if(isset($tabstage_horaire1["heure1"]))echo $tabstage_horaire1["heure1"]; ?>" /></span><span class="col-md-1 smallradio">à</span><span class="col-md-4"><input type="text" id="horairesemainefin1" name="horairesemainefin1" placeholder="15h30" value="<?php if(isset($tabstage_horaire1["heure2"]))echo $tabstage_horaire1["heure2"]; ?>" /></span></div>
				<?php $tabstage_horaire2=recData("stage_horaire2",$stage_id); ?>
				<div class="row margintop10"><span class="col-md-3 smallradio">Mardi de</span><span class="col-md-4"><input type="text" id="horairesemainedebut2" name="horairesemainedebut2" placeholder="8h00" value="<?php if(isset($tabstage_horaire2["heure1"]))echo $tabstage_horaire2["heure1"]; ?>" /></span><span class="col-md-1 smallradio">à</span><span class="col-md-4"><input type="text" id="horairesemainefin2" name="horairesemainefin2" placeholder="15h30" value="<?php if(isset($tabstage_horaire2["heure2"]))echo $tabstage_horaire2["heure2"]; ?>" /></span></div>
				<?php $tabstage_horaire3=recData("stage_horaire3",$stage_id); ?>
				<div class="row margintop10" ><span class="col-md-3 smallradio">Mercredi de</span><span class="col-md-4"><input type="text" id="horairesemainedebut3" name="horairesemainedebut3" placeholder="8h00" value="<?php if(isset($tabstage_horaire3["heure1"]))echo $tabstage_horaire3["heure1"]; ?>" /></span><span class="col-md-1 smallradio">à</span><span class="col-md-4"><input type="text" id="horairesemainefin3" name="horairesemainefin3" placeholder="15h30" value="<?php if(isset($tabstage_horaire3["heure2"]))echo $tabstage_horaire3["heure2"]; ?>" /></span></div>
				<?php $tabstage_horaire4=recData("stage_horaire4",$stage_id); ?>
				<div class="row margintop10" ><span class="col-md-3 smallradio">Jeudi de</span><span class="col-md-4"><input type="text" id="horairesemainedebut4" name="horairesemainedebut4" placeholder="8h00" value="<?php if(isset($tabstage_horaire4["heure1"]))echo $tabstage_horaire4["heure1"]; ?>" /></span><span class="col-md-1 smallradio">à</span><span class="col-md-4"><input type="text" id="horairesemainefin4" name="horairesemainefin4" placeholder="15h30" value="<?php if(isset($tabstage_horaire4["heure2"]))echo $tabstage_horaire4["heure2"]; ?>" /></span></div>
				<?php $tabstage_horaire5=recData("stage_horaire5",$stage_id); ?>
				<div class="row margintop10" ><span class="col-md-3 smallradio">Vendredi de</span><span class="col-md-4"><input type="text" id="horairesemainedebut5" name="horairesemainedebut5" placeholder="8h00" value="<?php if(isset($tabstage_horaire5["heure1"]))echo $tabstage_horaire5["heure1"]; ?>" /></span><span class="col-md-1 smallradio">à</span><span class="col-md-4"><input type="text" id="horairesemainefin5" name="horairesemainefin5" placeholder="15h30" value="<?php if(isset($tabstage_horaire5["heure2"]))echo $tabstage_horaire5["heure2"]; ?>" /></span></div>
				<?php $tabstage_horaire6=recData("stage_horaire6",$stage_id); ?>
				<div class="row margintop10" ><span class="col-md-3 smallradio">Samedi de</span><span class="col-md-4"><input type="text" id="horairesemainedebut6" name="horairesemainedebut6" placeholder="8h00" value="<?php if(isset($tabstage_horaire6["heure1"]))echo $tabstage_horaire6["heure1"]; ?>" /></span><span class="col-md-1 smallradio">à</span><span class="col-md-4"><input type="text" id="horairesemainefin6" name="horairesemainefin6" placeholder="15h30" value="<?php if(isset($tabstage_horaire6["heure2"]))echo $tabstage_horaire6["heure2"]; ?>" /></span></div>
			</div>
			</div>
		</div>
		
	</div>
	
	<br><br>
</div>
<div class="row margintop20">
	<div class="col-md-6">
		<label for="userrue">Pause déjeuner :</br><i>Indiquez ci-dessous les détails concernant les horaires, le lieu, si l'élève doit apporter son déjeuner et qui sera responsable de l'élève durant cette pause.</i></label>
		<div class="row"><span class="col-md-5"><input type="text" id="horairepausedebut" name="horairepausedebut" placeholder="12h00" value="<?php echo $tabstage["pause_dej_h1"]; ?>" /></span><span class="col-md-2 smallradio">à</span><span class="col-md-5"><input type="text" id="horairepausefin" name="horairepausefin" placeholder="13h00" value="<?php echo $tabstage["pause_dej_h2"]; ?>" /></span></div>
		<br>
	</div>
</div>
<div class="col-lg-12">
        <a href="<?php echo get_site_url(); ?>/deposer-une-offre/?etape=3&stage=<?php echo $_GET["stage"]; ?>" class="btn btn-secondary"><i class="fa fa-mail-reply"></i> Précédent</a>
        <button type="submit" class="btn btn-warning"> Suivant</button>
		<br><br> <a href="<?php echo get_site_url(); ?>/espace-entreprise/" class="btn btn-primary"><i class="fa fa-user"></i> Retour</a>
 </div>
</form>
<?php

}

?>