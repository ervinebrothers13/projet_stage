<?php
/**
 * Template Name: fullwitdh
 * Description: Page plein
 */

get_header();  ?>
<div class="row breadcrumb-container">
	<?php wp_fanzone_breadcrumb(); ?>
</div>
<div class="row">

<aside class="widget-container col-md-3 " id="widget">
<?php get_sidebar('peda1');  ?>
  </aside>

	<div id="primary" class="content-area col-md-12">
	<button class="bouttomimpression" onclick="PrintElem(this)"><span class="glyphicon glyphicon-print"></span> Impression de la page</button>
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

	
</div>    
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
<script type='text/javascript' src='<?php bloginfo("url") ?>/wp-content/themes/wp-fanzone/js/sidebarefixe.js'></script>