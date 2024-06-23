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

    public function getSpecificCategoryTypes( Type $type ): array
    {
        return array_filter( $this->categories, fn( $category ) => $category->type === $type->value );
    }

    public function getAllIncomeCategoryIds()
    {
        return array_column( $this->getSpecificCategoryTypes( Type::INCOME ), "id" );
    }

    public function getAllExpenseCategoryIds()
    {
        return array_column( $this->getSpecificCategoryTypes( Type::EXPENSE ), "id" );
    }

    private function generateCategoryId(): int
    {
        $maxId = max( array_column( $this->categories, "id" ) );
        return $maxId + 1;
    }
}
