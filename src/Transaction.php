<?php

namespace App;

class Transaction
{
    private array $transactions;
    public function __construct( array $transactions )
    {
        $this->transactions = $transactions;
    }

    public function getTransactions(): array
    {
        return $this->transactions;
    }

    public function getIncomes(): array
    {
        return array_filter( $this->transactions, fn( $transaction ) => $transaction->type === Type::INCOME->value );
    }

    public function getExpenses(): array
    {
        return array_filter( $this->transactions, fn( $transaction ) => $transaction->type === Type::EXPENSE->value );
    }

    public function getSavings(): float
    {
        return $this->getTotalIncome() - $this->getTotalExpense();
    }

    // TODO:: rename this function add add validation if savings is less that expense
    public function addTransaction( float $amount, int $categoryId, Type $type ): bool
    {
        array_push( $this->transactions, (object) [
            "id"          => $this->generateTransactionId(),
            "amount"      => $amount,
            "type"        => $type->value,
            "category_id" => $categoryId,
        ] );
        return true;
    }

    private function generateTransactionId(): int
    {
        $transactionIds = array_column($this->transactions, "id");
        if(count($transactionIds) === 0) {
            return 1;
        }
        return max( array_column( $this->transactions, "id" ) ) + 1;
    }

    private function getTotal( array $items ): float
    {
        return array_reduce( $items, function ( $acc, $item ) {
            return $acc + $item->amount;
        }, 0 );
    }

    private function getTotalIncome(): float
    {
        return $this->getTotal( $this->getIncomes() );
    }

    private function getTotalExpense(): float
    {
        return $this->getTotal( $this->getExpenses() );
    }
}
