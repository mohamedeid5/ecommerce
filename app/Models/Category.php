<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, Translatable;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'slug', 'is_active', 'parent_id'
    ];

    /**
     * translatedAttributes
     *
     * @var array
     */
    public $translatedAttributes = ['name'];

    /**
     * casts
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean'
    ];

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
     * Method scopeParent
     *
     * @param $query $query [explicite description]
     *
     * @return void
     */
    public function scopeParent($query)
    {
        return $query->whereNull('parent_id');
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
     * Method category_parent
     *
     * @return void
     */
    public function category_parent() {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Method children
     *
     * @return void
     */
    public function children() {
        return $this->hasMany(Category::class, 'parent_id');
    }

}
