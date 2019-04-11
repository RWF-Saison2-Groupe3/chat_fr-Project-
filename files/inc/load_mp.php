<?php
session_start();

include_once "function.php";
include_Once 'config.php';

if(!connecter()){
    header('location: connexion.php');
    exit();
  
}

?>
      <?php
        $id_m = $_GET['id'];
        $table = $_GET['t'];
        $query = executeRequete("SELECT * FROM $table");
        // $rep = $query->fetch_assoc();
        // recup table de l'utilisateur 
        $qury = executeRequete("SELECT * FROM user WHERE id_user=$id_m");
        $profil = $qury->fetch_assoc();

       while ($rep = $query->fetch_assoc()) {
        if (!empty($rep['heure_mess'])) {
            $pp = $rep['heure_mess'];
            $exploded = multiexplode(array("-",":"," "), $pp);
            $verif = $exploded[2] . "/" . $exploded[1] . "/" . $exploded[0];
            $verifAN = $exploded[0];
            if (date("d/m/Y") == $verif)
                $heure = $exploded[3] . ":" . $exploded[4];
            if (date("d/m/Y") != $verif)
                $heure = "Le " . $exploded[2] . "/" . $exploded[1] . "&nbsp;à&nbsp;" . $exploded[3] . ":" . $exploded[4]; //sans année
            if (date("Y") != $verifAN)
                $heure = "Le " . $exploded[2] . "/" . $exploded[1] . "/" . $exploded[0] . "&nbsp;à&nbsp;" . $exploded[3] . ":" . $exploded[4];
        }
        if ($rep['id_m'] != $_SESSION['membre']['id_user']) {
            echo '<div class="miniPc">';
            echo '<a href="view.php?id=' . $profil['id_user'] . '"><img src="files/upload/' . $profil['photo'] . '" alt="photo de profil de ' . $profil['username'] . '"></a></div>&nbsp;';
            echo '<div class="pseudo"><span>' . $profil['username'] . '</span></div>
          <div class="message">&nbsp;<span>:</span>&nbsp;<span>' . $rep['contenu'] . '</span></div>
          <div class="heure">
            <span>' . $heure . '</span>
          </div>
          ';
            echo '<br />';
        }
        if ($rep['id_m'] == $_SESSION['membre']['id_user']) {
            echo '<div class="miniPc">';
            echo '<a href="view.php?id=' . $_SESSION['membre']['id_user'] . '"><img src="files/upload/' . $_SESSION['membre']['photo'] . '" alt="photo de profil de ' . $_SESSION['membre']['username'] . '"></a></div>&nbsp;';
            echo '<div class="pseudo"><span>' . $_SESSION['membre']['username'] . '</span></div>
          <div class="message">&nbsp;<span>:</span>&nbsp;<span>' . $rep['contenu'] . '</span></div>
          <div class="heure">
            <span>' . $heure . '</span>
          </div>
          ';
            echo '<br />';
        }
    }
?>