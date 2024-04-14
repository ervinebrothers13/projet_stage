
<div id="addoffer">
<div class="step">Etape 3 sur 4</div>
<div class="steplib">CV et lettre de motivation</div>
<div class="fr-stepper__steps2" data-fr-current-step="3" data-fr-steps="4"></div>
<i>Etape suivant : Récapitulatif</i>

</br></br>
<form id="addstage1-form" enctype="multipart/form-data" method="POST" action="<?php echo get_template_directory_uri(); ?>/actiondev2.php?act=postuler3">
<input type="hidden" name="cand_id" value="<?php echo $candhash; ?>" />
<div class="row">
	<div class="col-md-6">
		<h3>Votre curriculum vitae</h3>
		<label for="userexp">Expériences professionnels précédentes (Facultatif) :</label>
		<textarea id="userexp" name="userexp" rows="6" class="form-control"><?php echo ($tabeleve["elv_cv"]); ?></textarea>
		<br>
	</div>
	<div class="col-md-6 smallradio">
		<div class="fenetreconseil">
			<div class="fenetreconseilgauche">
				<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
			</div>
			<div class="fenetreconseildroite">
				<h3 class="fenetreconseil_title">Conseil</h3>
				<p>Si vous avez effectué d'autres stages ou avez de l'expérience dans le domaine du stage demandé. Vous pouvez l'ajouter ici pour motiver l'entreprise</p>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<label for="useractivite">Activités extra-scolaires (Facultatif) :<i>Sports, loisirs, engagements associatifs, etc.</i></label>
		<textarea id="useractivite" name="useractivite" rows="6" class="form-control"><?php echo ($tabeleve["elv_activite"]); ?></textarea>
		<br>
	</div>
	<div class="col-md-6 smallradio">
		<div class="fenetreconseil">
			<div class="fenetreconseilgauche">
				<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
			</div>
			<div class="fenetreconseildroite">
				<h3 class="fenetreconseil_title">Conseil</h3>
				<p>Si vous avez effectué des activités sportifs, des loisirs ou autres pour montrer vos centres d'intérêts</p>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<label for="userlangue">Langues vivantes :<i>Langues étudiées et/ou parlées</i></label>
		<textarea id="userlangue" name="userlangue" class="form-control"><?php echo ($tabeleve["elv_lang"]); ?></textarea>
		<br>
	</div>
	
</div>
<div class="row">
	<div class="col-md-6">
		<h3>Votre motivation</h3>
		<label for="usermotivation">Pourquoi ce stage me motive :</label>
		<textarea id="usermotivation" name="usermotivation" rows=6 class="form-control"><?php echo ($tabcand["cand_motiv"]); ?></textarea>
		<br>
	</div>
	<div class="col-md-6 smallradio">
		<div class="fenetreconseil">
			<div class="fenetreconseilgauche">
				<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
			</div>
			<div class="fenetreconseildroite">
				<h3 class="fenetreconseil_title">Conseil</h3>
				<p>Relisez-vous pour éviter les fautes d'orthographe et utilisez une formule de politesse pour conclure</p>
			</div>
		</div>
	</div>
	
</div>
  <hr>
  <div class="row">
	<div class="col-md-6">
		<label for="usermotivation">Téléverser mon cv (Facultatif) (format pdf) :</label>
		<input type="file" name="cveleve" id="cveleve" class="form-control"/>
		
		<?php

            if ($tabeleve["elv_cvpdf"] != "" and $tabeleve["elv_cvpdf"] != null) {

				?>
				<div class="row margintop10">
					<div class="col-lg-3">
						<a target=_blank href="<?php echo get_site_url(); ?>/wp-content/uploads/cvpdf/<?php echo $tabeleve["elv_cvpdf"]; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/pdf.png" width="50" height="50"/></a>
					</div>
					<div class="col-lg-4">
						<div class="suppcv cursorpointer btn btn-danger" data-cand="<?php echo $_GET["cand"]; ?>" onclick="supprimercvelv2(this)"><i class="fa fa-trash" aria-hidden="true"></i> Supprimer mon CV
						</div>
					</div>
				</div>
				<?php

			}

			?>
							
		<br>
	</div>
	<div class="col-md-6 smallradio">
		<div class="fenetreconseil">
			<div class="fenetreconseilgauche">
				<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
			</div>
			<div class="fenetreconseildroite">
				<h3 class="fenetreconseil_title">Conseil</h3>
				<p>Fournir un CV pourrait motiver l'entreprise à accepter votre candidature</p>
			</div>
		</div>
	</div>
	
</div>

<div class="col-lg-12">
        <a href="<?php echo get_site_url(); ?>/postuler/?etape=2&cand=<?php echo $candhash; ?>" class="btn btn-secondary"><i class="fa fa-mail-reply"></i> Précédent</a>
        <button type="submit" class="btn btn-warning"> Suivant</button>
		<?php if(lgchkpeda()){ ?>
		
			<br><a href="<?php echo get_site_url(); ?>/espace-pedagogique/" class="btn btn-default"><i class="fa fa-user"></i> Retour</a>
        
		
		<?php }else{ ?>
		
			<br><br> <a href="<?php echo get_site_url(); ?>/espace-eleve/" class="btn btn-primary"><i class="fa fa-user"></i> Retour</a>
		
		<?php } ?>
 </div>
</form>
