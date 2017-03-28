<?php

namespace SSZ\CMS\Models;

use \Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'date',
        'date_gmt',
        'guid',
        'id',
        'link',
        'modified',
        'modified_gmt',
        'slug',
        'status',
        'type',
        'password',
        'title',
        'content',
        'author',
        'excerpt',
        'featured_media',
        'comment_status',
        'ping_status',
        'format',
        'meta',
        'sticky',
        'template',
        'categories',
        'tags',
        'liveblog_likes',
    ];

    /**
     * The date the object was published, in the site’s timezone
     * datetime (ISO8601)
     * @var str
     */
    protected $date;

    /**
     * The date the object was published, as GMT
     * datetime (ISO8601)
     * @var str
     */
    protected $date_gmt;

    /**
     * The globally unique identifier for the object
     * @var object
     */
    protected $guid;

    /**
     * Unique identifier for the object
     * @var int
     */
    protected $id;

    /**
     * uri	URL to the object
     * @var str
     */
    protected $link;

    /**
     * The date the object was last modified, in the site’s timezone
     * datetime (ISO8601)
     * @var str
     */
    protected $modified;

    /**
     * The date the object was last modified, as GMT
     * datetime (ISO8601)
     * @var str
     */
    protected $modified_gmt;

    /**
     * An alphanumeric identifier for the object unique to its type
     * @var str
     */
    protected $slug;

    /**
     * A named status for the object
     * @var str     Values: publish, future, draft, pending, private
     */
    protected $status;

    /**
     * Type of Post for the object
     * @var str
     */
    protected $type;

    /**
     * A password to protect access to the content and excerpt
     * @var str
     */
    protected $password;


    /**
     * The title for the object
     * @var str
     */
    protected $title;

    /**
     * The content for the object
     * @var str
     */
    protected $content;

    /**
     * The ID for the author of the object
     * @var obj
     */
    protected $author;

    /**
     * The excerpt for the object
     * @var str
     */
    protected $excerpt;

    /**
     * The ID of the featured media for the object
     * @var int
     */
    protected $featured_media;

    /**
     * Whether or not comments are open on the object
     * @var str         values: open, closed
     */
    protected $comment_status;

    /**
     * Whether or not the object can be pinged
     * @var str         values: open, closed
     */
    protected $ping_status;

    /**
     * The format for the object
     * @var str         values: standard
     */
    protected $format;

    /**
     * Meta fields
     * @var obj
     */
    protected $meta;

    /**
     * Whether or not the object should be treated as sticky
     * @var boolean
     */
    protected $sticky;

    /**
     * The theme file to use to display the object
     * @var str
     */
    protected $template;

    /**
     * The terms assigned to the object in the category taxonomy
     * @uses    \App\CMS\Category::class    model for category
     * @var     array
     */
    protected $categories;

    /**
     * The terms assigned to the object in the post_tag taxonomy
     * @var array
     */
    protected $tags;

    /**
     * The number of Liveblog Likes the post has.
     * @var int
     */
    protected $liveblog_likes;

    /**
     * Mutate post published date, and set created_at
     * @param array $value
     */
    public function setDateAttribute($value)
    {
        $this->attributes['date'] = new Carbon($value);
        $this->attributes['created_at'] = $this->attributes['date'];
    }

    /**
     * Mutate post modified date, and set modified_at
     * @param array $value
     */
    public function setModifiedAttribute($value)
    {
        $this->attributes['modified'] = new Carbon($value);
        $this->attributes['modified_at'] = $this->attributes['modified'];
    }

    public function getLinkAttribute($value)
    {
        return route('post', [
            'category_slug' => $this->attributes['categories'][0]->slug,
            'post_slug' => $this->attributes['slug'],
            'post_id' => $this->attributes['id']
        ]);
    }

    public function excerpt($limit = 0)
    {
        $excerpt = strip_tags($this->attributes['excerpt']);
        return $limit ? str_limit($excerpt, $limit) : strip_tags($excerpt);
    }
}
