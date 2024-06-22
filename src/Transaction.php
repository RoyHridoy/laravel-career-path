<?php

namespace App;

class Transaction
{
    private array $transactions;
    public function __construct( array $transactions )
    {
        $this->transactions = $transactions;
    }

    public function getIncomes(): array
    {
        return array_filter( $this->transactions, fn( $transaction ) => $transaction->type === 'INCOME' );
    }

    public function getExpenses(): array
    {
        return array_filter( $this->transactions, fn( $transaction ) => $transaction->type === 'EXPENSE' );
    }

    // TODO: Have to implement
    public function addTransaction( float $amount, string $type ): bool
    {
        return false;
    }

    // TODO: Have to implement
    public function getTotalExpense(): float
    {
        return 5.5;
    }
    
    // TODO: Have to implement
    public function getTotalIncome(): float
    {
        return 5.5;
    }
    // TODO: Have to implement
    public function getSavings(): float
    {
        return 5.5;
    }
}