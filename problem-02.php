<?php

$fileName = readline( "Enter filename with extension (contains in the same directory) you want to read: " );
print_r( wordCountFromFile( $fileName ) );

function wordCountFromFile( string $fileNameWithExtension ): string {
    $fileName = getcwd() . DIRECTORY_SEPARATOR . $fileNameWithExtension;

    if ( !file_exists( $fileName ) ) {
        return "File Doesn't Exists";
    }

    $fileData = file_get_contents( $fileName );

    $paragraph  = trim( str_replace( "\n", " ", $fileData ) );
    $wordsArray = preg_split( "/ +/", $paragraph );

    return $fileNameWithExtension . " contains " . count( $wordsArray ) . " words";
}