<?php
require_once "vendor/autoload.php";

use App\MoneyManager;
use App\Options;

class MoneyManagerCLI
{

    private function printTitle( string $message ): void
    {
        print "==========================\n" . $message . "\n";
    }

    public function run(): void
    {

        while ( true ) {
            print "==========================\n";
            foreach ( Options::cases() as $option ) {
                print $option->value . ". " . ucfirst( strtolower( str_replace( "_", " ", $option->name ) ) ) . "\n";
            }
            $userOption = intval( readline( "\nEnter your option: " ) );
            if ( $userOption === 7 ) {
                print "App has been closed";
                return;
            }
            $moneyManager = new MoneyManager;

            switch ( $userOption ) {
                case Options::ADD_INCOME->value:
                    $this->printTitle( "Add Income" );
                    break;
                case Options::ADD_EXPENSE->value:
                    $this->printTitle( "Add Expense" );
                    break;
                case Options::VIEW_INCOMES->value:
                    $this->printTitle( "View Incomes" );
                    $moneyManager->viewIncomes();
                    break;
                case Options::VIEW_EXPENSES->value:
                    $this->printTitle( "View expenses" );
                    break;
                case Options::VIEW_SAVINGS->value:
                    $this->printTitle( "View savings" );
                    break;
                case Options::VIEW_CATAGORIES->value:
                    $this->printTitle( "View categories" );
                    break;
                default:
                    $this->printTitle( "Invalid Input. Try a valid Option" );
                    break;
            }
        }
    }
}

$moneyManager = new MoneyManagerCLI;
$moneyManager->run();
print PHP_EOL;
// print getcwd();