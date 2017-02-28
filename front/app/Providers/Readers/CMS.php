<?php

namespace App\Providers\Readers;

use Illuminate\Support\Facades\Cache;

use \GuzzleHttp\Client;
use \GuzzleHttp\Exception\RequestException;

class CMS implements CMSInterface
{
    public $client;
    public $endpoint;
    public $auth;

    public function __construct($endpoint = null, $auth = null)
    {
        $this->client = new Client;
        $this->endpoint = $endpoint;
        $this->endpoint = $auth;
    }

    /**
     * Get all posts
     *
     * @uses   \App\Providers\Params\Post  params for Post's arguments
     *
     * @param  obj      $args
     * @return array
     */
    public function posts(\App\Providers\Params\Post $args = null)
    {
        return $this->get('posts', $args ? $args->toArray() : []);
    }

    /**
     * Get specific post by ID
     *
     * @uses   \App\Providers\Params\Post  params for Post's arguments
     *
     * @param  int      $id                post ID
     * @param  obj      $args
     * @return array
     */
    public function getPost($id, \App\Providers\Params\Post $args = null)
    {
        return $this->get("posts/{$id}", $args ? $args->toArray() : []);
    }

    /**
     * Get all categories
     *
     * @uses   obj      \App\Providers\Params\Category  params for Category's arguments
     * @param  obj      $args
     * @return array
     */
    public function categories(\App\Providers\Params\Category $args = null)
    {
        return $this->get('categories', $args ? $args->toArray() : []);
    }

    /**
     * Get specific category by ID
     *
     * @uses   \App\Providers\Params\Category  params for Category's arguments
     *
     * @param  integer  $id                    category ID
     * @param  obj      $args
     * @return array
     */
    public function getCategory($id, \App\Providers\Params\Category $args = null)
    {
        return $this->get("categories/{$id}", $args ? $args->toArray() : []);
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
        // $cacheKey = $method . http_build_query($query);
        // if ($return = Cache::get($cacheKey)) return $return;
        try {
            $response = $this->client->get($this->endpoint . $method, $query);
            $return = [
                'results' => json_decode((string) $response->getBody(), true),
                'total'   => $response->getHeaderLine('X-WP-Total'),
                'pages'   => $response->getHeaderLine('X-WP-TotalPages')
            ];
            // if ($return['results']) Cache::forever($cacheKey, $return);
        } catch (RequestException $e) {
            $error['message'] = $e->getMessage();
            if ($e->getResponse()) {
                $error['code'] = $e->getResponse()->getStatusCode();
            }
            $return = [
                'error'   => $error,
                'results' => [],
                'total'   => 0,
                'pages'   => 0
            ];
        }
        return $return;
    }
}
