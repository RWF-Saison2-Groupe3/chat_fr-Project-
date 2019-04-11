<?php
session_start();

include_once 'files/inc/function.php';

if (!connecter()) {
    header('location: connexion.php');
    exit();
}

include_once "files/inc/config.php";

if (!isset($_GET['id'])) {
    header('location: 404.php');
}
if (!empty($_GET['id'])) {
    $query = executeRequete("SELECT * FROM user WHERE id_user=$_GET[id]");
    $rep   = $query->fetch_assoc();

    if (mysqli_num_rows($query) == 0) {
        header('location: 404.php');
    }
}
$id = $_SESSION['membre']['id_user'];
$id_r = $_GET['id'];
$exist = executeRequete("SELECT * FROM amis WHERE id_m_demandeur=$id AND id_m_receveur=$id_r OR id_m_demandeur=$id_r AND id_m_receveur=$id "); // verif si demande existe ou pas
$statut = $exist->fetch_assoc();
/* ------------------------------------------------------------------------- */
/* TRAITEMENT DEMANDE AMIS */
if (isset($_GET['ajout']) && $_GET['ajout'] == 't') {
    if (mysqli_num_rows($exist) == 0) {
        $req1 = executeRequete("INSERT INTO amis (id_amis, id_m_demandeur, id_m_receveur, conv_debute, statut) VALUES (NULL, '$id', '$id_r', 0, 0)") or die($mysqli->error);
        if ($req1 == true)
            $val = '<span class="textvert">Demande envoyé</span>';
    } else {
        $val = '<span class="textrouge">Une demande à déjà été envoyer</span>';
    }
    if ($statut['statut'] == 2) {
        $val = '<span class="textrouge">L\'utilisateur à refuser votre demande.</span>';
    }
}
/* ------------------------------------------------------------------------- */
/* DEMANDE FAV*/
if (isset($_GET['ajoutf']) && $_GET['ajoutf'] == 't') {
    $id_m = $_SESSION['membre']['id_user'];
    $fav = executeRequete("SELECT fav_m FROM user WHERE id_user=$id_m");
    $Listfav = $fav->fetch_assoc();
    if (empty($Listfav['fav_m'])) {
        $id = $_GET['id'] . ',';
        executeRequete("UPDATE user SET fav_m='$id' WHERE id_user=$id_m");
        if ($mysqli == true)
            $val = '<span class="textvert">Ajouté a vos favoris</span>';
        if ($mysqli != true)
            $val = '<span class="textrouge">Une erreur est survenue</span>';
    }
    if (!empty($Listfav['fav_m'])) {
        $favi = $Listfav['fav_m'];
        $id   = $_GET['id'] . ',';
        $comp = $favi . $id;
        executeRequete("UPDATE user SET fav_m='$comp' WHERE id_user=$id_m");
        if ($mysqli == true)
            $val = '<span class="textvert">Ajouté a vos favoris</span>';
        if ($mysqli != true)
            $val = '<span class="textrouge">Une erreur est survenue</span>';
    }
}

/* ------------------------------------------------------------------------- */
/* BLOCKAGE  */
if (isset($_GET['block']) && $_GET['block'] == 't') { }
/* ------------------------------------------------------------------------- */

$title = $rep['username'];

