<?php

require 'interpreter.php';

$chat_id = 0;
$chat_view = '';
foreach ($json as $chat) {
    if ($chat['participants'][0]==$cjson['username']) {
        $chat_name = $chat['participants'][1];
    } else {
        $chat_name = $chat['participants'][0];
    }
    $chat_num = $chat_id + 1;
    $chat_view .= '<li><a href="chat.php?id='.$chat_id.'">'. $chat_num. ') '. $chat_name . '</a></li>';
    $chat_id++;
}

?>

<html>
<head>
    <title>instaConvoDecorder</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<style>

body {
    font-family: monospace;
}

#chat_view li {
    margin-bottom: 10px;
    list-style-type: none;
}

#chat_view li :last-child {
    margin-bottom: 0px;
}

#chat_view a {
    text-decoration: none;
    background: black;
    color: white;
    padding: .5%;
    border: 1px solid black;
    display: inline-block;
    border-radius: 3px;
    transition: ease-in-out .2s;
}

#chat_view a:hover {
    background: none;
    color: black;
}

</style>

</head>
<body>


<ul id="chat_view">
<p>Username: <b><?=$cjson['username']; ?></b></p>
<p>Chats: <b><?=$chat_id; ?></b></p>
<?=$chat_view; ?>
</ul>

</body>
</html>