<?php

namespace App;

class MoneyManagerCLI
{
    private MoneyManager $moneyManager;

    public function __construct()
    {
        $this->moneyManager = new MoneyManager;
    }

    public function run(): void
    {
        while ( true ) {
            print "==================================================================\n";
            foreach ( Options::cases() as $option ) {
                printf( "%d. %s%s", $option->value, str_pad( ucfirst( strtolower( str_replace( "_", " ", $option->name ) ) ), 20 ), $option->value % 3 === 0 ? "\n" : "" );
            }
            $userOption = intval( readline( "\nEnter your option: " ) );
            if ( $userOption === Options::EXIT->value ) {
                print "App has been closed";
                return;
            }

            switch ( $userOption ) {
                case Options::ADD_INCOME->value:
                    $this->printTitle( "Add Income" );
                    $this->moneyManager->addTransaction( Type::INCOME );
                    break;
                case Options::ADD_EXPENSE->value:
                    $this->printTitle( "Add Expense" );
                    $this->moneyManager->addTransaction( Type::EXPENSE );
                    break;
                case Options::ADD_CATEGORY->value:
                    $this->printTitle( "Add Category" );
                    $this->moneyManager->addCategory();
                    break;
                case Options::VIEW_INCOMES->value:
                    $this->printTitle( "View Incomes" );
                    $this->moneyManager->viewIncomes();
                    break;
                case Options::VIEW_EXPENSES->value:
                    $this->printTitle( "View expenses" );
                    $this->moneyManager->viewExpenses();
                    break;
                case Options::VIEW_SAVINGS->value:
                    $this->printTitle( "View savings" );
                    $this->moneyManager->viewSavings();
                    break;
                case Options::VIEW_CATAGORIES->value:
                    $this->printTitle( "View categories" );
                    $this->moneyManager->viewCategories();
                    break;
                case Options::RESET->value:
                    $this->printTitle( "Reset" );
                    $this->moneyManager->resetApplication();
                    break;
                default:
                    $this->printTitle( "Invalid Input. Try a valid Option" );
                    break;
            }
        }
    }

    private function printTitle( string $message ): void
    {
        print "==================================================================\n------------------ " . $message . " -------------------\n";
    }
}