<?php
$fruits = array(
    "Avocado", "Blueberry", "Cherry",
    "Durian", "Elderberry", "Fig",
    "Grape", "Honeydew"
);

unset($fruits[1]);

$fruits = array_values($fruits);

echo "Data Blueberry dihapus.<br>";

$quoted = array_map(function($item) {
    return '"' . $item . '"';
}, $fruits);

echo "fruits = ( " . implode(", ", $quoted) . " )<br>";

$indeksTertinggi = count($fruits) - 1;
echo "Nilai dengan indeks tertinggi: " . $fruits[$indeksTertinggi];
?>