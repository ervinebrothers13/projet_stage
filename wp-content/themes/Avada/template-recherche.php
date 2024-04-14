<?php
/**
 * Template Name: recherche
 * Description: Page recherche pour pédagogie
 */
?>
<?php get_header(); ?>

<div class="row">
<aside class="col-md-3"> 
			<?php get_sidebar(); ?>
    </aside>

	<section id="primary" class="content-area col-md-9">
		<main id="main" class="site-main" role="main">
		
		<?php $i=0;if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Résulats de la recherche pour : %s', 'wp-fanzone' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				//get_template_part( 'content', 'search' );
				?>
				
				<?php
						$nombrecara=strlen(get_the_content());
									
							if($nombrecara>500){
										
									$classblock="item item-category-full";
									$i=-1;
										
							}else{
										$classblock="item item-category actu".$i%2;
							}
									
									
						?>
						<div class="<?php echo $classblock; ?>">
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<div class="post_box">
								
								 <header class="entry-header">
								
									<?php 
									$attr="target=_blank";
									$lien_vers_fichier = get_field( 'lien_vers_fichier' );
									if($lien_vers_fichier==""){
										$lien_vers_fichier = get_the_permalink('');
										$attr="";
									}
										$post_id=get_the_ID();
												if($requetesolo = $wpdb->get_results("select * from wp_weblink where id_post='".$post_id."'")){
													
													$iteration=$requetesolo[0]->iteration;
													$date_dern=$requetesolo[0]->date_dern;
												}else{
													$date_dern=date("Y-m-d");
													$iteration=1;
													$titre=get_the_title();
													$wpdb->insert('wp_weblink',array('id'=>'DEFAULT','id_post'=>$post_id,'nom'=>$titre,'iteration'=>$iteration,'date_dern'=>$date_dern));
													
													
												}
									
									?>
										<?php //the_title( sprintf( '<h5 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>        
									   <h5><a class="weblink" data-id="<?php the_ID(); ?>" <?php echo $attr; ?> href="<?php echo $lien_vers_fichier; ?>"><?php echo get_the_title(); ?></a></h5>
									</header><!-- .entry-header -->
									
									<?php
									
										if(has_post_thumbnail()){
											?>
											
											<a class="col-sm-3 padding5px weblink" data-id="<?php the_ID(); ?>" <?php echo $attr; ?> href="<?php echo $lien_vers_fichier; ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail(); ?></a>
									
									
								   <div class="col-sm-9">
									
									<div class="entry-content">
									
										<?php
											/* translators: %s: Name of current post */
											
											echo the_content();
											?>
															
															<a class="weblink" <?php echo $attr; ?> data-id="<?php the_ID(); ?>" style="float:right;"  href="<?php echo $lien_vers_fichier; ?>" />En savoir plus</a>
															
													
										
										
										<?php
											wp_link_pages( array(
												'before' => '<div class="page-links">' . __( 'Pages:', 'wp-fanzone' ),
												'after'  => '</div>',
											) );
										?>
									</div><!-- .entry-content -->
								  
									</div>
											
											<?php
										}else{
											?>
											  <div class="col-sm-12">
									
									<div class="entry-content">
									
										<?php
											/* translators: %s: Name of current post */
											
											echo the_content();
											
										?>
									
															
															<a class="weblink" <?php echo $attr; ?> data-id="<?php the_ID(); ?>"  style="float:right;" href="<?php echo $lien_vers_fichier; ?>" />En savoir plus</a>
															
														
										<?php
											wp_link_pages( array(
												'before' => '<div class="page-links">' . __( 'Pages:', 'wp-fanzone' ),
												'after'  => '</div>',
											) );
										?>
									</div><!-- .entry-content -->
								  
									</div>
											
											<?php
										}								
									?>
									
									
							   </div>
							</article><!-- #post-## -->
							<div class="clearfix"></div>
							<i style="float:right;font-size:10px;">Vue <span class="nbrvue" ><?php echo $iteration; ?></span> fois</i>
						</div>

			<?php  $i++; endwhile; ?>

			

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

	
</div>
<?php get_footer(); ?>
