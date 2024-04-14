
<div id="addoffer">
<div class="step">Etape 2 sur 4</div>
<div class="steplib">Date du stage</div>
<div class="fr-stepper__steps2" data-fr-current-step="2" data-fr-steps="4"></div>
<i>Etape suivant : CV et lettre de motivation</i>
</br></br>
<form id="addstage2-form" method="POST" action="<?php echo get_template_directory_uri(); ?>/actiondev2.php?act=postuler2">
<input type="hidden" name="cand_id" value="<?php echo $candhash;  ?>" />
<div class="row">
	<div class="col-md-6">
		<h3>Date du stage</h3>
	</div>
</div>
		<?php
		
		if($tabstage["dispo"]=="1"){
		
		?>
<div class="row">
	<div class="col-md-6">		
		<div class="fenetreconseil">
			<div class="fenetreconseilgauche">
				<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
			</div>
			<div class="fenetreconseildroite">
				<h3 class="fenetreconseil_title">Attention</h3>
				<p>Ce stage n'est pas programmé pour une date spécifique. Vous pouvez postuler pour la date que vous souhaitez.</p>
			</div>
		</div></br>
		<label for="username">Vos date de stage :</label>
		<div class="row">
		<div class="col-md-5">
			<div class="input-group date" id="ddebut">
				<input type="text" name="chpdddebut" id="chpdddebut" class="form-control" value="<?php echo fDate($tabcand["date_deb"],"html"); ?>" />
				<span class="input-group-addon btn-primary smallradio padding5"><i class="fa fa-calendar"></i></span>
			</div>
		</div>
		<div class="col-md-2 smallradio">au</div>
		<div class="col-md-5">
			<div class="input-group date" id="ddfin">
				<input type="text" name="chpddfin" id="chpddfin" class="form-control" value="<?php echo fDate($tabcand["date_fin"],"html"); ?>" />
				<span class="input-group-addon btn-primary smallradio padding5"><i class="fa fa-calendar"></i></span>
			</div>
		</div>
		
		<?php if(isset($_GET["msg"]) && $_GET["msg"] == "errordate"){ ?>
			</br><div class="col-md-12">
			<div class='alert alert-danger ctr'><button type='button' class='close' data-dismiss='alert'>&times;</button>Le format de date n'est pas valide. Bon format (dd/mm/yyyy)</div>
			</div>
		<?php } ?>
						
		</div>
	</div>
</div>
		<?php }else if($tabstage["dispo"]=="2"){ ?>
<div class="row">
	<div class="col-md-6">			
		<div class="fenetreconseil">
			<div class="fenetreconseilgauche">
				<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
			</div>
			<div class="fenetreconseildroite">
				<h3 class="fenetreconseil_title">Attention</h3>
				<p>Ce stage est programmé pour une marge de date spécifique. Vous ne pouvez pas postuler en dehors de ces dates.</p>
				
				<?php
				
				$tabsem=array();
					$lststage_sem=lstData("stage_sem",$tabstage["stage_id"]);
					foreach($lststage_sem as $sem){
						
						array_push($tabsem,$sem["semaine"]);
						
					}

					
					
					echo "<p>Disponibles sur ".sizeof($lststage_sem)." semaines</p>";
					echo "<ul class='nopadding showdatedispo'>";
					$weeks=getWeek();

					foreach($weeks as $value){
						
						$tabdate1=explode("/",$value[1]);
						$tabdate2=explode("/",$value[2]);
						
						$mois1=getmois($tabdate1[1]);
						$mois2=getmois($tabdate2[1]);
						
						
						
						
						if(in_array($value[0],$tabsem)){
							
							if($mois1==$mois2){
							
								echo "<li>Du ".$tabdate1[0]." au ".$tabdate2[0]." ".$mois1." ".$tabdate1[2]."</li>";
						
							}else{
							
								echo "<li>Du ".$tabdate1[0]." ".$mois1." au ".$tabdate2[0]." ".$mois2." ".$tabdate1[2]."</li>";												
								
							}
							
							
						}
							
					}
			
					echo "</ul>";
					
				?>
			</div>
		</div></br>
		
				<label for="useretab">Sélectionner la ou les semaines qui vous intéresse:</label>
				<div class="custom-control-checkbox-list selectcheckbox-list">
				<?php
				
				$tabsem=array();
				$lststage_sem=lstData("stage_sem",$tabstage["stage_id"]);
				foreach($lststage_sem as $sem){
					
					array_push($tabsem,$sem["semaine"]);
					
				}
				
				
				
							
							
				$weeks=getWeek();
				
				foreach($weeks as $value){
					
					$checked="";
					if(in_array($value[0],$tabsem)){
						
						$checked="";
						if($value[0]==$tabcand["semaine"])$checked="checked";
					
				?>
				
					<div class="fr-checkbox-group hosting_infocontent">
						<input type="radio" class="hosting_infocheck" value="<?php echo $value[0]; ?>" <?php echo $checked; ?> name="hosting_info">
						<label for="hosting_info" class="fr-label hosting_info">Semaine <?php echo $value[0]; ?> - du <?php echo $value[1]; ?> au <?php echo $value[2]; ?></label>
						
					</div>
				
				
				<?php

					}
				}

				?>
				
				</div>
				<br>
			
	</div>
</div>
		<?php }else if($tabstage["dispo"]=="3"){ ?>
<div class="row">
	<div class="col-md-6">			
		<div class="fenetreconseil">
			<div class="fenetreconseilgauche">
				<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
			</div>
			<div class="fenetreconseildroite">
				<h3 class="fenetreconseil_title">Attention</h3>
				<p>Ce stage est programmé pour une marge de date spécifique. Vous ne pouvez pas postuler en dehors de ces dates.</p>
				<p>Ce stage est programmé entre le <?php echo fDate($tabstage["dispo_opt3_d1"],"html"); ?> et le <?php echo fDate($tabstage["dispo_opt3_d2"],"html"); ?>.</p>
			</div>
		</div></br>
		<label for="username">Vos date de stage :</label>
		<div class="row">
		<div class="col-md-5">
			<div class="input-group date" id="ddebut">
				<input type="text" name="chpdddebut" id="chpdddebut" class="form-control" mindate="<?php echo fDate($tabstage["dispo_opt3_d1"],"html"); ?>" maxdate="<?php echo fDate($tabstage["dispo_opt3_d2"],"html"); ?>" value="<?php echo fDate($tabcand["date_deb"],"html"); ?>" />
				<span class="input-group-addon btn-primary smallradio padding5"><i class="fa fa-calendar"></i></span>
			</div>
		</div>
		<div class="col-md-2 smallradio">au</div>
		<div class="col-md-5">
			<div class="input-group date" id="ddfin">
				<input type="text" name="chpddfin" id="chpddfin" class="form-control" mindate="<?php echo fDate($tabstage["dispo_opt3_d1"],"html"); ?>" maxdate="<?php echo fDate($tabstage["dispo_opt3_d2"],"html"); ?>" value="<?php echo fDate($tabcand["date_fin"],"html"); ?>" />
				<span class="input-group-addon btn-primary smallradio padding5"><i class="fa fa-calendar"></i></span>
			</div>
		</div>
		<?php if(isset($_GET["msg"]) && $_GET["msg"] == "errordate"){ ?>
			</br><div class="col-md-12">
				<div class='alert alert-danger ctr'><button type='button' class='close' data-dismiss='alert'>&times;</button>Le format de date n'est pas valide. Bon format (dd/mm/yyyy)</div>
			</div>
		<?php } ?>
		</div>
	</div>
</div>
		<?php } ?>
</br>
<div class="col-lg-12">
        <a href="<?php echo get_site_url(); ?>/postuler/?etape=1&cand=<?php echo $candhash; ?>" class="btn btn-secondary"><i class="fa fa-mail-reply"></i> Précédent</a>
        <button type="submit" class="btn btn-warning"> Suivant</button>
		<?php if(lgchkpeda()){ ?>
		
			<br><a href="<?php echo get_site_url(); ?>/espace-pedagogique/" class="btn btn-default"><i class="fa fa-user"></i> Retour</a>
        
		
		<?php }else{ ?>
		
			<br><br> <a href="<?php echo get_site_url(); ?>/espace-eleve/" class="btn btn-primary"><i class="fa fa-user"></i> Retour</a>
		
		<?php } ?>
 </div>
</form>
