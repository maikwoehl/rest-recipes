<?php

$route = "/test/<name>";

$end1 = substr($route, -1);
$end2 = substr($route, strlen($route)-1);

echo "\n$end1\n\n$end2\n";

if ($end1 == "/") {
    echo "they are equal\n";
} else {
    echo "they are not equal\n";
}

if ($end2 == "/") {
    echo "they are equal\n";
} else {
    echo "they are not equal\n";
}

if (strcasecmp($end1, "/") != 0) {
    echo "they are not equal\n";
} else {
    echo "they are equal\n";
}

if (substr_compare($route, "/", -1, 1) != 0) {
    echo "they are not equal\n";
} else {
    echo "they are equal\n";
}