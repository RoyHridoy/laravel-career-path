<?php

namespace app\core;

class Database
{
    public static $DB_MESSAGE = "./db/messages.txt";
    public static $DB_USER    = "./db/users.txt";

    public function insertData( array $data, string $dbName )
    {
        $data = json_encode( $data );
        return file_put_contents( $dbName, $data, LOCK_EX );
    }
}
