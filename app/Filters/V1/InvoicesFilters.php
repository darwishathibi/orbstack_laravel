<?php

namespace App\Filters\V1;

use Illuminate\Http\Request;
use  App\Filters\ApiFilter;

class InvoicesFilters extends ApiFilter
{
    // Define the allowed query parameters and their operators
    protected $safeParams = [
        'customerId' => ['eq'],
        'amount' => ['eq', 'gt', 'lt', 'lte', 'gte'],
        'status' => ['eq', 'ne'],
        'address' => ['eq'],
        'billedDate' => ['eq', 'gt', 'lt', 'lte', 'gte'],
        'paidDate' => ['eq', 'gt', 'lt', 'lte', 'gte'],
    ];

    // Map request parameters to database columns
    protected $columnMap = [
        'customerId' => 'customer_id',
        'billedDate' => 'billed_date',
        'paidDate' => 'paid_date',
    ];

    // Map database columns to request parameters
    protected $operatorMap = [
        'eq' => '=',
        'gt' => '>',
        'lt' => '<',
        'lte' => '<=',
        'gte' => '>=',
        'ne' => '!=',
    ];

    
}
