<?php
/**
 * Template Name: show enseignant categorie
 * Description: Pages enseignant categorie
 */
 

 
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}
?>
<?php get_header(); ?>
<!-- Load jQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <!-- Load Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Load the plugin bundle. -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/filter-multi-select-main/dist/filter_multi_select.css" />
	 <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/pagination.css" />
    <script src="<?php echo get_template_directory_uri(); ?>/js/filter-multi-select-main/dist/filter-multi-select-bundle.min.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/pagination.js"></script>
	
<section id="content" <?php Avada()->layout->add_style( 'content_style' ); ?>>
	<?php if ( is_user_logged_in() ) { ?>
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
	
	<div id="contentfilter">
		
		<?php
		
		$parentarray=array(448,431,447);

		$taxonomy = 'category';
		$parent_args = [
			'taxonomy'     => $taxonomy,
			'parent'        => $parentarray[0],
			'hide_empty'    => false
		];
		$parent_terms = get_terms( $parent_args );
		
		/*echo "<pre>";
		print_r($parent_terms);
		echo "</pre>";*/
		
		$parent_args2 = [
			'taxonomy'     => $taxonomy,
			'parent'        => $parentarray[1],
			'hide_empty'    => false
		];
		$parent_terms2 = get_terms( $parent_args2 );
		
		$lstarray=array();
		$lstarray1=array();
		$lstarray2=array();
		
		?>
	
	
    <form method="GET" id="form">
	
		
		<div class="row">
			
			<div class="col-6 row paddingright40">
				<div class="form-group row">
					<label class="col-12 col-form-label fontsize30" for="niveau">Niveau :</label>
					<div class="col-12">
						<select multiple name="niveau[]" id="niveau" class="filter-multi-select">
							<?php foreach($parent_terms as $value1){ 
							
							array_push($lstarray, $value1->term_id);
							array_push($lstarray1, $value1->term_id);
							
							$selected="";
							if(isset($_GET["niveau"])){
								
								if(in_array($value1->term_id,$_GET["niveau"]))$selected="selected";
							
							}else{
								
								$selected="selected";
							}
							
							?>
						
							<option value="<?php echo $value1->term_id; ?>" <?php echo $selected; ?>><?php echo $value1->name; ?></option>
						
							<?php } ?>
						
						</select>
					</div>
				 </div>
			</div>
		   <div class="col-6 row paddingright40">
				<div class="form-group row">
					<label class="col-12 col-form-label fontsize30" for="ressources-enseignants">Matière :</label>
					<div class="col-12" >
					  <select multiple name="ressources-enseignants[]" id="ressources-enseignants" class="filter-multi-select">
						<?php foreach($parent_terms2 as $value2){ 
							
							
							array_push($lstarray, $value2->term_id);
							array_push($lstarray2, $value2->term_id);
							
							$selected="";
							if(isset($_GET["ressources-enseignants"])){
								
								if(in_array($value2->term_id,$_GET["ressources-enseignants"]))$selected="selected";
							
							}else{
								
								$selected="selected";
							}
						
						?>
						
							<option value="<?php echo $value2->term_id; ?>" <?php echo $selected; ?>><?php echo $value2->name; ?></option>
						
							<?php } ?>
					  </select>
					</div>
				 </div>
			</div>
			<?php if(isset($_GET["niveau"]) or isset($_GET["ressources-enseignants"])){ ?>
			<div class="col-6 row marginright10">
			
			<?php }else{	?>
			<div class="col-12 row marginright10">
			
			
			<?php } ?>
				<button type="submit" id="filtrerbut" class="btn btn-primary"><i class="fa fa-filter" aria-hidden="true"></i>filtrer</button>
			</div>
			<?php if(isset($_GET["niveau"]) or isset($_GET["ressources-enseignants"])){ ?>
			<div class="col-6 row">
				<a id="filtrerbutcancel" href="<?php echo get_site_url(); ?>/enseignants/ressources-par-type-niveaux-matieres/" class="btn btn-secondary" ><i class="fa fa-window-close-o" aria-hidden="true"></i>Annuler</a>
			</div>
			
			<?php } ?>
		</div>
	  
    </form>
	
	
    
    
	</div>
	
    <div id="contentarticle">
		
		<?php
		
		if(isset($_GET["niveau"]) or isset($_GET["ressources-enseignants"])){
			
			if(empty($_GET["niveau"])){
				
				$_GET["niveau"]=$lstarray1;
				
			}
			
			if(empty($_GET["ressources-enseignants"])){
				
				$_GET["ressources-enseignants"]=$lstarray2;
				
			}
						
			$lstarrayfiltre=array_merge($_GET["niveau"], $_GET["ressources-enseignants"]);
			
			$lstarraynotfiltre = array_diff($lstarray, $lstarrayfiltre);
			
			/*echo "<pre>";
			print_r($lstarrayfiltre);
			echo "</pre>";
			echo "<pre>";
			print_r($lstarraynotfiltre);
			echo "</pre>";*/
			 
			$args = array(
				'posts_per_page'   => -1,
				'category'         => $_GET["ressources-enseignants"],
				//'category' => array("462","432","433"),
				//'Exclude' => $lstarraynotfiltre,
				'orderby'          => 'post_date',
				'order'            => 'ASC',
				'post_type'        => 'post'
			);
			
		/*	cat (int)
			category_name (string)
			category__and (array)
			category__in (array)
			category__not_in (array)*/

		}else{
			
		$args = array(
			'posts_per_page'   => -1,
			'category'         => $lstarray2,
			'orderby'          => 'post_date',
			'order'            => 'ASC',
			'post_type'        => 'post'
		);

		
				
		}
		
		$posts = get_posts($args);
		
		$cpt=0;
			foreach($posts as $post){
				
				$lstcategories=wp_get_post_categories($post->ID);
				
				$good=0;
				$good1=0;
				$good2=1;
				$good3=0;
				
				 
				
				foreach($lstcategories as $value){
					
					$catobject = get_category($value);
					if($catobject->category_parent==$parentarray[1])$good3=1;
					
				}
					
				if(in_array($parentarray[2],$lstcategories))$good2=0;
				
				
				if(isset($_GET["niveau"],$_GET["ressources-enseignants"])){
					
					foreach($lstcategories as $value){
						
						if(in_array($value,$_GET["niveau"]))$good=1;
						
					}
					
					foreach($lstcategories as $value){
						
						if(in_array($value,$_GET["ressources-enseignants"]))$good1=1;
						
					}
					
				}else{
					
					$good=1;
					$good1=1;
				}
				
				
				if($good==1 and $good1==1 and $good2==1 and $good3==1){
					
					$content=html_entity_decode($post->post_content);
						
					$lastmodif=html_entity_decode($post->post_modified);
						
					?>
					
					<article>
						
						<h3 class="flex1 justifytext"><?php echo $post->post_title; ?></h3>
						<p class="flex1 fontsize10 nomargin">mise à jour : <?php echo fDate($lastmodif,"html"); ?></p>
						<p class="flex1">
						<?php
						
						foreach($lstcategories as $cate){
							
							if(function_exists('rl_color')){
								
								$rl_category_color = rl_color($cate);
								
							}
							
							if(!in_array($cate,$parentarray)){
								
								$category  = get_category($cate);
								$parent  = get_category($category->parent);
								//$category_name  = get_category($category->category_parent);
								
								
								//print_r($parent);

							?>
							
							<a href="<?php echo get_site_url(); ?>/enseignants/ressources-par-type-niveaux-matieres/?<?php echo $parent->slug; ?>%5B%5D=<?php echo $cate; ?>" class="categoryclass" style="background:<?php echo $rl_category_color; ?>;"><?php echo get_cat_name($cate); ?></a>
							
							
							<?php
							
							}
							
						}
						
						
						?>
						</p>
						
						<p  class="wordbreakall flex3 justifytext"><?php echo limitcontent($content,30); ?></p>
						<p class="alignselfcenter flex1 width100"><a class="btn btn-light padding20 fontbold width100" href="<?php echo get_the_permalink($post->ID); ?>" >Accéder à la ressource</a></p>
					</article>
			
			<?php
				$cpt++;
				}
			
			}
			
		if($cpt==0){
			
			?>
			
			<h1>Aucune ressource disponible</h1>
			
			<?php
			
		}
		
		?>
		
		

 
		
		
		
	</div>
	<?php }else{ ?>
	<div id="fenetreauthentition">
	<h2>Veuillez vous authentifier pour voir les ressources destinées aux enseignants</h2>
								<form action='<?php echo bloginfo("url"); ?>/wp-login.php' method='POST'>
															
													<label for="user_login">Identifant</label></br>
													<input type='text' id='user_login' name='log' class='form-control' placeholder='Votre identifiant ou email' required autofocus></br>
													<label for="user_pass">Votre mot de passe</label></br>
													<input type='password' id='user_pass' name='pwd' class='form-control' placeholder='Votre mot de passe' required></br>
													
													<input class='btn btn-primary btn-block buttonconnect' name='seconnecter' id="wp-submit" type='submit' value='Connexion'>
													<input type="hidden" value="<?php echo get_permalink(); ?>" name="redirect_to">					
																		
											</form>
											</div>
	<?php } ?>
