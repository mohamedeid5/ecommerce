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
    protected $translatedAttributes = ['name'];

    /**
     * Method getImageAttribute
     *
     * @param $val
     *
     * @return void
     */
    public function getImageAttribute($val) {

        return $val !== null ? 'admin/images/brands/' . $val : '';

    }


}
