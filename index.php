<!DOCTYPE html>
<meta charset="UTF-8">
<head>
    <title>Ernie Classic Chat Room</title>
    <link rel="stylesheet" href="style.css" type="text/css"/>
    <script type= "text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
</head>

<body>
<form name = "chat" action ="process.php" method ="post">
    <div id="wrapping" class="clearfix">
        <section id="aligned">
            <input type="text" name="name" id="name" placeholder="Your name" autocomplete="off" tabindex="1" class="txtinput"/>
            <textarea name="message" id="message" placeholder="Please enter your message..." tabindex="5" class="txtblock"></textarea>
            <input type="text" name="language" id="language" placeholder="Please enter language 'English' = 'EN' " autocomplete="off" tabindex="1" class="txtinput"/>
            <input type="submit" name="button" id="button" value="send"/>
        </section>
    <div>
</form>

</body>
</html>

