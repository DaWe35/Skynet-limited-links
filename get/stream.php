<?php
// download & send the file to the user, like a proxy
function stream($filename) {
    ini_set('max_execution_time', '3600'); // 1 hour
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$filename);

    $content_type = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
    header('Content-Type: ' . $content_type);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3600);


    curl_setopt($ch, CURLOPT_HEADERFUNCTION, function ($ch, $header) {
        // get & set file name
        $prefix = 'skynet-file-metadata:';
        if (strtolower(substr($header, 0, strlen($prefix))) === $prefix) {
            $metadata = json_decode(substr($header, strlen($prefix)), true);
            header('Content-Disposition: inline; filename="' . $metadata['filename'] . '"');
        }

        // get & set file size
        $prefix = 'content-length:';
        if (strtolower(substr($header, 0, strlen($prefix))) === $prefix) {
            $metadata = trim(substr($header, strlen($prefix)));
            header('Content-length: ' . $metadata);
        }

        return strlen($header);
    });

    curl_setopt($ch, CURLOPT_WRITEFUNCTION, function($curl, $data) {
        echo $data;
        return strlen($data);
    });
    curl_exec($ch);
    curl_close($ch);
}