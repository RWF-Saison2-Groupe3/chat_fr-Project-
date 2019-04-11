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
    
    if (isset($_GET['ban']) && $_GET['ban'] == 'ok') {
        echo '<div class="grid-1 message vert centrer">&nbsp Le membre à bien été bannis !</div>';
    }

    if (isset($_GET['down']) && $_GET['down'] == 'ok') {
        echo '<div class="grid-1 message vert centrer">&nbsp Le statut du membre à bien été modifié !</div>';
    }

    ?>
    <div class="all0">
            <div class="grid-1 center"><h1>Panel d'administration</h1></div>
            <div class="grid-1 centrer">
                <hr>
                <h2>Liste des tickets de signalements</h2>
                <a class="nodeco lienem" href="gestion_signalement.php"><em>Cliquer ici pour voir tout les tickets en attente</em></a><br/><br/>
                <span>Dernier ticket :</span>
            <?php 
            $all = executeRequete("SELECT * FROM signalement WHERE statut=0 ORDER BY id_signalement DESC LIMIT 1");
            $sign = $all->fetch_assoc();
            echo "<table><tr>";
            echo '<th>Membre signalés</th>';
            echo '<th>Message signalés</th>';
            echo '</tr><tr>';
            echo '<td>' . $sign['id_m_signaler'] . '</td>';
            echo '<td>' . $sign['id_mess_signaler'] . '</td>';
            echo '</tr></table><hr>';
            ?>
            </div>
            <div class="grid-1 centrer">
                <h2>Liste des utilisateurs</h2>
            <?php 
            $user = executeRequete("SELECT id_user, username, statut_m FROM user");
            echo '<span>Nombre d\'utilisateur inscrit : ' . $user->num_rows . '</span><br/><br/>';
            echo "<table>";
            echo '<tr>';
            while ($colonne = $user->fetch_field()) {
                echo '<th>' . $colonne->name . '</th>';
            }
            echo '<th>Bannir le membre</th>';
            echo '<th>Promouvoir le membre</th>';
            echo '</tr>';
            while ($membre = $user->fetch_assoc()) {
                echo '<tr>';
                foreach ($membre as $information) {
                    echo '<td>' . $information . '</td>';
                }
                if ($membre['statut_m'] == 0) {
                    echo '<td><a class="nodeco hoverRed" href="traitement/bannisement.php?id=' .$membre['id_user']. '">Bannir le membre</a></td>';
                    echo '<td><a class="nodeco hoverRed" href="traitement/upgrade.php?id=' .$membre['id_user']. '">Promouvoir</a></td>';
                }   
                if (WebMaster() && $membre['statut_m'] == 5) {
                    echo '<td><a class="nodeco hoverRed" href="traitement/bannisement.php?id=' .$membre['id_user']. '">Bannir le membre</a></td>';
                    echo '<td><a class="nodeco hoverRed" href="traitement/downgrade.php?id=' .$membre['id_user']. '">Modifié le grade du membre</a></td>';
                }  
                if (WebMaster() && $membre['statut_m'] == 9 ) {
                    echo '<td><a class="nodeco hoverRed" href="traitement/bannisement.php?id=' .$membre['id_user']. '">Bannir le membre</a></td>';
                    echo '<td><a class="nodeco hoverRed" href="traitement/downgrade.php?id=' .$membre['id_user']. '">Modifié le grade du membre</a></td>';
                }  
                if (Admin() && $membre['statut_m'] == 5) {
                    echo '<td><a class="nodeco hoverRed" href="traitement/bannisement.php?id=' .$membre['id_user']. '">Bannir le membre</a></td>';
                    echo '<td><a class="nodeco hoverRed" href="traitement/downgrade.php?id=' .$membre['id_user']. '">Modifié le grade du membre</a></td>';
                }  
                if (Admin() && $membre['statut_m'] == 10) {
                    echo '<td></td>';
                    echo '<td></td>';
                }         
                if (Admin() && $membre['statut_m'] == 9) {
                    echo '<td></td>';
                    echo '<td></td>';
                } 
                if (modo() && $membre['statut_m'] == 10) {
                    echo '<td></td>';
                    echo '<td></td>';
                }        
                if (modo() && $membre['statut_m'] == 9) {
                    echo '<td></td>';
                    echo '<td></td>';
                }        
                if (modo() && $membre['statut_m'] == 5) {
                    echo '<td></td>';
                    echo '<td></td>';
                }        
            }
            echo '</tr>';
            echo "</table>";
            ?>        
            </div>
    </div>
<?php include_Once "../inc/footer.inc.php"; 

} else {
    header('location: ../../index.php');
    exit();
}

?>