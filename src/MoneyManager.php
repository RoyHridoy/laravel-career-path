<?php
namespace App;

require_once "vendor/autoload.php";

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

    private function fetchAllData(): object
    {
        return json_decode( file_get_contents( $this->file::DB ) );
    }

    private function getIncomes(): array
    {
        return array_map( function ( $income ) {
            $categoryDetails = array_filter( $this->categories->getCategories(), fn( $category ) => $category->id === $income->category_id );
            return [
                "category" => reset( $categoryDetails )->name,
                "amount"   => $income->amount,
                "type"     => $income->type,
            ];
        }, $this->transactions->getIncomes() );
    }

    // TODO: Implement remains
    private function printExpenses(): array
    {
        return array_map( function ( $expense ) {
            $categoryDetails = array_filter( $this->categories->getCategories(), fn( $category ) => $category->id === $expense->category_id );
            return [
                "category" => reset( $categoryDetails )->name,
                "amount"   => $expense->amount,
                "type"     => $expense->type,
            ];
        }, $this->transactions->getExpenses() );
    }

    public function viewIncomes(): void
    {
        $total = 0;
        foreach ( $this->getIncomes() as $income ) {
            $total += $income["amount"];
            printf( "%s: %10.2f\n", str_pad( $income["category"], 20 ), $income["amount"] );
        }
        printf( "---------------------------------\n%s: %10.2f\n", str_pad( "Total Income is", 20 ), $total );
    }
}
