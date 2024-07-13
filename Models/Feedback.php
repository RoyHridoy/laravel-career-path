<?php

namespace app\Models;

use app\core\Application;
use app\core\Model;

class Feedback extends Model
{
    public string $feedback;
    public string $userId;

    public function rules(): array
    {
        return [
            "feedback" => [self::RULE_REQUIRED],
            "userId"   => [self::RULE_REQUIRED, [self::RULE_MAX, 'max' => 7], [self::RULE_MIN, 'min' => 7]],
        ];
    }

    public function send()
    {
        $feedbacks = $this->getAllFeedbacks();

        $feedback = [
            "id"       => $this->generateFeedbackId(),
            "feedback" => $this->feedback,
            "userId"   => $this->userId,
        ];
        array_push( $feedbacks, $feedback );
        $this->insertData( $feedbacks, Application::$app->database::$DB_MESSAGE );
        return true;
    }

    public function getAllFeedbacks()
    {
        $jsonData = file_get_contents( Application::$app->database::$DB_MESSAGE );
        return json_decode( $jsonData, true );
    }

    public function getAllFeedbacksByUser( string $uniqueId ): array
    {
        $allMessages = $this->getAllFeedbacks();
        return array_filter( $allMessages, fn( $message ) => $message["userId"] === $uniqueId );
    }

    public function getAllByColumnName( string $columnName ): array
    {
        $feedbacks = $this->getAllFeedbacks();
        return array_column( $feedbacks, $columnName );
    }

    private function generateFeedbackId()
    {
        return max( $this->getAllByColumnName( "id" ) ) + 1;
    }
}
