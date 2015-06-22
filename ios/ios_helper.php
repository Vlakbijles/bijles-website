<?php

    echo "<pre>";

    echo "[Host] => " . apache_request_headers()["Host"];
    echo "</br>";
    echo "[User-Agent] => " . apache_request_headers()["User-Agent"];
    echo "</br>";

    echo "[REQUEST_METHOD] => " . $_SERVER["REQUEST_METHOD"];
    echo "</br>";
    echo "[REQUEST_URI] => " . $_SERVER["REQUEST_URI"];
    echo "</br>";
    echo "</br>";

    echo "Globals";
    print_r($GLOBALS);

    echo "</pre>";



?>
