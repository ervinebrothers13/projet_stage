<?php
/**
 * Template Name: Voir candidature
 * Description: Pages Voir candidature
 */
 

 
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}
?>
<?php get_header("cust"); ?>

<section id="content" <?php Avada()->layout->add_style( 'content_style' ); ?>>
	
	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php echo fusion_render_rich_snippets_for_pages(); // phpcs:ignore WordPress.Security.EscapeOutput ?>

			<?php avada_singular_featured_image(); ?>

			<div class="post-content">
				<?php the_content(); ?>
				<?php fusion_link_pages(); ?>
			</div>
			<?php if ( ! post_password_required( $post->ID ) ) : ?>
				<?php do_action( 'avada_before_additional_page_content' ); ?>
				<?php if ( class_exists( 'WooCommerce' ) ) : ?>
					<?php $woo_thanks_page_id = get_option( 'woocommerce_thanks_page_id' ); ?>
					<?php $is_woo_thanks_page = ( ! get_option( 'woocommerce_thanks_page_id' ) ) ? false : is_page( get_option( 'woocommerce_thanks_page_id' ) ); ?>
					<?php if ( Avada()->settings->get( 'comments_pages' ) && ! is_cart() && ! is_checkout() && ! is_account_page() && ! $is_woo_thanks_page ) : ?>
						<?php comments_template(); ?>
					<?php endif; ?>
				<?php else : ?>
					<?php if ( Avada()->settings->get( 'comments_pages' ) ) : ?>
						<?php comments_template(); ?>
					<?php endif; ?>
				<?php endif; ?>
				<?php do_action( 'avada_after_additional_page_content' ); ?>
			<?php endif; // Password check. ?>
		</div>
	<?php endwhile; ?>
	
	
	<?php

		if(isset($_GET["cand"])){
			
			$candhash=$_GET["cand"];
			
			$cand_id=decryptIt($candhash,$_SESSION["hashsession"]);
			$tabcand=recData("candidature",$cand_id);
			$stage_id=$tabcand["stage_id"];
			$tabstage=recData("stage",$stage_id);
			$elv_id=$tabcand["elv_id"];
			$tabeleve=recData("eleve",$elv_id);
			
		
	?>
	
	<div class="row">
		<div class="col-md-12">
			<h3>Information sur le stage</h3>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<label for="domainedecouv">Domaine :</label>
			<p><?php echo ($tabstage["sect_lib"]); ?></p>
			<br>
		</div>
		<div class="col-md-6">
			<label for="mettredecouv">Métier à découvrir :</label>
			<p><?php echo ($tabstage["metier"]); ?></p>
			<br>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<label for="userprename">Informations sur le stage :</label>
			<p><?php echo ($tabstage["activity"]); ?></p>
			
		</div>
		<div class="col-md-6">
			<label for="datedecouv">Date disponible :</label>
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
			<br>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<label for="datedecouv">Déroulé de la semaine :</label>
							
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
	</div>
	<div class="row">
		<div class="col-md-12">
			<h3>Information sur l'élève</h3>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<label for="username">Nom :</label>
			<p><?php echo ($tabeleve["elv_nom"]); ?></p>
			<br>
		</div>
		<div class="col-md-6">
			<label for="userprename">prénom :</label>
			<p><?php echo ($tabeleve["elv_pren"]); ?></p>
			
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<label for="usertel">Téléphone :</label>
			<p><?php echo ($tabeleve["elv_tel"]); ?></p>
		
		</div>
		<div class="col-md-6">
			<label for="usermail">Email :</label>
			<p><?php echo ($tabeleve["elv_mail"]); ?></p>
			
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<label for="userdatenais">Date de naissance :</label>
			<p><?php echo fDate($tabeleve["elv_datenaiss"],"html"); ?></p>
			<br>
		</div>
		<div class="col-md-6">
			<label for="usergeo">Adresse géographique :</label>
			<p><?php echo ($tabeleve["elv_adr"]); ?></p>
			<br>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<label for="useretab">Etablissement Scolaire fréquenté :</label>
			<select id="useretab" class=" col-md-12" name="useretab" disabled>
				<?php echo(BLst('uai','uai_rne','uai_lc',$tabeleve["elv_uai"],"","","","",""));?>
			</select>
			<br>
		</div>
		<div class="col-md-6">
			<label for="userclass">Classe:</label>
			<p><?php echo ($tabeleve["elv_adr"]); ?></p>
			<br>
		</div>
	</div>

	<div class="row margintop20">
		<div class="col-md-12">
			<h3>Date du stage</h3>
			
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			
			<label for="username">Vos date de stage :</label>
			<?php
			
			if($tabstage["dispo"]=="1" or $tabstage["dispo"]=="3"){
			
			?>
			
			<div class="row">
			<div class="col-md-5">
				<div class="input-group date" id="ddebut">
					<input type="text" disabled class="form-control" value="<?php echo fDate($tabcand["date_deb"],"html"); ?>" />
					<span class="input-group-addon btn-primary smallradio padding5"><i class="fa fa-calendar"></i></span>
				</div>
			</div>
			<div class="col-md-2 smallradio">au</div>
			<div class="col-md-5">
				<div class="input-group date" id="ddfin">
					<input type="text" disabled class="form-control" value="<?php echo fDate($tabcand["date_fin"],"html"); ?>" />
					<span class="input-group-addon btn-primary smallradio padding5"><i class="fa fa-calendar"></i></span>
				</div>
			</div>
			</div>
			
			<?php }else{ ?>
			<div class="row">
				<div class="col-md-6">
					<label for="useretab">Semaine spécifique:</label>
					<?php
					
					

						
						
						echo "<ul class='nopadding showdatedispo'>";
						$weeks=getWeek();

						foreach($weeks as $value){
							
							$tabdate1=explode("/",$value[1]);
							$tabdate2=explode("/",$value[2]);
							
							$mois1=getmois($tabdate1[1]);
							$mois2=getmois($tabdate2[1]);
							
							
							
							
							if($value[0]==$tabcand["semaine"]){
								
								if($mois1==$mois2){
								
									echo "<li>Du ".$tabdate1[0]." au ".$tabdate2[0]." ".$mois1." ".$tabdate1[2]."</li>";
							
								}else{
								
									echo "<li>Du ".$tabdate1[0]." ".$mois1." au ".$tabdate2[0]." ".$mois2." ".$tabdate1[2]."</li>";												
									
								}
								
								
							}
								
						}
				
						echo "</ul>";
						
					?>
					
					<br>
				</div>
			</div>
			<?php } ?>
			<br>
		</div>
	</div>

	<div class="row margintop10">
		<div class="col-md-12">
			<h3>Votre curriculum vitae</h3>
		</div>
		<div class="col-md-6">
			
			<label for="userexp">Expériences professionnels précédentes (Facultatif) :</label>
			<p><?php echo ($tabcand["cand_cv"]); ?></p>
			<br>
		</div>
		
		<div class="col-md-6">
			<label for="useractivite">Activités extra-scolaires (Facultatif) :<i>Sports, loisirs, engagements associatifs, etc.</i></label>
			<p><?php echo ($tabcand["cand_activite"]); ?></p>
			<br>
		</div>
		
		<div class="col-md-6">
			<label for="userlangue">Langues vivantes :<i>Langues étudiées et/ou parlées</i></label>
			<p><?php echo ($tabcand["cand_lang"]); ?></p>
			<br>
		</div>
		<div class="col-md-6">
		<?php

				if ($tabeleve["elv_cvpdf"] != "" and $tabeleve["elv_cvpdf"] != null) {

					?>
					<label for="usermotivation">Mon cv papier :</label>
					<p><a target=_blank href="<?php echo get_site_url(); ?>/wp-content/uploads/cvpdf/<?php echo $tabeleve["elv_cvpdf"]; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/pdf.png" width="50" height="50"/></a></p>
						
					<?php

				}

				?>
	</div>
		
	</div>
	<div class="row margintop10">
		<div class="col-md-12">
			<h3>Votre motivation</h3>
		</div>
		<div class="col-md-6">
			
			<label for="usermotivation">Pourquoi ce stage me motive :</label>
			<p><?php echo ($tabcand["cand_motiv"]); ?></p>
			
		</div>
		
		
	</div><br><br>

    
	<?php }

	
	?>
	
</section>



<?php do_action( 'avada_after_content' ); ?>
<?php get_footer(); ?>