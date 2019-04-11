<?php
session_start();

$title = 'Dé-gradé un membre';

$metasup = '<meta name="robots" content="noindex"><meta name="googlebot" content="noindex">';

include_Once '../../inc/function.php';

if (!connecter()) {
    header('location: ../../connexion.php');
    exit();
}
if (WebMaster() or Admin() or modo()){

include_Once "../../inc/header.inc.php";
include_Once "../../inc/config.php";
include_Once "../../inc/nav.inc.php";
?>
    <div class="all0">
        <div class="grid-1 center"><h1>Down-grade du membre </h1></div>
        <?php 
            if (isset($_GET['id']) && !isset($_GET['ban'])) {
                

                $req = executeRequete("SELECT id_user, username, statut_m FROM user WHERE id_user=$id");
                $result = $req->fetch_assoc();
                echo '<div class="grid-1 centrer">';
                echo 'Quel nouveau grade voulez vous attribué a l\'utilisateur <span class="gras">' . $result['username'] . '</span> ?<br/><br/><br/>';
                echo '<div class="grid-1 centrer">';
                echo '<form action="#" method="POST">';
                ?>
                 <select id="grade-select" name="selection">
                    <option value="" disable hidden>--Veuillez choisir un grade--</option>
                   <?php if (WebMaster() or Admin()) {
                    ?>
                    <option id="admin" value="9" onclick="affiche_bloc(admin)" >Admin</option>
                    <?php }?>
                    <option id="modo" value="5" onclick="affiche_bloc(modo)" >Modo</option>
                    <option id="membre" value="0" onclick="affiche_bloc(membre)" >Utilisateur lambda</option>
                 </select><br/><br/>
                 <?php
                 echo '<div id="select"><input type="submit" name="changeGrade" value="Valider"></div>';
                 echo '</form>';
                 echo '</div>';
            } else {
                header('location: ' .RACINE_SITE. '404.php');
                exit();
            }

            if (isset($_GET['id']) && isset($_POST['changeGrade'])) {
                
                $id = $_GET['id'];

                if ($_POST['selection'] == 0 ) {

                    executeRequete("UPDATE user SET statut_m=0 WHERE id_user=$id");

                    header('refresh: 0; url=../admin.php?down=ok');

                } else if ($_POST['selection'] == 5 ) {

                    executeRequete("UPDATE user SET statut_m=5 WHERE id_user=$id");

                    header('refresh: 0; url=../admin.php?down=ok');

                } else if ($_POST['selection'] == 9 ) {

                    executeRequete("UPDATE user SET statut_m=9 WHERE id_user=$id");

                    header('refresh: 0; url=../admin.php?down=ok');

                }
                
            }
        ?>
        </div>
    </div>
    <script>
    function affiche_bloc(CheckBox) {

        if (CheckBox.selected) {
            document.getElementById("select").style.display="block";
        } else {
            document.getElementById("select").style.display="none";
            }
    }
    </script>
<?php include_Once "../../inc/footer.inc.php"; 

} else {
    header('location: ../../../index.php');
    exit();
 }

?>