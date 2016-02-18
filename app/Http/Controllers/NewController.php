<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\News;
use Illuminate\Http\Request;

class NewController extends Controller {

    /**
     * Display a listing News, public version.
     *
     * @return Response
     */
    public function index(News $newsModel, Request $request)
    {
        $posts = $newsModel->getNews($request->query(), $request->getPathInfo(), 15);
        return view('post.news', ['posts' => $posts]);
    }
    /**
     * Display a listing News, admin panel version.
     *
     * @return Response
     */
    public function adminList(News $newsModel, Request $request)
    {
        $posts = $newsModel->getNews($request->query(), $request->getPathInfo(), 15);
        return view('admin.all', ['posts' => $posts, 'base_url' => "/admin/news"]);
    }
    /**
     * Display single New, public version.
     *
     * @return Response
     */
    public function single(News $newsModel, $slug)
    {
        $post = $newsModel->singleNew('slug', $slug);
        return view('post.new', ['post' => $post]);
    }
    /**
     * Show the form for creating a New resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.create', ['type_content' => 'new', 'route' => '/new']);
    }
    /**
     * Creating New.
     *
     * @return Response
     */
    public function handlerCreate(News $newsModel, Request $request)
    {
        $newsModel->createNew($request);
        return redirect()->route('admin.news');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(News $newsModel, $id)
    {
        $post = $newsModel->singleNew('id', $id);
        return view('admin.edit', ['post' => $post, 'type_content' => 'new', 'route' => '/news/update']);
    }
    /**
     * Update the specified resource in storage.
     *
     * @return Response
     */
    public function  update(News $newsModel, Request $request)
    {
        $newsModel->updateNew($request);
        return redirect()->route('admin.news');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(News $newsModel, $id)
    {
        $newsModel->deleteNew($id);
        return redirect()->route('admin.news');
    }

}
