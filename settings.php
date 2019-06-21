<?php

$complete_view = '';
if (isset($_POST['username'])) {
    $data = json_encode(array('username'=>$_POST['username'], 'file'=>$_POST['file'], 'sort'=>$_POST['sort'], 'show_chat_names'=>$_POST['show_chat_names']));
    $handle = fopen('settings.json', 'w');
    fwrite($handle, $data);
    fclose($handle);
    $complete_view = '<p style="color:green;">Settings saved!</p>';
}

if (file_exists('settings.json')) {
    $handle = fopen('settings.json', 'r');
    $json = fread($handle, filesize('settings.json'));
    fclose($handle);
    $data = json_decode($json, true);
    $username = $data['username'];
    $file = $data['file'];
    $sort = $data['sort'];
    $show_chat_names = $data['show_chat_names'];

} else { $username=''; $file=''; $sort=''; $show_chat_names=''; }

if ($data['sort']=='oldest') {
    $sort_view = '<option value="newest">Newest</option> <option value="oldest" selected>Oldest</option>';
} elseif ($sort=='newest') {
    $sort_view = '<option value="newest" selected>Newest</option> <option value="oldest">Oldest</option>';
} else {
    $sort_view = '<option value="newest">Newest</option> <option value="oldest">Oldest</option>';
}

if ($data['show_chat_names']=='true') {
    $show_chat_names_view = '<option value="true" selected>Yes</option> <option value="false">No</option>';
} elseif ($data['show_chat_names']=='false') {
    $show_chat_names_view = '<option value="true">Yes</option> <option value="false" selected>No</option>';
} else {
    $show_chat_names_view = '<option value="true">Yes</option> <option value="false">No</option>';
}

?>

<html>
<head>
    <title>instaConvoDecoder</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {font-family:monospace;}
</style>
</head>

<body>


<a href="/">back</a>
<form action="" method="post">

<p>Username: <input type="text" name="username" value="<?=$username ?>" required></p>
<p>Filename: <input type="text" name="file" value="<?=$file ?>" required></p>
<p>Sort: <select name="sort"><?=$sort_view ?></select></p>
<p>Show chat names: <select name="show_chat_names"><?=$show_chat_names_view ?></select></p>
<input type="submit" value="save"><?=$complete_view ?>
</form>

</body>

</html>