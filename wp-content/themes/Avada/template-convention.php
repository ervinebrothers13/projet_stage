<?php
/**
 * Template Name: Modifier convention
 * Description: Pages Modifier convention
 */
 

 
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}
?>
<?php get_header("cust"); ?>

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
	
	<h2 class="textcenter">Mofidier ma convention</h2>
	<?php
	
	
	if(isset($_GET["cand"])){
			
		$candhash=$_GET["cand"];
		
		$cand_id=decryptIt($candhash,$_SESSION["hashsession"]);
		
		
		
		$elv_diplome="";
		$ent_adr="";
		$ent_nom="";
		$ent_domaine="";
		$ent_tel="";
		$ent_copier="";
		$ent_numtahiti="";
		$ent_represant="";
		$ent_represant_funct="";
		$ent_represant_mail="";
		$ent_represant_tel="";
		$ent_tuteur="";
		$ent_tuteur_funct="";
		$ent_tuteur_mail="";
		$ent_tuteur_tel="";
		$ent_mail="";
		$uai_adr="";
		$uai_tel="";
		$uai_copier="";
		$uai_represant="";
		$uai_mail="";
		$referent_nom="";
		$referent_tel="";
		$referent_mail="";
		$elv_nom="";
		$elv_pren="";
		$elv_datenaiss="";
		$elv_adr="";
		$elv_tel="";
		$elv_mail="";
		$uai_delib="";
		$elv_nom2="";
		$elv_pren2="";
		$elv_class="";
		$elv_diplome2="";
		$referent_nom2="";
		$date_stage="";
		$responsable="";
		$etudiant="";
		$typ_horaire=0;
		$typ_horaire_opt1_h1="";
		$pause_dej_h1="";
		$pause_dej_h2="";
		$typ_horaire_opt1_h2="";
		$ent_lieustage="";
		$lundimatin="";
		$pause_dej_h1_lundi="";
		$pause_dej_h2_lundi="";
		$lundiaprem="";	
		$mardimatin="";
		$pause_dej_h1_mardi="";
		$pause_dej_h2_mardi="";
		$mardiaprem="";
		$mercredimatin="";
		$pause_dej_h1_mercredi="";
		$pause_dej_h2_mercredi="";
		$mercrediaprem="";
		$jeudimatin="";
		$pause_dej_h1_jeudi="";
		$pause_dej_h2_jeudi="";
		$jeudiaprem="";
		$vendredimatin="";
		$pause_dej_h1_vendredi="";
		$pause_dej_h2_vendredi="";
		$vendrediaprem="";
		$samedimatin="";
		$pause_dej_h1_samedi="";
		$pause_dej_h2_samedi="";
		$samediaprem="";
		$horairejour=0;
		$horaireweek=0;
		$finance_ent=0;
		$finance_rest1="";
		$finance_rest2="";
		$finance_transp1="";
		$finance_transp2="";
		$finance_heberg1="";
		$finance_heberg2="";
		$finance_grat="";
		$finance_grat_montant="";
		$finance_versement="";
		$ent_assurreur="";
		$ent_numcontrat="";
		$uai_assureur="";
		$uai_numcontrat="";
		$signerok=0;
		
		
		
		$tabcand=recData("candidature",$cand_id);
		$stage_id=$tabcand["stage_id"];
		$tabstage=recData("stage",$stage_id);
		$elv_id=$tabcand["elv_id"];
		$tabeleve=recData("eleve",$elv_id);
		$type=$tabstage["type_id"];
		$tabentreprise=recData("entreprise",$tabstage["ent_id"]);
		
		$uai_rnehash=encryptIt($tabeleve["elv_uai"],$_SESSION["hashsession"]);
		$elvhash=encryptIt($tabcand["elv_id"],$_SESSION["hashsession"]);
		
		
		
		$elv_diplome=($tabeleve["elv_diplome"]);
		$ent_adr=($tabentreprise["ent_adr"]);
		$ent_nom=($tabentreprise["ent_nom"]);
		$ent_domaine=($tabentreprise["ent_domaine"]);
		$ent_tel=($tabentreprise["ent_tel"]);
		$ent_copier=($tabentreprise["ent_copier"]);
		$ent_numtahiti=($tabentreprise["ent_numtahiti"]);
		$ent_represant=($tabentreprise["ent_represant"]);
		$ent_represant_funct=($tabentreprise["ent_represant_funct"]);
		$ent_represant_mail=($tabentreprise["ent_represant_mail"]);
		$ent_represant_tel=($tabentreprise["ent_represant_tel"]);
		$ent_tuteur=($tabentreprise["ent_tuteur"]);
		$ent_tuteur_funct=($tabentreprise["ent_tuteur_funct"]);
		$ent_tuteur_mail=($tabentreprise["ent_tuteur_mail"]);
		$ent_tuteur_tel=($tabentreprise["ent_tuteur_tel"]);
		$ent_mail=($tabentreprise["ent_mail"]);
		$uai_adr=($tabeleve["uai_adr"]);
		$uai_tel=($tabeleve["uai_tel"]);
		$uai_copier=($tabeleve["uai_copier"]);
		$uai_represant=($tabeleve["uai_represant"]);
		$uai_represant_mail=($tabeleve["uai_represant_mail"]);
		$uai_mail=($tabeleve["uai_mail"]);
		$elv_nom=($tabeleve["elv_nom"]);
		$elv_pren=($tabeleve["elv_pren"]);
		$elv_datenaiss=($tabeleve["elv_datenaiss"]);
		$elv_adr=($tabeleve["elv_adr"]);
		$elv_tel=($tabeleve["elv_tel"]);
		$elv_mail=($tabeleve["elv_mail"]);
		$uai_delib=($tabeleve["uai_delib"]);
		$elv_nom2=($tabeleve["elv_nom"]);
		$elv_pren2=($tabeleve["elv_pren"]);
		$elv_class=($tabeleve["class_lib"]);
		$elv_diplome2=($tabeleve["elv_diplome"]);
		$ent_lieustage=($tabentreprise["ent_adr"]);
		
		$etudiant=$elv_nom." ".$elv_pren;
		
		if($tabstage["dispo"]=="1" or $tabstage["dispo"]=="3"){
			
			$date_stage="Du ".fDate($tabcand["date_deb"],"html")." au ".fDate($tabcand["date_fin"],"html");
			
		}else{
			
			$weeks=getWeek();

			foreach($weeks as $value){
				
				$tabdate1=explode("/",$value[1]);
				$tabdate2=explode("/",$value[2]);
				
				$mois1=getmois($tabdate1[1]);
				$mois2=getmois($tabdate2[1]);
				
				
				
				
				if($value[0]==$tabcand["semaine"]){
					
					if($mois1==$mois2){
					
						$date_stage= "Du ".$tabdate1[0]." au ".$tabdate2[0]." ".$mois1." ".$tabdate1[2];
				
					}else{
					
						$date_stage= "Du ".$tabdate1[0]." ".$mois1." au ".$tabdate2[0]." ".$mois2." ".$tabdate1[2];												
						
					}
					
					
				}
					
			}
			
		}
		
		
		$typ_horaire=$tabstage["typ_horaire"];	
						
		if($tabstage["typ_horaire"]=="1"){
			
			$typ_horaire_opt1_h1=$tabstage["typ_horaire_opt1_h1"];
			$pause_dej_h1=$tabstage["pause_dej_h1"];
			$pause_dej_h2=$tabstage["pause_dej_h2"];
			$typ_horaire_opt1_h2=$tabstage["typ_horaire_opt1_h2"];
							
			$lundimatin=$tabstage["typ_horaire_opt1_h1"];
			$pause_dej_h1_lundi=$tabstage["pause_dej_h1"];
			$pause_dej_h2_lundi=$tabstage["pause_dej_h2"];
			$lundiaprem=$tabstage["typ_horaire_opt1_h2"];
			
			$mardimatin=$tabstage["typ_horaire_opt1_h1"];
			$pause_dej_h1_mardi=$tabstage["pause_dej_h1"];
			$pause_dej_h2_mardi=$tabstage["pause_dej_h2"];
			$mardiaprem=$tabstage["typ_horaire_opt1_h2"];
			
			$mercredimatin=$tabstage["typ_horaire_opt1_h1"];
			$pause_dej_h1_mercredi=$tabstage["pause_dej_h1"];
			$pause_dej_h2_mercredi=$tabstage["pause_dej_h2"];
			$mercrediaprem=$tabstage["typ_horaire_opt1_h2"];
			
			$jeudimatin=$tabstage["typ_horaire_opt1_h1"];
			$pause_dej_h1_jeudi=$tabstage["pause_dej_h1"];
			$pause_dej_h2_jeudi=$tabstage["pause_dej_h2"];
			$jeudiaprem=$tabstage["typ_horaire_opt1_h2"];
			
			$vendredimatin=$tabstage["typ_horaire_opt1_h1"];
			$pause_dej_h1_vendredi=$tabstage["pause_dej_h1"];
			$pause_dej_h2_vendredi=$tabstage["pause_dej_h2"];
			$vendrediaprem=$tabstage["typ_horaire_opt1_h2"];
			
		}else{
			
			$tabstage_horaire1=recData("stage_horaire1",$stage_id);
			if($tabstage_horaire1["heure1"]!=null)$lundimatin=$tabstage_horaire1["heure1"];
			$pause_dej_h1_lundi=$tabstage["pause_dej_h1"];
			$pause_dej_h2_lundi=$tabstage["pause_dej_h2"];
			if($tabstage_horaire1["heure2"]!=null)$lundiaprem=$tabstage_horaire1["heure2"];
			
			$tabstage_horaire2=recData("stage_horaire2",$stage_id);
			if($tabstage_horaire2["heure1"]!=null)$mardimatin=$tabstage_horaire2["heure1"];
			$pause_dej_h1_mardi=$tabstage["pause_dej_h1"];
			$pause_dej_h2_mardi=$tabstage["pause_dej_h2"];
			if($tabstage_horaire2["heure2"]!=null)$mardiaprem=$tabstage_horaire2["heure2"];
			
			$tabstage_horaire3=recData("stage_horaire3",$stage_id);
			if($tabstage_horaire3["heure1"]!=null)$mercredimatin=$tabstage_horaire3["heure1"];
			$pause_dej_h1_mercredi=$tabstage["pause_dej_h1"];
			$pause_dej_h2_mercredi=$tabstage["pause_dej_h2"];
			if($tabstage_horaire3["heure2"]!=null)$mercrediaprem=$tabstage_horaire3["heure2"];
			
			$tabstage_horaire4=recData("stage_horaire4",$stage_id);
			if($tabstage_horaire4["heure1"]!=null)$jeudimatin=$tabstage_horaire4["heure1"];
			$pause_dej_h1_jeudi=$tabstage["pause_dej_h1"];
			$pause_dej_h2_jeudi=$tabstage["pause_dej_h2"];
			if($tabstage_horaire4["heure2"]!=null)$jeudiaprem=$tabstage_horaire4["heure2"];
			
			$tabstage_horaire5=recData("stage_horaire5",$stage_id);
			if($tabstage_horaire5["heure1"]!=null)$vendredimatin=$tabstage_horaire5["heure1"];
			$pause_dej_h1_vendredi=$tabstage["pause_dej_h1"];
			$pause_dej_h2_vendredi=$tabstage["pause_dej_h2"];
			if($tabstage_horaire5["heure2"]!=null)$vendrediaprem=$tabstage_horaire5["heure2"];
			
			$tabstage_horaire6=recData("stage_horaire6",$stage_id);
			if($tabstage_horaire6["heure1"]!=null)$samedimatin=$tabstage_horaire6["heure1"];
			$pause_dej_h1_samedi=$tabstage["pause_dej_h1"];
			$pause_dej_h2_samedi=$tabstage["pause_dej_h2"];
			if($tabstage_horaire6["heure2"]!=null)$samediaprem=$tabstage_horaire6["heure2"];
			
		}
		
		$nbjour=0;
		
		$nbheurelundimatin=0;
		$nbminutelundimatin=0;
		
		if($lundimatin!="" or $lundiaprem!="")$nbjour++;
			
		if($lundimatin!=""){
			
			$tabhorairelundimatin=explode("h",$lundimatin);
			
			
			$nbminutetotal1=($tabhorairelundimatin[0]*60)+$tabhorairelundimatin[1];
			
			$tabpause_dej_h1=explode("h",$tabstage["pause_dej_h1"]);
			
			$nbminutetotal2=$tabpause_dej_h1[0]*60+$tabpause_dej_h1[1];
			
			$nbminutetotal=$nbminutetotal2-$nbminutetotal1;
			
			$nbheurelundimatin=floor($nbminutetotal/60);
			$nbminutelundimatin=$nbminutetotal-($nbheurelundimatin*60);
			
			
		}
		
		$nbheurelundiaprem=0;
		$nbminutelundiaprem=0;
		if($lundiaprem!=""){
			$tabhorairelundiaprem=explode("h",$lundiaprem);
			
			
			$nbminutetotal1=$tabhorairelundiaprem[0]*60+$tabhorairelundiaprem[1];
			
			$tabpause_dej_h2=explode("h",$tabstage["pause_dej_h2"]);
			
			$nbminutetotal2=$tabpause_dej_h2[0]*60+$tabpause_dej_h2[1];
			
			$nbminutetotal=$nbminutetotal1-$nbminutetotal2;
			
			$nbheurelundiaprem=floor($nbminutetotal/60);
			$nbminutelundiaprem=$nbminutetotal-($nbheurelundiaprem*60);
			
			
		}
		
		
		
		if($mardimatin!="" or $mardiaprem!="")$nbjour++;
		
		$nbheuremardimatin=0;
		$nbminutemardimatin=0;
		if($mardimatin!=""){
			$tabhorairemardimatin=explode("h",$mardimatin);
			
			
			$nbminutetotal1=$tabhorairemardimatin[0]*60+$tabhorairemardimatin[1];
			
			$tabpause_dej_h1=explode("h",$tabstage["pause_dej_h1"]);
			
			$nbminutetotal2=$tabpause_dej_h1[0]*60+$tabpause_dej_h1[1];
			
			$nbminutetotal=$nbminutetotal2-$nbminutetotal1;
			
			$nbheuremardimatin=floor($nbminutetotal/60);
			$nbminutemardimatin=$nbminutetotal-($nbheuremardimatin*60);
			
			
		}
		
		$nbheuremardiaprem=0;
		$nbminutemardiaprem=0;
		if($mardiaprem!=""){
			$tabhorairemardiaprem=explode("h",$mardiaprem);
			
			
			$nbminutetotal1=$tabhorairemardiaprem[0]*60+$tabhorairemardiaprem[1];
			
			$tabpause_dej_h2=explode("h",$tabstage["pause_dej_h2"]);
			
			$nbminutetotal2=$tabpause_dej_h2[0]*60+$tabpause_dej_h2[1];
			
			$nbminutetotal=$nbminutetotal1-$nbminutetotal2;
			
			$nbheuremardiaprem=floor($nbminutetotal/60);
			$nbminutemardiaprem=$nbminutetotal-($nbheuremardiaprem*60);
			
			
		}
		
		if($mercredimatin!="" or $mercrediaprem!="")$nbjour++;
		
		$nbheuremercredimatin=0;
		$nbminutemercredimatin=0;
		if($mercredimatin!=""){
			$tabhorairemercredimatin=explode("h",$mercredimatin);
			
			
			$nbminutetotal1=$tabhorairemercredimatin[0]*60+$tabhorairemercredimatin[1];
			
			$tabpause_dej_h1=explode("h",$tabstage["pause_dej_h1"]);
			
			$nbminutetotal2=$tabpause_dej_h1[0]*60+$tabpause_dej_h1[1];
			
			$nbminutetotal=$nbminutetotal2-$nbminutetotal1;
			
			$nbheuremercredimatin=floor($nbminutetotal/60);
			$nbminutemercredimatin=$nbminutetotal-($nbheuremercredimatin*60);
			
			
		}
		
		$nbheuremercrediaprem=0;
		$nbminutemercrediaprem=0;
		if($mercrediaprem!=""){
			$tabhorairemercrediaprem=explode("h",$mercrediaprem);
			
			
			$nbminutetotal1=$tabhorairemercrediaprem[0]*60+$tabhorairemercrediaprem[1];
			
			$tabpause_dej_h2=explode("h",$tabstage["pause_dej_h2"]);
			
			$nbminutetotal2=$tabpause_dej_h2[0]*60+$tabpause_dej_h2[1];
			
			$nbminutetotal=$nbminutetotal1-$nbminutetotal2;
			
			$nbheuremercrediaprem=floor($nbminutetotal/60);
			$nbminutemercrediaprem=$nbminutetotal-($nbheuremercrediaprem*60);
			
			
		}
		
		if($jeudimatin!="" or $jeudiaprem!="")$nbjour++;
		
		$nbheurejeudimatin=0;
		$nbminutejeudimatin=0;
		if($jeudimatin!=""){
			$tabhorairejeudimatin=explode("h",$jeudimatin);
			
			
			$nbminutetotal1=$tabhorairejeudimatin[0]*60+$tabhorairejeudimatin[1];
			
			$tabpause_dej_h1=explode("h",$tabstage["pause_dej_h1"]);
			
			$nbminutetotal2=$tabpause_dej_h1[0]*60+$tabpause_dej_h1[1];
			
			$nbminutetotal=$nbminutetotal2-$nbminutetotal1;
			
			$nbheurejeudimatin=floor($nbminutetotal/60);
			$nbminutejeudimatin=$nbminutetotal-($nbheurejeudimatin*60);
			
			
		}
		
		$nbheurejeudiaprem=0;
		$nbminutejeudiaprem=0;
		if($jeudiaprem!=""){
			$tabhorairejeudiaprem=explode("h",$jeudiaprem);
			
			
			$nbminutetotal1=$tabhorairejeudiaprem[0]*60+$tabhorairejeudiaprem[1];
			
			$tabpause_dej_h2=explode("h",$tabstage["pause_dej_h2"]);
			
			$nbminutetotal2=$tabpause_dej_h2[0]*60+$tabpause_dej_h2[1];
			
			$nbminutetotal=$nbminutetotal1-$nbminutetotal2;
			
			$nbheurejeudiaprem=floor($nbminutetotal/60);
			$nbminutejeudiaprem=$nbminutetotal-($nbheurejeudiaprem*60);
			
			
		}
		
		if($vendredimatin!="" or $vendrediaprem!="")$nbjour++;
		
		$nbheurevendredimatin=0;
		$nbminutevendredimatin=0;
		if($vendredimatin!=""){
			$tabhorairevendredimatin=explode("h",$vendredimatin);
			
			
			$nbminutetotal1=$tabhorairevendredimatin[0]*60+$tabhorairevendredimatin[1];
			
			$tabpause_dej_h1=explode("h",$tabstage["pause_dej_h1"]);
			
			$nbminutetotal2=$tabpause_dej_h1[0]*60+$tabpause_dej_h1[1];
			
			$nbminutetotal=$nbminutetotal2-$nbminutetotal1;
			
			$nbheurevendredimatin=floor($nbminutetotal/60);
			$nbminutevendredimatin=$nbminutetotal-($nbheurevendredimatin*60);
			
			
		}
		
		$nbheurevendrediaprem=0;
		$nbminutevendrediaprem=0;
		if($vendrediaprem!=""){
			$tabhorairevendrediaprem=explode("h",$vendrediaprem);
			
			
			$nbminutetotal1=$tabhorairevendrediaprem[0]*60+$tabhorairevendrediaprem[1];
			
			$tabpause_dej_h2=explode("h",$tabstage["pause_dej_h2"]);
			
			$nbminutetotal2=$tabpause_dej_h2[0]*60+$tabpause_dej_h2[1];
			
			$nbminutetotal=$nbminutetotal1-$nbminutetotal2;
			
			$nbheurevendrediaprem=floor($nbminutetotal/60);
			$nbminutevendrediaprem=$nbminutetotal-($nbheurevendrediaprem*60);
			
			
		}
		
		if($samedimatin!="" or $samediaprem!="")$nbjour++;
		
		$nbheuresamedimatin=0;
		$nbminutesamedimatin=0;
		if($samedimatin!=""){
			$tabhorairesamedimatin=explode("h",$samedimatin);
			
			
			$nbminutetotal1=$tabhorairesamedimatin[0]*60+$tabhorairesamedimatin[1];
			
			$tabpause_dej_h1=explode("h",$tabstage["pause_dej_h1"]);
			
			$nbminutetotal2=$tabpause_dej_h1[0]*60+$tabpause_dej_h1[1];
			
			$nbminutetotal=$nbminutetotal2-$nbminutetotal1;
			
			$nbheuresamedimatin=floor($nbminutetotal/60);
			$nbminutesamedimatin=$nbminutetotal-($nbheuresamedimatin*60);
			
			
		}
		
		$nbheuresamediaprem=0;
		$nbminutesamediaprem=0;
		if($samediaprem!=""){
			$tabhorairesamediaprem=explode("h",$samediaprem);
			
			
			$nbminutetotal1=$tabhorairesamediaprem[0]*60+$tabhorairesamediaprem[1];
			
			$tabpause_dej_h2=explode("h",$tabstage["pause_dej_h2"]);
			
			$nbminutetotal2=$tabpause_dej_h2[0]*60+$tabpause_dej_h2[1];
			
			$nbminutetotal=$nbminutetotal1-$nbminutetotal2;
			
			$nbheuresamediaprem=floor($nbminutetotal/60);
			$nbminutesamediaprem=$nbminutetotal-($nbheuresamediaprem*60);
			
			
		}
		
		$horairesemaine=($nbheurelundimatin*60)+$nbminutelundimatin+($nbheurelundiaprem*60)+$nbminutelundiaprem+($nbheuremardimatin*60)+$nbminutemardimatin+($nbheuremardiaprem*60)+$nbminutemardiaprem+($nbheuremercredimatin*60)+$nbminutemercredimatin+($nbheuremercrediaprem*60)+$nbminutemercrediaprem+($nbheurejeudimatin*60)+$nbminutejeudimatin+($nbheurejeudiaprem*60)+$nbminutejeudiaprem+($nbheurevendredimatin*60)+$nbminutevendredimatin+($nbheurevendrediaprem*60)+$nbminutevendrediaprem+($nbheuresamedimatin*60)+$nbminutesamedimatin+($nbheuresamediaprem*60)+$nbminutesamediaprem;
		
		$horairejournalier=$horairesemaine/$nbjour;
		
		$heurejournalier=floor($horairejournalier/60);
		
		$minutejournalier=$horairejournalier-($heurejournalier*60);
		
		if($heurejournalier<10)$heurejournalier="0".$heurejournalier;
		if($minutejournalier<10)$minutejournalier="0".$minutejournalier;
		
		$horairejour=$heurejournalier."h".$minutejournalier;
		
		
		
		$heuretotal=floor($horairesemaine/60);
		$minutetotal=$horairesemaine-($heuretotal*60);
		
		if($heuretotal<10)$heuretotal="0".$heuretotal;
		if($minutetotal<10)$minutetotal="0".$minutetotal;
		
		$horaireweek=$heuretotal."h".$minutetotal;
		
		
		$ent_assurreur=$tabentreprise["ent_assurreur"];
		$ent_numcontrat=$tabentreprise["ent_numcontrat"];
		$uai_assureur=$tabeleve["uai_assureur"];
		$uai_numcontrat=$tabeleve["uai_numcontrat"];			
		
		if(lgchkpeda()){
			
			$peda_id=decryptIt($_SESSION["peda_id"],$_SESSION["hashsession"]);
			$tabpedagogique=recData("pedagogique",$peda_id);
			
			$referent_nom=$tabpedagogique["peda_nom"]." ".$tabpedagogique["peda_pren"];
			$referent_tel="";
			$referent_mail=$tabpedagogique["peda_mail"];
			$referent_nom2=$tabpedagogique["peda_nom"]." ".$tabpedagogique["peda_pren"];
			
			
			$responsable=$referent_nom2;
			
			
		}
		
		
		$tabconvention=recData("convention",array($cand_id,$elv_id));
		
		if($tabconvention["elv_diplome"]!=null)$elv_diplome=($tabconvention["elv_diplome"]);
		if($tabconvention["ent_adr"]!=null)$ent_adr=($tabconvention["ent_adr"]);
		if($tabconvention["ent_nom"]!=null)$ent_nom=($tabconvention["ent_nom"]);
		if($tabconvention["ent_domaine"]!=null)$ent_domaine=($tabconvention["ent_domaine"]);
		if($tabconvention["ent_tel"]!=null)$ent_tel=($tabconvention["ent_tel"]);
		if($tabconvention["ent_copier"]!=null)$ent_copier=($tabconvention["ent_copier"]);
		if($tabconvention["ent_numtahiti"]!=null)$ent_numtahiti=($tabconvention["ent_numtahiti"]);
		if($tabconvention["ent_represant"]!=null)$ent_represant=($tabconvention["ent_represant"]);
		if($tabconvention["ent_represant_funct"]!=null)$ent_represant_funct=($tabconvention["ent_represant_funct"]);
		if($tabconvention["ent_represant_mail"]!=null)$ent_represant_mail=($tabconvention["ent_represant_mail"]);
		if($tabconvention["ent_tuteur"]!=null)$ent_tuteur=($tabconvention["ent_tuteur"]);
		if($tabconvention["ent_tuteur_funct"]!=null)$ent_tuteur_funct=($tabconvention["ent_tuteur_funct"]);
		if($tabconvention["ent_tuteur_mail"]!=null)$ent_tuteur_mail=($tabconvention["ent_tuteur_mail"]);
		if($tabconvention["ent_tuteur_tel"]!=null)$ent_tuteur_tel=($tabconvention["ent_tuteur_tel"]);
		if($tabconvention["ent_mail"]!=null)$ent_mail=($tabconvention["ent_mail"]);
		if($tabconvention["uai_adr"]!=null)$uai_adr=($tabconvention["uai_adr"]);
		if($tabconvention["uai_tel"]!=null)$uai_tel=($tabconvention["uai_tel"]);
		if($tabconvention["uai_copier"]!=null)$uai_copier=($tabconvention["uai_copier"]);
		if($tabconvention["uai_represant"]!=null)$uai_represant=($tabconvention["uai_represant"]);
		if($tabconvention["uai_represant_mail"]!=null)$uai_represant_mail=($tabconvention["uai_represant_mail"]);
		if($tabconvention["uai_mail"]!=null)$uai_mail=($tabconvention["uai_mail"]);
		if($tabconvention["referent_nom"]!=null)$referent_nom=($tabconvention["referent_nom"]);
		if($tabconvention["referent_tel"]!=null)$referent_tel=($tabconvention["referent_tel"]);
		if($tabconvention["referent_mail"]!=null)$referent_mail=($tabconvention["referent_mail"]);
		if($tabconvention["elv_nom"]!=null)$elv_nom=($tabconvention["elv_nom"]);
		if($tabconvention["elv_pren"]!=null)$elv_pren=($tabconvention["elv_pren"]);
		if($tabconvention["elv_datenaiss"]!=null)$elv_datenaiss=$tabconvention["elv_datenaiss"];
		if($tabconvention["elv_adr"]!=null)$elv_adr=($tabconvention["elv_adr"]);
		if($tabconvention["elv_tel"]!=null)$elv_tel=($tabconvention["elv_tel"]);
		if($tabconvention["elv_mail"]!=null)$elv_mail=($tabconvention["elv_mail"]);
		if($tabconvention["uai_delib"]!=null)$uai_delib=($tabconvention["uai_delib"]);
		if($tabconvention["elv_nom2"]!=null)$elv_nom2=($tabconvention["elv_nom2"]);
		if($tabconvention["elv_pren2"]!=null)$elv_pren2=($tabconvention["elv_pren2"]);
		if($tabconvention["elv_class"]!=null)$elv_class=($tabconvention["elv_class"]);
		if($tabconvention["elv_diplome2"]!=null)$elv_diplome2=($tabconvention["elv_diplome2"]);
		if($tabconvention["referent_nom2"]!=null)$referent_nom2=($tabconvention["referent_nom2"]);
		if($tabconvention["date_stage"]!=null)$date_stage=($tabconvention["date_stage"]);
		if($tabconvention["responsable"]!=null)$responsable=($tabconvention["responsable"]);
		if($tabconvention["etudiant"]!=null)$etudiant=($tabconvention["etudiant"]);
		if($tabconvention["typ_horaire_opt1_h1"]!=null)$typ_horaire_opt1_h1=($tabconvention["typ_horaire_opt1_h1"]);
		if($tabconvention["typ_horaire_opt1_h2"]!=null)$typ_horaire_opt1_h2=($tabconvention["typ_horaire_opt1_h2"]);
		if($tabconvention["ent_lieustage"]!=null)$ent_lieustage=($tabconvention["ent_lieustage"]);
		
		if($tabconvention["lundimatin"]!=null)$lundimatin=$tabconvention["lundimatin"];
		if($tabconvention["pause_dej_h1_lundi"]!=null)$pause_dej_h1_lundi=$tabconvention["pause_dej_h1_lundi"];
		if($tabconvention["pause_dej_h2_lundi"]!=null)$pause_dej_h2_lundi=$tabconvention["pause_dej_h2_lundi"];
		if($tabconvention["lundiaprem"]!=null)$lundiaprem=$tabconvention["lundiaprem"];
		if($tabconvention["mardimatin"]!=null)$mardimatin=$tabconvention["mardimatin"];
		if($tabconvention["pause_dej_h1_mardi"]!=null)$pause_dej_h1_mardi=$tabconvention["pause_dej_h1_mardi"];
		if($tabconvention["pause_dej_h2_mardi"]!=null)$pause_dej_h2_mardi=$tabconvention["pause_dej_h2_mardi"];
		if($tabconvention["mardiaprem"]!=null)$mardiaprem=$tabconvention["mardiaprem"];
		if($tabconvention["mercredimatin"]!=null)$mercredimatin=$tabconvention["mercredimatin"];
		if($tabconvention["pause_dej_h1_mercredi"]!=null)$pause_dej_h1_mercredi=$tabconvention["pause_dej_h1_mercredi"];
		if($tabconvention["pause_dej_h2_mercredi"]!=null)$pause_dej_h2_mercredi=$tabconvention["pause_dej_h2_mercredi"];
		if($tabconvention["mercrediaprem"]!=null)$mercrediaprem=$tabconvention["mercrediaprem"];
		if($tabconvention["jeudimatin"]!=null)$jeudimatin=$tabconvention["jeudimatin"];
		if($tabconvention["pause_dej_h1_jeudi"]!=null)$pause_dej_h1_jeudi=$tabconvention["pause_dej_h1_jeudi"];
		if($tabconvention["pause_dej_h2_jeudi"]!=null)$pause_dej_h2_jeudi=$tabconvention["pause_dej_h2_jeudi"];
		if($tabconvention["jeudiaprem"]!=null)$jeudiaprem=$tabconvention["jeudiaprem"];
		if($tabconvention["vendredimatin"]!=null)$vendredimatin=$tabconvention["vendredimatin"];
		if($tabconvention["pause_dej_h1_vendredi"]!=null)$pause_dej_h1_vendredi=$tabconvention["pause_dej_h1_vendredi"];
		if($tabconvention["pause_dej_h2_vendredi"]!=null)$pause_dej_h2_vendredi=$tabconvention["pause_dej_h2_vendredi"];
		if($tabconvention["vendrediaprem"]!=null)$vendrediaprem=$tabconvention["vendrediaprem"];
		if($tabconvention["samedimatin"]!=null)$samedimatin=$tabconvention["samedimatin"];
		if($tabconvention["pause_dej_h1_samedi"]!=null)$pause_dej_h1_samedi=$tabconvention["pause_dej_h1_samedi"];
		if($tabconvention["pause_dej_h2_samedi"]!=null)$pause_dej_h2_samedi=$tabconvention["pause_dej_h2_samedi"];
		if($tabconvention["samediaprem"]!=null)$samediaprem=$tabconvention["samediaprem"];
		if($tabconvention["horairejour"]!=null)$horairejour=($tabconvention["horairejour"]);
		if($tabconvention["horaireweek"]!=null)$horaireweek=($tabconvention["horaireweek"]);
		if($tabconvention["finance_ent"]!=null)$finance_ent=($tabconvention["finance_ent"]);
		if($tabconvention["finance_rest1"]!=null)$finance_rest1=($tabconvention["finance_rest1"]);
		if($tabconvention["finance_rest2"]!=null)$finance_rest2=($tabconvention["finance_rest2"]);
		if($tabconvention["finance_transp1"]!=null)$finance_transp1=($tabconvention["finance_transp1"]);
		if($tabconvention["finance_transp2"]!=null)$finance_transp2=($tabconvention["finance_transp2"]);
		if($tabconvention["finance_heberg1"]!=null)$finance_heberg1=($tabconvention["finance_heberg1"]);
		if($tabconvention["finance_heberg2"]!=null)$finance_heberg2=($tabconvention["finance_heberg2"]);
		if($tabconvention["finance_grat"]!=null)$finance_grat=($tabconvention["finance_grat"]);
		if($tabconvention["finance_grat_montant"]!=null)$finance_grat_montant=($tabconvention["finance_grat_montant"]);
		if($tabconvention["finance_versement"]!=null)$finance_versement=($tabconvention["finance_versement"]);
		if($tabconvention["ent_assurreur"]!=null)$ent_assurreur=($tabconvention["ent_assurreur"]);
		if($tabconvention["ent_numcontrat"]!=null)$ent_numcontrat=($tabconvention["ent_numcontrat"]);
		if($tabconvention["uai_assureur"]!=null)$uai_assureur=($tabconvention["uai_assureur"]);
		if($tabconvention["uai_numcontrat"]!=null)$uai_numcontrat=($tabconvention["uai_numcontrat"]);
		
		
		
		switch($type){ 

			case "1":
			
				include("convention3eme.php");
			
			break;
			case "2":
			
				include("conventionpfmp.php");
			
			break;
			case "3":
			
				include("conventionbts.php");
			
			break;
			
		
		}
		
		
		include("signatureconv.php");
		
		
		
	}

	?>
	
</section>



<?php do_action( 'avada_after_content' ); ?>
<?php get_footer(); ?>