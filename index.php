<?php
require_once "vendor/autoload.php";

use App\MoneyManagerCLI;

try {
    $moneyManager = new MoneyManagerCLI;
    $moneyManager->run();
    print PHP_EOL;
    $filePointer = fopen( "errors.txt", "a+" );
} catch ( Throwable $th ) {
    fwrite( $filePointer, $th->getMessage() . " on line Number " . $th->getLine() . " on file " . $th->getFile() . " at " . date( "F j, Y, g:i a" ) . "\n\n" );
    print "Something went wrong. See error log or Contact with the Administrator" . PHP_EOL;
} finally {
    fclose( $filePointer );
}
