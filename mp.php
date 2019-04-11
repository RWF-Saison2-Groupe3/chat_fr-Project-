<?php
session_start();

$load = 'onLoad="load_mp()"';

$title = 'Messagerie privé';

include_Once 'files/inc/function.php';

if(!connecter()){
    header('location: connexion.php');
    exit();

}

include_Once "files/inc/header.inc.php";
include_Once "files/inc/config.php";
include_Once "files/inc/nav.inc.php";

if (!empty($_GET['id']) && !empty($_GET['id_m'])) {

    /*---------- securisation mp--------------- */
    if ($_GET['id_m'] != $_SESSION['membre']['id_user']) {
        header('location: 404.php');
    }
    /* ---------------------------------------- */

    $id_m = $_GET['id'];
    $table = $_GET['t'];
    // recup table conv
    $query = executeRequete("SELECT * FROM $table");
    // $rep = $query->fetch_assoc();
    // recup table de l'utilisateur 
    $qury = executeRequete("SELECT * FROM user WHERE id_user=$id_m");
    $profil = $qury->fetch_assoc();
    
    if (mysqli_num_rows($qury) == 0) {
        $qdel = executeRequete("DROP TABLE $table");
        
        header('location: 404.php');
    }
?>
<?php
if (isset($_POST['pvm']) && !empty($_POST['message'])) {
    $_POST['message'] = htmltrim($_POST['message']);
    $_POST['message'] = addslashes($_POST['message']);
    $contenu_m = $_POST['message'];
    $send = $_SESSION['membre']['id_user'];
    $mess = executeRequete("INSERT INTO $table (id_m, contenu, heure_mess) VALUES ('$send', '$contenu_m' , NOW())") OR DIE($mysqli->error);
    
    $page = $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
    header("location: $page");
    }
}
?>
<div class="all0">
<div class="grid-1 center"><h1>Conversation avec&nbsp;<?php echo $profil['username']; ?></h1></div>
<div class="grid-9 chat" id="mp_chat">
      <?php
//     while ($rep = $query->fetch_assoc()) {
//         if (!empty($rep['heure_mess'])) {
//             $pp = $rep['heure_mess'];
//             $exploded = multiexplode(array("-",":"," "), $pp);
//             $verif = $exploded[2] . "/" . $exploded[1] . "/" . $exploded[0];
//             $verifAN = $exploded[0];
//             if (date("d/m/Y") == $verif)
//                 $heure = $exploded[3] . ":" . $exploded[4];
//             if (date("d/m/Y") != $verif)
//                 $heure = "Le " . $exploded[2] . "/" . $exploded[1] . "&nbsp;à&nbsp;" . $exploded[3] . ":" . $exploded[4]; //sans année
//             if (date("Y") != $verifAN)
//                 $heure = "Le " . $exploded[2] . "/" . $exploded[1] . "/" . $exploded[0] . "&nbsp;à&nbsp;" . $exploded[3] . ":" . $exploded[4];
//         }
//         if ($rep['id_m'] != $_SESSION['membre']['id_user']) {
//             echo '<div class="miniPc">';
//             echo '<a href="view.php?id=' . $profil['id_user'] . '"><img src="files/upload/' . $profil['photo'] . '" alt="photo de profil de ' . $profil['username'] . '"></a></div>&nbsp;';
//             echo '<div class="pseudo"><span>' . $profil['username'] . '</span></div>
//           <div class="message">&nbsp;<span>:</span>&nbsp;<span>' . $rep['contenu'] . '</span></div>
//           <div class="heure">
//             <span>' . $heure . '</span>
//           </div>
//           ';
//             echo '<br />';
//         }
//         if ($rep['id_m'] == $_SESSION['membre']['id_user']) {
//             echo '<div class="miniPc">';
//             echo '<a href="view.php?id=' . $_SESSION['membre']['id_user'] . '"><img src="files/upload/' . $_SESSION['membre']['photo'] . '" alt="photo de profil de ' . $_SESSION['membre']['username'] . '"></a></div>&nbsp;';
//             echo '<div class="pseudo"><span>' . $_SESSION['membre']['username'] . '</span></div>
//           <div class="message">&nbsp;<span>:</span>&nbsp;<span>' . $rep['contenu'] . '</span></div>
//           <div class="heure">
//             <span>' . $heure . '</span>
//           </div>
//           ';
//             echo '<br />';
//         }
//     }
// } else {

//         header('location: 404.php');
    
    
// }

?> 
</div>
    <div id="chatref" class="grid-9 entree">
      <div class="entree">
            <form method="post" autocomplete="off" action="#">
                <input class="champMess" type="text" id="message" name="message" placeholder="Pas d'insultes, de messages inaproprié ou de données personnels" size="120" required>
                <input type="submit" name="pvm" value="envoyer">
            </form>
        </div>
    </div>
</div>
<script>
    setInterval('load_mp()', 1000);
    function load_mp() {
        $('#mp_chat').load('files/inc/load_mp.php?id=<?php echo $id_m;?>&id_m=<?php echo $_GET['id_m'];?>&t=<?php echo $table;?>');
    }
</script>
<?php
include_once "files/inc/footer.inc.php";
?> 