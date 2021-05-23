<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
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
        'slug', 'is_active', 'image'
    ];

    /**
     * casts
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean'
    ];

    /**
     * translatedAttributes
     *
     * @var array
     */
    protected array $translatedAttributes = ['name'];

    /**
     * Method getImageAttribute
     *
     * @param $val
     *
     * @return string
     */
    public function getImageAttribute($val): string
    {

        return $val !== null ? 'admin/images/brands/' . $val : '';

    }

    public function scopeIsActive($query)
    {
        return $query->where('is_active', 1);
    }

}
