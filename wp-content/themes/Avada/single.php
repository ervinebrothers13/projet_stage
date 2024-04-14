<?php
/**
 * Template used for single posts and other post-types
 * that don't have a specific template.
 *
 * @package Avada
 * @subpackage Templates
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}
?>

	
	<?php
	
		if(isset($_GET["offre3eme"])){
			
			$stage_id=decryptIt($_GET["offre3eme"],$_SESSION["hashsession"]);
			
			
			$tabstage=recData("stage",$stage_id);
			
			?>
			<?php get_header("offre"); ?>
			<section id="contentoffre" >
			
			<div id="articledesc">
			
				<div class="row">
					<div class="col-md-12" >
						<a class="colorblue" href="<?php echo get_site_url(); ?>/liste-des-stages-3eme/">Retour à la liste des offres de 3ème</a>
					</div>
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
						
						<?php
						
						if(lgchkpeda()){
						
						?>
						
						<a href="#postulerelv" class="bouttonconnex" role="button" data-toggle="modal" data-id="<?php echo $_GET["offre3eme"]; ?>" onClick="postulerelv(this)" title="postulerelv"><i class="fa fa-pencil" aria-hidden="true"></i> Postuler pour un élève</a>
						
						<?php
						
						}else{
							
						?>
						
						<a href="<?php echo get_site_url(); ?>/postuler/?stage=<?php echo $_GET["offre3eme"]; ?>" class="bouttonconnex" ><i class="fa fa-pencil" aria-hidden="true"></i> Postuler</a>
						
						<?php } ?>
						
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
			
			</div>
			</section>
			<?php get_footer("offre"); ?>
			<?php
		}else if(isset($_GET["pfmp"])){
			
			$stage_id=decryptIt($_GET["pfmp"],$_SESSION["hashsession"]);
			
			
			$tabstage=recData("stage",$stage_id);
			?>
			<?php get_header("offre"); ?>
			<section id="contentoffre" >

			
			<div id="articledescpfmp">
				<div class="col-md-12" >
					<a class="colorblue" href="<?php echo get_site_url(); ?>/liste-des-pfmp/?typ=<?php echo $tabstage["dom_id"]; ?>">Retour à la liste des offres PFMP</a>
				</div>
					
				<h1 class="domaine domaine<?php echo $tabstage["dom_id"]; ?>">Consulte les détails de l’offre pour être sûre qu’elle te corresponde et prends contact avec l’entreprise</h1>
				<div class="row">
					<div class="col-md-12 partie1 row domaine domaine<?php echo $tabstage["dom_id"]; ?>" >
						
						<div class="col-md-5" >
							<h3><?php echo ($tabstage["metier"]); ?></h3>
							<p>Référence de l'Offre : <?php echo ($tabstage["reference"]); ?><p>
							<p>Dates disponibles :

	<?php
												
												switch($tabstage["dispo"]){
													
													case "1":
													
														echo "Disponible toute l'année";
													
													break;
													case "2":
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
																
																echo "Du ".$tabdate1[0]." au ".$tabdate2[0]." ".$mois1." ".$tabdate1[2];
															
															}else{
															
																echo "Du ".$tabdate1[0]." ".$mois1." au ".$tabdate2[0]." ".$mois2." ".$tabdate1[2];												
																
															}
															
														}else{
															
															echo "Du ".$tabdate1[0]." ".$mois1." ".$tabdate1[2]."  au ".$tabdate2[0]." ".$mois2." ".$tabdate2[2];												
															
														}
														
													break;
													
													
												}
												?>
												
							</p>
						</div>
						<div class="col-md-7" >
							
							<?php 
										
								$lststage_uai=lstData("stage_uai",$tabstage["stage_id"]); 
							
								if(sizeof($lststage_uai)>0){
								
							?>
											
							
									<p>Ce stage est réservé au établissements suivants :</p>
									<ul class="etablimited">
									<?php foreach($lststage_uai as $uai){ ?>
									
										<li><?php echo $uai["uai_lc"]; ?></li>
									
									<?php } ?>
									</ul>
									
							<?php } ?>
						
						</div>

					</div>
					<div class="col-md-12 partie2 row domaine domaine<?php echo $tabstage["dom_id"]; ?>" >
						
						<div class="col-md-3" >
							<?php
						
							$image=get_template_directory_uri()."/images/domaine/".$tabstage["dom_id"].".png";
							if($tabstage["ent_logo"]!=null and file_exists($_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/logo/'.$tabstage["ent_logo"]))$image=get_site_url()."/wp-content/uploads/logo/".$tabstage["ent_logo"];
						
						?>
							<img class="fr-responsive-img" src="<?php echo $image; ?>" alt="secteur" data-fr-js-ratio="true">
						
						</div>
						<div class="col-md-5" >
							<h3>Description du Poste</h3>
							<p><?php echo ($tabstage["activity"]); ?></p>
						</div>
						<div class="col-md-4" >
								<h4><?php echo $tabstage["ent_nom"]; ?></h4>
								<label for="usernom">Nom du Responsable : <?php echo $tabstage["stage_contact"]; ?></label></br>
								<label for="usertel">Numéro de Téléphone : <?php echo $tabstage["stage_tel"]; ?></label></br>
								<label for="useremail">Adresse Mail : <?php echo $tabstage["ent_mail"]; ?></label></br>
								<label for="useremail">Adresse géographique : <?php if($tabstage["stage_com"]!=null and $tabstage["stage_com"]!=""){ ?><?php echo $tabstage["Ile"]; ?>, <?php echo $tabstage["Geo"]; ?><?php } ?><?php if($tabstage["stage_adr"]!=null and $tabstage["stage_adr"]!=""){ ?>, <?php echo $tabstage["stage_adr"]; ?><?php } ?><?php if($tabstage["stage_pk"]!=null and $tabstage["stage_pk"]!=""){ ?> , PK<?php echo $tabstage["stage_pk"]; ?><?php } ?></label></br></br>
								
								<?php
						
								if(lgchkpeda()){
								
								?>
								
								<a href="#postulerelv" class="bouttonconnex" role="button" data-toggle="modal" data-id="<?php echo $_GET["pfmp"]; ?>" onClick="postulerelv(this)" title="postulerelv"><i class="fa fa-pencil" aria-hidden="true"></i> Postuler pour un élève</a>
								
								<?php
								
								}else{
									
								?>
								
								<a href="<?php echo get_site_url(); ?>/postuler/?stage=<?php echo $_GET["pfmp"]; ?>" class="bouttonconnex" ><i class="fa fa-pencil" aria-hidden="true"></i> Postuler</a>
								
								<?php } ?>
						
								
						
							</div>
					</div>
					<div class="col-md-12 partie3 domaine domaine<?php echo $tabstage["dom_id"]; ?>" >
						<?php
						
						$lundimatin="";$lundipause="";$lundiaprem="";
						$mardimatin="";$mardipause="";$mardiaprem="";
						$mercredimatin="";$mercredipause="";$mercrediaprem="";
						$jeudimatin="";$jeudipause="";$jeudiaprem="";
						$vendredimatin="";$vendredipause="";$vendrediaprem="";
						$samedimatin="";$samedipause="";$samediaprem="";
						
						
						if($tabstage["typ_horaire"]=="1"){
							
							$lundimatin=$tabstage["typ_horaire_opt1_h1"];$lundipause=$tabstage["pause_dej_h1"]."-".$tabstage["pause_dej_h2"];$lundiaprem=$tabstage["typ_horaire_opt1_h2"];
							$mardimatin=$tabstage["typ_horaire_opt1_h1"];$mardipause=$tabstage["pause_dej_h1"]."-".$tabstage["pause_dej_h2"];$mardiaprem=$tabstage["typ_horaire_opt1_h2"];
							$mercredimatin=$tabstage["typ_horaire_opt1_h1"];$mercredipause=$tabstage["pause_dej_h1"]."-".$tabstage["pause_dej_h2"];$mercrediaprem=$tabstage["typ_horaire_opt1_h2"];
							$jeudimatin=$tabstage["typ_horaire_opt1_h1"];$jeudipause=$tabstage["pause_dej_h1"]."-".$tabstage["pause_dej_h2"];$jeudiaprem=$tabstage["typ_horaire_opt1_h2"];
							$vendredimatin=$tabstage["typ_horaire_opt1_h1"];$vendredipause=$tabstage["pause_dej_h1"]."-".$tabstage["pause_dej_h2"];$vendrediaprem=$tabstage["typ_horaire_opt1_h2"];
							

						}else{
							
							$tabstage_horaire1=recData("stage_horaire1",$stage_id);
							if($tabstage_horaire1["heure1"]!=null)$lundimatin=$tabstage_horaire1["heure1"];
							$lundipause=$tabstage["pause_dej_h1"]."-".$tabstage["pause_dej_h2"];
							if($tabstage_horaire1["heure2"]!=null)$lundiaprem=$tabstage_horaire1["heure2"];
							
							$tabstage_horaire2=recData("stage_horaire2",$stage_id);
							if($tabstage_horaire2["heure1"]!=null)$mardimatin=$tabstage_horaire2["heure1"];
							$mardipause=$tabstage["pause_dej_h1"]."-".$tabstage["pause_dej_h2"];
							if($tabstage_horaire2["heure2"]!=null)$mardiaprem=$tabstage_horaire2["heure2"];
							
							$tabstage_horaire3=recData("stage_horaire3",$stage_id);
							if($tabstage_horaire3["heure1"]!=null)$mercredimatin=$tabstage_horaire3["heure1"];
							$mercredipause=$tabstage["pause_dej_h1"]."-".$tabstage["pause_dej_h2"];
							if($tabstage_horaire3["heure2"]!=null)$mercrediaprem=$tabstage_horaire3["heure2"];
							
							$tabstage_horaire4=recData("stage_horaire4",$stage_id);
							if($tabstage_horaire4["heure1"]!=null)$jeudimatin=$tabstage_horaire4["heure1"];
							$jeudipause=$tabstage["pause_dej_h1"]."-".$tabstage["pause_dej_h2"];
							if($tabstage_horaire4["heure2"]!=null)$jeudiaprem=$tabstage_horaire4["heure2"];
							
							$tabstage_horaire5=recData("stage_horaire5",$stage_id);
							if($tabstage_horaire5["heure1"]!=null)$vendredimatin=$tabstage_horaire5["heure1"];
							$vendredipause=$tabstage["pause_dej_h1"]."-".$tabstage["pause_dej_h2"];
							if($tabstage_horaire5["heure2"]!=null)$vendrediaprem=$tabstage_horaire5["heure2"];
							
							$tabstage_horaire6=recData("stage_horaire6",$stage_id);
							if($tabstage_horaire6["heure1"]!=null)$samedimatin=$tabstage_horaire6["heure1"];
							$samedipause=$tabstage["pause_dej_h1"]."-".$tabstage["pause_dej_h2"];
							if($tabstage_horaire6["heure2"]!=null)$samediaprem=$tabstage_horaire6["heure2"];
							
						}
						
						
						?>
						
						<h3>Emploi du temps</h3>
						<table border=1 >
							<tbody>
								<tr><td class="firsttd-domaine<?php echo $tabstage["dom_id"]; ?>">Heures/Jours</td><td>Lundi</td><td>Mardi</td><td>Mercredi</td><td>Jeudi</td><td>Vendredi</td><td>Samedi</td></tr>
								<tr><td class="firsttd-domaine<?php echo $tabstage["dom_id"]; ?>">Matin</td><td><?php echo $lundimatin; ?></td><td><?php echo $mardimatin; ?></td><td><?php echo $mercredimatin; ?></td><td><?php echo $jeudimatin; ?></td><td><?php echo $vendredimatin; ?></td><td><?php echo $samedimatin; ?></td></tr>
								<tr><td class="firsttd-domaine<?php echo $tabstage["dom_id"]; ?>">Pause</td><td><?php echo $lundipause; ?></td><td><?php echo $mardipause; ?></td><td><?php echo $mercredipause; ?></td><td><?php echo $jeudipause; ?></td><td><?php echo $vendredipause; ?></td><td><?php echo $samedipause; ?></td></tr>
								<tr><td class="firsttd-domaine<?php echo $tabstage["dom_id"]; ?>">Après-Midi</td><td><?php echo $lundipause; ?></td><td><?php echo $mardiaprem; ?></td><td><?php echo $mercrediaprem; ?></td><td><?php echo $jeudiaprem; ?></td><td><?php echo $vendrediaprem; ?></td><td><?php echo $samediaprem; ?></td></tr>
							</tbody>
						</table>

					</div>
					
				</div>
			
			</div>
			</section>
			<?php get_footer("offre"); ?>
			<?php
		}else if(isset($_GET["offrebts"])){
			
			$stage_id=decryptIt($_GET["offrebts"],$_SESSION["hashsession"]);
			
			
			$tabstage=recData("stage",$stage_id);
			
			?>
			<?php get_header("offre"); ?>
			<section id="contentoffre" >

			<div id="articledesc">
			
				<div class="row">
					<div class="col-md-12" >
						<a class="colorblue" href="<?php echo get_site_url(); ?>/liste-des-stages-de-bts/">Retour à la liste des offres de BTS</a>
					</div>
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
						
						<?php
						
						if(lgchkpeda()){
						
						?>
						
						<a href="#postulerelv" class="bouttonconnex" role="button" data-toggle="modal" data-id="<?php echo $_GET["offrebts"]; ?>" onClick="postulerelv(this)" title="postulerelv"><i class="fa fa-pencil" aria-hidden="true"></i> Postuler pour un élève</a>
						
						<?php
						
						}else{
							
						?>
						
						<a href="<?php echo get_site_url(); ?>/postuler/?stage=<?php echo $_GET["offrebts"]; ?>" class="bouttonconnex" ><i class="fa fa-pencil" aria-hidden="true"></i> Postuler</a>
						
						<?php } ?>
						
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
			
			</div>
			</section>
			<?php get_footer("offre"); ?>
			<?php
		}else{
	
	?>
	<?php get_header(); ?>
	<section id="content" <?php Avada()->layout->add_style( 'content_style' ); ?>>


		<?php if ( fusion_get_option( 'blog_pn_nav' ) ) : ?>
		<div class="single-navigation clearfix">
			<?php previous_post_link( '%link', esc_attr__( 'Previous', 'Avada' ) ); ?>
			<?php next_post_link( '%link', esc_attr__( 'Next', 'Avada' ) ); ?>
		</div>
	<?php endif; ?>
	
	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'post' ); ?>>
			<?php $full_image = ''; ?>
			<?php if ( 'above' === Avada()->settings->get( 'blog_post_title' ) ) : ?>
				<?php if ( 'below_title' === Avada()->settings->get( 'blog_post_meta_position' ) ) : ?>
					<div class="fusion-post-title-meta-wrap">
				<?php endif; ?>
				<?php $title_size = ( false === avada_is_page_title_bar_enabled( $post->ID ) ? '1' : '2' ); ?>
				<?php echo avada_render_post_title( $post->ID, false, '', $title_size ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				<?php if ( 'below_title' === Avada()->settings->get( 'blog_post_meta_position' ) ) : ?>
					<?php echo avada_render_post_metadata( 'single' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
					</div>
				<?php endif; ?>
			<?php elseif ( 'disabled' === Avada()->settings->get( 'blog_post_title' ) && Avada()->settings->get( 'disable_date_rich_snippet_pages' ) && Avada()->settings->get( 'disable_rich_snippet_title' ) ) : ?>
				<span class="entry-title" ><h1><?php the_title(); ?></h1></span>
			<?php endif; ?>

			<?php avada_singular_featured_image(); ?>

			<?php if ( 'below' === Avada()->settings->get( 'blog_post_title' ) ) : ?>
				<?php if ( 'below_title' === Avada()->settings->get( 'blog_post_meta_position' ) ) : ?>
					<div class="fusion-post-title-meta-wrap">
				<?php endif; ?>
				<?php $title_size = ( false === avada_is_page_title_bar_enabled( $post->ID ) ? '1' : '2' ); ?>
				<?php echo avada_render_post_title( $post->ID, false, '', $title_size ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				<?php if ( 'below_title' === Avada()->settings->get( 'blog_post_meta_position' ) ) : ?>
					<?php echo avada_render_post_metadata( 'single' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
					</div>
				<?php endif; ?>
			<?php endif; ?>
			<div class="post-content">
				<?php the_content(); ?>
				<?php fusion_link_pages(); ?>
				
				
				<?php $lien_vers_fichier = get_field( 'lien_vers_fichier' ); ?>
				
				<?php if($lien_vers_fichier!=""){ ?>
					<a href="<?php echo $lien_vers_fichier; ?>"  target=_blank >Voir le fichier</a>
				<?php } ?>
			</div>

			<?php if ( ! post_password_required( $post->ID ) ) : ?>
				<?php if ( '' === Avada()->settings->get( 'blog_post_meta_position' ) || 'below_article' === Avada()->settings->get( 'blog_post_meta_position' ) || 'disabled' === Avada()->settings->get( 'blog_post_title' ) ) : ?>
					<?php echo avada_render_post_metadata( 'single' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				<?php endif; ?>
				<?php do_action( 'avada_before_additional_post_content' ); ?>
				<?php avada_render_social_sharing(); ?>
				<?php $author_info = fusion_get_page_option( 'author_info', $post->ID ); ?>
				<?php if ( ( Avada()->settings->get( 'author_info' ) && 'no' !== $author_info ) || ( ! Avada()->settings->get( 'author_info' ) && 'yes' === $author_info ) ) : ?>
					<section class="about-author">
						<?php ob_start(); ?>
						<?php the_author_posts_link(); ?>
						<?php /* translators: The link. */ ?>
						<?php $title = sprintf( __( 'About the Author: %s', 'Avada' ), ob_get_clean() ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride ?>
						<?php $title_size = ( false === avada_is_page_title_bar_enabled( $post->ID ) ? '2' : '3' ); ?>
						<?php Avada()->template->title_template( $title, $title_size ); ?>
						<div class="about-author-container">
							<div class="avatar">
								<?php echo get_avatar( get_the_author_meta( 'email' ), '72' ); ?>
							</div>
							<div class="description">
								<?php the_author_meta( 'description' ); ?>
							</div>
						</div>
					</section>
				<?php endif; ?>
				<?php avada_render_related_posts( get_post_type() ); // Render Related Posts. ?>

				<?php $post_comments = fusion_get_page_option( 'blog_comments', $post->ID ); ?>
				<?php if ( ( Avada()->settings->get( 'blog_comments' ) && 'no' !== $post_comments ) || ( ! Avada()->settings->get( 'blog_comments' ) && 'yes' === $post_comments ) ) : ?>
					<?php comments_template(); ?>
				<?php endif; ?>
				<?php do_action( 'avada_after_additional_post_content' ); ?>
			<?php endif; ?>
		</article>
	<?php endwhile; ?>
	</section>
	<?php do_action( 'avada_after_content' ); ?>
<?php get_footer(); ?>
		<?php } ?>


<?php include("modal.php"); ?>