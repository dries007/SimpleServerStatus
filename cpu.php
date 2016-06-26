<?php
if (strpos(strtolower(PHP_OS), "win") !== false) die('Y U USE WINDOWS?');

$loads = sys_getloadavg();

$cpuinfo = file_get_contents('/proc/cpuinfo');
preg_match_all('/^processor/m', $cpuinfo, $matches);
$numCpus = count($matches[0]);

header('Content-Type: application/json');
echo json_encode([
    '#' => $numCpus,
    '1' => $loads[0],
    '5' => $loads[1],
    '15' => $loads[2],
]);
