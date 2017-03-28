<?php

namespace SSZ\CMS\Models;

use \Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'id',
        'username',
        'name',
        'first_name',
        'last_name',
        'email',
        'url',
        'description',
        'link',
        'locale',
        'nickname',
        'slug',
        'registered_date',
        'roles',
        'password',
        'capabilities',
        'extra_capabilities',
        'avatar_urls',
        'meta'
    ];

    /**
     * Unique identifier for the user
     * @var int
     */
    protected $id;

    /**
     * Login name for the user
     * @var str
     */
    protected $username;

    /**
     * Display name for the user
     * @var str
     */
    protected $name;

    /**
     * First name for the user
     * @var str
     */
    protected $first_name;

    /**
     * Last name for the user
     * @var str
     */
    protected $last_name;

    /**
     * The email address for the user
     * @var str
     */
    protected $email;

    /**
     * URL of the user
     * @var str
     */
    protected $url;

    /**
     * Description of the user
     * @var str
     */
    protected $description;

    /**
     * Author URL of the user
     * @var str
     */
    protected $link;

    /**
     * Locale for the user
     * @var str
     */
    protected $locale;

    /**
     * The nickname for the user
     * @var str
     */
    protected $nickname;

    /**
     * An alphanumeric identifier for the user
     * @var str
     */
    protected $slug;

    /**
     * Registration date for the user
     * @var str
     */
    protected $registered_date;

    /**
     * Roles assigned to the user
     * @var array
     */
    protected $roles = [];

    /**
     * Password for the user (never included)
     * @var str
     */
    protected $password;

    /**
     * All capabilities assigned to the user
     * @var obj
     */
    protected $capabilities = [];

    /**
     * Any extra capabilities assigned to the user
     * @var obj
     */
    protected $extra_capabilities = [];

    /**
     * Avatar URLs for the user
     * @var obj
     */
    protected $avatar_urls = [];

    /**
     * Meta fields
     * @var obj
     */
    protected $meta = [];

    /**
     * Mutate post published date, and set created_at
     * @param array $value
     */
    public function setDateAttribute($value)
    {
        $this->attributes['registered_date'] = new Carbon($value);
        $this->attributes['created_at'] = $this->attributes['registered_date'];
        $this->attributes['modified_at'] = $this->attributes['registered_date'];
    }

    public function avatar($size = 24)
    {
        $avatar = $this->attributes['avatar_urls'] ? array_first($this->attributes['avatar_urls']) : null;
        if ($this->attributes['avatar_urls'] && array_key_exists('24', $this->attributes['avatar_urls'])) $avatar = str_replace('s=24', "s={$size}", $this->attributes['avatar_urls']['24']);
        return $avatar;
    }
}
