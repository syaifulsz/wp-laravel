<?php

namespace App\Providers\Params;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'context',
        'page',
        'per_page',
        'search',
        '$after',
        'author',
        'author_exclude',
        'before',
        'exclude',
        'include',
        'offset',
        'order',
        'orderby',
        'slug',
        'status',
        'categories',
        'categories_exclude',
        'tags',
        'tags_exclude',
        'sticky',
        'password'
    ];

    /**
     * Scope under which the request is made; determines fields present
     * in response.
     * @var str
     */
    protected $context = 'view';

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
     * Limit response to posts published after a given ISO8601 compliant date
     * @var str
     */
    protected $after;

    /**
     * Limit result set to posts assigned to specific authors
     * @var str
     */
    protected $author;

    /**
     * Ensure result set excludes posts assigned to specific authors
     * @var array
     */
    protected $author_exclude = [];

    /**
     * Limit response to posts published before a given ISO8601 compliant date
     * @var str
     */
    protected $before;

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
     * Offset the result set by a specific number of items
     * @var int
     */
    protected $offset;

    /**
     * Order sort attribute ascending or descending
     * @var str     values: desc, asc
     */
    protected $order = 'desc';

    /**
     * Sort collection by object attribute.
     * @var str     values: date, relevance, id, include, title, slug
     */
    protected $orderby = 'date';

    /**
     * Limit result set to posts with one or more specific slugs.
     * @var str
     */
    protected $slug;

    /**
     * Limit result set to posts assigned one or more statuses
     * @var str
     */
    protected $status = 'publish';

    /**
     * Limit result set to all items that have the specified term assigned
     * in the categories taxonomy
     * @var array
     */
    protected $categories = [];

    /**
     * Limit result set to all items except those that have the specified
     * term assigned in the categories taxonomy
     * @var array
     */
    protected $categories_exclude = [];

    /**
     * Limit result set to all items that have the specified term assigned
     * in the tags taxonomy
     * @var array
     */
    protected $tags = [];

    /**
     * Limit result set to all items except those that have the specified
     * term assigned in the tags taxonomy
     * @var array
     */
    protected $tags_exclude = [];

    /**
     * Limit result set to items that are sticky
     * @var bool
     */
    protected $sticky;

    /**
     * The password for the post if it is password protected.
     * @var str
     */
    protected $password;
}