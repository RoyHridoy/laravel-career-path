<?php

namespace app\core\Form;

use app\core\Model;

class Form
{
    public static function start( string $method = "post", string $action = "" ): object
    {
        echo sprintf( '<form class="space-y-6" action="%s" method="%s">', $action, $method );
        return new Form;
    }

    public static function end()
    {
        return "</form>";
    }

    public function field(Model $model, string $attribute )
    {
        return new Field( $model, $attribute );
    }
}
