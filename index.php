<?php
  include_Once 'files/inc/header.inc.php';
  include_Once 'files/inc/config.php';
  
  
?>
<div id="form" class="grid-1"><?php
include_Once 'files/inc/form_insc.inc.php';
?></div>
<div id="erreur" class="grid-1"><hr>
<?php
if(!empty($err)){ echo $err;}
if(!empty($val)){ echo $val;}
if(!empty($erreur)){ echo $erreur;}
?><hr></div>
<div id="form2" class="grid-1"><?php include_Once 'files/inc/form_connex.inc.php'; ?><br/><br/><?php if(!empty($errco)){ echo $errco;}?></div>
<?php
    include_Once 'files/inc/footer.inc.php';
?>
