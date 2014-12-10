<?php
$guestbook = "messages.txt";





$method = $_SERVER['REQUEST_METHOD'];
if($method === 'POST')
{
    if(isset($_POST['method'])) {
	$method = $_POST['method'];
	if($method === 'write') {
	    header('Content-Type: application/json');
	    write_me();
	}
    }

} else if($method === 'GET') {
    header('Content-Type: application/json');
    get_latest();
    get_all();
}

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




?>

