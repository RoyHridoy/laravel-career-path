<?php
namespace App;

class MoneyManager
{
    private FileStorage $file;
    private Category $categories;
    private Transaction $transactions;

    public function __construct()
    {
        $this->file         = new FileStorage;
        $data               = $this->fetchAllData();
        $this->categories   = new Category( $data->categories );
        $this->transactions = new Transaction( $data->transactions );
    }

    public function viewIncomes(): void
    {
        $this->viewIncomesOrExpenses( $this->transactions->getIncomes() );
    }

    public function viewExpenses(): void
    {
        $this->viewIncomesOrExpenses( $this->transactions->getExpenses() );
    }

    public function viewSavings(): void
    {
        printf( "%s: %10.2f\n", str_pad( "Your savings", 20 ), $this->transactions->getSavings() );
    }

    public function viewCategories(): void
    {
        foreach ( $this->categories->getCategories() as $category ) {
            printf( "%s: %s\n", str_pad( $category->type, 8 ), $category->name );
        }
    }

    public function viewSpecificCategories( Type $type ): void
    {
        foreach ( $this->categories->getSpecificCategoryTypes( $type ) as $item ) {
            printf( "%d. %s\n", $item->id, $item->name );
        }
    }
    // TODO: implement notification that transaction added successfully
    // TODO: 
    public function addTransaction(Type $type):void
    {
        $amount     = $this->inputAmount();
        $categoryId = $this->inputCategoryId( $type );
        $this->transactions->addTransaction( $amount, $categoryId, $type );
        $this->storeData();
    }

    private function inputAmount(): int
    {
        $amount = intval( readline( "Enter amount: " ) );
        while ( !$amount ) {
            printf( "❌ Invalid Amount! Please Provide Valid Amount.\n" );
            $amount = intval( readline( "Enter valid amount: " ) );
        }
        return $amount;
    }

    private function inputCategoryId( Type $type ): int
    {
        printf( "Choose Category: \n" );

        if ( $type->value === Type::INCOME->value ) {
            $this->viewSpecificCategories( Type::INCOME );
            $categories = $this->categories->getAllIncomeCategoryIds();
        } else {
            $this->viewSpecificCategories( Type::EXPENSE );
            $categories = $this->categories->getAllExpenseCategoryIds();
        }

        $categoryId = intval( readline( "Enter Category number: " ) );
        while ( !in_array( $categoryId, $categories ) ) {
            printf( "❌ Invalid Category Input. Please Provide Valid Category\n" );
            $categoryId = intval( readline( "Enter valid Category number: " ) );
        }
        return $categoryId;
    }

    private function storeData()
    {
        file_put_contents( $this->file::DB, json_encode( [
            "categories"   => $this->categories->getCategories(),
            "transactions" => $this->transactions->getTransactions(),
        ] ), LOCK_EX );
    }

    private function fetchAllData(): object
    {
        return json_decode( file_get_contents( $this->file::DB ) );
    }

    private function getIncomesOrExpenses( array $items ): array
    {
        return array_map( function ( $item ) {
            $categoryDetails = array_filter( $this->categories->getCategories(), fn( $category ) => $category->id === $item->category_id );
            return [
                "category" => reset( $categoryDetails )->name,
                "amount"   => $item->amount,
                "type"     => $item->type,
            ];
        }, $items );
    }

    private function viewIncomesOrExpenses( array $items ): void
    {
        $total = 0;
        foreach ( $this->getIncomesOrExpenses( $items ) as $item ) {
            $total += $item["amount"];
            printf( "%s: %10.2f\n", str_pad( $item["category"], 20 ), $item["amount"] );
        }
        printf( "---------------------------------\n%s: %10.2f\n", str_pad( "Total amount", 20 ), $total );
    }
}
