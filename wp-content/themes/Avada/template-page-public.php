<?php
/**
 * Template Name: page public
 * Description: Page zone public
 */
 
get_header();  ?>
<section id="content" <?php Avada()->layout->add_style( 'content_style' ); ?>>	
	
	
    
		<aside id="widget" class="widget-container col-md-3 "><?php	get_sidebar('priv'); ?></aside>
		<section  class="content-area col-md-9">
		
			<?php while ( have_posts() ) : the_post(); ?>

				
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				

				<div class="entry-content">
					<?php the_content(); ?>
					<?php
						wp_link_pages( array(
							'before' => '<div class="page-links">' . __( 'Pages:', 'wp-fanzone' ),
							'after'  => '</div>',
						) );
					?>
				</div><!-- .entry-content -->

				<footer class="entry-footer">
					<?php edit_post_link( __( 'Edit', 'wp-fanzone' ), '<span class="edit-link">', '</span>' ); ?>
				</footer><!-- .entry-footer -->
			</article>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // end of the loop. ?>
			
		
	</section><!-- #primary -->

	
</section>  
<script type="text/javascript">

    function PrintElem(elem)
    {
        Popup(jQuery(elem).parent().find(".site-main").html());
    }

    function Popup(data) 
    {
        var mywindow = window.open('', 'my div', 'height=500,width=500');
        mywindow.document.write('<html><head><title>Education.pf</title>');
        /*optional stylesheet*/ //mywindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10

        mywindow.print();
        mywindow.close();

        return true;
    }

</script>	
<?php get_footer(); ?>