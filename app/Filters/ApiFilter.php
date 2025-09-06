<?php

namespace App\Filters;

use Illuminate\Http\Request;

class ApiFilter
{
    // Define the allowed query parameters and their operators
    protected $safeParams = [];

    // Map request parameters to database columns
    protected $columnMap = [];

    // Map database columns to request parameters
    protected $operatorMap = [];

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
