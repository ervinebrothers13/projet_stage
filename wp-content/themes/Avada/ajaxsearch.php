<?php


include_once("../../../wp-load.php");
include_once("../../../wp-config.php");

if (isset($_GET['term'])) {

    $return_arr = array();
    //recup term de ce que tu tapes sur le clavier
    $str = iconv('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE', $_GET['term']);
    //stock dans une var str
    $str = addslashes($str);

    try {
        //Connexion à la base de données
        $conn = null;

        //si msg typ
        switch ($_GET['typ']) {

            //si msg typ=eleve
			case "eleve":
			
				$conn = ConnBDDpdo();
                //select elv_id -> elv_nom (sichamp==str) elv_pren (sichamp==str)
                $sql = "SELECT elv_id as ID,CONCAT(elv_nom, ' ', elv_pren) as LIB FROM eleve WHERE (elv_nom LIKE '%" . $str . "%' or elv_pren like '%" . $str . "%')";

                break;
            case "numerotahiti":
			
				$conn = ConnBDDpdo();
                $sql = "SELECT num_tahiti_etab as ID, nom_etab as LIB FROM ispf_ent WHERE num_tahiti_etab LIKE '%" . $str . "%'";
                break;


        }

        //req préparée dans $sql
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        //si accès bdd récup id(session_usr) et lib(tapé par usr) enregistré
        foreach ($res as $row) {
			
			$id = encryptIt($row['ID'], $_SESSION["hashsession"]);
			
			$arrtmp = array('id' => $id, 'value' => $row['LIB']);
				
			

            $return_arr[] = $arrtmp;
        }

        //renvoie un json > jQuery : format tableau
        echo json_encode($return_arr);

    } //en cas d'erreur critique > affiche l'erreur et où elle se trouve (fichier / ligne)
    catch (PDOException $e) {
        echo $e->getMessage() . " | Fichier :" . $e->getFile() . " | Ligne :" . $e->getLine();
        $conn = null;
    }
}


?>