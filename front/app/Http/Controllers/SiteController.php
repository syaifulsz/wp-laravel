<?php

namespace App\Http\Controllers;

// Facades
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Cache;

class SiteController extends Controller
{
    /**
     * Home Page
     * @return View::class();
     */
     public function index()
     {
         $cms = new \CMS();
         $posts = $cms->posts();

         $data = [
             'pageTitle' => 'Blog',
             'posts' => []
         ];
         $data['posts'] = array_key_exists('results', $posts) && $posts['results'] ? $posts['results'] : [];

         View::share($data);
         return view('blog.index');
     }

     /**
      * Article Page
      * @return View::class();
      */
     public function post($category_slug, $post_slug, $post_id)
     {
         $cms = new \CMS();
         $post = $cms->getPost($post_id);

         $data = [
             'pageTitle' => '',
             'post' => []
         ];
         $data['post'] = array_key_exists('results', $post) && $post['results'] ? $post['results'] : [];
         if ($data['post']) {
             $data['pageTitle'] = $data['post']->title;
         }

         View::share($data);
         return view('blog.post');
     }
}
