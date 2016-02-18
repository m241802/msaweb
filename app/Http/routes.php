<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

Route::get('home', 'HomeController@index');

Route::get('parser', 'HomeController@parser');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);
get('admin', ['as' => 'admin', 'uses' => 'PostController@adminList', 'middleware' => 'auth']);


get('auth/register/{one?}/{two?}/{three?}/{four?}/{five?}', ['uses' => 'Auth\AuthController@getRegister', 'middleware' => 'auth']);

Route::post('auth/register/{one?}/{two?}/{three?}/{four?}/{five?}', ['uses' => 'Auth\AuthController@postRegister', 'middleware' => 'auth']);


/*
* Cтатьи */
/*создание статьи*/
get('admin/posts/create', ['as' => 'admin.posts.create', 'uses' => 'PostController@create', 'middleware' => 'auth']);
/*обработчик (создание статьи)*/
Route::post('post', ['as' => 'post.create.handler', 'uses' => 'PostController@handlerCreate', 'middleware' => 'auth']);
/*удаление статьи*/
get('admin/posts/destroy', ['as' => 'admin.posts.destroy', 'uses' => 'PostController@destroy', 'middleware' => 'auth']);
/*изменение статьи*/
get('admin/posts/{id}', ['as' => 'admin.post.{id}', 'uses' => 'PostController@edit', 'middleware' => 'auth']);
/*обработчик (изменение статьи)*/
Route::post('posts/update', ['as' => 'post.update', 'uses' => 'PostController@update', 'middleware' => 'auth']);
/*административная страница статьи*/
get('admin/posts', ['as' => 'admin.posts', 'uses' => 'PostController@adminList', 'middleware' => 'auth']);
/*публичная страница статьи*/
get('posts/{slug}', ['as' => 'post.{slug}', 'uses' => 'PostController@single']);
/*публичная страница всехстатей*/
get('posts', ['as' => 'posts', 'uses' => 'PostController@index']);


/*
* Новости */
/*создание новости*/
get('admin/news/create', ['as' => 'admin.news.create', 'uses' => 'NewController@create', 'middleware' => 'auth']);
/*обработчик (создание новости)*/
Route::post('new', ['as' => 'new.create.handler', 'uses' => 'NewController@handlerCreate', 'middleware' => 'auth']);
/*удаление новости*/
get('admin/news/destroy', ['as' => 'admin.news.destroy', 'uses' => 'NewController@destroy', 'middleware' => 'auth']);
/*изменение новости*/
get('admin/news/{id}', ['as' => 'admin.new.{id}', 'uses' => 'NewController@edit', 'middleware' => 'auth']);
/*обработчик (изменение новости)*/
Route::post('news/update', ['as' => 'new.update', 'uses' => 'NewController@update', 'middleware' => 'auth']);
/*административная страница новостей*/
get('admin/news', ['as' => 'admin.news', 'uses' => 'NewController@adminList', 'middleware' => 'auth']);
/*публичная страница новостей*/
get('news/{slug}', ['as' => 'new.{slug}', 'uses' => 'NewController@single']);
/*публичная страница всех новостей*/
get('news', ['as' => 'news', 'uses' => 'NewController@index']);


/*
* FAQ */
/*создание вопроса*/
get('admin/faqs/create', ['as' => 'admin.faqs.create', 'uses' => 'FaqController@create', 'middleware' => 'auth']);
/*обработчик (создание вопроса)*/
Route::post('faq', ['as' => 'faq.create.handler', 'uses' => 'FaqController@handlerCreate', 'middleware' => 'auth']);
/*удаление вопроса*/
get('admin/faqs/destroy', ['as' => 'admin.faqs.destroy', 'uses' => 'FaqController@destroy', 'middleware' => 'auth']);
/*изменение вопроса*/
get('admin/faqs/{id}', ['as' => 'admin.faq.{id}', 'uses' => 'FaqController@edit', 'middleware' => 'auth']);
/*обработчик (изменение вопроса)*/
Route::post('faqs/update', ['as' => 'faq.update', 'uses' => 'FaqController@update', 'middleware' => 'auth']);
/*административная страница вопросов*/
get('admin/faqs', ['as' => 'admin.faqs', 'uses' => 'FaqController@adminList', 'middleware' => 'auth']);
/*публичная страница вопроса*/
get('faqs/{slug}', ['as' => 'faq.{slug}', 'uses' => 'FaqController@single']);
/*публичная страница всех вопросов*/
get('faqs', ['as' => 'faqs', 'uses' => 'FaqController@index']);


/*
*Картинки*/
get('admin/files/upload-page', ['as' => 'upload.page.file', 'uses' => 'FileController@uploadPage', 'middleware' => 'auth']);
/*обработчик (создание картинки)*/
Route::post('admin/files/upload', ['as' => 'upload.file', 'uses' => 'FileController@upload', 'middleware' => 'auth']);
/*административная страница Картинки*/
get('admin/files', ['as' => 'admin.files', 'uses' => 'FileController@index', 'middleware' => 'auth']);
/*изменение картинки*/
get('admin/images/{slug}', ['as' => 'admin.img.{slug}', 'uses' => 'FileController@imgEdit', 'middleware' => 'auth']);
/*обработчик (изменение картинки)*/
Route::post('images/update', ['as' => 'images.update', 'uses' => 'FileController@imgUpdate', 'middleware' => 'auth']);

//search
Route::post('/search', ['as' => 'search', 'uses' => 'HomeController@searchResult',]);

//get files through angular
Route::post('/get-files', ['as' => 'get.files', 'uses' => 'FileController@angFiles',]);
Route::post('/initial-files', ['as' => 'start.get.files', 'uses' => 'FileController@initialFiles',]);



Blade::setContentTags('<%', '%>');        // for variables and all things Blade
Blade::setEscapedContentTags('<%%', '%%>');   // for escaped data