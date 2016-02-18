<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;
use App\LibraryClasses\QueryProcessing;
use App\LibraryClasses\FilesProcessing;
use App\LibraryClasses\CustomPagination;
class News extends Model {
    /**
     * get all News public
     *
     * @return mixed
     */
    public function getNews($path_query, $path_url, $take)
    {
        $news = DB::table('news')->paginate($take);
        //include files in page
        $filesProcessing = new FilesProcessing;
        $news = $filesProcessing->filesPosts($news->all(), 'new');

        //create pagination for page post
        $customPagination = new CustomPagination;
        $news = $customPagination->getPagination($news, $take, $path_url, $path_query, 'news');
        return $news;
    }

    /**
     * Get single New
     *
     * @param $row
     * @param $var
     * @return mixed
     */
    public function singleNew($row, $var)
    {
        $new = DB::table('news')->where($row, $var)->get();
        //include files in page
        $filesProcessing = new FilesProcessing;
        $new = $filesProcessing->filesPosts($new, 'new');
        return $new;
    }
    /**
     *Create New
     *
     * @param $request
     */
    public function createNew($request)
    {
        $filesProcessing = new FilesProcessing;
        $files_id = $filesProcessing->getIdFiles($request);
        $queryProcessing = new QueryProcessing;
        $queryProcessing->baseInsert('new', $request, $files_id);
    }

    /**
     * update New
     *
     * @param $request
     */
    public function updateNew($request)
    {
        $filesProcessing = new FilesProcessing;
        $files_id = $filesProcessing->getIdFiles($request);
        $queryProcessing = new QueryProcessing;
        $queryProcessing->baseUpdate('new', $request, $files_id);
    }

    /**
     * delete New
     *
     * @param $id
     */
    public function deleteNew($id)
    {
        DB::table('news')->where('id', '=', $id)->delete();
    }
}
