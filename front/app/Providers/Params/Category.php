<?php

namespace App\Providers\Params;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'context',
        'page',
        'per_page',
        'search',
        'exclude',
        'include',
        'order',
        'orderby',
        'hide_empty',
        'parent',
        'post',
        'slug'
    ];

    /**
     * Scope under which the request is made; determines fields present in response.
     * @var str
     */
    protected $context;

    /**
     * Current page of the collection
     * @var int
     */
    protected $page = 1;

    /**
     * Maximum number of items to be returned in result set
     * @var int
     */
    protected $per_page = 10;

    /**
     * Limit results to those matching a string
     * @var str
     */
    protected $search;

    /**
     * Ensure result set excludes specific IDs
     * @var array
     */
    protected $exclude = [];

    /**
     * Limit result set to specific IDs
     * @var array
     */
    protected $include = [];

    /**
     * Order sort attribute ascending or descending
     * @var str     values: asc, desc
     */
    protected $order = 'asc';

    /**
     * Sort collection by term attribute
     * @var str     values: id, include, name, slug, term_group, description, count
     */
    protected $orderby = 'name';

    /**
     * Whether to hide terms not assigned to any posts
     * @var bool
     */
    protected $hide_empty;

    /**
     * Limit result set to terms assigned to a specific parent
     * @var int
     */
    protected $parent;

    /**
     * Limit result set to terms assigned to a specific post
     * @var int
     */
    protected $post;

    /**
     * Limit result set to terms with a specific slug
     * @var str
     */
    protected $slug;
}