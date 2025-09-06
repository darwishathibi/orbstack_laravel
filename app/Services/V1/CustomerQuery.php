<?php

namespace App\Services\V1;

use Illuminate\Http\Request;

class CustomerQuery
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

    public function transform(Request $request)
    {
        $eloQuery = [];

        foreach ($this->safeParams as $param => $operators) {
            $query = $request->query($param);

            if (!isset($query)) {
                continue;
            }

            $column = $this->columnMap[$param] ?? $param;

            foreach ($operators as $operator) {
                if (isset($query[$operator])) {
                    $eloQuery[] = [
                        'column' => $column,
                        $this->operatorMap[$operator],
                        $query[$operator],
                    ];
                }
            }
        }

        return $eloQuery;
    }
}
