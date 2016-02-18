<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Files;
use Illuminate\Http\Request;

class FileController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Files $filesModel)
    {
        $images = $filesModel->getImages();
        return view('admin.file.all', ['images' => $images]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function uploadPage()
    {
        return view('admin.file.upload');
    }

    /**
     * @param Files $filesModel
     * @param Request $request
     */
    public function upload(Files $filesModel, Request $request)
    {
        dd($request);
        $filesModel->upload($request);

        /*return redirect()->route('admin.files');*/
    }
    /**
     * @param Files $filesModel
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function angFiles(Files $filesModel, Request $request)
    {
        $files = $filesModel->notInFiles($request->attrs);
        return response()->json($files);
    }
    public function initialFiles(Files $filesModel, Request $request)
    {
        $files = $filesModel->initialFiles($request->postId, $request->typeContent);
        return response()->json($files);
    }








}
