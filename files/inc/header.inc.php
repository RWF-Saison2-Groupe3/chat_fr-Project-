   <!DOCTYPE html>
<html lang="fr" dir="ltr">
   <head>
      <?php include_once "meta.inc.php"; ?>
      <title><?php echo isset($title) ? $title : 'Chat_FR' ?></title>
   </head>
   <body <?php if(isset($load)) echo $load; ?>>
      <div class="container">
      <a href="<?php echo RACINE_SITE ?>index.php">
         <div id="titre" class="grid-1">
            <h1>Chat FR</h1>
            <hr>
         </div>
      </a>