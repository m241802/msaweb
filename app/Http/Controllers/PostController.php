<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Posts;
use Illuminate\Http\Request;

class PostController extends Controller {

    /**
     * Display a listing Posts, public version.
     *
     * @return Response
     */
    public function index(Posts $postsModel, Request $request)
    {
        $posts = $postsModel->getPosts($request->query(), $request->getPathInfo(), 15);
        return view('post.posts', ['posts' => $posts]);
    }
    /**
     * Display a listing Posts, admin panel version.
     *
     * @return Response
     */
    public function adminList(Posts $postsModel, Request $request)
    {
        $posts = $postsModel->getPosts($request->query(), $request->getPathInfo(), 15);
        return view('admin.all', ['posts' => $posts, 'base_url' => "/admin/posts"]);
    }
    /**
     * Display single Post, public version.
     *
     * @return Response
     */
    public function single(Posts $postsModel, $slug)
    {
        $post = $postsModel->singlePost('slug', $slug);
        return view('post.post', ['post' => $post]);
    }
    /**
     * Show the form for creating a Post resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.create', ['type_content' => 'post', 'route' => '/post']);
    }
    /**
     * Creating Post.
     *
     * @return Response
     */
    public function handlerCreate(Posts $postsModel, Request $request)
    {
        $postsModel->createPost($request);
        return redirect()->route('admin.posts');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Posts $postsModel, $id)
    {
        $post = $postsModel->singlePost('id', $id);
        return view('admin.edit', ['post' => $post, 'type_content' => 'post', 'route' => '/posts/update']);
    }
    /**
     * Update the specified resource in storage.
     *
     * @return Response
     */
    public function  update(Posts $postsModel, Request $request)
    {
        $postsModel->updatePost($request);
        return redirect()->route('admin.posts');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Posts $postsModel, $id)
    {
        $postsModel->deletePost($id);
        return redirect()->route('admin.posts');
    }

}
