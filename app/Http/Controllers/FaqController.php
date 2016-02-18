<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Faqs;
use Illuminate\Http\Request;

class FaqController extends Controller {

    /**
     * Display a listing Faqs, public version.
     *
     * @return Response
     */
    public function index(Faqs $faqsModel, Request $request)
    {
        $posts = $faqsModel->getFaqs($request->query(), $request->getPathInfo(), 15);
        return view('post.faqs', ['posts' => $posts]);
    }
    /**
     * Display a listing Faqs, admin panel version.
     *
     * @return Response
     */
    public function adminList(Faqs $faqsModel, Request $request)
    {
        $posts = $faqsModel->getFaqs($request->query(), $request->getPathInfo(), 15);
        return view('admin.all', ['posts' => $posts, 'base_url' => "/admin/faqs"]);
    }
    /**
     * Display single Faq, public version.
     *
     * @return Response
     */
    public function single(Faqs $faqsModel, $slug)
    {
        $post = $faqsModel->singleFaq('slug', $slug);
        return view('post.faq', ['post' => $post]);
    }
    /**
     * Show the form for creating a Faq resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.create', ['type_content' => 'faq', 'route' => '/faq']);
    }
    /**
     * Creating Faq.
     *
     * @return Response
     */
    public function handlerCreate(Faqs $faqsModel, Request $request)
    {
        $faqsModel->createFaq($request);
        return redirect()->route('admin.faqs');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Faqs $faqsModel, $id)
    {
        $post = $faqsModel->singleFaq('id', $id);
        $title = 'Edit faq: ' . $post[0]->title;
        return view('admin.edit', ['post' => $post, 'type_content' => 'faq', 'route' => '/faqs/update']);
    }
    /**
     * Update the specified resource in storage.
     *
     * @return Response
     */
    public function  update( Faqs $faqsModel, Request $request)
    {
        $faqsModel->updateFaq($request);
        return redirect()->route('admin.faqs');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Faqs $faqsModel, $id)
    {
        $faqsModel->deleteFaq($id);
        return redirect()->route('admin.faqs');
    }

}
