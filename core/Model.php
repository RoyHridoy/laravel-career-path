<?php

namespace app\core;

abstract class Model
{
    public const RULE_MIN      = 'min';
    public const RULE_MAX      = 'max';
    public const RULE_EMAIL    = 'email';
    public const RULE_MATCH    = 'match';
    public const RULE_REQUIRED = 'required';
    public const RULE_UNIQUE   = 'unique';

    public array $errors = [];
    abstract public function rules(): array;
    abstract public function getAllByColumnName( string $columnName ): array;

    public function loadData( array $data ): void
    {
        foreach ( $data as $key => $value ) {
            if ( property_exists( $this, $key ) ) {
                $this->{$key} = $value;
            }
        }
    }

    public function validate()
    {
        foreach ( $this->rules() as $property => $rules ) {
            $value = $this->{$property};

            foreach ( $rules as $rule ) {
                $ruleName = $rule;
                if ( is_array( $ruleName ) ) {
                    $ruleName = $ruleName[0];
                }
                if ( self::RULE_REQUIRED === $ruleName && !$value ) {
                    $this->addError( $property, $this->errorMessages()[self::RULE_REQUIRED] );
                }

                if ( self::RULE_EMAIL === $ruleName && !filter_var( $value, FILTER_VALIDATE_EMAIL ) ) {
                    $this->addError( $property, $this->errorMessages()[self::RULE_EMAIL] );
                }

                if ( self::RULE_MIN === $ruleName && ( strlen( $value ) < $rule['min'] ) ) {
                    $errorMsg = $this->errorMessages()[self::RULE_MIN];
                    $this->addError( $property, str_replace( "{{$ruleName}}", $rule['min'], $errorMsg ) );
                }

                if ( self::RULE_MAX === $ruleName && ( strlen( $value ) > $rule['max'] ) ) {
                    $errorMsg = $this->errorMessages()[self::RULE_MAX];
                    $this->addError( $property, str_replace( "{{$ruleName}}", $rule['max'], $errorMsg ) );
                }

                if ( self::RULE_MATCH === $ruleName && !( $value === $this->{$rule['match']} ) ) {
                    $errorMsg = $this->errorMessages()[self::RULE_MATCH];
                    $this->addError( $property, str_replace( "{{$ruleName}}", $rule['match'], $errorMsg ) );
                }
                if ( self::RULE_UNIQUE === $ruleName && in_array( $value, $this->getAllByColumnName( "email" ) ) ) {
                    $errorMsg = $this->errorMessages()[self::RULE_UNIQUE];
                    $this->addError( $property, $errorMsg );
                }
            }
        }
        return count( $this->errors ) === 0;
    }

    public function errorMessages()
    {
        return [
            self::RULE_REQUIRED => 'This field is required',
            self::RULE_EMAIL    => 'This field must be valid email address',
            self::RULE_MAX      => 'Max length of this field must be {max}',
            self::RULE_MIN      => 'Min length of this field must be {min}',
            self::RULE_MATCH    => 'This field must be same as {match}',
            self::RULE_UNIQUE   => 'Already register with this email',
        ];
    }

    public function hasError( $property )
    {
        return $this->errors[$property] ?? false;
    }

    private function addError( $property, $message ): void
    {
        $this->errors[$property][] = $message;
    }

    public function getFirstErrorMessage( $property ): string
    {
        return $this->hasError( $property ) ? $this->errors[$property][0] : "";
    }

    public function insertData( array $data, string $dbName )
    {
        Application::$app->database->insertData( $data, $dbName );
    }
}
