<?php

function reverse( $word ) {
    $length = strlen( $word ) - 1;
    for ( $i = 0, $j = $length; $i <= $j; $i++ ) {
        if ( $word[$j] == '.' || $word[$j] == ',' ) {
            --$j;
        }
        $_temp    = $word[$i];
        $word[$i] = $word[$j];
        $word[$j] = $_temp;
    }
    return $word;
}

function reverseSentenceKeepingOrder( string $sentence ): string {
    return join( " ", array_map( fn( $word ) => reverse( $word ), explode( " ", $sentence ) ) );
}

$inputString = readline( "Enter string to reverse: " );

echo reverseSentenceKeepingOrder( $inputString ); // I evol, gnimmargorp.