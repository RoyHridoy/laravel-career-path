<?php

namespace app\Models;

use app\core\Application;
use app\core\Database;
use app\core\Model;

class User extends Model
{
    public string $name            = '';
    public string $email           = '';
    public string $password        = '';
    public string $confirmPassword = '';

    public function rules(): array
    {
        return [
            'name'            => [self::RULE_REQUIRED],
            'email'           => [self::RULE_REQUIRED, self::RULE_EMAIL, self::RULE_UNIQUE],
            'password'        => [self::RULE_REQUIRED, [self::RULE_MAX, 'max' => 24], [self::RULE_MIN, 'min' => 8]],
            'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }

    public function register()
    {
        $users = $this->getAllUsers();

        $user = [
            'id'       => $this->generateUserId(),
            'name'     => $this->name,
            'email'    => $this->email,
            'password' => password_hash( $this->password, PASSWORD_DEFAULT ),
            'uniqueId' => $this->generateUniqueId(),
        ];
        array_push( $users, $user );
        $this->insertData( $users, Application::$app->database::$DB_USER );
        return true;
    }

    public function getAllUsers(): array
    {
        $jsonData = file_get_contents( Application::$app->database::$DB_USER );
        return json_decode( $jsonData, true );
    }

    public function getAllByColumnName( string $columnName ): array
    {
        $users = $this->getAllUsers();
        return array_column( $users, $columnName );
    }

    public function getUserByColumnName( int | string $id, string $columnName = 'id' )
    {
        $users  = $this->getAllUsers();
        $offset = -1;
        foreach ( $users as $key => $user ) {
            if ( $user[$columnName] === $id ) {
                $offset = $key;
                break;
            }
        }
        return $users[$offset] ?? false;
    }

    private function generateUserId()
    {
        return max( $this->getAllByColumnName( "id" ) ) + 1;
    }

    private function generateUniqueId()
    {
        $character = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $length    = strlen( $character );
        $uniqueId  = '';
        for ( $i = 0; $i < 7; $i++ ) {
            $uniqueId .= $character[rand( 0, $length - 1 )];
        }
        if ( in_array( $uniqueId, $this->getAllByColumnName( "uniqueId" ), true ) ) {
            $this->generateUniqueId();
        }
        return $uniqueId;
    }
}
