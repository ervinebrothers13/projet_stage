<?php
/**
 * Template Name: Voir convention signé
 * Description: Pages Voir convention signé
 */
 

 
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}
?>
<?php get_header("cust"); ?>

<section id="content" <?php Avada()->layout->add_style( 'content_style' ); ?>>
	
	<?php
	
	
	if(isset($_GET["cand"])){
			
		$candhash=$_GET["cand"];
		
		$cand_id=decryptIt($candhash,$_SESSION["hashsession"]);
		$tabcand=recData("candidature",$cand_id);
		$elv_id=$tabcand["elv_id"];
		
		$tabconvention=recData("convention",array($cand_id,$elv_id));
		
		if($tabconvention["convention_pdf"]!=null){
			
			$filename = get_site_url()."/uploads/convention/".$tabconvention["convention_pdf"];
			$content = file_get_contents($filename);
			header("Content-Disposition: inline; filename=$filename");
			header("Content-type: application/pdf");
			header('Cache-Control: private, max-age=0, must-revalidate');
			header('Pragma: public');
			echo $content;
		
		}

		
	?>
	
</section>



<?php do_action( 'avada_after_content' ); ?>
<?php get_footer(); ?>