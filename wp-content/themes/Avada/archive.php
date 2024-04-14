<?php
/**
 * Archives template.
 *
 * @package Avada
 * @subpackage Templates
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}
?>
<?php get_header(); ?>
<section id="content" <?php Avada()->layout->add_class( 'content_class' ); ?> <?php Avada()->layout->add_style( 'content_style' ); ?>>
	<?php if ( category_description() ) : ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class( 'fusion-archive-description' ); ?>>
			<div class="post-content">
				<?php echo category_description(); ?>
			</div>
		</div>
	<?php endif; ?>
	
	<?php
	
	if(is_category())$page_id=the_category_ID(false);
	
	if(!empty($wpdb->get_results("select * from educ_uam_accessgroup_to_object where object_id='".$page_id."'"))){
		
	?>
	
		<aside id="widget" class="widget-container col-md-3 "><?php	get_sidebar('priv'); ?></aside>
		<section  class="content-area col-md-9">
		
		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">
					<?php
						
					single_cat_title();
					
					
					$cur_cat_id = get_query_var( 'cat' );

				
					?>
				</h1>
				<?php
					// Show an optional term description.
					$term_description = term_description();
					if ( ! empty( $term_description ) ) :
						printf( '<div class="taxonomy-description">%s</div>', $term_description );
					endif;
				?>
			</header><!-- .page-header -->
			<div>
			 <?php $categorie = $cur_cat_id;$pagecurrent=1;$nbparpage=10;$offset=0;$nbarticle=0;
		   
		   $cateparent=get_category_parents( $categorie, false,'|');
			$cateparenttab=explode("|",$cateparent);
		   $orderby="date";
		   	$order="DESC";
		   
		   
			if(isset($_GET["categorie"])){
				$categorie=$_GET["categorie"];
			}
			if(isset($_GET["page"])){
				$pagecurrent=$_GET["page"];
			}else{
				$page=1;
			}
			$offset=($page-1)*$nbparpage;
			
			$querynb = new WP_Query( 'cat='.$categorie);
			$nbarticle=$querynb->found_posts;;
			$nbarticle=ceil($nbarticle/$nbparpage);
			
				include("showcategorie.php");
		   ?>
		   </div>
		<?php
		endif;
		
		?>
		
	</section>
	<?php
	
	}else{
		
		?>
		
		<section  class="content-area col-md-12">
		
		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				
				<?php
					$cur_cat_id = get_query_var( 'cat' );
					// Show an optional term description.
					$term_description = term_description();
					if ( ! empty( $term_description ) ) :
						printf( '<div class="taxonomy-description">%s</div>', $term_description );
					endif;
				?>
			</header><!-- .page-header -->
			<div id="blogidcontent">
			 <?php $categorie = $cur_cat_id;$pagecurrent=1;$nbparpage=10;$offset=0;$nbarticle=0;
		   
		   $cateparent=get_category_parents( $categorie, false,'|');
			$cateparenttab=explode("|",$cateparent);
		   $orderby="date";
		   	$order="DESC";
		   
		   
			if(isset($_GET["categorie"])){
				$categorie=$_GET["categorie"];
			}
			if(isset($_GET["page"])){
				$pagecurrent=$_GET["page"];
			}else{
				$page=1;
			}
			$offset=($page-1)*$nbparpage;
			
			$querynb = new WP_Query( 'cat='.$categorie);
			$nbarticle=$querynb->found_posts;;
			$nbarticle=ceil($nbarticle/$nbparpage);
			
				include("showcategorie.php");
		   ?>
		   </div>
		<?php
		endif;
		
		?>
		
	</section>
	
	
	<?php
	
	
		//get_template_part( 'templates/blog', 'layout' ); 
	
	
	}
	?>
</section>
<?php do_action( 'avada_after_content' ); ?>
<?php get_footer(); ?>
