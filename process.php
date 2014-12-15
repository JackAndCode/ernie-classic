<?php
// While we're emulating technology from the early 2000's :P


$method     = $_SERVER['REQUEST_METHOD'];
//header('Content-Type: application/json');
define('DATA_FILE', "messages.txt");

function deserialize($latest = false, $constraints = array(
        'date' => null,  
        'language' => null,  
        'name' => null,  
        'to' => null,  
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
        $messageLine['to'] = $content[3];
        $messageLine['message'] = $content[4];

        if
        (
            ($constraints['language'] == null || $constraints['language'] === $messageLine['language']) &&
            ($constraints['message'] == null || $constraints['message'] === $messageLine['message']) &&
            ($constraints['name'] == null || $constraints['name'] === $messageLine['name']) &&
            ($constraints['date'] == null || $constraints['date'] === $messageLine['date']) &&
            ($constraints['to'] == null || $constraints['to'] === $messageLine['to']) 
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

function get_all($constraints = array(
        'date' => null,  
        'language' => null,  
        'name' => null,  
        'to' => null,  
        'message' => null,
    )) {
   deserialize(false, $constraints);
}

function get_latest($constraints = array(
        'date' => null,  
        'language' => null,  
        'name' => null,  
        'to' => null,  
        'message' => null,
    )) {
    deserialize(true, $constraints);
}

function write_me() {
    $valid = true;
    $valid &= isset($_POST['message']);
    $valid &= isset($_POST['language']);
    $valid &= isset($_POST['name']);
    $valid &= isset($_POST['to']);
    
    $messageLine = array();
    
    if(!$valid) {
        http_response_code(400);
        echo json_encode(array('error' => 'Empty write'));
    } else {
        $messageLine['message']   = $_POST['message'];
        $messageLine['language']  = $_POST['language'];
        $messageLine['name']      = $_POST['name'];
        $messageLine['to']      = $_POST['to'];
        $messageLine['date']      = getdate();
        $dataLine = sprintf("%s\t%s\t%s\t%s\t%s\n", $messageLine['date'][0],       
                                                $messageLine['language'],
                                                $messageLine['name'],
                                                $messageLine['to'],
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

