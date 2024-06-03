<?php

function findMinimumAbsoluteValue( int ...$numbers ): string | int {
    if ( $numbers == null ) {
        return "No number is given. Provide some numbers please.";
    }

    $minValue = abs( $numbers[0] );
    $length   = count( $numbers );

    for ( $i = 1; $i < $length; $i++ ) {
        $_absoluteValue = abs( $numbers[$i] );

        if ( $_absoluteValue < $minValue ) {
            $minValue = $_absoluteValue;
        }
    }
    return $minValue;
}

echo findMinimumAbsoluteValue( 10, 12, 15, 189, 22, 2, 34 ); // 2
echo PHP_EOL;
echo findMinimumAbsoluteValue( 10, 12, 15, 189, 22, 2, 34, -5 ); // 2
echo PHP_EOL;
echo findMinimumAbsoluteValue( 10, 12, 15, 189, 22, 2, 34, -1 ); // 1
echo PHP_EOL;
echo findMinimumAbsoluteValue( 10, -12, 34, 12, -3, 123 ); // 3
echo PHP_EOL;
echo findMinimumAbsoluteValue(); // no output