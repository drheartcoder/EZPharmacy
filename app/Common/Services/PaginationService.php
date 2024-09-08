<?php

namespace App\Common\Services;

use App\Models\UserModel;

use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class PaginationService
{
	public function __construct( )
	{
					
	}

	public function makePagination($items = [] ,$perPage = 3)
    {
        $pageStart = \Request::get('page', 1);
        // Start displaying items from this number;
        $offSet = ($pageStart * $perPage) - $perPage; 

        // Get only the items you need using array_slice
        $itemsForCurrentPage = array_slice($items, $offSet, $perPage, true);

        $obj_paginate = new LengthAwarePaginator($itemsForCurrentPage, count($items), $perPage,Paginator::resolveCurrentPage(), array('path' => Paginator::resolveCurrentPath()));

        return collect($obj_paginate)->toArray();
    }
}
?>