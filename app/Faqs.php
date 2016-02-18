<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;
use App\LibraryClasses\QueryProcessing;
use App\LibraryClasses\FilesProcessing;
use App\LibraryClasses\CustomPagination;
class Faqs extends Model {
    /**
     * get all Faqs public
     *
     * @return mixed
     */
    public function getFaqs($path_query, $path_url, $take)
    {
        $faqs = DB::table('faqs')->paginate($take);
        //include files in page
        $filesProcessing = new FilesProcessing;
        $faqs = $filesProcessing->filesPosts($faqs->all(), 'faq');

        //create pagination for page post
        $customPagination = new CustomPagination;
        $faqs = $customPagination->getPagination($faqs, $take, $path_url, $path_query, 'faqs');
        return $faqs;
    }

    /**
     * Get single Faq
     *
     * @param $row
     * @param $var
     * @return mixed
     */
    public function singleFaq($row, $var)
    {
        $faq = DB::table('faqs')->where($row, $var)->get();
        //include files in page
        $filesProcessing = new FilesProcessing;
        $faq = $filesProcessing->filesPosts($faq, 'faq');
        return $faq;
    }
    /**
     *Create Faq
     *
     * @param $request
     */
    public function createFaq($request)
    {
        $filesProcessing = new FilesProcessing;
        $files_id = $filesProcessing->getIdFiles($request);
        $queryProcessing = new QueryProcessing;
        $queryProcessing->baseInsert('faq', $request, $files_id);
    }

    /**
     * update Faq
     *
     * @param $request
     */
    public function updateFaq($request)
    {
        $filesProcessing = new FilesProcessing;
        $files_id = $filesProcessing->getIdFiles($request);
        $queryProcessing = new QueryProcessing;
        $queryProcessing->baseUpdate('faq', $request, $files_id);
    }

    /**
     * delete Faq
     *
     * @param $id
     */
    public function deleteFaq($id)
    {
        DB::table('faqs')->where('id', '=', $id)->delete();
    }
}
