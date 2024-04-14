<?php
/**
 * Template Name:  Voir un eleve
 * Description: Pages voir profil d'un élève
 */
 

 
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}
?>
<?php get_header(); ?>
<!-- Load jQuery -->
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-ui.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-validation/jquery.validate.js"></script>
 <script src="<?php echo get_template_directory_uri(); ?>/js/jquery-validation/jquery.validate-fr.js"></script>
 <script src="<?php echo get_template_directory_uri(); ?>/js/jquery-validation/additional-methods.min.js"></script>

<section id="content" <?php Avada()->layout->add_style( 'content_style' ); ?>>
	
	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php echo fusion_render_rich_snippets_for_pages(); // phpcs:ignore WordPress.Security.EscapeOutput ?>

			<?php avada_singular_featured_image(); ?>

			<div class="post-content">
				<?php the_content(); ?>
				<?php fusion_link_pages(); ?>
			</div>
			<?php if ( ! post_password_required( $post->ID ) ) : ?>
				<?php do_action( 'avada_before_additional_page_content' ); ?>
				<?php if ( class_exists( 'WooCommerce' ) ) : ?>
					<?php $woo_thanks_page_id = get_option( 'woocommerce_thanks_page_id' ); ?>
					<?php $is_woo_thanks_page = ( ! get_option( 'woocommerce_thanks_page_id' ) ) ? false : is_page( get_option( 'woocommerce_thanks_page_id' ) ); ?>
					<?php if ( Avada()->settings->get( 'comments_pages' ) && ! is_cart() && ! is_checkout() && ! is_account_page() && ! $is_woo_thanks_page ) : ?>
						<?php comments_template(); ?>
					<?php endif; ?>
				<?php else : ?>
					<?php if ( Avada()->settings->get( 'comments_pages' ) ) : ?>
						<?php comments_template(); ?>
					<?php endif; ?>
				<?php endif; ?>
				<?php do_action( 'avada_after_additional_page_content' ); ?>
			<?php endif; // Password check. ?>
		</div>
	<?php endwhile; ?>
	
	
	<div class="row" id="profileleve">
		
		<header class="panel-heading tab-bg-dark-navy-blue col-xl-3">
				<ul class="nav nav-tabs mb-2" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" data-toggle="tab" role="tab" aria-controls="informationtab" aria-selected="true" href="#informationtab">Informations</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" role="tab" aria-controls="moncvtab" aria-selected="true" href="#moncvtab">Curriculum vitae</a>
				</li>
				<li class="nav-item">
					<a class="nav-link " data-toggle="tab" role="tab" aria-controls="troisemetab" aria-selected="false" href="#troisemetab">Candidatures 3ème</a>
				</li>
				<li class="nav-item">
					<a class="nav-link " data-toggle="tab" role="tab" aria-controls="pfmptab" aria-selected="false" href="#pfmptab">Candidatures PFMP</a>
				</li>
				<li class="nav-item">
					<a class="nav-link retourliste" href="<?php echo get_site_url(); ?>/profil-enseignant/?ong=listeeleve" >Retour liste de vos élèves</a>
				</li>
				</ul>
		</header>			
		<div class="tab-content col-xl-9" id="myTabContent">
			
			<div id="informationtab" role="tabpanel" class="tab-pane active">
				
					<form id="addstage1-form" method="POST" action="<?php echo get_template_directory_uri(); ?>/action.php?act=postuler1">
						<h1>Modifier mes informations</h1>
						<div class="row">
							<div class="col-md-6">
								
								<label for="username">Nom :</label>
								<input type="text" id="username" name="username" value="test@test.com">
								<br>
							</div>
						
							<div class="col-md-6">
								<label for="userprename">prénom :</label>
								<input type="text" id="userprename" name="userprename" >
							
							</div>
						</div>	<br>
						<div class="row">
							<div class="col-md-6">
								<label for="usermail">Email :</label>
								<input type="email" id="usermail" name="usermail" >
								<br>
							</div>
							<div class="col-md-6">
								<label for="usertel">Téléphone :</label>
								<input type="text" id="usertel" name="usertel" >
								<br>
							</div>
						
					
							
						</div>
						<div class="row">
							<div class="col-md-6">
								<label for="userdatenais">Date de naissance :</label>
								<div class="input-group date" id="ddnais">
									<input type="text" name="chpddnais" id="chpddnais" class="form-control" required>
									<span class="input-group-addon btn-primary smallradio padding5"><i class="fa fa-calendar"></i></span>
								</div>
								<br>
							</div>
							<div class="col-md-6">
								<label for="usergeo">Adresse géographique :</label>
								<input type="text" id="usergeo" name="usergeo" >
								<br>
							</div>
						
							
						</div>
						<div class="row">
							<div class="col-md-6">
								<label for="useretab">Etablissement Scolaire fréquenté :</label>
								<select class="form-control" name="useretab" ></select>
								<br>
							</div>
							<div class="col-md-6">
								<label for="userclass">Classe:</label>
								<input type="text" id="userclass" name="userclass" >
								<br>
							</div>
						
						</div>
						<div class="row">
							
						
							<div class="col-md-6">
								<label for="userclass">Domaine d'étude:</label>
								<input type="text" id="userclass" name="userclass" >
								<br>
							</div>
						</div>
						<br>
						<br>
						<button class="bouttonconnex" type="submit">Modifier</button>
					</form>
				</div>
			<div id="moncvtab" role="tabpanel" class="tab-pane">
				<div class="row">
	<div class="col-md-6">
		<h3>Votre curriculum vitae</h3>
		<label for="userexp">Expériences professionnels précédentes (Facultatif) :</label>
		<textarea id="userexp" name="userexp" rows="6" class="form-control"></textarea>
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
	<div class="col-md-6">
		<label for="useractivite">Activités extra-scolaires (Facultatif) :<i>Sports, loisirs, engagements associatifs, etc.</i></label>
		<textarea id="useractivite" name="useractivite" rows="6" class="form-control"></textarea>
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
	<div class="col-md-6">
		<label for="userlangue">Langues vivantes :<i>Langues étudiées et/ou parlées</i></label>
		<textarea id="userlangue" name="userlangue" class="form-control"></textarea>
		<br>
	</div>
	
