<?php
//Saves messages file to variable
$guestbook = "messages.txt";

// This runs if some sends any user input
if(isset($_POST['button'])){
    if(!empty($_POST['name'])){

        $name = $_POST['name']."\n";
        $msg = $_POST['message']."\n";
        $lang = $_POST['language']."\n<hr>";
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


?>
