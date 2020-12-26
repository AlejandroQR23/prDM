
<?php

    session_start();
    session_unset();
    session_destroy();

    header('Location: /prDM_V01');

?>
