<?php
$method = $_SERVER['REQUEST_METHOD'];
if($method === 'POST')
{
    do_post();
} else if($method === 'GET') {
    do_get();
}


function do_post() {
    var_dump($_POST);
    echo 'Dammit Kelo';
}


function do_get() {
    var_dump($_GET);
    echo 'Dammit David';
}
