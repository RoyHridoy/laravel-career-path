<?php

namespace app\Models;

use app\core\Application;
use app\core\Model;

class Message extends Model
{
    public string $message;
    public string $userId;

    public function rules(): array
    {
        return [
            "message" => [self::RULE_REQUIRED],
            "userId"  => [self::RULE_REQUIRED, [self::RULE_MAX, 'max' => 7], [self::RULE_MIN, 'min' => 7]],
        ];
    }

    public function getAllMessagesByUser( string $uniqueId ): array
    {
        $jsonData    = file_get_contents( Application::$app->database::$DB_MESSAGE );
        $allMessages = json_decode( $jsonData, true );

        return array_filter( $allMessages, fn( $message ) => $message["userId"] === $uniqueId );
    }

    public function getAllByColumnName( string $columnName ): array
    {
        return [];
    }
}
