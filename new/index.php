<?php
require '../config.php';
header('Content-Type: application/json');
function error($descrition) {
    header('HTTP/1.1 400 Bad Request');
    $print['error'] = $descrition;
    $print = json_encode($print);
    echo $print;
    exit;
}

function is_skylink_valid($skylink) {
    $url = 'https://siasky.net/' . $skylink;
    $curlHandle = curl_init();
    curl_setopt($curlHandle, CURLOPT_URL, $url);
    curl_setopt($curlHandle, CURLOPT_HEADER, true);
    curl_setopt($curlHandle, CURLOPT_NOBODY  , true);  // we don't need body
    curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
    curl_exec($curlHandle);
    $response = curl_getinfo($curlHandle, CURLINFO_HTTP_CODE);
    curl_close($curlHandle); // Don't forget to close the connection
    if ($response == 200 || $response == 405) {
        return true;
    } else {
        return false;
    }
}

if (!isset($_POST['skylink']) || empty($_POST['skylink'])) {
    error("Post value 'skylink' is empty");
}

$skylink = $_POST['skylink'];

if (strlen($skylink) !== 46) {
    error("Post value 'skylink' is not a valid skylink (wrong length)");
}

if (!is_skylink_valid($skylink)) {
    error("Post value 'skylink' is not a valid skylink");
}

if (!isset($_POST['downloadable']) && !isset($_POST['expire_value']) && !isset($_POST['expire_unit']) && !isset($_POST['password'])) {
    error("Taks failed successfully - you did not set any limits");
}

if (isset($_POST['expire_value']) && !isset($_POST['expire_unit'])) {
    error("You need to set 'expire_unit' [minute, hour, day, week, or month] for 'expire_value'");
}

if (isset($_POST['expire_unit']) && !isset($_POST['expire_value'])) {
    error("You need to set 'expire_value' [integer] for 'expire_unit'");
}

if (isset($_POST['downloadable'])) {
    if (intval($_POST['downloadable']) < 1) {
        error("Wrong value for 'downloadable' positive integer required");
    } else if (intval($_POST['downloadable']) > 65535) {
        error("Wrong value for 'downloadable', maximum value: 65535");
    } else {
        $downloadable = intval($_POST['downloadable']);
    }
} else {
    $downloadable = null;
}


if (isset($_POST['expire_value']) && isset($_POST['expire_unit'])) {
    if ($_POST['expire_unit'] != 'minute' && $_POST['expire_unit'] != 'hour' && $_POST['expire_unit'] != 'day' &&  $_POST['expire_unit'] != 'week' && $_POST['expire_unit'] != 'month') {
        error("Wrong value, 'expire_unit' must be [minute, hour, day, week, or month]");
    } else if (intval($_POST['expire_value']) < 1) {
        error("Wrong value, 'expire_unit' must be an integer");
    } else {
        $current_time = date("Y-m-d H:i:s");
        $expire = date('Y-m-d H:i:s',strtotime('+'.$_POST['expire_value'].' ' . $_POST['expire_unit'],strtotime($current_time)));
    }
} else {
    $expire = null;
}

if (isset($_POST['password'])) {
    if (empty($_POST['password'])) {
        error("Password is empty - remove it, or pass a string");
    }

    $options = [
        'cost' => 10,
    ];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT, $options);

} else {
    $password = null;
}

$id = base_convert(microtime(false), 10, 36);

$sqlData = [
    'id' => $id,
    'skylink' => $skylink,
    'downloadable' => $downloadable,
    'expire' => $expire,
    'password' => $password,
];
$stmt = $db->prepare("INSERT INTO sia_links (id, skylink, downloadable, expire, password) VALUES (:id, :skylink, :downloadable, :expire, :password)");

if (!$stmt->execute($sqlData)) {
    exit('Database error');
}


$print['id'] = $id;
$print['url'] = URL . 'get?id=' . $id;
$print = json_encode($print);
echo $print;
exit;