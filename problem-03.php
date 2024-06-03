<?php

function reverseSentenceKeepingOrder( string $sentence ): string {
    return join( " ", array_map( fn( $word ) => strrev( $word ), explode( " ", $sentence ) ) );
}

echo reverseSentenceKeepingOrder( 'I love programming' ); // I evol gnimmargorp