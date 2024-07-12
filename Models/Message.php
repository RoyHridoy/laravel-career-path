<?php

namespace app\Models;

use app\core\Model;

class Message extends Model
{
    public function rules(): array
    {
        return [

        ];
    }

    public function getAllByColumnName(string $columnName): array
    {
        return [];
    }
}
