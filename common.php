<?php

// common.php
// description

class MissingTemplateException extends Exception {}

function render_template($template_file, $vars = array()) {
    if(file_exists($template_file)) {
        ob_start();
        extract($vars);
        include($template_file);
        return ob_get_clean();
    } else {
        throw new MissingTemplateException("Template: {$template_file} could not be found!");
    }
}


?>

