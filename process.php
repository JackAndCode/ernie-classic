<?php
// While we're emulating technology from the early 2000's :P


$method     = $_SERVER['REQUEST_METHOD'];
//header('Content-Type: application/json');
define('DATA_FILE', "messages.txt");

function deserialize($latest = false, $filter = array(
        'date' => null,  
        'language' => null,  
        'name' => null,  
        'message' => null,  
    )) {
    $buffy = trim(file_get_contents(DATA_FILE));
    $buffy = explode("\n", $buffy);
    $out = array();
    for ($i=0; $i < count($buffy); $i++) { 
        $messageLine = array();
        $content = explode("\t", $buffy[$i] );

        $messageLine['date'] = (int) $content[0];
        $messageLine['language'] = $content[1];
        $messageLine['name'] = $content[2];
        $messageLine['message'] = $content[3];

        if
        (
            ($filter['language'] == null || $filter['language'] === $messageLine['language']) &&
            ($filter['message'] == null || $filter['message'] === $messageLine['message']) &&
            ($filter['name'] == null || $filter['name'] === $messageLine['name']) &&
            ($filter['date'] == null || $filter['date'] === $messageLine['date']) 
        ) {
            array_push($out, $messageLine);
        }
    }


    if($latest) {
        echo json_encode(array($out[count($out) - 1]));
    } else {
        echo json_encode($out);
    }
}

function get_all() {
   deserialize(false);
}

function get_latest() {
    deserialize(true);
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


        $f  = file_put_contents(DATA_FILE, $dataLine, FILE_APPEND );
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

