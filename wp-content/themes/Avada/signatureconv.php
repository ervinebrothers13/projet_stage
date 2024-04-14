

<h3>Signature par les différents parties</h3>
<i class="colorred">Ne charger que la page contenant les signatures des différents parties</i>
</br><i class="colorgreen">Astuce pour le professeur référent : Imprimer la partie signature ou la convention entière et faites la signer par l'élève, le professeur principale, le chef d'établissement et vous même, puis charger ce même document (seulement la page 5 des signatures) pour les 4 entités, une à une.</i>
</br></br>
<ul>
	<li class="marginbottom10">L'entreprise : <?php if($tabconvention["ent_ok"]=="1"){ ?><span id="entsignaturesign" class="colorgreen">Signé</span><?php }else{ ?><span id="entsignaturesign" class="colorred">Pas encore signé</span><?php } ?>
	
	<?php if(lgchkent()){ ?>
	<input type="file" id="entsignaturebutton" class="displaynone2" /><button id="entsignature" class="btn btn-info marginleft20" onclick="file_explorer(this);" >Charger ma signature</button><span id="entsignatureerror" class="colorred signatureerror"></span>
	<?php } ?>
	
	</li>
	
	<li class="marginbottom10">L'élève ou son représentant légal (si mineur) : 
	<?php if($tabconvention["ent_ok"]=="1"){ ?>
	<?php if($tabconvention["elv_ok"]=="1"){ ?><span id="elvsignaturesign" class="colorgreen">Signé</span><?php }else{ ?><span id="elvsignaturesign" class="colorred">Pas encore signé</span><?php } ?> 
	<?php if(lgchkelv() or lgchkpeda()){ ?>
	<input type="file" id="elvsignaturebutton" class="displaynone2" /><button id="elvsignature" class="btn btn-info marginleft20" onclick="file_explorer(this);">Charger ma signature</button><span id="elvsignatureerror" class="colorred signatureerror"></span>
	<?php } ?>
	<?php }else{ ?>
	
	<span class="colorred" >En attente de la signature de l'entreprise</span>
	
	<?php } ?>
	</li>
	
	<li class="marginbottom10">L'enseignant référent : 
	<?php if($tabconvention["ent_ok"]=="1" && $tabconvention["elv_ok"]=="1"){ ?>
	<?php if($tabconvention["ref_ok"]=="1"){ ?><span id="refsignaturesign" class="colorgreen">Signé</span><?php }else{ ?><span id="refsignaturesign" class="colorred">Pas encore signé</span><?php } ?>
	<?php if(lgchkpeda()){ ?>
	<input type="file" id="refsignaturebutton" class="displaynone2" /><button id="refsignature" class="btn btn-info marginleft20" onclick="file_explorer(this);">Charger ma signature</button><span id="refsignatureerror" class="colorred signatureerror"></span>
	<?php } ?>
	<?php }else{ ?>
			
			<?php if($tabconvention["ent_ok"]=="1" && $tabconvention["elv_ok"]=="0"){ ?>
			<span class="colorred" >En attente de la signature de l'élève</span>
			<?php }else{ ?>
			<span class="colorred" >En attente de la signature de l'entreprise</span>
			<?php } ?>
	<?php } ?>
	</li>
	<li class="marginbottom10">Le professeur principale : 
	<?php if($tabconvention["ent_ok"]=="1" && $tabconvention["elv_ok"]=="1" && $tabconvention["ref_ok"]=="1"){ ?>
	<?php if($tabconvention["prof_ok"]=="1"){ ?><span id="profsignaturesign" class="colorgreen">Signé</span><?php }else{ ?><span id="profsignaturesign" class="colorred">Pas encore signé</span><?php } ?>
	<?php if(lgchkpeda()){ ?>
	<input type="file" id="profsignaturebutton" class="displaynone2" /><button id="profsignature" class="btn btn-info marginleft20" onclick="file_explorer(this);">Charger ma signature</button><span id="profsignatureerror" class="colorred signatureerror"></span>
	<?php } ?>
	<?php }else{ ?>
	
			<?php if($tabconvention["ent_ok"]=="1" && $tabconvention["elv_ok"]=="1" && $tabconvention["ref_ok"]=="0"){ ?>
			<span class="colorred" >En attente de la signature du référent</span>
			<?php }else if($tabconvention["ent_ok"]=="1" && $tabconvention["elv_ok"]=="0"){ ?>
			<span class="colorred" >En attente de la signature de l'élève</span>
			<?php }else{ ?>
			<span class="colorred" >En attente de la signature de l'entreprise</span>
			<?php } ?>
	<?php } ?>
	
	</li>
	<li class="marginbottom10">Le chef d'établissement : 
	<?php if($tabconvention["ent_ok"]=="1" && $tabconvention["elv_ok"]=="1" && $tabconvention["ref_ok"]=="1" && $tabconvention["prof_ok"]=="1"){ ?>
	<?php if($tabconvention["etab_ok"]=="1"){ ?><span id="etabsignaturesign" class="colorgreen">Signé</span><?php }else{ ?><span id="etabsignaturesign" class="colorred">Pas encore signé</span><?php } ?> 
	<?php if(lgchkpeda()){ ?>
	<input type="file" id="etabsignaturebutton" class="displaynone2" /><button id="etabsignature" class="btn btn-info marginleft20" onclick="file_explorer(this);" >Charger ma signature</button><span id="etabsignatureerror" class="colorred signatureerror"></span>
	<?php } ?>
	<?php }else{ ?>
	
			<?php if($tabconvention["ent_ok"]=="1" && $tabconvention["elv_ok"]=="1" && $tabconvention["ref_ok"]=="1" && $tabconvention["prof_ok"]=="0"){ ?>
			<span class="colorred" >En attente de la signature du professeur principale</span>
			<?php }else if($tabconvention["ent_ok"]=="1" && $tabconvention["elv_ok"]=="1" && $tabconvention["ref_ok"]=="0"){ ?>
			<span class="colorred" >En attente de la signature du référent</span>
			<?php }else if($tabconvention["ent_ok"]=="1" && $tabconvention["elv_ok"]=="0"){ ?>
			<span class="colorred" >En attente de la signature de l'élève</span>
			<?php }else{ ?>
			<span class="colorred" >En attente de la signature de l'entreprise</span>
			<?php } ?>
	<?php } ?>
	</li>
	
	
</ul>

<?php

if(file_exists($_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/signature/'.$tabconvention["reference"].'.pdf')){
	
?>
</br></br>
<!--<iframe id="partiesignature" width="100%" height="600" src="<?php echo get_site_url(); ?>/wp-content/uploads/signature/<?php echo $tabconvention["reference"]; ?>.pdf" />-->

<iframe id="partiesignature" width="100%" height="600" src="<?php echo get_template_directory_uri(); ?>/showsignature.php?cand=<?php echo $_GET["cand"]; ?>" />

<?php }else{ ?>

</br><a target=blank href="<?php echo get_template_directory_uri(); ?>/print_signature.php?cand=<?php echo $_GET["cand"]; ?>" class="btn btn-success width100"><i class="fa fa-print marginright10"></i> Impression de la partie signature</a>


<?php } ?>

	