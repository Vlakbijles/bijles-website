<?php

// require_once("include.php");
require_once("common.php");

$test = "teest";
echo render_template('profile_template.php', array('description' => $test));

?>
