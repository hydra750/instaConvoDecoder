<?php

function isJson($string) {
    json_decode($string);
    return (json_last_error() == JSON_ERROR_NONE);
}

if (!file_exists('settings.json')) {
    die('Missing settings.json file');
}

$handle = fopen('settings.json', 'r');
$control = fread($handle, filesize('settings.json'));
fclose($handle);
if (!isJson($control)) {die('The settings.json file is corrupted');}

$cjson = json_decode($control, true);

if (!file_exists($cjson['file'])) {
    die('Missing file: '.$cjson['file']);
}

$handle = fopen($cjson['file'], 'r');
$data = fread($handle, filesize($cjson['file']));
fclose($handle);


if (!isJson($data)) {die('The '. $cjson['file'] . ' contains invalid JSON');}

$json = json_decode($data, true);

?>