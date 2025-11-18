<?php

namespace App\Helpers;

use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CollectionHelper
{
    /**
     * Custom Pagination
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public static function paginate($data, $perPage = 10, $total = null)
    {
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        
        if (is_null($total)) {
            $offset = (request('page') - 1) * $perPage;
            $offset = $offset > 0 ? $offset : 0;
            
            if ($data instanceof Collection) {
                $total = $data->count();
                $items = $total > $perPage
                    ? $data->slice($offset, $perPage)->values()
                    : $data->values();
            } else {
                $total = count($data);
                $items = $total > $perPage
                    ? array_slice($data, $offset, $perPage)
                    : $data;
            }
    
            if ($total < $offset) {
                $items = [];
            }
        } else {
            if ($data instanceof Collection) {
                $items = $data->values()->toArray();
            } else {
                $items = $data;
            }
        }

        return new LengthAwarePaginator(
            $items,
            $total,
            $perPage,
            $currentPage,
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );
    }
}
