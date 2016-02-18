<?php namespace App\LibraryClasses;
use DB;
use Carbon\Carbon;
use App\LibraryClasses\VariableProcessing;
class QueryProcessing {
    public function baseInsert($name, $request, $files_id)
    {
        $variableProcessing = new VariableProcessing;
        $request->slug = $variableProcessing->transliterate($request->slug);
        if(!DB::table($name . 's')->where('slug', $request->slug)->exists()) {
            $id = DB::table($name . 's')->insertGetId(
                array(
                    'slug' => $request->slug,
                    'title' => $request->title,
                    'excerpt' => $request->excerpt,
                    'content' => $request->content,
                    'published_at' => $request->published_at,
                    'created_at' => Carbon::now('Europe/Moscow')->toDateTimeString()
                ));
            if(isset($files_id[0])) {
                $this->addFile($name, $files_id, $id);
            }
        }
    }
    public function baseUpdate($name, $request, $files_id)
    {
        $variableProcessing = new VariableProcessing;
        $request->slug = $variableProcessing->transliterate($request->slug);
        DB::table($name . 's')
            ->where('id', $request->id)
            ->update(array(
                'slug' => $request->slug,
                'title' => $request->title,
                'excerpt' => $request->excerpt,
                'content' => $request->content,
                'updated_at' => Carbon::now('Europe/Moscow')->toDateTimeString()
            ));

        if(isset($files_id[0])) {
            $this->addFile($name, $files_id, $request->id);
        }
    }

    /**
     * @param $name
     * @param $files
     * @param $id
     */
    public function addFile($name, $files, $id)
    {
        DB::table($name . "s_files")->where('id_' . $name, $id)->delete();
        foreach($files as $file) {
            if(!DB::table($name . "s_files")->where('id_file', $file)->where('id_' . $name, $id)->exists()&&($file != null))
            {
                DB::table($name . "s_files")->insert(
                    array('id_file' => $file,
                          'id_' . $name => $id));
            }
        }
    }

}