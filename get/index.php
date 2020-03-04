<?php
require '../config.php';
require 'stream.php';

function forbidden($descrition) {
    header('HTTP/1.1 403 Forbidden');
    echo $descrition;
    exit;
}

function forbidden_password($isPasswdEntered) {
    if ($isPasswdEntered !== false) {
        log_ip();
    }
    header('HTTP/1.1 403 Forbidden');
    include 'password.php';
    exit;
}

function notFound() {
    header('HTTP/1.1 404 Not Found');
    echo '404 not found';
    exit;
}

function log_ip() {
    global $db;
    $ip = ip2long($_SERVER['REMOTE_ADDR']);
    $current_time = date("Y-m-d H:i:s");
    $stmt = $db->prepare("INSERT INTO ip_ban (ip, time) VALUES (?, ?)");
    if (!$stmt->execute([$ip, $current_time])) {
        exit('Database error');
    }
}


function check_ip() {
    global $db;
    $ip = ip2long($_SERVER['REMOTE_ADDR']);
    $current_time = date("Y-m-d H:i:s");
    $time_min_hour = date('Y-m-d H:i:s',strtotime('-1 hour',strtotime($current_time)));
    $stmt = $db->prepare("SELECT count(ip) as count FROM ip_ban WHERE ip = ? AND time > ? LIMIT 11");
    if (!$stmt->execute([$ip, $time_min_hour])) {
        exit('Database error');
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row['count'] >= 10) {
        forbidden('Your ip banned, please wait one hour');
    }
    return $row['count'];
}

function clear_ip_ban() {
    global $db;
    $current_time = date("Y-m-d H:i:s");
    $time_min_hour = date('Y-m-d H:i:s',strtotime('-1 hour',strtotime($current_time)));
    $stmt = $db->prepare("DELETE FROM ip_ban WHERE time < ?");
    if (!$stmt->execute([$time_min_hour])) {
        exit('Database error');
    }
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    notFound();
}

$stmt = $db->prepare("SELECT skylink, expire, downloadable, password FROM sia_links WHERE id = ? LIMIT 1");
if (!$stmt->execute([$_GET['id']])) {
    exit('Database error');
}
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt = null;

if (empty($row)) {
    notFound();
}

$current_time = date("Y-m-d H:i:s");
if ($row['expire'] != null && $current_time > $row['expire']) {
    forbidden("Url expired (UTC {$row['expire']})");
}

if ($row['downloadable'] != null && $row['downloadable'] <= 0) {
    forbidden("The file has already been downloaded as many times as it could");
}

if ($row['password'] != null) {
    if (!isset($_POST['password'])) {
        forbidden_password(false);
    } else if (!password_verify($_POST['password'], $row['password'])) {
        clear_ip_ban();
        $ip_tries = check_ip();
        forbidden_password($ip_tries);
    }
}


// Update downloadable count
if ($row['downloadable'] != null && $row['downloadable'] > 0) {
    $stmt = $db->prepare("UPDATE sia_links SET downloadable = downloadable-1 WHERE id = ?");
    if (!$stmt->execute([$_GET['id']])) {
        exit('Database error');
    }
    $stmt = null;
}

stream('https://siasky.net/' . $row['skylink']);


// stream('https://siasky.net/CAAVU14pB9GRIqCrejD7rlS27HltGGiiCLICzmrBV0wVtA'); // html example
// stream('https://siasky.net/CABAB_1Dt0FJsxqsu_J4TodNCbCGvtFf1Uys_3EgzOlTcg'); // large video example