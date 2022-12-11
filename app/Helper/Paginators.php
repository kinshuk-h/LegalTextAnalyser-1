<?php
namespace App\Helper;

use Illuminate\Pagination\LengthAwarePaginator;

class Paginators{
    public static function arrayPaginator($array, $request)
    {
        $page = $request->input("page", 1);
        $perPage = 10;
        $offset = ($page * $perPage) - $perPage;
    
        return new LengthAwarePaginator(array_slice($array, $offset, $perPage, true), count($array), $perPage, $page,
            ['path' => $request->url(), 'query' => $request->query()]);
    }
}