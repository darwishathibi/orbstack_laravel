<?php

namespace App\Filters\V1;

use Illuminate\Http\Request;
use  App\Filters\ApiFilter;

class CustomersFilters extends ApiFilter
{
    // Define the allowed query parameters and their operators
    protected $safeParams = [
        'name' => ['eq'],
        'type' => ['eq'],
        'email' => ['eq'],
        'address' => ['eq'],
        'city' => ['eq'],
        'state' => ['eq'],
        'postalCode' => ['eq', 'gt', 'lt'],

    ];

    // Map request parameters to database columns
    protected $columnMap = [
        'postalCode' => 'postal_code',
    ];

    // Map database columns to request parameters
    protected $operatorMap = [
        'eq' => '=',
        'gt' => '>',
        'lt' => '<',
        'lte' => '<=',
        'gte' => '>=',
    ];
}
