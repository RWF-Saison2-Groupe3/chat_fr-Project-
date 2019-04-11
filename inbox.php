<?php
session_start();

$title = 'Boite de reception';

include_Once 'files/inc/function.php';

if(!connecter()){
    header('location: connexion.php');
    exit();
  
}

include_Once "files/inc/header.inc.php";
include_Once "files/inc/config.php";
include_Once "files/inc/nav.inc.php";

$id = $_SESSION['membre']['id_user'];
$conv = executeRequete("SELECT * FROM amis WHERE id_m_demandeur='$id' AND conv_debute=1 OR id_m_receveur='$id' AND conv_debute=1");

?>
<div class="all0">
    <div class="grid-1 center"><h1>Mes messages privé</h1></div>
    <div class="grid-1">
    <?php
    while ($conversation = $conv->fetch_assoc()) {
                                                                                /* ----------------------------- */
                                                                                /*   Si id demandeur = id session */
                                                                                /* ----------------------------- */

        if ($conversation['id_m_demandeur'] == $_SESSION['membre']['id_user']) {
            $id_user = $conversation['id_m_receveur'];
            $user = executeRequete("SELECT id_user,username, photo FROM user WHERE id_user=$id_user");
            $profil = $user->fetch_assoc();
            // var_dump($profil);

            /* ----------------------------- */
            /*              TABLE MP         */
            /* ----------------------------- */

            $tableName  = $_SESSION['membre']['id_user'] . $id_user . '_t';
            $tableName2 = $id_user . $_SESSION['membre']['id_user'] . '_t';
            $req1 = executeRequete("SHOW TABLES LIKE '$tableName'");
            $req2 = executeRequete("SHOW TABLES LIKE '$tableName2'");

            if (mysqli_num_rows($req1) != 0) {
                $msg = executeRequete("SELECT id_m,contenu, heure_mess FROM $tableName ORDER BY id_mess DESC LIMIT 1");
                $msgF = $msg->fetch_assoc();
                // var_dump($msgF);

                $tag = $msgF['id_m'];
                if ( $tag == $_SESSION['membre']['id_user']) $use = 'vous';
                if ( $tag != $_SESSION['membre']['id_user']) $use = $profil['username'];

                $pp = $msgF['heure_mess'];
                $exploded = multiexplode(array("-",":"," "), $pp);
                $verif = $exploded[2] . "/" . $exploded[1] . "/" . $exploded[0];
                $verifAN = $exploded[0];
                if (date("d/m/Y") == $verif)
                    $heure = $exploded[3] . ":" . $exploded[4];
                if (date("d/m/Y") != $verif)
                    $heure = "Le " . $exploded[2] . "/" . $exploded[1] . "&nbsp;à&nbsp;" . $exploded[3] . ":" . $exploded[4]; //sans année
                if (date("Y") != $verifAN)
                    $heure = "Le " . $exploded[2] . "/" . $exploded[1] . "/" . $exploded[0] . "&nbsp;à&nbsp;" . $exploded[3] . ":" . $exploded[4];

                $table = $tableName;
            }

            if (mysqli_num_rows($req2) != 0) {
                $msg =  executeRequete("SELECT id_m,contenu, heure_mess FROM $tableName2 ORDER BY id_mess DESC LIMIT 1");
                $msgF = $msg->fetch_assoc();
                // var_dump($msgF);

                $tag = $msgF['id_m'];
                if ( $tag == $_SESSION['membre']['id_user']) $use = 'vous';
                if ( $tag != $_SESSION['membre']['id_user']) $use = $profil['username'];
                
                $pp = $msgF['heure_mess'];
                $exploded = multiexplode(array("-",":"," "), $pp);
                $verif = $exploded[2] . "/" . $exploded[1] . "/" . $exploded[0];
                $verifAN = $exploded[0];
                if (date("d/m/Y") == $verif)
                    $heure = $exploded[3] . ":" . $exploded[4];
                if (date("d/m/Y") != $verif)
                    $heure = "Le " . $exploded[2] . "/" . $exploded[1] . "&nbsp;à&nbsp;" . $exploded[3] . ":" . $exploded[4]; //sans année
                if (date("Y") != $verifAN)
                    $heure = "Le " . $exploded[2] . "/" . $exploded[1] . "/" . $exploded[0] . "&nbsp;à&nbsp;" . $exploded[3] . ":" . $exploded[4];

                $table = $tableName2;
            }

            /* ----------------------------- */
            /*              AFFICHAGE        */
            /* ----------------------------- */
            
            echo '<div class="boxAmis">'; // affichage de toute la boite amis avec les infos dedans
            echo '<div class="Amis">';
            echo '<span class="Lprofil"><a href="view.php?id=' . $profil['id_user'] . '"><img src="files/upload/' . $profil['photo'] . '" alt="profil de ' . $profil['username'] . '"></a></span>';
            echo '<span class="Lprofil"><a href="view.php?id=' . $profil['id_user'] . '">&nbsp;' . $profil['username'] . '</a></span>';
            echo '
        <div class="droite inline">
        <a class="nodeco" href="mp.php?id='.$id_user.'&id_m='.$_SESSION['membre']['id_user'].'&t='.$table.'"><span class="hoverRed">Afficher la conversation</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
        <a class="nodeco mobilNone" href="mp.php?id='.$id_user.'&id_m='.$_SESSION['membre']['id_user'].'&t='.$table.'">Dernier message : <div class="inline mobileNone">'.$heure.'&nbsp;:&nbsp;<span class="gras">'.$msgF['contenu'].'</span> de '.$use.'</div>
        </a></div></div></div><hr>
            ';
            
            echo "<br/>";
        }

                                                                    /* ----------------------------- */
                                                                    /*   Si id receveur = id session */
                                                                    /* ----------------------------- */

        if ($conversation['id_m_receveur'] == $_SESSION['membre']['id_user']) {
            $id_user = $conversation['id_m_demandeur'];
            $user = executeRequete("SELECT id_user,username, photo FROM user WHERE id_user=$id_user");
            $profil = $user->fetch_assoc();
            // var_dump($profil);

            /* ----------------------------- */
            /*              TABLE MP         */
            /* ----------------------------- */

            $tableName  = $_SESSION['membre']['id_user'] . $id_user . '_t';
            $tableName2 = $id_user . $_SESSION['membre']['id_user'] . '_t';
            $req1 = executeRequete("SHOW TABLES LIKE '$tableName'");
            $req2 = executeRequete("SHOW TABLES LIKE '$tableName2'");

            if (mysqli_num_rows($req1) != 0) {
                $msg = executeRequete("SELECT id_m,contenu, heure_mess FROM $tableName ORDER BY id_mess DESC LIMIT 1");
                $msgF = $msg->fetch_assoc();
                // var_dump($msgF);

                $tag = $msgF['id_m'];
                if ( $tag == $_SESSION['membre']['id_user']) $use = 'vous';
                if ( $tag != $_SESSION['membre']['id_user']) $use = $profil['username'];


                $pp = $msgF['heure_mess'];
                $exploded = multiexplode(array("-",":"," "), $pp);
                $verif = $exploded[2] . "/" . $exploded[1] . "/" . $exploded[0];
                $verifAN = $exploded[0];
                if (date("d/m/Y") == $verif)
                    $heure = $exploded[3] . ":" . $exploded[4];
                if (date("d/m/Y") != $verif)
                    $heure = "Le " . $exploded[2] . "/" . $exploded[1] . "&nbsp;à&nbsp;" . $exploded[3] . ":" . $exploded[4]; //sans année
                if (date("Y") != $verifAN)
                    $heure = "Le " . $exploded[2] . "/" . $exploded[1] . "/" . $exploded[0] . "&nbsp;à&nbsp;" . $exploded[3] . ":" . $exploded[4];

                $table = $tableName;
            }

            if (mysqli_num_rows($req2) != 0) {
                $msg =  executeRequete("SELECT id_m,contenu, heure_mess FROM $tableName2 ORDER BY id_mess DESC LIMIT 1");
                $msgF = $msg->fetch_assoc();
                // var_dump($msgF);
                
                $tag = $msgF['id_m'];
                if ( $tag == $_SESSION['membre']['id_user']) $use = 'vous';
                if ( $tag != $_SESSION['membre']['id_user']) $use = $profil['username'];


                $pp = $msgF['heure_mess'];
                $exploded = multiexplode(array("-",":"," "), $pp);
                $verif = $exploded[2] . "/" . $exploded[1] . "/" . $exploded[0];
                $verifAN = $exploded[0];
                if (date("d/m/Y") == $verif)
                    $heure = $exploded[3] . ":" . $exploded[4];
                if (date("d/m/Y") != $verif)
                    $heure = "Le " . $exploded[2] . "/" . $exploded[1] . "&nbsp;à&nbsp;" . $exploded[3] . ":" . $exploded[4]; //sans année
                if (date("Y") != $verifAN)
                    $heure = "Le " . $exploded[2] . "/" . $exploded[1] . "/" . $exploded[0] . "&nbsp;à&nbsp;" . $exploded[3] . ":" . $exploded[4];

                $table = $tableName2;
            }    

            /* ----------------------------- */
            /*              AFFICHAGE        */
            /* ----------------------------- */

            echo '<div class="boxAmis">'; // affichage de toute la boite amis avec les infos dedans
            echo '<div class="Amis">';
            echo '<span class="Lprofil"><a href="view.php?id=' . $profil['id_user'] . '"><img src="files/upload/' . $profil['photo'] . '" alt="profil de ' . $profil['username'] . '"></a></span>';
            echo '<span class="Lprofil"><a href="view.php?id=' . $profil['id_user'] . '">&nbsp;' . $profil['username'] . '</a></span>';
            echo '
            <div class="droite inline">
            <a class="nodeco" href="mp.php?id='.$id_user.'&id_m='.$_SESSION['membre']['id_user'].'&t='.$table.'"><span class="hoverRed">Afficher la conversation</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
            <a class="nodeco mobilNone" href="mp.php?id='.$id_user.'&id_m='.$_SESSION['membre']['id_user'].'&t='.$table.'">Dernier message : <div class="inline mobileNone">'.$heure.'&nbsp;:&nbsp;<span class="gras">'.$msgF['contenu'].'</span> de '.$use.'</div>
            </a></div></div></div><hr>
            ';

            echo "<br/>";
        }
    }
    ?>
    </div>
</div>

<?php
include_once "files/inc/footer.inc.php";
?> 