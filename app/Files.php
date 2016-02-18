<?php namespace App;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;
use Redirect;
use Illuminate\Http\Response;
use App\LibraryClasses\FilesProcessing;
class Files extends Model {
    public function upload($request)
    {
        $this ->insertFiles($request->file('images'));
        return Redirect::to('upload');
    }
    public function insertFiles($files)
    {
        foreach($files as $key => $image)
        {
            //save image in dir
            $filesProcessing = new FilesProcessing;
            $uploadFile = $filesProcessing->saveImage($image);
            if($uploadFile == 'stop_script'){
                continue;
            }
            /*Сохранение картинки в базу данных*/
            if(!DB::table('files')->where('slug', $uploadFile['name'])->exists()){
                DB::table('files')->insert(
                    array('slug' => $uploadFile['name'],
                        'title' => $uploadFile['name'],
                        'size' => $uploadFile['size'],
                        'type' => $uploadFile['type'],
                        'destinationPath' => date("Y-m"),
                        'created_at' => Carbon::now('Europe/Moscow')->toDateTimeString(),
                    ));
            }
            $imagesId[$key] = DB::table('files')->select('id')->where('slug', $uploadFile['name'])->get()[0]->id;
        }
        if(empty($imagesId)){
            $imagesId = 'an empty file';
        };
        return $imagesId;
    }
    /*
    *
    ** getting all images*/
    public function getImages()
    {
        $images = Files::latest('created_at')->get();
        foreach($images as $key => $image){
            $images[$key]->size = json_decode($image->size);
        }
        return $images;
    }
    public function notInFiles($files_id)
    {
        if(isset($files_id[0])) {
            $files = DB::table('files')->whereNotIn('id', $files_id)->get();
        }
        else {
            $files = DB::table('files')->get();
        }
        $files = $this->createObjectAng($files);
        return $files;
    }
    public function createObjectAng($files)
    {
        foreach($files as $key => $file){
            $file->size = json_decode($file->size);
            $new_files[$key]['url'] = '/uploads/' . $file->destinationPath . '/' .$file->slug . '-' . $file->size[0] . '.' . $file->type;
            $new_files[$key]['id'] = $file->id;
            $new_files[$key]['title'] = $file->title;
            $new_files[$key]['url2'] = '/uploads/' . $file->destinationPath . '/' .$file->slug . '.' . $file->type;
        }
        return $new_files;
    }
    public function initialFiles($ids_posts, $table){
        //get posts files width id post
        $name_table = $table . 's_files';
        $id_key = 'id_' . $table;
        $files = DB::table($name_table)->where($id_key, $ids_posts)
            ->leftJoin('files', 'files.id', '=', $name_table . '.id_file')
            ->select($name_table . '.' . $id_key,
                'files.id',
                'files.slug',
                'files.title',
                'files.size',
                'files.type',
                'files.destinationPath')
            ->get();
        $files = $this->createObjectAng($files);
        return $files;
    }

}

