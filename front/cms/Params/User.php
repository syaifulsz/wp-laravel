<?php

namespace SSZ\CMS\Params;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'context',
        'page',
        'per_page',
        'search',
        'exclude',
        'include',
        'offset',
        'order',
        'orderby',
        'slug',
        'roles'
    ];

    /**
     * Scope under which the request is made; determines fields present in response`
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
     * @var str     values: asc, desc
     */
    protected $order = 'asc';

    /**
     * Sort collection by object attribute
     * @var str     values: id, include, name, registered_date, slug, email, url
     */
    protected $orderby = 'name';

    /**
     * Limit result set to users with a specific slug
     * @var str
     */
    protected $slug;

    /**
     * Limit result set to users matching at least one specific role provided. Accepts csv list or single role
     * @var str
     */
    protected $roles;
}