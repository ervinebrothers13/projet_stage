<?php

include_once("../../../wp-load.php"); 
include_once("../../../wp-config.php"); 
require_once 'assets/mpdf/vendor/autoload.php';

 try {
        //initialisation du message d'erreur
        $err = "";
        //connexion � la base de donn�es
        $conn = ConnBDDpdo();

        if (!empty($conn)) {

			switch($_GET['typ']){
					case "deconnexion":
						// Vider la variable de seesion
						$_SESSION = array();
						// récupérer les paramètres du cookie 
						$params = session_get_cookie_params();
						// Effacer le cookie actuel.
						setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
						// Détruire la session
						
						unset($_COOKIE['pseudocookieelv']); 
						setcookie('pseudocookieelv', '', -1, '/'); 
						unset($_COOKIE['pseudocookieent']); 
						setcookie('pseudocookieent', '', -1, '/'); 
						unset($_COOKIE['pseudocookiepeda']); 
						setcookie('pseudocookiepeda', '', -1, '/'); 
						unset($_COOKIE['passwordcookieelv']); 
						setcookie('passwordcookieelv', '', -1, '/'); 
						unset($_COOKIE['passwordcookieent']); 
						setcookie('passwordcookieent', '', -1, '/'); 
						unset($_COOKIE['passwordcookiepeda']); 
						setcookie('passwordcookiepeda', '', -1, '/');
					
					break;
					case "applyfilter3eme":
						
						
						if($_GET["tab"]!="")$_SESSION['filter3eme']=$_GET["tab"];
						else $_SESSION['filter3eme']="-1";
						
						echo "1";
						
					break;
					case "applyfilterpfmp":
						
						
						if($_GET["tab"]!="")$_SESSION['filterpfmp']=$_GET["tab"];
						else $_SESSION['filterpfmp']="-1";
						
						echo "1";
						
					break;
					case "applyfilterbts":
						
						
						if($_GET["tab"]!="")$_SESSION['filterbts']=$_GET["tab"];
						else $_SESSION['filterbts']="-1";
						
						echo "1";
						
					break;
					case "supprimercvelv":
						
						if(lgchkelv() or lgchkpeda()){
							
							$elv_id=0;
							
							if(lgchkpeda() and isset($_SESSION['elv_id2']) and $_SESSION['elv_id2']!=0){
								
								$elv_id=decryptIt($_SESSION["elv_id2"],$_SESSION["hashsession"]);
							
							}else{
								
								$elv_id=decryptIt($_SESSION["elv_id"],$_SESSION["hashsession"]);
								
							}
							
							$stmt = $conn->prepare("SELECT * FROM eleve WHERE eleve.elv_id = :elv_id");
							$stmt->bindParam(':elv_id', $elv_id);
							$stmt->execute();
							$res = $stmt->fetch(PDO::FETCH_ASSOC);
							$stmt->closeCursor();
							
							if(file_exists($_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/cvpdf/'.$res["elv_cvpdf"]))unlink($_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/cvpdf/'.$res["elv_cvpdf"]);
							
							$stmt = $conn->prepare("UPDATE eleve SET elv_cvpdf=NULL WHERE eleve.elv_id=:elv_id");
							$stmt->bindParam(':elv_id', $elv_id);			
							$stmt->execute();
							$stmt->closeCursor();
						
						
						}
						
						echo "1";
						
					break;
					case "supprimerlogo":
						
						if(lgchkent()){
							
							$ent_id=decryptIt($_SESSION["ent_id"],$_SESSION["hashsession"]);
							
							$stmt = $conn->prepare("SELECT * FROM entreprise WHERE entreprise.ent_id = :ent_id");
							$stmt->bindParam(':ent_id', $ent_id);
							$stmt->execute();
							$res = $stmt->fetch(PDO::FETCH_ASSOC);
							$stmt->closeCursor();
							
							if(file_exists($_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/logo/'.$res["ent_logo"]))unlink($_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/logo/'.$res["ent_logo"]);
							
							$stmt = $conn->prepare("UPDATE entreprise SET ent_logo=NULL WHERE entreprise.ent_id=:ent_id");
							$stmt->bindParam(':ent_id', $ent_id);			
							$stmt->execute();
							$stmt->closeCursor();
						
						
						}
						
						echo "1";
						
					break;
					case "supprimerlogouai":
						
						if(lgchkpeda()){
							
							$uai_rne=decryptIt($_GET["uai_rne"],$_SESSION["hashsession"]);
							
							$stmt = $conn->prepare("SELECT * FROM uai WHERE uai.uai_rne = :uai_rne");
							$stmt->bindParam(':uai_rne', $uai_rne);
							$stmt->execute();
							$res = $stmt->fetch(PDO::FETCH_ASSOC);
							$stmt->closeCursor();
							
							if($res["uai_logo"]!=null and file_exists($_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/logouai/'.$res["uai_logo"]))unlink($_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/logouai/'.$res["uai_logo"]);
							
							$stmt = $conn->prepare("UPDATE uai SET uai_logo=NULL WHERE uai.uai_rne=:uai_rne");
							$stmt->bindParam(':uai_rne', $uai_rne);			
							$stmt->execute();
							$stmt->closeCursor();
						
						
						}
						
						echo "1";
						
					break;
					case "voireleve":
					
					
					$content="";
					
						if(isset($_GET["id"])){
							
							$elv_id=decryptIt($_GET["id"],$_SESSION["hashsession"]);
							
							$tabnotifcand1=recData("pedanotificationcand1",$elv_id);
							
							$stmt = $conn->prepare("UPDATE candidature left join stage on stage.stage_id=candidature.stage_id SET candidature.notif_peda=NOW() WHERE stage.type_id=1 and candidature.elv_id=:elv_id");
							$stmt->bindParam(':elv_id', $elv_id);			
							$stmt->execute();
							$stmt->closeCursor();
					
							
							$tabnotifcand2=recData("pedanotificationcand2",$elv_id);
							$tabnotifcand3=recData("pedanotificationcand3",$elv_id);
							$tabnotifconv=recData("pedanotificationconv",$elv_id);
							
						$content.='<div class="row">
								<header class="panel-heading tab-bg-dark-navy-blue col-md-3">
									<ul class="nav nav-tabs mb-2" id="myTab2" role="tablist">
										
										<li class="nav-item" >
											<a class="nav-link active" onclick="changetab(this)" data-toggle="tab" role="tab" aria-controls="troisemetab"
											   aria-selected="false" href="#troisemetab">Candidatures 3ème</a>
										</li>
										<li class="nav-item" data-elv="'.$_GET["id"].'" onclick="viewnotifcandpeda2(this)">
											<a class="nav-link" onclick="changetab(this)" data-toggle="tab" role="tab" aria-controls="pfmptab"
											   aria-selected="false" href="#pfmptab">Candidatures PFMP';
											   
					
												if($tabnotifcand2["NB"]>0){
							
							
													$content.='<span id="notificationcand2"><i class="fa fa-bell fontsize17px animateringring" aria-hidden="true"></i>'.$tabnotifcand2["NB"].'</Span>';
						
							
												}
						
											   
											   
											   $content.='</a>
										</li>
										<li class="nav-item" data-elv="'.$_GET["id"].'" onclick="viewnotifcandpeda3(this)">
											<a class="nav-link" onclick="changetab(this)" data-toggle="tab" role="tab" aria-controls="btstab"
											   aria-selected="false" href="#btstab">Candidatures BTS';
											   
					
												if($tabnotifcand3["NB"]>0){
							
							
													$content.='<span id="notificationcand3"><i class="fa fa-bell fontsize17px animateringring" aria-hidden="true"></i>'.$tabnotifcand3["NB"].'</Span>';
						
							
												}
						
											   
											   
											   $content.='</a>
										</li>
										<li class="nav-item" data-elv="'.$_GET["id"].'" onclick="viewnotifconvpeda(this)">
											<a class="nav-link" onclick="changetab(this)" data-toggle="tab" role="tab" aria-controls="conventionstab"
											   aria-selected="false" href="#conventionstab">Conventions';
											   
					
												if($tabnotifconv["NB"]>0){
							
							
													$content.='<span id="notificationconv"><i class="fa fa-bell fontsize17px animateringring" aria-hidden="true"></i>'.$tabnotifconv["NB"].'</Span>';
						
							
												}
						
											   
											   
											   $content.='</a>
										</li>
									</ul>
								</header>
								<div class="tab-content col-md-9" id="myTabContent2">
									
									<div id="troisemetab" role="tabpanel"
										 class="tab-pane offrecontentclass active">
										<table class="table width100" data-toggle="table" data-search="true" data-pagination="true"
											   data-thead-classes="theadec">
											<thead>
											<tr>
												<th>Intitulé du stage</th>
												<th>Période du stage</th>
												<th>Statut</th>
												<th>Action(s)</th>

											</tr>
											</thead>
											<tbody>';
										
											$lstcand3eme = lstData("candidature3eme", $elv_id);
											
											if(!empty($lstcand3eme)){
												
												foreach ($lstcand3eme as $value) {
														
														$candhash = encryptIt($value["cand_id"], $_SESSION["hashsession"]);

													$candidaturesuspend="";if($value["suspend"]=="1")$candidaturesuspend="candidaturesuspend";
													
													$content.='<tr class="'.$candidaturesuspend.'">
														
														<th>'.($value["metier"]).'</th>
														<th>';
															
															if ($value["dispo"] == "1" or $value["dispo"] == "3") {

																
																$content.=fDate($value["date_deb"], "html") .' - '. fDate($value["date_fin"], "html");

															}else{

																//nb de semaine requis sur la candidature
																$weeks = getWeek();

																foreach ($weeks as $week) {

																	if ($week[0] == $value["semaine"]) {

																	
																		
																		$content.='<p>Semaine '.$week[0].' - du '.$week[1].' au '.$week[2].'</p>';

																		

																	}
																}

															}

														
														$content.='</th>
														<th>';
															
															
															
															
															if ($value["statut"] == "3") {
																
																if($value["ent_ok"]=="0"){
															
																	
																	$content.= '<span class="colorred">en attente de la signature de l\'entreprise</span>';
																	
																}else{
																	
																	if($value["elv_ok"]=="0"){
																		
																		$content.= '<a href="'.get_site_url().'/modifier-convention/?cand='.$candhash.'#entsignaturesign" class="colorred">en attente de votre signature</span>';
																		
																	}else{
																		
																		if($value["ref_ok"]=="0"){
																		
																			$content.= '<span class="colorred">en attente de la signature du référent</span>';
																			
																		}else{
																			
																			if($value["prof_ok"]=="0"){
																		
																				$content.= '<span class="colorred">en attente de la signature du professeur principale</span>';
																				
																			}else{
																				
																				if($value["etab_ok"]=="0"){
																		
																					$content.= '<span class="colorred">en attente de la signature du chef d\'établissement</span>';
																					
																				}else{
																					
																					$content.='<span class="colorgreen">Signé</span>';
																					
																				}
																				
																			}
																			
																		}
																		
																	}
																	
																}
													
																			
															}else{
																
																if ($value["statut"] == "1") $content.='en attente';
															else if ($value["statut"] == "2") $content.='Incomplète';
															else if ($value["statut"] == "3") $content.='Accepté';
															else if ($value["statut"] == "4") $content.='Refusé';
															else $content.='Non finalisé';
																
															}
															
														$content.='</th>
														<th>';
															if($value["suspend"]=="0"){
															if ($value["statut"] == "3") {

													
															   $content.='<a target=_blank class="btn btn-primary" href="'.get_site_url().'/modifier-convention/?cand='.$candhash.'" ><i class="fa fa-pencil" aria-hidden="true"></i></a>';
													
																$content.='<a target=blank href="'.get_template_directory_uri().'/print_convention.php?cand='.$candhash.'" class="btn btn-info"><i class="fa fa-print"></i></a>';
													

															
															} else if ($value["statut"] == "4") {

																

																$content.='<a target=_blank class="btn btn-warning"
																   href="'.get_site_url().'/voir-candidature/?cand='.$candhash.'"><i
																			class="fa fa-eye" aria-hidden="true"></i></a>';

															} else {

																
																$content.='<a target=_blank class="btn btn-warning" href="'.get_site_url().'/voir-candidature/?cand='.$candhash.'" ><i class="fa fa-eye" aria-hidden="true"></i></a>';
																
																$content.='<a class="btn btn-primary"
																   href="'.get_site_url().'/postuler/?elv='.$_GET["id"].'&cand='.$candhash.'"><i
																			class="fa fa-pencil" aria-hidden="true"></i></a>';
																$content.='<a href="#deldata" class="btn btn-danger" role="button" data-toggle="modal"
																   data-id="'.$candhash.'" data-typ="supprimercand3"
																   onClick="aChpDel(this)" title="suppression"><i class="fa fa-trash-o"></i></a>';

															} 
															}else{
											
																	$content.= "Le compte de l'entreprise a été suspendu temporairement";
																	
																	
																}
														$content.='</th>

													</tr>';

													

												}
												
											}
											
											$content.='</tbody>
										</table>
									</div>';
									
									$content.='<div id="pfmptab" role="tabpanel"
										 class="tab-pane offrecontentclasspfmp">
										
										<table class="table width100" data-toggle="table" data-search="true" data-pagination="true"
											   data-thead-classes="theadec">
											<thead>
											<tr>
												<th>Intitulé du stage</th>
												<th>Période du stage</th>
												<th>Statut</th>
												<th>Action(s)</th>
											</tr>
											</thead>
											<tbody>';
											
											$lstcandpfmp = lstData("candidaturepfmp", $elv_id);

											foreach ($lstcandpfmp as $value) {
												
												$candhash = encryptIt($value["cand_id"], $_SESSION["hashsession"]);

												
												$candidaturesuspend="";if($value["suspend"]=="1")$candidaturesuspend="candidaturesuspend";
													
													$content.='<tr class="'.$candidaturesuspend.'">
													
													<th>'.($value["metier"]).'</th>
													<th>';
														
														if ($value["dispo"] == "1" or $value["dispo"] == "3") {

															$content.=fDate($value["date_deb"], "html") . ' - ' . fDate($value["date_fin"], "html");

														} else {

															//nb de semaine requis sur la candidature
															$weeks = getWeek();

															foreach ($weeks as $week) {

																if ($week[0] == $value["semaine"]) {

																	
																	$content.='<p>Semaine '.$week[0].' - du '.$week[1].' au '.$week[2].'</p>';

																	

																}
															}

														}

														
													$content.='</th>
													<th>';
														

														//typ de réponse possible à la candidature
														if ($value["statut"] == "3") {
															if($value["ent_ok"]=="0"){
															
																	
																	$content.= '<span class="colorred">en attente de la signature de l\'entreprise</span>';
																	
																}else{
																	
																	if($value["elv_ok"]=="0"){
																		
																		$content.= '<a href="'.get_site_url().'/modifier-convention/?cand='.$candhash.'#entsignaturesign" class="colorred">en attente de votre signature</span>';
																		
																	}else{
																		
																		if($value["ref_ok"]=="0"){
																		
																			$content.= '<span class="colorred">en attente de la signature du référent</span>';
																			
																		}else{
																			
																			if($value["prof_ok"]=="0"){
																		
																				$content.= '<span class="colorred">en attente de la signature du professeur principale</span>';
																				
																			}else{
																				
																				if($value["etab_ok"]=="0"){
																		
																					$content.= '<span class="colorred">en attente de la signature du chef d\'établissement</span>';
																					
																				}else{
																					
																					$content.='<span class="colorgreen">Signé</span>';
																					
																				}
																				
																			}
																			
																		}
																		
																	}
																	
																}
													
																			
															}else{
																
																if ($value["statut"] == "1") $content.='en attente';
															else if ($value["statut"] == "2") $content.='Incomplète';
															else if ($value["statut"] == "3") $content.='Accepté';
															else if ($value["statut"] == "4") $content.='Refusé';
																else $content.='Non finalisé';
															}
															

														
													$content.='</th>
													
													<th>';
													if($value["suspend"]=="0"){
													if ($value["statut"] == "3") {
															
															
													
															   $content.='<a target=_blank class="btn btn-primary" href="'.get_site_url().'/modifier-convention/?cand='.$candhash.'" ><i class="fa fa-pencil" aria-hidden="true"></i></a>';
													
																$content.='<a target=blank href="'.get_template_directory_uri().'/print_convention.php?cand='.$candhash.'" class="btn btn-info"><i class="fa fa-print"></i></a>';
													

															
															} else if ($value["statut"] == "4") {

																

																$content.='<a target=_blank class="btn btn-warning"
																   href="'.get_site_url().'/voir-candidature/?cand='.$candhash.'"><i
																			class="fa fa-eye" aria-hidden="true"></i></a>';

															} else {

																
																$content.='<a target=_blank class="btn btn-warning" href="'.get_site_url().'/voir-candidature/?cand='.$candhash.'" ><i class="fa fa-eye" aria-hidden="true"></i></a>';
																
																$content.='<a class="btn btn-primary"
																   href="'.get_site_url().'/postuler/?elv='.$_GET["id"].'&cand='.$candhash.'"><i
																			class="fa fa-pencil" aria-hidden="true"></i></a>';
																$content.='<a href="#deldata" class="btn btn-danger" role="button" data-toggle="modal"
																   data-id="'.$candhash.'" data-typ="supprimercand3"
																   onClick="aChpDel(this)" title="suppression"><i class="fa fa-trash-o"></i></a>';

															} 
															}else{
											
																	$content.= "Le compte de l'entreprise a été suspendu temporairement";
																	
																	
																}
															
													$content.='</th>

												</tr>';

											

											}

											
											$content.='</tbody>
										</table>

									</div>';

									$content.='<div id="btstab" role="tabpanel"
										 class="tab-pane offrecontentclass">
										<table class="table width100" data-toggle="table" data-search="true" data-pagination="true"
											   data-thead-classes="theadec">
											<thead>
											<tr>
												<th>Intitulé du stage</th>
												<th>Période du stage</th>
												<th>Statut</th>
												<th>Action(s)</th>

											</tr>
											</thead>
											<tbody>';
										
											$lstcandbts = lstData("candidaturebts", $elv_id);
											
											if(!empty($lstcandbts)){
												
												foreach ($lstcandbts as $value) {
														
														$candhash = encryptIt($value["cand_id"], $_SESSION["hashsession"]);

													
													$candidaturesuspend="";if($value["suspend"]=="1")$candidaturesuspend="candidaturesuspend";
													
													$content.='<tr class="'.$candidaturesuspend.'">
														
														<th>'.($value["metier"]).'</th>
														<th>';
															
															if ($value["dispo"] == "1" or $value["dispo"] == "3") {

																
																$content.=fDate($value["date_deb"], "html") .' - '. fDate($value["date_fin"], "html");

															}else{

																//nb de semaine requis sur la candidature
																$weeks = getWeek();

																foreach ($weeks as $week) {

																	if ($week[0] == $value["semaine"]) {

																	
																		
																		$content.='<p>Semaine '.$week[0].' - du '.$week[1].' au '.$week[2].'</p>';

																		

																	}
																}

															}

															
														$content.='</th>
														<th>';
															
															
															
															
															if ($value["statut"] == "3") {
																
																if($value["ent_ok"]=="0"){
															
																	
																	$content.= '<span class="colorred">en attente de la signature de l\'entreprise</span>';
																	
																}else{
																	
																	if($value["elv_ok"]=="0"){
																		
																		$content.= '<a href="'.get_site_url().'/modifier-convention/?cand='.$candhash.'#entsignaturesign" class="colorred">en attente de votre signature</span>';
																		
																	}else{
																		
																		if($value["ref_ok"]=="0"){
																		
																			$content.= '<span class="colorred">en attente de la signature du référent</span>';
																			
																		}else{
																			
																			if($value["prof_ok"]=="0"){
																		
																				$content.= '<span class="colorred">en attente de la signature du professeur principale</span>';
																				
																			}else{
																				
																				if($value["etab_ok"]=="0"){
																		
																					$content.= '<span class="colorred">en attente de la signature du chef d\'établissement</span>';
																					
																				}else{
																					
																					$content.='<span class="colorgreen">Signé</span>';
																					
																				}
																				
																			}
																			
																		}
																		
																	}
																	
																}
													
																			
															}else{
																
																if ($value["statut"] == "1") $content.='en attente';
															else if ($value["statut"] == "2") $content.='Incomplète';
															else if ($value["statut"] == "3") $content.='Accepté';
															else if ($value["statut"] == "4") $content.='Refusé';
															else $content.='Non finalisé';	
															}
															
														$content.='</th>
														<th>';
															if($value["suspend"]=="0"){		
															if ($value["statut"] == "3") {

													
															   $content.='<a target=_blank class="btn btn-primary" href="'.get_site_url().'/modifier-convention/?cand='.$candhash.'" ><i class="fa fa-pencil" aria-hidden="true"></i></a>';
													
																$content.='<a target=blank href="'.get_template_directory_uri().'/print_convention.php?cand='.$candhash.'" class="btn btn-info"><i class="fa fa-print"></i></a>';
													

															
															} else if ($value["statut"] == "4") {

																

																$content.='<a target=_blank class="btn btn-warning"
																   href="'.get_site_url().'/voir-candidature/?cand='.$candhash.'"><i
																			class="fa fa-eye" aria-hidden="true"></i></a>';

															} else {

																
																$content.='<a target=_blank class="btn btn-warning" href="'.get_site_url().'/voir-candidature/?cand='.$candhash.'" ><i class="fa fa-eye" aria-hidden="true"></i></a>';
																
																$content.='<a class="btn btn-primary"
																   href="'.get_site_url().'/postuler/?elv='.$_GET["id"].'&cand='.$candhash.'"><i
																			class="fa fa-pencil" aria-hidden="true"></i></a>';
																$content.='<a href="#deldata" class="btn btn-danger" role="button" data-toggle="modal"
																   data-id="'.$candhash.'" data-typ="supprimercand3"
																   onClick="aChpDel(this)" title="suppression"><i class="fa fa-trash-o"></i></a>';

															} 
															
															}else{
											
																	$content.= "Le compte de l'entreprise a été suspendu temporairement";
																	
																	
																}
														$content.='</th>

													</tr>';

													

												}
												
											}
											
											$content.='</tbody>
										</table>
									</div>';

									
									$content.='<div id="conventionstab" role="tabpanel" class="tab-pane">
				
										  
										  <table class="table width100" data-toggle="table" data-search="true" data-pagination="true" data-thead-classes="theadec">
											<thead>
												<tr>
													<th>Type de stage</th>
													<th>Intitulé du stage</th>
													<th>Période du stage</th>
													<th>Statut</th>
													<th>Action(s)</th>
												   
												</tr>
											</thead>
											<tbody>';
												
												
													$lstcand=lstData("mesconventionselv",$elv_id);
													
													foreach($lstcand as $value){
														
														$candhash=encryptIt($value["cand_id"],$_SESSION["hashsession"]);
													
												
												
												$candidaturesuspend="";if($value["suspend"]=="1")$candidaturesuspend="candidaturesuspend";
													
													$content.='<tr class="'.$candidaturesuspend.'">
													<th>'.($value["type_lib"]).'</th>
													<th>'.($value["metier"]).'</th>
													<th>';
													
													
													if($value["dispo"]=="1" or $value["dispo"]=="3"){
														
														
														$content.=fDate($value["date_deb"],"html").' - '.fDate($value["date_fin"],"html");
														
													}else{
														
														
														
														$weeks=getWeek();
														
														foreach($weeks as $week){
															
															if($week[0]==$value["semaine"]){
															
													
														
															$content.='<p>Semaine '.$week[0].' - du '.$week[1].' au '.$week[2].'</p>';
																
															
														
														
														

															}
														}

														
													}



													
													$content.='</th>
													<th>';
													
													if($value["ent_ok"]=="0"){
															
																	
																	$content.= '<span class="colorred">en attente de la signature de l\'entreprise</span>';
																	
																}else{
																	
																	if($value["elv_ok"]=="0"){
																		
																		$content.= '<a href="'.get_site_url().'/modifier-convention/?cand='.$candhash.'#entsignaturesign" class="colorred">en attente de votre signature</span>';
																		
																	}else{
																		
																		if($value["ref_ok"]=="0"){
																		
																			$content.= '<span class="colorred">en attente de la signature du référent</span>';
																			
																		}else{
																			
																			if($value["prof_ok"]=="0"){
																		
																				$content.= '<span class="colorred">en attente de la signature du professeur principale</span>';
																				
																			}else{
																				
																				if($value["etab_ok"]=="0"){
																		
																					$content.= '<span class="colorred">en attente de la signature du chef d\'établissement</span>';
																					
																				}else{
																					
																					$content.='<span class="colorgreen">Signé</span>';
																					
																				}
																				
																			}
																			
																		}
																		
																	}
																	
																}
													
													
													$content.='</th>
													
													<th>';
													if($value["suspend"]=="0"){
													$content.='<a class="btn btn-primary" href="'.get_site_url().'/modifier-convention/?cand='.$candhash.'" ><i class="fa fa-pencil" aria-hidden="true"></i></a>';
													
													$content.='<a target=blank href="'.get_template_directory_uri().'/print_convention.php?cand='.$candhash.'" class="btn btn-info"><i class="fa fa-print"></i></a>';
													
													}else{
											
																	$content.= "Le compte de l'entreprise a été suspendu temporairement";
																	
																	
																}
													$content.='</th>
													
												</tr>';	
												
												
												
												}
												
												
											$content.='</tbody>
										</table>
								
								
								
								
									</div>

								</div>

							</div>';
							
						}
					
					
					
					echo $content;
					
					break;
					case "postulerel":
						
						$content='';
						
						 if (lgchkpeda() and isset($_GET["id"])) {

							$peda_id = decryptIt($_SESSION["peda_id"], $_SESSION["hashsession"]);
							
							$content.='<table class="table width100" data-url="inc/json-inc.php?typ=listeeleve" data-toggle="table"
                           data-search="true" data-pagination="true" data-thead-classes="theadec">
								<thead>
								<tr>
									<th>Nom</th>
									<th>Prénom</th>
									 <th>Classe</th>
									
									<th class="ctr" >Postuler</th>
								</tr>
								</thead>

								<tbody>';
								

								$lstelv = lstData("lstlvsuivi", $peda_id);


								foreach ($lstelv as $value) {

									$elv_hash = encryptIt($value["elv_id"], $_SESSION["hashsession"]);

									

									$content.='<tr>
										<th>'.($value["elv_nom"]).'</th>
										<th>'.($value["elv_pren"]).'</th>
										<th>'.($value["elv_class"]).'</th>
										
										 <th><a href="'.get_site_url().'/postuler/?elv='.$elv_hash.'&stage='.$_GET["id"].'" class="bouttonconnex" ><i class="fa fa-pencil" aria-hidden="true"></i> Postuler</a></th>
										

									</tr>';

									

								}

								
								$content.='</tbody>

							</table>';
							
						 }
						 
						 
						echo $content;
					
					
					break;
					
					case "uploadfile":
						
						$result="";
						
						if(file_exists($_FILES['file']['tmp_name']) && is_uploaded_file($_FILES['file']['tmp_name']) and isset($_GET["cand"]) and isset($_GET["elementid"])){
							
							$cand_id=decryptIt($_GET['cand'],$_SESSION["hashsession"]);
							
							$stmt = $conn->prepare("SELECT candidature.elv_id FROM candidature WHERE candidature.cand_id=:cand_id");
							$stmt->bindParam(':cand_id', $cand_id);
							$stmt->execute();
							$res = $stmt->fetch(PDO::FETCH_ASSOC);
							$stmt->closeCursor();
							
							$elv_id=$res["elv_id"];
							
							$stmt = $conn->prepare("SELECT convention.reference FROM convention WHERE convention.cand_id=:cand_id and convention.elv_id=:elv_id");
							$stmt->bindParam(':cand_id', $cand_id);
							$stmt->bindParam(':elv_id', $elv_id);
							$stmt->execute();
							$res = $stmt->fetch(PDO::FETCH_ASSOC);
							$stmt->closeCursor();
							
							$reference=$res["reference"];
							
							$infosfichier = pathinfo($_FILES['file']['name']);
							$extension_upload = $infosfichier['extension'];
							
							if(in_array($extension_upload,array("pdf"))){
								
								
								if(move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/signature/'. $reference.'.pdf')){
									
									$entlib="";
									$notif="";
									switch($_GET["elementid"]){
										
										
										case "entsignature":
											
											if(lgchkent()){
												
												$entlib="ent_ok";
												$notif="notif_elv=NULL, notif_peda=NULL,";
											}
											
										break;
										case "etabsignature":
											
											if(lgchkpeda()){
												
												$entlib="etab_ok";
												$notif="notif_ent=NULL,";
											}
											
										break;
										case "elvsignature":
											
											if(lgchkpeda() or lgchkelv()){
												
												$entlib="elv_ok";
												$notif="notif_ent=NULL,";
											}
											
										break;
										case "refsignature":
											
											if(lgchkpeda()){
												
												$entlib="ref_ok";
												$notif="notif_ent=NULL,";
											}
											
										break;
										case "profsignature":
										
											if(lgchkpeda()){
												
											$entlib="prof_ok";
											$notif="notif_ent=NULL,";
											}
											
										break;
										
									}
									
									if($entlib!=""){
										
									
										$stmt = $conn->prepare("UPDATE convention SET ".$notif." ".$entlib."=1 WHERE convention.cand_id=:cand_id and convention.elv_id=:elv_id");
										$stmt->bindParam(':cand_id', $cand_id);
										$stmt->bindParam(':elv_id', $elv_id);		
										$stmt->execute();
										$stmt->closeCursor();
										
										$result="1";
										
									}else{
									
										$result="errorbug";
										
									}
									
								}else{
									
									$result="errorupload";
									
								}
							
							}else if(in_array($extension_upload,array("jpg","png","gif"))){
									
									
									$filename=$_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/signature/'. $reference.'.pdf';
									 
									$mpdf = new mPDF();
									$file = $_FILES['file']['tmp_name'];
								   $size =  getimagesize ( $file );
								   $width = $size[0];
								   $height = $size[1];
								   $mpdf->WriteHTML('');
								   $mpdf->Image($file,60,50,$width,$height,'jpg','',true, true);
								   $mpdf->Output($filename,"F");
								
								
							}else{
									
								$result="errorext";
							
							}
						}else{
									
							$result="error";
							
						}
						
								
						echo $result;		
				
				
				
			break;
			case "viewnotifcandent":
			
				if(lgchkent()){
					
					
					$ent_id=decryptIt($_SESSION["ent_id"],$_SESSION["hashsession"]);
					
					
					$stmt2 = $conn->prepare("UPDATE candidature left join stage on stage.stage_id=candidature.stage_id SET candidature.notif_ent=NOW() WHERE stage.ent_id=:ent_id");
					$stmt2->bindParam(':ent_id', $ent_id);			
					$stmt2->execute();
					$stmt2->closeCursor();
						
				}
				
				echo "1";
			
			
			break;
			case "viewnotifconvent":
			
				if(lgchkent()){
					
					
					$ent_id=decryptIt($_SESSION["ent_id"],$_SESSION["hashsession"]);
					
					
					$stmt2 = $conn->prepare("UPDATE convention left join candidature on candidature.cand_id=convention.cand_id left join stage on stage.stage_id=candidature.stage_id SET convention.notif_ent=NOW() WHERE stage.ent_id=:ent_id");
					$stmt2->bindParam(':ent_id', $ent_id);			
					$stmt2->execute();
					$stmt2->closeCursor();
						
				}
				
				echo "1";
			
			
			break;
			case "viewnotifcandelv1":
			
				if(lgchkelv()){
					
					
					$elv_id=decryptIt($_SESSION["elv_id"],$_SESSION["hashsession"]);
					
					
					$stmt2 = $conn->prepare("UPDATE candidature left join stage on stage.stage_id=candidature.stage_id SET candidature.notif_elv=NOW() WHERE stage.type_id=1 and candidature.elv_id=:elv_id");
					$stmt2->bindParam(':elv_id', $elv_id);			
					$stmt2->execute();
					$stmt2->closeCursor();
						
				}
				
				echo "1";
			
			
			break;
			case "viewnotifcandelv2":
			
				if(lgchkelv()){
					
					
					$elv_id=decryptIt($_SESSION["elv_id"],$_SESSION["hashsession"]);
					
					
					$stmt2 = $conn->prepare("UPDATE candidature left join stage on stage.stage_id=candidature.stage_id SET candidature.notif_elv=NOW() WHERE stage.type_id=2 and candidature.elv_id=:elv_id");
					$stmt2->bindParam(':elv_id', $elv_id);			
					$stmt2->execute();
					$stmt2->closeCursor();
						
				}
				
				echo "1";
			
			
			break;
			case "viewnotifcandelv3":
			
				if(lgchkelv()){
					
					
					$elv_id=decryptIt($_SESSION["elv_id"],$_SESSION["hashsession"]);
					
					
					$stmt2 = $conn->prepare("UPDATE candidature left join stage on stage.stage_id=candidature.stage_id SET candidature.notif_elv=NOW() WHERE stage.type_id=3 and candidature.elv_id=:elv_id");
					$stmt2->bindParam(':elv_id', $elv_id);			
					$stmt2->execute();
					$stmt2->closeCursor();
						
				}
				
				echo "1";
			
			
			break;
			case "viewnotifconvelv":
			
				if(lgchkelv()){
					
					
					$elv_id=decryptIt($_SESSION["elv_id"],$_SESSION["hashsession"]);
					
					
					$stmt2 = $conn->prepare("UPDATE convention left join candidature on candidature.cand_id=convention.cand_id left join stage on stage.stage_id=candidature.stage_id SET convention.notif_elv=NOW() WHERE convention.elv_id=:elv_id");
					$stmt2->bindParam(':elv_id', $elv_id);			
					$stmt2->execute();
					$stmt2->closeCursor();
						
				}
				
				echo "1";
			
			
			break;
			case "viewnotifcandpeda1":
			
				if(lgchkpeda() and isset($_GET["id"])){
					
					
					$elv_id=decryptIt($_GET["id"],$_SESSION["hashsession"]);
					
					
					$stmt2 = $conn->prepare("UPDATE candidature left join stage on stage.stage_id=candidature.stage_id SET candidature.notif_peda=NOW() WHERE stage.type_id=1 and candidature.elv_id=:elv_id");
					$stmt2->bindParam(':elv_id', $elv_id);			
					$stmt2->execute();
					$stmt2->closeCursor();
						
				}
				
				echo "1";
			
			
			break;
			case "viewnotifcandpeda2":
			
				if(lgchkpeda() and isset($_GET["id"])){
					
					
					$elv_id=decryptIt($_GET["id"],$_SESSION["hashsession"]);
					
					
					$stmt2 = $conn->prepare("UPDATE candidature left join stage on stage.stage_id=candidature.stage_id SET candidature.notif_peda=NOW() WHERE stage.type_id=2 and candidature.elv_id=:elv_id");
					$stmt2->bindParam(':elv_id', $elv_id);			
					$stmt2->execute();
					$stmt2->closeCursor();
						
				}
				
				echo "1";
			
			
			break;
			case "viewnotifcandpeda3":
			
				if(lgchkpeda() and isset($_GET["id"])){
					
					
					$elv_id=decryptIt($_GET["id"],$_SESSION["hashsession"]);
					
					
					$stmt2 = $conn->prepare("UPDATE candidature left join stage on stage.stage_id=candidature.stage_id SET candidature.notif_peda=NOW() WHERE stage.type_id=3 and candidature.elv_id=:elv_id");
					$stmt2->bindParam(':elv_id', $elv_id);			
					$stmt2->execute();
					$stmt2->closeCursor();
						
				}
				
				echo "1";
			
			
			break;
			case "viewnotifconvpeda":
			
				if(lgchkpeda() and isset($_GET["id"])){
					
					
					$elv_id=decryptIt($_GET["id"],$_SESSION["hashsession"]);
					
					
					$stmt2 = $conn->prepare("UPDATE convention left join candidature on candidature.cand_id=convention.cand_id left join stage on stage.stage_id=candidature.stage_id SET convention.notif_peda=NOW() WHERE convention.elv_id=:elv_id");
					$stmt2->bindParam(':elv_id', $elv_id);			
					$stmt2->execute();
					$stmt2->closeCursor();
						
				}
				
				echo "1";
			
			
			break;
			case "changepublish":
				
				$content="";
				if(lgchkent() and isset($_GET["id"])){
					
					$stage_id=decryptIt($_GET["id"],$_SESSION["hashsession"]);
					
					$ent_id=decryptIt($_SESSION["ent_id"],$_SESSION["hashsession"]);
					
					$stmt = $conn->prepare("SELECT stage.publish FROM stage WHERE stage.stage_id = :stage_id and stage.ent_id = :ent_id");
					$stmt->bindParam(':stage_id', $stage_id);
					$stmt->bindParam(':ent_id', $ent_id);
					$stmt->execute();
					
					if($stmt->rowCount()>0){
						
						$res = $stmt->fetch(PDO::FETCH_ASSOC);
						
						$publish=$res["publish"];
						
						if($publish=="1"){
							
							$stmt = $conn->prepare("UPDATE stage SET publish=0 WHERE stage.stage_id=:stage_id");
							$stmt->bindParam(':stage_id', $stage_id);
							$stmt->execute();
							$stmt->closeCursor();
							
							$content='0';
						
						}else{
							
							$stmt = $conn->prepare("UPDATE stage SET publish=1 WHERE stage.stage_id=:stage_id");
							$stmt->bindParam(':stage_id', $stage_id);
							$stmt->execute();
							$stmt->closeCursor();
							
							$content='1';
							
						}
					
						
						
					}
					$stmt->closeCursor();
					
					
						
				}
				
				echo $content;
			
			
			break;
			
			}
			
		}else
		$err = "connerr";

	return $err;

} catch
(PDOException $e) {
	$err = $e;
	$conn = null;
	return $err;
}


?>
