<?php
session_start();

$title = 'Mes amis';

include_Once 'files/inc/function.php';

if(!connecter()){
    header('location: connexion.php');
    exit();
  
}

include_once "files/inc/header.inc.php";
include_once "files/inc/config.php";
include_once "files/inc/nav.inc.php";
include_once "files/inc/function.php";

$id = $_SESSION['membre']['id_user']; //stockage id membre facilite insertion requete
$amis = executeRequete("SELECT * FROM amis WHERE id_m_demandeur='$id' OR id_m_receveur='$id' AND statut=1");

?>
<div class="all0">
    <div class="grid-1 center"><h1>Ma liste d'amis</h1></div>
    <?php
    /* ----------------------------- */
    /*              affi si notif    */
    /* ----------------------------- */
    if (mysqli_num_rows($receive) > 0)
        echo '<div class="grid-1 center"><a href="new_amis.php"><em>Voir mes demandes</em></a></div>';
    ?>
    <div class="grid-1">
        <?php
    /* ----------------------------- */
    /*              LIST AMIS        */
    /* ----------------------------- */
    while ($list_amis = $amis->fetch_assoc()) {
        if ($list_amis['id_m_demandeur'] == $id && $list_amis['statut'] == 1) {//si l'id du demandeur == id session
            // var_dump($list_amis);
            $profil = executeRequete("SELECT * FROM user WHERE id_user='$list_amis[id_m_receveur]'"); //select le profil de l'utilisateur correspondant a l'amis
            $ListProfil = $profil->fetch_assoc();
            echo '<div class="boxAmis">';
            echo '<div class="Amis">';
            echo '<span class="Lprofil"><a href="view.php?id=' . $ListProfil['id_user'] . '"><img src="files/upload/' . $ListProfil['photo'] . '" alt="profil de ' . $ListProfil['username'] . '"></a></span>';
            echo '<span class="Lprofil"><a href="view.php?id=' . $ListProfil['id_user'] . '">&nbsp;' . $ListProfil['username'] . '</a></span>';
            echo '
            <div class="droite inline">
            <form class="formAmis" method="POST" action="?id=' . $ListProfil['id_user'] . '">
            <input type="submit" class="btnM" name="createtable" value="Envoyé un message">
            <input type="submit"  class="btnM rouge" name="deleteFriend" value="Supprimé des amis">
            </form></div></div></div>
            ';
        }
        if ($list_amis['id_m_receveur'] == $id && $list_amis['statut'] == 1) {//si l'id du demandeur != id session
            //var_dump($list_amis);
            $profil = executeRequete("SELECT * FROM user WHERE id_user='$list_amis[id_m_demandeur]'");
            $ListProfil = $profil->fetch_assoc();
            echo '<div class="boxAmis">'; // affichage de toute la boite amis avec les infos dedans
            echo '<div class="Amis">';
            echo '<span class="Lprofil"><a href="view.php?id=' . $ListProfil['id_user'] . '"><img src="files/upload/' . $ListProfil['photo'] . '" alt="profil de ' . $ListProfil['username'] . '"></a></span>';
            echo '<span class="Lprofil"><a href="view.php?id=' . $ListProfil['id_user'] . '">&nbsp;' . $ListProfil['username'] . '</a></span>';
            echo '
            <div class="droite inline">
            <form class="formAmis" method="POST" action="?id=' . $ListProfil['id_user'] . '">
            <input type="submit" class="btnM" name="createtable" value="Envoyé un message">
            <input type="submit"  class="btnM rouge" name="deleteFriend" value="Supprimé des amis">
            </form></div></div></div>
            ';
        }
        if (isset($_GET['id']) && !empty($_POST['deleteFriend'])) {
            $delm = $_GET['id'];
            $del_m = $_SESSION['membre']['id_user'];
            $del = executeRequete("DELETE FROM amis WHERE id_m_demandeur=$delm AND id_m_receveur=$del_m OR id_m_demandeur=$del_m AND id_m_receveur=$delm ");
            header('location: amis.php');
        }
    }

    /* ----------------------------- */
    /*              MESSAGES         */
    /* ----------------------------- */
    if (!empty($_POST['createtable']) && !empty($_GET['id'])) {

        $tableName  = $_SESSION['membre']['id_user'] . $_GET['id'] . '_t';
        $tableName2 = $_GET['id'] . $_SESSION['membre']['id_user'] . '_t';
        $req1 = executeRequete("SHOW TABLES LIKE '$tableName'");
        $req2 = executeRequete("SHOW TABLES LIKE '$tableName2'");
        
        if (mysqli_num_rows($req1) == 0 && mysqli_num_rows($req2) == 0) {
            $creatMess = executeRequete("CREATE TABLE IF NOT EXISTS `$tableName` (
            id_mess    Int  Auto_increment  NOT NULL ,
            id_m    Int NOT NULL ,
            contenu    Text NOT NULL ,
            heure_mess Datetime NOT NULL,
            CONSTRAINT vfdv_PK PRIMARY KEY (id_mess)
            )ENGINE=InnoDB;");
            if ($creatMess == true) {
                $convm = $_GET['id'];
                $conv_m = $_SESSION['membre']['id_user'];
                executeRequete("UPDATE amis SET conv_debute=1 WHERE id_m_demandeur=$convm AND id_m_receveur=$conv_m OR id_m_demandeur=$conv_m AND id_m_receveur=$convm ");
                $lo = 'location: mp.php?id=' . $_GET['id'] . '&id_m=' . $_SESSION['membre']['id_user'] . '&t=' . $tableName . '&name=' . $ListProfil['username'];
                header($lo);
            }
        } else {
            if (mysqli_num_rows($req1) == 1) { // si l'id de la table commence par sont id
                $req1r = $req1->fetch_assoc();
                // var_dump($req1r);
                foreach ($req1r as $indice => $element) {
                    $name = $element;
                }
                $lo = 'location: mp.php?id=' . $_GET['id'] . '&id_m=' . $_SESSION['membre']['id_user'] . '&t=' . $name;
                header($lo);
            }
            if (mysqli_num_rows($req2) == 1) { // si l'id de la table ne commence pas par sont id
                $req2r = $req2->fetch_assoc();
                // var_dump($req2r);
                foreach ($req2r as $indice => $element) {
                    $name = $element;
                }
                $lo = 'location: mp.php?id=' . $_GET['id'] . '&id_m=' . $_SESSION['membre']['id_user'] . '&t=' . $name;
                header($lo);
            }
        }
        
    }
    ?>
    </div>
</div>
<?php
include_once "files/inc/footer.inc.php";
?> 