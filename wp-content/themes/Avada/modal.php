<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="deldata" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
				<h4 class="modal-title">Confirmation de <span class="tdel"></span></h4>
			</div>
            <div class="modal-body">
                <center>Voulez-vous vraiment effectuer cette <span class="tdel"></span> ?</center>
                <form name="frmDel" id="frmDel" method="post" action="<?php echo get_template_directory_uri(); ?>/actiondev2.php">
                    <input type="hidden" name="chpiddel" id="chpiddel" value="">
                    <input type="hidden" name="chpidp" id="chpidp" value=""> <!-- Sert pour des suppressions d'objets dans une liste dans les pages de visu ou maj-->
                    <input type="hidden" name="act" id="actdel" value="">
                    <input type="hidden" name="rtn" id="rtn" value="<?php if(isset($rtn)) echo($rtn);?>"><!-- variable facultative pour savoir s'il faut revenir sur une page de visu ou maj. $rtn est initialisé dans la page parent-->
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Annuler</button>
                <button class="btn btn-danger" data-dismiss="modal" onClick="document.getElementById('frmDel').submit();">Valider</button>
            </div>
		</div>
	</div>
</div>


<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="acceptdata" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
				<h4 class="modal-title">Acceptation candidature</h4>
			</div>
            <div class="modal-body">
                <center>Voulez-vous vraiment effectuer cette action ?</center>
                <form name="frmaccept" id="frmaccept" method="post" action="<?php echo get_template_directory_uri(); ?>/actiondev2.php">
                    <input type="hidden" name="chpidaccept" id="chpidaccept" value="">
                    <input type="hidden" name="act" id="actaccept" value="">
                    </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Annuler</button>
                <button class="btn btn-danger" data-dismiss="modal" onClick="document.getElementById('frmaccept').submit();">Valider</button>
            </div>
		</div>
	</div>
</div>


<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="refusdata" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
				<h4 class="modal-title">Refus candidature</h4>
			</div>
            <div class="modal-body">
                <center>Voulez-vous vraiment effectuer cette action ?</center>
                <form name="frmrefus" id="frmrefus" method="post" action="<?php echo get_template_directory_uri(); ?>/actiondev2.php">
                    <input type="hidden" name="chpidrefus" id="chpidrefus" value="">
                    <input type="hidden" name="act" id="actrefus" value="">
                   </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Annuler</button>
                <button class="btn btn-danger" data-dismiss="modal" onClick="document.getElementById('frmrefus').submit();">Valider</button>
            </div>
		</div>
	</div>
</div>



<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="postulerelv" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
				<h4 class="modal-title">Postuler pour un élève</h4>
			</div>
            <div class="modal-body" id="postulerelvdiv">
                
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Annuler</button>
               
            </div>
		</div>
	</div>
</div>