</section>
<script>
$(function() {
 
})
</script>

<?php

function limitcontent($chaine,$nbmots){
	
	$chaine = preg_replace('!<br.*>!iU', "", $chaine); // remplacement des BR par des espaces
	$chaine = strip_tags($chaine);
	$chaine = preg_replace('/\s\s+/', ' ', $chaine); // retrait des espaces inutiles
	$tab = explode(" ",$chaine);
	if (count($tab) <= $nbmots) {
	$affiche = $chaine;
	} else {
	$affiche = "$tab[0]";
	for ($i=1; $i<$nbmots; $i++) {
	$affiche .= " $tab[$i]";
	}
	}
	
	return $affiche;
}



//******************************************************
// Fonction : fDate
// Paramètres : $val -- valeur à formater
//              $typ -- Type de formattage (sql ou html)
// Description : Formate une date au format voulu
//******************************************************
function fDate($val,$typ){ 
	$newdate = "";
	
	if ($val != ""){
		switch($typ){
			case 'sql':
				$annee = substr(trim($val),6,4);
				$mois = substr(trim($val),3,2);
				$jour = substr(trim($val),0,2);
				$newdate = $annee."-".$mois."-".$jour;
			break;
			case "html":
				$annee = substr(trim($val), 0, 4);
				$mois = substr(trim($val), 5, 2);
				$jour = substr(trim($val), 8, 2);
				$newdate = $jour."/".$mois."/".$annee;
			break;
			case "htmlh":
				$annee = substr(trim($val), 0, 4);
				$mois = substr(trim($val), 5, 2);
				$jour = substr(trim($val), 8, 2);
				$heure = substr(trim($val), 11, 2);
				$minute = substr(trim($val), 14, 2);
				$newdate = $jour."/".$mois."/".$annee." &agrave; ".$heure.":".$minute;
			break;
			case "htmld":
				$newdate = strftime('%A %d %B %Y',strtotime($val));
			break;
			case "dlimit":
				$newdate = strftime('%Y%m%d',strtotime($val.' +1 day'));
			break;
		}
	}
	return $newdate;
}
?>



<?php do_action( 'avada_after_content' ); ?>
<?php get_footer(); ?>