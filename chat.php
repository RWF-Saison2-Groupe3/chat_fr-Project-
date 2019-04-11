<?php
session_start();

$title = 'Chat commun';

$load = 'onLoad="load_messages()"';

include_Once 'files/inc/function.php';

if(!connecter()){
    header('location: connexion.php');
    exit();
  
}

include_once 'files/inc/header.inc.php';
include_once 'files/inc/config.php';
include_once 'files/inc/nav.inc.php';
?>
<div class="all0">
    <div class="grid-1">
        <h1 class="centrer">Chat Général</h1>
    </div>



    <?php 
        if (isset($_GET['mod']) && $_GET['mod'] == 'ok') {
            echo '<div class="grid-1 message vert centrer">&nbsp Le message a bien été modéré !</div>';

            header('Refresh: 1; url=chat.php');
        }
        if (isset($_GET['sing']) && $_GET['sing'] == 'ok') {
            echo '<div class="grid-1 message vert centrer">&nbsp Le message a bien été signalé !</div>';

            header('Refresh: 1; url=chat.php');
        }
    ?>

    <div class="grid-9 chat" id="chat_principal" style="border-radius: 10px;">
    </div>
    <div id="chatref" class="grid-9 entree">
        <div class="entree">
            <form method="post" autocomplete="off" action="files/inc/messageChat.php">
                <input class="champMess" type="text" id="message" name="message" placeholder="Pas d'insultes, de messages inaproprié ou de données personnels" size="120" required><input type="submit" value="envoyer">
            </form>
        </div>
    </div>
    <script>
        setInterval('load_messages()', 500);
        function load_messages() {
            $('#chat_principal').load('files/inc/load_chat.php');
        }

        /* AHHH CA MARCHHHHE */
        var timescroll = setInterval(scroll, 200);
        function scroll() {
            var elem = document.getElementById('chat_principal');
            elem.scrollTop = elem.scrollHeight;
        }
        var noboucle = setInterval(stop, 500);
        function stop() {
            clearInterval(timescroll);
        }
    </script>
</div>

<?php

include_once 'files/inc/footer.inc.php';
?> 