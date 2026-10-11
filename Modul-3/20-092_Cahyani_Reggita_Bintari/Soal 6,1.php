<?php
// 1. array_push()
$arr_push = ["A"];
echo 'Array awal: ("A")<br>';
array_push($arr_push, "B");
echo 'Hasil array_push: ' . implode(" ", $arr_push) . '<br><br>';

// 2. array_merge()
$arr_m1 = ["A", "B"];
$arr_m2 = ["C"];
echo 'Array awal: ("A", "B") digabung dengan ("C")<br>';
$merged = array_merge($arr_m1, $arr_m2);
echo 'Hasil array_merge: ' . implode(" ", $merged) . '<br><br>';

// 3. array_values()
$arr_assoc = ["x" => 1, "y" => 2];
echo 'Array awal: ("x" => 1, "y" => 2)<br>';
$values = array_values($arr_assoc);
echo 'Hasil array_values: ' . implode(" ", $values) . '<br><br>';

// 4. array_search()
$arr_search = ["A", "B", "C"];
echo 'Mencari "B" pada array: ("A", "B", "C")<br>';
$key = array_search("B", $arr_search);
echo 'Hasil array_search: ' . $key . '<br><br>';

// 5. array_filter()
$arr_filter = [0, 1, false, 2, "", 3, "array"];
echo 'Array awal: (0, 1, false, 2, "", 3, "array")<br>';
$filtered = array_filter($arr_filter);
echo 'Hasil array_filter: ' . implode(" ", $filtered) . '<br><br>';

// 6. Sorting Array Indexed (sort & rsort)
$arr_num = [3, 1, 2];
echo 'Array awal: (3, 1, 2)<br>';

$arr_sort = $arr_num;
sort($arr_sort);
echo 'Hasil sort: ' . implode(" ", $arr_sort) . '<br>';

$arr_rsort = $arr_num;
rsort($arr_rsort);
echo 'Hasil rsort: ' . implode(" ", $arr_rsort) . '<br><br>';

// 7. Sorting Array Asosiatif (asort, ksort, arsort, krsort)
$arr_age = ["Peter" => 35, "Ben" => 37, "Joe" => 43];
echo 'Array awal: ("Peter"=>35, "Ben"=>37, "Joe"=>43)<br>';

// Fungsi bantu untuk format tampilan array asosiatif
function format_assoc($arr) {
    $out = [];
    foreach ($arr as $k => $v) {
        $out[] = "$k=> $v";
    }
    return implode(", ", $out) . ",";
}

$a1 = $arr_age;
asort($a1);
echo 'Hasil asort: ' . format_assoc($a1) . '<br>';

$a2 = $arr_age;
ksort($a2);
echo 'Hasil ksort: ' . format_assoc($a2) . '<br>';

$a3 = $arr_age;
arsort($a3);
echo 'Hasil arsort: ' . format_assoc($a3) . '<br>';

$a4 = $arr_age;
krsort($a4);
echo 'Hasil krsort: ' . format_assoc($a4);
?>