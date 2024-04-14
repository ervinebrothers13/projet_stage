<?php

if(isset($_GET["stage"])){
	
?>

<div id="addoffer">
<div class="step">Etape 3 sur 5</div>
<div class="steplib">L'accueil du stagiaire</div>
<div class="fr-stepper__steps" data-fr-current-step="3" data-fr-steps="5"></div>
<i>Etape suivant : Informations pratiques du stage</i>
</br></br>
<form id="addstage3-form" method="POST" action="<?php echo get_template_directory_uri(); ?>/actiondev2.php?act=addstage3">
<input type="hidden" name="stageid" value="<?php echo $_GET["stage"]; ?>" />
<h3>Date du stage</h3>
<div class="row">
	<div class="col-md-6">
		<div class="row">
			<label  class="control-label col-md-12" for="datestage">Disponibilité * :</label>
			<div id="datestage1but" class="row col-md-12 cursorpointer selectdatestage">
				<span class="control-label col-md-3  "><input type="radio" class="selectdatestageinput form-control " id="datestage1" name="datestage" value="1" <?php if($tabstage["dispo"]=="1" or $tabstage["dispo"]==null){ echo "checked"; } ?> ></span><span class="control-label col-md-9 smallradio">Toute l'année scolaire 2023-2024</span>
			</div>
			<div id="datestage2but" class="row col-md-12 margintop10 cursorpointer selectdatestage">
				<span class="control-label col-md-3 "><input type="radio" class="selectdatestageinput form-control " id="datestage2" name="datestage" value="2" <?php if($tabstage["dispo"]=="2"){ echo "checked"; } ?> ></span><span class="control-label col-md-9 smallradio">Semaines spécifiques</span>
			</div>
			<div id="datestage3but" class="row col-md-12 margintop10 cursorpointer selectdatestage">
				<span class="control-label col-md-3 "><input type="radio" class="selectdatestageinput form-control " id="datestage3" name="datestage" value="3" <?php if($tabstage["dispo"]=="3"){ echo "checked"; } ?> ></span><span class="control-label col-md-9 smallradio"> Une fouchette de dates</span>
			</div>
			<div id="selectdatestagediv" class="margintop10 marginleft60 <?php if($tabstage["dispo"]!="2" or $tabstage["dispo"]==null){ echo "displaynone"; } ?>">
				<div class="custom-control-checkbox-list">
				<?php
				
				$tabsem=array();
				$lststage_sem=lstData("stage_sem",$stage_id);
				foreach($lststage_sem as $sem){
					
					array_push($tabsem,$sem["semaine"]);
					
				}
							
							
				$weeks=getWeek();
				
				foreach($weeks as $value){
					
					$checked="";
					if(in_array($value[0],$tabsem))$checked="checked";
					
				?>
				
					<div class="fr-checkbox-group hosting_infocontent">
						<input type="checkbox" class="hosting_infocheck" value="<?php echo $value[0]; ?>" <?php echo $checked; ?> name="hosting_info[]">
						<label for="hosting_info" class="fr-label hosting_info">Semaine <?php echo $value[0]; ?> - du <?php echo $value[1]; ?> au <?php echo $value[2]; ?></label>
						
					</div>
				
				
				<?php } ?>
				
				</div>
			</div>
			<div id="selectdatestagediv2" class="margintop10 marginleft60 <?php if($tabstage["dispo"]!="3" or $tabstage["dispo"]==null){ echo "displaynone"; } ?>">
			<div class="row">
				<div class="col-md-1 smallradio">Du</div>
				<div class="col-md-5">
					<div class="input-group date" id="ddebut">
						<input type="text" name="chpdddebut" id="chpdddebut" class="form-control" value="<?php echo fDate($tabstage["dispo_opt3_d1"],"html"); ?>" >
						<span class="input-group-addon btn-primary smallradio padding5"><i class="fa fa-calendar"></i></span>
					</div>
				</div>
				<div class="col-md-1 smallradio">au</div>
				<div class="col-md-5">
					<div class="input-group date" id="ddfin">
						<input type="text" name="chpddfin" id="chpddfin" class="form-control" value="<?php echo fDate($tabstage["dispo_opt3_d2"],"html"); ?>" >
						<span class="input-group-addon btn-primary smallradio padding5"><i class="fa fa-calendar"></i></span>
					</div>
				</div>
				</div>
				
			</div>
		</div>
	</div>
	
	<br><br>
</div><br>
<div class="row">
	<div class="col-md-6">
		<div class="row">
			<label  class="control-label col-md-12" for="stageradionb">Ce stage est :</label>
			<div id="typnbstage1but" class="row col-md-12 cursorpointer selecttypnbstage">
				<span class="control-label col-md-3  "><input type="radio" class="form-control " id="typnbstage1" name="stageradionb" <?php if($tabstage["typ_nb"]=="1" or $tabstage["typ_nb"]==null){ echo "checked"; } ?> value="1" ></span><span class="control-label col-md-9 smallradio">Individuel, un seul élève par stage</span>
			</div>
			<div id="typnbstage2but" class="row col-md-12 margintop10 cursorpointer selecttypnbstage">
				<span class="control-label col-md-3 "><input type="radio" class="form-control " id="typnbstage2" name="stageradionb" <?php if($tabstage["typ_nb"]=="2"){ echo "checked"; } ?> value="2" ></span><span class="control-label col-md-9 smallradio">Collectif, plusieurs élèves par stage</span>
			</div>
		</div>
		<div id="selecttypnbstagediv" class="marginleft60 <?php if($tabstage["typ_nb"]!="2" or $tabstage["typ_nb"]==null){ echo "displaynone"; } ?> padding20">
		<div class="row" >
			<div class="col-md-12">
				<label for="nbmaxelv">Nombre maximal d'élèves par groupe :</br><i>Renseignez ici l'effectif maximal de votre groupe d'élèves</i></label>
				<?php
				
				$nbb=1;if($tabstage["typ_nb_opt2"]!=null)$nbb=$tabstage["typ_nb_opt2"];
				
				?>
				<input type="text" id="nbmaxelv" name="nbmaxelv" value="<?php echo $nbb; ?>" />
				<br>
			</div>
		</div>
		</div>
	</div>
	<div class="col-md-6 smallradio">
		<div class="fenetreconseil">
			<div class="fenetreconseilgauche">
				<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
			</div>
			<div class="fenetreconseildroite">
				<h3 class="fenetreconseil_title">Conseil</h3>
				<p>L'accueil de plusieurs élèves en même temps peut avoir un caractère rassurant pour eux. Et cela ne demande pas plus de préparation.</p>
			</div>
		</div>
	</div>
	<br><br>
</div>
<div class="row margintop20">
	<div class="col-md-6">
		<div class="row">
			
			<div class="row col-md-12 selectreserveetab cursorpointer">
				<span class="control-label col-md-3"><input type="checkbox" class="form-control selectreserveetabclass" id="selectreserveetabid" name="reserveetab" <?php if($tabstage["reserv_uai"]=="1"){ echo "checked"; } ?> value="1" ></span><span class="control-label col-md-9">Ce stage est réservé à certains établissements ?</br><i>Les stages reservés ne seront proposés qu'aux élèves des établissements selectionnés.</i></span>
			</div>
			
		</div>
		<div id="selectreserveetabdiv" class="marginleft60 <?php if($tabstage["reserv_uai"]=="0" or $tabstage["reserv_uai"]==null){ echo "displaynone"; } ?> padding20">
		
		<div class="row" >
			<div class="col-md-12">
				<select name="basicuai[]" multiple="multiple" class="3col active form-control">
       
					<?php
							
							
							$tabuai=array();
							$lststage_uai=lstData("stage_uai",$stage_id);
							foreach($lststage_uai as $uai){
								
								array_push($tabuai,$uai["uai_rne"]);
								
							}
							
							$lstuai=lstData("uai");
							
							foreach($lstuai as $value){
								
								$selected="";
								if(in_array($value["uai_rne"],$tabuai))$selected="selected";
								
								echo '<option value="'.$value["uai_rne"].'" '.$selected.' >'.($value["uai_lc"]).'</option>';
								
							}
							
							
					?>
				</select>
			</div>
		</div>
		</div>
	</div>
	<div class="col-md-6 smallradio">
		<div class="fenetreconseil">
			<div class="fenetreconseilgauche">
				<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
			</div>
			<div class="fenetreconseildroite">
				<h3 class="fenetreconseil_title">Conseil</h3>
				<p>Si vous choisissez cette option, seul les établissements sélectionnées verront votre offres</p>
			</div>
		</div>
	</div>
	<br><br>
</div>
<div class="row margintop20" >
	<div class="col-md-6">
		<label for="nbmaxelvannee">Nombre total d'élèves que vous souhaitez accueillir sur l'année scolaire :</br><i>Vous accueillerez ces élèves individuellement ou par groupes</i></label>
		<?php
				
		$nbb2=1;if($tabstage["nb_elv_an"]!=null)$nbb2=$tabstage["nb_elv_an"];
		
		?>
		<input type="text" id="nbmaxelvannee" name="nbmaxelvannee" value="<?php echo $nbb2; ?>" />
		<br><br><br>
	</div>
</div>

<div class="col-lg-12">
        <a href="<?php echo get_site_url(); ?>/deposer-une-offre/?etape=2&stage=<?php echo $_GET["stage"]; ?>" class="btn btn-secondary"><i class="fa fa-mail-reply"></i> Précédent</a>
        <button type="submit" class="btn btn-warning"> Suivant</button>
		<br><br> <a href="<?php echo get_site_url(); ?>/espace-entreprise/" class="btn btn-primary"><i class="fa fa-user"></i> Retour</a>
 </div>
</form>
<?php

}

?>