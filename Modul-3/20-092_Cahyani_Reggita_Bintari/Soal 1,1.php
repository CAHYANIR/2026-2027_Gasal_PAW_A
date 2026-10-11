
<?php
$fruits = array("Avocado", "Blueberry", "Cherry");

$fruits[] = "Durian";
$fruits[] = "Elderberry";
$fruits[] = "Fig";
$fruits[] = "Grape";
$fruits[] = "Honeydew";

echo "<h3>Daftar Buah</h3>";

foreach ($fruits as $fruit) {
    echo $fruit . "<br>";
}

$indeksTertinggi = count($fruits) - 1;

echo "<br>Indeks tertinggi: " . $indeksTertinggi;
echo "<br>Nilai indeks tertinggi: " .
     $fruits[$indeksTertinggi];
?>