include_once "files/inc/header.inc.php";
include_once "files/inc/nav.inc.php";
?>
<div class="all0">
    <h1 class="centrer">Profil de <?php echo $rep["username"];
                                    if ($rep['statut_m'] == 10) echo '<span class="webmaster">WebMaster</span>';
                                    if ($rep['statut_m'] == 9) echo '<span class="admin">Admin</span>';
                                    if ($rep['statut_m'] == 5) echo '<span class="modo">Modérateur</span>'; ?></h1>
    <?php
    if (isset($val))
        echo '<h1 class="centrer">' . $val . '</h1>';
    ?>
    <div class="grid-1 centrer">
        <div class="photoP">
            <img src="files/upload/<?php echo $rep["photo"]; ?>" alt="Photo de profil de <?php echo $rep['username']; ?>">
        </div>
    </div>
    <div class="grid-1 center">
        <?php
        if ($_GET['id'] != $_SESSION['membre']['id_user']) {
            if ($statut['statut'] != 1) {
                $id = $_GET['id'];
                if ($rep['all_mess'] == 1) {
                    echo '<form method="POST" action="?id=' . $_GET['id'] . '">
                      <input type="submit" name="createtable" class="btn vert" value="Envoyé un message">';
                }
                echo '
        <a href="?id=' . $id . '&ajout=t" class="btn vert">Ajouter aux amis </a>
        <a href="?id=' . $id . '&ajoutf=t" class="btn orange">Ajouter aux favoris </a>
        <a href="?id=' . $id . '&block=t" class="btn">Bloquer </a>
        ';
            }
            if ($statut['statut'] == 1) {
                $id = $_GET['id'];
                echo '
        <form method="POST" action="?id=' . $_GET['id'] . '">
        <input type="submit" name="createtable" class="btn vert" value="Envoyé un message">
        <a href="?id=' . $id . '&ajoutf=t" class="btn orange">Ajouter aux favoris </a>
        <a href="?id=' . $id . '&block=t" class="btn">Bloquer </a>
        </form>';
            }
        }

        if ($statut['statut'] == 1 or $rep['all_mess'] == 1) {
            if (isset($_POST['createtable']) && !empty($_GET['id'])) {

                $tableName = $_SESSION['membre']['id_user'] . $_GET['id'] . '_t';
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

                    if ($statut['statut'] != 1 && $creatMess == true) {
                        $id = $_SESSION['membre']['id_user'];
                        $id_r = $_GET['id'];
                        if ( $rep['all_mess'] == 1) {
                            executeRequete("INSERT INTO amis (id_amis, id_m_demandeur, id_m_receveur, conv_debute, statut) VALUES (NULL, '$id', '$id_r', 1, 3)") or die($mysqli->error);
                        }
                        $lo = 'location: mp.php?id=' . $_GET['id'] . '&id_m=' . $_SESSION['membre']['id_user'] . '&t=' . $tableName;
                        header($lo);
                    }
                } else {
                    if (mysqli_num_rows($req1) == 1) { // si l'id de la table commence par sont id
                        $req1r = $req1->fetch_assoc();
                        var_dump($req1r);
                        foreach ($req1r as $indice => $element) {
                            $name = $element;
                        }
                        $lo = 'location: mp.php?id=' . $_GET['id'] . '&id_m=' . $_SESSION['membre']['id_user'] . '&t=' . $name;
                        header($lo);
                    }
                    if (mysqli_num_rows($req2) == 1) { // si l'id de la table ne commence pas par sont id
                        $req2r = $req2->fetch_assoc();
                        var_dump($req2r);
                        foreach ($req2r as $indice => $element) {
                            $name = $element;
                        }
                        $lo = 'location: mp.php?id=' . $_GET['id'] . '&id_m=' . $_SESSION['membre']['id_user'] . '&t=' . $name;
                        header($lo);
                    }
                }
            }
        }

        ?>
    </div>
    <div class="grid-1 centrer" style="margin-top: 10px;">
        <span style="font-weight: bold;">Message d'humeur :</span><br /><br />
        <span><?php echo $rep["humeur"]; ?></span>
    </div>

    <div class="grid-1 centrer" style="margin-top: 10px;">
        <span style="font-weight: bold;">Description :</span><br /><br />
        <?php if (!empty($rep['description'])) echo '<div class="description"><span>' . htmltrim(addslashes(nl2br($rep["description"]))) . '</span></div>'; ?>
    </div>

    <div class="grid-1 centrer" style="margin-top: 15px;">
        <span style="font-weight: bold;">Centre d'interet</span><br />
    </div>
    <div class="grid-1 centrer" style="margin-top: 20px;">
        <span>
            <?php
            if (!empty($rep['centre_interet'])) {
                $affi1 = explode(",", $rep["centre_interet"]); // J'explose le char de séparation
                $count = count($affi1); // Je compte combien j'ai de survivants
                for ($i = 0; $i < $count; $i++) { // boucle for jusqu'au nombre de mot j'affiche
                    $affi = '<span class="inter">' . $affi1[$i] . '</span>';
                    echo $affi;
                }
            } else {
                $affi = '<span class="inter">Vide</span>';
                echo $affi;
            }
            ?>
        </span>
    </div>
</div>
<?php
include_once "files/inc/footer.inc.php";
?>