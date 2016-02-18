<?php


namespace App\LibraryClasses;

use App\LibraryClasses\VariableProcessing;
use DB;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Files;
class FilesProcessing {
    /*
    * * save the image with all sizes
    * */
    public function createFileObject($url){
        //get name file by url and save in object-file
        $path_parts = pathinfo($url);
        //get image info (mime, size in pixel, size in bits)
        $newPath = $path_parts['dirname'] . '/tmp-files/';
        if(!is_dir ($newPath)){
            mkdir($newPath, 0777);
        }
        $newUrl = $newPath . $path_parts['basename'];
        copy($url, $newUrl);
        $imgInfo = getimagesize($newUrl);
        $file = new UploadedFile(
            $newUrl,
            $path_parts['basename'],
            $imgInfo['mime'],
            filesize($url),
            null,
            TRUE
        );
        return $file;
    }
    public function preparationSaveImage($image){
        //a change in the file php.ini for the correct operation of the script
        ini_set('max_execution_time', 30000);
        ini_set("gd.jpeg_ignore_warning", 1);
        ini_set("extension", "php_gd2.dll");
        $imageEnding = $image->getClientOriginalExtension();
        //Create a new image from file by type
        $imageCreateFrom = $this->imageCreateFrom($imageEnding, $image);
        if($imageCreateFrom == 'stop_script') {
            return $imageCreateFrom;
        }
        $img = $imageCreateFrom[0];
        $imageEnding = $imageCreateFrom[1];
        //upload path
        $destinationPath = 'uploads/img/' . date("Y-m") . '/';
        //check for the existence of the directory if there is no set up
        if(!is_dir ($destinationPath)){
            mkdir($destinationPath, 0777);
        }
        $fileName = $image->getClientOriginalName();
        //translation of the Cyrillic alphabet in Latin alphabet
        $variableProcessing = new VariableProcessing;
        $imageName = $variableProcessing->transliterate($fileName);
        //clean file name from the end of
        $imageName = str_replace('.' . $imageEnding, '', $imageName);
    }

    public function saveImage($image){
        //a change in the file php.ini for the correct operation of the script
        ini_set('max_execution_time', 30000);
        ini_set("gd.jpeg_ignore_warning", 1);
        ini_set("extension", "php_gd2.dll");
        $imageEnding = $image->getClientOriginalExtension();
        //Create a new image from file by type
        $imageCreateFrom = $this->imageCreateFrom($imageEnding, $image);
        if($imageCreateFrom == 'stop_script') {
            return $imageCreateFrom;
        }
        $img = $imageCreateFrom[0];
        $imageEnding = $imageCreateFrom[1];
        //upload path
        $destinationPath = 'uploads/' . date("Y-m") . '/';
        //check for the existence of the directory if there is no set up
        if(!is_dir ($destinationPath)){
            mkdir($destinationPath, 0777);
        }
        $fileName = $image->getClientOriginalName();
        //translation of the Cyrillic alphabet in Latin alphabet
        $variableProcessing = new VariableProcessing;
        $imageName = $variableProcessing->transliterate($fileName);
        //clean file name from the end of
        $imageName = str_replace('.' . $imageEnding, '', $imageName);


        $startSize = getimagesize($image);
        //Adding additional image sizes
        $newSize = $this->newSize($image, $startSize);
        $imgSize = "";
        foreach($newSize as $key => $value){
            $imgSize[$key] = round($value['width']) . "x" . round($value['height']);
            $newImage = imagecreatetruecolor($value['width'], $value['height']);
            imagecopyresampled($newImage, $img, 0, 0, 0, 0, $value['width'], $value['height'], $startSize[0], $startSize[1]);
            imagejpeg($newImage, $destinationPath . $imageName . '-' . $imgSize[$key] . '.' . $imageEnding );
        }
        $image->move($destinationPath,  $imageName . '.' . $imageEnding);
        $imgSize = json_encode($imgSize);
        return array('name' => $imageName, 'size' => $imgSize, 'type' => $imageEnding);
    }
    /*
    * * Adding additional image sizes
    * */
    public function newSize($image, $start_size){
        $quotient_size1 = $start_size[0] / $start_size[1];
        $quotient_size2 = $start_size[1] / $start_size[0];
        if($start_size[0] > $start_size[1]) {
            $size[0]['width'] = 80;
            $size[0]['height'] = $size[0]['width'] * $quotient_size2;
            $size[1]['width'] = 181;
            $size[1]['height'] = $size[1]['width'] * $quotient_size2;
        }
        elseif($start_size[0] < $start_size[1]) {
            $size[0]['height'] = 80;
            $size[0]['width'] = $size[0]['height'] * $quotient_size1;
            $size[1]['height'] = 181;
            $size[1]['width'] = $size[1]['height'] * $quotient_size1;
        }
        else {
            $size[0]['width'] = 80;
            $size[0]['height'] = 80;
            $size[1]['width'] = 181;
            $size[1]['height'] = 181;
        }
        return $size;
    }
    /*
   * * Create a new image from file by type
   * */
    public function imageCreateFrom($imageEnding, $image){
        if(@imagecreatefromgif($image)) {
            $img = array(imagecreatefromgif($image), 'gif');
        }
        elseif(@imagecreatefromjpeg($image)) {
            if($imageEnding != 'jpg') {
                $imageEnding == 'jpeg';
            }
            $img = array(imagecreatefromjpeg($image), $imageEnding);
        }
        elseif(@imagecreatefrompng($image)) {
            $img = array(imagecreatefrompng($image), 'png');
        }
        //if not content in file
        elseif(!file_get_contents($image)) {
            return 'stop_script';
        }
        else {
            dd($image, $imageEnding);
        }
        return $img;
    }
    /*
     * Add url files in posts
     * */
    public function filesPosts($posts, $table){
        foreach($posts as $key => $post){
            $new_posts[$post->id] = $post;
        }
        //get array from id page
        $ids_posts = array_keys($new_posts);
        //get posts files width id post
        $name_table = $table . 's_files';
        $id_key = 'id_' . $table;
        $files = DB::table($name_table)->whereIn($id_key, $ids_posts)
            ->leftJoin('files', 'files.id', '=', $name_table . '.id_file')
            ->select($name_table . '.' . $id_key,
                'files.id',
                'files.slug',
                'files.title',
                'files.size',
                'files.type',
                'files.destinationPath')
            ->get();
        //the formation of URL files and entering them in posts
        foreach($files as $file){
            $url = '/uploads/' . $file->destinationPath . '/' . $file->slug;
            $sizes = json_decode($file->size);
            foreach($sizes as $key => $size){
                $new_posts[$file->{$id_key}]->files[$file->id][$key] = $url . '-' . $size . '.' . $file->type;
            }
            $new_posts[$file->{$id_key}]->files[$file->id][count($sizes)] = $url . '.' . $file->type;
        }
        //
        $new_posts = array_values($new_posts);
        return $new_posts;

    }
    /**
     * @param $request
     * @return array|string
     */
    public function getIdFiles($request){
        $addFiles = $request->files->all()['images'];
        $files_id = array();
        if($addFiles[0] != null){
            $filesModel = new Files;
            $files_id = $filesModel->insertFiles($addFiles);
        }
        if(isset($request->images[0])&&($request->images[0] != null)){
            $files_id = array_merge($files_id, $request->images);
        }
        return $files_id;

    }

}