<?php  


$query = new WP_Query( 'cat='.$categorie.'&showposts='.$nbparpage.'&offset='.$offset.'&orderby='.$orderby.'&order='.$order ); 

		
					if(in_array("-Marchés publics-",$cateparenttab)){
						?>
							
							<?php $i=0;  if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
					
											<?php
											if(!has_post_thumbnail()){
												$urlthumbnail.="/wp-content/uploads/2019/03/marchepublic.jpg";
												$id_thumbnail=13703;
												set_post_thumbnail( get_the_ID(), $id_thumbnail );
											}
											
											
											
											
											
											
											$cat=get_the_category();
											
											
											//print_r($cat);
									$arraycate=array();
									$arraycateslug=array();
									$arraycategorie=array();
									
									$arraycate2=array();
									$arraycateslug2=array();
									$arraycategorie2=array();
									
									
									$it=0;
									$it2=0;
									foreach($cat as $obj){
										
										
										$cateparent=get_category_parents( $obj->term_id, true,'|');
										$cateparenttab=explode("|",$cateparent);
										$attribut=$obj->slug;
										$name_cate=$cateparenttab[0];
										
										$arraycategorie[$it2]=$obj->cat_name;
										
										
										if($attribut!="diaporama" and $attribut!="communique" and $attribut!="actualite-dgee"){
											
												
												
											
											if(!in_array($name_cate, $arraycate)){
												
												$arraycateslug[$it]=$obj->slug;
												$arraycate[$it]=$name_cate;
												$it++;
											}
										}
										
										if(!in_array($attribut,array("marches-publics","externe","communique","actualite-inter","europe-international"))){
											
											
											$arraycateslug2[$it2]=$attribut;
											$arraycate2[$it2]="<a href='".get_category_link($obj)."' >".$obj->name."</a>";
											$it2++;
										}

									
										
									}
											
									$styles="";
									
									
											
									?>
											
											
										<div class="item item-category-full" >
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<div class="post_box classcate">
								
								 <header class="entry-header">
								 <div class="categories" <?php echo $styles; ?>>
								  
								 <?php
								 
								
								 
								
								 echo "<div style='clear:both;'>";
								
										//print_r($arraycateslug2);
										 for($i4=0;$i4<sizeof($arraycateslug2);$i4++){
											 
											
											?>
											
											 <span class="category-span category-<?php echo $arraycateslug2[$i4]; ?>"><?php echo $arraycate2[$i4]; ?></span>
											<?php

										 }
									
									
									 echo "</div>";
									$attr="target=_blank";
									$lien_vers_fichier = get_field( 'lien_vers_fichier' );
									
								
									if($lien_vers_fichier==""){
										$lien_vers_fichier = get_the_permalink('');
										$attr="";
									}
									
									$post_id=get_the_ID();
									if($requetesolo = $wpdb->get_results("select * from educ_weblink where id_post='".$post_id."'")){
										
										$iteration=$requetesolo[0]->iteration;
										$date_dern=$requetesolo[0]->date_dern;
									}else{
										$date_dern=date("Y-m-d");
										$iteration=1;
										$titre=get_the_title();
										$wpdb->insert('educ_weblink',array('id'=>'DEFAULT','id_post'=>$post_id,'nom'=>$titre,'iteration'=>$iteration,'date_dern'=>$date_dern));
										
										
									}
										
									?>
								 </div>
								
										 
									   <h5 class="entry-title"><a class="weblink" data-id="<?php the_ID(); ?>" rel="bookmark" <?php echo $attr; ?> href="<?php echo $lien_vers_fichier; ?>"><?php the_title(); ?></a> <?php $my_date = get_the_date( 'd/m/Y' ); echo "<i class='font9'> Publié le ".$my_date."</i>"; ?></h5>
										
									</header><!-- .entry-header -->
									
								
													<a class="col-sm-2 padding5px weblink" data-id="<?php the_ID(); ?>" target=_blank href="<?php echo $lien_vers_fichier; ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail(); ?></a>
									
									
											<div class="col-sm-10">
												
												
												
												<div class="entry-content">
												
													<?php
														/* translators: %s: Name of current post */
														
														echo the_excerpt();
														?>
														
															<?php
															if(in_array("marches-publics",$arraycateslug)){
																$reglementation = get_field( 'reglementation' );
																$responsable = get_field( 'responsable' );
																$date_limite = get_field( 'date_limite' );
																$date = new DateTime($date_limite);
																$commentaire = get_field( 'commentaire' );
																$tabresp=explode(";",$responsable);
																
																$dce = get_field( 'dce' );
																
																
																echo "<p style='color:blue;'>".$commentaire."</p>";
																
																echo "<h4>Date limite : ".$date->format('d/m/Y')."</h4>";

																if(!empty($reglementation))echo '<a  class="btn btn-warning" target=_blank  href="'.$reglementation["url"].'" />Réglementation de consultation</a>';
																echo '<a class="btn btn-info weblink" style="margin-left:10px;"  data-id="'.get_the_ID().'"   href="'.$lien_vers_fichier.'" />En savoir plus...</a>';
																
																if(!empty($dce)){
																	
																	 echo '<a  class="btn btn-success floatright" target=_blank  href="'.$dce.'" />Voir le DCE</a>';
																
																}else if(!empty($responsable)){
																	
																	echo '<a  class="btn btn-success floatright"  href="mailto:'.$tabresp[0].'?subject='.get_the_title().' - Demande DCE';
																
																
																
																	for($ti=1;$ti<sizeof($tabresp);$ti++){
																	
																		echo '&cc='.$tabresp[$ti];
																	
																	
																	}
																	
																	echo '&body=Bonjour,%0D%0A%0D%0Aje suis éventuellement intéressé par ce marché.%0D%0A%0D%0AMerci de m\'envoyer le dossier de consultation afin de pouvoir vous remettre une offre." />Demande d\'envoi du DCE</a></br></br></br>';
																
																}
															
															
															
															
															}else{
														
															?>
															<a class="myButton weblink floatright" <?php echo $attr; ?> data-id="<?php the_ID(); ?>"   href="<?php echo $lien_vers_fichier; ?>" />En savoir plus...</a>
															
															<?php
															
															}
															
															?>
													
													
													<?php
														wp_link_pages( array(
															'before' => '<div class="page-links">' . __( 'Pages:', 'wp-fanzone' ),
															'after'  => '</div>',
														) );
													?>
												</div><!-- .entry-content -->
											 
											</div>
									
										
									
							</div>
							</article><!-- #post-## -->
							<div class="clearfix"></div>
							<i style="float:right;font-size:10px;">Vue <span class="nbrvue" ><?php echo $iteration; ?></span> fois</i>
						</div>
								
							<?php $i++; endwhile; ?>
							
						
				
						<?php endif; ?>
								
						
						
							
						<?php
						}else if(in_array("Annales",$cateparenttab)){
						?>
						
						<?php $i=0;  if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
					
											<?php
											if(!has_post_thumbnail()){
												$urlthumbnail.="/wp-content/uploads/2016/07/annales.jpg";
												$id_thumbnail=4177;
												set_post_thumbnail( get_the_ID(), $id_thumbnail );
											}
											?>
											
											
										<div class="item item-category" >
											<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
												<div class="post_box classcate">
												
												 
												
												<a class="col-sm-3 padding5px weblink" data-id="<?php the_ID(); ?>" <?php echo $attr; ?> href="<?php echo $lien_vers_fichier; ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail(); ?></a>
												
												
											   <div class="col-sm-9">
												<header class="entry-header">
															
																<?php 
																$liresuite = get_field( 'liresuite' );
																
																
																$attr="target=_blank";
																$lien_vers_fichier = get_field( 'lien_vers_fichier' );
																if($lien_vers_fichier==""){
																	$lien_vers_fichier = get_the_permalink('');
																	$attr="";
																}
																
																$post_id=get_the_ID();
																if($requetesolo = $wpdb->get_results("select * from educ_weblink where id_post=".$post_id)){
																	
																	$iteration=$requetesolo[0]->iteration;
																	$date_dern=$requetesolo[0]->date_dern;
																}else{
																	$date_dern=date("Y-m-d");
																	$iteration=1;
																	
																	$titre=get_the_title();
																	
																	$wpdb->insert('educ_weblink',array('id'=>'DEFAULT','id_post'=>$post_id,'nom'=>$titre,'iteration'=>$iteration,'date_dern'=>$date_dern));
																	
																	
																}
																?>
																		  
																   <h5><a class="weblink" data-id="<?php the_ID(); ?>" <?php echo $attr; ?> href="<?php echo $lien_vers_fichier; ?>"><?php echo get_the_title(); ?></a></h5>
													</header><!-- .entry-header -->
												<div class="entry-content">
												
													<?php
														/* translators: %s: Name of current post */
														
														echo the_excerpt();
														?>
																	<?php if($liresuite!="non"){ ?>			
																		<a class="weblink" <?php echo $attr; ?> data-id="<?php the_ID(); ?>" style="float:right;"  href="<?php echo $lien_vers_fichier; ?>" />En savoir plus...</a>
																	<?php } ?>	
																
													
													
													<?php
														wp_link_pages( array(
															'before' => '<div class="page-links">' . __( 'Pages:', 'wp-fanzone' ),
															'after'  => '</div>',
														) );
													?>
												</div><!-- .entry-content -->
											  
												</div>
												
											</div>
											</article><!-- #post-## -->
											<div class="clearfix"></div>
											<i style="float:right;font-size:10px;">Vue <span class="nbrvue" ><?php echo $iteration; ?></span> fois</i>
										</div>
								
							<?php $i++; endwhile; ?>
							
						
				
						<?php endif; ?>
								
						
						<?php
						
						}else{
						
						
						
						 $i=0;  if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); 
						
						
						$liresuite = get_field( 'liresuite' );
						$taille = get_field( 'taille' );
						
						if(!has_post_thumbnail()){
							if(in_array(htmlentities("Bourses et allocations d'étude"),$cateparenttab)){
								
													$id_thumbnail=4178;
													
							}else if(in_array(htmlentities("Europe & international"),$cateparenttab)){
								
													$id_thumbnail=222;
													
							}else if(in_array(htmlentities("Personnels éducation"),$cateparenttab)){
								
													$id_thumbnail=179;
													
							}else if(in_array(htmlentities("Vie scolaire"),$cateparenttab)){
								
													$id_thumbnail=179;
													
							}else if(in_array(htmlentities("Bureau de la Maintenance et des Constructions"),$cateparenttab)){
								
													$id_thumbnail=4186;
													
							}else if(in_array(htmlentities("Calendrier scolaire"),$cateparenttab)){
								
													$id_thumbnail=215;
													
							}else if(in_array(htmlentities("Calendrier d’examen de la session 2015"),$cateparenttab)){
								
													$id_thumbnail=215;
												
							}else if(in_array(htmlentities("Calendrier d'examen de la session 2016"),$cateparenttab)){
								
													$id_thumbnail=215;
													
							}else if(in_array(htmlentities("Calendrier d'examen de la session 2017"),$cateparenttab)){
								
													$id_thumbnail=215;
													
							}else if(in_array(htmlentities("Calendrier d’examen de la session de remplacement 2015"),$cateparenttab)){
								
													$id_thumbnail=215;
													
							}else if(in_array(htmlentities("Guides pratiques"),$cateparenttab)){
								
													$id_thumbnail=4187;
													
							}else if(in_array(htmlentities("Transport scolaire"),$cateparenttab)){
								
													$id_thumbnail=4188;
													
							}else if(in_array(htmlentities("Orientation"),$cateparenttab) and in_array("Imprimés et formulaire",$cateparenttab)){
								
													$id_thumbnail=4116;
							}
							
							set_post_thumbnail( get_the_ID(), $id_thumbnail );
						}
						?>
					
						<?php
						$nombrecara=strlen(get_the_content());
									
							

							$classblock="item item-category";
										
									
						?>
						<div class="<?php echo $classblock; ?>">
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<div class="post_box">
								
								 <header class="entry-header">
								
									<?php 
									$attr="target=_blank";
									$lien_vers_fichier = get_field( 'lien_vers_fichier' );
									if($lien_vers_fichier==""){
										$lien_vers_fichier = get_the_permalink('');
										$attr="";
									}
										$post_id=get_the_ID();
												if($requetesolo = $wpdb->get_results("select * from educ_weblink where id_post='".$post_id."'")){
													
													$iteration=$requetesolo[0]->iteration;
													$date_dern=$requetesolo[0]->date_dern;
												}else{
													$date_dern=date("Y-m-d");
													$iteration=1;
													$titre=get_the_title();
													$wpdb->insert('educ_weblink',array('id'=>'DEFAULT','id_post'=>$post_id,'nom'=>$titre,'iteration'=>$iteration,'date_dern'=>$date_dern));
													
													
												}
									
									?>
										<?php //the_title( sprintf( '<h5 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>        
									   <h5><a class="weblink" data-id="<?php the_ID(); ?>" <?php echo $attr; ?> href="<?php echo $lien_vers_fichier; ?>"><?php echo get_the_title(); ?></a>
									   <?php 
									   
									   $my_date = get_the_date( 'd/m/Y' );

									   echo "<i class='font9'> Publié le ".$my_date."</i>"; 
									   
									   ?>
									   
									   </h5>
									</header><!-- .entry-header -->
									
									<?php
									
									
									
										if(in_array("Vidéos",$cateparenttab)){
											?>
											<div class="entry-content">
															
																<?php
																	/* translators: %s: Name of current post */
																	
																	echo the_content();
																	?>
																				<?php if($liresuite!="non"){ ?>			
																					<a class="weblink" <?php echo $attr; ?> data-id="<?php the_ID(); ?>" style="float:right;"  href="<?php echo $lien_vers_fichier; ?>" />En savoir plus...</a>
																				<?php } ?>	
																			
																
																
																<?php
																	wp_link_pages( array(
																		'before' => '<div class="page-links">' . __( 'Pages:', 'wp-fanzone' ),
																		'after'  => '</div>',
																	) );
																?>
															</div><!-- .entry-content -->
											
											<?php
											
										}else if(has_post_thumbnail()){
												if ($post->post_content != '') {
										
														?>
														
														<a class="col-sm-3 padding5px weblink" data-id="<?php the_ID(); ?>" <?php echo $attr; ?> href="<?php echo $lien_vers_fichier; ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail(); ?></a>
												
												
														   <div class="col-sm-9">
															
															<div class="entry-content">
															
																<?php
																	/* translators: %s: Name of current post */
																	
																	echo the_excerpt();
																	?>
																				<?php if($liresuite!="non"){ ?>			
																					<a class="weblink" <?php echo $attr; ?> data-id="<?php the_ID(); ?>" style="float:right;"  href="<?php echo $lien_vers_fichier; ?>" />En savoir plus...</a>
																				<?php } ?>	
																			
																
																
																<?php
																	wp_link_pages( array(
																		'before' => '<div class="page-links">' . __( 'Pages:', 'wp-fanzone' ),
																		'after'  => '</div>',
																	) );
																?>
															</div><!-- .entry-content -->
														  
															</div>
														
														<?php
														
											}else{
												
													?>
													<div class="col-sm-12">
											
													<div class="entry-content">
														<a class="col-sm-9 padding5px weblink" data-id="<?php the_ID(); ?>" <?php echo $attr; ?> href="<?php echo $lien_vers_fichier; ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail(); ?></a>
													<?php if($liresuite!="non"){ ?>			<a class="weblink" <?php echo $attr; ?> data-id="<?php the_ID(); ?>" style="float:right;"  href="<?php echo $lien_vers_fichier; ?>" />Voir l'article...</a> <?php } ?>
														
														<?php
													wp_link_pages( array(
														'before' => '<div class="page-links">' . __( 'Pages:', 'wp-fanzone' ),
														'after'  => '</div>',
													) );
														?>
													</div><!-- .entry-content -->
												  
													</div>
													<?php
												
											}
											

										}else{
											?>
											  <div class="col-sm-12">
									
									<div class="entry-content">
									
										<?php
											/* translators: %s: Name of current post */
											
											echo the_content();
											
										?>
										
														<?php if($liresuite!="non"){ ?>			
															<a class="weblink" <?php echo $attr; ?> data-id="<?php the_ID(); ?>"  style="float:right;" href="<?php echo $lien_vers_fichier; ?>" />En savoir plus...</a>
														<?php } ?>	
														
										<?php
											wp_link_pages( array(
												'before' => '<div class="page-links">' . __( 'Pages:', 'wp-fanzone' ),
												'after'  => '</div>',
											) );
										?>
									</div><!-- .entry-content -->
								  
									</div>
											
											<?php
										}								
									?>
									
								<?php if(!in_array("Applications nationales Etablissements",$cateparenttab)){ ?>
								
								
								
								<?php } ?>
							   </div>
							</article><!-- #post-## -->
							<div class="clearfix"></div>
							<i style="float:right;font-size:10px;">Vue <span class="nbrvue" ><?php echo $iteration; ?></span> fois</i>
						</div>

                    
                <?php $i++; endwhile; ?>
                
            
    
            <?php endif; ?>
			
			<?php
			
			}

			
			if($nbarticle>1){
				?>
				<div class="pagination">
			<?php
			
				if($pagecurrent>1){
					
				$prevpage=$pagecurrent-1;
				$attr="categorie=".$categorie;
				$attr.="&page=".$prevpage;
				
				?>
				<a href="index.php?categorie=<?php echo $categorie; ?>" class="prev page-numbers"><span class="fa fa-angle-double-left"></span></a>
				<a href="index.php?<?php echo $attr; ?>" class="prev page-numbers"><span class="fa fa-chevron-left"></span></a>
				<?php
			}
			
			?>
			
			<?php
			
				for($i=1;$i<=$nbarticle;$i++){
					$current=$i;
					
					$attr="categorie=".$categorie;
					$attr.="&page=".$current;
					
					
					if($pagecurrent==$current){
						?>
						<span class="page-numbers current"><?php echo $current; ?></span>
						<?php
					}else{
						?>
						<a href="index.php?<?php echo $attr; ?>" class="page-numbers"><?php echo $current; ?></a>
						<?php
					}
				}
				
				
			
			
			?>
			
			
			

			
			
			
			<?php
			
			if($pagecurrent<$nbarticle){
				$nextpage=$pagecurrent+1;
				$attr="categorie=".$categorie;
				$attr.="&page=".$nextpage;
				
				?>
				<a href="index.php?<?php echo $attr; ?>" class="next page-numbers"><span class="fa fa-chevron-right"></span></a>
				<a href="index.php?categorie=<?php echo $categorie; ?>&page=<?php echo $nbarticle; ?>" class="next page-numbers"><span class="fa fa-angle-double-right"></span></a>
				<?php
			}
			
			?>
			
           </div>
				
				<?php
			}
			?>
			
                <div class="clearfix"></div>