<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, Translatable, SoftDeletes;

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
     * catas
     *
     * @var array
     */
    protected $catas = [
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



}
