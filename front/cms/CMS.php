<?php

namespace SSZ\CMS;

class CMS
{
    public function __construct()
    {
        $this->reader = \App::make('\SSZ\CMS\Readers\CMS');
        $this->reader->endpoint = config('cms.api');
        $this->reader->useCache = config('cms.useCache.api');
    }

    public function display()
    {
        return "This is a test message";
    }

    public function posts($page = null)
    {
        $getPost = $this->reader->posts($page);
        if (array_key_exists('results', $getPost) && is_array($getPost['results']) && $getPost['results']) {
            $posts = [];
            foreach ($getPost['results'] as $post) {
                $posts[] = new \SSZ\CMS\Models\Post($this->prepPost($post));
            }

            $getPost['results'] = $posts;
        }

        return $getPost;
    }

    private function prepPost($post = [])
    {
        $categories = [];
        $media = [];
        $author = [];
        foreach ($post as $post_key => $post_value) {

            // if rendered exist, use rendered
            if (isset($post_value['rendered']) && $post_value['rendered']) $post[$post_key] = $post_value['rendered'];

            if ($post_key == 'categories') {
                foreach ($post_value as $category_id) {
                    $category = $this->getCategory($category_id);
                    if (array_key_exists('results', $category) && $category['results']) {
                        $categories[] = $category['results'];
                    }
                }
            }

            if ($post_key == 'featured_media' && $post_value) {
                $media = $this->getMedia($post_value);
                if (array_key_exists('results', $media) && $media['results']) $media = $media['results'];
            }

            if ($post_key == 'author' && $post_value) {
                $author = $this->getUser($post_value);
                if (array_key_exists('results', $author) && $author['results']) $author = $author['results'];
            }
        }

        if (array_key_exists('categories', $post) && $categories) $post['categories'] = $categories;

        $post['featured_media'] = new \SSZ\CMS\Models\Media();
        if (array_key_exists('featured_media', $post) && $media) $post['featured_media'] = $media;

        $post['author'] = new \SSZ\CMS\Models\User();
        if (array_key_exists('author', $post) && $author) $post['author'] = $author;

        return $post;
    }

    public function categories($args = null)
    {
        if (!$args) $args = new \SSZ\CMS\Params\Category();
        $categories = $this->reader->categories($args);
        if (array_key_exists('results', $categories) && $categories['results']) {
            foreach ($categories['results'] as $category_key => $category) {
                $categories['results'][$category_key] =  new \SSZ\CMS\Models\Category($category);
            }
        }

        return $categories;
    }

    public function getCategory($id, $args = null)
    {
        if (!$args) $args = new \SSZ\CMS\Params\Category();
        $category = $this->reader->getCategory($id, $args);
        if ($category && array_key_exists('results', $category) && $category['results']) {
            $category['results'] = new \SSZ\CMS\Models\Category($category['results']);
        }
        return $category;
    }

    public function getPost($id, $args = null)
    {
        if (!$args) $args = new \SSZ\CMS\Params\Post();
        $getPost = $this->reader->getPost($id, $args);
        if (array_key_exists('results', $getPost) && $getPost['results']) $getPost['results'] = new \SSZ\CMS\Models\Post($this->prepPost($getPost['results']));
        return $getPost;
    }

    public function medias($args = null)
    {
        if (!$args) $args = new \SSZ\CMS\Params\Media();
        $getMedias = $this->reader->medias($args);
        if (array_key_exists('results', $getMedias) && $getMedias['results']) {
            foreach ($getMedias['results'] as $media_key => $media) {
                $getMedias['results'][$media_key] = new \SSZ\CMS\Models\Media($media);
            }
        }
        return $getMedias;
    }

    public function getMedia($id, $args = null)
    {
        if (!$args) $args = new \SSZ\CMS\Params\Media();
        $media = $this->reader->getMedia($id, $args);
        if ($media && array_key_exists('results', $media) && $media['results']) {
            $media['results'] = new \SSZ\CMS\Models\Media($media['results']);
        }
        return $media;
    }

    public function users($args = null)
    {
        if (!$args) $args = new \SSZ\CMS\Params\User();
        $getUsers = $this->reader->users($args);
        if (array_key_exists('results', $getUsers) && $getUsers['results']) {
            foreach ($getUsers['results'] as $user_key => $user) {
                $getUsers['results'][$user_key] = new \SSZ\CMS\Models\User($user);
            }
        }
        return $getUsers;
    }

    public function getUser($id, $args = null)
    {
        if (!$args) $args = new \SSZ\CMS\Params\User();
        $user = $this->reader->getUser($id, $args);
        if ($user && array_key_exists('results', $user) && $user['results']) $user['results'] = new \SSZ\CMS\Models\User($user['results']);
        return $user;
    }
}