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
echo "weight = (" . implode(", ", $items) . ")<br><br>";

$keys = array_keys($weight);
$total = count($keys);

for ($i = 0; $i < $total; $i++) {
    $nama = $keys[$i];
    $berat = $weight[$nama];
    echo $nama . " is " . $berat . " kg.<br>";
}
?>