<?php
session_start();

$title = 'Verification';

include_Once 'files/inc/function.php';

if(!connecter()){
  header('location: connexion.php');
  exit();

}

include_Once 'files/inc/header.inc.php';
include_Once 'files/inc/config.php';
?>
<div class="all0">
  <div class="grid-1 center">
    <h1> Chargement de votre espace membre en cours..</h1>
    <div class="verif">
  <img src="files/img/loading.gif" alt="chargement..">
  </div></div>
</div>

<?php
include_Once 'files/inc/footer.inc.php';
header('refresh: 1; url=index.php');
?>