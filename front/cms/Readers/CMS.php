<?php

namespace SSZ\CMS\Readers;

use Illuminate\Support\Facades\Cache;

use \GuzzleHttp\Client;
use \GuzzleHttp\Exception\RequestException;

class CMS implements CMSInterface
{
    public $client;
    public $endpoint;
    public $useCache;

    public function __construct($endpoint = null, $auth = null, $useCache = false)
    {
        $this->client = new Client;
        $this->endpoint = $endpoint;
        $this->useCache = $useCache;
    }

    /**
     * Get all posts
     *
     * @uses   \SSZ\CMS\Params\Post  params for Post's arguments
     *
     * @param  obj      $args
     * @return array
     */
    public function posts(\SSZ\CMS\Params\Post $args = null)
    {
        return $this->get('posts', $args ? $args->toArray() : []);
    }

    /**
     * Get specific post by ID
     *
     * @uses   \SSZ\CMS\Params\Post  params for Post's arguments
     *
     * @param  int      $id                post ID
     * @param  obj      $args
     * @return array
     */
    public function getPost($id, \SSZ\CMS\Params\Post $args = null)
    {
        return $this->get("posts/{$id}", $args ? $args->toArray() : []);
    }

    /**
     * Get all categories
     *
     * @uses   obj      \SSZ\CMS\Params\Category  params for Category's arguments
     * @param  obj      $args
     * @return array
     */
    public function categories(\SSZ\CMS\Params\Category $args = null)
    {
        return $this->get('categories', $args ? $args->toArray() : []);
    }

    /**
     * Get specific category by ID
     *
     * @uses   \SSZ\CMS\Params\Category  params for Category's arguments
     *
     * @param  integer  $id                    category ID
     * @param  obj      $args
     * @return array
     */
    public function getCategory($id, \SSZ\CMS\Params\Category $args = null)
    {
        return $this->get("categories/{$id}", $args ? $args->toArray() : []);
    }

    /**
     * Get all medias
     *
     * @uses   obj      \SSZ\CMS\Params\Media  params for Media's arguments
     * @param  obj      $args
     * @return array
     */
    public function medias(\SSZ\CMS\Params\Media $args = null)
    {
        return $this->get('media', $args ? $args->toArray() : []);
    }

    /**
     * Get specific media by ID
     * @uses   obj      \SSZ\CMS\Params\Media  params for Media's arguments
     * @param  str      $id
     * @param  obj      $args
     * @return array
     */
    public function getMedia($id, \SSZ\CMS\Params\Media $args = null)
    {
        return $this->get("media/{$id}", $args ? $args->toArray() : []);
    }

    /**
     * Get all users
     *
     * @uses   obj      \SSZ\CMS\Params\User  params for User's arguments
     * @param  obj      $args
     * @return array
     */
    public function users(\SSZ\CMS\Params\User $args = null)
    {
        return $this->get('users', $args ? $args->toArray() : []);
    }

    /**
     * Get specific user by ID
     * @uses   obj      \SSZ\CMS\Params\User  params for Media's arguments
     * @param  str      $id
     * @param  obj      $args
     * @return array
     */
    public function getUser($id, \SSZ\CMS\Params\User $args = null)
    {
        return $this->get("users/{$id}", $args ? $args->toArray() : []);
    }

    /**
     * Get data from API
     *
     * @param  string   $method
     * @param  array    $query
     * @return array
     */
    public function get($method, array $query = [])
    {
        $query = ['query' => $query];
        $cacheKey = \SSZ\CMS\Components\CMSHelper::cacheKeygen([$method, $query]);
        if (($return = Cache::get($cacheKey)) && $this->useCache) return $return;

        try {
            $response = $this->client->get($this->endpoint . $method, $query);
            $return = [
                'results' => json_decode((string) $response->getBody(), true),
                'total'   => $response->getHeaderLine('X-WP-Total'),
                'pages'   => $response->getHeaderLine('X-WP-TotalPages')
            ];

            if ($return['results']) {
                Cache::put($cacheKey, $return, 60);
                Cache::forever("staticReaderCache_{$cacheKey}", $return);
            }
        } catch (RequestException $e) {
            $error['message']   = $e->getMessage();
            $error['method']    = $method;
            $error['query']     = $query;
            if ($e->getResponse()) $error['code'] = $e->getResponse()->getStatusCode();
            $return = [
                'error'   => $error,
                'results' => [],
                'total'   => 0,
                'pages'   => 0
            ];
            \Log::error(__METHOD__ . ' No data return in CMS Reader API [[[]]] ' . print_r($return, true));
            if (($return = Cache::get("staticReaderCache_{$cacheKey}")) && $this->useCache) return $return;
        }
        return $return;
    }
}
