<?php

include_once("../../../wp-load.php"); 
include_once("../../../wp-config.php"); 


		//Définir le fuseau horaire de tahiti pour l'affichage des dates
    date_default_timezone_set('Pacific/Tahiti'); //Définir le fuseau horaire de tahiti pour l'affichage des dates
    setlocale (LC_TIME, 'fr_FR.utf8','fra'); 

	ini_set('memory_limit', '2048M');
	ini_set('max_execution_time', '300');
	ini_set("pcre.backtrack_limit", "3000000");
	
	if(isset($_GET["cand"])){
		
	
		$cand_id=decryptIt($_GET["cand"],$_SESSION["hashsession"]);
			
		$tabcand=recData("candidature",$cand_id);
		$elv_id=$tabcand["elv_id"];
		$stage_id=$tabcand["stage_id"];
		$tabstage=recData("stage",$stage_id);
		$tabeleve=recData("eleve",$elv_id);
		$type=$tabstage["type_id"];
		$tabconvention=recData("convention",array($cand_id,$elv_id));
		
		 // récupération du contenu HTML
		ob_start();
		
		include("model/signature.php");
				
		$content = ob_get_clean();
		//echo $content;
		ob_end_clean();

		// conversion HTML => PDF
		require_once 'assets/mpdf/vendor/autoload.php';
			
			
			
		$ort = "A4-P";
		$sfont = "12";
				
				
		try{		
			
				$prm = ['format' => $ort,
					'default_font' => 'Times New Roman',
					'default_font_size' => $sfont,
					'margin_left' => 10,
					'margin_right' => 10,
					'margin_top' => 5,
					'margin_bottom' => 5,
					'margin_header' => 0,
					'margin_footer' => 0,
					'tempDir' => __DIR__ . '/tmp'];
			
			
			
			$urlout = $_SERVER['DOCUMENT_ROOT']."/wp-content/uploads/signature/".$tabconvention["reference"].".pdf";
			
			$mpdf = new \Mpdf\Mpdf($prm);

			$mpdf->allow_charset_conversion = true;
			$mpdf->charset_in = 'utf8';
			$mpdf->WriteHTML($content);
			$mpdf->Output($urlout,'F');
			//$mpdf->Output($urlout,'D');
		}
		catch(\Mpdf\MpdfException $e) {
			echo $e->getMessage();
			exit;
		}
		
		
	}
	
	//exit();

?>