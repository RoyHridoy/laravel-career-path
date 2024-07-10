<?php

namespace app\core\Form;

use app\core\Model;

class Field
{
    private Model $model;
    private string $attribute;
    private string $type  = "text";
    private string $label = "Property Label";
    public function __construct( Model $model, string $attribute )
    {
        $this->model     = $model;
        $this->attribute = $attribute;
    }

    public function __toString()
    {
        return sprintf( '
            <div>
                <label for="%s" class="block text-sm font-medium leading-6 text-gray-900">%s</label>
                <div class="mt-2">
                    <input id="%s" name="%s" type="%s" autocomplete="%s" value="%s" required class="block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 %s">
                </div>
                <span class="mt-2 text-red-400 text-sm">%s</span>
            </div>
        ',
            $this->attribute,
            $this->label,
            $this->attribute,
            $this->attribute,
            $this->type,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->hasError( $this->attribute ) ? 'ring-red-300' : 'ring-gray-400',
            $this->model->getFirstErrorMessage( $this->attribute )
        );
    }

    public function type( string $value )
    {
        $this->type = $value;
        return $this;
    }

    public function label( string $value )
    {
        $this->label = $value;
        return $this;
    }
}
