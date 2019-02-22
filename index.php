<?php

  include_Once 'files/inc/header.inc.php';
  include_Once 'files/inc/config.php';

?>
<div id="form" class="grid-1"><?php
include_Once 'files/inc/form_insc.inc.php';
?></div>
<div id="erreur" class="grid-1"><hr><?php
 echo $err;
 echo $val;
 echo $erreur;
?><hr></div>
<div id="form2" class="grid-1"><?php include_Once 'files/inc/form_connex.inc.php'; ?><br/><br/><?php echo $errco;?></div>
<?php
    include_Once 'files/inc/footer.inc.php';
?>
