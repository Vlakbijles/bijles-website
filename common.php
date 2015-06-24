<?php

// common.php
//
// Contains helper functions

// HTML template rendering
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

// Recursively sort elements in array by key
function ksortRecursive(&$array) {
    if (is_array($array)) {
        ksort($array);
        foreach ($array as &$arr) {
            ksortRecursive($arr);
        }
    }
}

?>