</div>

</hr>
				<div class="form-group row">
					<label class="control-label col-md-4" for="chpnum">Téléverser mon cv (Facultatif) (format pdf)</label>
					<div class="col-lg-4"><input type="file" name="cveleve" id="cveleve" class="form-control" /></div>
				</div>
				<embed src="<?php echo get_template_directory_uri(); ?>/images/pdf/CV_Ropiteau-iraia.pdf" width="100%" height="700" type="application/pdf">
			
			</div>
			<div id="monlettretab" role="tabpanel" class="tab-pane">
				<div class="form-group row">
					<label class="control-label col-md-4" for="chpnum">Téléverser une lettre de motivation</label>
					<div class="col-lg-4"><input type="file" name="lettreeleve" id="lettreeleve" class="form-control" /></div>
				</div>
				<embed src="<?php echo get_template_directory_uri(); ?>/images/pdf/Lettre Motivation Ropiteau Iraia.pdf" width="100%" height="700" type="application/pdf">
			
			</div>
			<div id="troisemetab" role="tabpanel" class="tab-pane offrecontentclass">
				
			<div class="row">
			<div class="col-lg-6" >
				<article>
					<div class="article_body">
						
							<div class="article_body_content">
								<h4 class="body_title">
									<a href="<?php echo get_site_url(); ?>/offre-stage/?id=55555" >Chef de cuisine, Commis de cuisi...</a>
								</h4>
								<div  class="body_detail">
									LA VILLA (LA VILLA)
								</div>
								<div  class="body_desc">
									<p class="body_lieu">Riorges</p>
									<div class="body_date">Du 29 janvier 2024 au  2 juin 2024</div>
								</div>
							</div>
					
					</div>
					<div  class="article_header">
						<div>
							<a href="<?php echo get_site_url(); ?>/offre-stage/?id=55555" ><img class="fr-responsive-img" src="<?php echo get_template_directory_uri(); ?>/images/categorie/hotellerie_restauration.svg" alt="secteur" data-fr-js-ratio="true"></a>
						</div>
						<ul class="categorielist">
							<li class="cateitemli">
								<a href="/offres-de-stage/47251" ><div class="cateitem">Hôtellerie, restauration</div></a>
							</li>
						</ul>
					</div>
					
				</article>
			</div>
			<div class="col-lg-6" >
				<article>
					<div class="article_body">
						
							<div class="article_body_content">
								<h4 class="body_title">
									<a href="<?php echo get_site_url(); ?>/offre-stage/?id=55555" >Chef de cuisine, Commis de cuisi...</a>
								</h4>
								<div  class="body_detail">
									LA VILLA (LA VILLA)
								</div>
								<div  class="body_desc">
									<p class="body_lieu">Riorges</p>
									<div class="body_date">Du 29 janvier 2024 au  2 juin 2024</div>
								</div>
							</div>
					
					</div>
					<div  class="article_header">
						<div>
							<a href="<?php echo get_site_url(); ?>/offre-stage/?id=55555" ><img class="fr-responsive-img" src="<?php echo get_template_directory_uri(); ?>/images/categorie/hotellerie_restauration.svg" alt="secteur" data-fr-js-ratio="true"></a>
						</div>
						<ul class="categorielist">
							<li class="cateitemli">
								<a href="/offres-de-stage/47251" ><div class="cateitem">Hôtellerie, restauration</div></a>
							</li>
						</ul>
					</div>
					
				</article>
			</div>
			<div class="col-lg-6" >
				<article>
					<div class="article_body">
						
							<div class="article_body_content">
								<h4 class="body_title">
									<a href="<?php echo get_site_url(); ?>/offre-stage/?id=55555" >Chef de cuisine, Commis de cuisi...</a>
								</h4>
								<div  class="body_detail">
									LA VILLA (LA VILLA)
								</div>
								<div  class="body_desc">
									<p class="body_lieu">Riorges</p>
									<div class="body_date">Du 29 janvier 2024 au  2 juin 2024</div>
								</div>
							</div>
					
					</div>
					<div  class="article_header">
						<div>
							<a href="<?php echo get_site_url(); ?>/offre-stage/?id=55555" ><img class="fr-responsive-img" src="<?php echo get_template_directory_uri(); ?>/images/categorie/hotellerie_restauration.svg" alt="secteur" data-fr-js-ratio="true"></a>
						</div>
						<ul class="categorielist">
							<li class="cateitemli">
								<a href="/offres-de-stage/47251" ><div class="cateitem">Hôtellerie, restauration</div></a>
							</li>
						</ul>
					</div>
					
				</article>
			</div>
			<div class="col-lg-6" >
				<article>
					<div class="article_body">
						
							<div class="article_body_content">
								<h4 class="body_title">
									<a href="<?php echo get_site_url(); ?>/offre-stage/?id=55555" >Chef de cuisine, Commis de cuisi...</a>
								</h4>
								<div  class="body_detail">
									LA VILLA (LA VILLA)
								</div>
								<div  class="body_desc">
									<p class="body_lieu">Riorges</p>
									<div class="body_date">Du 29 janvier 2024 au  2 juin 2024</div>
								</div>
							</div>
					
					</div>
					<div  class="article_header">
						<div>
							<a href="<?php echo get_site_url(); ?>/offre-stage/?id=55555" ><img class="fr-responsive-img" src="<?php echo get_template_directory_uri(); ?>/images/categorie/hotellerie_restauration.svg" alt="secteur" data-fr-js-ratio="true"></a>
						</div>
						<ul class="categorielist">
							<li class="cateitemli">
								<a href="/offres-de-stage/47251" ><div class="cateitem">Hôtellerie, restauration</div></a>
							</li>
						</ul>
					</div>
					
				</article>
			</div>
			<div class="col-lg-6" >
				<article>
					<div class="article_body">
						
							<div class="article_body_content">
								<h4 class="body_title">
									<a href="<?php echo get_site_url(); ?>/offre-stage/?id=55555" >Chef de cuisine, Commis de cuisi...</a>
								</h4>
								<div  class="body_detail">
									LA VILLA (LA VILLA)
								</div>
								<div  class="body_desc">
									<p class="body_lieu">Riorges</p>
									<div class="body_date">Du 29 janvier 2024 au  2 juin 2024</div>
								</div>
							</div>
					
					</div>
					<div  class="article_header">
						<div>
							<a href="<?php echo get_site_url(); ?>/offre-stage/?id=55555" ><img class="fr-responsive-img" src="<?php echo get_template_directory_uri(); ?>/images/categorie/hotellerie_restauration.svg" alt="secteur" data-fr-js-ratio="true"></a>
						</div>
						<ul class="categorielist">
							<li class="cateitemli">
								<a href="/offres-de-stage/47251" ><div class="cateitem">Hôtellerie, restauration</div></a>
							</li>
						</ul>
					</div>
					
				</article>
			</div><div class="col-lg-6" >
				<article>
					<div class="article_body">
						
							<div class="article_body_content">
								<h4 class="body_title">
									<a href="<?php echo get_site_url(); ?>/offre-stage/?id=55555" >Chef de cuisine, Commis de cuisi...</a>
								</h4>
								<div  class="body_detail">
									LA VILLA (LA VILLA)
								</div>
								<div  class="body_desc">
									<p class="body_lieu">Riorges</p>
									<div class="body_date">Du 29 janvier 2024 au  2 juin 2024</div>
								</div>
							</div>
					
					</div>
					<div  class="article_header">
						<div>
							<a href="<?php echo get_site_url(); ?>/offre-stage/?id=55555" ><img class="fr-responsive-img" src="<?php echo get_template_directory_uri(); ?>/images/categorie/hotellerie_restauration.svg" alt="secteur" data-fr-js-ratio="true"></a>
						</div>
						<ul class="categorielist">
							<li class="cateitemli">
								<a href="/offres-de-stage/47251" ><div class="cateitem">Hôtellerie, restauration</div></a>
							</li>
						</ul>
					</div>
					
				</article>
			</div>
			<div class="col-lg-6" >
				<article>
					<div class="article_body">
						
							<div class="article_body_content">
								<h4 class="body_title">
									<a href="<?php echo get_site_url(); ?>/offre-stage/?id=55555" >Chef de cuisine, Commis de cuisi...</a>
								</h4>
								<div  class="body_detail">
									LA VILLA (LA VILLA)
								</div>
								<div  class="body_desc">
									<p class="body_lieu">Riorges</p>
									<div class="body_date">Du 29 janvier 2024 au  2 juin 2024</div>
								</div>
							</div>
					
					</div>
					<div  class="article_header">
						<div>
							<a href="<?php echo get_site_url(); ?>/offre-stage/?id=55555" ><img class="fr-responsive-img" src="<?php echo get_template_directory_uri(); ?>/images/categorie/hotellerie_restauration.svg" alt="secteur" data-fr-js-ratio="true"></a>
						</div>
						<ul class="categorielist">
							<li class="cateitemli">
								<a href="/offres-de-stage/47251" ><div class="cateitem">Hôtellerie, restauration</div></a>
							</li>
						</ul>
					</div>
					
				</article>
			</div>
			<div class="col-lg-6" >
				<article>
					<div class="article_body">
						
							<div class="article_body_content">
								<h4 class="body_title">
									<a href="<?php echo get_site_url(); ?>/offre-stage/?id=55555" >Chef de cuisine, Commis de cuisi...</a>
								</h4>
								<div  class="body_detail">
									LA VILLA (LA VILLA)
								</div>
								<div  class="body_desc">
									<p class="body_lieu">Riorges</p>
									<div class="body_date">Du 29 janvier 2024 au  2 juin 2024</div>
								</div>
							</div>
					
					</div>
					<div  class="article_header">
						<div>
							<a href="<?php echo get_site_url(); ?>/offre-stage/?id=55555" ><img class="fr-responsive-img" src="<?php echo get_template_directory_uri(); ?>/images/categorie/hotellerie_restauration.svg" alt="secteur" data-fr-js-ratio="true"></a>
						</div>
						<ul class="categorielist">
							<li class="cateitemli">
								<a href="/offres-de-stage/47251" ><div class="cateitem">Hôtellerie, restauration</div></a>
							</li>
						</ul>
					</div>
					
				</article>
			</div>
			<div class="col-lg-6" >
				<article>
					<div class="article_body">
						
							<div class="article_body_content">
								<h4 class="body_title">
									<a href="<?php echo get_site_url(); ?>/offre-stage/?id=55555" >Chef de cuisine, Commis de cuisi...</a>
								</h4>
								<div  class="body_detail">
									LA VILLA (LA VILLA)
								</div>
								<div  class="body_desc">
									<p class="body_lieu">Riorges</p>
									<div class="body_date">Du 29 janvier 2024 au  2 juin 2024</div>
								</div>
							</div>
					
					</div>
					<div  class="article_header">
						<div>
							<a href="<?php echo get_site_url(); ?>/offre-stage/?id=55555" ><img class="fr-responsive-img" src="<?php echo get_template_directory_uri(); ?>/images/categorie/hotellerie_restauration.svg" alt="secteur" data-fr-js-ratio="true"></a>
						</div>
						<ul class="categorielist">
							<li class="cateitemli">
								<a href="/offres-de-stage/47251" ><div class="cateitem">Hôtellerie, restauration</div></a>
							</li>
						</ul>
					</div>
					
				</article>
			</div>
			
			
		</div>
				
				</div>
				<div id="pfmptab" role="tabpanel" class="tab-pane offrecontentclasspfmp">
				
				
				<div class="row">
			<div class="col-md-6" >
				<article>
				
					<div class="row">
						
						<a href="<?php echo get_site_url(); ?>/offre-stage/?id=55555" class="col-sm-5 contentimage" ><img class="fr-responsive-img" src="<?php echo get_template_directory_uri(); ?>/images/domaine/touristeresto.png" alt="secteur" data-fr-js-ratio="true"></a>
						
						<div class="col-sm-7" >
							<div class="article_body">
						
									<div class="article_body_content">
										<h4 class="body_title">
											<a href="<?php echo get_site_url(); ?>/offre-stage/?id=55555" >Chargé de client</a>
										</h4>
										<div  class="body_detail">
											Tahiti Pearl Beach Ressort
										</div>
										<div  class="body_desc">
											<p class="body_lieu">Arue</p>
											<div class="body_date">du 20 novembre au 20 décembre</div>
										</div>
									</div>
							
							</div>
							
						</div>
					</div>
					
				</article>
			</div>
			<div class="col-md-6" >
				<article>
				
					<div class="row">
						
						<a href="<?php echo get_site_url(); ?>/offre-stage/?id=55555" class="col-sm-5 contentimage" ><img class="fr-responsive-img" src="<?php echo get_template_directory_uri(); ?>/images/domaine/touristeresto.png" alt="secteur" data-fr-js-ratio="true"></a>
						
						<div class="col-sm-7" >
							<div class="article_body">
						
									<div class="article_body_content">
										<h4 class="body_title">
											<a href="<?php echo get_site_url(); ?>/offre-stage/?id=55555" >Chargé de client</a>
										</h4>
										<div  class="body_detail">
											Tahiti Pearl Beach Ressort
										</div>
										<div  class="body_desc">
											<p class="body_lieu">Arue</p>
											<div class="body_date">du 20 novembre au 20 décembre</div>
										</div>
									</div>
							
							</div>
							
						</div>
					</div>
					
				</article>
			</div>
			<div class="col-md-6" >
				<article>
				
					<div class="row">
						
						<a href="<?php echo get_site_url(); ?>/offre-stage/?id=55555" class="col-sm-5 contentimage" ><img class="fr-responsive-img" src="<?php echo get_template_directory_uri(); ?>/images/domaine/touristeresto.png" alt="secteur" data-fr-js-ratio="true"></a>
						
						<div class="col-sm-7" >
							<div class="article_body">
						
									<div class="article_body_content">
										<h4 class="body_title">
											<a href="<?php echo get_site_url(); ?>/offre-stage/?id=55555" >Chargé de client</a>
										</h4>
										<div  class="body_detail">
											Tahiti Pearl Beach Ressort
										</div>
										<div  class="body_desc">
											<p class="body_lieu">Arue</p>
											<div class="body_date">du 20 novembre au 20 décembre</div>
										</div>
									</div>
							
							</div>
							
						</div>
					</div>
					
				</article>
			</div>
			<div class="col-md-6" >
				<article>
				
					<div class="row">
						
						<a href="<?php echo get_site_url(); ?>/offre-stage/?id=55555" class="col-sm-5 contentimage" ><img class="fr-responsive-img" src="<?php echo get_template_directory_uri(); ?>/images/domaine/touristeresto.png" alt="secteur" data-fr-js-ratio="true"></a>
						
						<div class="col-sm-7" >
							<div class="article_body">
						
									<div class="article_body_content">
										<h4 class="body_title">
											<a href="<?php echo get_site_url(); ?>/offre-stage/?id=55555" >Chargé de client</a>
										</h4>
										<div  class="body_detail">
											Tahiti Pearl Beach Ressort
										</div>
										<div  class="body_desc">
											<p class="body_lieu">Arue</p>
											<div class="body_date">du 20 novembre au 20 décembre</div>
										</div>
									</div>
							
							</div>
							
						</div>
					</div>
					
				</article>
			</div>
			<div class="col-md-6" >
				<article>
				
					<div class="row">
						
						<a href="<?php echo get_site_url(); ?>/offre-stage/?id=55555" class="col-sm-5 contentimage" ><img class="fr-responsive-img" src="<?php echo get_template_directory_uri(); ?>/images/domaine/touristeresto.png" alt="secteur" data-fr-js-ratio="true"></a>
						
						<div class="col-sm-7" >
							<div class="article_body">
						
									<div class="article_body_content">
										<h4 class="body_title">
											<a href="<?php echo get_site_url(); ?>/offre-stage/?id=55555" >Chargé de client</a>
										</h4>
										<div  class="body_detail">
											Tahiti Pearl Beach Ressort
										</div>
										<div  class="body_desc">
											<p class="body_lieu">Arue</p>
											<div class="body_date">du 20 novembre au 20 décembre</div>
										</div>
									</div>
							
							</div>
							
						</div>
					</div>
					
				</article>
			</div>
			<div class="col-md-6" >
				<article>
				
					<div class="row">
						
						<a href="<?php echo get_site_url(); ?>/offre-stage/?id=55555" class="col-sm-5 contentimage" ><img class="fr-responsive-img" src="<?php echo get_template_directory_uri(); ?>/images/domaine/touristeresto.png" alt="secteur" data-fr-js-ratio="true"></a>
						
						<div class="col-sm-7" >
							<div class="article_body">
						
									<div class="article_body_content">
										<h4 class="body_title">
											<a href="<?php echo get_site_url(); ?>/offre-stage/?id=55555" >Chargé de client</a>
										</h4>
										<div  class="body_detail">
											Tahiti Pearl Beach Ressort
										</div>
										<div  class="body_desc">
											<p class="body_lieu">Arue</p>
											<div class="body_date">du 20 novembre au 20 décembre</div>
										</div>
									</div>
							
							</div>
							
						</div>
					</div>
					
				</article>
			</div>
			<div class="col-md-6" >
				<article>
				
					<div class="row">
						
						<a href="<?php echo get_site_url(); ?>/offre-stage/?id=55555" class="col-sm-5 contentimage" ><img class="fr-responsive-img" src="<?php echo get_template_directory_uri(); ?>/images/domaine/touristeresto.png" alt="secteur" data-fr-js-ratio="true"></a>
						
						<div class="col-sm-7" >
							<div class="article_body">
						
									<div class="article_body_content">
										<h4 class="body_title">
											<a href="<?php echo get_site_url(); ?>/offre-stage/?id=55555" >Chargé de client</a>
										</h4>
										<div  class="body_detail">
											Tahiti Pearl Beach Ressort
										</div>
										<div  class="body_desc">
											<p class="body_lieu">Arue</p>
											<div class="body_date">du 20 novembre au 20 décembre</div>
										</div>
									</div>
							
							</div>
							
						</div>
					</div>
					
				</article>
			</div>
			<div class="col-md-6" >
				<article>
				
					<div class="row">
						
						<a href="<?php echo get_site_url(); ?>/offre-stage/?id=55555" class="col-sm-5 contentimage" ><img class="fr-responsive-img" src="<?php echo get_template_directory_uri(); ?>/images/domaine/touristeresto.png" alt="secteur" data-fr-js-ratio="true"></a>
						
						<div class="col-sm-7" >
							<div class="article_body">
						
									<div class="article_body_content">
										<h4 class="body_title">
											<a href="<?php echo get_site_url(); ?>/offre-stage/?id=55555" >Chargé de client</a>
										</h4>
										<div  class="body_detail">
											Tahiti Pearl Beach Ressort
										</div>
										<div  class="body_desc">
											<p class="body_lieu">Arue</p>
											<div class="body_date">du 20 novembre au 20 décembre</div>
										</div>
									</div>
							
							</div>
							
						</div>
					</div>
					
				</article>
			</div>
			<div class="col-sm-12" >
				
				<div id="pagination">
				  <button class="prev">Previous</button>
				  <button class="page active">1</button>
				  <button class="page">2</button>
				  <div>...</div>
				  <button class="page">8</button>
				  <button class="page">9</button>
				  <button class="next">Next</button>
				</div>
							
			</div>
		</div>
		
		
				</div>
			
			</div>
	
	
	</div>
	
</section>



<?php do_action( 'avada_after_content' ); ?>
<?php get_footer(); ?>