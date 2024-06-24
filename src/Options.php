<?php
namespace App;

enum Options: int {
    case ADD_INCOME      = 1;
    case ADD_EXPENSE     = 2;
    case ADD_CATEGORY    = 3;
    case VIEW_INCOMES    = 4;
    case VIEW_EXPENSES   = 5;
    case VIEW_SAVINGS    = 6;
    case VIEW_CATAGORIES = 7;
    case RESET           = 8;
    case EXIT            = 9;
}

enum Type: string {
    case INCOME  = 'INCOME';
    case EXPENSE = 'EXPENSE';
}
