<?php
$height = array(
    "Andy" => "176",
    "Barry" => "165",
    "Charlie" => "170"
);

$height["David"] = "180";
$height["Ethan"] = "172";
$height["Frank"] = "168";
$height["George"] = "175";
$height["Harry"] = "182";

function tampilkanArray($arr) {
    $items = [];
    foreach ($arr as $key => $value) {
        $items[] = "\"$key\"=>\"$value\"";
    }
    echo "height = (" . implode(", ", $items) . ")<br>";
}

tampilkanArray($height);

$last_key = array_key_last($height);
echo "Nilai dengan indeks terakhir: " . $height[$last_key] . "<br><br>";

unset($height["Barry"]);

tampilkanArray($height);

$last_key = array_key_last($height);
echo "Nilai dengan indeks terakhir setelah dihapus: " . $height[$last_key];
?>