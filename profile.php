<?php

    require_once("include.php");

    $test = "teest";
    echo render_template('profile_template.php', array('description' => $test));

?>
