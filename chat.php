<?php

if (!isset($_GET['id'])) {
    die('Incomplete request');
}
$id = $_GET['id'];
require 'interpreter.php';
$result = $json[$id];
if ($cjson['sort']=='oldest') { $result = array_reverse($result['conversation']); } else { $result = $result['conversation']; }

?>

<html>
<head>
<title>instaConvoDecoder</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="header"><a href="/" class="back"><-back</a> Messages: <?= number_format(count($result)) ?> | sort by: <?= $cjson['sort'] ?></div>
<div class="container">
  
<?php for ($i = 0; $i < count($result); $i++): ?>
    <?php
        $datetime = explode("T", $result[$i]['created_at']);
        $date = date_format(date_create($datetime[0]),"d M y");
        $n = (substr(explode(".", $datetime[1])[0], 0, 2) > 12) ? "pm" : "am";
        $time = (substr(explode(".", $datetime[1])[0], 0, 2) % 12) . substr(explode(".", $datetime[1])[0], 2) . " " . $n;
    ?>
    
    <div class="Area">
    <?php
    if ($cjson['show_chat_names']=='true') {
        if ($result[$i]['sender']==$cjson['username']) {
            echo '<p class="chat-name" style="text-align: right;">'.$result[$i]['sender'].'</p>';
        } else {
            echo'<p class="chat-name">'.$result[$i]['sender'].'</p>';
        }
    }
    ?>

    <p style="font-size: 10px; color:white; <?php  echo ($result[$i]['sender'] != $cjson['username']) ?  'margin-right: 4px;' :  'margin-left: 4px;'?>" class="<?php  echo ($result[$i]['sender'] != $cjson['username']) ?  'R' :  'L'?>"><?php echo $date . "<br> " . $time; ?></p>
        <?php  echo ($result[$i]['sender'] != $cjson['username']) ?  '<div class="L">' :  '<div class="R">'?>
        <?php $img = ($result[$i]['sender'] != $cjson['username']) ? "/1.png" : "/2.png" ?>
        <img class="pimg" src="<?=$img ?>"/>
        </div>
        
        <?php if (array_key_exists("media", $result[$i]) == 1): ?>
            <div class="text <?php  echo ($result[$i]['sender'] != $cjson['username']) ?  'L leftL' :  'R leftR'?>"><img src="<?=$result[$i]['media'] ?>" alt="Image not found"/></div>
        <?php elseif(array_key_exists("media_url", $result[$i]) == 1): ?>
            <div class="text <?php  echo ($result[$i]['sender'] != $cjson['username']) ?  'L leftL' :  'R leftR'?>"><img src="<?=$result[$i]['media_url'] ?>" alt="Media not found"/></div>
        <?php elseif(array_key_exists("media_share_url", $result[$i]) == 1): ?>
            <div class="text <?php  echo ($result[$i]['sender'] != $cjson['username']) ?  'L leftL' :  'R leftR'?>"><img src="<?=$result[$i]['media_share_url'] ?>" alt="Media not found"/></div>
        <?php elseif(array_key_exists("video_call_action", $result[$i]) == 1): ?> 
            <div class="text <?php  echo ($result[$i]['sender'] != $cjson['username']) ?  'L leftL' :  'R leftR'?>"><b>Video Call</b></div>
        <?php elseif(array_key_exists("heart", $result[$i]) == 1): ?>
            <div class="text <?php  echo ($result[$i]['sender'] != $cjson['username']) ?  'L leftL' :  'R leftR'?>">❤️</div>
        <?php else: ?>
            <div class="text <?php  echo ($result[$i]['sender'] != $cjson['username']) ?  'L leftL' :  'R leftR'?>"><?php echo $result[$i]['text']; ?></div>
        <?php endif; ?>
    </div>

<?php endfor; ?>
</div>
</body>
</html>
