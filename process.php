<?php
//Saves messages file to variable
$guestbook = "messages.txt";

// This runs if some sends any user input
if(isset($_POST['button'])){
    if(!empty($_POST['name'])){

        $name = $_POST['name']."\n";
        $msg = $_POST['message']."\n";
        $lang = $_POST['language']."\n<hr>";
        global $name, $msg, $lang;
        $file = fopen($guestbook,"a");
        fwrite($file, "$name $msg $lang");
        fclose($file);

    }else{
        echo '<script>alert("Please enter your name")</script>';}
}
$readfile = fopen($guestbook, "r");
// Read and print out everything in the page.
echo @fread($readfile, filesize($guestbook));
// Close the file we opened.
fclose($readfile);

$method = $_SERVER['REQUEST_METHOD'];
if($method === 'POST')
{
    header('Content-Type: application/json');
    write_me();

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
    var_dump($_POST);
    echo '';
}




?>

