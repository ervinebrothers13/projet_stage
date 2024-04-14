<?php
/**
 * Template Name: Ajouter page postuler
 * Description: Pages postuler
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
	
	if(lgchkelv() or lgchkpeda()){
		
		$stagehash=0;
		$candhash=0;
		
		$cand_id=0;
		$stage_id=0;
		
		$etape=1;
		
		$elv_id=0;
		
		if(lgchkpeda() and isset($_GET["elv"])){
			
			$_SESSION['elv_id2'] = $_GET["elv"];
			
			$elv_id=decryptIt($_GET["elv"],$_SESSION["hashsession"]);
			
		}else if(lgchkpeda() and isset($_SESSION['elv_id2']) and $_SESSION['elv_id2']!=0){
			
			$elv_id=decryptIt($_SESSION["elv_id2"],$_SESSION["hashsession"]);
			
		}else{
		
			$elv_id=decryptIt($_SESSION["elv_id"],$_SESSION["hashsession"]);
			
		}
		
		if(isset($_GET["cand"])){
			
			$candhash=$_GET["cand"];
			
			$cand_id=decryptIt($candhash,$_SESSION["hashsession"]);
			$tabcand=recData("candidature",$cand_id);
			
			$stage_id=$tabcand["stage_id"];
			$etape=$tabcand["etape"];
			
			$stage=encryptIt($stage_id,$_SESSION["hashsession"]);
			
		}else if(isset($_GET["stage"])){
			
			$stagehash=$_GET["stage"];
			
			$stage_id=decryptIt($stagehash,$_SESSION["hashsession"]);
			
			$testtabcand=recData("testcandidature",array($elv_id,$stage_id));
			
			if(!empty($testtabcand)){
				
				$candhash=encryptIt($testtabcand["cand_id"],$_SESSION["hashsession"]);
				$tabcand=recData("candidature",$testtabcand["cand_id"]);
				$etape=$tabcand["etape"];
				
			}
			
			
			
		}
		
		if(isset($_GET["etape"]))$etape=$_GET["etape"];
		
		$tabstage=recData("stage",$stage_id);
		
		$tabeleve=recData("eleve",$elv_id);
		
		switch($etape){ 
		
			case "1":
			
				include("postuler1.php");
			
			break;
			case "2":
			
				include("postuler2.php");
			
			break;
			case "3":
			
				include("postuler3.php");
			
			break;
			case "4":
			
				include("postuler4.php");
			
			break;
			
		} 
	 
	 
	}else{
		
		?>
		
		
		<h2>Pour pouvoir postuler à une offre de stage, vous devez d'abord vous connecter en tant qu'élève</h2>
		<a href="<?php echo get_site_url(); ?>/espace-eleve/?redirect=postuler&stage=<?php echo $_GET["stage"]; ?>" class="btn btn-warning">Se connecter</a>
		
		<?php
		
	}
	
	 ?>
	
	
	
</section>



<?php do_action( 'avada_after_content' ); ?>
<?php get_footer(); ?>
<?php include("modal.php");?>