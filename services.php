<?php
function check($port, $host)
{
    $conn = @fsockopen($host, $port, $errno, $errstr, 0.5);
    if ($conn)
    {
        fclose($conn);
        return true;
    }
    else return false;
}

function service($url, $port, $host = 'localhost')
{
    return [ 'url' => $url, 'online' => check($port, $host) ];
}

header('Content-Type: application/json');
echo json_encode([
    'HTTP' => service('http://dries007.net', 80),
    'HTTPS' => service('https://dries007.net', 443),
    'MySQL' => service('//phpmyadmin.dries007.net', 3306),
    'SSH' => service(null, 22),
    'Jenkins' => service('//jenkins.dries007.net', 8080),
    'Minecraft Servers' => service('//backend.dries007.net', 8081),
    'Artifactory' => service('//artifactory.dries007.net', 8082),
]);
