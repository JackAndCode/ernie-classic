<!DOCTYPE html>
<meta charset="UTF-8">
<head>
    <title>Ernie Classic Chat Room</title>
    <link rel="stylesheet" href="style.css" type="text/css"/>
    <script type= "text/javascript" src=""http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
</head>

<body>
 <form>
    <div id="wrapping" class="clearfix">
        <section id="aligned">
            <input type="text" name="name" id="name" placeholder="Your name" autocomplete="off" tabindex="1" class="txtinput"/>
            <textarea name="message" id="message" placeholder="Please enter your message..." tabindex="5" class="txtblock"></textarea>
            <input type="text" name="language" id="language" placeholder="Please enter language 'English' = 'EN' " autocomplete="off" tabindex="1" class="txtinput"/>
            <input type="submit" name="button" id="button" value="send"/>
        </section>
    <div>
 </form>
 <?php
    //Saves messages file to variable
    $guestbook = "messages.txt";

    // This runs if some sends any user input
    if(isset($_POST['button'])){
        if(!empty($_POST['name'])){

/*            $name = $_POST['name']."\n<hr>"
            $msg = $_POST['message']."\n<hr>";
            $lang = $_POST['language'];
            $file = fopen($guestbook,"a");
            fwrite($file, $name,$msg,$lang);
            fclose($file);
            */t
        }else{echo '<script>alert("Please enter your name")</script>'}
    }


 ?>







</body>
</html>

