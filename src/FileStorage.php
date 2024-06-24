<?php
namespace App;

use Exception;

class FileStorage
{
    public string $DB;

    public function __construct()
    {
        if ( !file_exists( "src/db/db.txt" ) ) {
            throw new Exception( "Database File isn't Found" );
        }
        $this->DB = "src/db/db.txt";
    }
}
