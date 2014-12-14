<?php
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
    $valid = true;
    $valid &= isset($_POST['message']);
    $valid &= isset($_POST['language']);
    $valid &= isset($_POST['name']);
    
    $messageLine = array();
    
    if(!$valid) {
        http_response_code(400);
        echo json_encode(array('error' => 'Empty write'));
    } else {
        $messageLine['message']   = $_POST['message'];
        $messageLine['language']  = $_POST['language'];
        $messageLine['name']      = $_POST['name'];
        $messageLine['date']      = getdate();
        $dataLine = sprintf("%s\t%s\t%s\t%s\n", $messageLine['date'][0],       
                                                $messageLine['language'],
                                                $messageLine['name'],
                                                $messageLine['message']);


        $f  = file_put_contents("messages.txt", $dataLine, FILE_APPEND );
        echo json_encode($messageLine);
    }
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

