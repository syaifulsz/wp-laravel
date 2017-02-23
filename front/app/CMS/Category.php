<?php

namespace App\CMS;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'id',
        'count',
        'description',
        'link',
        'name',
        'slug',
        'taxonomy',
        'parent',
        'meta'
    ];

    /**
     * Unique identifier for the term
     * @var int
     */
    protected $id;

    /**
     * Number of published posts for the term
     * @var integer
     */
    protected $count;

    /**
     * HTML description of the term
     * @var string
     */
    protected $description;

    /**
     * uri	URL of the term
     * @var string
     */
    protected $link;

    /**
     * HTML title for the term
     * @var string
     */
    protected $name;

    /**
     * An alphanumeric identifier for the term unique to its type
     * @var string
     */
    protected $slug;

    /**
     * Type attribution for the term
     * @var string      values: category, post_tag, nav_menu, link_category, post_format
     */
    protected $taxonomy;

    /**
     * The parent term ID
     * @var integer
     */
    protected $parent;

    /**
     * Meta fields
     * @var object
     */
    protected $meta;
}
