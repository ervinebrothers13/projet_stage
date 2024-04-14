<?php

if(isset($_GET["stage"])){
	
?>

<div id="addoffer">
<div class="step">Etape 5 sur 5</div>
<div class="steplib">Valider le récapitulatif de l'offre</div>
<div class="fr-stepper__steps" data-fr-current-step="5" data-fr-steps="5"></div>

</br></br>
<form id="addstage1-form" method="POST" action="<?php echo get_template_directory_uri(); ?>/actiondev2.php?act=addstage5">
<input type="hidden" name="stageid" value="<?php echo $_GET["stage"]; ?>" />
<h3>Récapitulatif de l'offre</h3>
</hr>

<div class="row" id="deposeoffreid">
	<div class="col-md-8" >
	
						<h3><?php echo ($tabstage["sect_lib"]); ?></h3>
						<h1><?php echo ($tabstage["metier"]); ?></h1>
						<hr>
						<h2>Informations sur le stage</h2>
						<p><?php echo ($tabstage["activity"]); ?></p>
						<h2>Déroulé de la semaine</h2>
						
						<?php if($tabstage["typ_horaire"]=="1"){ ?>
						
						<p>Horaire : <?php echo $tabstage["typ_horaire_opt1_h1"]; ?> à <?php echo $tabstage["typ_horaire_opt1_h2"]; ?></p>
						
						<?php }else{ ?>
						
						<p>Horaire : </p>
						<ul>
							<?php $tabstage_horaire1=recData("stage_horaire1",$stage_id); ?>
							<?php if($tabstage_horaire1["heure1"]!=null and $tabstage_horaire1["heure2"]!=null){ ?><li>Lundi : <?php echo $tabstage_horaire1["heure1"]; ?> à <?php echo $tabstage_horaire1["heure2"]; ?></li><?php } ?>
							<?php $tabstage_horaire2=recData("stage_horaire2",$stage_id); ?>
							<?php if($tabstage_horaire2["heure1"]!=null and $tabstage_horaire2["heure2"]!=null){ ?><li>Mardi : <?php echo $tabstage_horaire2["heure1"]; ?> à <?php echo $tabstage_horaire2["heure2"]; ?></li><?php } ?>
							<?php $tabstage_horaire3=recData("stage_horaire3",$stage_id); ?>
							<?php if($tabstage_horaire3["heure1"]!=null and $tabstage_horaire3["heure2"]!=null){ ?><li>Mercredi : <?php echo $tabstage_horaire3["heure1"]; ?> à <?php echo $tabstage_horaire3["heure2"]; ?></li><?php } ?>
							<?php $tabstage_horaire4=recData("stage_horaire4",$stage_id); ?>
							<?php if($tabstage_horaire4["heure1"]!=null and $tabstage_horaire4["heure2"]!=null){ ?><li>Jeudi : <?php echo $tabstage_horaire4["heure1"]; ?> à <?php echo $tabstage_horaire4["heure2"]; ?></li><?php } ?>
							<?php $tabstage_horaire5=recData("stage_horaire5",$stage_id); ?>
							<?php if($tabstage_horaire5["heure1"]!=null and $tabstage_horaire5["heure2"]!=null){ ?><li>Vendredi : <?php echo $tabstage_horaire5["heure1"]; ?> à <?php echo $tabstage_horaire5["heure2"]; ?></li><?php } ?>
							<?php $tabstage_horaire6=recData("stage_horaire6",$stage_id); ?>
							<?php if($tabstage_horaire6["heure1"]!=null and $tabstage_horaire6["heure2"]!=null){ ?><li>Samedi : <?php echo $tabstage_horaire6["heure1"]; ?> à <?php echo $tabstage_horaire6["heure2"]; ?></li><?php } ?>
						
						<?php } ?>
						
						<p>Pause déjeuner : <?php echo $tabstage["pause_dej_h1"]; ?> à <?php echo $tabstage["pause_dej_h2"]; ?></p>
	
	
	
	</div>
	<div class="col-md-4 articledescaside" >
					
						<ul class="categorielist">
							<li class="cateitemli">
							<?php if($tabstage["typ_nb"]=="1"){ ?>
								<span class="cateitem"><div class="cateitemleft"><img src="<?php echo get_template_directory_uri(); ?>/images/categorie/user.svg" /></div><div class="cateitemright">Stage individuel</div></span>
							<?php }else{ ?>
								<span class="cateitem"><div class="cateitemleft"><img src="<?php echo get_template_directory_uri(); ?>/images/categorie/user.svg" /></div><div class="cateitemright">Stage collectif (<?php echo $tabstage["typ_nb_opt2"]; ?> élève(s) max)</div></span>
							<?php }?>
							</li>
							<li class="cateitemli">
								<span class="cateitem"><div class="cateitemleft"><img src="<?php echo get_template_directory_uri(); ?>/images/categorie/check.svg" /></div><div class="cateitemright"><?php echo $tabstage["nb_elv_an"]; ?> places</div></span>
							</li>
						</ul>
						<hr>
						<ul class="categorielist">
								<li class="cateitemli">
									<span  class="cateitem"><div class="cateitemleft"><img src="<?php echo get_template_directory_uri(); ?>/images/categorie/buisness.svg" /></div><div class="cateitemright">
									<?php
									
									switch($tabstage["dispo"]){
										
										case "1":
										
											echo "Disponible toute l'année";
										
										break;
										case "2":
											$tabsem=array();
											$lststage_sem=lstData("stage_sem",$stage_id);
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
													
														echo "<li>du ".$tabdate1[0]." au ".$tabdate2[0]." ".$mois1." ".$tabdate1[2]."</li>";
												
													}else{
													
														echo "<li>du ".$tabdate1[0]." ".$mois1." au ".$tabdate2[0]." ".$mois2." ".$tabdate1[2]."</li>";												
														
													}
													
													
												}
													
											}
									
											echo "</ul>";
											
											
										break;
										case "3":
											
											$date1=fDate($tabstage["dispo_opt3_d1"],"html");
											$date2=fDate($tabstage["dispo_opt3_d2"],"html");
											
											$tabdate1=explode("/",$date1);
											$tabdate2=explode("/",$date2);
											
											$mois1=getmois($tabdate1[1]);
											$mois2=getmois($tabdate2[1]);
											
											
											if($tabdate1[2]==$tabdate2[2]){
												
												if($mois1==$mois2){
													
													echo "Disponible du ".$tabdate1[0]." au ".$tabdate2[0]." ".$mois1." ".$tabdate1[2];
												
												}else{
												
													echo "Disponible du ".$tabdate1[0]." ".$mois1." au ".$tabdate2[0]." ".$mois2." ".$tabdate1[2];												
													
												}
												
											}else{
												
												echo "Disponible du ".$tabdate1[0]." ".$mois1." ".$tabdate1[2]."  au ".$tabdate2[0]." ".$mois2." ".$tabdate2[2];												
												
											}
											
										break;
										
										
									}
									?>
									
									
									</div></span>
								</li>
							</ul>
						<hr>
							<ul class="categorielist">
								<li class="cateitemli">
									<span class="cateitem"><div class="cateitemleft"><img src="<?php echo get_template_directory_uri(); ?>/images/categorie/googlemap.svg" /></div><div class="cateitemright"><?php if($tabstage["stage_com"]!=null and $tabstage["stage_com"]!=""){ ?><?php echo $tabstage["Ile"]; ?>, <?php echo $tabstage["Geo"]; ?><?php } ?><?php if($tabstage["stage_adr"]!=null and $tabstage["stage_adr"]!=""){ ?>, <?php echo $tabstage["stage_adr"]; ?><?php } ?><?php if($tabstage["stage_pk"]!=null and $tabstage["stage_pk"]!=""){ ?> , PK<?php echo $tabstage["stage_pk"]; ?><?php } ?></div></span>
								</li>
							</ul>
							<?php 
										
								$lststage_uai=lstData("stage_uai",$tabstage["stage_id"]); 
							
								if(sizeof($lststage_uai)>0){
								
							?>
											
							<ul class="categorielist">
								<li class="cateitemli">
									
									<span class="cateitem">
									
									<div class="cateitemleft"><img src="<?php echo get_template_directory_uri(); ?>/images/categorie/etablissement.png" /></div>
									<div class="cateitemright">
									
									<ul class="etablimited">
									<?php foreach($lststage_uai as $uai){ ?>
									
										<li><?php echo $uai["uai_lc"]; ?></li>
									
									<?php } ?>
									</ul>
									</div>
									</div>
									</span>
									
								</li>
							</ul>
						<?php } ?>
					</div>
</div>

<div class="col-lg-12">
        <a href="<?php echo get_site_url(); ?>/deposer-une-offre/?etape=4&stage=<?php echo $_GET["stage"]; ?>" class="btn btn-secondary"><i class="fa fa-mail-reply"></i> Précédent</a>
       <a href="#deldata" class="btn btn-danger" role="button" data-toggle="modal" data-id="<?php echo $_GET["stage"]; ?>" data-typ="supprimerstage" onClick="aChpDel(this)" title="suppression"><i class="fa fa-trash-o"></i>Supprimer l'offre</a>
        <button type="submit" class="btn btn-success"> Publier</button><br><br>
		<br><br> <a href="<?php echo get_site_url(); ?>/espace-entreprise/" class="btn btn-primary"><i class="fa fa-user"></i> Retour</a>
 </div>
</form>
<?php

}

?>