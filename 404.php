<?php
  session_start();
if (!empty($_SESSION['membre'])) // Si non co renvoie a l'acceuil
{
  include_Once "files/inc/header.inc.php";
  include_Once "files/inc/nav.inc.php";
?>
<div class="grid-1">
    <div class="e404">
        <span>Une erreur est survenue..</span>&nbsp;&nbsp;<img src="files/img/bug.svg" alt="bug"><br /><br /><br />
        <a href="membre.php">Revenir a l'acceuil</a>
    </div>
</div>



  <?php
include_once "files/inc/footer.inc.php";
} else {
  header("Location: index.php");
}
?> 