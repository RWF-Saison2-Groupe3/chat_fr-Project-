<?php
session_start();

$title = 'Bannisement d\'un membre';

$metasup = '<meta name="robots" content="noindex"><meta name="googlebot" content="noindex">';

include_Once '../../inc/function.php';

if (!connecter()) {
    header('location: ../../../connexion.php');
    exit();
}

if (WebMaster() or Admin() or modo()){

    include_Once "../../inc/header.inc.php";
    include_Once "../../inc/config.php";
    include_Once "../../inc/nav.inc.php";

    ?>
    <div class="all0">
        <div class="grid-1 center"><h1>Bannisement du membre </h1></div>
        <?php 
            if (isset($_GET['id']) && !isset($_GET['ban'])) {
                $id = $_GET['id'];
                $req = executeRequete("SELECT id_user,username FROM user WHERE id_user=$id");
                $result = $req->fetch_assoc();
                echo '<div class="grid-1 centrer">';
                echo 'Voulez vous vraiment bannir définitivement l\'utilisateur <span class="gras">' . $result['username'] . '</span> ?<br/><br/><br/>';
                echo '</div>';
        
                echo '<div class="grid-1 centrer">';
                echo '<form action="#" method="POST">';
                echo '<input type="checkbox" onclick="affiche_bloc(valid)" name="valid"><label for="valid">&nbsp;<span class="gras">Je valide ce bannisement</span></label><br/><br/>';
                echo '<div id="check"><input type="submit" name="validban" value="Bannir"></div>';
                echo '</form>';
                echo '</div>';
            } else {
                header('location: ' .RACINE_SITE. '404.php');
                exit();
            }


            if (isset($_GET['id']) && isset($_POST['validban'])) {

                executeRequete("DELETE FROM user WHERE id_user=$id");
                
                header('refresh: 0; url=../admin.php?ban=ok');
            } 

        ?>
    </div>
    <script>
    function affiche_bloc(CheckBox) {

        if (CheckBox.checked) {
            document.getElementById("check").style.display="block";
        } else {
            document.getElementById("check").style.display="none";
            }
    }
    </script>
    <?php include_Once "../../inc/footer.inc.php"; 

    } else {
        header('location: ' .RACINE_SITE. 'index.php');
        exit();
    }

    ?>