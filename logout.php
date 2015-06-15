<?php

    // logout.php
    // Resets cookie, in turn logs out user

    setcookie("user_id");
    setcookie("token_hash");
    header("Location: " . $_SERVER["HTTP_REFERER"]);

?>

