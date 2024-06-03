<?php

$n = readline( "Enter number of row of the pattern (n): " );

for ( $i = 0; $i < $n; $i++ ) {
    $str = '';

    for ( $j = $n - $i - 1; $j > 0; $j-- ) {
        $str .= " ";
    }

    for ( $j = 1; $j <= 2 * $i + 1; $j++ ) {
        $str .= "*";
    }
    echo $str . PHP_EOL;
}