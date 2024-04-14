<?php
/**
 * Template Name: page assise
 * Description: Page assise
 */
 
get_header("style"); 



 ?>

<div class="row">
<aside class="widget-container col-md-3 " id="widget">
    

	<?php
		get_sidebar('assise'); 
	 ?>

	
    </aside>

	<div id="primary" class="content-area col-md-9">
	
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

jQuery(document).ready(function($){


	var offset = 300, offset_opacity = 1200, scroll_top_duration = 700, $back_to_top = jQuery('#gototop');

	jQuery(window).scroll(function(){
		( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
		if( $(this).scrollTop() > offset_opacity ) { 
			$back_to_top.addClass('cd-fade-out');
		}
	});

	$back_to_top.on('click', function(event){
		
		event.preventDefault();
		
		
		jQuery('body,html').animate({
			scrollTop: 0 ,
			}, scroll_top_duration
		);
	});



	var windowWidth = jQuery(window).width();
	var windowheight = jQuery(document).height();

	/**************Sidebar fixed*******************/

		
		var topmenu=jQuery("#sidebar").offset().top-100;
		var topfooter=jQuery("#colophon").offset().top-550;
		var top=jQuery(window).scrollTop();
		var toptopgotop=top+650;
		var topgotop=jQuery("#gototop").offset().top;
		var newtopgotop=topfooter-200;
		//alert(top);
		if(top>300){
			
				if(toptopgotop>topfooter){
						
				jQuery("#gototop").addClass("stoptogoabsolute").removeClass("stoptogofixed").css("top",newtopgotop+"px");
				}else{
				jQuery("#gototop").addClass("stoptogofixed").removeClass("stoptogoabsolute").removeAttr("style");
						
				}
			
			
		}
		if(windowWidth>670){
			var top=jQuery(window).scrollTop();
			
			;
			if(top>300){
				if(top>topfooter){
					jQuery("#widget").find("#sidebar").removeClass("stayfixed");
				}else if(top>topmenu){
					jQuery("#widget").find("#sidebar").addClass("stayfixed");
				}else{
					jQuery("#widget").find("#sidebar").removeClass("stayfixed");
					
				}
			}
			
			jQuery( window ).scroll(function() {
				var top=jQuery(window).scrollTop();
				var height= jQuery("body").height();
			var limit=height-top;
			//alert(limit);
		var toptopgotop=top+650;
		var topgotop=jQuery("#gototop").offset().top;
		var newtopgotop=topfooter-200;
			if(windowheight>2200){
				if(toptopgotop>topfooter){
						
					jQuery("#gototop").addClass("stoptogoabsolute").removeClass("stoptogofixed").css("top",newtopgotop+"px");
				}else{
					jQuery("#gototop").addClass("stoptogofixed").removeClass("stoptogoabsolute").removeAttr("style");
						
				}
			}
				if(limit>1420){
					
				if(top>topfooter){
					jQuery("#widget").find("#sidebar").removeClass("stayfixed");
				}else if(top>topmenu){
					jQuery("#widget").find("#sidebar").addClass("stayfixed");
				}else{
					jQuery("#widget").find("#sidebar").removeClass("stayfixed");
					
					
					
				}
				
				}else{
					jQuery("#widget").find("#sidebar").removeClass("stayfixed");
					
					
					
				}
			})
			
		}else{
			
			
			var top=jQuery(window).scrollTop();
			if(top>300){
				if(top>topfooter){
					jQuery("#widget").find("#sidebarmobile").removeClass("stayfixed");
				}else if(top>topmenu){
					jQuery("#widget").find("#sidebarmobile").addClass("stayfixed");
				}else{
					jQuery("#widget").find("#sidebarmobile").removeClass("stayfixed");
					
				}
			}
			
			jQuery( window ).scroll(function() {
				var top=jQuery(window).scrollTop();
				
				
		var toptopgotop=top+650;
		var topgotop=jQuery("#gototop").offset().top;
		var newtopgotop=topfooter-200;
			if(windowheight>2200){
				if(toptopgotop>topfooter){
						
					jQuery("#gototop").addClass("stoptogoabsolute").removeClass("stoptogofixed").css("top",newtopgotop+"px");
				}else{
					jQuery("#gototop").addClass("stoptogofixed").removeClass("stoptogoabsolute").removeAttr("style");
						
				}
			}
				if(top>topfooter){
					jQuery("#widget").find("#sidebarmobile").removeClass("stayfixed");
				}else if(top>topmenu){
					jQuery("#widget").find("#sidebarmobile").addClass("stayfixed");
				}else{
					jQuery("#widget").find("#sidebarmobile").removeClass("stayfixed");
					
					
					
				}
			})
			
			
			
		}
		
		jQuery(window).resize(function() {
			var topgotop=jQuery("#gototop").scrollTop();
			var windowWidth = jQuery(window).width();
			var topmenu=jQuery("#sidebar").offset().top-100;	
			var topfooter=jQuery("#colophon").offset().top-550;
			var top=jQuery(window).scrollTop();
		var toptopgotop=top+600;
		var topgotop=jQuery("#gototop").offset().top;
		var newtopgotop=topfooter-200;
		if(top>300){
		if(toptopgotop>topfooter){
					
					jQuery("#gototop").addClass("stoptogoabsolute").removeClass("stoptogofixed").css("top",newtopgotop+"px");
				}else{
					jQuery("#gototop").addClass("stoptogofixed").removeClass("stoptogoabsolute").removeAttr("style");
					
				}
		}	
			
				
			if(windowWidth>970){
			
				var top=jQuery(window).scrollTop();
				if(top>topfooter){
					jQuery("#widget").find("#sidebar").removeClass("stayfixed");
				}else if(top>topmenu){
					jQuery("#widget").find("#sidebar").addClass("stayfixed");
				}else{
					jQuery("#widget").find("#sidebar").removeClass("stayfixed");
				}
			
			
			jQuery( window ).scroll(function() {
				
				var top=jQuery(window).scrollTop();
				var toptopgotop=top+600;
				var topgotop=jQuery("#gototop").offset().top;
				var newtopgotop=topfooter-200;
				if(top>300){
				if(toptopgotop>topfooter){
							
							jQuery("#gototop").addClass("stoptogoabsolute").removeClass("stoptogofixed").css("top",newtopgotop+"px");
						}else{
							jQuery("#gototop").addClass("stoptogofixed").removeClass("stoptogoabsolute").removeAttr("style");
							
						}
				}	
				
				if(top>topfooter){
				jQuery("#widget").find("#sidebar").removeClass("stayfixed");
				}else if(top>topmenu){
					jQuery("#widget").find("#sidebar").addClass("stayfixed");
				}else{
					jQuery("#widget").find("#sidebar").removeClass("stayfixed");
				}
			})
			
			}else{
				
				jQuery("#widget").find("#sidebar").removeClass("stayfixed");
				
			}
		
		
		});
		
	jQuery("#idbuttonsidbar").click(function() {
		
		if($("#sidebarmobile").hasClass("sideclose")){
			
			 $(this).html('<span class="glyphicon glyphicon-chevron-left">');
			
			
			$('.page-template-template-page-style-php #widget .stayfixed').animate({
			
				left:"10px"
				
			});
			
			$("#sidebarmobile").removeClass("sideclose");
			
		}else{
			$(this).html('<span class="glyphicon glyphicon-chevron-right">');
			
			$('.page-template-template-page-style-php #widget .stayfixed').animate({
				
				left:"-210px"
				
			});
			
			
			$("#sidebarmobile").addClass("sideclose");
			
		}
		
		
	})	
	

})

</script>	
<?php get_footer(); ?>