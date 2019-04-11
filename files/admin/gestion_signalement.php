<?php
session_start();

$title = 'Administration';

$metasup = '<meta name="robots" content="noindex"><meta name="googlebot" content="noindex">';

include_Once '../inc/function.php';

if (!connecter()) {
    header('location: ../../connexion.php');
    exit();
}

if (WebMaster() or Admin() or modo()){

    include_Once "../inc/header.inc.php";
    include_Once "../inc/config.php";
    include_Once "../inc/nav.inc.php";

    $all = executeRequete("SELECT * FROM signalement WHERE statut=0 ORDER BY id_signalement DESC");

    ?>
<div class="all0">
    <div class="grid-1 centrer">
        <h1>Liste des tickets de signalement non traités</h1>
<?php 
            if (isset($_GET['valid']) && $_GET['valid'] == 'ok') {
                echo '<div class="grid-1 message vert centrer">&nbsp Le ticket a bien été validé !</div>';
            }

            echo '<span>Nombre de tickets en cours : ' . $all->num_rows . '</span><br/><br/>';
            echo "<table>";
            echo '<tr>';
            while ($colonne = $all->fetch_field()) {
                echo '<th>' . $colonne->name . '</th>';
            }
            echo '<th>Valider le ticket</th>';
            echo '</tr>';
            while ($ticket = $all->fetch_assoc()) {
                echo '<tr>';
                foreach ($ticket as $information) {
                    echo '<td>' . $information . '</td>';
                }
            echo '<td><a href="traitement/validation.php?id=' .$ticket['id_signalement']. '"><img src="' .RACINE_SITE. 'files/img/OK.png" ></a></td>';
            echo '</tr>';
            }
            echo '</table>';
?>
    </div>
</div>
<?php include_Once "../inc/footer.inc.php"; 

} else {
    header('location: ../../index.php');
    exit();
}

?>