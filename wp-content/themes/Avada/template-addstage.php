<?php
/**
 * Template Name: Ajouter stage
 * Description: Pages Ajouter stage
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
	
	
	if(lgchkent()){
		
	  if(isset($_GET["msg"]) && $_GET["msg"] == "connected"){ ?>

            <div class='alert alert-success ctr'><button type='button' class='close' data-dismiss='alert'>&times;</button>Bienvenue , <?php echo $_SESSION['ent_mail']; ?>.</div>

        <?php } 
		
		
	$ent_id=decryptIt($_SESSION["ent_id"],$_SESSION["hashsession"]);
		
	$tabarray=recData("entreprise",$ent_id);
	
	if(isset($_GET["stage"])){
	
		$stage_id=decryptIt($_GET["stage"],$_SESSION["hashsession"]);
		$tabstage=recData("stage",$stage_id);
	
	}
	
	$type=0;
	
	if(isset($_GET["type"])){
		
		$type=$_GET["type"];
		
	}

	$etape=1;
	if(isset($_GET["etape"]))$etape=$_GET["etape"];
	
	switch($etape){ 
	
		case "1":
		
		include("etape1.php");
		
		
		break;
		case "2":
		
		include("etape2.php");
		
		
		break;
		case "3":
		
		include("etape3.php");
		
		
		break;
		case "4":
		
		include("etape4.php");
		
		
		break;
		case "5":
		
		include("etape5.php");
		
		
		break;
		
	
	 }


	}else{
		
		?>
		
		<h2>Pour pouvoir déposer une offre de stage, vous devez d'abord vous connecter en tant qu'entreprise</h2>
			
			
		<?php
		
		if(isset($_GET["type"])){
		
			?>
			
			<a href="<?php echo get_site_url(); ?>/espace-entreprise/?redirect=deposer-une-offre&type=<?php echo $_GET["type"]; ?>" class="btn btn-warning">Se connecter</a>
			
			
			<?php
			
		}else{
	
		?>
		
		<a href="<?php echo get_site_url(); ?>/espace-entreprise/?redirect=deposer-une-offre" class="btn btn-warning">Se connecter</a>
		
		<?php
		
		}
		
	}

	 ?>
	
	
	
</section>



<?php do_action( 'avada_after_content' ); ?>
<?php get_footer(); ?>
<?php include("modal.php");?>