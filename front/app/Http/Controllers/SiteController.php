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
     */
    public function index()
    {
        $posts = \CMS::posts();

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
     *
     * @param $category_slug
     * @param $post_slug
     * @param $post_id
     */
    public function post($category_slug, $post_slug, $post_id)
     {
         $post = \CMS::getPost($post_id);

         $data = [
             'pageTitle' => '',
             'post' => [],
             'postUrl' => ''
         ];
         $data['post'] = array_key_exists('results', $post) && $post['results'] ? $post['results'] : [];

         if (empty($data['post']->id)) abort(404);

         if ($data['post']) {
             $data['pageTitle'] = $data['post']->title;
         }

         $data['postUrl'] = route('site/post', [
             'category_slug' => $data['post']->categories[0]->slug,
             'post_slug' => $data['post']->slug,
             'post_id' => $data['post']->id
         ]);

         if (url()->current() != $data['postUrl']) return redirect($data['postUrl'], 301);

         View::share($data);
         return view('blog.post');
     }


}
