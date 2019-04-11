<?php 
include_once "function.php";
include_once "config.php";

$id = $_SESSION['membre']['id_user'];
$receive = executeRequete("SELECT * FROM amis WHERE id_m_receveur=$id AND statut=0");
$rec = $receive->fetch_assoc();

?>
<div class="grid-1" id="btnNav" onclick="toggle_visibility('menu');" ><i class="fas fa-bars"></i></div>
<nav id="menu">
  <a href="<?php echo RACINE_SITE ?>profil.php?id=<?php echo $_SESSION['membre']['id_user'] ?>"><img src="<?php echo RACINE_SITE ?>files/img/user.svg" alt="profil"></a>
  <span class="sepnav">|</span>
  <a href="<?php echo RACINE_SITE ?>chat.php"><img src="<?php echo RACINE_SITE ?>files/img/chat.svg" alt="chat"></a>
  <span class="sepnav">|</span>
  <a href="<?php echo RACINE_SITE ?>listing_user.php"><img src="<?php echo RACINE_SITE ?>files/img/listing_friend.svg" alt="liste des utilisateurs"></a>
  <span class="sepnav">|</span>
  <a href="<?php echo RACINE_SITE ?>amis.php"><img src="<?php echo RACINE_SITE ?>files/img/amis.svg" alt="amis"></a><?php if(mysqli_num_rows($receive) > 0) echo '<a href="new_amis.php"><span class="notif">'.mysqli_num_rows($receive).'</span></a>'?>
  <span class="sepnav displ">|</span>
  <a href="<?php echo RACINE_SITE ?>inbox.php"><img src="<?php echo RACINE_SITE ?>files/img/mp.svg" alt="boite de reception" ></a>
  <span class="sepnav">|</span>
  <a href="<?php echo RACINE_SITE ?>setting.php?id=<?php echo $_SESSION['membre']['id_user'] ?>"><img src="<?php echo RACINE_SITE ?>files/img/settings.svg" alt="mes options" ></a>
  <span class="sepnav">|</span>
  <?php 
if(WebMaster()){
 echo '<a href="'.RACINE_SITE.'files/admin/admin.php"><img src="'. RACINE_SITE . 'files/img/admin.svg" alt="administration"></a>
      <span class="sepnav">|</span>';
}
if(Admin() or modo()){
 echo '<a href="'.RACINE_SITE.'files/admin/admin.php"><img src="'. RACINE_SITE . 'files/img/admin.svg" alt="administration"></a>
      <span class="sepnav">|</span>';
}
?>
  <a href="<?php echo RACINE_SITE ?>files/inc/deco.php"><img src="<?php echo RACINE_SITE ?>files/img/logout.svg" alt="deconnexion"></a>
</nav>
<script>
function toggle_visibility(id) {
    var e = document.getElementById(id);
    if(e.style.display == 'block')
      e.style.display = 'none';
    else
      e.style.display = 'block';
}
</script>
