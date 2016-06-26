<?php

const UNIT_SIZE = 1024 * 1024 * 1024;
const UNIT = "GB";

function getDiskspace($dir)
{
    $df = disk_free_space($dir) / UNIT_SIZE;
    $dt = disk_total_space($dir) / UNIT_SIZE;
    return ['total' => $dt, 'free' => $df, 'used' => $dt - $df];
}

header('Content-Type: application/json');
echo json_encode([
    'unit' => UNIT,
    'unit_size' => UNIT_SIZE,
    'root' => getDiskspace('/'),
    'home' => getDiskspace('/home'),
    'ssd2' => getDiskspace('/ssd2'),
    'ssd3' => getDiskspace('/ssd3'),
]);
