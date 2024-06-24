<?php

namespace App;

class Category
{
    private array $categories;
    private const DEFAULT_CATEGORIES = [
        ["id" => 1, "name" => "Rent", "type" => "EXPENSE"],
        ["id" => 2, "name" => "Business", "type" => "INCOME"],
        ["id" => 3, "name" => "Groceries", "type" => "EXPENSE"],
        ["id" => 4, "name" => "Utilities", "type" => "EXPENSE"],
        ["id" => 5, "name" => "Salary", "type" => "INCOME"],
        ["id" => 6, "name" => "Entertainment", "type" => "EXPENSE"],
        ["id" => 7, "name" => "Investment", "type" => "INCOME"],
    ];

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

    public function getAllIncomeCategories()
    {
        return array_column( $this->getSpecificCategoryTypes( Type::INCOME ), "name" );
    }

    public function getAllExpenseCategories()
    {
        return array_column( $this->getSpecificCategoryTypes( Type::EXPENSE ), "name" );
    }

    public function insertCategory( string $type, string $name )
    {
        array_push( $this->categories, (object) [
            "id"   => $this->generateCategoryId(),
            "name" => $name,
            "type" => $type,
        ] );
        return true;
    }

    public function getDefaultCategories(): string
    {
        return json_encode( self::DEFAULT_CATEGORIES );
    }

    private function generateCategoryId(): int
    {
        $maxId = max( array_column( $this->categories, "id" ) );
        return $maxId + 1;
    }
}
