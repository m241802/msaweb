<?php


namespace app\LibraryClasses;
use DB;
use Illuminate\Pagination\LengthAwarePaginator;
class CustomPagination
{
    public function getPagination($posts, $take, $path_url, $path_query, $name_table){
        //get total page
        $totalPage = DB::table($name_table)->select(DB::raw('count(*) as count'))->get()[0]->count;
        //number current page
        if(isset($path_query['page'])) {
            $currPage = $path_query['page'];
        }
        else {
            $currPage = 0;
        }

        //create pagination object
        $posts = new LengthAwarePaginator(
            $posts, //array items page
            $totalPage, //total items
            $take, //number of items per page
            $currPage, //current page
            ["path" => $path_url] //path url page
        );

        return $posts;
    }

}