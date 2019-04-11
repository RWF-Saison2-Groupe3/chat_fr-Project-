<?php

  $title = 'Recupération de mot de passe';

  include_Once 'files/inc/header.inc.php';
  include_Once 'files/inc/config.php';
  include_Once 'files/inc/function.php';
?>
<div id="recup_mdp" class="grid-1"><?php include_Once 'files/inc/form_reset_pass.php'; echo $mssg; ?></div>
<?php
    include_Once 'files/inc/footer.inc.php';
?>
