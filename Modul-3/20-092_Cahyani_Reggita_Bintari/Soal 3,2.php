<?php
$weight = array(
    "Andy" => "70",
    "Barry" => "65",
    "Charlie" => "75"
);

$items = [];
foreach ($weight as $key => $value) {
    $items[] = "\"$key\"=>\"$value\"";
}
echo "weight = (" . implode(", ", $items) . ")<br>";

echo "Data kedua: " . $weight['Barry'];
?>