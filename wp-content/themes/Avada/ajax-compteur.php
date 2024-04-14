<?php

include_once("../../../wp-load.php"); 
include_once("../../../wp-config.php"); 


if(isset($_GET["keyword"])){
	
	$content="";
	
	$stmt = $conn->prepare("SELECT `typ_ent`.`color`, `struct`.* FROM `struct` left join `typ_ent` on `typ_ent`.`tent_id`=`struct`.`typ_id` where `struct`.`parent`=0");
	$stmt->execute();
	$res = $stmt->fetch(PDO::FETCH_ASSOC);
	$stmt->closeCursor();	

	$content.="<div class='classstruct'>";
		$content.="<div class='classstructtitle' style='background:#".$res['color']."'>";
		$content.=funct_decode($res["libelle"]);
		if($res["cod"]!="")$content.=" (".$res["cod"].")</br>";
		if($res["email"]!="")$content.=funct_decode($res["email"])."</br>";
		if($res["tel"]!="")$content.="tel : ".funct_decode($res["tel"])."</br>";
		if($res["fax"]!="")$content.="fax : ".funct_decode($res["fax"])."</br>";
		$content.="</div>";
		$content.="<div class='classstructcontent'>";
			$stmt2 = $conn->prepare("SELECT agent.* FROM agent where agent.bur_id =:bur_id");
			$stmt2->bindParam(':bur_id', $res['id']);
			$stmt2->execute();
			$nb=$stmt2->rowCount();
			
			while($res2=$stmt2->fetch()){
				
				$classsup="";if($nb>1)$classsup="bordernottom";
				if($res["chef_id"]==$res2["id"])$content.="<div class='personne responsable ".$classsup."'>";	
				else $content.="<div class='personne'>";				
				$content.="<div class='classname'>".funct_decode($res2["name"])."</div><div class='classtel'>".funct_decode($res2["tel"])."</div></div>";
				
			}
		$content.="</div>";
	$content.="</div>";
	
	$stmt2->closeCursor();	
	
	$content.=showchildsearch($res['id'],1,$_GET["keyword"]);
	
	echo $content;
	

}else if(isset($_GET["fullfilehead"])){
	
	$content="";
	
	$stmt = $conn->prepare("SELECT `typ_ent`.`color`, `struct`.* FROM `struct` left join `typ_ent` on `typ_ent`.`tent_id`=`struct`.`typ_id` where `struct`.`parent`=0");
	$stmt->execute();
	$res = $stmt->fetch(PDO::FETCH_ASSOC);
	$stmt->closeCursor();	

	$content.="<div class='classstruct'>";
		$content.="<div class='classstructtitle' style='background:#".$res['color']."'>";
		$content.=funct_decode($res["libelle"]);
		if($res["cod"]!="")$content.=" (".$res["cod"].")</br>";
		if($res["email"]!="")$content.=funct_decode($res["email"])."</br>";
		if($res["tel"]!="")$content.="tel : ".funct_decode($res["tel"])."</br>";
		if($res["fax"]!="")$content.="fax : ".funct_decode($res["fax"])."</br>";
		$content.="</div>";
		$content.="<div class='classstructcontent'>";
			$stmt2 = $conn->prepare("SELECT agent.* FROM agent where agent.bur_id =:bur_id");
			$stmt2->bindParam(':bur_id', $res['id']);
			$stmt2->execute();
			$nb=$stmt2->rowCount();
			
			while($res2=$stmt2->fetch()){
				
				$classsup="";if($nb>1)$classsup="bordernottom";
				if($res["chef_id"]==$res2["id"])$content.="<div class='personne responsable ".$classsup."'>";	
				else $content.="<div class='personne'>";				
				$content.="<div class='classname'>".funct_decode($res2["name"])."</div><div class='classtel'>".funct_decode($res2["tel"])."</div></div>";
				
			}
		$content.="</div>";
	$content.="</div>";
	
	$stmt2->closeCursor();	
	
	$content.=showchild($res['id'],1);
	
	echo $content;
	

}else if(isset($_GET["article"])){

	$article=$_GET["article"];
	$date_dern=date("Y-m-d");


	$requetesolo = $wpdb->get_results("select * from educ_weblink where id_post='".$article."'");									
	$iteration=$requetesolo[0]->iteration;

	$iteration++;								

	$wpdb->update('educ_weblink',array('iteration'=>$iteration,'date_dern'=>$date_dern),array('id_post'=>$article), array( '%d', '%s' ), array( '%d' ));


	}else if(isset($_GET["article2"])){

	$article=$_GET["article2"];
	$date_dern=date("Y-m-d");


	$requetesolo = $wpdb->get_results("select * from educ_weblinksolo where nameid='".$article."'");									
	$iteration=$requetesolo[0]->iteration;

	$iteration++;								

	$wpdb->update('educ_weblinksolo',array('iteration'=>$iteration,'date_dern'=>$date_dern),array('nameid'=>$article), array( '%d', '%s' ), array( '%s' ));


}




	function ConnBDDpdo(){
		try{
		
			$dbconn = new PDO("mysql:host=".DB_HOST2.";dbname=".DB_NAME2, DB_USER2, DB_PWD2, array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET lc_time_names='fr_FR'", PDO::MYSQL_ATTR_LOCAL_INFILE => true));
			$dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
		}
		catch(PDOException | Exception $e){
			$dbconn = null;
			echo $e->getMessage()." | Fichier :".$e->getFile()." | Ligne :".$e->getLine();
		}
		return $dbconn;
	}
	 
	function showchild($id,$cpt){
		
		try{
		//Connexion à la base de données
		$conn = ConnBDDpdo();
	
			$content="";
			
			$sql = "SELECT STRUCT1.*,STRUCT1.libelle as libelle1,agent.name as NAME,typ_ent.tent_ll as libelle2, typ_ent.color,(select count(STRUCT3.id) as NB from struct as STRUCT3 where STRUCT3.parent=STRUCT1.id) as NB FROM struct as STRUCT1 left join typ_ent on typ_ent.tent_id=STRUCT1.typ_id left join agent on agent.id=STRUCT1.chef_id  left join struct as STRUCT2 on STRUCT2.id=STRUCT1.parent where STRUCT1.parent=".$id." order by STRUCT1.ordre ASC";
			$stmt = $conn->prepare($sql);
			$stmt->execute();
			
			$pixel=15*(4*$cpt);
			
			while($res=$stmt->fetch()){
				$content.='<div class="classstructdiv">';
				$content.='<div style="margin-left:'.$pixel.'px;">';
				$content.='<img src="'.get_site_url().'/wp-content/themes/Avada/images/listopen.png">';
				
				
				
				$content.='</div>';
				$content.='<div class="classstruct">';
				$content.='<div class="classstructtitle" style="background:#'.$res['color'].'">';	
				$content.=funct_decode($res["libelle1"]);
				if($res["cod"]!="")$content.=" (".$res["cod"].")";
				$content.='</div>';
				$content.='<div class="classstructcontent">';
					
					$sql2 = "SELECT agent.* FROM agent where bur_id=".$res["id"]." order by ordre ASC";
					$stmt2 = $conn->prepare($sql2);
					$stmt2->execute();
					$nb=$stmt2->rowCount();
					
					while($res2=$stmt2->fetch()){
						$classsup="";if($nb>1)$classsup="bordernottom";
						if($res["chef_id"]==$res2["id"])$content.="<div class='personne responsable ".$classsup."'>";	
						else $content.="<div class='personne'>";	
						$content.="<div class='classname'>".funct_decode($res2["name"])."</div><div class='classtel'>".funct_decode($res2["tel"])."</div></div>";
						
					}
					
					$stmt2->closeCursor();	
					
						
					$content.='</div>
				</div>
				</div>';
				
				if($res["NB"]>0){
					$cpt++;
			
					$content.=showchild($res["id"],$cpt);
				}
					
				
			}
			
			$stmt->closeCursor();	    
			
			
			
			return $content;
			
		}catch(PDOException $e){
			echo $e->getMessage()." | Fichier :".$e->getFile()." | Ligne :".$e->getLine();
			$conn = null;
		}
		
	}
	
	function showchildsearch($id,$cpt,$search){
		
		try{
		//Connexion à la base de données
		$conn = ConnBDDpdo();
	
			$content="";
			
			$sql = "SELECT STRUCT1.*,STRUCT1.libelle as libelle1,agent.name as NAME,typ_ent.tent_ll as libelle2, typ_ent.color,(select count(STRUCT3.id) as NB from struct as STRUCT3 where STRUCT3.parent=STRUCT1.id) as NB ";
			$sql .= " FROM struct as STRUCT1";
			$sql .= " left join typ_ent on typ_ent.tent_id=STRUCT1.typ_id";
			$sql .= " left join agent on agent.id=STRUCT1.chef_id";
			$sql .= " left join struct as STRUCT2 on STRUCT2.id=STRUCT1.parent";
			$sql .= " where STRUCT1.parent=".$id." and (STRUCT1.libelle LIKE '%".$search."%' OR STRUCT1.keywords LIKE '%".$search."%' OR agent.name LIKE '%".$search."%' OR agent.tel LIKE '%".$search."%') order by STRUCT1.ordre ASC";
			$stmt = $conn->prepare($sql);
			$stmt->execute();
			
			$pixel=15*(4*$cpt);
			
			while($res=$stmt->fetch()){
				$content.='<div class="classstructdiv">';
				$content.='<div style="margin-left:'.$pixel.'px;">';
				$content.='<img src="'.get_site_url().'/wp-content/themes/Avada/images/listopen.png">';
				
				
				
				$content.='</div>';
				$content.='<div class="classstruct">';
				$content.='<div class="classstructtitle" style="background:#'.$res['color'].'">';	
				$content.=funct_decode($res["libelle1"]);
				if($res["cod"]!="")$content.=" (".$res["cod"].")";
				$content.='</div>';
				$content.='<div class="classstructcontent">';
					
					$sql2 = "SELECT agent.* FROM agent where bur_id=".$res["id"]." AND (agent.name LIKE '%".$search."%' OR agent.tel LIKE '%".$search."%') order by ordre ASC";
					$stmt2 = $conn->prepare($sql2);
					$stmt2->execute();
					$nb=$stmt2->rowCount();
					
					while($res2=$stmt2->fetch()){
						$classsup="";if($nb>1)$classsup="bordernottom";
						if($res["chef_id"]==$res2["id"])$content.="<div class='personne responsable ".$classsup."'>";	
						else $content.="<div class='personne'>";	
						$content.="<div class='classname'>".funct_decode($res2["name"])."</div><div class='classtel'>".funct_decode($res2["tel"])."</div></div>";
						
					}
					
					$stmt2->closeCursor();	
					
						
					$content.='</div>
				</div>
				</div>';
				
				if($res["NB"]>0){
					$cpt++;
			
					$content.=showchildsearch($res["id"],$cpt,$search);
				}
					
				
			}
			
			$stmt->closeCursor();	    
			
			
			
			return $content;
			
		}catch(PDOException $e){
			echo $e->getMessage()." | Fichier :".$e->getFile()." | Ligne :".$e->getLine();
			$conn = null;
		}
		
	}
	

 
  function funct_decode($texte){
	
	$text2=$texte;
	
	$text2=utf8_encode($texte);
		
	
	
	return $text2;
	 
 }


?>
