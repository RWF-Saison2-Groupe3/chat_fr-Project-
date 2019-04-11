<?php
session_start();

$title = 'Mes options';

include_Once 'files/inc/function.php';

if(!connecter()){
    header('location: connexion.php');
    exit();
  
}

include_Once "files/inc/header.inc.php";
include_Once "files/inc/config.php";
include_Once "files/inc/nav.inc.php";

$id = $_GET['id'];
$info = executeRequete("SELECT all_mess FROM user WHERE id_user=$id");
$mes = $info->fetch_assoc();

?>
<div class="all0">
    <div class="grid-1 center"><h1>Mes paramètres</h1></div>
    <div class="grid-1 center form">
        <h2>Changer de mot de passe</h2>
        <form action="files/inc/traitement.php?id=<?php echo $_GET['id']; ?>" method="POST">
            <input type="password" name="chd_pass" placeholder="Entrez le nouveau mot de passe" required><br /><br />
            <input type="password" name="chd_pass_repeat" placeholder="Confirmez le mot de passe" required><br /><br />
            <input type="submit" value="Changer mon mot de passe" name="chd_pass_sub">
        </form><br /><br />
        <hr>
    </div>
    <div class="grid-1 center">
        <h2>Messages</h2>
        <form action="files/inc/traitement.php?id=<?php echo $_GET['id']; ?>" method="POST">
            <input type="checkbox"<?php if ($mes['all_mess'] == 0) echo 'checked="checked"'; ?> name="mssg_amis">&nbsp;<span class="gras">Seul mes amis peuvent m'envoyer des messages</span>
            <input type="submit" value="Modifié" name="swichFriend"><br /><br /><br />
        </form>
        <hr>
    </div>
    <div class="grid-1 center">
        <h2>Supprimé mon compte</h2>
        <span class="textrouge"><em>Cette action supprimera définitivement votre compte sans retour possible a sont état d'origine</em></span>
        <form action="files/inc/traitement.php?id=<?php echo $_GET['id']; ?>" method="POST"><br />
            <input type="password" name="suppr_pass" placeholder="votre mot de passe" required><br /><br />
            <input type="submit" value="Supprimé mon compte" onclick="return(confirm('Etes-vous sûr de vouloir supprimer votre compte ?'));" name="suppr_compte">
        </form>
    </div>
</div>

<?php
include_once "files/inc/footer.inc.php";

?>