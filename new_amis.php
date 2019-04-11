<?php
session_start();

$title = 'Mes demandes';

include_Once 'files/inc/function.php';

if(!connecter()){
    header('location: connexion.php');
    exit();
  
}

include_once "files/inc/header.inc.php";
include_once "files/inc/config.php";
include_once "files/inc/nav.inc.php";
include_once "files/inc/function.php";

$id = $_SESSION['membre']['id_user'];
$receive = executeRequete("SELECT * FROM amis WHERE id_m_receveur=$id AND statut=0");
?>
<div class="all0">
    <div class="grid-1 center"><h1>Mes demandes d'amis</h1></div>
    <div class="grid-1">
    <?php
    while ($List = $receive->fetch_assoc()) { //affiche liste demande amis
        $id_demandeur = $List['id_m_demandeur'];
        $profDem = executeRequete("SELECT * FROM user WHERE id_user=$id_demandeur");
        $amis = $profDem->fetch_assoc();
        echo '<div class="boxAmis">';
        echo '<div class="Amis">';
        echo '<span class="Lprofil"><a href="view.php?id=' . $amis['id_user'] . '"><img src="files/upload/' . $amis['photo'] . '" alt="profil de ' . $amis['username'] . '"></a></span>';
        echo '<span class="Lprofil"><a href="view.php?id=' . $amis['id_user'] . '">&nbsp;' . $amis['username'] . '</a></span>';
        echo '
    <span class="droite">
    <form class="formAmis" method="POST" action="?id=' . $amis['id_user'] . '">
    <input type="submit" class="btnM" name="addamis" value="Accepter la demande">
    <input type="submit" class="btnM rouge" name="refusamis" value="Supprimé la demande">
    </form></div></div>
    ';
    }
    ?>
    </div>
</div>
<?php
if (!empty($_POST['addamis']) && !empty($_GET['id'])) { // ajout amis
    $id     = $_GET['id'];
    $requin = executeRequete("UPDATE amis SET statut=1 WHERE id_m_demandeur=$id");
    header('location: new_amis.php');
}
if (!empty($_POST['refusamis']) && !empty($_GET['id'])) { // refus amis
    $id     = $_GET['id'];
    $requin = executeRequete("UPDATE amis SET statut=2 WHERE id_m_demandeur=$id");
    header('location: new_amis.php');
}

include_once "files/inc/footer.inc.php";

?> 