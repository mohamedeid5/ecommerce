<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory, Translatable;

    /**
     * with
     *
     * @var array
     */
    protected $with = ['translations'];

    /**
     * hidden
     *
     * @var array
     */
    protected $hidden = ['translations'];

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'slug',
        'price',
        'speical_price',
        'speical_price_start',
        'speical_price_end',
        'selling_price',
        'sku',
        'manage_stock',
        'qty',
        'in_stock',
        'views',
        'is_active',
        'brand_id',
    ];

    /**
     * casts
     *
     * @var array
     */
    protected $casts = [
        'manage_stock'  => 'boolean',
        'in_stock'      => 'boolean',
        'is_active'     => 'boolean',
    ];

    /**
     * dates
     *
     * @var array
     */
    protected $dates = [

        'speical_price_start',
        'speical_price_end',
        'start_date',
        'end_date',
        'deleted_at',
    ];

    protected $translatedAttributes = ['name', 'description', 'short_description'];

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value, '-');
    }

    /**
     * Method scopeActive
     *
     * @param $query
     *
     * @return void
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    /**
     * Method brand
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class)->withDefault();
    }

    /**
     * Method categories
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }

    /**
     * Method tags
     *
     * @return void
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tags');
    }

    /**
     * Method images
     *
     * @return void
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

     /**
     * Method getActive
     *
     * @return string
     */
    public function getActive()
    {
        return $this->is_active == 1 ? __('general.active') : __('general.not_active');
    }

    /**
     * Method options
     *
     * @return void
     */
    public function options()
    {
        return $this->hasMany(Option::class);
    }

    /**
     * Method users
     *
     * @return void
     */
    public function user_wishlist()
    {
        return $this->belongsToMany(User::class, 'wishlists')->withTimestamps();
    }

}
