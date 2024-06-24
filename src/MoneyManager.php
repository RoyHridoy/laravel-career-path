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
            printf( "%s: %s\n", str_pad( $category->type, 8 ), ucfirst( $category->name ) );
        }
    }

    public function viewSpecificCategories( Type $type ): void
    {
        foreach ( $this->categories->getSpecificCategoryTypes( $type ) as $item ) {
            printf( "%d. %s\n", $item->id, ucfirst( $item->name ) );
        }
    }

    public function addTransaction( Type $type ): bool
    {
        $amount = $this->inputAmount();
        if ( $amount <= 0 ) {
            printf( "⛔ Transaction is not possible.\nAmount must be greater than 0\nTry from Scratch\n" );
            return false;
        }

        $categoryId = $this->inputCategoryId( $type );
        if ( $type->value === Type::EXPENSE->value && $this->transactions->getSavings() < $amount ) {
            printf( "⛔ Transaction is not possible.\nYour savings(%.2f) is less than your expense(%.2f)\nRetry with a logical amount.\n", $this->transactions->getSavings(), $amount );
            return false;
        }

        $isValidTransaction = $this->transactions->insertTransaction( $amount, $categoryId, $type );
        if ( $isValidTransaction ) {
            $this->storeData();
            printf( "✅ Transaction added Successfully.\n" );
            return true;
        }
    }

    public function addCategory(): bool
    {
        $type = $this->inputCategoryType();
        if ( !$type ) {
            return false;
        }

        $categoryName = $this->inputCategoryName( $type );
        if ( !$categoryName ) {
            return false;
        }

        $isValidCategory = $this->categories->insertCategory( $type, $categoryName );
        if ( $isValidCategory ) {
            $this->storeData();
            printf( "✅ Category added Successfully.\n" );
            return true;
        }
    }

    public function resetTransaction()
    {
        printf( "⚠️ This will remove all of your transactions and the categories you added manually.\n Only Default Categories remain. Are you really sure❓\n  1. Confirm\n  0. Cancel\n" );
        $confirm = intval( readline( "Press 1 or 0: " ) );
        if ( 0 === $confirm ) {
            return false;
        }
        if ( 1 === $confirm ) {
            file_put_contents( $this->file->DB, json_encode( [
                "categories"   => json_decode( $this->categories->getDefaultCategories() ),
                "transactions" => [],
            ] ), LOCK_EX );
            $data               = $this->fetchAllData();
            $this->categories   = new Category( $data->categories );
            $this->transactions = new Transaction( $data->transactions );
            printf( "✅ Successfully Reset the Application.\n" );
            return true;
        }
        printf( "⛔ Invalid Key. Try Later\n" );
        return false;
    }

    private function inputCategoryName( string $type ): string | bool
    {
        if ( Type::INCOME->value === $type ) {
            $existingCategories = $this->categories->getAllIncomeCategories();
        }
        if ( Type::EXPENSE->value === $type ) {
            $existingCategories = $this->categories->getAllExpenseCategories();
        }

        $categoryName = strtolower( readline( "Enter Category name: " ) );
        if ( in_array( $categoryName, $existingCategories ) ) {
            printf( "⛔ This category already exists! ⛔\nTry again from scratch\n" );
            return false;
        }
        return $categoryName;
    }

    private function inputCategoryType(): string | bool
    {
        printf( "Choose Category Type:\n1. INCOME\n2. EXPENSE\n" );
        $type = intval( readline( "Enter Category number(1 or 2): " ) );
        if ( $type === 1 ) {
            return Type::INCOME->value;
        }
        if ( $type === 2 ) {
            return Type::EXPENSE->value;
        }
        printf( "⛔ Invalid Category ⛔\nTry again with valid category\n" );
        return false;
    }

    private function inputAmount(): float
    {
        $amount = floatval( readline( "Enter amount: " ) );
        while ( !$amount ) {
            printf( "⛔ Invalid Amount! Please Provide Valid Amount.\n" );
            $amount = floatval( readline( "Enter valid amount: " ) );
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
            printf( "⛔ Invalid Category Number.\nPlease Provide Valid Category Number from above list\n" );
            $categoryId = intval( readline( "Enter valid Category number: " ) );
        }
        return $categoryId;
    }

    private function storeData()
    {
        file_put_contents( $this->file->DB, json_encode( [
            "categories"   => $this->categories->getCategories(),
            "transactions" => $this->transactions->getTransactions(),
        ] ), LOCK_EX );
    }

    private function fetchAllData(): object
    {
        return json_decode( file_get_contents( $this->file->DB ) );
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
        if ( count( $items ) === 0 ) {
            printf( "You have No Transaction to show\n" );
            return;
        }

        $total = 0;
        foreach ( $this->getIncomesOrExpenses( $items ) as $item ) {
            $total += $item["amount"];
            printf( "%s: %12.2f\n", str_pad( ucfirst( $item["category"] ), 20 ), $item["amount"] );
        }
        printf( "------------------------------------\n%s: %12.2f\n", str_pad( "Total amount", 20 ), $total );
    }
}
