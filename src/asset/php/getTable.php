<?php

$table = isset($_GET['table']) ? $_GET['table'] : '';

switch($table) {
    case 'user':
        $query = "SELECT * FROM user";
        break;
    case 'blog':
        $query = "SELECT * FROM blog";
        break;
    case 'package':
        $query = "SELECT * FROM package";
        break;
    default:
        echo 'Table not specified or unknown table.';
        exit;
}

?>