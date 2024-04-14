
 <?php
 
include_once("../../../wp-load.php"); 
include_once("../../../wp-config.php"); 

session_init();
	
 if(isset($_GET["cand"])){
	  
	$cand_id=decryptIt($_GET["cand"],$_SESSION["hashsession"]);
	 
	 $tabcand=recData("candidature",$cand_id);
	 
	 $elv_id=$tabcand["elv_id"];
	 
	 $tabconvention=recData("convention",array($cand_id,$elv_id));
	 
 
$filename = get_site_url()."/wp-content/uploads/signature/".$tabconvention["reference"].".pdf";
$content = file_get_contents($filename);
header("Content-Disposition: inline; filename=$filename");
header("Content-type: application/pdf");
header('Cache-Control: private, max-age=0, must-revalidate');
header('Pragma: public');
echo $content;

 }
 
 ?>