<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;
use App\LibraryClasses\QueryProcessing;
use App\LibraryClasses\FilesProcessing;
use App\LibraryClasses\CustomPagination;
class Posts extends Model {
    /**
     * get all Posts admin width files
     * tables DB: posts
     *
     * @return mixed
     */
    public function getPosts($path_query, $path_url, $take)
    {
        $posts = DB::table('posts')->paginate($take);
        //include files in page
        $filesProcessing = new FilesProcessing;
        $posts = $filesProcessing->filesPosts($posts->all(), 'post');
        //create pagination for page post
        $customPagination = new CustomPagination;
        $posts = $customPagination->getPagination($posts, $take, $path_url, $path_query, 'posts');
        return $posts;
    }


    /**
     * Get single post
     *
     * @param $row
     * @param $var
     * @return mixed
     */
    public function singlePost($row, $var)
    {
        $post = DB::table('posts')->where($row, $var)->get();
        //include files in page
        $filesProcessing = new FilesProcessing;
        $post = $filesProcessing->filesPosts($post, 'post');
        return $post;
    }
    /**
     *Create post
     *
     * @param $request
     */
    public function createPost($request)
    {
        $filesProcessing = new FilesProcessing;
        $files_id = $filesProcessing->getIdFiles($request);
        $queryProcessing = new QueryProcessing;
        $queryProcessing->baseInsert('post', $request, $files_id);
    }

    /**
     * update Post
     *
     * @param $request
     */
    public function updatePost($request)
    {
        $filesProcessing = new FilesProcessing;
        $files_id = $filesProcessing->getIdFiles($request);
        $queryProcessing = new QueryProcessing;
        $queryProcessing->baseUpdate('post', $request, $files_id);
    }

    /**
     * delete Post
     *
     * @param $id
     */
    public function deletePost($id)
    {
        DB::table('posts')->where('id', '=', $id)->delete();
    }
}
