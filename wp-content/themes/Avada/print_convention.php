<?php

include_once("../../../wp-load.php"); 
include_once("../../../wp-config.php"); 

	
	
		//Définir le fuseau horaire de tahiti pour l'affichage des dates
    date_default_timezone_set('Pacific/Tahiti'); //Définir le fuseau horaire de tahiti pour l'affichage des dates
    setlocale (LC_TIME, 'fr_FR.utf8','fra'); 

	ini_set('memory_limit', '2048M');
	ini_set('max_execution_time', '300');
	ini_set("pcre.backtrack_limit", "3000000");
	
	
	require_once('assets/FPDI/src/autoload.php');
	require_once('assets/fpdf/fpdf.php');
	
	use setasign\Fpdi\Fpdi;
	
	require_once('assets/vendor/autoload.php');
	
	$pdf = new Fpdi();
	
	$test=0;
	
	if(isset($_GET["cand"])){
		
	
		$cand_id=decryptIt($_GET["cand"],$_SESSION["hashsession"]);
			
		$tabcand=recData("candidature",$cand_id);
		$elv_id=$tabcand["elv_id"];
		$stage_id=$tabcand["stage_id"];
		$tabstage=recData("stage",$stage_id);
		$tabeleve=recData("eleve",$elv_id);
		$type=$tabstage["type_id"];
		$tabconvention=recData("convention",array($cand_id,$elv_id));
		
		
		$urlsign = $_SERVER['DOCUMENT_ROOT']."/wp-content/uploads/signature/".$tabconvention["reference"].".pdf";
		
		
		switch($type){ 

				case "1":
				
				
				 // récupération du contenu HTML
						ob_start();
						
						include("model/convention3eme-1.php");	
						
						$content = ob_get_clean();
						
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
							
							
							$urlconv1 = $_SERVER['DOCUMENT_ROOT']."/wp-content/uploads/convention/".$tabconvention["reference"]."-1.pdf";
							
							$mpdf = new \Mpdf\Mpdf($prm);
							$mpdf->allow_charset_conversion = true;
							$mpdf->charset_in = 'utf8';
							$mpdf->WriteHTML($content);
							$mpdf->Output($urlconv1,'F');

						}
						catch(\Mpdf\MpdfException $e) {
							echo $e->getMessage();
							exit;
						}
						
						
						if($test==1){
							
							ob_start();
							
							include("model/signature-3eme.php");	
							
							$content = ob_get_clean();
							
							ob_end_clean();

							
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
								
								
								$urlsign = $_SERVER['DOCUMENT_ROOT']."/wp-content/uploads/signature/".$tabconvention["reference"].".pdf";
								
								$mpdf = new \Mpdf\Mpdf($prm);
								$mpdf->allow_charset_conversion = true;
								$mpdf->charset_in = 'utf8';
								$mpdf->WriteHTML($content);
								$mpdf->Output($urlsign,'F');

							}
							catch(\Mpdf\MpdfException $e) {
								echo $e->getMessage();
								exit;
							}
						
						}
						
						
						$urlout2="convention-3eme-".$tabconvention["reference"].".pdf";
						
						mergePDFFiles($pdf,array($urlconv1,$urlsign),$urlout2,"convention-".$tabconvention["reference"],"dgee","");
		
		
					
					
				break;
				case "2":
					
					 // récupération du contenu HTML
						ob_start();
						
						include("model/conventionpfmp-1.php");	
						
						$content = ob_get_clean();
						
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
							
							
							$urlconv1 = $_SERVER['DOCUMENT_ROOT']."/wp-content/uploads/convention/".$tabconvention["reference"]."-1.pdf";
							
							$mpdf = new \Mpdf\Mpdf($prm);
							$mpdf->allow_charset_conversion = true;
							$mpdf->charset_in = 'utf8';
							$mpdf->WriteHTML($content);
							$mpdf->Output($urlconv1,'F');

						}
						catch(\Mpdf\MpdfException $e) {
							echo $e->getMessage();
							exit;
						}
						
						
						if($test==1){
							
							ob_start();
							
							include("model/signature-pfmp.php");	
							
							$content = ob_get_clean();
							
							ob_end_clean();

							
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
								
								
								$urlsign = $_SERVER['DOCUMENT_ROOT']."/wp-content/uploads/signature/".$tabconvention["reference"].".pdf";
								
								$mpdf = new \Mpdf\Mpdf($prm);
								$mpdf->allow_charset_conversion = true;
								$mpdf->charset_in = 'utf8';
								$mpdf->WriteHTML($content);
								$mpdf->Output($urlsign,'F');

							}
							catch(\Mpdf\MpdfException $e) {
								echo $e->getMessage();
								exit;
							}
						
						}
						

						// récupération du contenu HTML
						ob_start();
						
						include("model/conventionpfmp-2.php");	
						
						$content = ob_get_clean();
						
						//echo $content;
						ob_end_clean();
	
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
							
							
							$urlconv2 = $_SERVER['DOCUMENT_ROOT']."/wp-content/uploads/convention/".$tabconvention["reference"]."-2.pdf";
							
							$mpdf = new \Mpdf\Mpdf($prm);
							$mpdf->allow_charset_conversion = true;
							$mpdf->charset_in = 'utf8';
							$mpdf->WriteHTML($content);
							$mpdf->Output($urlconv2,'F');
							
							
							//$mpdf->Output($urlout,'D');
						}
						catch(\Mpdf\MpdfException $e) {
							echo $e->getMessage();
							exit;
						}
						
						
						$urlout2="convention-pfmp-".$tabconvention["reference"].".pdf";
		
						mergePDFFiles($pdf,array($urlconv1,$urlsign,$urlconv2),$urlout2,"convention-".$tabconvention["reference"],"dgee","");
		
		
						
				break;
				case "3":
				
				
				 // récupération du contenu HTML
						ob_start();
						
						include("model/conventionbts-1.php");	
						
						$content = ob_get_clean();
						
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
							
							
							$urlconv1 = $_SERVER['DOCUMENT_ROOT']."/wp-content/uploads/convention/".$tabconvention["reference"]."-1.pdf";
							
							$mpdf = new \Mpdf\Mpdf($prm);
							$mpdf->allow_charset_conversion = true;
							$mpdf->charset_in = 'utf8';
							$mpdf->WriteHTML($content);
							$mpdf->Output($urlconv1,'F');

						}
						catch(\Mpdf\MpdfException $e) {
							echo $e->getMessage();
							exit;
						}
						
						
						
						
						if($test==1){
							
							ob_start();
							
							include("model/signature-bts.php");	
							
							$content = ob_get_clean();
							
							ob_end_clean();

							
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
								
								
								$urlsign = $_SERVER['DOCUMENT_ROOT']."/wp-content/uploads/signature/".$tabconvention["reference"].".pdf";
								
								$mpdf = new \Mpdf\Mpdf($prm);
								$mpdf->allow_charset_conversion = true;
								$mpdf->charset_in = 'utf8';
								$mpdf->WriteHTML($content);
								$mpdf->Output($urlsign,'F');

							}
							catch(\Mpdf\MpdfException $e) {
								echo $e->getMessage();
								exit;
							}
						
						}
						
						$urlout2="convention-bts-".$tabconvention["reference"].".pdf";
						
						mergePDFFiles($pdf,array($urlconv1,$urlsign),$urlout2,"convention-".$tabconvention["reference"],"dgee","");
		
		
					
					
				break;
			
			}
			
			
		
		
		
		
		
		
	}
	
	
function mergePDFFiles($pdf,Array $filenames, $outFile, $title='', $author = '', $subject = '') {
	
	// Iterate through each PDF file and add it to the mPDF instance
	foreach ($filenames as $file) {
		// Add a page
		$pdf->AddPage();
		// Set the source file
		$pageCount = $pdf->setSourceFile($file);
		// Import each page
		for ($i = 1; $i <= $pageCount; $i++) {
			$tplId = $pdf->importPage($i);
			// Use the imported page
			$pdf->useTemplate($tplId);
			if ($i < $pageCount) {
				$pdf->AddPage();
			}
		}
		$tabfile=explode("convention",$file);
		if(sizeof($tabfile)>1)unlink($file);
	}
	
	// Output the merged PDF
	$pdf->Output($outFile, 'I'); // 'F' indicates saving to a file
	
}
	
	//exit();

?>