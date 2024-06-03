<?php

function sumOfDigits( $number ): int {
    if ( $number < 0 ) {
        $number *= -1;
    }

    $sum = 0;
    while ( $number ) {
        $lastDigit = $number % 10;
        $number    = (int) ( $number / 10 );
        $sum += $lastDigit;
    }
    return $sum;
}
echo sumOfDigits( 62343 ); // 18
echo PHP_EOL;
echo sumOfDigits( -62343 ); // 18
echo PHP_EOL;
echo sumOfDigits( 1000 ); // 1