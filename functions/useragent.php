<?php
    $allowed = ['AppleTV','iPhone','iPad','Android','SmartTV','Kodi','Plex'];
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';

    $allowedClient = false;
    foreach ($allowed as $client) {
         if (stripos($userAgent, $client) !== false) {
             $allowedClient = true;
             break;
         }
     }
    if (!$allowedClient) {
         header('HTTP/1.1 403 Forbidden');
         exit('Access denied: TV clients only.');
    }
?>