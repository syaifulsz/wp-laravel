<?php

namespace SSZ\CMS\Models;

use \Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
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
        'title',
        'author',
        'comment_status',
        'ping_status',
        'meta',
        'alt_text',
        'caption',
        'description',
        'media_type',
        'mime_type',
        'media_details',
        'post',
        'source_url'
    ];

    /**
     * The date the object was published, in the site’s timezone
     * @var str
     */
    protected $date;

    /**
     * The date the object was published, as GMT
     * @var str
     */
    protected $date_gmt;

    /**
     * The globally unique identifier for the object
     * @var obj
     */
    protected $guid;

    /**
     * Unique identifier for the object
     * @var int
     */
    protected $id;

    /**
     * URL to the object
     * @var str
     */
    protected $link;

    /**
     * The date the object was last modified, in the site’s timezone
     * @var str
     */
    protected $modified;

    /**
     * The date the object was last modified, as GMT
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
     * @var str     values: publish, future, draft, pending, private
     */
    protected $status;

    /**
     * Type of Post for the object
     * @var str
     */
    protected $type;

    /**
     * The title for the object
     * @var obj
     */
    protected $title;

    /**
     * The id for the author of the object
     * @var str     values: open, closed
     */
    protected $author;

    /**
     * Whether or not comments are open on the object
     * @var str     values: open, closed
     */
    protected $comment_status;

    /**
     * Whether or not the object can be pinged
     * @var str     values: open, closed
     */
    protected $ping_status;

    /**
     * Meta fields
     * @var obj
     */
    protected $meta;

    /**
     * Alternative text to display when resource is not displayed
     * @var str
     */
    protected $alt_text;

    /**
     * The caption for the resource
     * @var str
     */
    protected $caption;

    /**
     * The description for the resource
     * @var str
     */
    protected $description;

    /**
     * Type of resource
     * @var str     values: image, file
     */
    protected $media_type;

    /**
     * MIME type of resource
     * @var str
     */
    protected $mime_type;

    /**
     * Details about the resource file, specific to its type
     * @var obj
     */
    protected $media_details;

    /**
     * The id for the associated post of the resource
     * @var int
     */
    protected $post;

    /**
     * URL to the original resource file
     * @var str
     */
    protected $source_url;

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

    public function media($size = 'thumbnail', $meta = false)
    {
        $media = null;
        $uploads = null;

        if (!isset($this->attributes['media_details']) || !$this->attributes['media_details']) return $media;

        $file = $this->attributes['media_details']['file'];
        $uploads = dirname($file);

        if (!isset($this->attributes['media_details']['sizes'][$size]) && $size) return $media;

        $media = $this->attributes['media_details']['sizes']['full']['file'];
        if ($size) $media = $this->attributes['media_details']['sizes'][$size]['file'];
        if ($meta && $size) $media = $this->attributes['media_details']['sizes'][$size];

        if (is_array($media)) $media['url'] = config('cms.media') . "{$uploads}/{$media['file']}";

        return is_array($media) ? $media : config('cms.media') . "{$uploads}/{$media}";
    }
}
