<?php

const UNIT_SIZE = 1024 * 1024;
const UNIT = "GB";

$data = explode("\n", file_get_contents("/proc/meminfo"));
$meminfo = array('unit' => UNIT, 'unit_size' => UNIT_SIZE);
foreach ($data as $line) {
    @list($key, $val) = explode(":", $line);
    if ($key == '') continue;
    $meminfo[$key] = intval(str_replace(" kb", "", trim($val))) / UNIT_SIZE;
}

header('Content-Type: application/json');
echo json_encode([
    'unit' => UNIT,
    'unit_size' => UNIT_SIZE,
    'total' => $meminfo['MemTotal'],
    'available' => $meminfo['MemAvailable'],
    'free' => $meminfo['MemFree'],
]);
