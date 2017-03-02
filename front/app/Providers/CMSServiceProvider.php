<?php

namespace App\Providers;

// readers
use \App\Providers\Readers\CMS;

// vendors
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

use Illuminate\Support\ServiceProvider;

class CMSServiceProvider extends ServiceProvider
{
    public function __construct()
    {
        $this->reader = new \App\Providers\Readers\CMS();
        $this->reader->endpoint = config('cms.api');
        $this->reader->useCache = config('cms.useCache.api');
    }

    public function posts($page = null)
    {
        $getPost = $this->reader->posts($page);
        if (array_key_exists('results', $getPost) && is_array($getPost['results']) && $getPost['results']) {
            $posts = [];
            foreach ($getPost['results'] as $post) {
                $posts[] = new \App\CMS\Post($this->prepPost($post));
            }

            $getPost['results'] = $posts;
        }

        return $getPost;
    }

    private function prepPost($post = [])
    {
        $categories = [];
        foreach ($post as $post_key => $post_value) {

            // if rendered exist, use rendered
            if (isset($post_value['rendered']) && $post_value['rendered']) $post[$post_key] = $post_value['rendered'];

            if ($post_key == 'categories') {
                foreach ($post_value as $category_id) {
                    $category = $this->getCategory($category_id);
                    if (array_key_exists('results', $category) && $category['results']) {
                        $categories[] = new \App\CMS\Category($category['results']);
                    }
                }
            }
        }

        if (array_key_exists('categories', $post) && $categories) $post['categories'] = $categories;

        return $post;
    }

    public function categories($args = null)
    {
        if (!$args) $args = new \App\Providers\Params\Category();
        return $this->reader->categories($args);
    }

    public function getCategory($id, $args = null)
    {
        if (!$args) $args = new \App\Providers\Params\Category();
        return $this->reader->getCategory($id, $args);
    }

    public function getPost($id, $args = null)
    {
        if (!$args) $args = new \App\Providers\Params\Post();
        $getPost = $this->reader->getPost($id, $args);
        if (array_key_exists('results', $getPost) && $getPost['results']) $getPost['results'] = new \App\CMS\Post($this->prepPost($getPost['results']));
        return $getPost;
    }
}
