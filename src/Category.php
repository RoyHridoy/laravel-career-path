<?php

namespace App;

class Category
{
    private array $categories;
    public function __construct( array $categories )
    {
        $this->categories = $categories;
    }

    public function getCategories(): array
    {
        return $this->categories;
    }

    public function printCategories(): void
    {
        // $categories = $this->categories;

        foreach ( $this->categories as $category ) {
            printf( "Name: %s, Type: %s\n", $category->name, $category->type );
        }
    }
}
