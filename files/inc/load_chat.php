<?php
session_start();

include_Once 'function.php';

include_once 'config.php';

$mess = executeRequete("SELECT * FROM chatg ORDER BY id_mess ASC LIMIT 35");
while ($message = $mess->fetch_assoc()) {
    echo '<div class="miniPc">';
    echo '<img onclick="tagging()" src="files/upload/' . $message["photo_m"] . '" alt="photo de profil"></div>&nbsp;';
    echo '<div class="pseudo"><a class="nameC" href="view.php?id=' . $message['id_n_m'] . '"><span>' . $message["id_m"] . '</span></a></div>';
    echo '<div class="message"><span> :</span><span> ' . $message["mess_post_g"] . '</span></div>';
    if (!WebMaster()) {
        $mod = '<div id="droite"><a href="files/inc/chat_mod.php?sign=' . $message['id_mess'] . '&id_m=' .$message['id_n_m']. '"><span>Signaler</span></a></div>';
    }
    if (WebMaster()) {
        $mod = '<div  id="droite"><a href="files/inc/chat_mod.php?moderation=' . $message['id_mess'] . '"><span>Modéré</span></a></div>';
    }
    if (Admin()) {
        $mod = '<div  id="droite"><a href="files/inc/chat_mod.php?moderation=' . $message['id_mess'] . '"><span>Modéré</span></a></div>';
    }
    if (Modo()) {
        $mod = '<div  id="droite"><a href="files/inc/chat_mod.php?moderation=' . $message['id_mess'] . '"><span>Modéré</span></a></div>';
    }
    echo $mod;
    echo '
    <script>
        function tagging(){
        $("#message").append($("#message").val("@' . $message["id_m"] . '"));
    }
    </script>
    <br />';
}
?>
