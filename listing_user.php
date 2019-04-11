<?php
session_start();

$title = 'Forum';

include_Once 'files/inc/function.php';

if(!connecter()){
    header('location: connexion.php');
    exit();
  
}

include_Once "files/inc/header.inc.php";
include_Once "files/inc/config.php";
include_Once "files/inc/nav.inc.php";
include_once "files/inc/function.php";

$req = executeRequete("SELECT id_user, username, photo, statut_m FROM user")

?>
<div class="all0">
    <div class="grid-1 centrer"><h1>Liste des utilisateurs incrits</h1></div>
    <div class="grid-1">
    <?php 
    while ($list_user = $req->fetch_assoc()) { ?>
        <div class="boxUser">
        <div class="user">
        <span class="Lprofil"><a href="view.php?id=<?php echo $list_user['id_user'] ?>"><img src="files/upload/<?php echo $list_user['photo'] ?>" alt="profil de '<?php echo $list_user['username']?>"></a></span>
        <span class="Lprofil"><a href="view.php?id=<?php echo $list_user['id_user'] ?>">&nbsp;<?php echo $list_user['username'];
            if ($list_user['statut_m'] == 10) echo '<span class="webmaster">WebMaster</span>';
            if ($list_user['statut_m'] == 9) echo '<span class="admin">Admin</span>';
            if ($list_user['statut_m'] == 5) echo '<span class="modo">Modérateur</span>';
        ?></a></span>
        </div>
        </div>
<?php } ?>
    </div>
</div>
<?php
include_Once "files/inc/footer.inc.php";
?>