<?php
/**
 * Template Name: offre stage bts
 * Description: Pages offre stage bts
 */
 

 
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}


	
?>
<?php get_header("cust"); ?>

<?php



if(!isset($_SESSION['filterbts']))$_SESSION['filterbts']='-1';

$tabfilte=explode(",",$_SESSION['filterbts']);

?>


  
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
	
	$page=1;
	$offset=0;
	$limit=12;
	
	if(isset($_GET["pg"]))$page=$_GET["pg"];
	else  $page=1;
		
	$offset=($page-1)*$limit;
	
	
	
	
	
	$lstoffrebtssize=recData("lstoffrebtssize",$_SESSION['filterbts']);
	
	$lstoffrebts=lstData("alllststagebts",array($_SESSION['filterbts'],$offset,$limit));
	
	$nbpage=floor($lstoffrebtssize["NB"]/$limit);
	
	?>
	
	<div id="offrecontent" class="offrecontentclass">
		<div class="topcontent">
			
					<div class="title"><?php echo $lstoffrebtssize["NB"]; ?> offres de stage</div>
				
					<div class="filtre" onclick="openfilter()"><img src="<?php echo get_template_directory_uri(); ?>/images/categorie/equalizer.svg" /> Filtrer</div>
				
		</div>
		
		<div class="row listarticlecontent">
		
		<?php 
		
			foreach($lstoffrebts as $offre){
				
			$stageid=encryptIt($offre["stage_id"],$_SESSION["hashsession"]);
		
		?>
			<div class="articlecontent" >
				<article>
					<div class="article_body">
						
							<div class="article_body_content">
								<h4 class="body_title">
									<a href="<?php echo get_site_url(); ?>/offre-stage/?offrebts=<?php echo $stageid; ?>" ><?php echo $offre["metier"]; ?></a>
								</h4>
								<div  class="body_detail">
									<span class="body_detail_name"><?php echo $offre["ent_nom"]; ?></span>
									<?php
									
										if($offre["confirm"]=="1"){
											
											echo '<span class="confirmed">Vérifié</span>';
											
											
										}
									
									?>
								</div>
								<div  class="body_desc">
									<p class="body_lieu"><?php if($offre["stage_com"]!=null and $offre["stage_com"]!=""){ ?><?php echo $offre["Ile"]; ?>, <?php echo $offre["Geo"]; ?><?php } ?><?php if($offre["stage_adr"]!=null and $offre["stage_adr"]!=""){ ?>, <?php echo $offre["stage_adr"]; ?><?php } ?><?php if($offre["stage_pk"]!=null and $offre["stage_pk"]!=""){ ?> , PK<?php echo $offre["stage_pk"]; ?><?php } ?></p>
									<div class="body_date">
									<?php
									
									switch($offre["dispo"]){
										
										case "1":
										
											echo "Disponible toute l'année";
										
										break;
										case "2":
											$tabsem=array();
											$lststage_sem=lstData("stage_sem",$offre["stage_id"]);
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
											
											$date1=fDate($offre["dispo_opt3_d1"],"html");
											$date2=fDate($offre["dispo_opt3_d2"],"html");
											
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
									
									</div>
									
									
										<?php 
										
										$lststage_uai=lstData("stage_uai",$offre["stage_id"]); 
										
										if(sizeof($lststage_uai)>0){
											
											?>
											
											<div class="body_etab">
												
												Limité à certaines établissements
												
											</div>
											
										<?php
										
										}
										
										?>
									
								</div>
							</div>
					
					</div>
					<div  class="article_header">
						<div>
							<?php
								$image=get_template_directory_uri()."/images/categorie/".$offre["dom_id"].".png";
								
								if(!file_exists($_SERVER['DOCUMENT_ROOT'].'/monstage/wp-content/themes/Avada/images/categorie/'.$offre["dom_id"].'.svg'))$image=get_template_directory_uri()."/images/categorie/default_sector.svg";
								
								
							?>
							<a href="<?php echo get_site_url(); ?>/offre-stage/?offrebts=<?php echo $stageid; ?>" ><img class="fr-responsive-img" src="<?php echo $image; ?>" alt="secteur" data-fr-js-ratio="true"></a>
						</div>
						<ul class="categorielist">
							<li class="cateitemli">
								<a href="<?php echo get_site_url(); ?>/offre-stage/?offrebts=<?php echo $stageid; ?>" ><div class="cateitem"><?php echo ($offre["sect_lib"]); ?></div></a>
							</li>
						</ul>
					</div>
					
				</article>
			</div>
			
			<?php } ?>
			
			
			
			<div class="col-sm-12" >
				
				<div id="pagination">
					<?php
					
						if($page>1){
					
					?>
				  <a class="page prev" href="<?php echo get_site_url(); ?>/liste-des-stages-bts/?pg=<?php echo ($page-1); ?>">Previous</a>
					<?php
					
						}
						
						?>
					<?php 
					
					$pagefirst=$page-3;
					$pagelast=$page+3;
					
					$good=1;
					
					for($i=1;$i<=$nbpage;$i++){
						
						
						if(($i>$pagefirst and $i<$pagelast) or ($i>($nbpage-1)) or ($i<2)){
							
							$good=1;
							
							$active="";if($i==$page)$active="active";

						?>
					
					
						<a class="page <?php echo $active; ?>" href="<?php echo get_site_url(); ?>/liste-des-stages-bts/?pg=<?php echo $i; ?>"><?php echo $i; ?></a>
					
						<?php 
					 
						}else{ 
					 
							if($good==1){
								
								$good=0;
						 ?>

							<a class="page">...</a>

						 <?php 
						 
							}
					 
						} 
					 
					 ?>
				  <?php } ?>
				 <?php
					
						if($page<$lstoffrebtssize["NB"] and $lstoffrebtssize["NB"]>$limit){
					
					?>
				  <a class="page next" href="<?php echo get_site_url(); ?>/liste-des-stages-bts/?pg=<?php echo ($page+1); ?>">Next</a>
				  <?php
					
						}
						
						?>
				</div>
							
			</div>
		</div>
			
	</div>
		
	
	
</section>




<?php do_action( 'avada_after_content' ); ?>
<?php get_footer(); ?>
<div id="fondgris">
	<div id="filterdiv">
		<div class="top_filter">
			<div>Tous les filtres</div>
			<div class="closefilter" onclick="closefilter()">Fermer <i class="fa fa-times" aria-hidden="true"></i></div>
		</div>
		<h1>Secteurs d'activité</h1>
		<div class="middle_filter">
			
			<div id="listfilter" class="row">
			
				<?php
				
				$lstsecteur=lstData("lstsecteur3");
				foreach($lstsecteur as $secteur){
				
				?>				
					
					<span class="filteritem col-md-4"><input type="checkbox" class="filteritemcheck" name="cate1" value="<?php echo $secteur["sect_id"]; ?>" <?php if(in_array($secteur["sect_id"],$tabfilte)){ echo "checked"; } ?> /><span class="filteritemlib"><?php echo ($secteur["sect_lib"]); ?></span></span>
					
				<?php
				
				}
				
				?>
				
				
				
			</div>
		</div>
		<div class="bottom_filter">
			<span class="removefilter" onclick="removefilterbts()">Tout effacer</span>
			<button class="bouttonconnex3" id="applyfilterbts"onclick="applyfilterbts()">Appliquer ces filtres</button>
		</div>
		
	</div>
</div>