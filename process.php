<?php

$guestbook = "messages.txt";
$method     = $_SERVER['REQUEST_METHOD'];
header('Content-Type: application/json');

function get_all() {
   // var_dump($_GET);
    $alldata = array("Name" => $_POST['name'],
                        "Date" => getdate(),
                        "Message" => $_POST['message'],
                        "Language" => $_POST['language']);
    echo json_encode($alldata);
}

function get_latest() {
    $latestpost = array("Name" => $_POST['name'],
        "Date" => getdate(),
        "Message" => $_POST['message'],
        "Language" => $_POST['language']);
    echo json_encode($latestpost);
}

function write_me() {
    echo json_encode($_POST);
}

if($method === 'POST') {
    $methodName = isset($_POST['method']) ? $_POST['method'] : null;
    switch ($methodName) {
        case 'write':
	        write_me();    
            break;
        default:
            break;
    }
} else if($method === 'GET') {
    $methodName = isset($_GET['method']) ? $_GET['method'] : null;
    switch ($methodName) {
        case 'latest':
            get_latest();
            break;
        default:
        case 'all':
            get_all();
            break;
    }
}

?>