<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="voireleve" class="modal <?php if(isset($_GET["showelv"])){ echo "in"; }else{ echo "fade"; }?>">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
				<h4 class="modal-title">Voir la fiche de l'élève <span id="voirelevename">
				<?php if(isset($_GET["showelv"]) and $_GET["showelv"]!=0){ 
					
					$elv_id=decryptIt($_GET["showelv"],$_SESSION["hashsession"]);
					$tabelv=recdata("eleve",$elv_id);
					
					echo ($tabelv["elv_nom"]." ".$tabelv["elv_pren"]);

				} ?></span></h4>
			</div>
            <div class="modal-body" id="voirelevediv">
				
				<?php
				
				
				$content="";
					
						if(isset($_GET["showelv"])){
							
							$elv_id=decryptIt($_GET["showelv"],$_SESSION["hashsession"]);
							
							$tabnotifcand1=recData("pedanotificationcand1",$elv_id);
							$tabnotifcand2=recData("pedanotificationcand2",$elv_id);
							$tabnotifcand3=recData("pedanotificationcand3",$elv_id);
							$tabnotifconv=recData("pedanotificationconv",$elv_id);
							
							$onglet="3eme";
							if(isset($_GET["ong2"]))$onglet=$_GET["ong2"];
							
						$content.='<div class="row">
								<header class="panel-heading tab-bg-dark-navy-blue col-md-3">
									<ul class="nav nav-tabs mb-2" id="myTab2" role="tablist">
										
										<li class="nav-item" data-elv="'.$_GET["showelv"].'" onclick="viewnotifcandpeda1(this)">
											<a class="nav-link ';
											if($onglet=="3eme"){
												$content.='active';
											 }
											
											$content.='" onclick="changetab(this)" data-toggle="tab" role="tab" aria-controls="troisemetab"
											   aria-selected="false" href="#troisemetab">Candidatures 3ème';
											   
					
												if($tabnotifcand1["NB"]>0){
							
							
													$content.='<span id="notificationcand1"><i class="fa fa-bell fontsize17px animateringring" aria-hidden="true"></i>'.$tabnotifcand1["NB"].'</Span>';
						
							
												}
						
											   
											   
											   $content.='</a>
										</li>
										<li class="nav-item" data-elv="'.$_GET["showelv"].'" onclick="viewnotifcandpeda2(this)">
											<a class="nav-link ';
											if($onglet=="pfmp"){
												$content.='active';
											 }
											
											$content.='" onclick="changetab(this)" data-toggle="tab" role="tab" aria-controls="pfmptab"
											   aria-selected="false" href="#pfmptab">Candidatures PFMP';
											   
					
												if($tabnotifcand2["NB"]>0){
							
							
													$content.='<span id="notificationcand2"><i class="fa fa-bell fontsize17px animateringring" aria-hidden="true"></i>'.$tabnotifcand2["NB"].'</Span>';
						
							
												}
						
											   
											   
											   $content.='</a>
										</li>
										<li class="nav-item" data-elv="'.$_GET["showelv"].'" onclick="viewnotifcandpeda3(this)">
											<a class="nav-link ';
											if($onglet=="bts"){
												$content.='active';
											 }
											
											$content.='" onclick="changetab(this)" data-toggle="tab" role="tab" aria-controls="btstab"
											   aria-selected="false" href="#btstab">Candidatures BTS';
											   
					
												if($tabnotifcand3["NB"]>0){
							
							
													$content.='<span id="notificationcand3"><i class="fa fa-bell fontsize17px animateringring" aria-hidden="true"></i>'.$tabnotifcand3["NB"].'</Span>';
						
							
												}
						
											   
											   
											   $content.='</a>
										</li>
										<li class="nav-item" data-elv="'.$_GET["showelv"].'" onclick="viewnotifconvpeda(this)">
											<a class="nav-link ';
											if($onglet=="convention"){
												$content.='active';
											 }
											
											$content.='" onclick="changetab(this)" data-toggle="tab" role="tab" aria-controls="conventionstab"
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
										 class="tab-pane offrecontentclass ';
										 if($onglet=="3eme"){
											$content.='active';
										 }
										 $content.='">
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
																   href="'.get_site_url().'/postuler/?elv='.$_GET["showelv"].'&cand='.$candhash.'"><i
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
									</div>

									
									<div id="pfmptab" role="tabpanel"
										 class="tab-pane offrecontentclasspfmp ';
										 if($onglet=="pfmp"){
											$content.='active';
										 }
										 $content.='">
										
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
																   href="'.get_site_url().'/postuler/?elv='.$_GET["showelv"].'&cand='.$candhash.'"><i
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

									</div>
									<div id="btstab" role="tabpanel"
										 class="tab-pane offrecontentclass ';
										 if($onglet=="bts"){
											$content.='active';
										 }
										 $content.='">
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
																   href="'.get_site_url().'/postuler/?elv='.$_GET["showelv"].'&cand='.$candhash.'"><i
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
									</div>

									<div id="conventionstab" role="tabpanel" class="tab-pane ';
										 if($onglet=="convention"){
											$content.='active';
										 }
										 $content.='">
				
										  
										  <table class="table width100" data-toggle="table" data-search="true" data-pagination="true" data-thead-classes="theadec">
											<thead>
												<tr>
													<th>Type de stage</th>
													<th>Intitulé du stage</th>
													<th>Période du stage</th>
													<th>Statut</th>
													<th>Actions(s)</th>
												   
												</tr>
											</thead>
											<tbody>';
												
												
													$lstcand=lstData("mesconventionselv",$elv_id);
													
													foreach($lstcand as $value){
														
														$candhash=encryptIt($value["cand_id"],$_SESSION["hashsession"]);
													
												
												
												$content.='<tr>
													<th>'.($value["type_lib"]).'</th>
													<th>'.($value["metier"]).'</th>
													<th>';
													
													
													if($value["dispo"]=="1" or $value["dispo"]=="3"){
														
														
														$content.=fDate($value["date_deb"],"html").' - '.fDate($value["date_fin"],"html");
														
													}else{
														
														
														
														$weeks=getWeek();
														
														foreach($weeks as $week){
															
															if($week[0]==$value["semaine"]){
															
													
														
															$content.='<p>Semaine '.$week[0].' - du '.$week[1].' au '.$week[2].'<p>';
																
															
														
														
														

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
						
						?>
						
                
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Annuler</button>
               
            </div>
		</div>
	</div>
</div>

